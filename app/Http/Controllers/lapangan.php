<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lapang;

class lapangan extends Controller
{
    public function index()
    {
        $la = Lapang::all();
        return view('lapangan.index', compact('la'));
    }

    public function add()
    {
        // Di sini, jika kamu ingin menampilkan data penyewa dari model Penyewa, kamu dapat melakukannya.
        // $all = Penyewa::all();

        return view('lapangan.add');
    }

    public function show()
    {
        
        $lapangan = \DB::table('lapangans')->paginate(20);
        return view('HomeUser',compact('lapangan'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function insert(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'waktu' => 'required',
            'file_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageFile = $request->file('file_image');
        $nama_image_file = time() . '_' . $imageFile->getClientOriginalName();
        $tujuan_upload_image = 'storage/images';
        $imageFile->move($tujuan_upload_image, $nama_image_file);

        Lapang::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'waktu' => $request->waktu,
            'file_image' => $request->file_image,
            'file_path_image' => $tujuan_upload_image . '/' . $nama_image_file,
        ]);

        return redirect()->route('la.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $edit = Lapang::findOrFail($id);
        return view('lapangan.edit', compact('edit'));
    }
    public function update(Request $request, $id)
{
    $request->validate([
        'nama' => 'required',
        'deskripsi' => 'required',
        'waktu' => 'required',
        'file_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $lapangan = Lapang::findOrFail($id);

    if ($request->hasFile('file_image')) {
        $imageFile = $request->file('file_image');
        $nama_image_file = time() . '_' . $imageFile->getClientOriginalName();
        $tujuan_upload_image = 'storage/images';
        $imageFile->move($tujuan_upload_image, $nama_image_file);

        $lapangan->file_image = $request->file_image;
        $lapangan->file_path_image = $tujuan_upload_image . '/' . $nama_image_file;
    }

    $lapangan->nama = $request->nama;
    $lapangan->deskripsi = $request->deskripsi;
    $lapangan->waktu = $request->waktu;
    $lapangan->save();

    return redirect()->route('la.index')->with('success', 'Data berhasil diperbarui!');
}
public function delete($id)
{
    $lapangan = Lapang::findOrFail($id);
    
    if($lapangan->delete()) {
        return redirect()->route('la.index')->with('success', 'Data berhasil dihapus!');
    } else {
        return redirect()->route('la.index')->with('error', 'Gagal menghapus data!');
    }
}
}
