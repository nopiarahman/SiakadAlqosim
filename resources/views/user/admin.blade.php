@extends('layouts.tema')
@section('menuUser', 'active open')
@section('subMenuUser1', 'active')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin</h4>
        <x-alert />
        <div class="card mb-4">
            <h5 class="card-header">Tambah Admin Baru</h5>
            <div class="card-body">
                <div>
                    <form enctype="multipart/form-data" action="{{ url('kelas/simpan') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Email</label>
                            <input type="text" class="form-control" id="basic-default-fullname"
                                placeholder="Masukkan nama kelas" name="nama">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Daftar Admin</h5>
            <div class="text-nowrap">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        {{-- @foreach ($admin as $i)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><i class="fab fa-angular fa-lg text-danger"></i>
                                    <strong>{{ $i->nama }}</strong>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <button class="dropdown-item" type="button" class="btn btn-primary"
                                                data-bs-toggle="modal" data-bs-target="#modalEdit"
                                                data-nama="{{ $i->nama }}" data-id="{{ $i->id }}"><i
                                                    class="bx bx-edit-alt me-1"></i>
                                                Edit</button>
                                            <button class="dropdown-item " data-bs-toggle="modal"
                                                data-bs-target="#exampleModalCenter" data-id="{{ $i->id }}"
                                                data-nama="{{ $i->nama }}">
                                                <i class="bx bx-trash me-1" aria-hidden="true"></i> Hapus</button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach --}}
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
                modal.find('.modal-text').text('Yakin ingin menghapus kelas ' + nama + ' ?')
                document.getElementById('formHapus').action = '/kelas/delete/' + id;
            })
        });
    </script>
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Edit Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" id="formEdit">
                    @csrf
                    @method('patch')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameWithTitle" class="form-label">Nama</label>
                                <input type="text" name="nama" id="namaEdit" class="form-control"
                                    placeholder="Enter Name" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#modalEdit').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var id = button.data('id') // Extract info from data-bs-* attributes
                var nama = button.data('nama')
                document.getElementById('formEdit').action = '/kelas/update/' + id;
                $('#namaEdit').val(nama);
            })
        });
    </script>
@endsection
