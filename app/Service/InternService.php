<?php

namespace App\Service;

use App\Http\Requests\UpdateInternRequest;
use App\Mail\InternStatus;
use App\Models\Intern;
use App\Models\Periode;
use App\Models\Position;
use App\Models\Report;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use PhpOffice\PhpWord\IOFactory;

class InternService
{
    protected $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    // Edit
    public function getAllPositions()
    {
        return Position::all();
    }

    public function getActivePositions(Carbon $today)
    {
        return Position::whereHas('periodes', function ($query) use ($today) {
            $query->where('start_date', '<=', $today)
                ->where('end_date', '>=', $today);
        })->get();
    }

    // Update
    // public function updateIntern($intern, $request)
    // {
    //     $status = $request->input('status');
    //     $newPositionId = $request->input('position_id');
    //     $previousStatus = $intern->status;

    //     if (in_array($status, ['pending', 'interview', 'accepted', 'rejected'])) {
    //         $intern->messages = $request->messages;
    //     }

    //     if ($intern->status !== $status) {
    //         $this->handleStatusChange($intern, $previousStatus, $status);
    //         $intern->status = $status;
    //     }

    //     if ($intern->position_id != $newPositionId) {
    //         $this->updatePosition($intern, $newPositionId);
    //     }

    //     $this->updateInternData($intern, $request);

    //     if ($intern->save()) {
    //         return response()->json(['success' => true]);
    //     } else {
    //         return response()->json(['success' => false]);
    //     }
    // }

    /**
     * Menambah kuota untuk posisi
     *
     * @param Intern $intern
     * @param Periode $periode
     * @param Position|null $position
     */
    public function increaseQuota($intern, $periode, $position = null)
    {
        $positionId = $position ? $position->id : $intern->position_id;

        $pivotData = $periode->positions()->where('positions.id', $positionId)->first();

        if ($pivotData) {
            // Tambahkan 1 ke kuota
            $pivotData->pivot->quota++;
            $pivotData->pivot->save();
        }
    }

    /**
     * Mengurangi kuota untuk posisi
     *
     * @param Intern $intern
     * @param Periode $periode
     * @param Position|null $position
     * @throws Exception
     */
    public function decreaseQuota($intern, $periode, $position = null)
    {
        $positionId = $position ? $position->id : $intern->position_id;

        $pivotData = $periode->positions()->where('positions.id', $positionId)->first();

        if (!$pivotData) {
            throw new \Exception('Posisi tidak ditemukan untuk periode ini.');
        }

        if ($pivotData->pivot->quota <= 0) {
            throw new \Exception('Maaf, kuota untuk posisi ini sudah penuh.');
        }

        // Kurangi kuota
        $pivotData->pivot->quota--;
        $pivotData->pivot->save();

        return true;
    }

    /**
     * Update posisi intern dengan memperhatikan berbagai skenario
     *
     * @param Intern $intern
     * @param int $newPositionId
     * @return JsonResponse|void
     */
    public function updatePosition($intern, $newPositionId, $newStatus = null)
    {
        $newPosition = Position::find($newPositionId);

        if ($newPosition) {
            $newPeriode = Periode::find($intern->periode_id);
            $oldPosition = Position::find($intern->position_id);

            if ($newPeriode) {
                // Skenario 1
                if ($intern->status === 'accepted' && $intern->position_id != $newPositionId) {
                    $this->increaseQuota($intern, $newPeriode, $oldPosition);
                    $this->decreaseQuota($intern, $newPeriode, $newPosition);
                }
                // Skenario 2
                elseif (in_array($intern->status, ['pending', 'interview', 'rejected']) && $newStatus === 'accepted' && $intern->position_id != $newPositionId) {
                    $intern->status = 'accepted';
                    $this->decreaseQuota($intern, $newPeriode, $newPosition);
                }
                // Skenario 3
                elseif ($intern->status === 'accepted' && in_array($newStatus, ['pending', 'interview', 'rejected']) && $intern->position_id != $newPositionId) {
                    $this->increaseQuota($intern, $newPeriode, $oldPosition);
                    $intern->status = $newStatus;
                }
                // Skenario 4
                elseif ($intern->position_id != $newPositionId && $intern->status === $newStatus) {
                    // Tidak ada perubahan pada kuota
                }

                $intern->position_id = $newPositionId;
                $intern->status = $newStatus ?? $intern->status;
                $intern->save();
            }
        } else {
            return response()->json(['message' => 'Posisi tidak ditemukan.'], 404);
        }
    }


    public function handleStatusChange($intern, $previousStatus, $status)
    {
        $periode = Periode::find($intern->periode_id);

        if ($status === 'rejected' || $status === 'pending' || $status === 'interview') {
            if ($previousStatus === 'accepted' && $periode) {
                $this->increaseQuota($intern, $periode);
                Report::where('intern_id', $intern->id)->delete();
            }

            Mail::to($intern->email)->send(new InternStatus($intern, $status, $intern->messages));
        } elseif ($status === 'accepted') {
            if ($this->decreaseQuota($intern, $periode)) {
                $this->createUserAndReports($intern, $periode);
            }
        }
    }

    public function createReports($startDate, $endDate, $internId)
    {
        $currentDate = $startDate;
        while ($currentDate <= $endDate) {
            Report::create([
                'intern_id' => $internId,
                'date' => $currentDate,
                'attendance_time' => null,
                'presence' => null,
                'is_late' => false,
                'is_consequence_done' => false,
                'consequence_description' => null,
                'agency' => null,
                'project_name' => null,
                'job' => null,
                'description' => null,
                'status' => 'pending',
                'admin_reason' => null
            ]);
            $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
        }
    }

    public function createUserAndReports($intern, $periode)
    {
        $user = User::create([
            'name' => $intern->username,
            'email' => $intern->email,
            'role' => 'user',
            'password' => bcrypt('intern' . $intern->username),
        ]);

        $intern->user_id = $user->id;
        $this->createReports($intern->start_date, $intern->end_date, $intern->id);

        Mail::to($intern->email)->send(new InternStatus($intern, 'accepted', 'intern' . $intern->username, $intern->messages));
    }

    public function updateInternData($intern, $request)
    {
        $intern->update($request->only([
            'full_name',
            'username',
            'email',
            'phone_number',
            'address',
            'gender',
            'school',
            'major',
            'periode_id',
            'start_date',
            'end_date',
            'messages'
        ]));

        $this->uploadFiles($intern, $request);
    }

    public function uploadFiles($intern, $request)
    {
        $files = ['cv', 'motivation_letter', 'cover_letter', 'portfolio', 'photo'];
        foreach ($files as $file) {
            if ($request->hasFile($file)) {
                $fileName = $this->fileService->uploadFile($request->file($file), $file);
                $intern->update([$file => $fileName]);
            }
        }
    }
}
