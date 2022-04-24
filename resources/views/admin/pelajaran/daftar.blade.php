@extends('_layout.main_admin')

@section('title-admin')
<title>Daftar Pelajaran</title>
@endsection

@section('style-admin')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endsection

@section('content-admin')

<div class="modal fade" id="tambah-pelajaran" tabindex="-1" role="dialog" aria-labelledby="tambah-pelajaran" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Nama Kelas:
                <input type="text" name="nama" id="tambah-pelajaran-nama" class="form-control mb-2" placeholder="Input nama kelas">
                Tingkat:
                <select name="level" class="form-control" id="tambah-pelajaran-tingkat"></select>
                Deskripsi:
                <textarea name="deskripsi" id="tambah-pelajaran-deskripsi" cols="30" rows="10" class="form-control" placeholder="Input deskripsi"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="tambah">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-pelajaran" tabindex="-1" role="dialog" aria-labelledby="edit-pelajaran" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Nama Kelas:
                <input type="text" name="nama" id="edit-pelajaran-nama" class="form-control mb-2" placeholder="Input nama kelas">
                Tingkat:
                <select name="level" class="form-control" id="edit-pelajaran-tingkat"></select>
                Deskripsi:
                <textarea name="deskripsi" id="edit-pelajaran-deskripsi" cols="30" rows="10" class="form-control" placeholder="Input deskripsi"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="edit">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Daftar Pelajaran</h1>
            </div>
        </div>
    </div>
</div>


<section class="content">
    <div class="container">
        <button class="btn btn-primary mb-3"><i class="fas fa-plus mr-1"></i>Tambah Pelajaran</button>
        <table class="table table-bordered table-striped text-center d-none d-lg-table" id="tabel-pelajaran">
            <thead>
                <th style="width: 1%;">No</th>
                <th>Nama</th>
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
        var table = $('#tabel-pelajaran').DataTable({
            processing:true,
            serverSide:true,
            ordering:true,
            ajax:"{{route('admin.dt-pelajaran')}}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data:'name', name:'name' },
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