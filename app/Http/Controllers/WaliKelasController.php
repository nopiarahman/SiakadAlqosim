<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Jadwal;
use App\Models\Santri;
use App\Models\WaliKelas;
use Illuminate\Http\Request;
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
            // User Wali Kelas
            $user = new User;
            $user['name']=$guru->nama;
            $user['username']='walikelas'.$kelas->nama;
            $user['marhalah_id']=auth()->user()->marhalah_id;
            $user['password']=Hash::make('walikelas');
            $user->save();
            // Data Wali Kelas
            $waliKelas = new WaliKelas;
            $waliKelas = WaliKelas::create([
                'user_id'=>$user->id,
                'kelas_id'=>$kelas->id,
                'guru_id'=>$guru->id
            ]);
            $waliKelas->save();
            $user->assignRole('waliKelas');
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
            // User Wali Kelas
            $user = User::updateOrCreate(
                ['username'=>'walikelas'.$kelas->nama],
                ['name'=>$guru->nama,'password'=>Hash::make('walikelas'),'marhalah_id'=>auth()->user()->marhalah_id]
            );
            $waliKelas = WaliKelas::updateOrCreate(
                ['kelas_id'=>$kelas->id],
                ['user_id'=>$user->id,'guru_id'=>$guru->id]
            );
            // Data Wali Kelas
            $user->assignRole('waliKelas');
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
        $nilai = Nilai::where('periode_id',getPeriodeAktif()->id)
        ->where('kelas_id',$kelas->id)
        ->where('santri_id',$santri->id)->get();
        dd($nilai);
    }
}
