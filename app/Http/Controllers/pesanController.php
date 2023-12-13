<?php

namespace App\Http\Controllers;
use App\Models\Lapang;
use Illuminate\Http\Request;
use App\Models\pesan;
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

    public function store(Request $request, $lapanganId)
    {
        // Validasi data yang diterima dari formulir
        $validatedData = $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email',
            'no_telepon' => 'required|string',
            'tanggal' => 'required|date',
            'waktu' => 'nullable|date_format:H:i', // Jika diisi, pastikan format waktu benar
            'durasi' => 'required|integer|min:1|max:3',
        ]);

        // Simpan data pemesanan ke dalam database
        $pemesanan = new pesan();
        $pemesanan->nama_penyewa = $validatedData['nama'];
        $pemesanan->email = $validatedData['email'];
        $pemesanan->no_hp = $validatedData['no_telepon'];
        $pemesanan->tanggal = $validatedData['tanggal'];
        $pemesanan->waktu = $validatedData['waktu'];
        $pemesanan->durasi = $validatedData['durasi'];
        $pemesanan->id_lapangan = $lapanganId;
        $pemesanan->save();

        // Redirect atau tampilkan pesan sukses, sesuai kebutuhan
        return redirect()->route('pesan', $lapanganId)->with('success', 'Pemesanan berhasil disimpan.');
    }

    public function laporan($lapanganId)
    {
        // Ambil data pemesanan berdasarkan lapangan_id
        $laporanPemesanan = pesan::where('lapangan_id', $lapanganId)->get();

        // Tampilkan data pemesanan atau proses sesuai kebutuhan
        return view('laporan.index', ['laporanPemesanan' => $laporanPemesanan]);
    }

    public function RiwayatIndex(){
        $pesanan = \DB::table('pesans')->paginate(10);
        return view('pesan.RiwayatPesan', compact('pesanan'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    

    public function index($id){
        $lapangan = Lapang::findOrFail($id);

        return view('pesan.halamanPesan', compact('lapangan'));
    }
}
