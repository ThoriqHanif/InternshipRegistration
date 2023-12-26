<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Models\Intern;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
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

    public function reportByInternPDF($internId){

        $intern = Intern::with('reports')->find($internId);
       
        $pdf = app('dompdf.wrapper')->loadView('pages.users.report.internReport', compact('intern'));
        
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
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        
        $data = Report::find($id);
        $presences = ['masuk' => 'Masuk', 'remote' => 'Remote', 'libur' => 'Libur', 'izin' => 'Izin'];

        // return view('pages.users.report.edit', [
        //     'report' => $data,
        //     'id' => $data->id,
        //     'date' => $data->date,
        //     'presence' => $data->presence,
        //     'presences' => $presences,
        //     'attendance_hours' => $data->attendance_hours,
        //     'agency' => $data->agency,
        //     'project_name' => $data->project_name,
        //     'job' => $data->job,
        //     'description' => $data->description,


        // ]);
        // return view('pages.users.report.edit', compact('report'));
        // $data = Report::where('id', $id)->first();
        return response()->json(['result' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReportRequest $request, $id)
    {
        //
        // dd($id);
        $report = Report::find($id);

        $report->update([   
            'presence' => $request->input('presence'),
            'attendance_hours' => $request->input('attendance_hours'),
            'agency' => $request->input('agency'),
            'project_name' => $request->input('project_name'),
            'job' => $request->input('job'),
            'description' => $request->input('description'),
        ]);

        // Simpan perubahan 
        if ($report->save()) {
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
}
