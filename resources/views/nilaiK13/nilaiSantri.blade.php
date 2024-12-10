@extends('layouts.tema')
@section('menuNilaiSantri', 'active')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-primary fw-light">Nilai Santri Semester {{ ucfirst($periode->semester) }} Tahun Ajaran {{$periode->tahun}} </h4>
        <x-alert />
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Daftar Kelas Marhalah {{ $marhalah->nama }} </h5>
            <div class="text-nowrap table-responsive">
                <table class="table ">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($kelas as $i)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><i class="fab fa-angular fa-lg text-danger"></i>
                                    <strong>{{ $i->nama }}</strong>
                                </td>
                                <td>
                                    <a class="btn btn-primary me-1"
                                        href="#">
                                        Lihat Santri`</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
@endsection
