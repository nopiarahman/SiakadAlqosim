@extends('layouts.tema')
@section('menuJadwalGuru', 'active open')
@section('head')
    <link rel="stylesheet" href="{{ asset('template/css/vanilla-dataTables.min.css') }}">
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">
                Jadwal</span></h4>

        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Daftar Jadwal</h5>
            <div class="text-nowrap">
                <table class="table table-responsive" id="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Hari</th>
                            <th>Kelas</th>
                            <th>Mapel</th>
                            <th>Jam</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($jadwal as $i)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><i class="fab fa-angular fa-lg text-danger"></i>
                                    <strong>{{ ucfirst($i->hari) }}</strong>
                                </td>
                                <td>{{ $i->kelas->nama }}</td>
                                <td>{{ $i->mapel->nama }}</td>
                                <td><span class="text-primary">{{ substr($i->mulai, 0, 5) }} -
                                        {{ substr($i->selesai, 0, 5) }}</span></td>
                                <td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('template/js/vanilla-dataTables.min.js') }}"></script>
    <script>
        var table = document.querySelector('#table');
        var datatable = new DataTable(table);
    </script>
@endsection
