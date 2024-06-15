<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Marhalah;
use App\Models\NilaiTahfidz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function admin() {
        $admin = User::role('admin')->get();
        $marhalah = Marhalah::all();
        return view('user.admin',compact('marhalah','admin'));
    }
    function store(Request $request) {
        try {
            DB::beginTransaction();
            $validasi = $this->validate($request,[
                'name'=> 'string|required',
                ]);
            $user = new User;
            $user = User::create([
                'name'=>$request->name,
                'username'=>$request->username,
                'password'=>Hash::make($request->password),
                'marhalah_id'=>$request->marhalah_id,
            ]);
            $user->save();
            $user->assignRole('admin');
            DB::commit();
            return redirect()->back()->with('success','Admin Berhasil Disimpan');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error','Gagal. Pesan Error: '.$ex->getMessage());
        }
    }
    function test() {
        $santri=auth()->user()->santri->first();
        $cekData = NilaiTahfidz::where('santri_id',$santri->id)->where('tugas_tahfidz_id',15)->first();
        return view('user.create');
    }
    function testSimpan(Request $request) {
        // dd($request->file('audio'));
        $dataAudio = $request->file('audio')->getClientOriginalName();
        // dd($dataAudio);
        return response()->json([
            'pesan'=>'Tugas berhasil dikirim', 
            'data'=>$dataAudio],200);
    }
    function destroy(User $id) {
        $id->delete();
        return redirect()->back()->with('success','Admin berhasil Dihapus');
    }
    function update(Request $request, User $id) {
        try {
            DB::beginTransaction();
            $requestData=$request->all();
            $id->update($requestData);
            DB::commit();
            return redirect()->back()->with('success','User Diedit');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error','Gagal. Pesan Error: '.$ex->getMessage());
        }
    }
}
