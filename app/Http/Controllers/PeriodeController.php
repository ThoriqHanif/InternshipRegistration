<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use App\Http\Requests\StorePeriodeRequest;
use App\Http\Requests\UpdatePeriodeRequest;
use App\Models\PeriodePosition;
use App\Models\Position;
use App\Traits\LogActivityTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PeriodeController extends Controller
{
    use LogActivityTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $periode = Periode::with('positions')->select('periodes.*');

            return DataTables::of($periode)
                ->addColumn('action', function ($periode) {
                    return view('pages.admin.periode.action', compact('periode'));
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.admin.periode.index');
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $positions = Position::all();
        return view('pages.admin.periode.create', compact('positions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePeriodeRequest $request)
    {
        $periode = new Periode();
        $periode->name = $request->name;
        $periode->start_date = $request->start_date;
        $periode->end_date = $request->end_date;
        $periode->description = $request->description;

        if ($periode->save()) {
            $positionsData = [];

            foreach ($request->positions as $position) {
                $existingPeriodePosition = PeriodePosition::where('periode_id', $periode->id)
                    ->where('position_id', $position['id'])
                    ->first();

                if ($existingPeriodePosition) {
                    $existingPeriodePosition->quota += $position['quota'];
                    $existingPeriodePosition->save();
                } else {
                    $existingPeriodePosition = PeriodePosition::create([
                        'periode_id' => $periode->id,
                        'position_id' => $position['id'],
                        'quota' => $position['quota'],
                    ]);
                }

                $positionsData[] = [
                    'position_id' => $existingPeriodePosition->position_id,
                    'quota' => $existingPeriodePosition->quota,
                ];
            }

            $this->logActivity($periode, 'Menambahkan Periode', [
                'periode' => $periode->toArray(),
                'positions' => $positionsData,
            ]);

            // dd(['periode' => $periode, 'positions' => $positionsData]);

            return response()->json(['success' => true, 'data' => $periode, 'positions' => $positionsData]);
        } else {
            return response()->json(['success' => false]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $periode = Periode::with('positions')->findOrFail($id);

        $periode->start_date_formatted = Carbon::parse($periode->start_date)->translatedFormat('d F Y');
        $periode->end_date_formatted = Carbon::parse($periode->end_date)->translatedFormat('d F Y');
        $periode->created_at_formatted = Carbon::parse($periode->created_at)->translatedFormat('d F Y H:i');
        $periode->updated_at_formatted = Carbon::parse($periode->updated_at)->translatedFormat('d F Y H:i');

        return response()->json([
            'result' => $periode,
            'positions' => $periode->positions
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $periode = Periode::with('positions')->findOrFail($id);
        $position_id = $periode->position_id;
        $positions = Position::all();

        return view('pages.admin.periode.edit', [
            'periode' => $periode,
            'id' => $periode->id,
            'name' => $periode->name,
            'position_id' => $position_id,
            'positions' => $positions,
            'start_date' => $periode->start_date,
            'end_date' => $periode->end_date,
            'quota' => $periode->quota,
            'description' => $periode->description

        ]);
        return view('pages.admin.periode.edit', compact('periode', 'positions'));
    }

    public function update(UpdatePeriodeRequest $request, $id)
    {
        $periode = Periode::with('positions')->findOrFail($id);

        $before = $periode->toArray();
        $periode->name = $request->name;
        $periode->start_date = $request->start_date;
        $periode->end_date = $request->end_date;
        $periode->description = $request->description;

        if ($periode->save()) {

            $positionIds = collect(json_decode($request->positions, true))->pluck('id');
            $periode->positions()->whereNotIn('position_id', $positionIds)->detach();

            foreach (json_decode($request->positions, true) as $positionData) {
                $position = $periode->positions()->where('position_id', $positionData['id'])->first();

                if ($position) {
                    $position->pivot->quota = $positionData['quota'];
                    $position->pivot->save();
                } else {
                    $periode->positions()->attach($positionData['id'], ['quota' => $positionData['quota']]);
                }
            }

            $after = [
                'periode' => $periode->toArray(),
                'positions' => $periode->positions->map(function ($position) {
                    return [
                        'position_id' => $position->pivot->position_id,
                        'quota' => $position->pivot->quota,
                    ];
                })->toArray(),
            ];

            $this->logActivity($periode, 'Memperbarui Periode', [
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
    public function destroy($id)
    {
        $periode = Periode::with(['positions', 'interns'])->findOrFail($id);
        $data = [
            'periode' => $periode->toArray()
        ];

        if ($periode->delete()) {
            $this->logActivity($periode, 'Menghapus Periode', $data);
            return response()->json(['success' => true, 'message' => 'User berhasil dihapus.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus User.']);
        }
    }
}
