<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    function index() {
        $asatidz = Guru::all();
        return view('guru.index',compact('asatidz'));
    }
    function create() {
        return  view('guru.create');
    }
    function store(Request $request) {
        // Mengubah ke huruf kecil
        $string = strtolower($request->nama);

        // Menghapus spasi
        $string = str_replace(' ', '', $string);
        try {
            DB::beginTransaction();
            $validasi = $this->validate($request,[
                'nama'=> 'string|required',
                ]);
            // User Guru
            $user = new User;
            $user['name']=$request->nama;
            $user['username']=$string;
            $user['marhalah_id']=auth()->user()->marhalah_id;
            $user['password']=Hash::make('alqosimJambi');
            $user->save();
            // Data Guru
            $guru = new Guru;
            $guru = Guru::create($request->all());
            $guru['marhalah_id'] = auth()->user()->marhalah_id;
            $guru['user_id']=$user->id;
            $guru->save();
            $user->assignRole('guru');
            DB::commit();
            return redirect()->route('guru')->with('success','Guru Berhasil Disimpan');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error','Gagal. Pesan Error: '.$ex->getMessage());
        }
    }
    function destroy(Guru $id) {
        try {
            DB::beginTransaction();
            $id->user->delete();
            $id->delete();
            DB::commit();
            return redirect()->route('guru')->with('success','Guru Dihapus');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error','Gagal. Pesan Error: '.$ex->getMessage());
        }

    }
    function cariGuru(Request $request) {
        if($request->has('q')){
            $cari = $request->q;
            $data = Guru::select('id','nama')->where('nama','LIKE','%'.$cari.'%')->get();
            return response()->json($data);
        }
    }
}
