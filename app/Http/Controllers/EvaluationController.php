<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Intern;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\IOFactory;
use Yajra\DataTables\Facades\DataTables;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $evaluations = Evaluation::with('intern')->get();

            return DataTables::of($evaluations)
                ->addColumn('action', function ($evaluations) {
                    return view('pages.admin.evaluation.action', compact('evaluations'));
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.admin.evaluation.index');
    }

    public function getInterns(Request $request)
    {
        if ($request->ajax()) {
            $interns = Intern::where('status', 'accepted')->get();

            return response()->json($interns);
        }

        return response()->json(['error' => 'Unauthorized'], 403);
    }

    public function internEvaluation(Request $request)
    {
        $internId = auth()->user()->id;

        if ($request->ajax()) {
            $evaluations = Evaluation::with('intern')
                ->where('intern_id', $internId)
                ->get();
            return DataTables::of($evaluations)
                ->addColumn('action', function ($evaluations) {
                    return view('pages.users.evaluation.action', compact('evaluations'));
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.users.evaluation.index');
    }

    public function internEvaluationDetail($slug)
    {
        $internId = auth()->user()->id;
        $evaluation = Evaluation::with('intern')
        ->where('slug', $slug)
        ->where('intern_id', $internId)
        ->firstOrFail();

        if ($evaluation->file) {
            $fileUrl = asset('uploads/evaluation/' . $evaluation->file);
            $fileExtension = pathinfo($evaluation->file, PATHINFO_EXTENSION);
            if ($fileExtension == 'docx') {
                $htmlPath = $this->convertDocxToHtml(public_path('uploads/evaluation/' . $evaluation->file), 'file');
                $fileHtmlPath = $htmlPath;
            }
        } else {
            $fileUrl = null;
            $fileExtension = null;
        }

        return view('pages.users.evaluation.show', compact('evaluation', 'fileUrl', 'fileExtension'), with([
            'fileHtmlPath' => isset($fileHtmlPath) ? $fileHtmlPath : null,
        ]));
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
    public function store(Request $request)
    {
        $validate = $request->validate([
            'intern_id' => 'required',
            'name' => 'required',
            'file' => 'required|mimes:pdf,doc,docx'
        ]);

        $file_evaluationFileName = null;
        if ($request->hasFile('file')) {
            $file_evaluationFile = $request->file('file');
            $file_evaluationFileName = $file_evaluationFile->getClientOriginalName();
            $file_evaluationFile->move(public_path('uploads/evaluation'), $file_evaluationFileName);
        }

        $evaluation = new Evaluation();
        $evaluation->intern_id = $request->intern_id;
        $evaluation->name = $request->name;
        $evaluation->file = $file_evaluationFileName;
        $evaluation->note = $request->note;


        if ($evaluation->save()) {
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

        $fileTypeFolder = 'evaluation';
        if ($fileType === 'file') {
            $fileTypeFolder = 'evaluation';
        }

        $htmlFilePath = public_path('uploads/' . $fileTypeFolder . '/convert/' . pathinfo($docxFilePath, PATHINFO_FILENAME) . '.html');
        $htmlWriter->save($htmlFilePath);
        $htmlFilePath = asset('uploads/' . $fileTypeFolder . '/convert/' . pathinfo($docxFilePath, PATHINFO_FILENAME) . '.html');

        return $htmlFilePath;
    }
    public function show($id)
    {
        //
        $evaluations = Evaluation::find($id);
        if ($evaluations->file) {
            $fileUrl = asset('uploads/evaluation/' . $evaluations->file);
            $fileExtension = pathinfo($evaluations->file, PATHINFO_EXTENSION);
            if ($fileExtension == 'docx') {
                $htmlPath = $this->convertDocxToHtml(public_path('uploads/evaluation/' . $evaluations->file), 'file');
                $fileHtmlPath = $htmlPath;
            }
        } else {
            $fileUrl = null;
            $fileExtension = null;
        }

        return view('pages.admin.evaluation.show', compact('evaluations', 'fileUrl', 'fileExtension'), with([
            'fileHtmlPath' => isset($fileHtmlPath) ? $fileHtmlPath : null,
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $evaluation = Evaluation::findOrFail($id);
        $interns = Intern::where('status', 'accepted')->get();
        // dd($evaluations);

        if ($evaluation->file) {
            $fileUrl = asset('uploads/evaluation/' . $evaluation->file);
            $fileExtension = pathinfo($evaluation->file, PATHINFO_EXTENSION);
            if ($fileExtension == 'docx') {
                $htmlPath = $this->convertDocxToHtml(public_path('uploads/evaluation/' . $evaluation->file), 'file');
                $fileHtmlPath = $htmlPath;
            }
        } else {
            $fileUrl = null;
            $fileExtension = null;
        }

        return view('pages.admin.evaluation.edit', compact('evaluation', 'interns', 'fileUrl', 'fileExtension'), with([
            'fileHtmlPath' => isset($fileHtmlPath) ? $fileHtmlPath : null,
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $evaluation = Evaluation::findOrFail($id);

        $request->validate([
            'intern_id' => 'required',
            'name' => 'required',
        ]);

        $evaluation->intern_id = $request->intern_id;
        $evaluation->name = $request->name;
        $evaluation->note = $request->note;

        if ($request->hasFile('file')) {
            $file_evaluationFile = $request->file('file');
            $file_evaluationFileName = time() . '_' . $file_evaluationFile->getClientOriginalName();
            $file_evaluationFile->move(public_path('uploads/evaluation'), $file_evaluationFileName);

            $evaluation->file = $file_evaluationFileName;
        }

        if ($evaluation->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evaluation $evaluation)
    {
        //
        if ($evaluation->delete()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
