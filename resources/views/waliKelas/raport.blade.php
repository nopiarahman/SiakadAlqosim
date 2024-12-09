@extends('layouts.tema')
@section('menuCetakRaport', 'active open')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">
                Cetak Raport </span></h4>
        <x-alert />

        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Daftar Kelas</h5>
            <div class="text-nowrap table-responsive">
                <table class="table ">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kelas</th>
                            <th>Isi Kelas</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($listKelas as $i)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><i class="fab fa-angular fa-lg text-danger"></i>
                                    <strong>{{ $i->kelas->nama }}</strong>
                                </td>
                                <td>
                                    <a type="button" href="{{ route('list-kelas-walikelas', ['kelas' => $i->kelas->id]) }}"
                                        class="btn btn-primary">List Santri</a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
