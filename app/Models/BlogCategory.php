<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'blog_categories';
    protected $fillable = [
        'name',
        'slug',

    ];

    public function blog()
    {
        return $this->hasMany(Blog::class, 'category_id');
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
