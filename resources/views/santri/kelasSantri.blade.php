@extends('layouts.tema')
@section('menuSantri', 'active open')
@section('subMenuSantri2', 'active')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">
                Kelas</span></h4>

        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Daftar Kelas Marhalah {{ auth()->user()->marhalah->nama }}</h5>
            <div class="text-nowrap table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Isi Kelas</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($kelas as $i)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><i class="fab fa-angular fa-lg text-danger"></i>
                                    <strong>{{ $i->nama }}</strong>
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
