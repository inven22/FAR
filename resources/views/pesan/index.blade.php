@extends('layouts.base_admin.base_dashboard')@section('judul', 'List Akun')
@section('content')
<style>
    .search-form {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
    }

    .search-input {
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .search-button {
        padding: 8px 12px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .search-results {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        margin: 0 -10px;
    }

    .search-results h2 {
        font-size: 18px;
        margin-bottom: 20px;
        text-align: center;
        width: 100%;
    }

    .data-card {
        flex: 0 0 calc(33.33% - 20px);
        max-width: calc(33.33% - 20px);
        margin: 10px;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
        background-color: #fff;
    }

    .data-card:hover {
        transform: translateY(-5px);
    }

    .data-card p {
        margin: 5px 0;
    }

    .data-card p strong {
        font-weight: bold;
    }

    @media (max-width: 767px) {
        .data-card {
            flex-basis: calc(50% - 20px);
            max-width: calc(50% - 20px);
        }
    }

    @media (max-width: 575px) {
        .data-card {
            flex-basis: calc(100% - 20px);
            max-width: calc(100% - 20px);
        }
    }

    .data-card {
        display: flex;
        flex-direction: row;
        align-items: center;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Menambahkan shadow */
        background-color: #fff;
        border-radius: 8px;
        padding: 20px;
        margin: 10px;
    }
    .book-image {
        flex: 0 0 200px;
        max-width: 200px;
        margin-left: 25px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Menambahkan shadow */
    }
</style>
<br>
<br>
<div class="search-form">
    <form action="{{ URL::to('pesan') }}" method="GET">
        <input type="text" name="query" placeholder="Cari lapangan" class="search-input" />
        <button type="submit" class="search-button">Cari</button>
    </form>
</div>

@if(isset($cari))
    <div class="search-results">
        @if(count($cari) > 0)
          
            @foreach ($cari as $row)
                <div class="data-card">
                    <div>
                        <p><strong>Nama lapangan </strong> {{ $row->nama }}</p>
                        <p><strong>Deskripsi </strong> {{ $row->deskripsi }}</p>
                       <br>
                       <br>
                       <br>
                       <br>
                        {{-- <a href="{{ route('data.detail', $row->id) }}" class="btn btn-sm btn-info">Detail Buku</a> --}}
                       
                        <br>
                       
                        <!-- Add more data fields as needed -->
                        <a href="" class="btn btn-sm btn-info">Pesan lapangan</a>
                        <td class="align-middle">
                            
                            {{-- <button class="btn btn-sm btn-primary copy-link-btn" data-link="{{ $row->link }}">
                                <i class="fas fa-copy"></i> Copy Link
                            </button>
                            <span class="copy-status"></span> --}}
                        </td>
                    </div>

                    <!-- Menampilkan gambar cover buku -->
                    <img src="{{ asset($row->file_path_image) }}" alt="cv" class="book-image">
                </div>
            @endforeach
        @else
            <p>Tidak ada hasil yang ditemukan.</p>
        @endif
    </div>

@endif

@endsection