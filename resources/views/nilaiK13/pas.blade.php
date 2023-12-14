@extends('layouts.tema')
@section('menuNilaiGuru', 'active open')
{{-- @section('head')
    <link rel="stylesheet" href="{{ asset('template/css/vanilla-dataTables.min.css') }}">
@endsection --}}
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{ url('/nilai-guru') }}"> Nilai Santri</a> /
            </span>Nilai PAS {{ $mapel->nama }} Kelas {{ $kelas->nama }}</h4>
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
        <div class="card">
            <h5 class="card-header">Daftar Santri Kelas {{ $kelas->nama }}</h5>
            <div class="card-body">
                <div class="text-nowrap table-responsive">
                    <table class="table m-3">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Nilai PAS</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <form action="{{ route('nilaiK13-pas-simpan') }}" enctype="multipart/form-data" method="POST">
                                @foreach ($santri as $i)
                                    <tr>
                                        @csrf
                                        <input type="hidden" name="santri_id[]" value="{{ $i->id }}">
                                        <input type="hidden" name="mapel_id[]" value="{{ $mapel->id }}">
                                        <input type="hidden" name="kelas_id[]" value="{{ $kelas->id }}">
                                        <input type="hidden" name="kurikulum_id[]"
                                            value="{{ $kelas->kurikulums()->first()->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td><i class="fab fa-angular fa-lg text-danger"></i>
                                            <strong>{{ $i->namaLengkap }}</strong>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm" name="pas[]"
                                                style="width: 70px !important"
                                                value="{{ nilaiSantriPASK13($i->id, $kelas->id, $mapel->id, getPeriodeAktif()->id, $kelas->kurikulums()->first()->id) }}"
                                                max="100" min="0">
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3">
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Simpan Semua</button>
                                        </div>

                                    </td>
                                </tr>
                            </form>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
