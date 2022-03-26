@extends('_layout.main_admin')
@section('title-admin')
<title>Daftar Guru</title>
@endsection
@section('content-admin')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Daftar Guru</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container">
    <button class="btn btn-primary mb-3"><i class="fas fa-plus mr-1"></i>Tambah Guru</button>
    <table class="table table-bordered table-striped text-center d-none d-lg-table">
            <thead>
                <th style="width: 1%;">No</th>
                <th>Nama</th>
                <th>Mata Pelajaran</th>
                <th style="width: 13%;">Action</th>
            </thead>
            <tbody>
                

            </tbody>
        </table>
    </div><!-- /.container-fluid -->
</section>
@endsection