<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konselor extends Model
{
    use HasFactory;
    protected $fillable = [
        'konselor_pegawai_id',
        'konselor_bidang',
        'konselor_keterangan'
    ];
}