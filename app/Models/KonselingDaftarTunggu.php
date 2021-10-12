<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KonselingDaftarTunggu extends Model
{
    use HasFactory;

    protected $fillable = [
        'assesment_sesi_id'
    ];

    public function assesmentSesiData(){
        return $this->belongsTo('App\Models\AssesmentSesi','assesment_sesi_id','id');
    }


}
