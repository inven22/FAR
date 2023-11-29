<?php

namespace App\Http\Controllers;

use App\Models\pesan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class custumer extends Controller
{
    public function index()
    {
        return view('page.admin.penyewa.index');
    }
    
    public function Shompenyewa(Request $request)
    {
        $totalFilteredRecord = $totalDataRecord = 0;
        $columns_list = [
            0 => 'id',
            1 => 'nama_penyewa',
            2 => 'email',
        ];
    
        $totalDataRecord = pesan::count();
        $totalFilteredRecord = $totalDataRecord;
    
        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_column = $columns_list[$request->input('order.0.column')];
        $order_dir = $request->input('order.0.dir');
    
        if (empty($request->input('search.value'))) {
            $custumer_data = pesan::offset($start_val)
                ->limit($limit_val)
                ->orderBy($order_column, $order_dir)
                ->get();
        } else {
            $search_text = $request->input('search.value');
    
            $custumer_data = pesan::where('id', 'LIKE', "%{$search_text}%")
                ->orWhere('nama_penyewa', 'LIKE', "%{$search_text}%")
                ->orWhere('email', 'LIKE', "%{$search_text}%")
                ->offset($start_val)
                ->limit($limit_val)
                ->orderBy($order_column, $order_dir)
                ->get();
    
            $totalFilteredRecord = pesan::where('id', 'LIKE', "%{$search_text}%")
                ->orWhere('nama_penyewa', 'LIKE', "%{$search_text}%")
                ->orWhere('email', 'LIKE', "%{$search_text}%")
                ->count();
        }
    
        $data_val = [];
        if (!empty($custumer_data)) {
            foreach ($custumer_data as $custumer) {
                $url = route('makanan.edit', ['id' => $custumer->id]);
                $urlHapus = route('makanan.delete', $custumer->id);
    
                $csNestedData = [
                    'id' => $custumer->id,
                    'nama_penyewa' => $custumer->nama_penyewa,
                    'email' => $custumer->email,
                    'options' => "<a href='$url'><i class='fas fa-edit fa-lg'></i></a> <a style='border: none; background-color:transparent;' class='hapusData' data-id='$custumer->id' data-url='$urlHapus'><i class='fas fa-trash fa-lg text-danger'></i></a>",
                ];
    
                $data_val[] = $csNestedData;
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
    
}
