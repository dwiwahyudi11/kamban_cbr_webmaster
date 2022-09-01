<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diseases extends Model
{
    protected $fillable = [
        'nama_penyakit',
        'gambar',
        'deskripsi',
        'solusi',
    ];

    public function caseStudies()
    {
        return $this->hasMany(CaseStudies::class);
    }
}
