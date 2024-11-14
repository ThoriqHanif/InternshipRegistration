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
        'attendance_time',
        'presence',
        'is_late',
        'is_consequence_done',
        'consequence_description',
        'agency',
        'project_name',
        'job',
        'description',
        'status',
        'admin_reason',
    ];

    public function intern()
    {
        return $this->belongsTo(Intern::class);
    }

    public function routeName()
    {
        return 'daily-report';
    }
}
