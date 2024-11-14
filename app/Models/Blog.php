<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'blogs';

    protected $fillable = [
        'category_id',
        'author_id',
        'title',
        'title_en',
        'slug',
        'slug_en',
        'body',
        'body_en',
        'image_thumbnail',
        'status',
        'is_popular',
        'is_featured',
        'published_at',
    ];

    public function category(){
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function tag()
    {
        return $this->belongsToMany(Tag::class, 'blog_tags');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'blog_id');
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate' => true
            ],
            'slug_en' => [
                'source' => 'title_en',
                'onUpdate' => true
            ]
        ];
    }

    public function routeName()
    {
        return 'blog';
    }
}
