<?php

namespace App\Http\Controllers;

use App\Models\LogActivity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LogActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $log_activity = LogActivity::with('user')->select('*');
            return DataTables::of($log_activity)
                ->addColumn('action', function ($log_activity) {
                    return view('pages.admin.log-activity.action', compact('log_activity'));
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.admin.log-activity.index');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $logActivity = LogActivity::with('user')->findOrFail($id);
        $logActivity->created_at_formatted = Carbon::parse($logActivity->created_at)->translatedFormat('d F Y H:i');

        return response()->json(['result' => $logActivity]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LogActivity $logActivity)
    {
        $logActivity->created_at_formatted = Carbon::parse($logActivity->created_at)->translatedFormat('d F Y H:i');

        return response()->json(['result' => $logActivity]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LogActivity $logActivity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LogActivity $logActivity)
    {
        if($logActivity->delete()) {
            return response()->json(['success' => true]);
        }else{
            return response()->json(['success' => false]);
        }
    }
}
