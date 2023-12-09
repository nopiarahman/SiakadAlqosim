<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Jadwal;
use App\Models\Santri;
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
            $guru = Guru::findOrFail($request->guru_id);
            DB::beginTransaction();
            $validasi = $this->validate($request,[
                'guru_id'=> 'string|required',
                ]);
            $waliKelas = WaliKelas::updateOrCreate(
                ['kelas_id'=>$kelas->id],
                ['user_id'=>$guru->user_id,'guru_id'=>$guru->id]
            );
            // Data Wali Kelas
            $guru->user->assignRole('waliKelas');
            DB::commit();
            return redirect()->route('list-kelas')->with('success','Wali Kelas Berhasil Disimpan');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error','Gagal. Pesan Error: '.$ex->getMessage());
        }
    }
    function raportKelas() {
        $listKelas = WaliKelas::where('guru_id',auth()->user()->waliKelas->guru->id)->get();
        return view('waliKelas.raport',compact('listKelas'));
    }
    function isiKelas(Kelas $kelas) {
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
        $data = DataRaportK13::where('santri_id',$santri->id)->where('periode_id',getPeriodeAktif()->id)->first();
        return view('waliKelas.eksSantri',compact('data','santri','kelas'));
    }
    function prestasiSantri( Kelas $kelas,Santri $santri) {
        $data = DataRaportK13::where('santri_id',$santri->id)->where('periode_id',getPeriodeAktif()->id)->first();
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
        // dd($request);
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
}
