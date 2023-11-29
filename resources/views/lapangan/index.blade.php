@extends('layouts.crud')@section('judul', 'List Custumer')
@section('content')
    <h3>Data Lapangan</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header py-2">
                    {{-- <a href="{{ route('') }}" class="btn btn-primary">Export Data</a>
                    <a href="{{ URL::to('') }}" class="btn btn-primary">Import Data</a> --}}
                </div>
                <br>

                <!-- /.card-header -->

                <div class="table-responsive text-nowrap">

                    <br>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Lapangan</th>
                                <th>Deskripsi</th>
                                <th>Waktu batas sewa</th>
                                <th>Foto lapangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        @foreach ($la as $index => $row)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $row->nama }}</td>
                                <td> {{ $row->deskripsi }} </td>
                                <td> {{ $row->waktu}} </td>
                                <td>
                                    @if ($row->file_path_image)
                                        <!-- Adjust the width and height as needed -->
                                        <img src="{{ asset($row->file_path_image) }}" alt="Gambar Buku" style="max-width: 100px; max-height: 100px;">
                                    @else
                                        <p>No Image Available</p>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('la.edit', $row->id) }}" class="btn btn-sm btn-success">edit</a>
                                    <a href="{{ URL::to('delete/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete" class="middle-align">Delete</a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama Lapangan</th>
                                <th>Kapasitas</th>
                                <th>Waktu batas sewa</th>
                                <th>Foto Lapangan</th>
                                <th>aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
