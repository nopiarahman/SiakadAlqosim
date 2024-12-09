<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Jadwal;
use App\Models\Santri;
use App\Models\NilaiK13;
use App\Models\Prestasi;
use App\Models\WaliKelas;
use Illuminate\Http\Request;
use App\Models\DataRaportK13;
use App\Models\Ekstrakurikuler;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class WaliKelasController extends Controller
{
    function create(Kelas $kelas) {
        return view('waliKelas.create',compact('kelas'));
    }
    function store(Request $request, Kelas $kelas) {
        try {
            $guru = Guru::findOrFail($request->guru_id);
            DB::beginTransaction();
            $validasi = $this->validate($request,[
                'guru_id'=> 'string|required',
                ]);
            // Role Wali Kelas
            $guru->user->assignRole('waliKelas');
            // Data Wali Kelas
            $waliKelas = new WaliKelas;
            $waliKelas = WaliKelas::create([
                'user_id'=>$guru->user_id,
                'kelas_id'=>$kelas->id,
                'guru_id'=>$guru->id
            ]);
            $waliKelas->save();
            DB::commit();
            return redirect()->route('list-kelas')->with('success','Wali Kelas Berhasil Disimpan');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error','Gagal. Pesan Error: '.$ex->getMessage());
        }
    }
    function edit(Kelas $kelas) {
        return view('waliKelas.edit',compact('kelas'));
    }
    function update(Request $request, Kelas $kelas) {
        try {
            // Validasi input
            $this->validate($request, [
                'guru_id' => 'required|string',
                'id_wali_sebelum' => 'required|exists:users,id', // Pastikan id_wali_sebelum valid
            ]);
    
            DB::beginTransaction();
    
            // Temukan guru baru berdasarkan guru_id
            $guru = Guru::findOrFail($request->guru_id);
            
            // Hapus role waliKelas dari wali kelas sebelumnya (jika ada)
            if ($request->has('id_wali_sebelum')) {
                $waliKelasSebelumnya = User::findOrFail($request->id_wali_sebelum);
                $waliKelasSebelumnya->removeRole('waliKelas'); // Hapus role waliKelas
            }
    
            // Update atau buat wali kelas baru untuk kelas tersebut
            $waliKelas = WaliKelas::updateOrCreate(
                ['kelas_id' => $kelas->id],
                ['user_id' => $guru->user_id, 'guru_id' => $guru->id]
            );
    
            // Assign role waliKelas kepada guru baru
            $guru->user->assignRole('waliKelas');
    
            DB::commit();
    
            return redirect()->route('list-kelas')->with('success', 'Wali Kelas Berhasil Disimpan');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal. Pesan Error: ' . $ex->getMessage());
        }
    }
    
    function raportKelas() {
        $listKelas = WaliKelas::where('guru_id',auth()->user()->waliKelas->guru->id)->get();
        return view('waliKelas.raport',compact('listKelas'));
    }
    function isiKelas(Kelas $kelas) {
        // $nilaiPengetahuanAll = NilaiK13::select('PTS','PAS', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'h7', 'h8','k1', 'k2', 'k3', 'k4', 'k5', 'k6', 'k7', 'k8')
        // ->where('kelas_id',$kelas->id)
        // ->where('periode_id',getPeriodeAktif()->id)
        // ->first();
        // if ($nilaiPengetahuanAll) {
        //     $attributes = ['PTS','PAS', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'h7', 'h8','k1', 'k2', 'k3', 'k4', 'k5', 'k6', 'k7', 'k8'];
        
        //     $total = collect($attributes)->sum(function ($attribute) use ($nilaiPengetahuanAll) {
        //         return $nilaiPengetahuanAll->$attribute ?? 0;
        //     });
        // } 
        // dd($total);
        return view('waliKelas.isiKelas',compact('kelas'));
    }
    function raportMid(Santri $santri, Kelas $kelas) {
        return redirect()->back()->with('error',"'afwan,  fitur sedang dikembangkan");
        $nilai = Nilai::where('periode_id',getPeriodeAktif()->id)
        ->where('kelas_id',$kelas->id)
        ->where('santri_id',$santri->id)->get();
        dd($nilai);
    }
    function dataRaport() {
        $listKelas = WaliKelas::where('guru_id',auth()->user()->waliKelas->guru->id)->get();
        return view('waliKelas.data-raport',compact('listKelas'));
    }
    function listDataRaport(Kelas $kelas) {
        return view('waliKelas.list-data',compact('kelas'));

    }
    function absensi(Kelas $kelas) {
        return view('waliKelas.absensi',compact('kelas'));
    }
    function absensiStore(Request $request) {
        try {
            DB::beginTransaction();
            DataRaportK13::updateOrCreate(
                ['santri_id'=>$request->santri_id,'periode_id'=>getPeriodeAktif()->id],
                $request->all()
            );
            DB::commit();
            return redirect()->back()->with('success','Absensi Berhasil ditambahkan');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error','Gagal. Pesan Error: '.$ex->getMessage());
        }
    }
    function catatanStore(Request $request) {
        try {
            DB::beginTransaction();
            DataRaportK13::updateOrCreate(
                ['santri_id'=>$request->santri_id,'periode_id'=>getPeriodeAktif()->id],
                $request->all()
            );
            DB::commit();
            return redirect()->back()->with('success','Catatan Berhasil ditambahkan');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error','Gagal. Pesan Error: '.$ex->getMessage());
        }
    }
    function catatanWaliKelas(Kelas $kelas) {
        return view('waliKelas.catatan',compact('kelas'));
    }
    function eks(Kelas $kelas) {
        return view('waliKelas.eks',compact('kelas'));
    }
    function prestasi(Kelas $kelas) {
        return view('waliKelas.prestasi',compact('kelas'));
    }
    function eksSantri( Kelas $kelas,Santri $santri) {
        
        $data = DataRaportK13::firstOrCreate([
            'santri_id' => $santri->id,
            'periode_id' => getPeriodeAktif()->id
        ]);
        
        return view('waliKelas.eksSantri',compact('data','santri','kelas'));
    }
    function prestasiSantri( Kelas $kelas,Santri $santri) {
        $data = DataRaportK13::firstOrCreate([
            'santri_id' => $santri->id,
            'periode_id' => getPeriodeAktif()->id
        ]);
        
        return view('waliKelas.prestasiSantri',compact('data','santri','kelas'));
    }
    function eksSantriStore(Request $request) {
        try {
            DB::beginTransaction();
            Ekstrakurikuler::create($request->all());
            DB::commit();
            return redirect()->back()->with('success','Catatan Berhasil ditambahkan');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error','Gagal. Pesan Error: '.$ex->getMessage());
        }
    }
    function prestasiSantriStore(Request $request) {
        try {
            DB::beginTransaction();
            Prestasi::create($request->all());
            DB::commit();
            return redirect()->back()->with('success','Catatan Berhasil ditambahkan');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error','Gagal. Pesan Error: '.$ex->getMessage());
        }
    }
    function eksDestroy(Ekstrakurikuler $id) {
        $id->delete();
        return redirect()->back()->with('success','Ekstrakurikuler Berhasil Dihapus');
    }
    function prestasiDestroy(Prestasi $id) {
        $id->delete();
        return redirect()->back()->with('success','Prestasi Berhasil Dihapus');
    }
    function sikap(Kelas $kelas) {
        return view('waliKelas.sikap',compact('kelas'));
    }
    function sikapStore(Request $request) {
        try {
            DB::beginTransaction();
            $data = DataRaportK13::firstOrCreate(
                ['santri_id' => $request->santri_id,'periode_id'=>getPeriodeAktif()->id]
            );
            $data->sikap()->updateOrCreate(
                ['data_raport_k13_id' => $data->id], // Kriteria pencarian
                $request->all() // Data untuk update atau create
            );
            DB::commit();
            return redirect()->back()->with('success','Catatan Berhasil ditambahkan');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error','Gagal. Pesan Error: '.$ex->getMessage());
        }
    }
    function kenaikan(Kelas $kelas) {
        return view('waliKelas.kenaikan',compact('kelas'));
    }
    function kenaikanUpdate(Kelas $kelas, Santri $santri,Request $request) {
        try {
            DB::beginTransaction();
            DataRaportK13::updateOrCreate(
                ['santri_id'=>$santri->id,'periode_id'=>getPeriodeAktif()->id],
                ['status'=>$request->status,'tujuan'=>$request->tujuan]
            );
            DB::commit();
            return redirect()->back()->with('success','Informasi Kenaikan Kelas Berhasil Disimpan');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error','Gagal. Pesan Error: '.$ex->getMessage());
        }
    }
}
