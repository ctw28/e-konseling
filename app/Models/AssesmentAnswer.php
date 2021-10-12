<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssesmentAnswer extends Model
{
    use HasFactory;
    
    protected $table = 'assesment_jawabans';
    protected $fillable = [
        'assesment_id',
        'assesment_sesi_id',
        'jawaban'
    ];



    public function asesmenData()
    {
        return $this->belongsTo('App\Models\Assesment');
    }

    public function assesmentSesiData()
    {
        return $this->belongsTo('App\Models\AssesmentSesi');
    }

    public function getAssesmentById()
    {
        return $this->belongsTo('App\Models\Assesment','assesment_id','id');
    }
    

    public function answers(){
        return $this->hasManyThrough('App\Models\AssesmentAnswer','App\Models\AssesmentSesi');
    }

}