<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class custumerController extends Controller
{

    public function showMakanan(Request $request)
    {
        $totalFilteredRecord = $totalDataRecord = 0;
        $columns_list = [
            0 => 'idMakanan',
            1 => 'namaMakanan',
            2 => 'hargaMakanan',
        ];
    
        $totalDataRecord = Makanan::count();
        $totalFilteredRecord = $totalDataRecord;
    
        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_column = $columns_list[$request->input('order.0.column')];
        $order_dir = $request->input('order.0.dir');
    
        if (empty($request->input('search.value'))) {
            $makanan_data = Makanan::offset($start_val)
                ->limit($limit_val)
                ->orderBy($order_column, $order_dir)
                ->get();
        } else {
            $search_text = $request->input('search.value');
    
            $makanan_data = Makanan::where('idMakanan', 'LIKE', "%{$search_text}%")
                ->orWhere('namaMakanan', 'LIKE', "%{$search_text}%")
                ->orWhere('hargaMakanan', 'LIKE', "%{$search_text}%")
                ->offset($start_val)
                ->limit($limit_val)
                ->orderBy($order_column, $order_dir)
                ->get();
    
            $totalFilteredRecord = Makanan::where('idMakanan', 'LIKE', "%{$search_text}%")
                ->orWhere('namaMakanan', 'LIKE', "%{$search_text}%")
                ->orWhere('hargaMakanan', 'LIKE', "%{$search_text}%")
                ->count();
        }
    
        $data_val = [];
        if (!empty($makanan_data)) {
            foreach ($makanan_data as $makanan_val) {
                $url = route('makanan.edit', ['id' => $makanan_val->idMakanan]);
                $urlHapus = route('makanan.delete', $makanan_val->idMakanan);
    
                $makananNestedData = [
                    'idMakanan' => $makanan_val->idMakanan,
                    'namaMakanan' => $makanan_val->namaMakanan,
                    'hargaMakanan' => $makanan_val->hargaMakanan,
                    'options' => "<a href='$url'><i class='fas fa-edit fa-lg'></i></a> <a style='border: none; background-color:transparent;' class='hapusData' data-id='$makanan_val->idMakanan' data-url='$urlHapus'><i class='fas fa-trash fa-lg text-danger'></i></a>",
                ];
    
                $data_val[] = $makananNestedData;
            }
        }
    
        $draw_val = $request->input('draw');
        $draw = is_numeric($draw_val) ? intval($draw_val) : 0;
    
        $get_json_data = [
            "draw" => $draw,
            "recordsTotal" => intval($totalDataRecord),
            "recordsFiltered" => intval($totalFilteredRecord),
            "data" => $data_val,
        ];
    
        return response()->json($get_json_data);
    }

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
