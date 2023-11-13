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

        $intern = Intern::where('user_id', $userId)->first();
        $reports = Report::all();
        
        if ($intern) {
            $internId = $intern->id; // Mengasumsikan 'id' pada tabel Intern adalah 'intern_id'

            if ($request->ajax()) {
                $reports = Report::where('intern_id', $internId)->select('*');
                return DataTables::of($reports)
                    ->addColumn('action', function ($report) use ($internId) {
                        return view('pages.users.report.action', compact('report', 'internId'));
                    })
                    ->addIndexColumn()
                    ->rawColumns(['action'])
                    ->make(true);
            }

            $reports = Report::all();

            $reports = Report::where('intern_id', $internId)->get();

            return view('pages.users.report.index', compact('internId'));
        } 
    
    
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
        //
        $report = Report::find($id);
       
        return view('pages.users.report.edit', [
            'report' => $report,
            'id' => $report->id,
            'date' => $report->date,
            'presence' => $report->presence,
            'attendance_hours' => $report->attendance_hours,
            'agency' => $report->agency,
            'project_name' => $report->project_name,
            'job' => $report->job,
            'description' => $report->description,
           

        ]);
        return view('pages.users.report.edit', compact('report'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReportRequest $request, $id)
    {
        //
        $report = Report::find($id);

        $report->update([
            'presence'=>$request->input('presence'),
            'attendance_hours'=>$request->input('attendance_hours'),
            'agency'=>$request->input('agency'),
            'project_name'=>$request->input('project_name'),
            'job'=>$request->input('job'),
            'description'=>$request->input('description'),
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
