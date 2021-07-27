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

    public function getAssesmentById()
    {
        return $this->belongsTo('App\Models\Assesment','assesment_id','id');
    }
    
    public function assesmentSesiData()
    {
        return $this->belongsTo('App\Models\AssesmentSesi','assesment_sesi_id','id');
    }
}