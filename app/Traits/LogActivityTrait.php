<?php

namespace App\Traits;

use App\Models\Aspect;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\GradeRange;
use App\Models\Intern;
use App\Models\LogActivity;
use App\Models\Position;
use App\Models\PositionAspect;
use App\Models\Subscription;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

trait LogActivityTrait
{
    public function logActivity($model, $action, array $data = [])
    {
        $identifier = $model->name ?? 'Tidak Ada Nama';
        $identifierLabel = 'nama';
        $modelId = null;

        if (is_array($model)) {
            $identifier = 'Aspek Baru';
        } elseif ($model instanceof Aspect) {
            $type = $model->type ?? '-';
            $show = "{$type}-aspects";

            if ($type === 'technical') {
                $modelId = null;
                $relatedAspects = PositionAspect::whereIn('aspect_id', array_column($data['aspects'], 'id'))
                    ->with('position', 'aspect')
                    ->get();

                $aspects = $relatedAspects->groupBy('aspect_id')->map(function ($group) {
                    $firstAspect = $group->first()->aspect;
                    return [
                        'id' => $firstAspect->id,
                        'name' => $firstAspect->name,
                        'type' => $firstAspect->type,
                        'positions' => $group->map(function ($positionAspect) {
                            return [
                                'position_id' => $positionAspect->position_id,
                                'position_name' => $positionAspect->position->name,
                                'position_aspect' => [
                                    'id' => $positionAspect->id,
                                    'position_id' => $positionAspect->position_id,
                                    'aspect_id' => $positionAspect->aspect_id,
                                ],
                            ];
                        })->toArray(),
                    ];
                })->values();

                $data = array_merge($data, ['aspects' => $aspects]);
                $positionId = $data['position_id'];
                $aspectCount = count($data['aspects']);
                $activityMessage = "{$action} dengan Position ID {$positionId} dan jumlah aspek {$aspectCount}";
            } else {
                $modelId = $model->id;
            }
        } elseif ($model instanceof Subscription) {
            $identifier = $model->email;
            $identifierLabel = 'email';
            $modelId = $model->id;
            $show = $model->routeName() . '/' . $modelId;
        } elseif ($model instanceof Intern) {
            $identifier = $model->full_name;
            $identifierLabel = 'nama';
            $modelId = $model->id;
            $show = $model->routeName() . '/' . $modelId;
        } elseif ($model instanceof Blog) {
            $identifier = $model->title;
            $identifierLabel = 'judul';
            $modelId = $model->id;
            $show = $model->routeName() . '/' . $modelId;
        } elseif ($model instanceof Comment) {
            $identifier = $model->message;
            $identifierLabel = 'pesan';
            $modelId = $model->id;
            $show = $model->routeName() . '/' . $modelId;
        } elseif ($model instanceof GradeRange) {
            $identifier = $model->predicate;
            $identifierLabel = 'predikat';
            $modelId = $model->id;
            $show = $model->routeName() . '/' . $modelId;
        } else {
            $modelId = $model->id ?? null;
            $show = $model->routeName() . '/' . $modelId;
        }


        LogActivity::create([
            'user_id' => Auth::id(),
            'model_type' => get_class($model),
            'model_id' => $modelId,
            'show' => isset($show) ? $show : null,
            'data' => $data,
            'activity' => isset($activityMessage) ? $activityMessage : ($action . ' dengan ID ' . $modelId . ' dan ' . $identifierLabel . ' ' . $identifier),
            'method' => request()->method(),
            'url' => request()->fullUrl(),
            'agent' => request()->header('User-Agent'),
            'ip' => request()->ip(),
        ]);
    }
}
