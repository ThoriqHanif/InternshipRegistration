<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    protected $table = 'periodes';
    protected $dates = ['start_date', 'end_date'];

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'description'
    ];

    public function positions()
    {
        return $this->belongsToMany(Position::class, 'periode_positions')->withPivot('quota');
    }

    public function isActive() {
        return $this->start_date <= now() && $this->end_date >= now();
    }

    public function interns()
    {
        return $this->hasMany(Intern::class);
    }


}
