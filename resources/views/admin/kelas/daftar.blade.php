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

<div class="modal fade" id="tambah-tingkat" tabindex="-1" role="dialog" aria-labelledby="tambah-tingkat" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Tingkat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Nama Tingkat:
                <input type="text" name="nama" id="tambah-tingkat-nama" class="form-control mb-2" placeholder="Input nama kelas">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="tambah_tingkat">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-tingkat" tabindex="-1" role="dialog" aria-labelledby="edit-kelas" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit tingkat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Nama tingkat:
                <input type="text" name="nama" id="edit-tingkat-nama" class="form-control mb-2" placeholder="Input nama kelas">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="edit_tingkat">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                {{-- <h1 class="m-0"><a href="{{route("admin.kelas")}}" class="btn btn-light btn-lg active" id="kelas-page">Kelas</a> | <a href="{{route("admin.tingkat")}}" class="btn btn-light btn-lg" id="tingkat-page">Tingkat</a></h1> --}}
                <h1 class="m-0"><button class="btn btn-light btn-lg active" id="kelas-page">Kelas</button> | <button class="btn btn-light btn-lg" id="tingkat-page">Tingkat</button></h1>
            </div>
        </div>
    </div>
</div>

<section class="content" id="kelas-page-view">
    <div class="container-fluid">
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambah-kelas" id="tambah-kelas-btn"><i class="fas fa-plus mr-1"></i>Tambah Kelas</button>
    <table class="table table-bordered table-striped text-center d-none d-lg-table" id="table-kelas" style="width:100%">
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

<section class="content d-none" id="tingkat-page-view">
    <div class="container-fluid">
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambah-tingkat"><i class="fas fa-plus mr-1"></i>Tambah Tingkat</button>
    <table class="table table-bordered table-striped text-center d-none d-lg-table" id="table-tingkat">
        <thead>
            <th id="tingkat-no" style="width: 1%;">No</th>
            <th id="tingkat-nama">Nama</th>
            <th id="tingkat-action" style="width: 13%;">Action</th>
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

    var table_tingkat = $('#table-tingkat').DataTable({
        processing:true,
        serverSide:true,
        ordering:true,
        ajax:"{{route('admin.dt-tingkat')}}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data:'name', name:'name' },
            { data:'action', name: 'action' }
        ],
    });

    $('#kelas-page').on('click', function() {
        $('#kelas-page').addClass('active');
        $('#tingkat-page').removeClass('active');
        $('#kelas-page-view').removeClass('d-none');
        $('#tingkat-page-view').addClass('d-none');
    });

    $('#tingkat-page').on('click', function() {
        $('#kelas-page').removeClass('active');
        $('#tingkat-page').addClass('active');
        $('#kelas-page-view').addClass('d-none');
        $('#tingkat-page-view').removeClass('d-none');
        $('#table-tingkat').css('width', '100%');
        $('#tingkat-no').css('width', '1%');
        $('#tingkat-action').css('width', '13%');
    });

    $('#tambah-kelas-btn').on('click', function() {
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

    $('#tambah_tingkat').on('click', function() {
        $.post("{{route('admin.tingkat.store')}}", {
            name:$('#tambah-tingkat-nama').val(),
        }, function(data) {
            Swal.fire(data.title, data.message, data.type);
            $('#tambah-tingkat-nama').val('')
            table_tingkat.ajax.reload();
            $('#tambah-tingkat').modal('hide');
        })
    })

    $('#edit_tingkat').on('click', function() {
        var id = $(this).attr('data-id');
        var url = "{{route('admin.tingkat.update', 'tingkat_id')}}";
        url = url.replace(/tingkat_id/g, id);
        $.post(url, {
            _method: 'put',
            name: $('#edit-tingkat-nama').val(),
        }, function(data) {
            Swal.fire(data.title, data.message, data.type);
            table_tingkat.ajax.reload();
            $('#edit-tingkat').modal('hide');
        })
    })

    $('#tambah').on('click', function() {
        $.post("{{route('admin.kelas.tambah')}}", {
            name: $('#tambah-kelas-nama').val(),
            description: $('#tambah-kelas-deskripsi').val(),
            grade_id: $('#tambah-kelas-tingkat').val(),
        }, function(data) {
            Swal.fire(data.title, data.message, data.type)
            table.ajax.reload();
        })
        $('#tambah-kelas-nama').val('');
        $('#tambah-kelas-deskripsi').val('');
        $('#tambah-kelas-tingkat').val('');
        $('#tambah-kelas').modal('hide');
    })

    $('#edit').on('click', function() {
        var id = $(this).attr('data-id');
        var url = "{{route('admin.kelas.update', 'kelas_id')}}";
        url = url.replace(/kelas_id/g, id);
        $.post(url, {
            _method: 'put',
            name: $('#edit-kelas-nama').val(),
            grade_id: $('#edit-kelas-tingkat').val(),
            description: $('#edit-kelas-deskripsi').val(),
        }, function(data) {
            Swal.fire(data.title, data.message, data.type);
            table.ajax.reload();
        });
        $('#edit-kelas-nama').val('');
        $('#edit-kelas-deskripsi').val('');
        $('#edit-kelas-tingkat').val('');
        $('#edit-kelas').modal('hide');
    })

    function edittingkat(id) {
        let url = "{{route('admin.tingkat.edit', 'kelas_id')}}"
        url = url.replace(/kelas_id/g, id);
        $.get(url, function(data) {
            console.log(data);
            $('#edit-tingkat-nama').val(data.name);
            $('#edit_tingkat').attr('data-id', data.id);
            $('#edit-tingkat').modal('show');
        });
    }

    function deletetingkat(id) {
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
                let url = "{{route('admin.tingkat.destroy', 'kelas_id')}}"
                url = url.replace(/kelas_id/g, id);
                $.post(url, {
                    _method: 'delete',
                }, function(data) {
                    Swal.fire(data.title, data.message, data.type);
                    table_tingkat.ajax.reload();
                });
            }
        });
    }

    function editkelas(id) {
        let url = "{{route('admin.kelas.edit', 'kelas_id')}}"
        url = url.replace(/kelas_id/g, id);
        $.get(url, function(data) {
            console.log(data);
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

    function deletekelas(id) {
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
            let url = "{{route('admin.kelas.delete', 'kelas_id')}}"
            url = url.replace(/kelas_id/g, id);
            $.post(url, {
                _method: 'delete',
            }, function(data) {
                Swal.fire(data.title, data.message, data.type);
                table.ajax.reload();
            });
        })
    }
</script>
@endsection
