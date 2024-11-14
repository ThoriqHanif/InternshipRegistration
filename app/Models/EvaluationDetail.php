<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationDetail extends Model
{
    use HasFactory;

    protected $table = 'evaluation_details';
    protected $fillable = ['evaluation_id', 'evaluator_id', 'score'];

    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class, 'evaluation_id');
    }

    public function evaluator()
    {
        return $this->belongsTo(Evaluator::class, 'evaluator_id');
    }
}
