<?php

namespace App\Http\Controllers;

use App\Models\Intern;
use App\Models\Position;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    public function index(){

        $currentDate = Carbon::now();

        $totalPendaftar = Intern::count();
        $posisiTersedia = Position::whereHas('periode', function ($query) use ($currentDate) {
            $query->where('start_date', '<=', $currentDate)
                ->where('end_date', '>=', $currentDate)
                ->where('quota', '>', 0); // Kuota yang masih tersedia
        })->count();
        $pemagangDiterima = Intern::where('status','diterima')->count();

        $activePositions = Position::whereHas('periode', function ($query) use ($currentDate) {
            $query->where('end_date', '>=', $currentDate);
        })->get();

        // $comingSoon = Position::whereHas('periode', function($query) use ($currentDate){
        //     $query->where('start_date', '=>', $currentDate);
        // });
    
        return view('pages.home.index', compact('activePositions', 'totalPendaftar','posisiTersedia','pemagangDiterima', 'currentDate'));
    }
}
