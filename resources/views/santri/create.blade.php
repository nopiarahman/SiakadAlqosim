@extends('layouts.tema')
@section('menuMarhalah', 'active open')
@section('submenuMarhalah1', 'active')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{ url('/kelas-santri') }}"> Santri</a> /
            </span>Tambah</h4>
        <x-alert />
        <div class="row">
            {{-- Data Santri --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4">
                        <h5 class="card-header">Data Santri</h5>
                        <div class="card-body">
                            <div>
                                <form enctype="multipart/form-data"
                                    action="{{ route('santri-kelas-simpan', ['kelas' => $kelas->id]) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-default-fullname">NIK</label>
                                        <input type="text" class="form-control" name="nik">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-default-fullname">NIS</label>
                                        <input type="text" class="form-control" name="nis">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-default-fullname">NISN</label>
                                        <input type="text" class="form-control" name="nisn">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-default-fullname">Nama</label>
                                        <input type="text" class="form-control" name="namaLengkap" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-default-fullname">Nama Panggilan</label>
                                        <input type="text" class="form-control" name="namaPanggilan">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-default-fullname">Tempat Lahir</label>
                                        <input type="text" class="form-control" name="tempatLahir">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-default-fullname">Tanggal Lahir</label>
                                        <input type="date" class="form-control" name="tanggalLahir" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-default-fullname">Bahasa Keseharian</label>
                                        <input type="text" class="form-control" name="bahasaKeseharian">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-default-fullname">Golongan Darah</label>
                                        <input type="text" class="form-control" name="golonganDarah">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-default-fullname">Riwayat Penyakit</label>
                                        <input type="text" class="form-control" name="penyakit">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label d-block">Ukuran Baju</label>
                                        <div class="form-check form-check-inline mt-3">
                                            <input class="form-check-input" type="radio" name="baju" id="inlineRadio1"
                                                value="XS">
                                            <label class="form-check-label" for="inlineRadio1">XS</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="baju" id="inlineRadio2"
                                                value="S">
                                            <label class="form-check-label" for="inlineRadio2">S</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="baju" id="inlineRadio2"
                                                value="M">
                                            <label class="form-check-label" for="inlineRadio2">M</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="baju"
                                                id="inlineRadio2" value="L">
                                            <label class="form-check-label" for="inlineRadio2">L</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="baju"
                                                id="inlineRadio2" value="XL">
                                            <label class="form-check-label" for="inlineRadio2">XL</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="baju"
                                                id="inlineRadio2" value="XXL">
                                            <label class="form-check-label" for="inlineRadio2">XXL</label>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <label class="form-label d-block">Jenis Kelamin</label>
                                        <div class="form-check form-check-inline mt-3">
                                            <input class="form-check-input" type="radio" name="jenisKelamin"
                                                id="inlineRadio1" value="laki-laki">
                                            <label class="form-check-label" for="inlineRadio1">Laki-Laki</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenisKelamin"
                                                id="inlineRadio2" value="perempuan">
                                            <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <h5 class="card-header">Data Sekolah Sebelum</h5>
                                <div class="card-body">
                                    <div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Nama Sekolah</label>
                                            <input type="text" class="form-control" name="sekolahSebelum">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Alamat</label>
                                            <input type="text" class="form-control" name="alamatSekolahSebelum">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">NISN Sekolah</label>
                                            <input type="text" class="form-control" name="nisnSekolahSebelum">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <h5 class="card-header">Data Wali Santri</h5>
                                <div class="card-body">
                                    <div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Nama Wali</label>
                                            <input type="text" class="form-control" name="namaWali" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Nama Panggilan</label>
                                            <input type="text" class="form-control" name="namaPanggilanWali">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Tempat Lahir</label>
                                            <input type="text" class="form-control" name="tempatLahirWali">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Tanggal Lahir</label>
                                            <input type="date" class="form-control" name="tanggalLahirWali" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Pendidikan</label>
                                            <input type="text" class="form-control" name="pendidikanWali">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Alamat</label>
                                            <input type="text" class="form-control" name="alamatWali">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Penghasilan</label>
                                            <input type="text" class="form-control" name="penghasilanWali">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Telepon</label>
                                            <input type="text" class="form-control" name="teleponWali">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Email</label>
                                            <input type="text" class="form-control" name="emailWali">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                {{-- Data Ayah --}}
                <div class="col-md-6">
                    <div class="card mb-4">
                        <h5 class="card-header">Data Ayah</h5>
                        <div class="card-body">
                            <div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Nama</label>
                                    <input type="text" class="form-control" name="namaAyah">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Nama Panggilan</label>
                                    <input type="text" class="form-control" name="namaPanggilanAyah">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Pendidikan</label>
                                    <input type="text" class="form-control" name="pendidikanAyah">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Alamat</label>
                                    <input type="text" class="form-control" name="alamatAyah">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Penghasilan</label>
                                    <input type="text" class="form-control" name="penghasilanAyah">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Telepon</label>
                                    <input type="text" class="form-control" name="teleponAyah">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Email</label>
                                    <input type="text" class="form-control" name="emailAyah">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Data Ibu --}}
                <div class="col-md-6">
                    <div class="card mb-4">
                        <h5 class="card-header">Data Ibu</h5>
                        <div class="card-body">
                            <div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Nama</label>
                                    <input type="text" class="form-control" name="namaIbu">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Nama Panggilan</label>
                                    <input type="text" class="form-control" name="namaPanggilanIbu">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Pendidikan</label>
                                    <input type="text" class="form-control" name="pendidikanIbu">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Alamat</label>
                                    <input type="text" class="form-control" name="alamatIbu">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Penghasilan</label>
                                    <input type="text" class="form-control" name="penghasilanIbu">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Telepon</label>
                                    <input type="text" class="form-control" name="teleponIbu">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Email</label>
                                    <input type="text" class="form-control" name="emailIbu">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
