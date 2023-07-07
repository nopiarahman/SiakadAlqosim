@extends('layouts.tema')
@section('menuMapel', 'active open')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{ url('/mapel') }}">Mata
                    Pelajaran</a> /
            </span>Tambah</h4>
        <x-alert />
        <div class="card mb-4">
            <h5 class="card-header">Tambah Mata Pelajaran Baru</h5>
            <div class="card-body">
                <div>
                    <form enctype="multipart/form-data" action="{{ route('mapel-simpan') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Nama Mata Pelajaran</label>
                            <input type="text" class="form-control" name="nama">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Nama Mata Pelajaran (Arab) </label>
                            <input type="text" class="form-control" name="namaArab">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">KKM</label>
                            <input type="number" class="form-control" name="kkm">
                        </div>
                        <div class="col-md">
                            <label class="form-label d-block">Kategori</label>
                            <div class="form-check form-check-inline ">
                                <input class="form-check-input" type="radio" name="kategori" id="inlineRadio1"
                                    value="diniyah" checked>
                                <label class="form-check-label" for="inlineRadio1">Diniyah</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kategori" id="inlineRadio2"
                                    value="umum">
                                <label class="form-check-label" for="inlineRadio2">Umum</label>
                            </div>
                        </div>
                        <div class="col-md">
                            <label class="form-label d-block">Jenis</label>
                            <div class="form-check form-check-inline ">
                                <input class="form-check-input" type="radio" name="jenis" id="inlineRadio1"
                                    value="teori" checked>
                                <label class="form-check-label" for="inlineRadio1">Teori</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis" id="inlineRadio2"
                                    value="praktek">
                                <label class="form-check-label" for="inlineRadio2">Praktek</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
