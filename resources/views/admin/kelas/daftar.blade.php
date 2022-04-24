@extends('_layout.main_admin')

@section('title-admin')
<title>Kelas</title>
@endsection

@section('style-admin')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endsection

@section('content-admin')
<div class="modal fade" id="tambah-kelas" tabindex="-1" role="dialog" aria-labelledby="tambah-kelas" aria-hidden="true">
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
                <input type="text" name="nama" id="tambah-kelas-nama" class="form-control mb-2" placeholder="Input nama kelas">
                Tingkat:
                <select name="level" class="form-control" id="tambah-kelas-tingkat"></select>
                Deskripsi:
                <textarea name="deskripsi" id="tambah-kelas-deskripsi" cols="30" rows="10" class="form-control" placeholder="Input deskripsi"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="tambah">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-kelas" tabindex="-1" role="dialog" aria-labelledby="edit-kelas" aria-hidden="true">
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
                <input type="text" name="nama" id="edit-kelas-nama" class="form-control mb-2" placeholder="Input nama kelas">
                Tingkat:
                <select name="level" class="form-control" id="edit-kelas-tingkat"></select>
                Deskripsi:
                <textarea name="deskripsi" id="edit-kelas-deskripsi" cols="30" rows="10" class="form-control" placeholder="Input deskripsi"></textarea>
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
                <h1 class="m-0">Kelas</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container">
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambah-kelas"><i class="fas fa-plus mr-1"></i>Tambah Kelas</button>
    <table class="table table-bordered table-striped text-center d-none d-lg-table" id="table-kelas">
        <thead>
            <th style="width: 1%;">No</th>
            <th style="width:13%">Nama</th>
            <th>Deskripsi</th>
            <th style="width: 13%;">Action</th>
        </thead>
        <tbody>
        </tbody>
    </table>
    </div>
</section>
@endsection

@section('script-admin')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    var table = $('#table-kelas').DataTable({
        processing:true,
        serverSide:true,
        ordering:true,
        ajax:"{{route('admin.dt-kelas')}}",
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
        $.post("{{route('admin.kelas.tambah')}}", {
            nama_kelas: $('#tambah-kelas-nama').val(),
            deskripsi_kelas: $('#tambah-kelas-deskripsi').val(),
            level_kelas: $('#tambah-kelas-tingkat').val(),
        }, function(data) {
            table.ajax.reload();
        })
        $('#tambah-kelas-nama').val('');
        $('#tambah-kelas-deskripsi').val('');
        $('#tambah-kelas-tingkat').val('');
        $('#tambah-kelas').modal('hide');
    })

    $(document).ready(function() {
        $.get("{{route('admin.kelas.level')}}", function(data) {
            var option = `<option value="0">Default select</option>`
            var option_edit = ``;
            $.each(data, function(index, value) {
                option += `<option value="`+value.id+`">`+value.name+`</option>`
                option_edit += `<option class="option-edit-kelas" value="`+value.id+`">`+value.name+`</option>`
            });
            $('#tambah-kelas-tingkat').html(option);
            $('#edit-kelas-tingkat').html(option_edit);
        });
    });

    function editkelas(id) {
        var url = "{{route('admin.kelas.edit', 'kelas_id')}}"
        url = url.replace(/kelas_id/g, id);
        $.get(url, function(data) {
            $('#edit-kelas-nama').val(data.name);
            $('.option-edit-kelas').each(function(i, obj) {
                if($(obj).val() == data.grade_level_id) {
                    $(obj).attr('selected', 'selected');
                }
            });
            $('#edit-kelas-deskripsi').val(data.description);
            $('#edit-kelas').modal('show');
        });
        $('#edit').attr('data-id', id);
    }

    $('#edit').on('click', function() {
        var id = $(this).attr('data-id');
        var url = "{{route('admin.kelas.update', 'kelas_id')}}";
        url = url.replace(/kelas_id/g, id);
        $.post(url, {
            _method: 'put',
            nama_kelas: $('#edit-kelas-nama').val(),
            level_kelas: $('#edit-kelas-tingkat').val(),
            deskripsi_kelas: $('#edit-kelas-deskripsi').val(),
        }, function(data) {
            table.ajax.reload();
        });
        $('#edit-kelas-nama').val('');
        $('#edit-kelas-deskripsi').val('');
        $('#edit-kelas-tingkat').val('');
        $('#edit-kelas').modal('hide');
    })
</script>
@endsection