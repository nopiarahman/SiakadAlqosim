@extends('layouts.tema')
@section('menuMarhalah', 'active open')
@section('submenuMarhalah1', 'active')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{ url('/marhalah') }}"> Marhalah</a> /
            </span>Tambah</h4>
        <div class="card mb-4">
            <h5 class="card-header">Tambah Santri Baru</h5>
            <div class="card-body">
                <div>
                    <form enctype="multipart/form-data" action="{{ route('santri-kelas-simpan', ['kelas' => $kelas->id]) }}"
                        method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">NIK</label>
                            <input type="text" class="form-control" name="nik">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">NISN</label>
                            <input type="text" class="form-control" name="nisn">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Nama</label>
                            <input type="text" class="form-control" name="namaLengkap">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Tempat Lahir</label>
                            <input type="text" class="form-control" name="tempatLahir">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tanggalLahir">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Ibu Kandung</label>
                            <input type="text" class="form-control" name="namaIbu">
                        </div>
                        <div class="col-md">
                            <label class="form-label d-block">Jenis Kelamin</label>
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" type="radio" name="jenisKelamin" id="inlineRadio1"
                                    value="laki-laki">
                                <label class="form-check-label" for="inlineRadio1">Laki-Laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenisKelamin" id="inlineRadio2"
                                    value="perempuan">
                                <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
