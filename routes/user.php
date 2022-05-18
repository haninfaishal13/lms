<?php

use App\Http\Controllers\User\ChangeRoleController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\KelasController;
use App\Http\Controllers\User\PelajaranController;
use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Route;

    Route::group(['middleware' => ['auth', 'ceklogin:student|teacher|public']], function() {
        Route::get('dashboard', [HomeController::class, 'index'])->name('user.index');
        route::group(['prefix' => 'status-ubah'], function() {
            Route::get('{username}', [ChangeRoleController::class, 'edit'])->name('user.role.edit');
            Route::post('{username}', [ChangeRoleController::class, 'change_role'])->name('user.role.change');
        });

        Route::group(['prefix' => 'kelas'], function() {
            Route::get('', [KelasController::class, 'index'])->name('user.grade');
        });
        Route::group(['prefix' => 'pelajaran'], function() {
            Route::get('{id}', [PelajaranController::class, 'show'])->name('user.lesson.show');
        });
        Route::group(['prefix' => 'profil'], function() {
            Route::get('{username}', [ProfileController::class, 'show'])->name('user.profile.show');
        });
    });

