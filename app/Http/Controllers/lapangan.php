<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class lapangan extends Controller
{
    public function index()
    {
    	$la = DB::table('lapangans')->get();
        return view('lapangan.index',compact('la'));
    } 

    public function Add()
    {
    $all = DB::table('penyewa')->get();
    return view('lapangan.add',compact('all'));
    }
    
    public function insert(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'waktu' => 'required',
            'file_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation rule for images
        
        ]);
    
      // Handle image file upload
      $imageFile = $request->file('file_image');
      $nama_image_file = time() . '_' . $imageFile->getClientOriginalName();
      $tujuan_upload_image = 'storage/images';
      $imageFile->move($tujuan_upload_image, $nama_image_file);

        DB::table('lapangans')->insert([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'waktu' => $request->waktu,
            'file_image' => $request->file_image,
            'file_path_image' => $tujuan_upload_image . '/' . $nama_image_file,
    
        ]);
    
        return Redirect()->route('la.index')->with('success','Add data successfully!');    
    }

    public function Edit($id)
    {
    $edit=DB::table('lapangans')
         ->where('id',$id)
         ->first();
    return view('lapangan.edit', compact('edit'));     
    }
    
    public function Update(Request $request,$id)
    {
         // Handle image file upload
      $imageFile = $request->file('file_image');
      $nama_image_file = time() . '_' . $imageFile->getClientOriginalName();
      $tujuan_upload_image = 'storage/images';
      $imageFile->move($tujuan_upload_image, $nama_image_file);
      
        DB::table('lapangans')->where('id', $id)->first();        
        $data = array();
        $data['nama'] = $request->nama;
        $data['deskripsi'] = $request->deskripsi;  
        $data['waktu'] = $request->waktu;  
        $data['file_image'] = $request->file_image;
        $data['file_path_image'] = $tujuan_upload_image . '/' . $nama_image_file;
      
        $update = DB::table('lapangans')->where('id', $id)->update($data);
    
        if ($update) 
    {
            
            return Redirect()->route('la.index')->with('success','Updated successfully!');                     
    }
        else
    {
        $notification=array
        (
        'messege'=>'error ',
        'alert-type'=>'error'
        );
        return Redirect()->route('la.index')->with($notification);
    }
     
    }

    public function Delete($id)
    {
    
        $delete = DB::table('lapangans')->where('id', $id)->delete();
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
