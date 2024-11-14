<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeTable extends Model
{
    use HasFactory;

    protected $table = 'time_tables';

    protected $fillable = [
        'day',
        'start_time',
        'end_time',
    ];

    public function routeName()
    {
        return 'time-table';
    }
}
