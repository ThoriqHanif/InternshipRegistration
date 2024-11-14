<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInternRequest;
use App\Mail\InternStatus;
use App\Models\Intern;
use App\Models\Periode;
use App\Models\Position;
use App\Service\MailService;
use App\Service\RegistrationService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $registrationService;
    private $mailService;

    public function __construct(RegistrationService $registrationService, MailService $mailService)
    {
        $this->registrationService = $registrationService;
        $this->mailService = $mailService;
    }

    public function index(Request $request)
    {
        $positionId = $request->input('position_id');
        $selectedPosition = null;
        $activePositions = null;

        if ($positionId) {
            $selectedPosition = $this->registrationService->getSelectedPosition($positionId);
        } else {
            $activePositions = $this->registrationService->getActivePositions(now());
        }

        return view('form', compact('selectedPosition', 'activePositions'));
    }

    public function showBySlug(Request $request, $locale, $slug)
    {
        App::setLocale($locale);
        $today = Carbon::now();
        $positionData = $this->registrationService->getPositionWithQuota($slug, $today);

        if (!$positionData) {
            abort(404);
        }

        $selectedPosition = $positionData['position'];
        $periode = $positionData['periode'];
        $quota = $positionData['quota'];

        if (!$quota || $quota <= 0) {
            return view('components.error');
        }
        $activePositions = $this->registrationService->getActivePositions($today);

        return view('form', compact('selectedPosition', 'activePositions', 'periode'));
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
    public function store(StoreInternRequest $request)
    {
        DB::beginTransaction();
        try {
            $intern = $this->registrationService->createIntern($request);

            if ($this->registrationService->saveIntern($intern)) {
                if ($intern->status === 'pending') {
                    $this->mailService->sendEmailRegister($intern);
                }
                DB::commit();
                return response()->json(['success' => true]);
            } else {
                DB::rollBack();
                return response()->json(['success' => false]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
