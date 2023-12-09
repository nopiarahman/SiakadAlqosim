@extends('layouts.tema')
@section('menuDataRaport', 'active open')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{ url('/data-raport') }}"> Data Raport</a> /
            </span>Kelas {{ $kelas->nama }}</h4>
        <x-alert />

        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Daftar Data Raport</h5>
            <div class="card-body px-5">
                <div class="row">
                    <div class="card mb-3 custom-card-1 col-md-6">
                        <a href="{{ route('nilai-sikap', ['kelas' => $kelas->id]) }}">
                            <div class="card-body">
                                <h5 class="card-title">Nilai Sikap</h5>
                                <h6 class="card-subtitle mb-2 text-white fw-bold">Nilai Sikap dan Spiritual Santri</h6>
                            </div>
                        </a>
                    </div>
                    <div class="card mb-3 custom-card-1 col-md-6">
                        <a href="{{ route('absensi-santri', ['kelas' => $kelas->id]) }}">
                            <div class="card-body">
                                <h5 class="card-title">Absensi</h5>
                                <h6 class="card-subtitle mb-2 text-white fw-bold">Kehadiran Santri</h6>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="card mb-3 custom-card-1 col-md-6">
                        <a href="{{ route('eks-santri', ['kelas' => $kelas->id]) }}">
                            <div class="card-body">
                                <h5 class="card-title">Ekstrakurikuler</h5>
                                <h6 class="card-subtitle mb-2 text-white fw-bold">Ekstrakurikuler Santri</h6>
                            </div>
                        </a>
                    </div>
                    <div class="card mb-3 custom-card-1 col-md-6">
                        <a href="{{ route('prestasi-santri', ['kelas' => $kelas->id]) }}">
                            <div class="card-body">
                                <h5 class="card-title">Prestasi</h5>
                                <h6 class="card-subtitle mb-2 text-white fw-bold">Prestasi Santri</h6>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="card mb-3 custom-card-1 col-md-6">
                        <a href="{{ route('catatan-wali-kelas', ['kelas' => $kelas->id]) }}">
                            <div class="card-body">
                                <h5 class="card-title">Catatan Wali Kelas</h5>
                                <h6 class="card-subtitle mb-2 text-white fw-bold">Catatan Santri</h6>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
