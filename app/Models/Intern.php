<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Intern extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'interns';

    protected $fillable = [
        'email',
        'reg_number',
        'full_name',
        'username',
        'phone_number',
        'address',
        'gender',
        'school',
        'major',
        'start_date',
        'end_date',
        'position_id',
        'periode_id',
        'url',
        'cv',
        'motivation_letter',
        'cover_letter',
        'portfolio',
        'photo',
        'status',
        'user_id',
        'messages',
        'registration_date'
    ];

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getDeletedUserIdAttribute()
    {
        return $this->attributes['user_id'];
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class, 'periode_id');
    }

    public function document()
    {
        return $this->hasMany(Document::class);
    }

    public function social_medias()
    {
        return $this->hasMany(SocialMedia::class);
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function finalScores()
    {
        return $this->hasMany(FinalScore::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($intern) {
            DB::transaction(function () use ($intern) {
                $year = date('Y', strtotime($intern->start_date));
                $initials = substr(strtoupper($intern->full_name), 0, 3);
                $regNumber = $year . $initials;

                $latestIntern = Intern::withTrashed()
                    ->where('reg_number', 'LIKE', $regNumber . '%')
                    ->latest()
                    ->first();

                if ($latestIntern) {
                    $lastNumber = intval(substr($latestIntern->reg_number, -2));
                    $regNumber .= str_pad($lastNumber + 1, 2, '0', STR_PAD_LEFT);
                } else {
                    $regNumber .= '01';
                }
                $intern->reg_number = $regNumber;
            });
        });
    }

    public function routeName()
    {
        return 'interns';
    }
}
