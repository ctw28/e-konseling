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
        'konseling_catatan'
    ];

    public function assesmentSesiData()
    {
        return $this->hasOne('App\Models\AssesmentSesi','id','assesment_sesi_id');
    }

    public function konselingJadwalData(){
        return $this->hasMany('App\Models\Konselor\KonselingJadwal','konseling_sesi_id');
    }
    
    
}