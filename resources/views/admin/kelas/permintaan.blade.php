@extends('_layout.main_admin')
@section('title-admin')
<title>Permintaan Kelas</title>
@endsection
@section('content-admin')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Permintaan Kelas</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container">
    <table class="table table-bordered table-striped text-center d-none d-lg-table" id="table-kelas">
        <thead>
            <th style="width: 1%;">No</th>
            <th style="width:13%">Nama</th>
            <th style="width:13%">Level</th>
            <th>Deskripsi</th>
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
    var table = $('#table-kelas').DataTable({
        processing:true,
        serverSide:true,
        ajax:"{{route('admin.dt-kelas.permintaan')}}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data:'name', name:'name' },
            { data:'level', name: 'level' },
            { data:'description', render: function(data, type, row) {
                if(data == null) {
                    var html = `-`;
                }
                else {
                    var html = ``+data+``;
                }
                return html;
            }},
            { data:'action', name: 'action' }
        ],
    });
</script>

@endsection