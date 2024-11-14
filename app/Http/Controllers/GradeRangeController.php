<?php

namespace App\Http\Controllers;

use App\Models\GradeRange;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class GradeRangeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $grade_ranges = GradeRange::query();
            return DataTables::of($grade_ranges)
                ->addColumn('action', function ($grade_range) {
                    return view('pages.admin.grade-range.action', compact('grade_range'));
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.admin.grade-range.index');
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
            'min' => 'required',
            'max' => 'required',
            'letter_grade' => 'required',
            'predicate' => 'required',
        ]);

        $gradeRange = new GradeRange();
        $gradeRange->min = $request->min;
        $gradeRange->max = $request->max;
        $gradeRange->letter_grade = $request->letter_grade;
        $gradeRange->predicate = $request->predicate;

        if($gradeRange->save()){
            return response()->json(['success' => true, 'grade_range' => $gradeRange]);
        }else{
            return response()->json(['success' => false]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(GradeRange $gradeRange)
    {
        $gradeRange->created_at_formatted = Carbon::parse($gradeRange->created_at)->translatedFormat('d F Y H:i');
        $gradeRange->updated_at_formatted = Carbon::parse($gradeRange->updated_at)->translatedFormat('d F Y H:i');

        return response()->json(['result' => $gradeRange]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GradeRange $gradeRange)
    {
        $gradeRange->created_at_formatted = Carbon::parse($gradeRange->created_at)->translatedFormat('d F Y H:i');
        $gradeRange->updated_at_formatted = Carbon::parse($gradeRange->updated_at)->translatedFormat('d F Y H:i');

        return response()->json(['result' => $gradeRange]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GradeRange $gradeRange)
    {
        $before = $gradeRange->toArray();

        $gradeRange->update([
            'min' => $request->min,
            'max' => $request->max,
            'letter_grade' => $request->letter_grade,
            'predicate' => $request->predicate,
        ]);

        if ($gradeRange->save()) {
            $after = $gradeRange->fresh()->toArray();
            $data = [
                'before' => $before,
                'after' => $after,
            ];

            return response()->json(['success' => true, 'data' => $data]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GradeRange $gradeRange)
    {
        if ($gradeRange->delete()) {
            return response()->json(['success' => true, 'data' => $gradeRange]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
