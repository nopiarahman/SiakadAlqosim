@extends('layouts.tema')
@section('menuMarhalah', 'active open')
@section('submenuMarhalah1', 'active')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{ url('/marhalah') }}"> Marhalah</a> /
            </span>Tambah</h4>
        <div class="card mb-4">
            <h5 class="card-header">Tambah Marhalah Baru</h5>
            <div class="card-body">
                <div>
                    <form enctype="multipart/form-data" action="{{ url('marhalah/simpan') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Nama Marhalah</label>
                            <input type="text" class="form-control" id="basic-default-fullname"
                                placeholder="Masukkan nama marhalah" name="nama">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
