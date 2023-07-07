@extends('layouts.tema')
@section('menuJadwal', 'active open')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">
                Jadwal</span></h4>

        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Pilih Kelas</h5>
            <div class="text-nowrap">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Isi Jadwal</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($kelas as $i)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><i class="fab fa-angular fa-lg text-danger"></i>
                                    <strong>{{ $i->nama }}</strong>
                                </td>
                                <td><a href="{{ route('isi-jadwal', ['kelas' => $i->id]) }}"><span
                                            class="badge bg-label-primary me-1">Isi
                                            Jadwal</span></a></td>
                                <td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
