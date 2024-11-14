<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Service\MailService;
use App\Traits\LogActivityTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;


class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use LogActivityTrait;
    private $mailService;

    public function __construct(MailService $mailService)
    {
        $this->mailService = $mailService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $subscriptions = Subscription::query();
            return DataTables::of($subscriptions)
                ->addColumn('action', function ($subscriptions) {
                    return view('pages.admin.subscription.action', compact('subscriptions'));
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        };

        return view('pages.admin.subscription.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'status' => 'required',
        ]);

        $subscription = new Subscription();
        $subscription->email = $request->email;
        $subscription->status = $request->status;

        if ($subscription->save()) {
            $this->logActivity($subscription, 'Menambahkan Pelanggan', $subscription->toArray());

            if ($this->mailService->sendEmailSubscribe($subscription)) {
                try {
                    $this->logActivity($subscription, 'Mengirim Email Pelanngan', [
                        'email' => $subscription->email,
                        'status' => $subscription->status,
                    ], 'email');
                } catch (\Exception $e) {
                    Log::error('Failed to log activity: ' . $e->getMessage());
                }
            }

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    // Di landing page section subscribe
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $subscription = Subscription::where('email', $request->input('email'))->first();
        $before = $subscription->toArray();

        if ($subscription) {

            if ($subscription->status == 0) {
                $subscription->status = 1;
                $subscription->save();

                $after = $subscription->fresh()->toArray();
                $data = [
                    'before' => $before,
                    'after' => $after,
                ];

                $this->logActivity($subscription, 'Re-subcribe Pelanggan', $data);

                $this->mailService->sendEmailReSubscribe($subscription);
                return response()->json(['success' => true, 'message' => 'You have successfully re-subscribed!']);
            }
            return response()->json(['success' => false, 'message' => 'You are already subscribed.'], 400);
        } else {
            $subscription = new Subscription();
            $subscription->email = $request->input('email');
            $subscription->status = 1;
            $this->mailService->sendEmailSubscribe($subscription);

            if ($subscription->save()) {
                $this->logActivity($subscription, 'Pelanggan Baru', $subscription->toArray());

                return response()->json(['success' => true, 'message' => 'You have successfully subscribed!']);
            } else {
                return response()->json(['success' => false, 'message' => 'Subscription failed.'], 500);
            }
        }
    }

    public function unsubscribe($email)
    {
        $subscription = Subscription::where('email', $email)->first();

        if ($subscription) {
            $before = $subscription->toArray();

            $subscription->status = 0;
            $subscription->save();

            $after = $subscription->fresh()->toArray();
            $data = [
                'before' => $before,
                'after' => $after,
            ];


            $this->logActivity($subscription, 'Unsubscribe Pelanggan', $data);
            $this->mailService->sendEmailUnsubscribe($email);
            return view('pages.home.unsubscribe', ['email' => $email]);
        }
        return response()->json(['success' => false, 'message' => 'Email not found.'], 404);
    }

    // Di halaman un-subscribe
    public function reSubscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $subscription = Subscription::where('email', $request->input('email'))->first();

        if ($subscription) {
            if ($subscription->status == 0) {
                $before = $subscription->toArray();

                $subscription->status = 1;
                $subscription->save();

                $after = $subscription->fresh()->toArray();
                $data = [
                    'before' => $before,
                    'after' => $after,
                ];

                $this->logActivity($subscription, 'Re-subscribe Pelanggan', $data);
                $this->mailService->sendEmailReSubscribe($subscription);

                return response()->json(['success' => true, 'message' => 'You have successfully subscribed again!']);
            }

            return response()->json(['success' => true, 'message' => 'You have successfully subscribed again!']);
        }

        // If the subscription does not exist
        return response()->json(['success' => false, 'message' => 'Subscription failed.'], 500);
    }




    /**
     * Display the specified resource.
     */
    public function show(Subscription $subscription)
    {
        $subscription->created_at_formatted = Carbon::parse($subscription->created_at)->translatedFormat('d F Y H:i');
        $subscription->updated_at_formatted = Carbon::parse($subscription->updated_at)->translatedFormat('d F Y H:i');

        return response()->json(['result' => $subscription]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subscription $subscription)
    {
        //
        $subscription->created_at_formatted = Carbon::parse($subscription->created_at)->translatedFormat('d F Y H:i');
        $subscription->updated_at_formatted = Carbon::parse($subscription->updated_at)->translatedFormat('d F Y H:i');

        return response()->json(['result' => $subscription]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subscription $subscription)
    {

        $before = $subscription->toArray();

        $request->validate([
            'email' => 'required|email',
            'status' => 'required'
        ]);

        $subscription->email = $request->email;
        $subscription->status = $request->status;

        if ($subscription->save()) {
            $after = $subscription->fresh()->toArray();
            $data = [
                'before' => $before,
                'after' => $after,
            ];

            $this->logActivity($subscription, 'Memperbarui Pelanggan', $data);

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscription $subscription)
    {
        //
        if ($subscription->delete()) {
            $this->logActivity($subscription, 'Menghapus Pelanggan', $subscription->toArray());
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
