<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
use App\Models\Document;
use App\Models\Intern;
use App\Service\FileService;
use App\Service\MailService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DocumentController extends Controller
{
    protected $fileService;
    protected $mailService;

    public function __construct(FileService $fileService, MailService $mailService)
    {
        $this->fileService = $fileService;
        $this->mailService = $mailService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $interns = Intern::orderBy('start_date', 'asc')->get();
        $documents = Document::with('intern')->get();

        if ($request->ajax()) {
            $query = Document::with('intern');

            if ($request->intern_id) {
                $query->where('intern_id', $request->intern_id);
            }

            if ($request->type) {
                $query->where('type', $request->type);
            }

            return DataTables::of($query->get())
                ->addColumn('action', function ($documents) {
                    return view('pages.admin.document.action', compact('documents'));
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }


        return view('pages.admin.document.index', compact('interns', 'documents'));
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
    public function store(StoreDocumentRequest $request)
    {
        $file_file_documentFileName = $this->fileService->uploadFile($request->file('file'), 'file');

        $document = new Document();
        $document->intern_id = $request->intern_id;
        $document->name = $request->name;
        $document->type = $request->type;
        $document->file = $file_file_documentFileName;
        $document->note = $request->note;

        if ($document->save()) {
            $intern = Intern::findOrFail($request->intern_id);
            $this->mailService->sendEmailDocument($intern, $document);

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        list($fileUrl, $fileHtmlPath, $fileExtension) = $this->fileService->getFileData($document->file, 'file');

        return view('pages.admin.document.show', compact('document', 'fileUrl', 'fileExtension'), with([
            'fileHtmlPath' => $fileHtmlPath,
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $document)
    {
        $interns = Intern::where('status', 'accepted')->get();

        list($fileUrl, $fileHtmlPath, $fileExtension) = $this->fileService->getFileData($document->file, 'file');

        return view('pages.admin.document.edit', compact('document', 'interns', 'fileUrl', 'fileExtension'), with([
            'fileHtmlPath' => $fileHtmlPath,
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDocumentRequest $request, Document $document)
    {
        $document->intern_id = $request->intern_id;
        $document->name = $request->name;
        $document->note = $request->note;

        if ($request->hasFile('file')) {
            $this->fileService->deleteFile($document->file, 'file');

            $file_documentFileName = $this->fileService->uploadFile($request->file('file'), 'file');
            $document->file = $file_documentFileName;
        }

        if ($document->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
    {
        if ($document->delete()) {
            $this->fileService->deleteFile($document->file, 'file');

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function getInterns(Request $request)
    {
        if ($request->ajax()) {
            $interns = Intern::where('status', 'accepted')->get();

            return response()->json($interns);
        }

        return response()->json(['error' => 'Unauthorized'], 403);
    }

    public function internDocument(Request $request)
    {
        $internId = auth()->user()->intern->id;

        if ($request->ajax()) {
            $documents = Document::with('intern')
                ->where('intern_id', $internId)
                ->get();
            return DataTables::of($documents)
                ->addColumn('action', function ($documents) {
                    return view('pages.users.document.action', compact('documents'));
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.users.document.index');
    }

    public function internDocumentDetail($slug)
    {
        $internId = auth()->user()->intern->id;
        $document = Document::with('intern')
            ->where('slug', $slug)
            ->where('intern_id', $internId)
            ->firstOrFail();

        list($fileUrl, $fileHtmlPath, $fileExtension) = $this->fileService->getFileData($document->file, 'file');

        return view('pages.users.document.show', compact('document', 'fileUrl', 'fileExtension'), with([
            'fileHtmlPath' => $fileHtmlPath,
        ]));
    }
}
