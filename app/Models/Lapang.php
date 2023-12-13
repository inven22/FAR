<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lapang extends Model
{
    protected $table = 'lapangans';
    protected $fillable = ['nama', 'deskripsi', 'waktu', 'file_image', 'file_path_image'];
}
