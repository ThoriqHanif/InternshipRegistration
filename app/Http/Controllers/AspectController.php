<?php

namespace App\Http\Controllers;

use App\Models\Aspect;
use App\Models\Position;
use App\Traits\LogActivityTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AspectController extends Controller
{
    use LogActivityTrait;
    public function index(Request $request)
    {
        $aspects = Aspect::all();
        $technical = Aspect::with('positionAspects')->where('type', 'technical')->get();
        $non_technical = Aspect::where('type', 'non-technical')->get();
        return view('pages.admin.aspect.index', compact('aspects', 'technical', 'non_technical'));
    }

    public function indexTechnical(Request $request)
    {
        if ($request->ajax()) {
            // $aspect = Aspect::with('positions')->where('type', 'technical')->get();
            $positions = Position::with(['aspects' => function ($query) {
                $query->where('type', 'technical');
            }])->withCount(['aspects as total_aspects' => function ($query) {
                $query->where('type', 'technical');
            }])->having('total_aspects', '>', 0)->get();

            return DataTables::of($positions)
                ->addColumn('action', function ($position) {
                    return view('pages.admin.aspect.technical.action', compact('position'));
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.admin.aspect.technical.index');
    }

    public function indexNonTechnical(Request $request)
    {
        if ($request->ajax()) {
            $aspects = Aspect::where('type', 'non-technical')->get();
            return DataTables::of($aspects)
                ->addColumn('action', function ($aspect) {
                    return view('pages.admin.aspect.non-technical.action', compact('aspect'));
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.admin.aspect.non-technical.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function createTechnical()
    {
        $positions = Position::whereDoesntHave('aspects', function ($query) {
            $query->where('type', 'technical');
        })->get();

        return view('pages.admin.aspect.technical.create', compact('positions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function storeTechnical(Request $request)
    {
        $request->validate([
            'position_id' => 'required|exists:positions,id',
            'name' => 'required|array',
            'name.*' => 'required|string|distinct',
            'type' => 'required|in:technical,non-technical',
        ]);

        $existingAspects = Aspect::whereHas('positionAspects', function ($query) use ($request) {
            $query->where('position_id', $request->position_id);
        })->where('type', 'technical')->pluck('name')->toArray();

        foreach ($request->name as $aspectName) {
            if (in_array($aspectName, $existingAspects)) {
                return response()->json(['success' => false, 'message' => 'Aspek teknis "' . $aspectName . '" ini sudah ada untuk posisi tersebut.'], 400);
            }
        }

        $aspects = [];
        foreach ($request->name as $aspectName) {
            $aspect = new Aspect(['name' => $aspectName, 'type' => $request->type]);
            $aspect->save();

            $aspect->positionAspects()->attach($request->position_id);
            $positionAspect = $aspect->positionAspects()->where('position_id', $request->position_id)->first();

            // Menyimpan setiap aspek dengan informasi posisi
            $aspects[] = [
                'id' => $aspect->id,
                'name' => $aspect->name,
                'type' => $aspect->type,
                'position_aspect' => [
                    'id' => $positionAspect->pivot->id,
                    'position_id' => $positionAspect->pivot->position_id,
                    'aspect_id' => $positionAspect->pivot->aspect_id,
                ],
            ];
        }

        $data = [
            'position_id' => $request->position_id,
            'position_name' => Position::find($request->position_id)->name,
            'aspects' => $aspects,
        ];

        $this->logActivity($aspect, 'Menambahkan Aspek Teknis', $data);

        return response()->json(['success' => true, 'aspects' => $aspects], 201);
    }

    public function storeNonTechnical(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required|in:technical,non-technical',
        ]);

        $aspect = new Aspect();
        $aspect->name = $request->name;
        $aspect->type = 'non-technical';

        if ($aspect->save()) {
            $this->logActivity($aspect, 'Menambahkan Aspek Non-Teknis', $aspect->toArray());
            return response()->json(['success' => true, 'aspect' => $aspect]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Aspect $aspect)
    {
        //
    }

    public function showTechnical($id)
    {
        $aspect = Position::with('aspects')->findOrFail($id);

        $aspect->created_at_formatted = Carbon::parse($aspect->created_at)->translatedFormat('d F Y H:i');
        $aspect->updated_at_formatted = Carbon::parse($aspect->updated_at)->translatedFormat('d F Y H:i');

        return response()->json([
            'result' => $aspect,
        ]);
    }

    public function showNonTechnical($id)
    {
        $aspect = Aspect::findOrFail($id);
        $aspect->created_at_formatted = Carbon::parse($aspect->created_at)->translatedFormat('d F Y H:i');
        $aspect->updated_at_formatted = Carbon::parse($aspect->updated_at)->translatedFormat('d F Y H:i');

        return response()->json([
            'result' => $aspect,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aspect $aspect) {}

    public function editTechnical($id)
    {
        $aspects = Position::with('technicalAspects')->findOrFail($id);
        $positions = Position::whereDoesntHave('aspects', function ($query) {
            $query->where('type', 'technical');
        })
            ->orWhere('id', $aspects->id)
            ->get();
        $positionAll = Position::with('aspects')->get();

        return view('pages.admin.aspect.technical.edit', compact('positions', 'aspects', 'positionAll'));
    }

    public function editNonTechnical($id)
    {
        $aspect = Aspect::where('type', 'non-technical')->findOrFail($id);
        return response()->json(['result' => $aspect]);
    }

    public function swapPositions(Request $request)
    {
        $request->validate([
            'swap_position_1' => 'required|exists:positions,id',
            'swap_position_2' => 'required|exists:positions,id',
        ]);

        // Ambil posisi yang akan ditukar
        $position1 = Position::findOrFail($request->swap_position_1);
        $position2 = Position::findOrFail($request->swap_position_2);

        try {
            // Ambil aspek teknis yang terkait dengan posisi 1 dan posisi 2
            $position1Aspects = $position1->aspects()->where('type', 'technical')->get();
            $position2Aspects = $position2->aspects()->where('type', 'technical')->get();

            // Tukar position_id untuk semua aspek yang ada
            foreach ($position1Aspects as $aspect) {
                $aspect->pivot->position_id = $position2->id;
                $aspect->pivot->save();
            }

            foreach ($position2Aspects as $aspect) {
                $aspect->pivot->position_id = $position1->id;
                $aspect->pivot->save();
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aspect $aspect) {}

    // public function updateTechnical(Request $request, $id)
    // {
    //     $request->validate([
    //         'position_id' => 'required|exists:positions,id',
    //         'name' => 'required|array',
    //         'name.*' => 'required|string|distinct',
    //         'type' => 'required|in:technical,non-technical',
    //     ]);

    //     $position = Position::findOrFail($request->position_id);
    //     $aspectNames = $request->name;
    //     $aspectIds = [];

    //     $beforeData = [
    //         'position_id' => $position->id,
    //         'position_name' => $position->name,
    //         'aspects' => $position->aspects->where('type', $request->type)->map(function ($aspect) {
    //             return [
    //                 'id' => $aspect->id,
    //                 'name' => $aspect->name,
    //                 'type' => $aspect->type,
    //                 'positions' => $aspect->positionAspects->map(function ($positionAspect) {
    //                     return [
    //                         'position_id' => $positionAspect->position_id,
    //                         'position_name' => $positionAspect->position->name,
    //                         'position_aspect' => [
    //                             'id' => $positionAspect->pivot->id,
    //                             'position_id' => $positionAspect->pivot->position_id,
    //                             'aspect_id' => $positionAspect->pivot->aspect_id,
    //                         ],
    //                     ];
    //                 })->toArray(),
    //             ];
    //         })->toArray()
    //     ];

    //     foreach ($aspectNames as $aspectName) {
    //         $aspect = Aspect::where('name', $aspectName)
    //             ->where('type', $request->type)
    //             ->first();

    //         if (!$aspect) {
    //             $aspect = Aspect::create([
    //                 'name' => $aspectName,
    //                 'type' => $request->type,
    //             ]);
    //         }
    //         $aspectIds[] = $aspect->id;
    //     }

    //     $position->aspects()->sync($aspectIds);
    //     $this->cleanUnusedAspects();

    //     $afterData = [
    //         'position_id' => $position->id,
    //         'position_name' => $position->name,
    //         'aspects' => $position->aspects->where('type', $request->type)->map(function ($aspect) {
    //             return [
    //                 'id' => $aspect->id,
    //                 'name' => $aspect->name,
    //                 'type' => $aspect->type,
    //                 'positions' => $aspect->positionAspects->map(function ($positionAspect) {
    //                     return [
    //                         'position_id' => $positionAspect->position_id,
    //                         'position_name' => $positionAspect->position->name,
    //                         'position_aspect' => [
    //                             'id' => $positionAspect->pivot->id,
    //                             'position_id' => $positionAspect->pivot->position_id,
    //                             'aspect_id' => $positionAspect->pivot->aspect_id,
    //                         ],
    //                     ];
    //                 })->toArray(),
    //             ];
    //         })->toArray()
    //     ];

    //     $firstAspect = Aspect::find(reset($aspectIds));
    //     $data = [
    //         'before' => $beforeData,
    //         'after' => $afterData,
    //     ];
    //     $this->logActivity($firstAspect, 'Memperbarui Aspek Teknis', $data);

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Data technical aspects berhasil diperbarui!',
    //         'aspects' => $position->aspects,
    //     ]);
    // }

    // public function updateTechnical(Request $request, $id)
    // {
    //     $request->validate([
    //         'position_id' => 'required|exists:positions,id',
    //         'name' => 'required|array',
    //         'name.*' => 'required|string|distinct',
    //         'type' => 'required|in:technical,non-technical',
    //     ]);

    //     $position = Position::findOrFail($request->position_id);
    //     $aspectNames = $request->name;
    //     $aspectIds = [];

    //     // Before Data
    //     $beforeData = [
    //         'position_id' => $position->id,
    //         'position_name' => $position->name,
    //         'aspects' => $position->aspects->where('type', $request->type)->map(function ($aspect) {
    //             return [
    //                 'id' => $aspect->id,
    //                 'name' => $aspect->name,
    //                 'type' => $aspect->type,
    //                 'positions' => $aspect->positionAspects->map(function ($positionAspect) {
    //                     return [
    //                         'position_id' => $positionAspect->position_id,
    //                         'position_name' => optional($positionAspect->position)->name,
    //                         'position_aspect' => [
    //                             'id' => $positionAspect->id,
    //                             'position_id' => $positionAspect->position_id,
    //                             'aspect_id' => $positionAspect->aspect_id,
    //                         ],
    //                     ];
    //                 })->toArray(),
    //             ];
    //         })->values()->toArray()
    //     ];

    //     $aspects = [];
    //     foreach ($aspectNames as $aspectName) {
    //         $aspect = Aspect::firstOrCreate(
    //             ['name' => $aspectName, 'type' => $request->type]
    //         );
    //         $aspectIds[] = $aspect->id;

    //         $aspect->positionAspects()->syncWithoutDetaching([$request->position_id]);
    //         $positionAspect = $aspect->positionAspects()->where('position_id', $request->position_id)->first();

    //         $aspects[] = [
    //             'id' => $aspect->id,
    //             'name' => $aspect->name,
    //             'type' => $aspect->type,
    //             'positions' => [
    //                 [
    //                     'position_id' => optional($positionAspect->position)->id,
    //                     'position_name' => optional($positionAspect->position)->name,
    //                     'position_aspect' => $positionAspect ? [
    //                         'id' => $positionAspect->id,
    //                         'position_id' => $positionAspect->position_id,
    //                         'aspect_id' => $positionAspect->aspect_id,
    //                     ] : null,
    //                 ]
    //             ],
    //         ];
    //     }


    //     $position->aspects()->sync($aspectIds);
    //     $this->cleanUnusedAspects();

    //     $afterData = [
    //         'position_id' => $position->id,
    //         'position_name' => $position->name,
    //         'aspects' => $aspects,
    //     ];

    //     $data = [
    //         'before' => $beforeData,
    //         'after' => $afterData,
    //     ];

    //     $this->logActivity($position, 'Memperbarui Aspek Teknis', $data);

    //     return response()->json(['success' => true, 'aspects' => $aspects], 201);
    // }

    public function updateTechnical(Request $request, $id)
{
    $request->validate([
        'position_id' => 'required|exists:positions,id',
        'name' => 'required|array',
        'name.*' => 'required|string|distinct',
        'type' => 'required|in:technical,non-technical',
    ]);

    $position = Position::findOrFail($request->position_id);
    $aspectNames = $request->name;
    $aspectIds = [];

    // Before Data
    $beforeData = [
        'position_id' => $position->id,
        'position_name' => $position->name,
        'aspects' => $position->aspects->where('type', $request->type)->map(function ($aspect) {
            return [
                'id' => $aspect->id,
                'name' => $aspect->name,
                'type' => $aspect->type,
                'positions' => $aspect->positionAspects->map(function ($positionAspect) {
                    return [
                        'position_id' => $positionAspect->position_id ?? null,
                        'position_name' => $positionAspect->position ? $positionAspect->position->name : null,
                        'position_aspect' => [
                            'id' => $positionAspect->id,
                            'position_id' => $positionAspect->position_id,
                            'aspect_id' => $positionAspect->aspect_id,
                        ],
                    ];
                })->toArray(),
            ];
        })->values()->toArray()
    ];

    // Update or create aspects
    $aspects = [];
    foreach ($aspectNames as $aspectName) {
        $aspect = Aspect::firstOrCreate(
            ['name' => $aspectName, 'type' => $request->type]
        );
        $aspectIds[] = $aspect->id;

        $aspect->positionAspects()->syncWithoutDetaching([$request->position_id]);
        $positionAspect = $aspect->positionAspects()->where('position_id', $request->position_id)->first();

        if ($positionAspect) {
            $aspects[] = [
                'id' => $aspect->id,
                'name' => $aspect->name,
                'type' => $aspect->type,
                'positions' => [
                    [
                        'position_id' => $positionAspect->position_id,
                        'position_name' => $positionAspect->position ? $positionAspect->position->name : null,
                        'position_aspect' => [
                            'id' => $positionAspect->id,
                            'position_id' => $positionAspect->position_id,
                            'aspect_id' => $positionAspect->aspect_id,
                        ],
                    ]
                ],
            ];
        }
    }

    // Sync aspects with the position
    $position->aspects()->sync($aspectIds);
    $this->cleanUnusedAspects();

    // After Data
    $afterData = [
        'position_id' => $position->id,
        'position_name' => $position->name,
        'aspects' => $aspects,
    ];

    $data = [
        'before' => $beforeData,
        'after' => $afterData,
    ];

    // Logging aktivitas
    $this->logActivity($position, 'Memperbarui Aspek Teknis', $data);

    return response()->json(['success' => true, 'aspects' => $aspects], 201);
}




    /**
     * Hapus aspek yang tidak digunakan di posisi mana pun
     */
    protected function cleanUnusedAspects()
    {
        $unusedAspects = Aspect::doesntHave('positionAspects')
            ->where('type', 'technical')
            ->get();

        // Hapus aspek-aspek tersebut
        foreach ($unusedAspects as $aspect) {
            $aspect->delete();
        }
    }


    public function updateNonTechnical(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required|in:technical,non-technical',
        ]);

        $aspect = Aspect::findOrFail($id);
        $before = $aspect->toArray();
        $aspect->name = $request->name;
        $aspect->type = 'non-technical';

        if ($aspect->save()) {
            $after = $aspect->fresh()->toArray();
            $data = [
                'before' => $before,
                'after' => $after,
            ];
            $this->logActivity($aspect, 'Memperbarui Aspek Non-Teknis', $data);
            return response()->json(['success' => true, 'aspect' => $aspect]);
        } else {
            return response()->json(['success' => false]);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aspect $aspect)
    {
        //
    }

    public function destroyTechnical(Request $request, $id)
    {
        $position = Position::findOrFail($id);
        $aspectIds = $position->aspects()->pluck('aspects.id');

        $position->aspects()->detach();

        Aspect::whereIn('id', $aspectIds)->each(function ($aspect) {
            if ($aspect->positionAspects()->count() == 0) {
                $aspect->delete();
            }
        });

        return response()->json(['success' => true]);
    }


    public function destroyNonTechnical($id)
    {
        $aspect = Aspect::where('type', 'non-technical')->findOrFail($id);

        if ($aspect->delete()) {
            $this->logActivity($aspect, 'Menghapus Aspek Non-Teknis', $aspect->toArray());
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
