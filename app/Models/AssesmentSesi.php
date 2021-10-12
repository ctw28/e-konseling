<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssesmentSesi extends Model
{
    use HasFactory;
    protected $table = 'assesment_sesis';

    const CREATED_AT = 'sesi_tanggal';
    protected $fillable = [
        'user_id',
        'sesi_kode',
        'sesi_status',
        'lanjut_konseling',
        'sesi_catatan'
    ];

    public function userData(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }
    
    
    public function assesmentAnswerData(){
        return $this->hasMany('App\Models\AssesmentAnswer');
    }
    
    public function assesmentJawabanData(){
        return $this->hasMany('App\Models\AssesmentAnswer','assesment_sesi_id');
    }

    public function getUpdatedAtColumn() {
        return null;
    }
}