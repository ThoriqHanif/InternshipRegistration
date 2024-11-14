<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PositionAspect extends Model
{
    use HasFactory;

    protected $table = 'position_aspects';
    protected $fillable = ['position_id', 'aspect_id'];

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

    public function aspect()
    {
        return $this->belongsTo(Aspect::class, 'aspect_id');
    }

}
