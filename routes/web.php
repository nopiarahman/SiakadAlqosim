<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\HalaqohController;
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
        Route::get('/santri/{id}','edit')->name('edit-santri');
        Route::patch('/santri/{id}','update')->name('update-santri');
        Route::delete('/santri/{id}','destroy');
        Route::get('/santri/tambah/{kelas}','create')->name('santri-kelas-tambah');
        Route::post('/santri/simpan/{kelas}','store')->name('santri-kelas-simpan');
        Route::get('/kelas-santri','kelasSantri');
        Route::get('/kelas-santri-marhalah','kelasMarhalah');
        Route::get('/santri-marhalah/{id}','isiKelasMarhalah')->name('isi-kelas-marhalah');
        Route::get('/kelas-santri/{id}','isiKelas')->name('isi-kelas');
        Route::get('/cariSantri','cariSantri');
        
    });
    // Guru
    Route::controller(GuruController::class)->group(function(){
        Route::get('/guru','index')->name('guru');
        Route::get('/guru/tambah','create');
        Route::post('/guru/simpan','store')->name('guru-simpan');
        Route::get('/guru/edit/{id}','edit')->name('edit-guru');
        Route::delete('/guru/delete/{id}','destroy');
    });
    // Halaqoh
    Route::controller(HalaqohController::class)->group(function(){
        Route::get('/halaqoh','index');
        Route::post('/halaqoh/simpan','store');
        Route::get('/halaqoh/{id}','isi')->name('isi-halaqoh');
        Route::post('/halaqoh/{id}/simpan','isiSantri')->name('halaqoh-isi-simpan');
        Route::delete('/halaqoh/deleteSantri/{id}','deleteSantri');
    });
    Route::controller(MapelController::class)->group(function(){
        Route::get('/mapel','index')->name('mapel-index');
        Route::get('/mapel/tambah','create');
        Route::patch('/mapel/update/{id}','update')->name('update-mapel');
        Route::post('/mapel/simpan','store')->name('mapel-simpan');
        Route::get('/mapel/edit/{id}','edit')->name('edit-mapel');
        Route::delete('/mapel/delete/{id}','destroy');

    });
});
