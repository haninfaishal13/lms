@extends('_layout.main_user')
@section('title-user')
<title>Kelas</title>
@endsection
@section('content-user')
<div class="container">
    <div class="row">
        <div class="col-sm-8 border-right">
            <h3 class="mb-4">Kelas {{$grade_cluster->grade->name.'-'.$grade_cluster->name}}</h3>
            <p>{{$grade_cluster->description == null ? '-' : $grade_cluster->description}}</p>
            <hr>
            <h4>Mata Pelajaran</h4>
            <div class="card mt-4">
                <div class="card-body">
                    @forelse ($lessons as $lesson)
                        <div class="mb-2">
                            <a href="{{route('user.lesson.show', $lesson->id)}}" class="text-dark"><h5>{{$lesson->name}}</h5></a>
                            <p>{{$lesson->description == null ? '-' : $lesson->description}}</p>
                            <hr class="mt-1">
                        </div>
                    @empty
                        Tidak ada mata pelajaran yang diikuti
                    @endforelse
                </div>
            </div>

        </div>
        <div class="col-sm-4">
            <h3>Navigasi</h3>
            <hr>
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
        </div>
    </div>
</div>

@endsection
