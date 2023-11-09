<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;


class Position extends Model
{
    use HasFactory, SoftDeletes, HasSlug;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'description',
        'requirement',
        'image',
    ];

    public function requirementsArray()
    {
        return explode(', ', $this->requirements);
    }

    public function interns()
    {
        return $this->hasMany(Intern::class);
    }

    public function periode()
    {
        return $this->hasMany(Periode::class);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name') // Kolom yang akan digunakan untuk menghasilkan slug
            ->saveSlugsTo('slug'); // Kolom database yang akan menyimpan slug
            // ->allowDuplicateSlugs();
    }
}
