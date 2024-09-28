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
use App\Service\InternService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\IOFactory;
use Yajra\DataTables\Facades\DataTables;
use ZipArchive;

class InternController extends Controller
{

    protected $internService;

    public function __construct(InternService $internService)
    {
        $this->internService = $internService;
    }
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
        $today = now();

        $periodeId = Periode::whereHas('positions', function ($query) use ($positionId) {
            $query->where('position_id', $positionId);
        })
            ->where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->value('id');

        return response()->json(['periode_id' => $periodeId]);
    }

    public function create()
    {
        $periodes = Periode::all();
        $positions = Position::all();
        $activePositions = Position::whereHas('periodes', function ($query) {
            $today = now()->format('Y-m-d');
            $query->where('start_date', '<=', $today)
                ->where('end_date', '>=', $today);
        })->get();

        return view('pages.admin.intern.create', compact('activePositions', 'positions', 'periodes'));
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
            $cvFile->move(public_path('uploads/cv'), $cvFileName);
        }

        $motivation_letterFileName = null;
        if ($request->hasFile('motivation_letter')) {
            $motivation_letterFile = $request->file('motivation_letter');
            $motivation_letterFileName = $motivation_letterFile->getClientOriginalName();
            $motivation_letterFile->move(public_path('uploads/motivation_letter'), $motivation_letterFileName);
        }

        $cover_letterFileName = null;
        if ($request->hasFile('cover_letter')) {
            $cover_letterFile = $request->file('cover_letter');
            $cover_letterFileName = $cover_letterFile->getClientOriginalName();
            $cover_letterFile->move(public_path('uploads/cover_letter'), $cover_letterFileName);
        }

        $portfolioFileName = null;
        if ($request->hasFile('portfolio')) {
            $portfolioFile = $request->file('portfolio');
            $portfolioFileName = $portfolioFile->getClientOriginalName();
            $portfolioFile->move(public_path('uploads/portfolio'), $portfolioFileName);
        }

        $photoFileName = null;
        if ($request->hasFile('photo')) {
            $photoFile = $request->file('photo');
            $photoFileName = $photoFile->getClientOriginalName();
            $photoFile->move(public_path('uploads/photo'), $photoFileName);
        }

        $interns = new Intern();
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

        $htmlFilePath = public_path('uploads/' . $fileTypeFolder . '/convert/' . pathinfo($docxFilePath, PATHINFO_FILENAME) . '.html');

        $htmlWriter->save($htmlFilePath);

        // Path Html
        $htmlFilePath = asset('uploads/' . $fileTypeFolder . '/convert/' . pathinfo($docxFilePath, PATHINFO_FILENAME) . '.html');

        return $htmlFilePath;
    }

    public function show($id)
    {
        //
        $intern = Intern::find($id);
        $position_id = $intern->position_id;
        $positions = $this->internService->getAllPositions();
        $documentData = $this->internService->processInternDocuments($intern);



        return view('pages.admin.intern.show', array_merge(compact('intern', 'positions', 'position_id'), $documentData));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $today = Carbon::now();
        $intern = Intern::find($id);
        $periodes = Periode::all();
        $position_id = $intern->position_id;

        $positions = $this->internService->getAllPositions();
        $activePositions = $this->internService->getActivePositions($today);
        $documentData = $this->internService->processInternDocuments($intern);

        return view('pages.admin.intern.edit', array_merge(compact(
            'intern',
            'positions',
            'position_id',
            'activePositions',
            'periodes'
        ), $documentData));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInternRequest $request, $id)
    {

        $data = Intern::findOrFail($id);
        $status = $request->input('status');
        $newPositionId = $request->input('position_id');
        $previousStatus = $data->status;

        if (in_array($request->status, ['pending', 'interview', 'accepted', 'rejected'])) {
            $data->messages = $request->messages;
            $data->save();
        }

        // Cek perubahan status
        if ($data->status !== $status) {
            $response = $this->handleStatusChange($data, $previousStatus, $status);
            if ($response) {
                return $response;
            }
            $data->status = $status;
        }

        // Perbarui posisi jika berbeda
        if ($data->position_id != $newPositionId) {
            $this->updatePosition($data, $newPositionId);
        }

        // Update data pemagang
        $this->updateInternData($data, $request);

        if ($data->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    protected function handleStatusChange($data, $previousStatus, $status)
    {
        $periodeId = $data->periode_id;
        $periode = Periode::find($periodeId);

        if ($status === 'rejected' || $status === 'pending' || $status === 'interview') {
            if ($previousStatus === 'accepted' && $periode) {
                $pivotData = $periode->positions()->where('positions.id', $data->position_id)->first();
                if ($pivotData) {
                    $pivotData->pivot->quota++;
                    $pivotData->pivot->save();
                }
                Report::where('intern_id', $data->id)->delete();
            }

            Mail::to($data->email)->send(new InternStatus($data, $status, $data->messages));
        } elseif ($status === 'accepted') {
            $pivotData = $periode->positions()->where('positions.id', $data->position_id)->first();

            if (!$pivotData || $pivotData->pivot->quota <= 0) {
                return response()->json(['message' => 'Maaf, kuota untuk posisi ini sudah penuh.'], 400);
            }

            $pivotData->pivot->quota--;
            $pivotData->pivot->save();

            $this->createUserAndReports($data, $periode);
        }
    }

    protected function updatePosition($data, $newPositionId)
    {
        $newPosition = Position::find($newPositionId);
        if ($newPosition) {
            $newPeriode = $newPosition->periodes()->where('start_date', '<=', now())
                ->where('end_date', '>=', now())->first();

            if ($newPeriode) {
                $pivotData = $newPeriode->positions()->where('positions.id', $newPositionId)->first();

                if ($pivotData && $pivotData->pivot->quota > 0) {
                    $pivotData->pivot->quota--;
                    $pivotData->pivot->save();

                    $data->position_id = $newPositionId;
                    $data->periode_id = $newPeriode->id;
                    $data->save();

                    return response()->json(['success' => true]);
                } else {
                    return response()->json(['message' => 'Maaf, kuota untuk posisi ini sudah penuh.'], 400);
                }
            } else {
                return response()->json(['message' => 'Periode tidak tersedia untuk posisi ini.'], 400);
            }
        }

        return response()->json(['message' => 'Posisi ini tidak ditemukan.'], 404);
    }

    protected function createUserAndReports($data, $periode)
    {
        $username = $data->username;
        $password = 'intern' . $username;

        $user = User::create([
            'name' => $data->username,
            'email' => $data->email,
            'role' => 'user',
            'password' => bcrypt($password),
        ]);

        $data->user_id = $user->id;

        $this->createReports($data->start_date, $data->end_date, $data->id);

        Mail::to($data->email)->send(new InternStatus($data, 'accepted', $password, $data->messages));
    }

    protected function createReports($startDate, $endDate, $internId)
    {
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
    }

    protected function updateInternData($data, $request)
    {
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
            'messages' => $request->input('messages')
        ]);

        $this->uploadFiles($data, $request);
    }

    protected function uploadFiles($data, $request)
    {
        $files = ['cv', 'motivation_letter', 'cover_letter', 'portfolio', 'photo'];
        foreach ($files as $file) {
            if ($request->hasFile($file)) {
                $fileInstance = $request->file($file);
                $fileName = $fileInstance->getClientOriginalName();
                $fileInstance->move(public_path("uploads/{$file}"), $fileName);
                $data->update([$file => $fileName]);
            }
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
            Storage::delete('uploads/cv/' . $intern->cv);
        }
        if ($intern->motivation_letter) {
            Storage::delete('uploads/motivation_letter/' . $intern->motivation_letter);
        }
        if ($intern->cover_letter) {
            Storage::delete('uploads/cover_letter/' . $intern->cover_letter);
        }
        if ($intern->portfolio) {
            Storage::delete('uploads/portfolio/' . $intern->portfolio);
        }
        if ($intern->photo) {
            Storage::delete('uploads/photo/' . $intern->photo);
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

        $zipFileName = '['. strtolower($username) .']' . '_files.zip';
        $zip = new ZipArchive;
        $zip->open(public_path($zipFileName), ZipArchive::CREATE);

        $uploadsToZip = [
            public_path('uploads/cv/' . $intern->cv),
            public_path('uploads/motivation_letter/' . $intern->motivation_letter),
            !is_null($intern->cover_letter) ? public_path('uploads/cover_letter/' . $intern->cover_letter) : null,
            public_path('uploads/portfolio/' . $intern->portfolio),
            public_path('uploads/photo/' . $intern->photo),
        ];

        // Tambahkan file yang bukan null ke dalam zip
        foreach ($uploadsToZip as $file) {
            if ($file !== null && file_exists($file)) {
                $zip->addFile($file, basename($file));
            }
        }

        $zip->close();

        // Berikan tautan unduhan
        return response()->download(public_path($zipFileName))->deleteFileAfterSend(true);
    }
}
