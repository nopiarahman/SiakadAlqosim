<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\SantriController;

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
    });
});