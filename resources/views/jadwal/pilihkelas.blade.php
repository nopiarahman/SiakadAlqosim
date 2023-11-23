@extends('layouts.tema')
@section('menuJadwal', 'active open')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">
                Jadwal</span></h4>

        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Pilih Kelas</h5>
            <div class="text-nowrap table-responsive">
                <table class="table ">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th colspan="2">Kurikulum</th>
                            <th>Isi Jadwal</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($kelas as $i)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><i class="fab fa-angular fa-lg text-danger"></i>
                                    <strong>{{ $i->nama }}</strong>
                                </td>
                                <td>
                                    @if ($i->kurikulums()->first() != null)
                                        <i class="fab fa-angular fa-lg text-primary">
                                            <strong>{{ $i->kurikulums()->first()->nama }}</strong></i>
                                    @else
                                        <i class="fab fa-angular fa-lg text-danger">
                                            <strong>Belum ada Kurikulum</strong></i>
                                    @endif
                                </td>
                                <td>
                                    @if ($i->kurikulums()->first() != null)
                                        <a style="cursor: pointer" class="badge bg-label-warning me-1"
                                            data-bs-toggle="modal" data-bs-target="#modalEdit"
                                            data-nama="{{ $i->nama }}" data-id="{{ $i->id }}"><i
                                                class="bx bx-edit-alt me-1"></i>
                                            Ganti Kurikulum</a>
                                    @else
                                        <a style="cursor: pointer" class="badge bg-label-primary me-1"
                                            data-bs-toggle="modal" data-bs-target="#modalEdit"
                                            data-nama="{{ $i->nama }}" data-id="{{ $i->id }}"><i
                                                class="bx bx-edit-alt me-1"></i>
                                            Pilih Kurikulum</a>
                                    @endif
                                </td>
                                <td>
                                    @if ($i->kurikulums()->first() != null)
                                        <a href="{{ route('isi-jadwal', ['kelas' => $i->id]) }}"><span
                                                class="badge bg-label-primary me-1">Isi
                                                Jadwal</span></a>
                                    @endif
                                </td>
                                <td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Pilih Kurikulum</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" id="formEdit" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <input type="hidden" id="kelasId" readonly name="kelas_id">
                                <input type="hidden" value="{{ getPeriodeAktif()->id }}" name="periode_id">
                                <label for="defaultSelect" class="form-label">Kurikulum</label>
                                <select id="defaultSelect" class="form-select" name="kurikulum_id">
                                    <option>Pilih Kurikulum..</option>
                                    @foreach ($kurikulum as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Pilih</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.slim.js"
        integrity="sha256-tXm+sa1uzsbFnbXt8GJqsgi2Tw+m4BLGDof6eUPjbtk=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#modalEdit').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var id = button.data('id') // Extract info from data-bs-* attributes\
                var nama = button.data('nama')
                document.getElementById('formEdit').action = '/jadwal/kurikulum/' + id;
                $('#kelasId').val(id);
            })
        });
    </script>
@endsection
