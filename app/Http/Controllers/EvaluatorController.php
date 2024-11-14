<?php

namespace App\Http\Controllers;

use App\Models\Evaluator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EvaluatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $evaluator = Evaluator::query();
            return DataTables::of($evaluator)
                ->addColumn('action', function ($evaluator) {
                    return view('pages.admin.evaluator.action', compact('evaluator'));
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.admin.evaluator.index');
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
            'name' => 'required',
        ]);

        $evaluator = new Evaluator();
        $evaluator->name = $request->name;

        if ($evaluator->save()) {
            return response()->json(['success' => true, 'evaluator' => $evaluator]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Evaluator $evaluator)
    {
        $evaluator->created_at_formatted = Carbon::parse($evaluator->created_at)->translatedFormat('d F Y H:i');
        $evaluator->updated_at_formatted = Carbon::parse($evaluator->updated_at)->translatedFormat('d F Y H:i');

        return response()->json(['result' => $evaluator]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evaluator $evaluator)
    {
        $evaluator->created_at_formatted = Carbon::parse($evaluator->created_at)->translatedFormat('d F Y H:i');
        $evaluator->updated_at_formatted = Carbon::parse($evaluator->updated_at)->translatedFormat('d F Y H:i');

        return response()->json(['result' => $evaluator]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evaluator $evaluator)
    {
        $before = $evaluator->toArray();
        $evaluator->name = $request->name;
        if ($evaluator->save()) {
            $after = $evaluator->fresh()->toArray();
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
    public function destroy(Evaluator $evaluator)
    {
        if ($evaluator->delete()) {
            return response()->json(['success' => true, 'data' => $evaluator]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
