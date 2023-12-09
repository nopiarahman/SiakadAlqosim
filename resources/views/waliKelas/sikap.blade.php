@extends('layouts.tema')
@section('menuDataRaport', 'active open')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{ url('/data-raport') }}"> Data Raport</a> /
                <a href="{{ route('data-raport-kelas', ['kelas' => $kelas->id]) }}">Kelas {{ $kelas->nama }}</a> /
            </span>Sikap</h4>
        <x-alert />
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header ">Daftar Santri Kelas {{ $kelas->nama }}</h5>
            <div class="container text-nowrap table-responsive ">
                <table class="table m-3 table-bordered">
                    <thead>
                        <tr>
                            <th rowspan="2">No</th>
                            <th rowspan="2">Nama</th>
                            <th colspan="2">Sikap Spiritual</th>
                            <th colspan="2">Sikap Sosial</th>
                            <th rowspan="2">Nilai</th>
                        </tr>
                        <tr>
                            <th>Predikat </th>
                            <th>Deskripsi </th>
                            <th>Predikat </th>
                            <th>Deskripsi </th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($kelas->santri as $i)
                            <tr>
                                <form enctype="multipart/form-data" method="POST"
                                    action="{{ route('nilai-sikap-store', ['kelas' => $kelas->id]) }}">
                                    @csrf
                                    <td>{{ $loop->iteration }}</td>
                                    <input type="hidden" name="santri_id" value="{{ $i->id }}">
                                    <td><i class="fab fa-angular fa-lg text-danger"></i>
                                        <strong>{{ $i->namaLengkap }}</strong>
                                    </td>
                                    <td>
                                        <input type="text" name="predikat_spiritual" id="" class="form-control"
                                            value="{{ sikapWaliKelas($i->id, getPeriodeAktif()->id, $key = 'predikat_spiritual') }}">
                                    </td>
                                    <td>
                                        <textarea name="deskripsi_spiritual" id="" cols="50" rows="3" class="form-control">{{ sikapWaliKelas($i->id, getPeriodeAktif()->id, $key = 'deskripsi_spiritual') }}</textarea>
                                    </td>
                                    <td>
                                        <input type="text" name="predikat_sosial" id="" class="form-control"
                                            value="{{ sikapWaliKelas($i->id, getPeriodeAktif()->id, $key = 'predikat_sosial') }}">
                                    </td>
                                    <td>
                                        <textarea name="deskripsi_sosial" id="" cols="50" rows="3" class="form-control">{{ sikapWaliKelas($i->id, getPeriodeAktif()->id, $key = 'deskripsi_sosial') }}</textarea>
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
