<?php

namespace App\Http\Controllers;

use App\Models\Intern;
use App\Models\Periode;
use App\Models\Report;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ReportAdminController extends Controller
{
    //
    public function index(Request $request)
    {
        $intern = Intern::select('*')->get();

        if ($request->ajax()) {

            $periodes = Periode::select('*');

            return DataTables::of($periodes)
                ->addColumn('action', function ($periode) {
                    return view('pages.admin.report.action', compact('periode'));
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.admin.report.index', compact('intern'));
    }

    public function getInternsByPeriode(Request $request, $id)
    {


        if ($request->ajax()) {
            $internPeriode = Intern::with('position', 'periode')
                ->where('periode_id', $id)
                ->where('status', 'diterima')
                ->get();
            return response()->json($internPeriode);

            return DataTables::of($internPeriode)
                ->addColumn('action', function ($intern) {
                    // return view('pages.admin.report.action', compact('intern'));                
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.admin.report.index', compact('internPeriode'));
    }

    public function getReportByIntern(Request $request, $id)
    {
        if ($request->ajax()) {
            $reportIntern = Report::where('intern_id', $id)->get();
            return response()->json($reportIntern);

            return DataTables::of($reportIntern)
                ->addColumn('action', function ($report) {
                    // return view('pages.admin.report.action', compact('intern'));                
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.admin.report.index', compact('reportIntern'));
    }

    public function verifyReport(Request $request, $id)
    {
        $report = Report::find($id);
        if (!$report) {
            return response()->json(['error' => 'Report not found'], 404);
        }

        // Lakukan pembaruan status ke 'vermin'
        $report->status = 'vermin';
        $report->save();

        return response()->json(['message' => 'Report verified successfully'], 200);
    }

    public function getStatus()
    {
        $reports = Report::where('status', 'vermin')->get();

        return response()->json($reports);
    }

    public function verifAll($id)
    {
        $intern = Intern::find($id);
        if($intern) {
            $intern->reports()->update(['status' => 'vermin']);
            return response()->json(['message' => 'Berhasil memverifikasi semua laporan']);
        } else {
            return response()->json(['message' => 'Gagal memverifikasi laporan'], 404);
        }
    }
}
