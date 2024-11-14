<?php

namespace App\Listeners;

use App\Models\LogActivity;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogActivityListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        //
    }

    public function handleLogin(Login $event)
    {
        $user = $event->user;

        LogActivity::create([
            'user_id' => $user->id,
            'activity' => 'ID : ' . $user->id . ', Username : ' . $user->name . ', Berhasil Login',
            'method' => 'POST',
            'url' => request()->fullUrl(),
            'agent' => request()->header('User-Agent'),
            'ip' => request()->ip(),
        ]);
    }

    public function handleLogout(Logout $event)
    {
        $user = $event->user;

        LogActivity::create([
            'user_id' => $user->id,
            'activity' => 'ID : ' . $user->id . ', Username : ' . $user->username . ', Berhasil Logout',
            'method' => 'POST',
            'url' => request()->fullUrl(),
            'agent' => request()->header('User-Agent'),
            'ip' => request()->ip(),
        ]);
    }

}
