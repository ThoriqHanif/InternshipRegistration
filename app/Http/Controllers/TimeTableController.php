<?php

namespace App\Http\Controllers;

use App\Models\TimeTable;
use App\Http\Requests\StoreTimeTableRequest;
use App\Http\Requests\UpdateTimeTableRequest;
use App\Traits\LogActivityTrait;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TimeTableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use LogActivityTrait;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $time_table = TimeTable::query();
            return DataTables::of($time_table)
                ->addColumn('action', function ($time_table) {
                    return view('pages.admin.time-table.action', compact('time_table'));
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.admin.time-table.index');
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
    public function store(StoreTimeTableRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TimeTable $timeTable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TimeTable $timeTable)
    {
        return response()->json(['result' => $timeTable]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTimeTableRequest $request, TimeTable $timeTable)
    {
        $before = $timeTable->toArray();
        $timeTable->update([
            'start_time' => $request->input('start_time'),
            'end_time' => $request->input('end_time'),
        ]);


        if ($timeTable->save()) {
            $after = $timeTable->fresh()->toArray();
            $data = [
                'before' => $before,
                'after' => $after,
            ];
            $this->logActivity($timeTable, 'Memperbarui Jam Operasional', $data);

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TimeTable $timeTable)
    {
        //
    }
}
