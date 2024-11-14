<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'weight', 'has_technical_aspects', 'has_non_technical_aspects'];

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }

    public function routeName()
    {
        return 'task';
    }

}
