@extends('_layout.main_admin')
@section('title-admin')
<title>Daftar Siswa</title>
@endsection
@section('content-admin')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Daftar Siswa</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container">
        <table class="table table-bordered table-striped text-center d-none d-lg-table">
            <thead>
                <th style="width: 1%;">No</th>
                <th>Nama</th>
                <th>Mata Pelajaran</th>
                <th style="width: 25%;">Action</th>
            </thead>
            <tbody>
                

            </tbody>
        </table>
    </div><!-- /.container-fluid -->
</section>
@endsection