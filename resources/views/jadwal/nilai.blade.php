@extends('layouts.tema')
@section('menuSantri', 'active open')
@section('subMenuSantri2', 'active')
{{-- @section('head')
    <link rel="stylesheet" href="{{ asset('template/css/vanilla-dataTables.min.css') }}">
@endsection --}}
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{ url('/jadwal-guru') }}"> Jadwal</a> /
            </span>{{ $id->mapel->nama }} Kelas {{ $id->kelas->nama }}</h4>
        <x-alert />
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Daftar Santri Kelas {{ $id->kelas->nama }}</h5>
            <div class="card-body">
                <small class="text-light fw-semibold d-block">Untuk menyimpan nilai, silahkan simpan per-nama santri satu per
                    satu</small>
                <div class="text-nowrap table-responsive">
                    <table class="table m-3">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Harian</th>
                                <th>Mid</th>
                                <th>UAS</th>
                                <th>Akhlak</th>
                                <th>Nilai Raport</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($santri as $i)
                                <tr>
                                    <form action="{{ route('jadwal-nilai-simpan', ['jadwal' => $id->id]) }}"
                                        enctype="multipart/form-data" method="POST">
                                        @csrf
                                        <input type="hidden" name="santri_id" value="{{ $i->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td><i class="fab fa-angular fa-lg text-danger"></i>
                                            <strong>{{ $i->namaLengkap }}</strong>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm" name="harian"
                                                style="width: 70px !important" value="{{ nilaiHarianSantri($id, $i->id) }}">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm" name="uts"
                                                style="width: 70px !important" value="{{ nilaiUtsSantri($id, $i->id) }}">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm" name="uas"
                                                style="width: 70px !important" value="{{ nilaiUasSantri($id, $i->id) }}">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm" name="akhlak"
                                                style="width: 70px !important"
                                                value="{{ nilaiAkhlakSantri($id, $i->id) }}">
                                        </td>
                                        <td>
                                            <span class="text-primary fw-bold">{{ nilaiRaport($id, $i->id) }}</span>
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

    <!-- Modal Hapus-->
    <div class="modal fade exampleModalCenter" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Hapus Kelas </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="formHapus">
                        @method('delete')
                        @csrf
                        <p class="modal-text"></p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Hapus!</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.slim.js"
        integrity="sha256-tXm+sa1uzsbFnbXt8GJqsgi2Tw+m4BLGDof6eUPjbtk=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#exampleModalCenter').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var id = button.data('id') // Extract info from data-bs-* attributes
                var nama = button.data('nama')
                var modal = $(this)
                modal.find('.modal-text').text('Yakin ingin menghapus santri ' + nama + ' ?')
                document.getElementById('formHapus').action = '/santri/' + id;
            })
        });
    </script>
@endsection
{{-- @section('script')
    <script src="{{ asset('template/js/vanilla-dataTables.min.js') }}"></script>
    <script>
        var table = document.querySelector('#table');
        var datatable = new DataTable(table);
    </script>
@endsection --}}
