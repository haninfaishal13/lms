@extends('_layout.main_user')
@section('title-user')
    <title>{{$title}}</title>
@endsection
@section('content-user')
    <div class="container">
        <h1>Bioadata</h1>
        <div class="card">
            <div class="card-body">
                <div class="h5">
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="{{asset($photo_profile)}}" alt="" class="rounded-circle" style="width:100%; height:auto">
                        </div>
                        <div class="col-sm-9">
                            <div class="row mb-4 ml-2">
                                <div class="col-sm-3">
                                    Nama:
                                </div>
                                <div class="col-sm-9 font-weight-light">
                                    {{$user->name}}
                                </div>
                            </div>
                            <div class="row mb-4 ml-2">
                                <div class="col-sm-3">
                                    Email:
                                </div>
                                <div class="col-sm-9 font-weight-light">
                                    {{$user->email}}
                                </div>
                            </div>
                            <div class="row mb-4 ml-2">
                                <div class="col-sm-3">
                                    Alamat:
                                </div>
                                <div class="col-sm-9 font-weight-light">
                                    {{$user->address != '' || $user->address != null ? $user->address : '-'}}
                                </div>
                            </div>
                            <div class="row mb-4 ml-2">
                                <div class="col-sm-3">
                                    Agama:
                                </div>
                                <div class="col-sm-9 font-weight-light">
                                    {{$user->religion}}
                                </div>
                            </div>
                            <div class="row mb-4 ml-2">
                                <div class="col-sm-3">
                                    Jenis Kelamin:
                                </div>
                                <div class="col-sm-9 font-weight-light">
                                    {{$gender}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if($role == 'public')
        <div class="card mt-3">
            <div class="card-body">
                @if (empty($status_request))
                    Anda belum terdaftar sebagai guru atau murid. Silakan daftarkan diri terlebih dahulu
                    <a href="{{route('user.role.edit', Auth::user()->username)}}" class="btn btn-primary">Daftarkan diri</a>
                @else
                    @if($status_request->status == 2)
                        Anda belum terdaftar sebagai guru atau murid. Silakan daftarkan diri terlebih dahulu
                        <a href="{{route('user.role.edit', Auth::user()->username)}}" class="btn btn-primary">Daftarkan diri</a>
                    @else
                        Permintaan pendaftaran sudah dikirimkan. Silakan menunggu konfirmasi administrator
                    @endif
                @endif
            </div>
        </div>
        @endif

    </div>

@endsection
