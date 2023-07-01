<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wali;
use App\Models\Kelas;
use App\Models\Santri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SantriController extends Controller
{
    function all() {
        $santri =Santri::where('marhalah_id',auth()->user()->marhalah_id)->get();
        return view('santri.index',compact('santri'));
    }
    function kelasSantri() {
        $kelas = Kelas::where('marhalah_id',auth()->user()->marhalah_id)->get();
        return view('santri.kelasSantri',compact('kelas'));
    }
    function isiKelas(Kelas $id) {
        return view('santri.isiKelas',compact('id'));
    }
    function create(Kelas $kelas) {
        return view('santri.create',compact('kelas'));
    }
    function store(Request $request, Kelas $kelas) {
        try {
            DB::beginTransaction();
            $validasi = $this->validate($request,[
                'namaLengkap'=> 'string|required',
                ]);
            // User Santri
            $userSantri = new User;
            $userSantri['name']=$request->namaLengkap;
            $userSantri['username']=$request->nik;
            $userSantri['marhalah_id']=auth()->user()->marhalah_id;
            $userSantri['password']=Hash::make($request->tanggalLahir);
            $userSantri->save();
            $userSantri->assignRole('santri');
            
            // User Wali Santri
            $userWali = new User;
            $userWali['name']=$request->namaIbu;
            $userWali['username']=$request->nisn.$request->namaIbu;
            $userWali['marhalah_id']=auth()->user()->marhalah_id;
            $userWali['password']=Hash::make($request->tanggalLahir);
            $userWali->save();
            $userWali->assignRole('waliSantri');
            
            // Data Santri
            $santri = new Santri;
            $santri = Santri::create($request->all());
            $santri['marhalah_id'] = auth()->user()->marhalah_id;
            $santri['user_id']=$userSantri->id;
            $santri->save();
            $kelas->santri()->attach($santri->id);

            // Data Wali
            $wali = new Wali;
            $wali = Wali::create([
                'santri_id'=>$santri->id,
                'user_id'=>$userWali->id,
                'namaIbu'=>$request->namaIbu,
            ]);
            $wali->save();
            DB::commit();
            return redirect()->route('isi-kelas',['id'=>$kelas->id])->with('success','Santri Berhasil Disimpan');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error','Gagal. Pesan Error: '.$ex->getMessage());
        }
    }
    function cariSantri(Request $request) {
        if($request->has('q')){
            $cari = $request->q;
            $data = Santri::select('id','namaLengkap')->where('namaLengkap','LIKE','%'.$cari.'%')
            ->where('marhalah_id',auth()->user()->marhalah_id)->get();
            $dataKelas = $data->filter(function($value){
                $value['kelas']=$value->kelas->first()->nama;
                return $value;
            });
            return response()->json($dataKelas);
        }
    }
}
