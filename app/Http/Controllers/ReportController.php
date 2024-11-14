<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Models\Intern;
use App\Service\ReportService;
use App\Traits\LogActivityTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    protected $reportService;
    use LogActivityTrait;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $userId = Auth::id();
        $interns = Intern::where('user_id', $userId)->first();

        if ($interns) {
            $internId = $interns->id;

            if ($request->ajax()) {
                $reports = Report::where('intern_id', $internId)->select('*')->get();
                return DataTables::of($reports)
                    ->addColumn('action', function ($report) use ($internId) {
                        return view('pages.users.report.action', compact('report', 'internId'));
                    })
                    ->addIndexColumn()
                    ->rawColumns(['action'])
                    ->make(true);
            }

            $reports = Report::where('intern_id', $internId)->get();
            return view('pages.users.report.index', compact('internId', 'reports', 'interns')); // Kirimkan data ke view
        }
    }

    public function reportByInternPDF($internId)
    {

        $intern = Intern::with('reports')->find($internId);

        $pdf = app('dompdf.wrapper')->loadView('pages.pdf.report-pdf', compact('intern'));

        $pdf->setPaper('legal', 'landscape');

        $pdf->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

        return $pdf->download('reportByIntern' . $internId . '.pdf');
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
    public function store(StoreReportRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report, $id)
    {
        $report = Report::find($id);
        $totalLate = $this->reportService->countTotalLate();
        $latenessDuration = $this->reportService->countDiffLate($id);
        $latenessDates = $this->reportService->getDateLate();
        $latenessDurationText = $latenessDuration !== null ? $latenessDuration['formatted'] : "0 menit";
        $formattedLatenessDates = implode(', ', array_map(function ($date) {
            return Carbon::parse($date)->format('d/m/Y');
        }, $latenessDates));

        return response()->json([
            'result' => $report,
            'lateness_duration' => $latenessDurationText,
            'total_lateness' => $totalLate,
            'lateness_dates' => $formattedLatenessDates,
            'consequence_description' => $report->consequence_description,
            'is_consequence_done' => $report->is_consequence_done,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $report = Report::find($id);
        $totalLate = $this->reportService->countTotalLate();
        $latenessDuration = $this->reportService->countDiffLate($id);
        $latenessDates = $this->reportService->getDateLate();

        $latenessDurationText = $latenessDuration !== null ? $latenessDuration['formatted'] : "0 menit";
        $formattedLatenessDates = implode(', ', array_map(function ($date) {
            return Carbon::parse($date)->format('d/m/Y');
        }, $latenessDates));


        return response()->json([
            'result' => $report,
            'lateness_duration' => $latenessDurationText,
            'total_late' => $totalLate,
            'lateness_dates' => $formattedLatenessDates
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReportRequest $request, $id)
    {
        $report = Report::findOrFail($id);
        $before = $report->toArray();

        $report->update([
            'presence' => $request->input('presence'),
            'attendance_time' => $request->input('attendance_time'),
            'agency' => $request->input('agency'),
            'project_name' => $request->input('project_name'),
            'job' => $request->input('job'),
            'description' => $request->input('description'),
        ]);

        $isLate = $this->reportService->CheckIsLate($request->merge(['report_id' => $id]));
        $report->is_late = $isLate;

        if ($report->save()) {
            $after = $report->toArray();
            $latenessDuration = $this->reportService->countDiffLate($id);

            $this->logActivity($report, 'Memperbarui Laporan', [
                'before' => $before,
                'after' => $after,
            ]);

            return response()->json([
                'success' => true,
                'lateness_duration' => $latenessDuration['formatted'] ?? '0 menit',
            ]);
        } else {
            return response()->json(['success' => false]);
        }
    }


    public function updateIsLate(Request $request, $id)
    {
        $report = Report::find($id);
        $before = $report->toArray();


        $report->update([
            'is_consequence_done' => $request->input('is_consequence_done'),
            'consequence_description' => $request->input('consequence_description'),
        ]);

        if ($report->save()) {
            $after = $report->toArray();

            $this->logActivity($report, 'Memperbarui Status Konsekuensi Laporan', [
                'before' => $before,
                'after' => $after,
            ]);
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        //
    }

    public function checkLate(Request $request)
    {
        $isLate = $this->reportService->CheckIsLate($request);

        return response()->json(['isLate' => $isLate]);
    }
}
