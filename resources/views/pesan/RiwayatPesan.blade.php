@extends('layouts.base_admin.base_dashboard')@section('judul', 'List Akun')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 1em;
        }

        section {
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .update-button, .delete-button {
            padding: 8px;
            cursor: pointer;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
        }

        .delete-button {
            background-color: #f44336;
        }
    </style>
</head>
<body>
    <header>
        <h1>Riwayat Pemesanan Futsal</h1>
    </header>

    <section>
        <table>
            <thead>
                <tr>
                    <th>ID Pemesanan</th>
                    <th>Nama Pemesan</th>
                    <th>Email</th>
                    <th>No Telepon</th>
                    <th>Lapangan</th>
                    <th>Tanggal Pemesanan</th>
                    <th>Jam Pemesanan</th>
                    <th>Durasi</th>
                    {{-- <th>Aksi</th> --}}
                </tr>
            </thead>
            <tbody>
                <!-- Isi tabel dengan data pemesanan futsal -->
                @foreach ($pesanan as $pesanan)
                    @php
                        $lapangan = \DB::table('lapangans')->where('id', $pesanan->id_lapangan)->first();
                    @endphp
                    <tr>
                        <td>{{$pesanan->id}}</td>
                        <td>{{$pesanan->nama_penyewa}}</td>
                        <td>{{$pesanan->email}}</td>
                        <td>{{$pesanan->no_hp}}</td>
                        <td>{{$lapangan->nama}}</td>
                        <td>{{$pesanan->tanggal}}</td>
                        <td>{{$pesanan->waktu}}</td>
                        <td>{{$pesanan->durasi}} jam</td>
                        {{-- <td class="action-buttons">
                            <button class="update-button">Update</button>
                            <button class="delete-button">Delete</button>
                        </td> --}}
                    </tr>
                @endforeach

                
                <!-- Tambah baris lain sesuai dengan data pemesanan lainnya -->
            </tbody>
        </table>
    </section>
</body>
</html>
@endsection