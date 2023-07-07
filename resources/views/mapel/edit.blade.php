@extends('layouts.tema')
@section('menuMapel', 'active open')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{ url('/mapel') }}">Mata
                    Pelajaran</a> /
            </span>Edit</h4>
        <x-alert />
        <div class="card mb-4">
            <h5 class="card-header">Edit Mata Pelajaran {{ $id->nama }}</h5>
            <div class="card-body">
                <div>
                    <form enctype="multipart/form-data" action="{{ route('update-mapel', ['id' => $id->id]) }}" method="POST">
                        @csrf
                        @method('patch')
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Nama Mata Pelajaran</label>
                            <input type="text" class="form-control" name="nama" value="{{ $id->nama }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">KKM</label>
                            <input type="number" class="form-control" name="kkm" value="{{ $id->kkm }}">
                        </div>
                        <div class="col-md">
                            <label class="form-label d-block">Kategori</label>
                            <div class="form-check form-check-inline ">
                                <input class="form-check-input" type="radio" name="kategori" id="inlineRadio1"
                                    value="diniyah" @if ($id->kategori == 'diniyah') checked @endif>
                                <label class="form-check-label" for="inlineRadio1">Diniyah</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kategori" id="inlineRadio2"
                                    value="umum" @if ($id->kategori == 'umum') checked @endif>
                                <label class="form-check-label" for="inlineRadio2">Umum</label>
                            </div>
                        </div>
                        <div class="col-md">
                            <label class="form-label d-block">Jenis</label>
                            <div class="form-check form-check-inline ">
                                <input class="form-check-input" type="radio" name="jenis" id="inlineRadio1"
                                    value="teori" @if ($id->jenis == 'teori') checked @endif>
                                <label class="form-check-label" for="inlineRadio1">Teori</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis" id="inlineRadio2"
                                    value="praktek" @if ($id->jenis == 'praktek') checked @endif>
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
