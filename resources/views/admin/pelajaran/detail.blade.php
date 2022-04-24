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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Sub Pelajaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action=""></form>
            <div class="modal-body">
                Nama Sub Pelajaran:
                <input type="text" name="nama" id="tambah-pelajaran-nama" class="form-control mb-2" placeholder="Input nama kelas">
                Nama Pelajaran:
                <select name="lesson_id" class="form-control" id="tambah-pelajaran-pelajaran">
                    <option value="{{$lesson->id}}">{{$lesson->name}}</option>
                </select>
                Tingkat:
                <select name="grade_id" class="form-control" id="tambah-pelajaran-tingkat">
                    @foreach($grade as $grad)
                        <option value="{{ $grad->id }}">{{$grad->name}}</option>
                    @endforeach
                </select>
                Major:
                <select name="major_id" class="form-control" id="tambah-pelajaran-jurusan">
                    @foreach($major as $maj)
                        <option value="{{$maj->id}}">{{$maj->name}}</option>
                    @endforeach
                </select>
                Deskripsi:
                <textarea name="description" class="form-control" id="tambah-pelajaran-deskripsi" cols="30" rows="10"></textarea>
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
                <h1 class="m-0">{{$lesson->name}}</h1>
            </div>
        </div>
    </div>
</div>


<section class="content">
    <div class="container">
        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambah-pelajaran"><i class="fas fa-plus mr-1"></i>Tambah Sub Pelajaran</button>
        <table class="table table-bordered table-striped text-center d-none d-lg-table" id="tabel-pelajaran">
            <thead>
                <th style="width: 1%;">No</th>
                <th>Nama</th>
                <th>Tingkat</th>
                <th>Jurusan</th>
                <th style="width: 30%">Deskripsi</th>
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
            ajax:"{{route('admin.dt-pelajaran-show', $lesson->id)}}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data:'name', name:'name' },
                { data:'grade', name:'grade' },
                { data:'major', name:'major' },
                { data:'description', name:'description' },
                { data:'action', name: 'action' }
            ],
        });

        $('#tambah').on('click', function() {
            var lesson_id = $('#tambah-pelajaran-pelajaran').val();
            var grade_id = $('#tambah-pelajaran-tingkat').val();
            var major_id = $('#tambah-pelajaran-jurusan').val();
            var name = $('#tambah-pelajaran-nama').val();
            var description = $('#tambah-pelajaran-deskripsi').val();
            $.post("{{route('admin.pelajaran-grade-major.tambah')}}", {
                lesson_id: lesson_id,
                grade_id: grade_id,
                major_id: major_id,
                name: name,
            }, function(data) {
                $('#tambah-pelajaran').modal('hide');
                Swal.fire(
                    data.title, 
                    data.message,
                    data.type
                );
                table.ajax.reload()
            })
        })
    </script>
@endsection