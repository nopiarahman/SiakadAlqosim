@extends('layouts.tema')
@section('menuDataRaport', 'active open')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{ url('/data-raport') }}"> Data Raport</a> /
                <a href="{{ route('data-raport-kelas', ['kelas' => $kelas->id]) }}">Kelas {{ $kelas->nama }}</a> /
            </span>Absensi</h4>
        <x-alert />
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header ">Daftar Santri Kelas {{ $kelas->nama }}</h5>
            <div class="text-nowrap table-responsive">
                <table class="table m-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Sakit</th>
                            <th>Izin</th>
                            <th>Alfa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($kelas->santri as $i)
                            <tr>
                                <form enctype="multipart/form-data" method="POST"
                                    action="{{ route('absensi-santri-store') }}">
                                    @csrf
                                    <td>{{ $loop->iteration }}</td>
                                    <td><i class="fab fa-angular fa-lg text-danger"></i>
                                        <strong>{{ $i->namaLengkap }}</strong>
                                    </td>
                                    <td>
                                        <input type="hidden" name="santri_id" value="{{ $i->id }}">
                                        <input type="number" class="form-control form-control-sm" name="s"
                                            style="width: 70px !important"
                                            value="{{ absensi('s', $i->id, getPeriodeAktif()->id) }}" max="100"
                                            min="0">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control form-control-sm" name="i"
                                            style="width: 70px !important"
                                            value="{{ absensi('i', $i->id, getPeriodeAktif()->id) }}" max="100"
                                            min="0">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control form-control-sm" name="a"
                                            style="width: 70px !important"
                                            value="{{ absensi('a', $i->id, getPeriodeAktif()->id) }}" max="100"
                                            min="0">
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </td>
                                </form>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
