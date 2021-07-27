<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assesment extends Model
{
    use HasFactory;
    protected $table = 'assesments';
    protected $fillable = [
        'no_urut',
        'soal',
        'soal_sebelum',
        'soal_setelah',
        'jenis_aum_id'
    ];

    public function getAssesmentJenisAumById()
    {
        return $this->belongsTo('App\Models\AssesmentJenisAum', 'jenis_aum_id', 'id');
    }
    
    public function getAnswer()
    {
        return $this->belongsTo('App\Models\AssesmentAnswer','assesment_id', 'id');
    }
}