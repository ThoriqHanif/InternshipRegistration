<?php

namespace App\Http\Controllers;

use App\Models\Intern;
use App\Models\SocialMedia;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class SocialMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $userId = Auth::id();

        if ($request->ajax()) {
            $intern = Intern::where('user_id', $userId)->first();

            if ($intern) {
                $social_medias = SocialMedia::with('intern')
                    ->where('intern_id', $intern->id)
                    ->get();

                return DataTables::of($social_medias)
                    ->addColumn('action', function ($social_media) {
                        return view('pages.users.sosmed.action', compact('social_media'));
                    })
                    ->addIndexColumn()
                    ->rawColumns(['action'])
                    ->make(true);
            }

            return response()->json(['error' => 'Intern not found.'], 404);
        }

        return view('pages.users.sosmed.index');
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
        $userId = Auth::id();
        $intern = Intern::where('user_id', $userId)->first();

        $social_media = new SocialMedia();
        $social_media->intern_id = $intern->id;
        $social_media->name = $request->name;
        $social_media->url = $request->url;
        $social_media->icon = $request->icon;


        if ($social_media->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SocialMedia $socialMedia)
    {
        $socialMedia->created_at_formatted = Carbon::parse($socialMedia->created_at)->translatedFormat('d F Y H:i');
        $socialMedia->updated_at_formatted = Carbon::parse($socialMedia->updated_at)->translatedFormat('d F Y H:i');

        return response()->json(['result' => $socialMedia]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SocialMedia $socialMedia)
    {
        return response()->json(['result' => $socialMedia]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SocialMedia $socialMedia)
    {
        $socialMedia->update([
            'name' => $request->input('name'),
            'url' => $request->input('url'),
            'icon' => $request->input('icon'),
        ]);

        // Simpan perubahan
        if ($socialMedia->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SocialMedia $socialMedia)
    {
        if ($socialMedia->delete()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
