<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $tag = Tag::query();
            return DataTables::of($tag)
                ->addColumn('action', function ($tag) {
                    return view('pages.admin.blog-tag.action', compact('tag'));
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.admin.blog-tag.index');
    }

    public function getTagList(Request $request)
    {
        $tags = Tag::where('name', 'like', '%' . $request->q . '%')->get();
        return response()->json($tags);
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
        $tag = new Tag();
        $tag->name = $request->name;

        if ($tag->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        $tag->created_at_formatted = Carbon::parse($tag->created_at)->translatedFormat('d F Y H:i');
        $tag->updated_at_formatted = Carbon::parse($tag->updated_at)->translatedFormat('d F Y H:i');

        return response()->json(['result' => $tag]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        //
        return response()->json(['result' => $tag]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $tag->update([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
        ]);

        // Simpan perubahan
        if ($tag->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        if ($tag->delete()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
