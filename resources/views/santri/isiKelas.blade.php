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
            <div class="text-nowrap">
                <table class="table table-responsive m-3" id="table">
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
                                            <button class="dropdown-item " data-bs-toggle="modal"
                                                data-bs-target="#exampleModalCenter" data-id="{{ $i->id }}"
                                                data-nama="{{ $i->namaLengkap }}">
                                                <i class="bx bx-trash me-1" aria-hidden="true"></i> Hapus</button>
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
