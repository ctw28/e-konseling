<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KonselingSesi extends Model
{
    use HasFactory;

    protected $fillable = [
        'konselor_id',
        'assesment_sesi_id',
        'konseling_kode',
        'konseling_status',
        'konseling_setuju',
        'konseling_catatan'
    ];


    // public function assesmentSesiData()
    // {
    //     return $this->hasOne('App\Models\AssesmentSesi','id','assesment_sesi_id');
    // }
    
    public function assesmentSesiDataLimit()
    {
        return $this->belongsTo('App\Models\AssesmentSesi','assesment_sesi_id')->take(1);
    }
    public function assesmentSesiData()
    {
        return $this->belongsTo('App\Models\AssesmentSesi','assesment_sesi_id');
    }

    public function konselingJadwalData(){
        return $this->hasMany('App\Models\Konselor\KonselingJadwal');
    }
    
    public function konselorData(){
        return $this->belongsTo('App\Models\Admin\Konselor','konselor_id','id');
    }
    
    // public function userData(){
    //     return $this->hasOneThrough('App\Models\User','App\Models\AssesmentSesi');
    // }
    
}