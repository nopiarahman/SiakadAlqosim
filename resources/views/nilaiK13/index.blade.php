@extends('layouts.tema')
@section('menuNilaiGuru', 'active open')
@section('head')
    <link rel="stylesheet" href="{{ asset('template/css/vanilla-dataTables.min.css') }}">
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">
                Nilai Santri</span></h4>

        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Daftar Jadwal</h5>
            <div class="text-nowrap table-responsive">
                <table class="table " id="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kelas</th>
                            <th>Mapel</th>
                            <th>Nilai Harian</th>
                            <th>Nilai PTS</th>
                            <th>Nilai PAS</th>
                            <th>Nilai Raport</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($list as $i)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><i class="fab fa-angular fa-lg text-warning">
                                        <strong>{{ $i->kelas->nama }}</strong></i>
                                </td>
                                <td><i class="fab fa-angular fa-lg text-primary">
                                        <strong>{{ $i->mapel->nama }}</strong></i>
                                </td>
                                <td>
                                    <a class="btn btn-primary"
                                        href="{{ route('isi-nilai-pengetahuan', ['kelas' => $i->kelas_id, 'mapel' => $i->mapel_id]) }}">
                                        Nilai Pengetahuan</a>
                                    <a class="btn btn-primary "
                                        href="{{ route('isi-nilai-keterampilan', ['kelas' => $i->kelas_id, 'mapel' => $i->mapel_id]) }}">
                                        Nilai Keterampilan</a>
                                </td>
                                <td><a class="btn btn-primary me-1"
                                        href="{{ route('isi-nilai-pts', ['kelas' => $i->kelas_id, 'mapel' => $i->mapel_id]) }}">
                                        Nilai PTS</a></td>
                                <td><a class="btn btn-primary me-1"
                                        href="{{ route('isi-nilai-pas', ['kelas' => $i->kelas_id, 'mapel' => $i->mapel_id]) }}">
                                        Nilai PAS</a></td>
                                <td><a class="btn btn-primary me-1"
                                        href="{{ route('lihat-nilai-k13', ['kelas' => $i->kelas_id, 'mapel' => $i->mapel_id]) }}">
                                        Lihat Nilai</a></td>
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
