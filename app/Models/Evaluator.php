<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluator extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function evaluationDetails()
    {
        return $this->hasMany(EvaluationDetail::class, 'evaluator_id');
    }

    public function routeName()
    {
        return 'evaluator';
    }
}
