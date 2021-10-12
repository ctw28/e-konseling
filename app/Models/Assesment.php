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
        'assesment_jenis_aum_id'
    ];

    public function answerData(){
        return $this->hasOne('App\Models\AssesmentAnswer');
    }

    public function jenisAumData()
    {
        return $this->belongsTo('App\Models\AssesmentJenisAum');
    }

    public function getAssesmentJenisAumById()
    {
        return $this->belongsTo('App\Models\AssesmentJenisAum', 'assesment_jenis_aum_id', 'id');
    }
    
    public function getAnswer()
    {
        return $this->belongsTo('App\Models\AssesmentAnswer','assesment_id', 'id');
    }
}