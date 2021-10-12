<?php

namespace App\Models\Konselor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KonselingJadwal extends Model
{
    use HasFactory;
    protected $fillable = [
        'konseling_sesi_id',
        'konseling_tanggal',
        'konseling_catatan'
    ];

    public function konselingSesiData(){
        return $this->belongsTo('App\Models\Admin\KonselingSesi','konseling_sesi_id');
    }
    // public function setKonselingTanggalAttribute($value)
    // {
    //     $this->attributes['konseling_tanggal'] = \Carbon\Carbon::parse($value)->translatedFormat('l, d F Y');
    // }

    // public function getKonselingTanggalAttribute($value)
    // {
    //     return $value;
    // }
}