<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konselor extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'konselor_bidang',
        'konselor_keterangan'
    ];

    public function userData()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
    
    public function konselingData(){
        return $this->hasMany('App\Models\Admin\KonselingSesi','konselor_id');        
    }

}