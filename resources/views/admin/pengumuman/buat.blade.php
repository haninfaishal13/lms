@extends('_layout.main_admin')

@section('title-admin')
<title>Daftar Pelajaran</title>
@endsection

@section('style-admin')
<link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content-admin')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Tambah Pengumuman</h1>
            </div>
        </div>
    </div>
</div>


<section class="content">
    <div class="container-fluid">
        <div class="form-group">
            <div class="row">
                <div class="col-md-2">
                    Title:
                </div>
                <div class="col-md-10">
                    <input type="text" name="title" id="title" class="form-control" placeholder="Isi judul pengumuman" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-2">
                    Kategori
                </div>
                <div class="col-md-10">
                    <select name="category" id="category" class="form-control" required></select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-2">
                    Header
                </div>
                <div class="col-md-10">
                    <input type="file" name="header" id="header" class="form-control-file" accept="image/jpg, image/jpeg, image/png" required />
                    <img alt="" id="show-header" style="max-width:100%">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-2">
                    Konten
                </div>
                <div class="col-md-10">
                    <textarea name="text" id="text" cols="30" rows="10" placeholder="Isi konten pengumuman" class="form-control" required></textarea>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-2">
                    Media
                </div>
                <div class="col-md-10">
                    <input type="file" name="media[]" id="media" class="form-control-file" multiple>
                    <div class="row mt-2" id="media-show"></div>
                </div>
            </div>
        </div>
        <div class="d-flex flex-row-reverse">
            <button class="btn btn-primary" id="submit-announcement"><i class="fas fa-save mr-2"></i>Simpan</button>
            <button class="btn btn-danger mr-2" id="cancel-announcement"><i class="fas fa-window-close mr-2"></i>Reset</button>
        </div>
    </div>
</section>
@endsection

@section('script-admin')
    <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
    <script>


        $('#text').summernote({
            height:200,
        });

        $('#category').select2({
            placeholder: 'Pilih kategori',
            ajax: {
                url: "{{route('admin.select2.ann_category')}}",
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
        var headerFile;
        $('#header').on('change', function() {
            var files = !!this.files ? this.files : [];
            console.log(files);
            headerFile = files[0];
            if (!files.length || !window.FileReader) return;
            if (/^image/.test( files[0].type)){
                var reader = new FileReader();
                reader.readAsDataURL(files[0]);
                reader.onloadend = function(){
                    $('#show-header').attr("src",this.result);
                }
            }
        });
        var collectionFiles = [];
        $('#media').on('change', function(event) {
            var currentFiles = [];
            var files = event.target.files, length = files.length;
            var url = "{{asset('img/png/icon/nama_file')}}"
            let html = ``;
            var iter = 0;

            recursive_collection(iter, files, collectionFiles, currentFiles);
            recursive_append_card(iter, currentFiles);

            arr_length = collectionFiles.length;

            $('.remove_media').on('click', function() {
                id = $(this).attr('data-id');
                name = $(this).attr('data-name');
                var iter = 0;
                recursive_delete_element(iter, collectionFiles, name);
                $('#'+id).remove();
            });
        });

        $('#cancel-announcement').on('click', function() {
            $('#title').val('');
            $('#header').val('');
            $('#show-header').attr('src', '');
            $('#category').val('').trigger('change');
            $('#text').val('');
            $('#media').val('');
            collectionFiles = [];
        })

        $('#submit-announcement').on('click', function() {
            var formData = new FormData();
            formData.append('title', $('#title').val());
            formData.append('header', headerFile);
            formData.append('text', $('#text').val());
            formData.append('ann_category_id', $('#category').val());
            $.each(collectionFiles, function(index, value) {
                formData.append('media[]', value);
            });
            $.ajax({
                url: "{{route('admin.pengumuman.store')}}",
                method:"post",
                contentType: false,
                processData: false,
                data: formData,
                success: function(data) {
                    if(data.type == "success") {
                        Swal.fire(data.title, data.message, data.type);
                        window.location = "{{route('admin.pengumuman.daftar')}}";
                    }
                    else {
                        Swal.fire(data.title, data.message, data.type);
                    }

                },
                error: function(data) {
                    Swal.fire("Error", "Terjadi kesalahan, silakan coba lagi nanti", "error");
                    console.log(data);
                }
            });
        });

        function recursive_collection(iter, files, array, array_current) {
            var arr_length = files.length;
            if(iter < arr_length) {
                array.push(files[iter]);
                array_current.push(files[iter]);
                var next_iter = iter + 1
                recursive_collection(next_iter, files, array, array_current);
            }
            else {
                return
            }
        }

        function recursive_append_card(iter, array) {
            var arr_length = array.length;
            if(iter < arr_length) {
                var name = array[iter].name;
                var ext = name.split('.').pop();
                let idx = 0;
                if($('.media-uploaded').length < 1 ) {
                    idx = 0;
                }
                else {
                    idx = parseInt($('.media-uploaded').last().attr('id')) + 1
                }
                var card = create_card_media(name, idx, ext);
                $('#media-show').append(card);
                var next_iter = iter + 1;
                recursive_append_card(next_iter, array);
            }
            else {
                return
            }
        }

        function recursive_delete_element(iter, array, name) {
            var arr_length = array.length;
            if(iter < arr_length) {
                if(array[iter].name == name) {
                    array.splice(iter, 1);
                    return
                }
                else {
                    var next_iter = iter + 1;
                    recursive_delete_element(next_iter, array, name);
                }
            }
            else {
                return
            }
        }

        function create_card_media(name, idx, ext) {
            if(ext == 'jpg' || ext == 'jpeg') {
                var img = `<img src ="{{asset('img/png/icon/jpg.png')}}" width=100%>`
            }
            else if(ext == 'png') {
                var img = `<img src ="{{asset('img/png/icon/png.png')}}" width=100%>`
            }
            else if(ext == 'rar') {
                var img = `<img src ="{{asset('img/png/icon/rar.png')}}" width=100%>`
            }
            else if(ext == 'zip') {
                var img = `<img src ="{{asset('img/png/icon/zip.png')}}" width=100%>`
            }
            else if(ext == 'pdf') {
                var img = `<img src ="{{asset('img/png/icon/pdf.png')}}" width=100%>`
            }
            else if(ext == 'doc' || ext == 'docx') {
                var img = `<img src ="{{asset('img/png/icon/doc.png')}}" width=100%>`
            }
            else if(ext == 'ppt' || ext == 'pptx') {
                var img = `<img src ="{{asset('img/png/icon/ppt.png')}}" width=100%>`
            }
            else if(ext == 'xls' || ext == 'pptx') {
                var img = `<img src ="{{asset('img/png/icon/ppt.png')}}" width=100%>`
            }
            else {
                var img = `<img src ="{{asset('img/png/icon/file.png')}}" width=100%>`
            }
            var card = `
                <div class="col-md-2 mt-2 media-uploaded" id="${idx}">
                    <div class="card">
                        <div class="card-body">
                            ${img}
                            <br>
                            <span class="text-center">${name}</span>
                            <button class="btn btn-danger btn-sm btn-block remove_media" data-id="${idx}" data-name="${name}"> Hapus </button>
                        </div>
                    </div>
                </div>
            `
            return card;
        }
    </script>
@endsection
