<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInternRequest;
use App\Mail\InternStatus;
use App\Models\Intern;
use App\Models\Periode;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $positionId = $request->input('position_id');
        $selectedPosition = null;
        $activePositions = null; // Inisialisasi $activePositions agar tidak menghasilkan "Undefined variable" jika tidak ada parameter 'position_id'.

        if ($positionId) {
            // Jika parameter position_id ada, pengguna membuka formulir dari tautan di halaman landing.
            $selectedPosition = Position::find($positionId);
        } else {
            // Jika tidak ada parameter position_id, tampilkan daftar posisi yang aktif.
            $today = now()->format('Y-m-d');
            $activePositions = Position::whereHas('periode', function ($query) use ($today) {
                $query->where('start_date', '<=', $today)
                    ->where('end_date', '>=', $today);
            })->get();
        }

        return view('form', compact('selectedPosition', 'activePositions'));
    }

    public function showBySlug(Request $request, $slug)
    {
        $position = Position::where('slug', $slug)->first();

        if (!$position) {
            abort(404);
        }

        $selectedPosition = $position;

        $today = now()->format('Y-m-d');
        $activePositions = Position::whereHas('periode', function ($query) use ($today) {
            $query->where('start_date', '<=', $today)
                ->where('end_date', '>=', $today);
        })->get();

        $periode = Periode::where('position_id', $selectedPosition->id)
            ->where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->first();

        if (!$periode || $periode->quota <= 0) {
            // Periode tidak ditemukan atau kuotanya habis, atur respon sesuai kebutuhan Anda
            return view('components.error');
        }

        return view('form', compact('selectedPosition', 'activePositions', 'periode'));


    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInternRequest $request)
    {
        $cvFileName = null;
        if ($request->hasFile('cv')) {
            $cvFile = $request->file('cv');
            $cvFileName = $cvFile->getClientOriginalName();
            $cvFile->move(public_path('files/cv'), $cvFileName);
        }

        $motivation_letterFileName = null;
        if ($request->hasFile('motivation_letter')) {
            $motivation_letterFile = $request->file('motivation_letter');
            $motivation_letterFileName = $motivation_letterFile->getClientOriginalName();
            $motivation_letterFile->move(public_path('files/motivation_letter'), $motivation_letterFileName);
        }

        $cover_letterFileName = null;
        if ($request->hasFile('cover_letter')) {
            $cover_letterFile = $request->file('cover_letter');
            $cover_letterFileName = $cover_letterFile->getClientOriginalName();
            $cover_letterFile->move(public_path('files/cover_letter'), $cover_letterFileName);
        }

        $portfolioFileName = null;
        if ($request->hasFile('portfolio')) {
            $portfolioFile = $request->file('portfolio');
            $portfolioFileName = $portfolioFile->getClientOriginalName();
            $portfolioFile->move(public_path('files/portfolio'), $portfolioFileName);
        }

        $photoFileName = null;
        if ($request->hasFile('photo')) {
            $photoFile = $request->file('photo');
            $photoFileName = $photoFile->getClientOriginalName();
            $photoFile->move(public_path('files/photo'), $photoFileName);
        }


        $interns = new Intern();
        // $interns->user_id = null;
        $interns->email = $request->email;
        $interns->full_name = $request->full_name;
        $interns->username = $request->username;
        $interns->phone_number = $request->phone_number;
        $interns->gender = $request->gender;
        $interns->address = $request->address;
        $interns->school = $request->school;
        $interns->major = $request->major;
        $interns->start_date = $request->start_date;
        $interns->end_date = $request->end_date;
        $interns->position_id = $request->position_id;
        $interns->periode_id = $request->periode_id; 
        $interns->cv = $cvFileName;
        $interns->motivation_letter = $motivation_letterFileName;
        $interns->cover_letter = $cover_letterFileName;
        $interns->portfolio = $portfolioFileName;
        $interns->photo = $photoFileName;
        $interns->status = $request->input('status', 'pending');
        $interns->messages = $request->messages;

        if ($interns->save()) {
            if ($interns->status === 'pending') {
                // Kirim email notifikasi ke pemagang dengan status 'pending'
                Mail::to($interns->email)->send(new InternStatus($interns, 'pending'));
            }

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // $cvFileName = null;
    // if ($request->hasFile('cv')) {
    //     $cvFile = $request->file('cv');
    //     $cvFileName = $cvFile->getClientOriginalName();
    //     $cvFile->move(public_path('files/cv'), $cvFileName);
    // }

    // $motivation_letterFileName = null;
    // if ($request->hasFile('motivation_letter')) {
    //     $motivation_letterFile = $request->file('motivation_letter');
    //     $motivation_letterFileName = $motivation_letterFile->getClientOriginalName();
    //     $motivation_letterFile->move(public_path('files/motivation_letter'), $motivation_letterFileName);
    // }

    // $cover_letterFileName = null;
    // if ($request->hasFile('cover_letter')) {
    //     $cover_letterFile = $request->file('cover_letter');
    //     $cover_letterFileName = $cover_letterFile->getClientOriginalName();
    //     $cover_letterFile->move(public_path('files/cover_letter'), $cover_letterFileName);
    // }

    // $portfolioFileName = null;
    // if ($request->hasFile('portfolio')) {
    //     $portfolioFile = $request->file('portfolio');
    //     $portfolioFileName = $portfolioFile->getClientOriginalName();
    //     $portfolioFile->move(public_path('files/portfolio'), $portfolioFileName);
    // }

    // $photoFileName = null;
    // if ($request->hasFile('photo')) {
    //     $photoFile = $request->file('photo');
    //     $photoFileName = $photoFile->getClientOriginalName();
    //     $photoFile->move(public_path('files/photo'), $photoFileName);
    // }


    // $interns = new Intern();
    // // $interns->user_id = null;
    // $interns->email = $request->email;
    // $interns->full_name = $request->full_name;
    // $interns->username = $request->username;
    // $interns->phone_number = $request->phone_number;
    // $interns->gender = $request->gender;
    // $interns->address = $request->address;
    // $interns->school = $request->school;
    // $interns->major = $request->major;
    // $interns->start_date = $request->start_date;
    // $interns->end_date = $request->end_date;
    // $interns->position_id = $request->position_id;
    // $interns->cv = $cvFileName;
    // $interns->motivation_letter = $motivation_letterFileName;
    // $interns->cover_letter = $cover_letterFileName;
    // $interns->portfolio = $portfolioFileName;
    // $interns->photo = $photoFileName;
    // $interns->status = $request->input('status', 'pending');
    // $interns->save();


    // return response()->json(['success' => true]);
}
