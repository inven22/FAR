<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class crud extends Controller
{
    public function read(){
        return view('crud.index');
    }

    public function addform(){
        return view('crud.add');
    }

    public function editform(){
        return view('crud.edit');
    }
}
