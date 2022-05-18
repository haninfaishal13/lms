@extends('_layout.main_user')
@section('title-user')
<title>Beranda</title>
@endsection
@section('content-user')
<div class="container">
    <div class="row">
        <div class="col-sm-8 bordered-right">
            <h3>Pengumuman</h3>
            <hr>
            @forelse ($announcements as $announcement)
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="" id="title">
                            <h5>{{$announcement->title}}</h5>
                        </div>
                        <div class="d-flex justify-content-center" id="header">
                            <img src="{{asset('storage/'.$announcement->header)}}" alt="" class="w-50 mt-3 ">
                        </div>
                        <div class="mt-2" id="body">
                            {!! $announcement->text !!}
                        </div>
                    </div>
                </div>
            @empty
                Tidak ada pengumuman
            @endforelse
        </div>
        <div class="col-sm-4">
            <h3>Navigasi</h3>
            <hr>
            @if($role == "student")
                @if ($user_study != null)
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                <li class="nav-item">
                                    <a href="{{route('user.grade')}}" class="text-dark"><h5>Kelas {{$grade_cluster->grade->name.'-'.$grade_cluster->name}}</h5></a>
                                </li>
                                <li class="nav-item">
                                    <h5>Mata Pelajaran</h5>
                                    <ul class="nav nav-treeview">
                                        @forelse ($lessons as $lesson)
                                            <li class="nav-item"><a href="{{route('user.lesson.show', $lesson->id)}}" class=" ml-4 text-dark">{{$lesson->name}}</a></li>
                                        @empty
                                            <li class="nav-item">Belum ada mata pelajaran dalam kelas ini</li>
                                        @endforelse
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                @else
                    Anda belum mendapatkan kelas. Silakan hubungi guru atau administrator untuk mendapatkan kelas.
                @endif
            @elseif($role == 'teacher')
                @if ($user_teach != null)
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                <li class="nav-item">
                                    <a href="#" class="text-dark"><h5>Buat Pengumuman</h5></a>
                                </li>
                                <li class="nav-item">
                                    <h5>Mata Pelajaran</h5>
                                    <ul class="nav nav-treeview">
                                        @forelse ($user_teach_lessons as $lesson)
                                            <li class="nav-item"><a href="{{route('user.lesson.show', $lesson->lesson_grade_major->id)}}" class=" ml-4 text-dark">{{$lesson->lesson_grade_major->name}}</a></li>
                                        @empty
                                            <li class="nav-item">Belum ada mata pelajaran dalam kelas ini</li>
                                        @endforelse
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                @else
                    Anda belum mendapatkan penempatan mata pelajaran. Silakan hubungi administrator untuk mendapatkan penempatan mata pelajaran.
                @endif
            @elseif($role == 'public')
                Anda belum terdaftar menjadi murid atau guru.
            @endif
        </div>
    </div>
</div>

@endsection
