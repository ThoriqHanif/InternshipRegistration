<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'intern_id',
        'task_id',
        'aspect_id',
        'total_score',
        'total_inputted',
        'average_score',
        'final_score'
    ];

    public function intern()
    {
        return $this->belongsTo(Intern::class, 'intern_id');
    }

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

    public function aspect()
    {
        return $this->belongsTo(Aspect::class, 'aspect_id');
    }


    public function evaluationDetails()
    {
        return $this->hasMany(EvaluationDetail::class, 'evaluation_id');
    }
}
