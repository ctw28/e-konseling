<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssesmentJenisAum extends Model
{
    use HasFactory;
    protected $table = 'assesment_jenis_aums';
    protected $fillable = [
        'jenis_aum',
        'singkatan'
    ];
}