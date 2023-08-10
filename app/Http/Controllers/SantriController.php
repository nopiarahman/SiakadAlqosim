<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wali;
use App\Models\Kelas;
use App\Models\Santri;
use App\Models\Marhalah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SantriController extends Controller
{
    function all() {
        if(auth()->user()->getRoleNames()->first()!= 'Super-Admin'){
            $santri =Santri::where('marhalah_id',auth()->user()->marhalah_id)->get();
        }else{
            $santri = Santri::all();
        }
        return view('santri.index',compact('santri'));
    }
    function kelasSantri() {
        $kelas = Kelas::where('marhalah_id',auth()->user()->marhalah_id)->get();
        return view('santri.kelasSantri',compact('kelas'));
    }
    function kelasMarhalah() {
        $marhalah = Marhalah::all();
        return view('santri.kelasMarhalah',compact('marhalah'));
    }
    function isiKelasMarhalah(Marhalah $id) {
        $santri =Santri::where('marhalah_id',$id->id)->get();
        return view('santri.isiKelasMarhalah',compact('santri','id'));
    }
    function isiKelas(Kelas $id) {
        return view('santri.isiKelas',compact('id'));
    }
    function create(Kelas $kelas) {
        return view('santri.create',compact('kelas'));
    }
    function store(Request $request, Kelas $kelas) {
        $password = date('dmY',strtotime($request->tanggalLahir));
        $passwordWali = date('dmY',strtotime($request->tanggalLahirWali));
        $string = strtolower($request->namaWali);
        $string = str_replace(' ', '', $string);
        try {
            DB::beginTransaction();
            $validasi = $this->validate($request,[
                'namaLengkap'=> 'string|required',
                'nik'=> 'string|required',
                'namaWali'=> 'string|required',
                'tanggalLahir'=> 'required',
                'tanggalLahirWali'=> 'required',
                ]);
            // User Santri
            $userSantri = new User;
            $userSantri['name']=$request->namaLengkap;
            $userSantri['username']='santri'.$request->nik;
            $userSantri['marhalah_id']=auth()->user()->marhalah_id;
            $userSantri['password']=Hash::make($password);
            $userSantri->save();
            $userSantri->assignRole('santri');
            
            
            // User Wali Santri
            $userWali = new User;
            $userWali['name']=$request->namaWali;
            $userWali['username']='wali'.$request->nik;
            $userWali['marhalah_id']=auth()->user()->marhalah_id;
            $userWali['password']=Hash::make('wali'.$request->nik);
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
                'namaWali'=>$request->namaWali,
            ]);
            $wali->save();
            DB::commit();
            return redirect()->route('isi-kelas',['id'=>$kelas->id])->with('success','Santri Berhasil Disimpan');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error','Gagal. Pesan Error: '.$ex->getMessage());
        }
    }
    function edit(Santri $id) {
        return view('santri.edit',compact('id'));
    }

    function update(Request $request, Santri $id) {
        $password = date('dmY',strtotime($request->tanggalLahir));
        $passwordWali = date('dmY',strtotime($request->tanggalLahirWali));
        $string = strtolower($request->namaWali);
        $string = str_replace(' ', '', $string);
        try {
            DB::beginTransaction();
            $validasi = $this->validate($request,[
                'namaLengkap'=> 'string|required',
                'nik'=> 'string|required',
                'namaWali'=> 'string|required',
                'tanggalLahir'=> 'required',
                'tanggalLahirWali'=> 'required',
                ]);
            $requestData=$request->all();
            // Update Data Santri
            $id->update($requestData);
            // Update Data Wali
            $id->wali->update($requestData);
            // Update user santri
            $id->user->update([
                'name'=>$request->namaLengkap,
                'username'=>$request->nik,
                'marhalah_id'=>auth()->user()->marhalah_id,
                'password'=>Hash::make($password),
            ]);
            // Update user wali
            $id->wali->user->update([
                'name'=>$request->namaWali,
                'username'=>$string,
                'marhalah_id'=>auth()->user()->marhalah_id,
                'password'=>Hash::make($passwordWali),
            ]);
            DB::commit();
            return redirect()->back()->with('success','Santri Diedit');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error','Gagal. Pesan Error: '.$ex->getMessage());
        }
    }

    function cariSantri(Request $request) {
        if($request->has('q')){
            $cari = $request->q;
            $data = Santri::where('namaLengkap','LIKE','%'.$cari.'%')->select('id','namaLengkap','marhalah_id')->get();
            $dataKelas = $data->map(function ($value) {
                $value['namaKelas'] = $value->kelas->first()->nama;
                $value['namaMarhalah'] = $value->marhalah->nama;
                return $value;
            });
            return response()->json($dataKelas);
        }
    }
    function destroy(Santri $id) {
        try {
            DB::beginTransaction();
            $id->user->delete();
            $id->wali->user->delete();
            $id->wali->delete();
            $id->delete();
            DB::commit();
            return redirect()->back()->with('success','Santri Dihapus');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error','Gagal. Pesan Error: '.$ex->getMessage());
        }
    }
}
