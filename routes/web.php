<?php
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KDK13Controller;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\RaportController;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\HalaqohController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\MarhalahController;
use App\Http\Controllers\NilaiK13Controller;
use App\Http\Controllers\KurikulumController;
use App\Http\Controllers\WaliKelasController;
use App\Http\Controllers\PendaftaranController;

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
Route::get('/pendaftaran', function () {
    return view('pendaftaran');
});
Route::controller(PendaftaranController::class)->group(function(){
    Route::get('/formulir','form')->name('form-pendaftaran');
});

Route::middleware([
    'auth:sanctum','restrict.api.users',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::group(['middleware'=>['role:Super-Admin|admin']],function(){
        // Marhalah
        Route::controller(MarhalahController::class)->group(function(){
            Route::get('/marhalah','index');
            Route::get('/marhalah/kelas','kelas');
            Route::get('/marhalah/tambah','create');
            Route::post('/marhalah/simpan','store');
            Route::post('/marhalah/kepsek/{id}','storeKepsek');
            Route::get('/marhalah/edit/{id}','edit')->name('edit-marhalah');
            Route::patch('/marhalah/update/{id}','update')->name('update-marhalah');
            Route::delete('/marhalah/delete/{id}','destroy');
        });
        //    Kelas
        Route::controller(KelasController::class)->group(function(){
            Route::get('/kelas','listKelas')->name('list-kelas');
            Route::get('/marhalah/kelas/{marhalah}','index')->name('kelas-marhalah');
            Route::post('/kelas/simpan','store');
            Route::patch('/kelas/update/{id}','update');
            Route::delete('/kelas/delete/{id}','destroy');
        });
        // User
        Route::controller(UserController::class)->group(function(){
            Route::get('/user/admin','admin');
            Route::post('/admin/simpan','store');
            Route::post('/test','testSimpan')->name('test-simpan');
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
            Route::get('/cariGuru','cariGuru');
        });
        // Halaqoh
        Route::controller(HalaqohController::class)->group(function(){
            Route::get('/halaqoh','index');
            Route::post('/halaqoh/simpan','store');
            Route::get('/halaqoh/{id}','isi')->name('isi-halaqoh');
            Route::post('/halaqoh/{id}/simpan','isiSantri')->name('halaqoh-isi-simpan');
            Route::delete('/halaqoh/deleteSantri/{id}','deleteSantri');
            Route::delete('/halaqoh/delete/{id}','destroy');
        });
        Route::controller(MapelController::class)->group(function(){
            Route::get('/mapel','index')->name('mapel-index');
            Route::get('/mapel/tambah','create');
            Route::patch('/mapel/update/{id}','update')->name('update-mapel');
            Route::post('/mapel/simpan','store')->name('mapel-simpan');
            Route::get('/mapel/edit/{id}','edit')->name('edit-mapel');
            Route::delete('/mapel/delete/{id}','destroy');
        });
        Route::controller(PeriodeController::class)->group(function(){
            Route::get('/periode','index')->name('periode-index');
            Route::get('/periode/tambah','create');
            Route::patch('/periode/update/{id}','update')->name('periode-update');
            Route::post('/periode/simpan','store')->name('periode-simpan');
            Route::get('/periode/edit/{id}','edit')->name('edit-periode');
            Route::get('/periode/set/{id}','set')->name('set-periode');
            Route::delete('/periode/delete/{id}','destroy');
        });
        Route::controller(JadwalController::class)->group(function(){
            Route::get('/jadwal','index')->name('jadwal-index');
            Route::get('/jadwal-guru','jadwalGuru')->name('jadwal-guru');
            Route::get('/jadwal/{kelas}','isiJadwal')->name('isi-jadwal');
            Route::get('/jadwal/tambah','create');
            Route::post('/jadwal/kurikulum/{id}','pilihKurikulum');
            Route::patch('/jadwal/update/{id}','update')->name('jadwal-update');
            Route::post('/jadwal/simpan/{kelas}','store')->name('jadwal-simpan');
            Route::get('/jadwal/edit/{id}','edit')->name('edit-jadwal');
            Route::delete('/jadwal/delete/{id}','destroy');
        });
        Route::controller(WaliKelasController::class)->group(function(){
            Route::get('/waliKelas/{kelas}','create')->name('waliKelas-tambah');
            Route::get('/waliKelas/edit/{kelas}','edit')->name('waliKelas-edit');
            Route::post('/waliKelas/{kelas}','store')->name('waliKelas-simpan');
            Route::patch('/waliKelas/{kelas}','update')->name('waliKelas-update');
        });
        Route::controller(KurikulumController::class)->group(function(){
            Route::get('/kurikulum','index')->name('kurikulum-index');
            Route::post('/kurikulum','store')->name('kurikulum-simpan');
            Route::get('/kurikulum/tambah','create')->name('kurikulum-tambah');
            Route::get('/kurikulum/edit/{id}','edit')->name('edit-kurikulum');
            Route::patch('/kurikulum/{id}','update')->name('kurikulum-update');
            Route::delete('/kurikulum/delete/{id}','destroy')->name('kurikulum-delete');
        });
    });
    Route::group(['middleware'=>['role:guru']],function(){
        Route::controller(JadwalController::class)->group(function(){
            Route::get('/jadwal-guru','jadwalGuru')->name('jadwal-guru');
            Route::get('/jadwal-guru/nilai/{id}','isinilai')->name('isi-nilai');
        });
        Route::controller(KDK13Controller::class)->group(function(){
            Route::get('/kd-guru','index')->name('kd-guru');
            Route::post('/kd-guru/simpan','store')->name('kd-guru-simpan');
            Route::get('/kd-guru/list/{kelas}/{mapel}','isi')->name('isi-kd-guru');
        });
        Route::controller(NilaiK13Controller::class)->group(function(){
            Route::get('/nilai-guru','index')->name('nilai-guru');
            Route::get('/nilai-pengetahuan/{kelas}/{mapel}','pengetahuan')->name('isi-nilai-pengetahuan');
            Route::get('/nilai-keterampilan/{kelas}/{mapel}','keterampilan')->name('isi-nilai-keterampilan');
            Route::get('/nilai-pts/{kelas}/{mapel}','pts')->name('isi-nilai-pts');
            Route::get('/nilai-pas/{kelas}/{mapel}','pas')->name('isi-nilai-pas');
            Route::post('/nilai-harian/simpan','store')->name('nilaiK13-harian-simpan');
            Route::post('/nilai-keterampilan/simpan','storeKeterampilan')->name('nilaiK13-keterampilan-simpan');
            Route::post('/nilai-pts/simpan','storePTS')->name('nilaiK13-pts-simpan');
            Route::post('/nilai-pas/simpan','storePAS')->name('nilaiK13-pas-simpan');
        });
    });
    Route::group(['middleware'=>['role:waliKelas']],function(){
        Route::controller(WalikelasController::class)->group(function(){
            Route::get('/raport-kelas','raportKelas');
            Route::get('/data-raport','dataRaport');
            Route::post('/store-data-raport/absensi','absensiStore')->name('absensi-santri-store');
            Route::post('/store-data-catatan','catatanStore')->name('catatan-santri-store');
            Route::get('/data-raport/absensi/{kelas}','absensi')->name('absensi-santri');
            Route::get('/data-raport/sikap/{kelas}','sikap')->name('nilai-sikap');
            Route::post('/data-raport/sikap/{kelas}/store','sikapStore')->name('nilai-sikap-store');
            Route::get('/data-raport/eks/{kelas}','eks')->name('eks-santri');
            Route::get('/data-raport/prestasi/{kelas}','prestasi')->name('prestasi-santri');
            Route::get('/data-raport/eks-detail/{kelas}/{santri}','eksSantri')->name('eks-santri-detail');
            Route::get('/data-raport/prestasi-detail/{kelas}/{santri}','prestasiSantri')->name('prestasi-santri-detail');
            Route::post('/data-raport/eks/store','eksSantriStore')->name('eks-simpan');
            Route::post('/data-raport/prestasi/store','prestasiSantriStore')->name('prestasi-simpan');
            Route::delete('/data-raport/eks/delete/{id}','eksDestroy')->name('eks-destroy');
            Route::delete('/data-raport/prestasi/delete/{id}','prestasiDestroy')->name('prestasi-destroy');
            Route::get('/data-raport/catatan/{kelas}','catatanWaliKelas')->name('catatan-wali-kelas');
            Route::get('/list-raport-kelas/{kelas}','isiKelas')->name('list-kelas-walikelas');
            Route::get('/data-raport-kelas/{kelas}','listDataRaport')->name('data-raport-kelas');
            Route::get('/raport-mid/{santri}/{kelas}','raportMid')->name('raport-mid');
            Route::get('/raport-mid/{santri}/{kelas}','raportMid')->name('raport-mid');
        });
        Route::controller(RaportController::class)->group(function(){
            Route::get('/raport-semesterk13/{santri}/{kelas}','semesterk13')->name('raport-semesterk13');
            Route::get('/raport-pas-print/{santri}/{kelas}','printPasK13')->name('print-pas-k13');
        });
    });
    Route::controller(UserController::class)->group(function(){
        Route::get('/test','test');
    });
});
