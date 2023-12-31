<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    protected $table = 'periodes';
    
    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'quota',
        'description'
    ];

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function isActive() {
        return $this->start_date <= now() && $this->end_date >= now();
    }

    public function interns()
    {
        return $this->hasMany(Intern::class);
    }

    
}
