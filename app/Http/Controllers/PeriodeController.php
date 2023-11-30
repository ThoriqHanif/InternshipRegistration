<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use App\Http\Requests\StorePeriodeRequest;
use App\Http\Requests\UpdatePeriodeRequest;
use App\Models\Position;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            // $periode = Periode::select('*');
            $periode = Periode::with('position')->select('periodes.*');
            
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
        //
        $position = Position::all();
        return view('pages.admin.periode.create', compact('position'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePeriodeRequest $request)
    {
        //
        
        $periode = new Periode();
        // $periode->user_id = null;
        $periode->name = $request->name;
        $periode->position_id = $request->position_id;
        $periode->start_date = $request->start_date;
        $periode->end_date = $request->end_date;
        $periode->quota = $request->quota;
        $periode->description = $request->description;

        if ($periode->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $periode = Periode::find($id);
        $position_id = $periode->position_id;
        $positions = Position::all();

        return view('pages.admin.periode.show', [
            'periode' => $periode,
            'id' => $periode->id,
            'name' => $periode->name,
            'position_id' => $position_id,
            'positions' => $positions,
            'start_date' => $periode->start_date,
            'end_date' => $periode->end_date,
            'quota'=> $periode->quota,
            'description'=> $periode->description

        ]);
        return view('pages.admin.periode.show', compact('periode', 'position'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        //
        $periode = Periode::find($id);
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
            'quota'=> $periode->quota,
            'description'=> $periode->description

        ]);
        return view('pages.admin.periode.edit', compact('periode', 'position'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePeriodeRequest $request, $id)
    {
        //
        $periode = Periode::find($id);
        $newPositionId = $request->input('position_id');

        if ($periode->position_id != $newPositionId) {
            // Periksa apakah posisi yang baru ada
            $newPosition = Position::find($newPositionId);

            if ($newPosition) {
                // Hapus relasi dengan posisi lama
                $oldPosition = Position::find($periode->position_id);
                if ($oldPosition) {
                    $periode->position()->dissociate();
                    $periode->save();
                }

                // Atur relasi dengan posisi baru
                $periode->position_id = $newPositionId;
                $periode->save();
            }
        }

        $periode->update([
            'name' => $request->input('name'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'position_id' => $request->input('position_id'),
            'quota' => $request->input('quota'),
            'description' => $request->input('description'),

        ]);

        if ($periode->save()) {
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
        //
        $periode = Periode::find($id);

        if ($periode->delete()) {
            return response()->json(['success' => true, 'message' => 'User berhasil dihapus.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus User.']);
        }
    }
}
