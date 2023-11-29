<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\sewa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class kelolakelaslapangan extends Controller
{ 
    public function index(){
        return view('page.admin.crud.index');
    }
     
    public function addform(){
        return view('page.admin.crud.add');
    }

}
