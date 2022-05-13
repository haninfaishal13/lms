<?php

use App\Http\Controllers\Admin\DatatableController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\MajorController;
use App\Http\Controllers\Admin\PelajaranController;
use App\Http\Controllers\Admin\PengumumanController;
use App\Http\Controllers\Admin\SelectController;
use App\Http\Controllers\Admin\SiswaController;
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

            Route::group(['prefix' => 'tingkat'], function() {
                Route::get('daftar', [KelasController::class, 'index_tingkat'])->name('admin.tingkat');
                Route::post('', [KelasController::class, 'store_tingkat'])->name('admin.tingkat.store');
                Route::get('{id}/edit', [KelasController::class, 'edit_tingkat'])->name('admin.tingkat.edit');
                Route::put('{id}/update', [KelasController::class, 'update_tingkat'])->name('admin.tingkat.update');
                Route::delete('{id}/delete', [KelasController::class, 'destroy_tingkat'])->name('admin.tingkat.destroy');
            });

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
                Route::get('{id}/edit', [PelajaranController::class, 'edit'])->name('admin.pelajaran.edit');
                Route::post('', [PelajaranController::class, 'store'])->name('admin.pelajaran.tambah');
                Route::put('{id}/update', [PelajaranController::class, 'update'])->name('admin.pelajaran.update');
                Route::delete('{id}/delete', [PelajaranController::class, 'destroy'])->name('admin.pelajaran.delete');

                Route::post('pelajaran-tingkat-jurusan', [PelajaranController::class, 'store_lesson_grade_major'])->name('admin.pelajaran-grade-major.tambah');
                Route::post('get-pelajaran-tingkat-jurusan', [PelajaranController::class, 'get_lesson_grade_major'])->name('admin.pelajaran-grade-major.get');
            });

            Route::group(['prefix' => 'guru'], function() {
                Route::get('daftar', [GuruController::class, 'index_daftar'])->name('admin.guru.daftar');
                Route::get('permintaan', [GuruController::class, 'index_permintaan'])->name('admin.guru.permintaan');
                Route::get('daftarkan-guru', [GuruController::class, 'daftarkan_guru_create'])->name('admin.guru.daftarakan_guru_create');
                Route::post('daftarkan-guru', [GuruController::class, 'daftarkan_guru'])->name('admin.guru.daftarakan_guru');

                Route::group(['prefix' => 'detail'], function() {
                    Route::get('{id}', [GuruController::class, 'show'])->name('admin.guru.detail.show');
                    Route::post('{id}/atur-mapel', [GuruController::class, 'atur_mapel_guru'])->name('admin.guru.detail.atur_mapel');
                    Route::get('{id}/edit-mapel', [GuruController::class, 'edit_mapel_guru'])->name('admin.guru.detail.edit_mapel');
                    Route::put('{id}/update-mapel', [GuruController::class, 'update_mapel_guru'])->name('admin.guru.detail.update_mapel');
                    Route::delete('{id}/delete-mapel', [GuruController::class, 'delete_mapel_guru'])->name('admin.guru.detail.delete_mapel');
                });
            });

            Route::group(['prefix' => 'siswa'], function() {
                Route::get('daftar', [SiswaController::class, 'index'])->name('admin.siswa.daftar');
                Route::post('', [SiswaController::class, 'store'])->name('admin.siswa.store');
                Route::get('{id}/detail', [SiswaController::class, 'show'])->name('admin.siswa.detail.show');

                Route::get('permintaan', [SiswaController::class, 'index_permintaan'])->name('admin.siswa.permintaan');
            });

            Route::group(['prefix' => 'pengumuman'], function() {
                Route::get('daftar', [PengumumanController::class, 'index_daftar'])->name('admin.pengumuman.daftar');
                Route::get('buat', [PengumumanController::class, 'create'])->name('admin.pengumuman.create');
                Route::post('simpan', [PengumumanController::class, 'store'])->name('admin.pengumuman.store');
                Route::get('{id}/detail', [PengumumanController::class, 'show'])->name('admin.pengumuman.show');
                Route::get('{id}/edit', [PengumumanController::class, 'edit'])->name('admin.pengumuman.edit');
                Route::put('{id}/update', [PengumumanController::class, 'update'])->name('admin.pengumuman.update');
                Route::delete('{id}', [PengumumanController::class, 'destroy'])->name('admin.pengumuman.delete');

                Route::get('pengajuan', [PengumumanController::class, 'index_pengajuan'])->name('admin.pengumuman.pengajuan');
                Route::post('{id}/update_status', [PengumumanController::class, 'update_status'])->name('admin.pengumuman.update_status');
            });

            Route::group(['prefix' => 'select2'], function() {
                Route::post('student', [SelectController::class, 'selUserStudent'])->name('admin.select2.student');
                Route::post('teacher', [SelectController::class, 'selUserTeacher'])->name('admin.select2.teacher');
                Route::post('pelajaran', [SelectController::class, 'selLesson'])->name('admin.select2.lesson');
                Route::post('tingkat', [SelectController::class, 'selGrade'])->name('admin.select2.grade');
                Route::post('major', [SelectController::class, 'selMajor'])->name('admin.select2.major');
                Route::post('kelas', [SelectController::class, 'selGradeCluster'])->name('admin.select2.grade_cluster');
                Route::post('ann_category', [SelectController::class, 'selAnnCategory'])->name('admin.select2.ann_category');
            });

            Route::get('dt-tingkat', [KelasController::class, 'dt_grade_index'])->name('admin.dt-tingkat');
            Route::get('dt-kelas', [KelasController::class, 'dt_index'])->name('admin.dt-kelas');
            Route::get('dt-kelas/permintaan', [KelasController::class, 'dt_permintaan'])->name('admin.dt-kelas.permintaan');
            Route::get('dt-pelajaran', [PelajaranController::class, 'dt_index'])->name('admin.dt-pelajaran');
            Route::get('dt-pelajaran/{id}', [PelajaranController::class, 'dt_show'])->name('admin.dt-pelajaran-show');
            Route::get('dt-guru-all', [GuruController::class, 'dt_daftar_all'])->name('admin.dt-guru-all');
            Route::get('dt-guru-aktif', [GuruController::class, 'dt_daftar_aktif'])->name('admin.dt-guru-aktif');
            Route::get('dt-guru-nonaktif', [GuruController::class, 'dt_daftar_nonaktif'])->name('admin.dt-guru-nonaktif');
            Route::get('dt-guru-mapel/{id}', [GuruController::class, 'dt_guru_mapel'])->name('admin.dt-guru-mapel');
            Route::get('dt-siswa-all', [SiswaController::class, 'dt_daftar_all'])->name('admin.dt-siswa-all');
            Route::get('dt-siswa-aktif', [SiswaController::class, 'dt_daftar_aktif'])->name('admin.dt-siswa-aktif');
            Route::get('dt-siswa-nonaktif', [SiswaController::class, 'dt_daftar_nonaktif'])->name('admin.dt-siswa-nonaktif');
            Route::get('dt-pengumuman-daftar', [DatatableController::class, 'dt_pengumuman_daftar'])->name('admin.dt-pengumuman-daftar');

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
