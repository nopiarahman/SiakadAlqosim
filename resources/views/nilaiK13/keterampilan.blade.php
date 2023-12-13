@extends('layouts.tema')
@section('menuNilaiGuru', 'active open')
{{-- @section('head')
    <link rel="stylesheet" href="{{ asset('template/css/vanilla-dataTables.min.css') }}">
@endsection --}}
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{ url('/nilai-guru') }}"> Nilai Santri</a> /
            </span>Nilai Keterampilan {{ $mapel->nama }} Kelas {{ $kelas->nama }}</h4>
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
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-3">
            <h5 class="card-header">Daftar Kompetensi Dasar</h5>
            <div class="card-body">
                <h6 class="card-subtitle mb-2 text-muted ">Aspek Keterampilan</h6>
                <p class="card-text">
                    @if ($kdKeterampilan->first() != null)
                        @foreach ($kdKeterampilan->first()->only(['k1', 'k2', 'k3', 'k4', 'k5', 'k6', 'k7', 'k8']) as $key => $value)
                            @if ($value !== null && Str::startsWith($key, 'k'))
                                {{ ucfirst($key) }} = {{ $value }} <br>
                            @endif
                        @endforeach
                    @else
                        Tidak ada data Kompetensi Dasar, silahkan tambahkan
                        <a class="fw-bold"
                            href="{{ route('isi-kd-guru', ['kelas' => $kelas->id, 'mapel' => $mapel->id]) }}">DISINI</a>
                    @endif
                </p>
            </div>
        </div>
        <div class="card">
            <h5 class="card-header">Daftar Santri Kelas {{ $kelas->nama }}</h5>
            <div class="card-body">
                <small class="text-light fw-semibold d-block">Untuk menyimpan nilai, silahkan simpan per-nama santri satu
                    per
                    satu</small>
                <div class="text-nowrap table-responsive">
                    <table class="table m-3">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                {{-- KD Pengetahuan --}}
                                @if ($kdKeterampilan->first() != null)
                                    @foreach ($kdKeterampilan->first()->only(['k1', 'k2', 'k3', 'k4', 'k5', 'k6', 'k7', 'k8']) as $key => $value)
                                        @if (Str::startsWith($key, 'k') && !is_null($value))
                                            <th>{{ $key }}</th>
                                        @endif
                                    @endforeach
                                @endif
                                <th>RPH</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($santri as $i)
                                <tr>
                                    <form action="{{ route('nilaiK13-keterampilan-simpan') }}"
                                        enctype="multipart/form-data" method="POST">
                                        @csrf
                                        <input type="hidden" name="santri_id" value="{{ $i->id }}">
                                        <input type="hidden" name="mapel_id" value="{{ $mapel->id }}">
                                        <input type="hidden" name="kelas_id" value="{{ $kelas->id }}">
                                        <input type="hidden" name="kurikulum_id"
                                            value="{{ $kelas->kurikulums()->first()->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td><i class="fab fa-angular fa-lg text-danger"></i>
                                            <strong>{{ $i->namaLengkap }}</strong>
                                        </td>
                                        {{-- Nilai per KD Pengetahuan --}}
                                        @if ($kdKeterampilan->first() != null)
                                            @foreach ($kdKeterampilan->first()->only(['k1', 'k2', 'k3', 'k4', 'k5', 'k6', 'k7', 'k8']) as $key => $value)
                                                @if (Str::startsWith($key, 'k') && !is_null($value))
                                                    <td>
                                                        <input type="number" class="form-control form-control-sm"
                                                            name="{{ $key }}" style="width: 70px !important"
                                                            value="{{ nilaiSantriHarianK13($i->id, $kelas->id, $mapel->id, getPeriodeAktif()->id, $kelas->kurikulums()->first()->id, $key) }}"
                                                            max="100" min="0">
                                                    </td>
                                                @endif
                                            @endforeach
                                        @endif
                                        <td class="fw-bold text-primary">
                                            {{ nilaiRPHKeterampilan($i->id, $kelas->id, $mapel->id, getPeriodeAktif()->id, $kelas->kurikulums()->first()->id) }}
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
    </div>
@endsection
