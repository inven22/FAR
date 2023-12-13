@extends('layouts.base_admin.base_dashboard')@section('judul', 'List Akun')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Tempat Futsal</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 1em;
        }

        main {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            display: grid;
            grid-gap: 10px;
        }

        label {
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        button {
            background-color: #333;
            color: #fff;
            padding: 10px;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>

    <header>
        <h1>Pemesanan Tempat Futsal</h1>
    </header>
    {{-- @php
        $lapangan = \DB::table('lapangans')->first();
    @endphp --}}
    <main>
        <div style="display: flex; align-items: center;">
            <img src="{{ asset('img/Futsal.jpg') }}" alt="" width="250" height="250">
            <div style="margin-left: 10px; margin-top: -160px; font-family: 'Arial';">
                <strong>{{$lapangan->nama}}</strong>
                <br>Deskripsi:{{$lapangan->deskripsi}}
                <br>Waktu:{{$lapangan->waktu}}
            </div>
        </div>
        
        <form method="post" action="{{ route('pemesanan.store', ['lapanganId' => $lapangan->id]) }}">
            @csrf
            <label for="nama">Nama Pemesan:</label>
            <input type="text" id="nama" name="nama" required>

            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required>

            <label for="no_telepon">No Telepon:</label>
            <input type="text" id="no_telepon" name="no_telepon" required>

            <label for="tanggal">Tanggal Main:</label>
            <input type="date" id="tanggal" name="tanggal" required>

            <label for="waktu">Pilih Waktu:</label>
            <input type="time" id="waktu" name="waktu">

            <label for="durasi">Durasi (jam):</label>
            <input type="number" id="durasi" name="durasi" min="1" max="3" required>

            <button type="submit">Pesan</button>
        </form>
    </main>

</body>
</html>

@endsection