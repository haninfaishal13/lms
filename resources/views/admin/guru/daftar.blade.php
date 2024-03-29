@extends('_layout.main_admin')
@section('title-admin')
<title>Daftar Guru</title>
@endsection
@section('style-admin')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endsection
@section('content-admin')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Daftar Guru</h1>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <a href="{{route('admin.guru.daftarakan_guru_create')}}" class="btn btn-primary mb-3"><i class="fas fa-plus mr-1"></i>Tambah Guru</a>
        <table class="table table-bordered table-striped text-center d-none d-lg-table" id="table-guru">
            <thead>
                <th style="width: 1%;">No</th>
                <th style="width:25%">Nama</th>
                <th style="width:30%">Alamat</th>
                <th>Mulai mengajar</th>
                <!-- <th>Mata Pelajaran</th> -->
                <th style="width: 25%;">Action</th>
            </thead>
            <tbody>


            </tbody>
        </table>
    </div><!-- /.container-fluid -->
</section>
@endsection
@section('script-admin')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        var table = $('#table-guru').DataTable({
            processing:true,
            serverSide:true,
            ordering:true,
            ajax:"{{route('admin.dt-guru-aktif')}}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data:'name', name:'name' },
                { data:'address', name:'address' },
                { data:'start_date', name:'start_time' },
                { data:'action', name: 'action' }
            ],
        });
    </script>
@endsection
