<?php

use App\Models\LogActivity;
use Illuminate\Support\Facades\Auth;

class Utility
{
    public static function addLog($activity, $model = null)
    {
        $data = $model ? json_encode($model->toArray(), JSON_PRETTY_PRINT) : null;

        LogActivity::create([
            'user_id' => Auth::id(),
            'model_type' => $model ? get_class($model) : null,
            'model_id' => $model ? $model->id : null,
            'show' => $model ? route(strtolower(class_basename($model)) . '.show', $model->id) : null,
            'data' => $data,
            'activity' => $activity,
            'method' => request()->method(),
            'url' => request()->fullUrl(),
            'agent' => request()->header('User-Agent'),
            'ip' => request()->ip(),
        ]);
    }
}


?>