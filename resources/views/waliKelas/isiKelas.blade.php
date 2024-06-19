@extends('layouts.tema')
@section('menuRaportSantri', 'active open')
@section('head')
    <link rel="stylesheet" href="{{ asset('template/css/vanilla-dataTables.min.css') }}">
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{ url('/raport-kelas') }}"> Raport</a> /
            </span>Kelas {{ $kelas->nama }}</h4>
        <x-alert />
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Daftar Santri Kelas {{ $kelas->nama }}</h5>
            <div class="text-nowrap table-responsive">
                <table class="table  m-3" id="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Raport</th>
                            <th>Total Nilai Semester</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($kelas->santri as $i)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><i class="fab fa-angular fa-lg text-danger"></i>
                                    <strong>{{ $i->namaLengkap }}</strong>
                                </td>
                                <td>
                                    <a class="btn btn-primary"
                                        href="{{ route('raport-mid', ['santri' => $i->id, 'kelas' => $kelas->id]) }}"><i
                                            class="bx bx-edit-alt me-1"></i>
                                        Raport MID</a>
                                    <a class="btn btn-primary"
                                        href="{{ route('raport-semesterk13', ['santri' => $i->id, 'kelas' => $kelas->id]) }}"><i
                                            class="bx bx-edit-alt me-1"></i>
                                        Raport Semester</a>
                                </td>
                                <td>
                                    {{hitungTotalNilaiSemester($i->id,$kelas->id,getPeriodeAktif()->id)}}
                                </td>
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
