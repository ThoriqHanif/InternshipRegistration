<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'intern_id',
        'date',
        'presence',
        'attendance_hours',
        'agency',
        'project_name',
        'job',
        'description',
    ];

    public function intern()
    {
        return $this->belongsTo(Intern::class);
    }
}
