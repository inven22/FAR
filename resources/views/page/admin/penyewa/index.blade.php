@extends('layouts.base_admin.base_dashboard')

@section('judul', 'List Custumer')

@section('script_head')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Custumer</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">Beranda</a>
                        </li>
                        <li class="breadcrumb-item active">Makanan</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0" style="margin: 20px">
                <table id="previewcs" class="table table-striped table-bordered display" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama </th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
@endsection

@section('script_footer')
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#previewcs').DataTable({
                "serverSide": true,
                "processing": true,
                "ajax": {
                    "url": "{{ route('penyewa.Showpenyewa') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {
                        _token: "{{ csrf_token() }}"
                    },
                    "error": function (xhr, error, thrown) {
                        console.error('DataTables Ajax Error:', xhr, error, thrown);
                        // Handle errors more gracefully, e.g., display a user-friendly message
                    }
                },
                "columns": [
                    { "data": "id" },
                    { "data": "nama_penyewa" },
                    { "data": "email" },
                    { 
                        "data": "options",
                        "orderable": false,
                        "searchable": false
                    },
                ],
                "language": {
                    // ... Your language settings ...
                },
                "error": function (xhr, error, thrown) {
                    console.error('DataTables Error:', xhr, error, thrown);
                    // Handle errors more gracefully, e.g., display a user-friendly message
                }
            });

           
        });
    </script>
@endsection
