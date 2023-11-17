@extends('layouts.tema')
@section('menuKurikulum', 'active open')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{ url('/kurikulum') }}">Kurikulum</a> /
            </span>Edit</h4>
        <x-alert />
        <div class="card mb-4">
            <h5 class="card-header">Edit Kurikulum</h5>
            <div class="card-body">
                <div>
                    <form enctype="multipart/form-data" action="{{ route('kurikulum-update', ['id' => $id->id]) }}"
                        method="POST">
                        @csrf
                        @method('patch')
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Nama</label>
                            <input type="text" class="form-control" name="nama" value="{{ $id->nama }}">
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
