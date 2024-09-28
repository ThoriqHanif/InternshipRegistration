<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodePosition extends Model
{
    use HasFactory;

    protected $fillable = ['periode_id', 'position_id', 'quota'];

    // public function periode()
    // {
    //     return $this->belongsTo(Periode::class);
    // }

    // public function position()
    // {
    //     return $this->belongsTo(Position::class);
    // }
}
