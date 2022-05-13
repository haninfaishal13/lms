@extends('_layout.main_admin')

@section('title-admin')
<title>Daftar Pelajaran</title>
@endsection

@section('style-admin')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endsection

@section('content-admin')

<div class="modal fade" id="tambah-pelajaran" tabindex="-1" role="dialog" aria-labelledby="tambah-pelajaran" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pengumuman-title">Detail Pengumuman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img alt="" id="pengumuan-header">
                <div id="pengumuman-text"></div>
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
        <a href="{{route('admin.pengumuman.create')}}" class="btn btn-primary mb-3"><i class="fas fa-plus mr-1"></i>Tambah Pelajaran</a>
        <table class="table table-bordered table-striped text-center d-none d-lg-table" id="tabel-pelajaran">
            <thead>
                <th style="width: 1%;">No</th>
                <th>Pengirim</th>
                <th>Kategori</th>
                <th>Judul</th>
                <th>Header</th>
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
            ajax:"{{route('admin.dt-pengumuman-daftar')}}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data:'name', name:'name' },
                { data:'category', name:'category' },
                { data:'title', name:'title' },
                { data:'header', render: function(data, type, row) {
                    let html = `<img src="{{asset('storage/`+data+`')}}" style="max-width:100%">`;
                    return html;
                }},
                { data:'action', name: 'action' }
            ],
        });

        function detailpengumuman(id) {
            let url = "{{route('admin.pengumuman.show', 'pengumuman_id')}}";
            url = url.replace(/pengumuman_id/g, id);

            $.get(url, function(data) {
                $('#pengumuman-title').html(data.title);
                $('#pengumuman-header').attr('src', data.header);
                $('#pengumuman-text').html(data.text);
            })
        }

        function deletepengumuman(id) {
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
                    let url = "{{route('admin.pengumuman.delete', 'pengumuman_id')}}";
                    url = url.replace(/pengumuman_id/g, id);
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
