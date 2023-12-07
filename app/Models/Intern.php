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
        'cv',
        'motivation_letter',
        'cover_letter',
        'position_id',
        'periode_id',
        'portfolio',
        'photo',
        'status',
        'user_id',
        'messages'
    ];

    // public function position()
    // {
    //     return $this->belongsTo(Position::class, 'position_id');
    // }

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

    
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($intern) {
            DB::transaction(function () use ($intern) {
                // Mengambil tahun dari tanggal mulai
                $year = date('Y', strtotime($intern->start_date));

                // Mendapatkan huruf awal dari nama lengkap
                $initials = substr(strtoupper($intern->full_name), 0, 3); // Mengambil 3 huruf pertama dari nama lengkap

                // Menggabungkan tahun dan huruf awal untuk membuat reg_number
                $regNumber = $year . $initials;

                // Mengecek apakah reg_number sudah ada dalam database (termasuk yang dihapus)
                $latestIntern = Intern::withTrashed()
                    ->where('reg_number', 'LIKE', $regNumber . '%')
                    ->latest()
                    ->first();

                if ($latestIntern) {
                    $lastNumber = intval(substr($latestIntern->reg_number, -2)); // Mengambil 2 angka terakhir
                    $regNumber .= str_pad($lastNumber + 1, 2, '0', STR_PAD_LEFT); // Menambahkan nomor unik dengan padding 2 digit
                } else {
                    $regNumber .= '01'; // Jika belum ada reg_number yang sama, gunakan nomor 01
                }
                $intern->reg_number = $regNumber;
            });
        });
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
}
