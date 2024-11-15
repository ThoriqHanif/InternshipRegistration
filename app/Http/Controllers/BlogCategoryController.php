<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Traits\LogActivityTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Helpers\Utility;
use Yajra\DataTables\Facades\DataTables;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    use LogActivityTrait;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $blog_category = BlogCategory::query();
            return DataTables::of($blog_category)
                ->addColumn('action', function ($blog_category) {
                    return view('pages.admin.blog-category.action', compact('blog_category'));
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.admin.blog-category.index');


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
        $blog_category = new BlogCategory();
        $blog_category->name = $request->name;

        if ($blog_category->save()) {
            return response()->json(['success' => true, 'category' => $blog_category]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(BlogCategory $blogCategory)
    {
        //
        $blogCategory->created_at_formatted = Carbon::parse($blogCategory->created_at)->translatedFormat('d F Y H:i');
        $blogCategory->updated_at_formatted = Carbon::parse($blogCategory->updated_at)->translatedFormat('d F Y H:i');

        return response()->json(['result' => $blogCategory]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogCategory $blogCategory)
    {
        return response()->json(['result' => $blogCategory]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BlogCategory $blogCategory)
    {
        $before = $blogCategory->toArray();

        $blogCategory->update([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
        ]);

        if ($blogCategory->save()) {
            $after = $blogCategory->fresh()->toArray();
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
    public function destroy(BlogCategory $blogCategory)
    {
        if ($blogCategory->delete()) {
            return response()->json(['success' => true, 'data' => $blogCategory]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
