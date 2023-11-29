
@extends('layouts.crud')@section('judul', 'List Custumer')
@section('content')
    <h3>Data Custumer</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header py-2">
                    <a href="{{ route('cus.export') }}" class="btn btn-success">Export</a>
                </div>
                <br>

                <!-- /.card-header -->

                <div class="table-responsive text-nowrap">

                    <br>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Custumer</th>
                                <th>Email custumer</th>
                                <th>No hp</th>
                                <th>Alamat</th>
                              <th>Aksi</th>
                            </tr>
                        </thead>
                        @foreach ($cus as $index => $row)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $row->nama_penyewa }}</td>
                                <td> {{ $row->email }} </td>
                                <td> {{ $row->no_hp }} </td>
                                <td> {{ $row->alamat }} </td>
                                <td>
                                    <a href="{{ route('cus.edit', $row->id) }}" class="btn btn-sm btn-success">edit</a>
                                    <a href="{{ URL::to('delete/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete" class="middle-align">Delete</a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama Custumer</th>
                                <th>Email custumer</th>
                                <th>No hp</th>
                                <th>Alamat</th>
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
