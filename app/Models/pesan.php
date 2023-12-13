<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pesan extends Model
{
    use HasFactory;
    /**
    * The table associated with the model.
    *
    * @var string
    */
   protected $table = 'pesans';

   /**
    * The primary key for the model.
    *
    * @var string
    */
   protected $primaryKey = 'id';

   /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
   protected $fillable = [
       'id',
       'nama_penyewa',
       'email',
       'no_hp',
        'tanggal',
       'waktu',
        'durasi',
        'id_lapangan',
      
   ];

   /**
    * The attributes that should be cast.
    *
    * @var array<string, string>
    */
   protected $casts = [
      
   ];
}
