@extends('layouts.tema')
@section('menuMarhalah', 'active open')
@section('submenuMarhalah1', 'active')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Marhalah</h4>

        <x-alert />
        <a href="{{ url('/marhalah/tambah') }}" type="button" class="btn btn-success mb-3"> Tambah Marhalah Baru
        </a>
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Daftar Marhalah</h5>
            <div class="text-nowrap table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Kepala Sekolah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($marhalah as $i)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><i class="fab fa-angular fa-lg text-danger"></i>
                                    <strong>{{ $i->nama }}</strong>
                                </td>
                                <td><a href="{{ route('kelas-marhalah', ['marhalah' => $i->id]) }}"><span
                                            class="badge bg-label-primary me-1">Isi
                                            Kelas</span></a></td>
                                <td>
                                    @if ($i->kepsek)
                                        <span class="text-primary">{{ $i->kepsek }}</span>
                                    @else
                                        <span class="text-danger">Tidak ada Kepala Sekolah</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="{{ route('edit-marhalah', ['id' => $i->id]) }}"><i
                                                    class="bx bx-edit-alt me-1"></i> Edit</a>
                                            <button class="dropdown-item " data-bs-toggle="modal"
                                                data-bs-target="#exampleModalCenter" data-id="{{ $i->id }}"
                                                data-nama="{{ $i->nama }}">
                                                <i class="bx bx-trash me-1" aria-hidden="true"></i> Hapus</button>
                                            <button class="dropdown-item " data-bs-toggle="modal"
                                                data-bs-target="#addkepsek" data-id="{{ $i->id }}"
                                                data-nama="{{ $i->nama }}">
                                                <i class="bx bx-edit-alt me-1"></i> Data Kepala
                                                Sekolah</button>
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
    <!-- Modal Hapus-->
    <div class="modal fade exampleModalCenter" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Hapus Marhalah </h5>
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
                modal.find('.modal-text').text('Yakin ingin menghapus marhalah ' + nama + ' ?')
                document.getElementById('formHapus').action = '/marhalah/delete/' + id;
            })
        });
    </script>
    <!-- Modal Hapus-->
    <div class="modal fade addkepsek" id="addkepsek" tabindex="-1" role="dialog" aria-labelledby="addkepsekTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Data Kepala Sekolah </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="addkepsekform">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Kepala Sekolah</label>
                            <input type="text" class="form-control" name="kepsek">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
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
            $('#addkepsek').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var id = button.data('id') // Extract info from data-bs-* attributes
                var nama = button.data('nama')
                var modal = $(this)
                document.getElementById('addkepsekform').action = '/marhalah/kepsek/' + id;
            })
        });
    </script>
@endsection
