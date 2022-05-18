@extends('_layout.main_user')
@section('title-user')
    <title>{{$title}}</title>
@endsection
@section('content-user')
<div class="container">
    <h3>Daftarkan diri</h3>
    @if (session('error_changerole'))
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button>
        {!! session('error_changerole') !!}
    </div>
    @endif
    <div class="card mt-3">
        <div class="card-body">
            <form action="{{route('user.role.change', Auth::user()->username)}}" id="change-role" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row mb-3">
                    <div class="col-sm-3">
                        Mendaftar menjadi:
                    </div>
                    <div class="col-sm-9">
                        <select name="role" id="role" class="form-control">
                            <option value="0">Pilih</option>
                            <option value="student">Siswa</option>
                            <option value="teacher">Guru</option>
                        </select>
                        <code id="warning-role" class="text-danger d-none">Pilihan tidak boleh kosong</code>
                    </div>
                </div>
                {{-- <div class="row mb-3">
                    <div class="col-sm-3">
                        Dokumen pendaftaran
                    </div>
                    <div class="col-sm-9">
                        <input type="file" name="document_support" id="document_support" accept="image/jpg, image/jpeg, image/png" required />
                        <br>
                        <code class="text-danger">Dokumen maksimal 4 GB</code>
                    </div>
                </div> --}}
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary" onclick="return changerole()">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('scripts-user')
    <script>
        function changerole() {
            if($('#role').val() == '0') {
                $('#warning-role').removeClass('d-none');
                setTimeout(() => {
                    $('#warning-role').addClass('d-none');
                }, 3000);
                return false
            }
        }
    </script>
@endsection
