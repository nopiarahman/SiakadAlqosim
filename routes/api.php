<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\APIController;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\SantriController;
use App\Http\Controllers\API\NilaiTahfidzController;
use App\Http\Controllers\API\TugasTahfidzController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('login',[LoginController::class,'loginApi']);

Route::prefix('v1')->group(function(){ 
    Route::middleware(['auth:sanctum',config('jetstream.auth_session'),
    'verified'])->group(function(){
        Route::apiResource('santri',SantriController::class);
        Route::post('logout',[LoginController::class,'logout']);
        Route::get('/kelas-santri',[SantriController::class,'kelasSantri']);
        Route::get('/kelas-santri/{id}',[SantriController::class,'isiKelas']);
        // halaqoh
        Route::get('/halaqoh',[APIController::class,'halaqoh']);
        // Tugas
        Route::apiResource('tugas',TugasTahfidzController::class);
        // User Santri
        Route::get('/list-tugas',[TugasTahfidzController::class,'list']);
        Route::get('nilai/lihat',[NilaiTahfidzController::class,'lihat']);
        // Nilai
        Route::get('nilai/{tugas}',[NilaiTahfidzController::class,'index']);
        Route::post('kirim/{tugas}',[NilaiTahfidzController::class,'kirim']);
        // User Guru
        Route::get('nilai/pengumpulan',[NilaiTahfidzController::class,'listPengumpulan']);
        Route::get('nilai/pengumpulan/{tugas}',[NilaiTahfidzController::class,'pengumpulanTugas']);
        Route::get('nilai/koreksi/{nilai}',[NilaiTahfidzController::class,'koreksi']);
        Route::patch('nilai/koreksi-nilai/{nilai}',[NilaiTahfidzController::class,'simpanKoreksi']);
        
    });
});