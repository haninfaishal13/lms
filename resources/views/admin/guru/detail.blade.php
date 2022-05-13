@extends('_layout.main_admin')

@section('title-admin')
<title>Detail Guru</title>
@endsection

@section('style-admin')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link  href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css">

@endsection

@section('content-admin')
<div class="modal fade" id="tambah-mapel" tabindex="-1" role="dialog" aria-labelledby="tambah-mapel" aria-hidden="true">
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
                    Tingkat:
                    <select name="level" class="form-control select2" id="tambah-mapel-tingkat" style="width:100%;"></select>
                </div>
                <div class="form-group">
                    Jurusan:
                    <select name="major" class="form-control select2 py-2" id="tambah-mapel-jurusan" style="width:100%;"></select>
                </div>
                <div class="form-group">
                    Pelajaran:
                    <select name="lesson" class="form-control select2 py-2" id="tambah-mapel-pelajaran" style="width:100%;"></select>
                </div>
                <div class="form-group">
                    Sub Pelajaran:
                    <select name="sub_lesson" class="form-control" id="tambah-mapel-subpelajaran"></select>
                </div>
                <div class="form-group">
                    Tanggal Mulai:
                    <input type="text" name="start_date" id="start_date" placeholder="Tanggal mulai" class="form-control date">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="atur-mapel">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-mapel" tabindex="-1" role="dialog" aria-labelledby="edit-mapel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Mata Pelajaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    Tingkat:
                    <select name="level" class="form-control" id="edit-mapel-tingkat" style="width:100%;"></select>
                </div>
                <div class="form-group">
                    Jurusan:
                    <select name="major" class="form-control" id="edit-mapel-jurusan" style="width:100%;"></select>
                </div>
                <div class="form-group">
                    Pelajaran:
                    <select name="lesson" class="form-control" id="edit-mapel-pelajaran" style="width:100%;"></select>
                </div>
                <div class="form-group">
                    Sub Pelajaran:
                    <select name="sub_lesson" class="form-control" id="edit-mapel-subpelajaran"></select>
                </div>
                <div class="form-group">
                    Tanggal Mulai:
                    <input type="text" name="start_date" id="edit_start_date" placeholder="Tanggal mulai mengajar" class="form-control date">
                </div>
                <button class="btn btn-outline-primary btn-sm" id="end-date-btn">Guru tidak mengajar lagi?</button>
                <div class="form-group d-none" id="end-date-field">
                    <div class="d-flex justify-content-between">
                        Tanggal Selesai:
                        <button class="btn btn-light btn-sm" id="end-date-remove"><i class="fas fa-times mask"></i></button>
                    </div>
                    <input type="text" name="end_date" id="edit_end_date" placeholder="Tanggal selesai mengajar" class="form-control date">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="atur-edit-mapel">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{$teacher->user->name}}</h1>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->

<section class="content">
    <div class="container-fluid">
    <h4>Mata Pelajaran yang diampu</h4>
    <button class="btn btn-primary mb-2" data-toggle="modal" data-target="#tambah-mapel"><i class="fas fa-plus mr-2"></i> Tambah Mata pelajaran</button>
    <table class="table table-bordered table-striped text-center d-none d-lg-table">
            <thead>
                <th style="width: 1%;">No</th>
                <th>Pelajaran</th>
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
        var table = $('.table').DataTable({
            processing:true,
            serverSide:true,
            ordering:true,
            ajax:"{{route('admin.dt-guru-mapel', $teacher->id)}}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                // { data:'name', name:'name' },
                { data:'lesson', name:'lesson' },
                { data:'start_time', name:'start_time' },
                { data:'end_time', name:'end_time' },
                { data:'action', name: 'action' }
            ],
        });

        // <============== Select2 Tambah =============>
        $('#tambah-mapel-tingkat').select2({
            placeholder: 'Pilih Kelas',
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

        $('#tambah-mapel-jurusan').select2({
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

        $('#tambah-mapel-pelajaran').select2({
            placeholder: 'Pilih Kelas',
            ajax: {
                url: "{{route('admin.select2.lesson')}}",
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

        // <============== Select2 Tambah =============>
        $('#edit-mapel-tingkat').select2({
            placeholder: 'Pilih Kelas',
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

        $('#edit-mapel-jurusan').select2({
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

        $('#edit-mapel-pelajaran').select2({
            placeholder: 'Pilih Kelas',
            ajax: {
                url: "{{route('admin.select2.lesson')}}",
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

        $('.date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
        });



        $('#tambah-mapel-tingkat').on('change', function() {
            getLessonGradeMajor($('#tambah-mapel-tingkat').val(), $('#tambah-mapel-jurusan').val(), $('#tambah-mapel-pelajaran').val(), 'add')
        });

        $('#tambah-mapel-jurusan').on('change', function() {
            getLessonGradeMajor($('#tambah-mapel-tingkat').val(), $('#tambah-mapel-jurusan').val(), $('#tambah-mapel-pelajaran').val(), 'add')
        });

        $('#tambah-mapel-pelajaran').on('change', function() {
            getLessonGradeMajor($('#tambah-mapel-tingkat').val(), $('#tambah-mapel-jurusan').val(), $('#tambah-mapel-pelajaran').val(), 'add')
        });

        $('#edit-mapel-tingkat').on('change', function() {
            getLessonGradeMajor($('#edit-mapel-tingkat').val(), $('#edit-mapel-jurusan').val(), $('#edit-mapel-pelajaran').val(), 'edit')
        });

        $('#edit-mapel-jurusan').on('change', function() {
            getLessonGradeMajor($('#edit-mapel-tingkat').val(), $('#edit-mapel-jurusan').val(), $('#edit-mapel-pelajaran').val(), 'edit')
        });

        $('#edit-mapel-pelajaran').on('change', function() {
            getLessonGradeMajor($('#edit-mapel-tingkat').val(), $('#edit-mapel-jurusan').val(), $('#edit-mapel-pelajaran').val(), 'edit')
        });

        $('#atur-mapel').on('click', function() {
            $.post("{{route('admin.guru.detail.atur_mapel', $teacher->id)}}", {
                lesson_grade_major_id: $('#tambah-mapel-subpelajaran').val(),
                start_date: $('#start_date').val(),
            }, function(data) {
                Swal.fire(
                    data.title, data.message, data.type
                );
                table.ajax.reload();
                $('#tambah-mapel-tingkat').val('0').change();
                $('#tambah-mapel-jurusan').val('0').change();
                $('#tambah-mapel-pelajaran').val('').change();
                $('#start_date').val('').change();
            });
        });

        $('#atur-edit-mapel').on('click', function() {
            var id = $('#atur-edit-mapel').attr('data-id');
            let url = "{{route('admin.guru.detail.update_mapel', 'mapel_id')}}";
            url = url.replace(/mapel_id/g, id);

            $.post(url, {
                _method: 'put',
                lesson_grade_major_id: $('#edit-mapel-subpelajaran').val(),
                start_time: $('#edit_start_date').val(),
                end_time: $('#edit_end_date').val(),
            }, function(data) {
                Swal.fire(data.title, data.message, data.type);
                table.ajax.reload();
                $('#edit-mapel-tingkat').val('0').change();
                $('#edit-mapel-jurusan').val('0').change();
                $('#edit-mapel-pelajaran').val('').change();
                $('#edit_start_date').val('').change();
                $('#edit_end_date').val('').change();
                $('#edit-mapel').modal('hide');
            })
        })

        $('#end-date-btn').on('click', function() {
            $('#end-date-field').removeClass('d-none');
        })

        $('#end-date-remove').on('click', function() {
            $('#end-date-field').addClass('d-none');
            $('#edit_end_date').val('');
        })

        function getLessonGradeMajor(grade_id, major_id, lesson_id, usage) {
            // console.log([grade_id, major_id, lesson_id]);
            if(grade_id != null && major_id != null && lesson_id != null) {
                $.post("{{route('admin.pelajaran-grade-major.get')}}", {
                    grade_id: grade_id,
                    major_id: major_id,
                    lesson_id: lesson_id,
                },function(data) {
                    let html = ``;
                    $.each(data, function(index, value) {
                        html += `<option value="`+value.id+`">`+value.name+`</option>`
                    })
                    if(usage == 'add') {
                        $('#tambah-mapel-subpelajaran').html(html);
                    }
                    else if(usage == 'edit') {
                        $('#edit-mapel-subpelajaran').html(html);
                    }
                });
            }
        }

        function editmapelguru(id) {
            let url = "{{route('admin.guru.detail.edit_mapel', 'mapel_id')}}"
            url = url.replace(/mapel_id/g, id);
            $.get(url, function(data) {
                console.log([data.grade, data.lesson, data.major, data.lesson_grade_major]);
                $('#edit-mapel-pelajaran').append(`<option value="`+data.lesson.id+`" selected>`+data.lesson.name+`</option>`);
                $('#edit-mapel-tingkat').append(`<option value="`+data.grade.id+`" selected>`+data.grade.name+`</option>`);
                $('#edit-mapel-jurusan').append(`<option value="`+data.major.id+`" selected>`+data.major.name+`</option>`);
                $('#edit-mapel-subpelajaran').append(`<option value="`+data.lesson_grade_major.id+`" selected>`+data.lesson_grade_major.name+`</option>`);
                $('#edit_start_date').val(data.user_teach_lesson.start_date);
                if(data.user_teach_lesson.end_date != null) {
                    $('#edit_end_date').val(data.user_teach_lesson.end_date);
                }
                $('#atur-edit-mapel').attr('data-id', data.user_teach_lesson.id);
                $('#edit-mapel').modal('show');
            });
            $('#edit').attr('data-id', id);
        }

        function deletemapelguru(id) {
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
                    let url = "{{route('admin.guru.detail.delete_mapel', 'mapel_id')}}"
                    url = url.replace(/mapel_id/g, id);
                    $.post(url, {
                        _method: 'delete',
                    }, function(data) {
                        Swal.fire(data.title, data.message, data.type);
                        table.ajax.reload();
                    });
                }
            });
        }
    </script>
@endsection

