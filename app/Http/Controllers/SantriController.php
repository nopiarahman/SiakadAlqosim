<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wali;
use App\Models\Kelas;
use App\Models\Santri;
use App\Models\Marhalah;
use Illuminate\Http\Request;
use App\Models\PindahSekolah;
use App\Models\SantriDikeluarkan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
    public function santriTidakAktif()
    {
        // Ambil data santri yang pindah sekolah di marhalah yang sama dengan user
        $santriPindah = PindahSekolah::with('santri', 'kelasSebelum')
        ->whereHas('santri', function($query) {
            $query->where('marhalah_id', auth()->user()->marhalah_id);
        })
        ->get();

        // Ambil data santri yang dikeluarkan di marhalah yang sama dengan user
        $santriDikeluarkan = SantriDikeluarkan::with('santri', 'kelasSebelum')
        ->whereHas('santri', function($query) {
            $query->where('marhalah_id', auth()->user()->marhalah_id);
        })
        ->get();
        // Return ke view
        return view('santri.santriTidakAktif', compact('santriPindah', 'santriDikeluarkan'));
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
        $kelasMarhalah=Kelas::where('marhalah_id',$id->marhalah_id)->get();
        return view('santri.isiKelas',compact('id','kelasMarhalah'));
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
                'namaWali'=> 'string|required',
                'tanggalLahir'=> 'required',
                ]);
            // User Santri
            $userSantri = new User;
            $userSantri['name']=$request->namaLengkap;
            $userSantri['username']='santri'.$request->nis;
            $userSantri['marhalah_id']=auth()->user()->marhalah_id;
            $userSantri['password']=Hash::make($password);
            $userSantri->save();
            $userSantri->assignRole('santri');
            
            
            // User Wali Santri
            $userWali = new User;
            $userWali['name']=$request->namaWali;
            $userWali['username']='wali'.$request->nis;
            $userWali['marhalah_id']=auth()->user()->marhalah_id;
            $userWali['password']=Hash::make($request->nis);
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
    function naikKelas(Request $request, Santri $id) {
        // Validasi input
        $request->validate([
            'kelasTujuan' => 'required|exists:kelas,id',
        ]);
    
        // Ambil ID kelas tujuan
        $kelasTujuan = $request->input('kelasTujuan');
    
        // Validasi tambahan: apakah santri sudah berada di kelas tujuan
        if ($id->kelas->contains($kelasTujuan)) {
            return redirect()->back()->with('error', 'Santri sudah berada di kelas yang dipilih.');
        }
    
        // Perbarui pivot dengan ID kelas tujuan
        $id->kelas()->sync([$kelasTujuan]);
    
        // Feedback atau redirect
        return redirect()->back()->with('success', 'Santri berhasil dipindahkan ke kelas baru!');
    }
    public function pindahSekolah(Request $request, Santri $id)
    {
        // Validasi input
        $request->validate([
            'kelas_sebelum_id' => 'required|exists:kelas,id',
            'sekolah_tujuan' => 'required|string|max:255',
            'tanggal_pindah' => 'required|date',
            'alasan_pindah' => 'required|string|max:1000',
        ]);
    
        // Periksa apakah santri benar-benar ada di kelas yang disebutkan
        if (!$id->kelas->contains($request->kelas_sebelum_id)) {
            return redirect()->back()->with('error', 'Santri tidak berada di kelas yang dipilih.');
        }
    
        // Masukkan data ke tabel `pindah_sekolah`
        DB::table('pindah_sekolah')->insert([
            'santri_id' => $id->id,
            'kelas_sebelum_id' => $request->kelas_sebelum_id,
            'sekolah_tujuan' => $request->sekolah_tujuan,
            'tanggal_pindah' => $request->tanggal_pindah,
            'alasan_pindah' => $request->alasan_pindah,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        // Hapus santri dari kelas sekarang
        $id->kelas()->detach($request->kelas_sebelum_id);
    
        // Feedback atau redirect
        return redirect()->back()->with('success', 'Santri berhasil dipindahkan ke sekolah tujuan!');
    }    

    public function keluarkanSantri(Request $request, Santri $id)
    {
        $request->validate([
            'kelas_sebelum_id' => 'required|exists:kelas,id',
            'tanggal_dikeluarkan' => 'required|date',
            'alasan_dikeluarkan' => 'required|string|max:255',
            // 'file_pendukung' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);
    
        // Simpan data santri dikeluarkan
        $santriDikeluarkan = SantriDikeluarkan::create([
            'santri_id' => $id->id,
            'kelas_sebelum_id' => $request->input('kelas_sebelum_id'),
            'tanggal_dikeluarkan' => $request->input('tanggal_dikeluarkan'),
            'alasan_dikeluarkan' => $request->input('alasan_dikeluarkan'),
        ]);
    
        // Tangani file unggahan
        if ($request->hasFile('file_pendukung')) {
            $file = $request->file('file_pendukung');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/santri_dikeluarkan', $fileName, 'public');
    
            // Simpan path file di database
            $santriDikeluarkan->file_pendukung = $filePath;
            $santriDikeluarkan->save();
        }
    
        // Hapus santri dari kelas sekarang
        $id->kelas()->detach();
    
        return redirect()->back()->with('success', 'Santri berhasil dikeluarkan.');
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
