<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;


class Position extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'description',
        'requirement',
        'image',
    ];

    public function requirementsArray()
    {
        return explode(', ', $this->requirements);
    }

    public function interns()
    {
        return $this->hasMany(Intern::class);
    }

    public function periode()
    {
        return $this->hasMany(Periode::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
