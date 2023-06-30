<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\MarhalahController;

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

Route::get('/', function () {
    return redirect('login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Marhalah
    Route::controller(MarhalahController::class)->group(function(){
        Route::get('/marhalah','index');
        Route::get('/marhalah/kelas','kelas');
        Route::get('/marhalah/tambah','create');
        Route::post('/marhalah/simpan','store');
        Route::get('/marhalah/edit/{id}','edit')->name('edit-marhalah');
        Route::patch('/marhalah/update/{id}','update')->name('update-marhalah');
        Route::delete('/marhalah/delete/{id}','destroy');
    });
    //    Kelas
    Route::controller(KelasController::class)->group(function(){
        Route::get('/marhalah/kelas/{marhalah}','index')->name('kelas-marhalah');
        Route::post('/kelas/simpan','store');
        Route::patch('/kelas/update/{id}','update');
        Route::delete('/kelas/delete/{id}','destroy');
    });
    // User
    Route::controller(UserController::class)->group(function(){
        Route::get('/user/admin','admin');
        Route::post('/admin/simpan','store');
    });
    // Santri
    Route::controller(SantriController::class)->group(function(){
        Route::get('/santri','all');
        Route::get('/santri/tambah/{kelas}','create')->name('santri-kelas-tambah');
        Route::post('/santri/simpan/{kelas}','store')->name('santri-kelas-simpan');
        Route::get('/kelas-santri','kelasSantri');
        Route::get('/kelas-santri/{id}','isiKelas')->name('isi-kelas');
    });
    // Guru
    Route::controller(GuruController::class)->group(function(){
        Route::get('/guru','index')->name('guru');
        Route::get('/guru/tambah','create');
        Route::post('/guru/simpan','store')->name('guru-simpan');
        Route::delete('/guru/delete/{id}','destroy');
    });
});
