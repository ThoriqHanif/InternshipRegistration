<?php

namespace App\Http\Controllers;

use App\Models\Intern;
use App\Http\Requests\StoreInternRequest;
use App\Http\Requests\UpdateInternRequest;
use App\Mail\InternStatus;
use App\Models\Periode;
use App\Models\Position;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\IOFactory;
use Yajra\DataTables\Facades\DataTables;
use ZipArchive;

class InternController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $showDeleted = $request->input('showDeleted', 0);
            $statusFilter = $request->input('status');

            $interns = Intern::with('position')->select('interns.*');

            if ($showDeleted) {
                $interns->onlyTrashed();
            }

            if ($statusFilter) {
                $interns->where('status', $statusFilter);
            }

            return DataTables::of($interns)
                ->addColumn('action', function ($intern) {
                    return view('pages.admin.intern.action', compact('intern'));
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.admin.intern.index');
    }

    public function restore($id)
    {
        $intern = Intern::onlyTrashed()->find($id);

        if ($intern) {
            $intern->restore();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function forceDelete($id)
    {
        $intern = Intern::onlyTrashed()->find($id);

        if ($intern) {
            try {
                $intern->forceDelete();
                return response()->json(['success' => true]);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Gagal menghapus pemagang secara permanen.'], 400);
            }
        } else {
            return response()->json(['message' => 'Pemagang tidak ditemukan atau tidak dalam status terhapus.']);
        }
    }

    /**
     * Show the form for creating a new resource.
     */

    public function getPeriodeId($positionId)
    {
        $periodeId = Periode::where('position_id', $positionId)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->value('id');

        return response()->json(['periode_id' => $periodeId]);
    }

    public function create()
    {
        //
        $activePositions = Position::whereHas('periode', function ($query) {
            $today = now()->format('Y-m-d');
            $query->where('start_date', '<=', $today)
                ->where('end_date', '>=', $today);
        })->get();

        return view('pages.admin.intern.create', compact('activePositions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInternRequest $request)
    {
        //
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
                // Kirim email status e 'pending'
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

    public function convertDocxToHtml($docxFilePath, $fileType)

    {
        $phpWord = IOFactory::load($docxFilePath);
        $htmlWriter = new \PhpOffice\PhpWord\Writer\HTML($phpWord);

        $fileTypeFolder = '';
        if ($fileType === 'motivation_letter') {
            $fileTypeFolder = 'motivation_letter/';
        } elseif ($fileType === 'cv') {
            $fileTypeFolder = 'cv/';
        } elseif ($fileType === 'cover_letter') {
            $fileTypeFolder = 'cover_letter/';
        } elseif ($fileType === 'portfolio') {
            $fileTypeFolder = 'portfolio/';
        }

        $htmlFilePath = public_path('files/' . $fileTypeFolder . '/convert/' . pathinfo($docxFilePath, PATHINFO_FILENAME) . '.html');

        $htmlWriter->save($htmlFilePath);

        // Path Html
        $htmlFilePath = asset('files/' . $fileTypeFolder . '/convert/' . pathinfo($docxFilePath, PATHINFO_FILENAME) . '.html');

        return $htmlFilePath;

        // $phpWord = IOFactory::load($docxFilePath);
        // $htmlWriter = new \PhpOffice\PhpWord\Writer\HTML($phpWord);

        // // Definisikan path di mana hasil HTML akan disimpan
        // $htmlFilePath = public_path('files/motivation_letter/' . pathinfo($docxFilePath, PATHINFO_FILENAME) . '.html');

        // $htmlWriter->save($htmlFilePath);

        // // Setel path file HTML yang dihasilkan
        // $motivationLetterHtmlPath = asset('files/motivation_letter/' . pathinfo($docxFilePath, PATHINFO_FILENAME) . '.html');

        // // Kembalikan path file HTML
        // return $motivationLetterHtmlPath;
    }

    public function show($id)
    {
        //
        $intern = Intern::find($id);
        $genders = ['L' => 'Laki - Laki', 'P' => 'Perempuan'];
        $position_id = $intern->position_id;
        $positions = Position::all();
        $st = ['diterima' => 'Diterima', 'ditolak' => 'Ditolak', 'pending' => 'Pending'];

        // Mengambil alamat URL untuk file CV dari penyimpanan "public"
        if ($intern->cv) {
            $cvUrl = asset('files/cv/' . $intern->cv);
            $cvExtension = pathinfo($intern->cv, PATHINFO_EXTENSION);
            if ($cvExtension == 'docx') {
                // Konversi docx ke html
                $htmlPath = $this->convertDocxToHtml(public_path('files/cv/' . $intern->cv), 'cv');
                $cvHtmlPath = $htmlPath;
            }
        } else {
            $cvUrl = null;
            $cvExtension = null;
        }

        if ($intern->motivation_letter) {
            $motivationLetterUrl = asset('files/motivation_letter/' . $intern->motivation_letter);
            $motivation_letterExtension = pathinfo($intern->motivation_letter, PATHINFO_EXTENSION);

            if ($motivation_letterExtension == 'docx') {
                $htmlPath = $this->convertDocxToHtml(public_path('files/motivation_letter/' . $intern->motivation_letter), 'motivation_letter');
                $motivationLetterHtmlPath = $htmlPath;
            }
        } else {
            $motivationLetterUrl = null;
            $motivation_letterExtension = null;
        }

        if ($intern->cover_letter) {
            $coverLetterUrl = asset('files/cover_letter/' . $intern->cover_letter);
            $cover_letterExtension = pathinfo($intern->cover_letter, PATHINFO_EXTENSION);
            if ($cover_letterExtension == 'docx') {
                $htmlPath = $this->convertDocxToHtml(public_path('files/cover_letter/' . $intern->cover_letter), 'cover_letter');
                $coverLetterHtmlPath = $htmlPath;
            }
        } else {
            $coverLetterUrl = null;
            $cover_letterExtension = null;
        }

        if ($intern->portfolio) {
            $portfolioUrl = asset('files/portfolio/' . $intern->portfolio);
            $portfolioExtension = pathinfo($intern->portfolio, PATHINFO_EXTENSION);
            if ($portfolioExtension == 'docx') {
                $htmlPath = $this->convertDocxToHtml(public_path('files/portfolio/' . $intern->portfolio), 'portfolio');
                $portfolioHtmlPath = $htmlPath;
            }
        } else {
            $portfoliorUrl = null;
            $portfolioExtension = null;
        }

        if ($intern->photo) {
            $photoUrl = asset('files/photo/' . $intern->photo);
            $photoExtension = pathinfo($intern->photo, PATHINFO_EXTENSION);
        } else {
            $photorUrl = null;
            $photoExtension = null;
        }

        return view('pages.admin.intern.show', [
            'id' => $intern->id,
            'email' => $intern->email,
            'full_name' => $intern->full_name,
            'username' => $intern->username,
            'phone_number' => $intern->phone_number,
            'gender' => $intern->gender,
            'address' => $intern->address,
            'school' => $intern->school,
            'major' => $intern->major,
            'start_date' => $intern->start_date,
            'end_date' => $intern->end_date,
            'genders' => $genders, // Kirim data jenis kelamin ke tampilan
            'positions' => $positions,
            'position_id' => $position_id,
            'cvExtension' => $cvExtension,
            'motivation_letterExtension' => $motivation_letterExtension,
            'cvUrl' => $cvUrl, // Menambahkan URL CV ke tampilan
            'cover_letterExtension' => $cover_letterExtension,
            'portfolioExtension' => $portfolioExtension,
            'photoExtension' => $photoExtension,
            'motivationLetterUrl' => $motivationLetterUrl,
            'coverLetterUrl' => $coverLetterUrl,
            'portfolioUrl' => $portfolioUrl,
            'photoUrl' => $photoUrl,
            'cvHtmlPath' => isset($cvHtmlPath) ? $cvHtmlPath : null,
            'motivationLetterHtmlPath' => isset($motivationLetterHtmlPath) ? $motivationLetterHtmlPath : null,
            'coverLetterHtmlPath' => isset($coverLetterHtmlPath) ? $coverLetterHtmlPath : null,
            'portfolioHtmlPath' => isset($portfolioHtmlPath) ? $portfolioHtmlPath : null,
            'status' => $intern->status,
            'st' => $st
        ]);
        return view('pages.admin.intern.show', compact('intern', 'positions', 'status'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $intern = Intern::find($id);
        $genders = ['L' => 'Laki - Laki', 'P' => 'Perempuan'];
        $position_id = $intern->position_id;
        $positions = Position::all();
        $st = ['diterima' => 'Diterima', 'interview' => 'Interview', 'ditolak' => 'Ditolak', 'pending' => 'Pending'];

        $activePositions = Position::whereHas('periode', function ($query) {
            $today = now()->format('Y-m-d');
            $query->where('start_date', '<=', $today)
                ->where('end_date', '>=', $today);
        })->get();

        if ($intern->cv) {
            $cvUrl = asset('files/cv/' . $intern->cv);
            $cvExtension = pathinfo($intern->cv, PATHINFO_EXTENSION);
            if ($cvExtension == 'docx') {
                // convert docx -> html
                $htmlPath = $this->convertDocxToHtml(public_path('files/cv/' . $intern->cv), 'cv');
                $cvHtmlPath = $htmlPath;
            }
        } else {
            $cvUrl = null;
            $cvExtension = null;
        }

        if ($intern->motivation_letter) {
            $motivationLetterUrl = asset('files/motivation_letter/' . $intern->motivation_letter);
            $motivation_letterExtension = pathinfo($intern->motivation_letter, PATHINFO_EXTENSION);

            if ($motivation_letterExtension == 'docx') {
                $htmlPath = $this->convertDocxToHtml(public_path('files/motivation_letter/' . $intern->motivation_letter), 'motivation_letter');
                $motivationLetterHtmlPath = $htmlPath;
            }
        } else {
            $motivationLetterUrl = null;
            $motivation_letterExtension = null;
        }

        if ($intern->cover_letter) {
            $coverLetterUrl = asset('files/cover_letter/' . $intern->cover_letter);
            $cover_letterExtension = pathinfo($intern->cover_letter, PATHINFO_EXTENSION);
            if ($cover_letterExtension == 'docx') {
                $htmlPath = $this->convertDocxToHtml(public_path('files/cover_letter/' . $intern->cover_letter), 'cover_letter');
                $coverLetterHtmlPath = $htmlPath;
            }
        } else {
            $coverLetterUrl = null;
            $cover_letterExtension = null;
        }

        if ($intern->portfolio) {
            $portfolioUrl = asset('files/portfolio/' . $intern->portfolio);
            $portfolioExtension = pathinfo($intern->portfolio, PATHINFO_EXTENSION);
            if ($portfolioExtension == 'docx') {
                $htmlPath = $this->convertDocxToHtml(public_path('files/portfolio/' . $intern->portfolio), 'portfolio');
                $portfolioHtmlPath = $htmlPath;
            }
        } else {
            $portfoliorUrl = null;
            $portfolioExtension = null;
        }

        if ($intern->photo) {
            $photoUrl = asset('files/photo/' . $intern->photo);
            $photoExtension = pathinfo($intern->photo, PATHINFO_EXTENSION);
        } else {
            $photorUrl = null;
            $photoExtension = null;
        }


        return view('pages.admin.intern.edit', [
            'intern' => $intern,
            'id' => $intern->id,
            'email' => $intern->email,
            'full_name' => $intern->full_name,
            'username' => $intern->username,
            'phone_number' => $intern->phone_number,
            'gender' => $intern->gender,
            'address' => $intern->address,
            'school' => $intern->school,
            'major' => $intern->major,
            'start_date' => $intern->start_date,
            'end_date' => $intern->end_date,
            'genders' => $genders,
            'positions' => $positions,
            'position_id' => $position_id,
            'activePositions' => $activePositions,
            'cvUrl' => $cvUrl, // Menambahkan URL file ke tampilan
            'motivationLetterUrl' => $motivationLetterUrl,
            'coverLetterUrl' => $coverLetterUrl,
            'portfolioUrl' => $portfolioUrl,
            'photoUrl' => $photoUrl,
            'cvExtension' => $cvExtension,
            'motivation_letterExtension' => $motivation_letterExtension,
            'cover_letterExtension' => $cover_letterExtension,
            'portfolioExtension' => $portfolioExtension,
            'photoExtension' => $photoExtension,
            'cvHtmlPath' => isset($cvHtmlPath) ? $cvHtmlPath : null,
            'motivationLetterHtmlPath' => isset($motivationLetterHtmlPath) ? $motivationLetterHtmlPath : null,
            'coverLetterHtmlPath' => isset($coverLetterHtmlPath) ? $coverLetterHtmlPath : null,
            'portfolioHtmlPath' => isset($portfolioHtmlPath) ? $portfolioHtmlPath : null,
            'status' => $intern->status,
            'st' => $st,
            'statusChanged' => $intern->status_changed,
            'messages' => $intern->messages

        ]);
        return view('pages.admin.intern.edit', compact('intern', 'position', 'activePositions'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(UpdateInternRequest $request, $id)
    {
        $data = Intern::find($id);
        $status = $request->input('status');
        $newPositionId = $request->input('position_id');   
         
        $previousStatus = $data->status;

        if ($request->status === 'diterima' || $request->status === 'pending' || $request->status === 'interview' || $request->status === 'ditolak') {
            $data->messages = $request->messages; // Ambil pesan dari request
            $data->save();
        }

        if ($data->status !== $status) {
            // Pindahkan logika pengiriman email ke luar dari kondisi 'diterima'
            if ($status === 'ditolak') {
                if ($previousStatus === 'diterima') {
                    $positionId = $data->position_id;
                    $currentDate = $data->created_at;

                    $periode = Intern::where('periode_id', $positionId)
                        ->where('start_date', '<=', $currentDate)
                        ->where('end_date', '>=', $currentDate)
                        ->first();

                    if ($periode) {
                        $periode->quota++;
                        $periode->save();
                    }

                    Report::where('intern_id', $data->id)->delete();
                }
                // Jika status sekarang adalah 'ditolak', kirim email notifikasi ditolak
                Mail::to($data->email)->send(new InternStatus($data, 'ditolak', $data->messages));
            } elseif ($status === 'pending') {
                if ($previousStatus === 'diterima') {
                    $positionId = $data->position_id;
                    $currentDate = $data->created_at;

                    $periode = Periode::where('position_id', $positionId)
                        ->where('start_date', '<=', $currentDate)
                        ->where('end_date', '>=', $currentDate)
                        ->first();

                    if ($periode) {
                        $periode->quota++;
                        $periode->save();
                    }

                    Report::where('intern_id', $data->id)->delete();
                }
                // Jika status sekarang adalah 'pending', kirim email notifikasi pending
                Mail::to($data->email)->send(new InternStatus($data, 'pending', $data->messages));
            } elseif ($status === 'interview') {
                if ($previousStatus === 'diterima') {
                    $positionId = $data->position_id;
                    $currentDate = $data->created_at;

                    $periode = Periode::where('position_id', $positionId)
                        ->where('start_date', '<=', $currentDate)
                        ->where('end_date', '>=', $currentDate)
                        ->first();

                    if ($periode) {
                        $periode->quota++;
                        $periode->save();
                    }

                    Report::where('intern_id', $data->id)->delete();
                }
                // Jika status sekarang adalah 'interview', kirim email notifikasi interview
                Mail::to($data->email)->send(new InternStatus($data, 'interview', $data->messages));

                // UPDATE JADI DITERIMA
            } elseif ($status === 'diterima') {

                $position = Position::find($data->position_id);
                $periode = Periode::where('position_id', $data->position_id)
                    ->where('start_date', '<=', $data->created_at)
                    ->where('end_date', '>=', $data->created_at)
                    ->where('quota', '>', 0)
                    ->first();

                if (!$periode) {
                    // Jika tidak ada periode yang tersedia
                    return response()->json(['message' => 'Maaf, periode tidak tersedia untuk posisi ini.'], 400);
                }

                if ($periode->quota <= 0) {
                    // Jika kuota sudah habis
                    return response()->json(['message' => 'Maaf, kuota untuk posisi ini sudah penuh.'], 400);
                }

                if ($position && $periode) {
                    // Perbarui kuota pada periode yang sesuai
                    $periode->quota--;
                    $periode->save();
                }

                // CREATE USER
                $username = $data->username;
                $password = 'intern' . $username;


                $user = User::create([
                    'name' => $data->username,
                    'email' => $data->email,
                    'role' => 'user',
                    'password' => $password,
                ]);

                // RELASI USER
                $data->user_id = $user->id;

                // CREATE REPORT 
                $startDate = $data->start_date;
                $endDate = $data->end_date;
                $internId = $data->id;

                $currentDate = $startDate;
                while ($currentDate <= $endDate) {
                    Report::create([
                        'intern_id' => $internId,
                        'date' => $currentDate,
                        'presence' => null,
                        'attendance_hours' => null,
                        'agency' => null,
                        'project_name' => null,
                        'job' => null,
                        'description' => null,
                    ]);

                    $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
                }

                Mail::to($data->email)->send(new InternStatus($data, 'diterima', $password, $data->messages));
            }

            // DITOLAK -> USRER ID NULL
            $relatedInterns = Intern::where('user_id', $data->user_id)->get();
            foreach ($relatedInterns as $relatedIntern) {
                $relatedIntern->user_id = null;
                $relatedIntern->save();
            }

            // HAPUS USER <- STATUS DITERIMA
            if ($data->status === 'diterima' && $data->user) {
                $data->user->delete();
            }

            $data->status = $status;
        }

        if ($data->position_id != $newPositionId) {
            $newPosition = Position::find($newPositionId);
            $newPeriode = null;
        
            if ($newPosition) {
                // Temukan periode baru yang terkait dengan posisi baru
                $newPeriode = Periode::where('position_id', $newPositionId)->first();
        
                if ($newPeriode) {
                    $availableQuota = $newPeriode->quota;
        
                    // Cek apakah posisi baru memiliki kuota tersedia
                    if ($availableQuota > 0) {
                        $data->position_id = $newPositionId;
                        $data->periode_id = $newPeriode->id;
        
                        // Kurangi kuota yang tersedia karena pemagang pindah posisi
                        $newPeriode->quota -= 1;
                        $newPeriode->save();
        
                        // Simpan perubahan pada data pemagang untuk posisi_id dan periode_id
                        if ($data->save(['position_id', 'periode_id'])) {
                            return response()->json(['success' => true]);
                        }
                    } else {
                        return response()->json(['message' => 'Maaf, kuota untuk posisi ini sudah penuh.'], 400);
                    }
                }
            }
        }
        

        // edit input    
        $data->update([
            'full_name' => $request->input('full_name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number'),
            'address' => $request->input('address'),
            'gender' => $request->input('gender'),
            'school' => $request->input('school'),
            'major' => $request->input('major'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'position_id' => $request->input('position_id'),
            'messages' => $request->input('messages')
        ]);

        if ($request->hasFile('cv')) {

            $cvFile = $request->file('cv');
            $cvFileName = $cvFile->getClientOriginalName();
            $cvFile->move(public_path('files/cv'), $cvFileName);
            $data->update(['cv' => $cvFileName]);
        }

        if ($request->hasFile('motivation_letter')) {

            $motivation_letterFile = $request->file('motivation_letter');
            $motivation_letterFileName = $motivation_letterFile->getClientOriginalName();
            $motivation_letterFile->move(public_path('files/motivation_letter'), $motivation_letterFileName);
            $data->update(['motivation_letter' => $motivation_letterFileName]);
        }

        if ($request->hasFile('cover_letter')) {

            $cover_letterFile = $request->file('cover_letter');
            $cover_letterFileName = $cover_letterFile->getClientOriginalName();
            $cover_letterFile->move(public_path('files/cover_letter'), $cover_letterFileName);
            $data->update(['cover_letter' => $cover_letterFileName]);
        }

        if ($request->hasFile('portfolio')) {

            $portfolioFile = $request->file('portfolio');
            $portfolioFileName = $portfolioFile->getClientOriginalName();
            $portfolioFile->move(public_path('files/portfolio'), $portfolioFileName);
            $data->update(['portfolio' => $portfolioFileName]);
        }

        if ($request->hasFile('photo')) {

            $photoFile = $request->file('photo');
            $photoFileName = $photoFile->getClientOriginalName();
            $photoFile->move(public_path('files/photo'), $photoFileName);
            $data->update(['photo' => $photoFileName]);
        }

        // Simpan perubahan
        if ($data->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $intern = Intern::find($id);

        // Hapus file CV, motivation letter, cover letter, portfolio, dan photo jika ada
        if ($intern->cv) {
            Storage::delete('files/cv/' . $intern->cv);
        }
        if ($intern->motivation_letter) {
            Storage::delete('files/motivation_letter/' . $intern->motivation_letter);
        }
        if ($intern->cover_letter) {
            Storage::delete('files/cover_letter/' . $intern->cover_letter);
        }
        if ($intern->portfolio) {
            Storage::delete('files/portfolio/' . $intern->portfolio);
        }
        if ($intern->photo) {
            Storage::delete('files/photo/' . $intern->photo);
        }

        // Hapus data Interns dari database
        if ($intern->delete()) {
            return response()->json(['success' => true, 'message' => 'Posisi berhasil dihapus.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Posisi menghapus User.']);
        }
    }

    public function download($id)
    {
        $intern = Intern::find($id);
        $username = $intern->username;

        if (!$intern) {
            return redirect('intern.index')->with('error', 'Pemagang tidak ditemukan');
        }

        $zipFileName = 'intern_' . $username . '_files.zip'; // Nama file zip yang akan diunduh
        $zip = new ZipArchive;
        $zip->open(public_path($zipFileName), ZipArchive::CREATE);

        $filesToZip = [
            public_path('files/cv/' . $intern->cv),
            public_path('files/motivation_letter/' . $intern->motivation_letter),
            // Pastikan Anda memeriksa apakah cover_letter adalah null sebelum menambahkannya ke dalam zip
            !is_null($intern->cover_letter) ? public_path('files/cover_letter/' . $intern->cover_letter) : null,
            public_path('files/portfolio/' . $intern->portfolio),
            public_path('files/photo/' . $intern->photo),
        ];

        // Tambahkan file yang bukan null ke dalam zip
        foreach ($filesToZip as $file) {
            if ($file !== null && file_exists($file)) {
                $zip->addFile($file, basename($file));
            }
        }

        $zip->close();

        // Berikan tautan unduhan
        return response()->download(public_path($zipFileName))->deleteFileAfterSend(true);
    }
}
