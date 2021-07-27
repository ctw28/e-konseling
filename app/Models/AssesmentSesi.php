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
        'sesi_catatan'
    ];

    public function assesmentJawabanData(){
        return $this->hasMany('App\Models\Assesment_jawaban','assesment_sesi_id');
    }

    public function getUpdatedAtColumn() {
        return null;
    }
}