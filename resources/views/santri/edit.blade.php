@extends('layouts.tema')
@section('menuMarhalah', 'active open')
@section('submenuMarhalah1', 'active')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{ url('/kelas-santri') }}"> Santri</a> /
            </span>Edit</h4>

        <x-alert />
        <div class="row">
            {{-- Data Santri --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4">
                        <h5 class="card-header">Data Santri {{ $id->namaLengkap }}</h5>
                        <div class="card-body">
                            <div>
                                <form enctype="multipart/form-data" action="{{ route('update-santri', ['id' => $id->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('patch')
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-default-fullname">NIK</label>
                                        <input type="text" class="form-control" value="{{ $id->nik }}"
                                            name="nik" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-default-fullname">NISN</label>
                                        <input type="text" class="form-control" value="{{ $id->nisn }}"
                                            name="nisn">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-default-fullname">Nama</label>
                                        <input type="text" class="form-control" value="{{ $id->namaLengkap }}"
                                            name="namaLengkap" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-default-fullname">Nama Panggilan</label>
                                        <input type="text" class="form-control" value="{{ $id->namaPanggilan }}"
                                            name="namaPanggilan">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-default-fullname">Tempat Lahir</label>
                                        <input type="text" class="form-control" value="{{ $id->tempatLahir }}"
                                            name="tempatLahir">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-default-fullname">Tanggal Lahir</label>
                                        <input type="date" class="form-control" value="{{ $id->tanggalLahir }}"
                                            name="tanggalLahir" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-default-fullname">Bahasa Keseharian</label>
                                        <input type="text" class="form-control" value="{{ $id->bahasaKeseharian }}"
                                            name="bahasaKeseharian">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-default-fullname">Golongan Darah</label>
                                        <input type="text" class="form-control" value="{{ $id->golonganDarah }}"
                                            name="golonganDarah">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-default-fullname">Riwayat Penyakit</label>
                                        <input type="text" class="form-control" value="{{ $id->penyakit }}"
                                            name="penyakit">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label d-block">Ukuran Baju</label>
                                        <div class="form-check form-check-inline mt-3">
                                            <input class="form-check-input" type="radio" name="baju" id="inlineRadio1"
                                                value="XS" @if ($id->baju == 'XS') checked @endif>
                                            <label class="form-check-label" for="inlineRadio1">XS</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="baju" id="inlineRadio2"
                                                value="S" @if ($id->baju == 'S') checked @endif>
                                            <label class="form-check-label" for="inlineRadio2">S</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="baju" id="inlineRadio2"
                                                value="M" @if ($id->baju == 'M') checked @endif>
                                            <label class="form-check-label" for="inlineRadio2">M</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="baju"
                                                id="inlineRadio2" value="L"
                                                @if ($id->baju == 'L') checked @endif>
                                            <label class="form-check-label" for="inlineRadio2">L</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="baju"
                                                id="inlineRadio2" value="XL"
                                                @if ($id->baju == 'XL') checked @endif>
                                            <label class="form-check-label" for="inlineRadio2">XL</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="baju"
                                                id="inlineRadio2" value="XXL"
                                                @if ($id->baju == 'XXL') checked @endif>
                                            <label class="form-check-label" for="inlineRadio2">XXL</label>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <label class="form-label d-block">Jenis Kelamin</label>
                                        <div class="form-check form-check-inline mt-3">
                                            <input class="form-check-input" type="radio" name="jenisKelamin"
                                                id="inlineRadio1" value="laki-laki"
                                                @if ($id->jenisKelamin == 'laki-laki') checked @endif>
                                            <label class="form-check-label" for="inlineRadio1">Laki-Laki</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenisKelamin"
                                                id="inlineRadio2" value="perempuan"
                                                @if ($id->jenisKelamin == 'perempuan') checked @endif>
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
                                            <input type="text" class="form-control" value="{{ $id->sekolahSebelum }}"
                                                name="sekolahSebelum">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Alamat</label>
                                            <input type="text" class="form-control"
                                                value="{{ $id->alamatSekolahSebelum }}" name="alamatSekolahSebelum">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">NISN Sekolah</label>
                                            <input type="text" class="form-control"
                                                value="{{ $id->nisnSekolahSebelum }}" name="nisnSekolahSebelum">
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
                                            <input type="text" class="form-control" value="{{ $id->namaWali }}"
                                                name="namaWali" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Nama Panggilan</label>
                                            <input type="text" class="form-control"
                                                value="{{ $id->namaPanggilanWali }}" name="namaPanggilanWali">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Tempat Lahir</label>
                                            <input type="text" class="form-control"
                                                value="{{ $id->tempatLahirWali }}" name="tempatLahirWali">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Tanggal Lahir</label>
                                            <input type="text" class="form-control"
                                                value="{{ $id->tanggalLahirWali }}" name="tanggalLahirWali">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Pendidikan</label>
                                            <input type="text" class="form-control" value="{{ $id->pendidikanWali }}"
                                                name="pendidikanWali">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Alamat</label>
                                            <input type="text" class="form-control" value="{{ $id->alamatWali }}"
                                                name="alamatWali">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Penghasilan</label>
                                            <input type="text" class="form-control"
                                                value="{{ $id->penghasilanWali }}" name="penghasilanWali">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Telepon</label>
                                            <input type="text" class="form-control" value="{{ $id->teleponWali }}"
                                                name="teleponWali">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Email</label>
                                            <input type="text" class="form-control" value="{{ $id->emailWali }}"
                                                name="emailWali">
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
                                    <input type="text" class="form-control" value="{{ $id->namaAyah }}"
                                        name="namaAyah">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Nama Panggilan</label>
                                    <input type="text" class="form-control" value="{{ $id->namaPanggilanAyah }}"
                                        name="namaPanggilanAyah">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Pendidikan</label>
                                    <input type="text" class="form-control" value="{{ $id->pendidikanAyah }}"
                                        name="pendidikanAyah">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Alamat</label>
                                    <input type="text" class="form-control" value="{{ $id->alamatAyah }}"
                                        name="alamatAyah">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Penghasilan</label>
                                    <input type="text" class="form-control" value="{{ $id->penghasilanAyah }}"
                                        name="penghasilanAyah">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Telepon</label>
                                    <input type="text" class="form-control" value="{{ $id->teleponAyah }}"
                                        name="teleponAyah">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Email</label>
                                    <input type="text" class="form-control" value="{{ $id->emailAyah }}"
                                        name="emailAyah">
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
                                    <input type="text" class="form-control" value="{{ $id->namaIbu }}"
                                        name="namaIbu">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Nama Panggilan</label>
                                    <input type="text" class="form-control" value="{{ $id->namaPanggilanIbu }}"
                                        name="namaPanggilanIbu">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Pendidikan</label>
                                    <input type="text" class="form-control" value="{{ $id->pendidikanIbu }}"
                                        name="pendidikanIbu">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Alamat</label>
                                    <input type="text" class="form-control" value="{{ $id->alamatIbu }}"
                                        name="alamatIbu">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Penghasilan</label>
                                    <input type="text" class="form-control" value="{{ $id->penghasilanIbu }}"
                                        name="penghasilanIbu">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Telepon</label>
                                    <input type="text" class="form-control" value="{{ $id->teleponIbu }}"
                                        name="teleponIbu">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Email</label>
                                    <input type="text" class="form-control" value="{{ $id->emailIbu }}"
                                        name="emailIbu">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
