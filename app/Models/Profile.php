<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profiles';
    protected $fillable = [
        'profil_nama',
        'profil_slug',
        'profil_isi',
        'profil_oleh'
    ];
}