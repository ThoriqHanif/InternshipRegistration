<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradeRange extends Model
{
    use HasFactory;

    protected $table = 'grade_ranges';

    protected $fillable = ['min', 'max', 'letter_grade', 'predicate'];

    /**
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param float $score
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForScore($query, $score)
    {
        return $query->where('min', '<=', $score)
                     ->where('max', '>=', $score)
                     ->first();
    }
}
