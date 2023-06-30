@extends('layouts.tema')
@section('menuGuru', 'active open')
@section('subMenuGuru2', 'active')
@section('head')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> <a href="{{ url('/halaqoh') }}"> Halaqoh</a> </span> /
            Daftar Santri</h4>
        <x-alert />
        <div class="card mb-4">
            <h5 class="card-header">Tambah Santri di Halaqoh ini</h5>
            <div class="card-body">
                <div>
                    <form enctype="multipart/form-data" action="{{ route('halaqoh-isi-simpan', ['id' => $id->id]) }}"
                        method="POST">
                        @csrf
                        <select class="cari form-select" name="santri_id" style="height: 200px !important"></select>
                        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
                        <script type="text/javascript">
                            $('.cari').select2({
                                placeholder: 'Cari Santri...',
                                ajax: {
                                    url: '/cariSantri',
                                    dataType: 'json',
                                    delay: 250,
                                    processResults: function(data) {
                                        return {
                                            results: $.map(data, function(item) {
                                                return {
                                                    text: item.namaLengkap,
                                                    /* memasukkan text di option => <option>namaSurah</option> */
                                                    id: item.id /* memasukkan value di option => <option value=id> */
                                                }
                                            })
                                        };
                                    },
                                    cache: true
                                }
                            });
                        </script>
                        @error('objek')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Daftar Halaqoh</h5>
            <div class="text-nowrap">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($id->santri as $i)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><i class="fab fa-angular fa-lg text-danger"></i>
                                    <strong>{{ $i->namaLengkap }}</strong>
                                </td>
                                <td>{{ $i->kelas->first()->nama }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <button class="dropdown-item " data-bs-toggle="modal"
                                                data-bs-target="#exampleModalCenter" data-id="{{ $id->id }}"
                                                data-nama="{{ $i->namaLengkap }}">
                                                <i class="bx bx-trash me-1" aria-hidden="true"></i> Hapus</button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <td>
                                belum ada santri
                            </td>
                        @endforelse
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Hapus Santri dari Halaqoh </h5>
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
                modal.find('.modal-text').text('Yakin ingin menghapus nama ' + nama + ' ?')
                document.getElementById('formHapus').action = '/halaqoh/deleteSantri/' + id;
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
