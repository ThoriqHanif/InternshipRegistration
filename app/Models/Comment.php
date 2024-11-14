<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';
    protected $fillable = [
        'blog_id',
        'user_id',
        'parent_id',
        'name',
        'email',
        'message'
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function routeName()
    {
        return 'comment';
    }
}
