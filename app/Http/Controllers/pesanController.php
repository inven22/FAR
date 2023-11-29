<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class pesanController extends Controller
{
    public function pesan(Request $request){
        $query = $request->input('query');

        $cari = DB::table('lapangans')
            ->where(function ($q) use ($query) {
            $q->where('nama', 'LIKE', '%' . $query . '%')
            ->orWhere('deskripsi', 'LIKE', '%' . $query . '%')
            ->Where('id', 'LIKE', '%' . $query . '%');
           
                    
            })
            ->get();
    
        return view('pesan.index', compact('cari'));
    }
}
