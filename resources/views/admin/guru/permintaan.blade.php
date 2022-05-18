@extends('_layout.main_admin')

@section('title-admin')
<title>Permintaan Guru</title>
@endsection

@section('style-admin')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endsection

@section('content-admin')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Permintaan Guru</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container">
        <table class="table table-bordered table-striped text-center d-none d-lg-table" id="table-guru">
            <thead>
                <th style="width: 1%;">No</th>
                <th>Nama</th>
                <th>Status sebelumnya</th>
                <th>Status diminta</th>
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
        ajax:"{{route('admin.dt_gantirole', 'teacher')}}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data:'name', name:'name' },
            { data:'role_previous', name:'role_previous' },
            { data:'role_request', name:'role_request' },
            { data:'action', name: 'action' }
        ],
    });

    function accept(id) {
        changerole(id, 1);
    }

    function reject(id) {
        changerole(id, 2);
    }

    function changerole(id, status) {
        $.post("{{route('admin.guru.permintaan.gantiperan')}}", {
            user_change_role_id: id,
            status: status,
        }, function(data) {
            Swal.fire(data.title, data.message, data.type);
            table.ajax.reload();
        });
    }
</script>
@endsection
