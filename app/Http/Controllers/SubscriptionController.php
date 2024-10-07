<?php

namespace App\Http\Controllers;

use App\Mail\SuccessUnsubscribe;
use App\Mail\UnsubscribeConfirmation;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
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

        if($subscription->save())
        {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $subscription = Subscription::where('email', $request->input('email'))->first();

        if ($subscription) {
            if ($subscription->status == 0) {
                $subscription->status = 1;
                $subscription->save();
                return response()->json(['success' => true, 'message' => 'You have successfully re-subscribed!']);
            }

            return response()->json(['success' => false, 'message' => 'You are already subscribed.'], 400);
        } else {
            $subscription = new Subscription();
            $subscription->email = $request->input('email');
            $subscription->status = 1;

            if ($subscription->save()) {
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
            $subscription->status = 0;
            $subscription->save();

            Mail::to($email)->send(new SuccessUnsubscribe());

            return view('pages.home.unsubscribe', ['email' => $email]);
        }

        return response()->json(['success' => false, 'message' => 'Email not found.'], 404);
    }

    public function reSubscribe(Request $request)
    {
        $subscription = Subscription::where('email', $request->input('email'))->first();

        if ($subscription) {
            $subscription->status = 1;
            $subscription->save();

            return response()->json(['success' => true, 'message' => 'You have successfully subscribed again!']);

        } else {
            return response()->json(['success' => false, 'message' => 'Subscription failed.'], 500);

        }
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
        //
        $request->validate([
            'email' => 'required|email',
            'status' => 'required'
        ]);

        $subscription->email = $request->email;
        $subscription->status = $request->status;

        if($subscription->save())
        {
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
        if($subscription->delete())
        {
            return response()->json(['success' => true]);
        }else{
            return response()->json(['success' => false]);
        }
    }
}
