<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'evaluations';
    protected $fillable = [
        'intern_id',
        'name',
        'slug',
        'file',
        'comment'

    ];

    public function intern()
    {
        return $this->belongsTo(Intern::class);
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
