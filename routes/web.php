<?php

use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\PelajaranController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Student\HomeController as StudentHomeController;
use App\Http\Controllers\Teacher\HomeController as TeacherHomeController;
use App\Http\Controllers\WelcomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/', function() {
    return view('welcome');
});
Route::get('register', [AuthController::class, 'index_register'])->name('auth.index.register');
Route::post('login', [AuthController::class, 'login_process'])->name('auth.login.process');
Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::group(['middleware' => ['auth']], function() {
    Route::group(['middleware' => ['ceklogin:admin']], function() {
        
        Route::group(['prefix' => 'admin'], function() {
            Route::get('dashboard', [HomeController::class, 'index'])->name('admin.index');

            Route::group(['prefix' => 'kelas'], function() {
                Route::get('daftar', [KelasController::class, 'index'])->name('admin.kelas');
                Route::post('', [KelasController::class, 'store'])->name('admin.kelas.tambah');
                Route::get('permintaan', [KelasController::class, 'permintaan_kelas'])->name('admin.kelas.permintaan');
                Route::get('level', [KelasController::class, 'grade_level'])->name('admin.kelas.level');
                Route::get('{id}', [KelasController::class, 'edit'])->name('admin.kelas.edit');
                Route::put('{id}', [KelasController::class, 'update'])->name('admin.kelas.update');
                Route::delete('{id}', [KelasController::class, 'destroy'])->name('admin.kelas.delete');
            });

            Route::group(['prefix' => 'pelajaran'], function() {
                Route::get('daftar', [PelajaranController::class, 'index'])->name('admin.pelajaran');
                Route::get('{id}', [PelajaranController::class, 'show'])->name('admin.pelajaran.show');
                Route::post('', [PelajaranController::class, 'store'])->name('admin.pelajaran.tambah');

                Route::post('pelajaran-tingkat-jurusan', [PelajaranController::class, 'store_lesson_grade_major'])->name('admin.pelajaran-grade-major.tambah');
            });

            
            Route::get('dt-kelas', [KelasController::class, 'dt_index'])->name('admin.dt-kelas');
            Route::get('dt-kelas/permintaan', [KelasController::class, 'dt_permintaan'])->name('admin.dt-kelas.permintaan');
            Route::get('dt-pelajaran', [PelajaranController::class, 'dt_index'])->name('admin.dt-pelajaran');
            Route::get('dt-pelajaran/{id}', [PelajaranController::class, 'dt_show'])->name('admin.dt-pelajaran-show');
            

            Route::group(['prefix' => 'guru'], function() {
                Route::get('daftar', [GuruController::class, 'index_daftar'])->name('admin.guru.daftar');
                Route::get('permintaan', [GuruController::class, 'index_permintaan'])->name('admin.guru.permintaan');
            });
        });
    });

    Route::group(['middleware' => ['ceklogin:teacher']], function() {
        Route::get('teacher', [TeacherHomeController::class, 'index'])->name('teacher.index');
    });

    Route::group(['middleware' => ['ceklogin:student']], function() {
        Route::get('student', [StudentHomeController::class, 'index'])->name('student.index');
    });

    Route::group(['middleware' => ['ceklogin:pubic']], function() {

    });
});
