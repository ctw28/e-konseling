<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = [
        'post_judul',
        'post_slug',
        'post_tanggal',
        'post_konten',
        'post_oleh',
        'post_status',
        'post_kategori',
        'post_foto'
    ];
}