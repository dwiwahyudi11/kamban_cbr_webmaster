<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CaseStudies extends Model
{
    protected $fillable = [
        'diseases_id',
        'symptoms_id',
    ];

    public $timestamps = false;

    public function disease()
    {
        return $this->belongsTo(Diseases::class, 'diseases_id', 'id');
    }

    public function symptom()
    {
        return $this->belongsTo(Symptoms::class, 'symptoms_id', 'id');
    }
}
