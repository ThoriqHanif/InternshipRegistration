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
use App\Service\FileService;
use App\Service\InternService;
use App\Service\MailService;
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
    protected $mailService;
    protected $fileService;

    public function __construct(InternService $internService, MailService $mailService, FileService $fileService)
    {
        $this->internService = $internService;
        $this->mailService = $mailService;
        $this->fileService = $fileService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $positions = Position::all();
        $periodes = Periode::all();

        if ($request->ajax()) {
            $showDeleted = $request->input('showDeleted', 0);
            $statusFilter = $request->input('status');
            $periodeFilter = $request->input('periode');
            $positionFilter = $request->input('position');

            $interns = Intern::with('position')->select('interns.*');

            if ($showDeleted) {
                $interns->onlyTrashed();
            }

            if ($statusFilter) {
                $interns->where('status', $statusFilter);
            }

            if ($periodeFilter) {
                $interns->where('periode_id', $periodeFilter);
            }

            if ($positionFilter) {
                $interns->where('position_id', $positionFilter);
            }

            return DataTables::of($interns)
                ->addColumn('action', function ($intern) {
                    return view('pages.admin.intern.action', compact('intern'));
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.admin.intern.index', compact('positions', 'periodes'));
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
        // Temukan data intern yang terhapus
        $intern = Intern::onlyTrashed()->find($id);

        if ($intern) {
            $intern->forceDelete();

            $this->fileService->deleteFile($intern->cv, 'cv');
            $this->fileService->deleteFile($intern->motivation_letter, 'motivation_letter');
            $this->fileService->deleteFile($intern->cover_letter, 'cover_letter');
            $this->fileService->deleteFile($intern->portfolio, 'portfolio');
            $this->fileService->deleteFile($intern->photo, 'photo');

            return response()->json(['success' => true]);
        }

        return response()->json(['message' => 'Pemagang tidak ditemukan atau tidak dalam status terhapus.'], 404);
    }


    /**
     * Show the form for creating a new resource.
     */

    public function getAvailablePositions($periodeId)
    {
        $positions = Position::whereHas('periodes', function ($query) use ($periodeId) {
            $query->where('periode_id', $periodeId)->where('quota', '>', 0);
        })->get();

        return response()->json($positions);
    }

    public function create()
    {
        $periodes = Periode::all();
        $availablePositions = Periode::with('positions')
            ->whereHas('positions', function ($query) {
                $query->where('quota', '>', 0);
            })
            ->get();

        return view('pages.admin.intern.create', compact('availablePositions', 'periodes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInternRequest $request)
    {
        $cvFileName = $this->fileService->uploadFile($request->file('cv'), 'cv');
        $motivation_letterFileName = $this->fileService->uploadFile($request->file('motivation_letter'), 'motivation_letter');
        $cover_letterFileName = $this->fileService->uploadFile($request->file('cover_letter'), 'cover_letter');
        $portfolioFileName = $this->fileService->uploadFile($request->file('portfolio'), 'portfolio');
        $photoFileName = $this->fileService->uploadFile($request->file('photo'), 'photo');

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
                $this->mailService->sendEmailRegister($interns);
            }
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
    /**
     * Display the specified resource.
     */

    public function show($id)
    {
        $intern = Intern::find($id);
        $position_id = $intern->position_id;
        $positions = $this->internService->getAllPositions();
        $documentData = $this->fileService->internDocuments($intern);

        // dd($documentData);
        return view('pages.admin.intern.show', array_merge(compact('intern', 'positions', 'position_id'), $documentData));
    }

    public function getAvailablePositionsAndCurrentPosition($periodeId, $currentPositionId = null)
    {
        $positions = Position::whereHas('periodes', function ($query) use ($periodeId) {
            $query->where('periode_id', $periodeId)->where('quota', '>', 0);
        })
            ->orWhere('id', $currentPositionId)
            ->with(['periodes' => function ($query) use ($periodeId) {
                $query->where('periode_id', $periodeId);
            }])
            ->get();

        return response()->json($positions);
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
        $documentData = $this->fileService->internDocuments($intern);

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
        $intern = Intern::findOrFail($id);
        $status = $request->input('status');
        $newPositionId = $request->input('position_id');
        $previousStatus = $intern->status;

        // Update status intern jika berbeda
        if (in_array($status, ['pending', 'interview', 'accepted', 'rejected']) && $intern->status !== $status) {
            $this->internService->handleStatusChange($intern, $previousStatus, $status);
            $intern->status = $status;
        }

        // Tangani perubahan status
        if ($intern->status !== $status) {
            $this->internService->handleStatusChange($intern, $previousStatus, $status);
            $intern->status = $status;
        }

        // Update posisi intern jika berbeda dan statusnya 'accepted'
        if ($intern->position_id != $newPositionId) {
            $this->internService->updatePosition($intern, $newPositionId);
        }

        // Update periode_id
        $intern->periode_id = $request->input('periode_id');
        $this->internService->updateInternData($intern, $request);

        if ($intern->save()) {
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
        $intern = Intern::find($id);

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

        $zipFileName = '[' . strtolower($username) . ']' . '_files.zip';
        $zip = new ZipArchive;
        $zip->open(($zipFileName), ZipArchive::CREATE);

        $uploadsToZip = [
            ('uploads/cv/' . $intern->cv),
            ('uploads/motivation_letter/' . $intern->motivation_letter),
            !is_null($intern->cover_letter) ? ('uploads/cover_letter/' . $intern->cover_letter) : null,
            ('uploads/portfolio/' . $intern->portfolio),
            ('uploads/photo/' . $intern->photo),
        ];

        // Tambahkan file yang bukan null ke dalam zip
        foreach ($uploadsToZip as $file) {
            if ($file !== null && file_exists($file)) {
                $zip->addFile($file, basename($file));
            }
        }

        $zip->close();

        // Berikan tautan unduhan
        return response()->download(($zipFileName))->deleteFileAfterSend(true);
    }
}
