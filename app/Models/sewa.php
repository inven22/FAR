<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class sewa extends Model
{
    use HasFactory;
    protected $table = 'penyewa';

    protected $fillable = [
        'name',
        'email',
        'no_hp',
        'alamat',
        'waktu_sewa',
    ];

    // Define your custom methods here

    public static function customQueryMethod()
    {
        // Example: Using the DB facade for a custom query
        $results = DB::table('penyewa')
            ->select('name', 'email')
            ->where('waktu_sewa', '>=', now())
            ->get();

        return $results;
    }
   
}
