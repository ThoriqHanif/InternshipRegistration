<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Http\Requests\StorePositionRequest;
use App\Http\Requests\UpdatePositionRequest;
use App\Models\Intern;
use App\Service\FileService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $fileService;
    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

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
        $requirements = $request->input('requirements', []);
        if (!empty($requirements)) {
            $requirementsString = implode(', ', $requirements);
        } else {
            $requirementsString = null;
        }

        $imageFileName = $this->fileService->uploadFile($request->file('image'), 'image');

        $position = new Position();
        $position->name = $request->input('name');
        $position->description = $request->input('description');
        $position->requirements = $requirementsString;
        $position->image = $imageFileName;

        if ($position->save()) {
            return response()->json(['success' => true, 'position' => $position]);
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
        [$imageUrl, $imageExtension] = $this->fileService->getImageDetails($position->image, 'image');

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

        [$imageUrl, $imageExtension] = $this->fileService->getImageDetails($position->image, 'image');

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
    public function update(UpdatePositionRequest $request, Position $position)
    {
        $before = $position->toArray();

        $position->name = $request->input('name');
        $position->description = $request->input('description');

        $requirements = $request->input('requirements', []);
        $position->requirements = implode(', ', $requirements);

        if ($request->hasFile('image')) {
            if ($position->image) {
                $this->fileService->deleteFile($position->image, 'image');
            }
            $imageFileName = $this->fileService->uploadFile($request->file('image'), 'image');
            $position->image = $imageFileName;
        }

        if ($position->save()) {
            $after = $position->fresh()->toArray();
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
    public function destroy($id)
    {
        //
        $position = Position::findOrFail($id);

        $relatedInterns = Intern::where('position_id', $position->position_id)->get();
        foreach ($relatedInterns as $relatedIntern) {
            $relatedIntern->position_id = null;
            $relatedIntern->save();
        }
        if ($position->delete()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Posisi menghapus User.']);
        }
    }

    public function restore($id)
    {
        $position = Position::onlyTrashed()->find($id);

        if ($position) {
            $position->restore();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function forceDelete($id)
    {
        $position = Position::onlyTrashed()->find($id);

        if ($position) {
            $position->forceDelete();
            $this->fileService->deleteFile($position->image, 'image');

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
