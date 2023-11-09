<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    public function index(){

        $currentDate = Carbon::now();

        $activePositions = Position::whereHas('periode', function ($query) use ($currentDate) {
            $query->where('start_date', '<=', $currentDate)
                  ->where('end_date', '>=', $currentDate);
        })->get();
    
        return view('pages.home.index', compact('activePositions'));
    }
}
