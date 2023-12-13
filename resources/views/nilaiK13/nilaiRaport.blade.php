@extends('layouts.tema')
@section('menuNilaiGuru', 'active open')
{{-- @section('head')
    <link rel="stylesheet" href="{{ asset('template/css/vanilla-dataTables.min.css') }}">
@endsection --}}
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{ url('/nilai-guru') }}"> Nilai Santri</a> /
            </span>Nilai Raport {{ $mapel->nama }} Kelas {{ $kelas->nama }}</h4>
        <x-alert />
        <!-- Basic Bootstrap Table -->
        <div class="card mb-3 custom-card-1">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="card-title">{{ $mapel->nama }}</h5>
                        <h6 class="card-subtitle mb-2 text-white fw-bold">{{ $mapel->namaArab }}</h6>
                    </div>
                    <div class="col-md-6">
                        <span class="card-text fw-bold text-primary">KKM: {{ $mapel->kkm }}</span> <br>
                        <span class="card-text fw-bold text-primary">Rata-rata kelas: </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <h5 class="card-header">Daftar Santri Kelas {{ $kelas->nama }}</h5>
            <div class="card-body">
                <div class="text-nowrap table-responsive">
                    <table class="table m-3">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Nilai Pengetahuan</th>
                                <th>Nilai Keterampilan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($santri as $i)
                                <tr>
                                    <input type="hidden" name="santri_id" value="{{ $i->id }}">
                                    <input type="hidden" name="mapel_id" value="{{ $mapel->id }}">
                                    <input type="hidden" name="kelas_id" value="{{ $kelas->id }}">
                                    <input type="hidden" name="kurikulum_id"
                                        value="{{ $kelas->kurikulums()->first()->id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td><i class="fab fa-angular fa-lg text-danger"></i>
                                        <strong>{{ $i->namaLengkap }}</strong>
                                    </td>
                                    <td>
                                        @if (getNilaiPSantri($i->id, $kelas->id, $mapel->id) < $mapel->kkm)
                                            <strong
                                                class="text-danger fw-bold">{{ getNilaiPSantri($i->id, $kelas->id, $mapel->id) }}</strong>
                                        @else
                                            <strong
                                                class="text-success fw-bold">{{ getNilaiPSantri($i->id, $kelas->id, $mapel->id) }}</strong>
                                        @endif
                                    </td>
                                    <td>
                                        @if (getNilaiKSantri($i->id, $kelas->id, $mapel->id) < $mapel->kkm)
                                            <strong
                                                class="text-danger fw-bold">{{ getNilaiKSantri($i->id, $kelas->id, $mapel->id) }}</strong>
                                        @else
                                            <strong
                                                class="text-success fw-bold">{{ getNilaiKSantri($i->id, $kelas->id, $mapel->id) }}</strong>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-primary">Remedial</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
