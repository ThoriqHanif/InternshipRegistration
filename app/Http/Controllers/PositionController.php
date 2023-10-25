<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Http\Requests\StorePositionRequest;
use App\Http\Requests\UpdatePositionRequest;
use App\Models\Intern;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $positions = Position::select('*');
            return DataTables::of($positions)
                ->addColumn('action', function ($positions) {
                    return view('pages.admin.position.action', compact('positions'));
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
    
        return view('pages.admin.position.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $position = Position::all();
        return view('pages.admin.position.create', compact('position'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePositionRequest $request)
    {
        //
        $requirements = $request->input('requirements', []);
        if (!empty($requirements)) {
            $requirementsString = implode(', ', $requirements);
        } else {
            $requirementsString = null; // Atau, jika Anda ingin mengisi dengan null jika tidak ada yang dipilih
        }

        $positions = new Position();
        $positions->name = $request->input('name');
        $positions->description = $request->input('description');
        $positions->requirements = $requirementsString;
        // $positions->save();

        if ($positions->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Position $position)
    {
        //
        return view('pages.admin.position.show')->with([
            'id' => 'id',
            'name' => $position->name,
            'description' => $position->description,
            'requirements' => $position->requirements,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Position $position)
    {
        //
        return view('pages.admin.position.edit')->with([
            'position' => $position,
            'id' => $position->id,
            'name' => $position->name,
            'description' => $position->description,
            'requirements' => $position->requirements,
        ]);
        $requirements = explode(', ', $position->requirements);

        return view('pages.admin.position.edit', compact('position', 'requirements'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePositionRequest $request, $id)
    {
        //

        $data = Position::find($id);

        $data->name = $request->input('name');
        $data->description = $request->input('description');

        // Proses pembaruan kolom "requirements" sesuai kebutuhan Anda
        // Misalnya, Anda dapat menggunakan implode untuk menggabungkan nilai checkbox
        $requirements = $request->input('requirements', []);
        $requirementsString = implode(', ', $requirements);
        $data->requirements = $requirementsString;

        // Simpan perubahan
        if ($data->save()) {
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
        $data = Position::findOrFail($id);

        $relatedInterns = Intern::where('position_id', $data->position_id)->get();
                    foreach ($relatedInterns as $relatedIntern) {
                        // Set user_id menjadi null pada pemagang yang terkait
                        $relatedIntern->position_id = null;
                        $relatedIntern->save();

                    }
        if ($data->delete()) {
            return response()->json(['success' => true, 'message' => 'Posisi berhasil dihapus.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Posisi menghapus User.']);
        }
    }
}
