@extends('layouts.tema')
@section('menuSantri', 'active open')
@section('subMenuSantri3', 'active')
@section('head')
    <link rel="stylesheet" href="{{ asset('template/css/vanilla-dataTables.min.css') }}">
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">
            </span>Daftar Santri Tidak Aktif</h4>
        <x-alert />
        <!-- Basic Bootstrap Table -->
        <div class="nav-align-top nav-tabs-shadow mb-6">
            <ul class="nav nav-tabs nav-fill" role="tablist">
              <li class="nav-item" role="presentation">
                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#pindahSekolah" aria-controls="pindahSekolah" aria-selected="true"><span class="d-none d-sm-block"><i class="tf-icons bx bx-log-out bx-sm me-1_5 align-text-bottom"></i> Pindah Sekolah</span><i class="bx bx-home bx-sm d-sm-none"></i></button>
              </li>
              <li class="nav-item" role="presentation">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#Dikeluarkan" aria-controls="Dikeluarkan" aria-selected="false" tabindex="-1"><span class="d-none d-sm-block"><i class="tf-icons bx bx-x-circle bx-sm me-1_5 align-text-bottom"></i> Dikeluarkan</span><i class="bx bx-user bx-sm d-sm-none"></i></button>
              </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane fade show active" id="pindahSekolah" role="tabpanel">
                <table class="table table-striped" id="tabelPindah">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Santri</th>
                            <th>Kelas Sebelum</th>
                            <th>Nama Sekolah Tujuan</th>
                            <th>Tanggal Pindah</th>
                            <th>Alasan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($santriPindah as $index => $pindah)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $pindah->santri->namaLengkap }}</td>
                            <td>{{ $pindah->kelasSebelum->nama ?? '-' }}</td>
                            <td>{{ $pindah->sekolah_tujuan }}</td>
                            <td>{{ $pindah->tanggal_pindah }}</td>
                            <td>{{ $pindah->alasan_pindah }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data santri pindah sekolah.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
              </div>
              <div class="tab-pane fade" id="Dikeluarkan" role="tabpanel">
                <table class="table table-striped" id="tabelDikeluarkan">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Santri</th>
                            <th>Kelas Sebelum</th>
                            <th>Tanggal Dikeluarkan</th>
                            <th>Alasan</th>
                            <th>File Pendukung</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($santriDikeluarkan as $index => $dikeluarkan)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $dikeluarkan->santri->namaLengkap }}</td>
                            <td>{{ $dikeluarkan->kelasSebelum->nama ?? '-' }}</td>
                            <td>{{ $dikeluarkan->tanggal_dikeluarkan }}</td>
                            <td>{{ $dikeluarkan->alasan_dikeluarkan }}</td>
                            <td>
                                @if ($dikeluarkan->file_pendukung)
                                <a href="{{ asset('storage/' . $dikeluarkan->file_pendukung) }}" target="_blank">Lihat File</a>
                                @else
                                Tidak Ada
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data santri dikeluarkan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
              </div>
            </div>
          </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('template/js/vanilla-dataTables.min.js') }}"></script>
    <script>
        var table = document.querySelector('#tabelPindah');
        var datatable = new DataTable(table);
    </script>
    <script>
        var table = document.querySelector('#tabelDikeluarkan');
        var datatable = new DataTable(table);
    </script>
@endsection
