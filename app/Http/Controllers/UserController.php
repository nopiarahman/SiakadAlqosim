<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Marhalah;
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
        dd(auth()->user()->santri->first()->id);
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
}
