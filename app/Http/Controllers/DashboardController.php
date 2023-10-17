<?php

namespace App\Http\Controllers;

use App\Models\Intern;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function admin()
    {
        $totalPendaftar = Intern::count();
        $totalPemagang = User::where('role', 'user')->count();
        $totalPosisi = Position::count();
        $totalPending = Intern::where('status','pending')->count();

        return view('pages.admin.dashboard', compact('totalPendaftar','totalPemagang', 'totalPosisi', 'totalPending'));
    }

    public function user()
    {
        // dd(Auth::user());
        $totalPendaftar = Intern::count();
        $totalPemagang = User::where('role', 'user')->count();
        $totalPosisi = Position::count();

        return view('pages.users.dashboard', compact('totalPendaftar','totalPemagang', 'totalPosisi'));
    }
}
