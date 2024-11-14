<?php

namespace App\Http\Controllers;

use App\Models\Aspect;
use App\Models\Evaluation;
use App\Models\EvaluationDetail;
use App\Models\Evaluator;
use App\Models\FinalScore;
use App\Models\GradeRange;
use App\Models\Intern;
use App\Models\Periode;
use App\Models\Position;
use App\Models\Task;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tasks = Task::all();
        $positions = Position::all();
        $interns = Intern::all();
        $periodes = Periode::all();

        if ($request->ajax()) {
            $query = Intern::query();

            if ($request->periode_id) {
                $query->where('periode_id', $request->periode_id);
            }

            if ($request->position_id) {
                $query->whereHas('position', function($q) use ($request) {
                    $q->where('id', $request->position_id);
                });
            }

            $evaluations = $query->get();

            return DataTables::of($evaluations)
                ->addColumn('action', function ($intern) {
                    return view('pages.admin.evaluation.action', ['context' => 'intern', 'intern' => $intern]);
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.admin.evaluation.index', compact('tasks', 'positions', 'interns', 'periodes'));
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
        $request->validate([
            'intern_id' => 'required',
            'task_id' => 'required',
            'evaluations' => 'nullable|array',
            'evaluations.*.evaluator' => 'nullable|array',
            'evaluations.*.evaluator.*.evaluator_id' => 'nullable|integer',
            'evaluations.*.evaluator.*.score' => 'nullable|numeric|min:40|max:90',
        ]);

        try {
            if ($request->has('technical')) {
                $this->processAspects($request->input('technical'), $request->intern_id, $request->task_id, 'technical');
            }

            if ($request->has('non_technical')) {
                $this->processAspects($request->input('non_technical'), $request->intern_id, $request->task_id, 'non_technical');
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    private function processAspects(array $aspects, $internId, $taskId, $type)
    {
        foreach ($aspects as $aspect) {
            if (
                isset($aspect['aspect_id']) &&
                isset($aspect['total_score']) &&
                isset($aspect['total_inputted']) &&
                isset($aspect['average_score']) &&
                isset($aspect['final_score']) &&
                isset($aspect['evaluators']) && is_array($aspect['evaluators'])
            ) {
                $aspectId = $aspect['aspect_id'];

                $evaluation = Evaluation::updateOrCreate(
                    [
                        'intern_id' => $internId,
                        'task_id' => $taskId,
                        'aspect_id' => $aspectId,
                    ],
                    [
                        'total_score' => $aspect['total_score'],
                        'total_inputted' => $aspect['total_inputted'],
                        'average_score' => $aspect['average_score'],
                        'final_score' => $aspect['final_score'],
                    ]
                );

                $existingEvaluator = Evaluation::where('task_id', $taskId)
                    ->where('intern_id', $internId)
                    ->where('aspect_id', $aspect['aspect_id'])
                    ->join('evaluation_details', 'evaluations.id', '=', 'evaluation_details.evaluation_id')
                    ->select('evaluation_details.evaluator_id')
                    ->groupBy('evaluation_details.evaluator_id')
                    ->get()
                    ->toArray();

                foreach ($aspect['evaluators'] as $key => $evaluator) {
                    if (isset($evaluator['evaluator_id']) && !is_null($evaluator['score'])) {
                        if (isset($existingEvaluator[$key])) {
                            $evaluationDetail = EvaluationDetail::where('evaluation_id', $evaluation->id)
                                ->where('evaluator_id', $existingEvaluator[$key]['evaluator_id'])
                                ->first();

                            if ($evaluationDetail) {
                                if ($existingEvaluator[$key]['evaluator_id'] != $evaluator['evaluator_id']) {
                                    $evaluationDetail->update([
                                        'evaluator_id' => $evaluator['evaluator_id'],
                                    ]);
                                }
                                $evaluationDetail->update([
                                    'score' => $evaluator['score']
                                ]);
                            }
                        } else {
                            EvaluationDetail::create([
                                'evaluation_id' => $evaluation->id,
                                'evaluator_id' => $evaluator['evaluator_id'],
                                'score' => $evaluator['score'],
                            ]);
                        }
                    }
                }

                $this->updateFinalScores($internId, $aspectId);
            }
        }
    }

    private function updateFinalScores($internId, $aspectId)
    {
        $totalFinalScore = Evaluation::where('intern_id', $internId)
            ->where('aspect_id', $aspectId)
            ->sum('final_score');

        $gradeRange = GradeRange::where('min', '<=', $totalFinalScore)
            ->where('max', '>=', $totalFinalScore)
            ->first();

        $letterGrade = $gradeRange ? $gradeRange->letter_grade : null;
        $predicate = $gradeRange ? $gradeRange->predicate : null;

        FinalScore::updateOrCreate(
            [
                'intern_id' => $internId,
                'aspect_id' => $aspectId,
            ],
            [
                'final_score' => $totalFinalScore,
                'letter_grade' => $letterGrade,
                'predicate' => $predicate,
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $interns = Intern::find($id);
        $tasks = Task::all();
        return view('pages.admin.evaluation.detail-intern-task', compact('interns', 'tasks'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evaluation $evaluation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evaluation $evaluation) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evaluation $evaluation)
    {
        //
    }


    public function showTask($internId, $taskId)
    {
        $interns = Intern::with('position')->findOrFail($internId);
        $tasks = Task::findOrFail($taskId);

        $aspectsQuery = Aspect::whereHas('positionAspects', function ($query) use ($interns) {
            $query->where('position_id', $interns->position_id);
        });

        if ($tasks->has_technical_aspects && !$tasks->has_non_technical_aspects) {
            $aspectsQuery = $aspectsQuery->where('type', 'technical');
        } elseif ($tasks->has_non_technical_aspects && !$tasks->has_technical_aspects) {
            $aspectsQuery = $aspectsQuery->where('type', 'non-technical');
        }

        $aspects = $aspectsQuery->get();
        $nonTechnicalAspects = Aspect::where('type', 'non-technical')->get();
        $technicalAspects = Aspect::where('type', 'technical')->get();
        $evaluators = Evaluator::all();
        $totalEvaluators = Evaluator::count();

        $evaluation = Evaluation::where('intern_id', $internId)
            ->where('task_id', $taskId)
            ->with('evaluationDetails')
            ->get()
            ->keyBy('aspect_id');

        $technicalEvaluations = $evaluation->filter(function ($evaluation) {
            return $evaluation->aspect->type === 'technical';
        });

        $nonTechnicalEvaluations = $evaluation->filter(function ($evaluation) {
            return $evaluation->aspect->type === 'non-technical';
        });

        return view(
            'pages.admin.evaluation.task-evaluation',
            compact(
                'interns',
                'tasks',
                'aspects',
                'totalEvaluators',
                'evaluators',
                'evaluation',
                'nonTechnicalAspects',
                'technicalEvaluations',
                'nonTechnicalEvaluations'
            )
        );
    }

    public function getTaskData($taskId)
    {
        $task = Task::findOrFail($taskId);

        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        return response()->json($task);
    }

    public function finalScore(Request $request, $internId)
    {
        $finalScores = FinalScore::with('aspect')
            ->where('intern_id', $internId)
            ->get();

        if ($request->ajax()) {
            return DataTables::of($finalScores)
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        $interns = Intern::with('position')->findOrFail($internId);
        $evaluatorInterns = Evaluation::with('evaluationDetails')
            ->where('intern_id', $internId)
            ->whereHas('evaluationDetails', function ($query) {
                $query->whereNotNull('evaluator_id');
            })
            ->get()
            ->pluck('evaluationDetails.*.evaluator_id')
            ->flatten()
            ->unique();

        return view('pages.admin.evaluation.final-score', compact('interns', 'finalScores', 'evaluatorInterns'));
    }

    public function exportEvaluationTaskPDF($internId, $taskId)
    {
        $intern = Intern::find($internId);
        $task = Task::find($taskId);

        $evaluations = Evaluation::with(['evaluationDetails.evaluator', 'evaluationDetails.evaluation.aspect'])
            ->where('intern_id', $internId)
            ->where('task_id', $taskId)
            ->get();

        $evaluators = Evaluator::with('evaluationDetails.evaluation')
            ->whereHas('evaluationDetails.evaluation', function ($query) use ($internId, $taskId) {
                $query->where('intern_id', $internId)
                    ->where('task_id', $taskId);
            })->get();

        try {
            $pdf = PDF::loadView('pages.pdf.evaluation-task-pdf', compact('intern', 'task', 'evaluations', 'evaluators'))
                ->setPaper('legal', 'landscape')
                ->setOptions([
                    'isHtml5ParserEnabled' => true,
                    'isRemoteEnabled' => true,
                ]);



            return $pdf->download('Nilai' . $task->name . '.pdf');
        } catch (\Exception $e) {
            \Log::error('PDF generation failed', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            throw $e;
        }
    }

    public function exportFinalScorePDF($internId)
    {
        $intern = Intern::with(['position', 'finalScores'])
            ->find($internId);

        if (!$intern) {
            return response()->json(['error' => 'Intern tidak ditemukan.'], 404);
        }

        $finalScores = FinalScore::with('aspect')
            ->where('intern_id', $internId)
            ->get();

        try {
            $pdf = PDF::loadView('pages.pdf.final-score-pdf', compact('intern', 'finalScores'))
                ->setPaper('A4', 'potrait')
                ->setOptions([
                    'isHtml5ParserEnabled' => true,
                    'isRemoteEnabled' => true,
                ]);

            return $pdf->download('Rekap Nilai Magang - ' . $intern->full_name . '.pdf');
        } catch (\Exception $e) {
            \Log::error('PDF generation failed', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            throw $e;
        }
    }
}
