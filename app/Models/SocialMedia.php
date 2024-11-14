<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    use HasFactory;

    protected $table = 'social_medias';
    protected $fillable = ['intern_id', 'name', 'url', 'icon'];

    public function intern()
    {
        return $this->belongsTo(Intern::class);
    }
}
