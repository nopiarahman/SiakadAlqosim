@extends('layouts.tema')
@section('menuSantri', 'active open')
@section('subMenuSantri2', 'active')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{ url('/kelas-santri') }}"> Kelas</a> /
            </span>Kelas {{ $id->nama }}</h4>
        <x-alert />
        <a href="{{ route('santri-kelas-tambah', ['kelas' => $id->id]) }}" type="button" class="btn btn-success mb-3"> Tambah
            Santri
            Baru di Kelas ini
        </a>
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Daftar Santri Kelas {{ $id->nama }}</h5>
            <div class="text-nowrap">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Isi Kelas</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($id->santri as $i)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><i class="fab fa-angular fa-lg text-danger"></i>
                                    <strong>{{ $i->namaLengkap }}</strong>
                                </td>
                                <td><a href="{{ route('isi-kelas', ['id' => $i->id]) }}"><span
                                            class="badge bg-label-primary me-1">Isi
                                            Kelas</span></a></td>
                                <td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
