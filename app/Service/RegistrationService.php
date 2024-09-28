<?php

namespace App\Service;

use App\Mail\InternStatus;
use App\Models\Intern;
use App\Models\Periode;
use App\Models\Position;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RegistrationService
{
    public function getSelectedPosition($positionId)
    {
        return Position::find($positionId);
    }

    public function getActivePositions(Carbon $today)
    {
        return Position::whereHas('periodes', function ($query) use ($today) {
            $query->where('start_date', '<=', $today)
                ->where('end_date', '>=', $today);
        })->get();
    }

    public function getPositionWithQuota($slug, Carbon $today,)
    {
        $position = Position::where('slug', $slug)->first();

        if (!$position) {
            return null;
        }

        $periode = Periode::whereHas('positions', function ($query) use ($position) {
            $query->where('position_id', $position->id);
        })->where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->first();

        $quota = $periode ? $periode->positions->where('id', $position->id)->first()?->pivot->quota : null;

        return [
            'position' => $position,
            'periode' => $periode,
            'quota' => $quota
        ];
    }

    // Penyimpanan Formulir Pendaftaran
    public function uploadFile($file, $folder)
    {
        if ($file) {
            $fileName = $file->getClientOriginalName();
            $file->move(public_path("uploads/{$folder}"), $fileName);
            return $fileName;
        }
        return null;
    }

    public function createIntern(Request $request)
    {
        $intern = new Intern();
        $intern->email = $request->email;
        $intern->full_name = $request->full_name;
        $intern->username = $request->username;
        $intern->phone_number = $request->phone_number;
        $intern->gender = $request->gender;
        $intern->address = $request->address;
        $intern->school = $request->school;
        $intern->major = $request->major;
        $intern->start_date = $request->start_date;
        $intern->end_date = $request->end_date;
        $intern->position_id = $request->position_id;
        $intern->periode_id = $request->periode_id;
        $intern->cv = $this->uploadFile($request->file('cv'), 'cv');
        $intern->motivation_letter = $this->uploadFile($request->file('motivation_letter'), 'motivation_letter');
        $intern->cover_letter = $this->uploadFile($request->file('cover_letter'), 'cover_letter');
        $intern->portfolio = $this->uploadFile($request->file('portfolio'), 'portfolio');
        $intern->photo = $this->uploadFile($request->file('photo'), 'photo');
        $intern->status = $request->input('status', 'pending');
        $intern->messages = $request->messages;
        $intern->registration_date = Carbon::now();
        return $intern;
    }

    public function saveIntern(Intern $intern)
    {
        return $intern->save();
    }

    public function sendRegisterEmail(Intern $intern)
    {
        if ($intern->status === 'pending') {
            Mail::to($intern->email)->send(new InternStatus($intern, 'pending'));
        }
    }
}
