<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'documents';

    protected $fillable = [
        'intern_id',
        'name',
        'slug',
        'type',
        'file',
        'note',
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

    public function routeName()
    {
        return 'documents.show';
    }
}
