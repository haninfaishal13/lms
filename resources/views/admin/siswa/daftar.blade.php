@extends('_layout.main_admin')

@section('title-admin')
<title>Daftar Siswa</title>
@endsection

@section('style-admin')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link  href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content-admin')
<div class="modal fade" id="tambah-siswa" tabindex="-1" role="dialog" aria-labelledby="tambah-mapel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Atur Mata Pelajaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    Nama:
                    <select name="name" class="form-control select2" id="tambah-siswa-nama" style="width:100%;"></select>
                </div>
                <div class="form-group">
                    Tingkat:
                    <select name="lesson" class="form-control select2 py-2" id="tambah-siswa-tingkat" style="width:100%;"></select>
                </div>
                <div class="form-group">
                    Kelas:
                    <select name="lesson" class="form-control select2 py-2" id="tambah-siswa-kelas" style="width:100%;"></select>
                </div>
                <div class="form-group">
                    Jurusan:
                    <select name="major" class="form-control select2 py-2" id="tambah-siswa-jurusan" style="width:100%;"></select>
                </div>
                <div class="form-group">
                    Tanggal Mulai:
                    <input type="text" name="start_date" id="start_date" placeholder="Tanggal mulai" class="form-control date">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="atur-siswa">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Daftar Siswa</h1>
                <button class="btn btn-primary mb-2" data-toggle="modal" data-target="#tambah-siswa"><i class="fas fa-plus mr-2"></i> Tambah Siswa Terdaftar</button>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <table class="table table-bordered table-striped text-center d-none d-lg-table" id="table-siswa">
            <thead>
                <th style="width: 1%;">No</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Jurusan</th>
                <th>Alamat</th>
                <th>Tanggal mulai</th>
                <th>Tanggal selesai</th>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
    <script>
        var table = $('#table-siswa').DataTable({
            processing:true,
            serverSide:true,
            ordering:true,
            ajax:"{{route('admin.dt-siswa-aktif')}}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data:'name', name:'name' },
                { data:'grade_cluster', name:'grade_cluster' },
                { data:'major', name:'major' },
                { data:'address', name: 'address'},
                { data:'start_date', name:'start_date' },
                { data:'end_date', name:'end_date' },
                { data:'action', name: 'action' }
            ],
        });

        $('.date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
        });

        // <============== Select2 Tambah =============>
        $('#tambah-siswa-nama').select2({
            placeholder: 'Pilih Kelas',
            ajax: {
                url: "{{route('admin.select2.student')}}",
                type: 'post',
                dataType: 'json',
                data: function(params) {
                    return {
                        search:params.term,
                    }
                },
                processResults: function(response) {
                    return {
                        results: response,
                    };
                },
                cache: true,
            }
        });

        $('#tambah-siswa-tingkat').select2({
            placeholder: 'Pilih tingkat',
            ajax: {
                url: "{{route('admin.select2.grade')}}",
                type: 'post',
                dataType: 'json',
                data: function(params) {
                    return {
                        search:params.term,
                    }
                },
                processResults: function(response) {
                    return {
                        results: response,
                    };
                },
                cache: true,
            }
        });

        $('#tambah-siswa-tingkat').on('change', function() {
            $('#tambah-siswa-kelas').val('').trigger('change');
            $('#tambah-siswa-kelas').select2({
                placeholder: 'Pilih Kelas',
                ajax: {
                    url: "{{route('admin.select2.grade_cluster')}}",
                    type: 'post',
                    dataType: 'json',
                    data: function(params) {
                        return {
                            grade_id: $('#tambah-siswa-tingkat').val(),
                            search:params.term,
                        }
                    },
                    processResults: function(response) {
                        return {
                            results: response,
                        };
                    },
                    cache: true,
                }
            });
        })

        $('#tambah-siswa-jurusan').select2({
            placeholder: 'Pilih Kelas',
            ajax: {
                url: "{{route('admin.select2.major')}}",
                type: 'post',
                dataType: 'json',
                data: function(params) {
                    return {
                        search:params.term,
                    }
                },
                processResults: function(response) {
                    return {
                        results: response,
                    };
                },
                cache: true,
            }
        });

        $('#atur-siswa').on('click', function() {
            var user_id = $('#tambah-siswa-nama').val();
            var grade_cluster_id = $('#tambah-siswa-kelas').val();
            var major_id = $('#tambah-siswa-jurusan').val();
            $.post("{{route('admin.siswa.store')}}", {
                user_id: user_id,
                grade_cluster_id: grade_cluster_id,
                major_id: major_id,
            }, function(data) {
                Swal.fire(data.title, data.message, data.type);
                table.ajax.reload();
                $('#tambah-siswa').modal('hide');
            });
            $('#tambah-siswa-nama').val('').trigger('change');
            $('#tambah-siswa-kelas').val('').trigger('change');
            $('#tambah-siswa-jurusan').val('').trigger('change');
            $('#tambah-siswa-tingkat').val('').trigger('change');
        })

    </script>

@endsection
