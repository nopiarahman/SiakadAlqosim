@extends('layouts.tema')
@section('menuPeriode', 'active open')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{ url('/periode') }}">Periode</a> /
            </span>Edit</h4>
        <x-alert />
        <div class="card mb-4">
            <h5 class="card-header">Edit Periode</h5>
            <div class="card-body">
                <div>
                    <form enctype="multipart/form-data" action="{{ route('periode-update', ['id' => $id->id]) }}"
                        method="POST">
                        @csrf
                        @method('patch')
                        <div class="col-md mb-3">
                            <label class="form-label d-block">Semester</label>
                            <div class="form-check form-check-inline ">
                                <input class="form-check-input" type="radio" name="semester" id="inlineRadio1"
                                    value="ganjil" @if ($id->semester == 'ganjil') checked @endif>
                                <label class="form-check-label" for="inlineRadio1">Ganjil</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="semester" id="inlineRadio2"
                                    value="genap" @if ($id->semester == 'genap') checked @endif>
                                <label class="form-check-label" for="inlineRadio2">Genap</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Tahun</label>
                            <input type="text" class="form-control" name="tahun" value="{{ $id->tahun }}">
                        </div>
                        <div class="col-md">
                            <label class="form-label d-block">Status</label>
                            <div class="form-check form-check-inline ">
                                <input class="form-check-input" type="radio" name="status" id="inlineRadio1"
                                    value="aktif" @if ($id->status == 'aktif') checked @endif>
                                <label class="form-check-label" for="inlineRadio1">Aktif</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="inlineRadio2"
                                    value="nonaktif" @if ($id->status == 'nonaktif') checked @endif>
                                <label class="form-check-label" for="inlineRadio2">Tidak Aktif</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
