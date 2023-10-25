<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Position extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'description',
        'requirement'
    ];

    public function requirementsArray()
    {
        return explode(', ', $this->requirements);
    }

    public function interns()
    {
        return $this->hasMany(Intern::class);
    }
}
