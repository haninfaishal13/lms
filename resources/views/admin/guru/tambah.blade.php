@extends('_layout.main_admin')
@section('title-admin')
<title>Daftarkan Guru</title>
@endsection
@section('style-admin')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endsection
@section('content-admin')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Daftar User Guru</h1>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
    <button class="btn btn-primary mb-3"><i class="fas fa-plus mr-1"></i>Tambah User Guru</button>
    <table class="table table-bordered table-striped text-center d-none d-lg-table">
            <thead>
                <th style="width: 1%;">No</th>
                <th>Nama</th>
                <th style="width:50%">Alamat</th>
                <!-- <th>Mata Pelajaran</th> -->
                <th style="width: 13%;">Action</th>
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
        var table = $('.table').DataTable({
            processing:true,
            serverSide:true,
            ordering:true,
            ajax:"{{route('admin.dt-guru-all')}}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data:'name', name:'name' },
                { data:'address', name:'address' },
                { data:'action', name: 'action' }
            ],
        });

        function tambahGuru(id) {
            $.post("{{route('admin.guru.daftarakan_guru')}}", {
                user_id: id,
            }, function(data) {
                Swal.fire(
                    data.title,
                    data.message,
                    data.type,
                );
            });
        }
    </script>
@endsection

