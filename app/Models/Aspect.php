<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aspect extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type'];

    public function positionAspects()
    {
        return $this->belongsToMany(Position::class, 'position_aspects', 'aspect_id', 'position_id');
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class, 'aspect_id');
    }

    public function finalScores()
    {
        return $this->hasMany(FinalScore::class, 'aspect_id');
    }

    public function routeName()
    {
        return $this->type === 'technical' ? 'technical-aspects' : 'non-technical-aspects';
    }


}
