<?php

use App\Http\Controllers\AlumniController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(LoginController::class)->group(function(){
    Route::get('/login', 'login');
    Route::post('/auth', 'auth');
    Route::get('/logout', 'logout');
});

Route::middleware(['statuslogin'])->group(function () {

    Route::get('/', function () {
        return redirect('/lowongan_pekerjaan');
    });

    Route::get('/infoker', function(){
        return view('user.dashboard');
    });

    Route::controller(UserController::class)->group( function(){
        Route::get('/infoker', 'show');
        Route::post('/infoker', 'search');

        Route::get('/pengajuan', 'showPengajuan');
        Route::get('/pengajuan-form', 'formPengajuan');
        Route::get('/pengajuan-form_edit{id}', 'formEdit');

        Route::get('/profil', 'profil');
    });

    Route::controller(AlumniController::class)->group(function(){

        Route::get('/alumni', 'show');
        Route::get('/alumni-add', 'add');
        Route::post('/alumni-add', 'create');
        Route::get('/alumni-profil{nisn}', 'profil');
        
        Route::post('/alumni-profil_update{user_id}', 'updateProfil');
        Route::post('/upload_foto/{nisn}', 'uploadFoto');
    });

    Route::controller(JurusanController::class)->group(function(){
        Route::get('/jurusan', 'show');
        Route::post('/jurusan-add', 'create');
    });

    Route::controller(LowonganController::class)->group(function(){
        Route::get('/lowongan_pekerjaan', 'show');
        Route::get('/lowongan_pekerjaan-form', 'add');
        Route::post('/lowongan_pekerjaan/store', 'create');
        
        Route::get('/lowongan_pekerjaan-form_edit{id}', 'edit');
        Route::post('/lowongan_pekerjaan/update{id}', 'update');

        Route::post('/lowongan_pekerjaan-status_changer{id}', 'statusChanger');

        Route::get('/lowongan_pekerjaan-remove{id}', 'remove');
    });

});
