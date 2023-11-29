<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class custumerController extends Controller
{
    public function index()
    {
    	$cus = DB::table('penyewa')->get();
        return view('custumer.index',compact('cus'));
    } 

    public function Add()
    {
    $all = DB::table('penyewa')->get();
    return view('custumer.add',compact('all'));
    }
   
    
    public function insert(Request $request)
    {
        $request->validate([
            'nama_penyewa' => 'required',
            'email' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
        
        ]);
    
    
        DB::table('penyewa')->insert([
            'nama_penyewa' => $request->nama_penyewa,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
    
        ]);
    
        return Redirect()->route('cus.index')->with('success','Add data successfully!');    
    }

    public function Edit($id)
    {
    $edit=DB::table('penyewa')
         ->where('id',$id)
         ->first();
    return view('custumer.edit', compact('edit'));     
    }
   
    public function Update(Request $request,$id)
    {
      
        DB::table('penyewa')->where('id', $id)->first();        
        $data = array();
        $data['nama_penyewa'] = $request->nama_penyewa;
        $data['email'] = $request->email;  
        $data['no_hp'] = $request->no_hp;  
        $data['alamat'] = $request->alamat;  
        $update = DB::table('penyewa')->where('id', $id)->update($data);
    
        if ($update) 
    {
            
            return Redirect()->route('cus.index')->with('success','Updated successfully!');                     
    }
        else
    {
        $notification=array
        (
        'messege'=>'error ',
        'alert-type'=>'error'
        );
        return Redirect()->route('cus.index')->with($notification);
    }
     
    }

    public function Delete($id)
{

    $delete = DB::table('penyewa')->where('id', $id)->delete();
    if ($delete)
                        {
                        $notification=array(
                        'messege'=>'Successfully  Deleted ',
                        'alert-type'=>'success'
                        );
                        return Redirect()->back()->with($notification);                      
                        }
         else
              {
              $notification=array(
              'messege'=>'error ',
              'alert-type'=>'error'
              );
              return Redirect()->back()->with($notification);

              }

  }
}
