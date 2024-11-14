<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $tasks = Task::query();
            return DataTables::of($tasks)
                ->addColumn('action', function ($task) {
                    return view('pages.admin.task.action', compact('task'));
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.admin.task.index');
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
            'weight' => 'required|min:0|max:100',
        ]);

        $task = new Task();
        $task->name = $request->name;
        $task->weight = $request->weight;
        $task->has_technical_aspects = $request->has_technical == '1' ? 1 : 0;
        $task->has_non_technical_aspects = $request->has_non_technical == '1' ? 1 : 0;

        if ($task->save()) {

            return response()->json(['success' => true, 'task' => $task]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $task->created_at_formatted = Carbon::parse($task->created_at)->translatedFormat('d F Y H:i');
        $task->updated_at_formatted = Carbon::parse($task->updated_at)->translatedFormat('d F Y H:i');

        return response()->json(['result' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $task->created_at_formatted = Carbon::parse($task->created_at)->translatedFormat('d F Y H:i');
        $task->updated_at_formatted = Carbon::parse($task->updated_at)->translatedFormat('d F Y H:i');

        return response()->json(['result' => $task]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'name' => 'required',
            'weight' => 'required|min:0|max:100',
        ]);

        $task->name = $request->name;
        $task->weight = $request->weight;
        $task->has_technical_aspects = $request->has_technical_aspects == '1' ? 1 : 0;
        $task->has_non_technical_aspects = $request->has_non_technical_aspects == '1' ? 1 : 0;

        if ($task->save()) {
            return response()->json(['success' => true, 'task' => $task]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        if ($task->delete()) {
            return response()->json(['success' => true, 'data' => $task]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
