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
        if ($request->ajax()) {
            $positions = ($request->showDeleted == 1) ? Position::onlyTrashed() : Position::query();
    
            return DataTables::of($positions)
                ->addColumn('action', function ($positions) {
                    if ($positions->trashed()) {
                        return view('pages.admin.position.action', compact('positions'));
                    } else {
                        return view('pages.admin.position.action', compact('positions'));
                    }
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
    
        return view('pages.admin.position.index');
    }

    public function restore($id)
    {
        $positions = Position::onlyTrashed()->find($id);
        
        if ($positions) {
            $positions->restore();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function forceDelete($id)
    {
        $positions = Position::onlyTrashed()->find($id);

        if ($positions) {
            try {
                $positions->forceDelete();
                return response()->json(['success' => true]);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'message' => 'Gagal menghapus Posisi secara permanen.']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Posisi tidak ditemukan atau tidak dalam status terhapus.']);
        }
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

        
        $imageFileName = null;
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageFileName = $imageFile->getClientOriginalName();
            $imageFile->move(public_path('files/image'), $imageFileName);
        }

        $positions = new Position();
        $positions->name = $request->input('name');
        $positions->description = $request->input('description');
        $positions->requirements = $requirementsString;
        $positions->image = $imageFileName;
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
        if ($position->image) {
            // Jika surat pengantar sudah diunggah, atur $coverLetterUrl
            $imageUrl = asset('files/image/' . $position->image);
            $imageExtension = pathinfo($position->image, PATHINFO_EXTENSION);
        } else {
            // Jika surat pengantar belum diunggah, atur $coverLetterUrl menjadi null
            $imageUrl = null;
            $imageExtension = null;
        }

        return view('pages.admin.position.show')->with([
            'id' => 'id',
            'name' => $position->name,
            'description' => $position->description,
            'requirements' => $position->requirements,
            'imageUrl' => $imageUrl,
            'imageExtension' => $imageExtension,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Position $position)
    {
     
        $imageUrl = null;
        if ($position->image) {
            // Jika surat pengantar sudah diunggah, atur $coverLetterUrl
            $imageUrl = asset('files/image/' . $position->image);
            $imageExtension = pathinfo($position->image, PATHINFO_EXTENSION);
        } else {
            // Jika surat pengantar belum diunggah, atur $coverLetterUrl menjadi null
            $imagerUrl = null;
            $imageExtension = null;
        }  

        return view('pages.admin.position.edit')->with([
            'position' => $position,
            'id' => $position->id,
            'name' => $position->name,
            'description' => $position->description,
            'requirements' => $position->requirements,
            'imageUrl' => $imageUrl,
            'imageExtension' => $imageExtension,
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
        $data = $request->all();
        $data = Position::find($id);

        $data->name = $request->input('name');
        $data->description = $request->input('description');

        // Proses pembaruan kolom "requirements" sesuai kebutuhan Anda
        // Misalnya, Anda dapat menggunakan implode untuk menggabungkan nilai checkbox
        $requirements = $request->input('requirements', []);
        $requirementsString = implode(', ', $requirements);
        $data->requirements = $requirementsString;

        if ($request->hasFile('image')) {
            // Simpan file gambar yang baru
            $imageFile = $request->file('image');
            $imageFileName = $imageFile->getClientOriginalName();
            $imageFile->move(public_path('files/image'), $imageFileName);
    
            // Update kolom "image" dalam database
            $data->update(['image' => $imageFileName]);
        }

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
