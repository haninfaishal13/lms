@extends('_layout.main_user')
@section('title-user')
<title>Kelas</title>
@endsection
@section('content-user')
<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <h3 class="mb-4">{{$lesson_detail->name}}</h3>
            <p>{{$lesson_detail->description == null ? '-' : $lesson_detail->description}}</p>
            <h4>Bab</h4>
            <div class="card mt-4">
                <div class="card-body">
                    <a href="#" class="text-dark"><h5>Nama Bab</h5></a>
                    <p>Deskripsi</p>
                    <hr class="m-2">
                    <div class="row">
                        <div class="col-sm-4">Materi</div>
                        <div class="col-sm-8">Kolom deskripsi & download materi</div>
                    </div>
                    <hr class="m-2">
                    <div class="row">
                        <div class="col-sm-4">Tugas</div>
                        <div class="col-sm-8">Kolom deskripsi & kirim berkas tugas</div>
                    </div>
                    <hr class="m-2">
                    <div class="row">
                        <div class="col-sm-4">Kuis Online</div>
                        <div class="col-sm-8">Kolom ke kuis online, terbuka & tertutup sesuai waktunya</div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <h3>Navigasi</h3>
            <hr>
            @if($role == 'student')
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
            @elseif($role == 'teacher')
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
            @endif
        </div>
    </div>
</div>

@endsection
