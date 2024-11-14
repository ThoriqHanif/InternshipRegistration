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

    public function periodes()
    {
        return $this->belongsToMany(Periode::class, 'periode_positions')->withPivot('quota');
    }

    public function aspects()
    {
        return $this->belongsToMany(Aspect::class, 'position_aspects', 'position_id', 'aspect_id');
    }

    public function positionAspects()
    {
        return $this->hasMany(PositionAspect::class, 'position_id');
    }

    public function technicalAspects()
    {
        return $this->aspects()->where('type', 'technical');
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function routeName()
    {
        return 'position';
    }
}
