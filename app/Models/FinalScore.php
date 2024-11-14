<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinalScore extends Model
{
    use HasFactory;

    protected $table = 'final_scores';
    protected $fillable = ['intern_id', 'aspect_id', 'final_score', 'letter_grade', 'predicate'];

    public function intern()
    {
        return $this->belongsTo(Intern::class, 'intern_id');
    }
    public function aspect()
    {
        return $this->belongsTo(Aspect::class, 'aspect_id');
    }


}
