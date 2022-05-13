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
                Nama Pelajaran:
                <input type="text" name="nama" id="edit-pelajaran-nama" class="form-control mb-2" placeholder="Input nama kelas">
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
    <div class="container-fluid">
        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambah-pelajaran"><i class="fas fa-plus mr-1"></i>Tambah Pelajaran</button>
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

        $('#tambah').on('click', function() {
            var name = $('#tambah-pelajaran-nama');
            var description = $('#tambah-pelajaran-deskripsi');
            $.post("{{route('admin.pelajaran.tambah')}}", {
                name: name.val(),
                description: description.val(),
            }, function(data) {
                Swal.fire(data.title, data.message, data.type);
                name.val('');
                description.val('');
                table.ajax.reload();
            });
        });

        $('#edit').on('click', function() {
            var name = $('#edit-pelajaran-nama').val();
            var description = $('#edit-pelajaran-deskripsi').val();
            var id = $('#edit').attr('data-id');
            let url = "{{route('admin.pelajaran.update', 'pelajaran_id')}}";
            url = url.replace(/pelajaran_id/g, id);
            $.post(url, {
                _method: 'put',
                name: name,
                description: description,
            }, function(data) {
                Swal.fire(data.title, data.message, data.type);
                $('#edit-pelajaran').modal('hide');
                table.ajax.reload();
            });
        });

        function editpelajaran(id) {
            let url = "{{route('admin.pelajaran.edit', 'pelajaran_id')}}";
            url = url.replace(/pelajaran_id/g, id);
            $.get(url, function(data) {
                $('#edit-pelajaran-nama').val(data.name);
                $('#edit-pelajaran-deskripsi').val(data.description);
                $('#edit').attr('data-id', id);
                $('#edit-pelajaran').modal('show');
            });
        }

        function deletepelajaran(id) {
            Swal.fire({
                title: 'Kamu yakin?',
                text: "Data akan dihapus secara permanen",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal'
            }).then(function (willDelete) {
                if(willDelete.value) {
                    let url = "{{route('admin.pelajaran.delete', 'pelajaran_id')}}";
                    url = url.replace(/pelajaran_id/g, id);
                    $.post(url, {
                        _method: 'delete',
                    },function(data) {
                        Swal.fire(data.title, data.message, data.type);
                        table.ajax.reload();
                    });
                }
            })
        }
    </script>
@endsection
