@extends('layouts.tema')
@section('menuSantri', 'active open')
@section('subMenuSantri2', 'active')
@section('head')
    <link rel="stylesheet" href="{{ asset('template/css/vanilla-dataTables.min.css') }}">
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{ url('/kelas-santri') }}"> Kelas</a> /
            </span>Kelas {{ $id->nama }}</h4>
        <x-alert />
        <a href="{{ route('santri-kelas-tambah', ['kelas' => $id->id]) }}" type="button" class="btn btn-primary mb-3"> Tambah
            Santri
            Baru di Kelas ini
        </a>
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Daftar Santri Kelas {{ $id->nama }}</h5>
            <div class="text-nowrap table-responsive">
                <table class="table  m-3" id="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NISN</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($id->santri as $i)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $i->nisn }}</td>
                                <td><i class="fab fa-angular fa-lg text-danger"></i>
                                    <strong>{{ $i->namaLengkap }}</strong>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('edit-santri', ['id' => $i->id]) }}"><i
                                                    class="bx bx-edit-alt me-1"></i>
                                                Edit</a>
                                            <button class="dropdown-item text-primary " data-bs-toggle="modal"
                                            data-bs-target="#modalNaikKelas" data-id="{{ $i->id }}"
                                            data-nama="{{ $i->namaLengkap }}"><i 
                                                class='bx bxs-chevrons-up me-1'></i>
                                                 Naik Kelas</button>
                                            <button class="dropdown-item text-warning " data-bs-toggle="modal"
                                            data-bs-target="#modalPindahSekolah" data-id="{{ $i->id }}"
                                            data-nama="{{ $i->namaLengkap }}"><i class='bx bx-log-out me-1'></i>
                                                 Pindah Sekolah</button>
                                            <button class="dropdown-item text-danger " data-bs-toggle="modal"
                                            data-bs-target="#modalDikeluarkan" data-id="{{ $i->id }}"
                                            data-nama="{{ $i->namaLengkap }}"><i class='bx bx-x-circle me-1'></i>
                                                 Dikeluarkan!</button>
                                            {{-- <button class="dropdown-item " data-bs-toggle="modal"
                                                data-bs-target="#exampleModalCenter" data-id="{{ $i->id }}"
                                                data-nama="{{ $i->namaLengkap }}">
                                                <i class="bx bx-trash me-1" aria-hidden="true"></i> Hapus</button> --}}
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Dikeluarkan-->
    <div class="modal fade modalDikeluarkan" id="modalDikeluarkan" tabindex="-1" role="dialog"
        aria-labelledby="modalDikeluarkanTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Dikeluarkan dari Sekolah </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="formDikeluarkan" enctype="multipart/form-data">
                        @csrf
                        <p class="modal-text"></p>
                        <input type="hidden" name="kelas_sebelum_id" value="{{ $id->id }}">

                        <!-- Tanggal Dikeluarkan -->
                        <div class="mb-4">
                            <label for="tanggal_dikeluarkan" class="form-label">Tanggal Dikeluarkan</label>
                            <input 
                                type="date" 
                                name="tanggal_dikeluarkan" 
                                id="tanggal_dikeluarkan" 
                                class="form-control @error('tanggal_dikeluarkan') is-invalid @enderror" 
                                value="{{ old('tanggal_dikeluarkan') }}" 
                                required>
                            @error('tanggal_dikeluarkan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Alasan Dikeluarkan -->
                        <div class="mb-4">
                            <label for="alasan_dikeluarkan" class="form-label">Alasan Dikeluarkan</label>
                            <textarea 
                                name="alasan_dikeluarkan" 
                                id="alasan_dikeluarkan" 
                                class="form-control @error('alasan_dikeluarkan') is-invalid @enderror" 
                                rows="4" 
                                placeholder="Masukkan alasan..." 
                                required>{{ old('alasan_dikeluarkan') }}</textarea>
                            @error('alasan_dikeluarkan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Upload File Pendukung -->
                        <div class="mb-4">
                            <label for="file_pendukung" class="form-label">File Pendukung (Opsional)</label>
                            <input 
                                type="file" 
                                name="file_pendukung" 
                                id="file_pendukung" 
                                class="form-control @error('file_pendukung') is-invalid @enderror" >
                            @error('file_pendukung')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <p class="text-danger font-weight-bold">PERHATIAN!, Untuk Sekarang santri yang dikeluarkan dari sekolah tidak bisa di kembalikan aktif kembali, Cek data terlebih dahulu!</p>          
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Dikeluarkan!</button>
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
            $('#modalDikeluarkan').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var id = button.data('id') // Extract info from data-bs-* attributes
                var nama = button.data('nama')
                var modal = $(this)
                modal.find('.modal-text').text('Santri atas nama ' + nama + ' dikeluarkan?')
                document.getElementById('formDikeluarkan').action = '/santri/' + id + '/keluarkan';
            })
        });
    </script>
    <!-- Modal Pindah Sekolah-->
    <div class="modal fade modalPindahSekolah" id="modalPindahSekolah" tabindex="-1" role="dialog"
        aria-labelledby="modalPindahSekolahTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Pindah Sekolah </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="formNaik">
                        @csrf
                        <p class="modal-text"></p>
                        <input type="hidden" name="kelas_sebelum_id" value="{{$id->id}}">
                        <div class="mb-4">
                            <label for="sekolah_tujuan" class="form-label">Nama Sekolah Tujuan</label>
                            <input type="text" name="sekolah_tujuan" id="sekolah_tujuan" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label for="tanggal_pindah" class="form-label">Tanggal Pindah</label>
                            <input type="date" name="tanggal_pindah" id="tanggal_pindah" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label for="alasan_pindah" class="form-label">Alasan Pindah</label>
                            <textarea name="alasan_pindah" id="alasan_pindah" class="form-control" rows="4" required></textarea>
                        </div>      
                        <p class="text-danger font-weight-bold">PERHATIAN!, Untuk Sekarang santri yang dipindahkan sekolah tidak bisa di kembalikan aktif kembali, Cek data terlebih dahulu!</p>          
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Pindah Sekolah!</button>
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
            $('#modalPindahSekolah').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var id = button.data('id') // Extract info from data-bs-* attributes
                var nama = button.data('nama')
                var modal = $(this)
                modal.find('.modal-text').text('Santri atas nama ' + nama + ' pindah ke?')
                document.getElementById('formNaik').action = '/santri/pindahSekolah/' + id;
            })
        });
    </script>
    <!-- Modal Naik Kelas-->
    <div class="modal fade modalNaikKelas" id="modalNaikKelas" tabindex="-1" role="dialog"
        aria-labelledby="modalNaikKelasTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Naik Kelas </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="formNaik">
                        @csrf
                        <p class="modal-text"></p>
                        @error('kelasTujuan')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="mb-4">
                            <select name="kelasTujuan" class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" required>
                                <option value="" selected disabled>Pilih Kelas</option>
                                @foreach ($kelasMarhalah as $i)
                                <option value="{{$i->id}}">{{$i->nama}}</option>
                                @endforeach
                            </select>
                        </div>                        
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Naik Kelas!</button>
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
            $('#modalNaikKelas').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var id = button.data('id') // Extract info from data-bs-* attributes
                var nama = button.data('nama')
                var modal = $(this)
                modal.find('.modal-text').text('Naik Kelas santri atas nama ' + nama + ' ke?')
                document.getElementById('formNaik').action = '/santri/naikKelas/' + id;
            })
        });
    </script>
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
@section('script')
    <script src="{{ asset('template/js/vanilla-dataTables.min.js') }}"></script>
    <script>
        var table = document.querySelector('#table');
        var datatable = new DataTable(table);
    </script>
@endsection
