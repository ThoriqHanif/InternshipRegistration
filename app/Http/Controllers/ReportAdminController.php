<?php

namespace App\Http\Controllers;

use App\Models\Intern;
use App\Models\Periode;
use App\Models\Report;
use App\Service\ReportService;
use App\Traits\LogActivityTrait;
use Carbon\Carbon;
// use Barryvdh\DomPDF\PDF;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;
use Yajra\DataTables\Facades\DataTables;

class ReportAdminController extends Controller
{

    use LogActivityTrait;
    protected $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function index(Request $request)
    {
        $periodes = Periode::with('positions')->get();

        if ($request->ajax()) {
            return DataTables::of($periodes)
                ->addColumn('action', function ($periode) {
                    return view('pages.admin.report.action', ['context' => 'index', 'periode' => $periode]);
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.admin.report.index', compact('periodes'));
    }

    public function getInternsByPeriode(Request $request, $id)
    {
        $periode = Periode::find($id);
        $interns = Intern::with('position', 'periode')
            ->where('periode_id', $id)
            ->where('status', 'accepted')
            ->get();

        if ($request->ajax()) {
            return DataTables::of($interns)
                ->addColumn('action', function ($intern) {
                    return view('pages.admin.report.action', ['context' => 'intern_periode', 'intern' => $intern]);
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.admin.report.intern-periode', compact('interns', 'periode'));
    }


    public function getReportByIntern(Request $request, $id)
    {
        $daily_report = Report::where('intern_id', $id)->get();
        $intern = Intern::find($id);

        if ($request->ajax()) {
            return DataTables::of($daily_report)
                ->addColumn('action', function ($daily_report) {
                    return view('pages.admin.report.action', ['context' => 'daily_report', 'report' => $daily_report]);
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.admin.report.report-intern', compact('daily_report', 'intern'));
    }

    public function detailReport($reportId)
    {
        $report = Report::find($reportId);
        $totalLate = $this->reportService->countTotalLate();
        $latenessDuration = $this->reportService->countDiffLate($reportId);
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

    public function getLatenessDetails($id)
    {
        $report = Report::find($id);
        if ($report) {

            $totalLate = $this->reportService->countTotalLate();
            $latenessDuration = $this->reportService->countDiffLate($id);
            $latenessDates = $this->reportService->getDateLate();
            $latenessDurationText = $latenessDuration !== null ? $latenessDuration['formatted'] : "0 menit";
            $formattedLatenessDates = implode(', ', array_map(function ($date) {
                return Carbon::parse($date)->format('d/m/Y');
            }, $latenessDates));

            return response()->json([
                'lateness_duration' => $latenessDurationText,
                'total_lateness' => $totalLate,
                'lateness_dates' => $formattedLatenessDates,
                'consequence_description' => $report->consequence_description,
                'is_consequence_done' => $report->is_consequence_done,
                'result' => $report
            ]);
        } else {
            return response()->json(['error' => 'Report not found'], 404);
        }
    }

    public function verifyReport($reportId)
    {
        $verify = $this->reportService->verifReport($reportId);

        return $verify;
    }

    public function rejectReport(Request $request, $reportId)
    {
        $reject = $this->reportService->rejectReport($request, $reportId);
        return $reject;
    }

    // Export PDF
    public function exportPDFIntern($periodeId)
    {
        $interns = Intern::where('periode_id', $periodeId)->with('reports')->get();
        $periode = Periode::find($periodeId);

        $pdf = app('dompdf.wrapper')->loadView('pages.pdf.periode-intern-pdf', compact('interns', 'periode'))
            ->setPaper('legal', 'landscape')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true
            ]);

        return $pdf->download('internByPeriode' . $periodeId . '.pdf');

    }

    public function exportPDFReport($internId) {
        $intern = Intern::with('reports')->find($internId);

        $pdf = app('dompdf.wrapper')->loadView('pages.pdf.intern-report-pdf', compact('intern'))
            ->setPaper('legal', 'landscape')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true
            ]);

        return $pdf->download('internReport' . $internId . '.pdf');

    }


    // OLD
    public function getStatus()
    {
        $reports = Report::where('status', 'vermin')->get();

        return response()->json($reports);
    }

    public function verifAll($id)
    {
        $intern = Intern::find($id);
        if ($intern) {
            $intern->reports()->update(['status' => 'vermin']);
            return response()->json(['message' => 'Berhasil memverifikasi semua laporan']);
        } else {
            return response()->json(['message' => 'Gagal memverifikasi laporan'], 404);
        }
    }

    public function getInternDetail($id)
    {
        $intern = Intern::with('position')->find($id);
        return response()->json($intern);
    }

}
