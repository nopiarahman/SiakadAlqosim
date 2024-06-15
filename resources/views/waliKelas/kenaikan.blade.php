@extends('layouts.tema')
@section('menuDataRaport', 'active open')
@section('head')
    <link rel="stylesheet" href="{{ asset('template/css/vanilla-dataTables.min.css') }}">
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{ url('/data-raport') }}"> Data Raport</a> /
                <a href="{{ route('data-raport-kelas', ['kelas' => $kelas->id]) }}">Kelas {{ $kelas->nama }}</a> /
            </span>Kenaikan</h4>
        <x-alert />
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header ">Daftar Santri Kelas {{ $kelas->nama }}</h5>
            <div class="container text-nowrap table-responsive">
                <table class="table m-3" id="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Status Kenaikan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($kelas->santri as $i)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><i class="fab fa-angular fa-lg text-danger"></i>
                                    <strong>{{ $i->namaLengkap }}</strong>
                                </td>
                                @php
                                    $data = getStatusKenaikanSantri($i->id,getPeriodeAktif()->id);
                                @endphp
                                @if($data !=false && $data->status=='naik')
                                <td class="text-primary">{{ucfirst($data->status)." kelas ".$data->tujuan}}</td>
                                @elseif($data !=false && $data->status=='tinggal')
                                <td class="text-danger">{{ucfirst($data->status)." kelas ".$data->tujuan}}</td>
                                @else
                                <td class="text-warning">belum ada status kenaikan</td>
                                @endif
                                <td>
                                    <button class="btn btn-primary" type="button" class="btn btn-primary"
                                                data-bs-toggle="modal" data-bs-target="#modalEdit"
                                                data-nama="{{ $i->namaLengkap }}" data-id="{{ $i->id }}" data-kelas="{{$kelas->id}}"><i
                                                    class="bx bx-edit-alt me-1"></i>
                                                Edit</button>
                                </td>
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
                    <h5 class="modal-title" id="modalCenterTitle">Edit Kenaikan Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" id="formEdit">
                    @csrf
                    @method('patch')
                    <div class="modal-body">
                        <div class="row">
                            <h6 id="namaSantri"></h6>
                            <div class="col-md">
                                <label class="d-block">Status</label>
                                <div class="form-check form-check-inline mt-3">
                                  <input class="form-check-input" type="radio" name="status" value="naik" checked>
                                  <label class="form-check-label" for="inlineRadio1">Naik</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="status" value="tinggal">
                                  <label class="form-check-label" for="inlineRadio2">Tinggal</label>
                                </div>
                              </div>
                            <div class="col mb-3">
                                <label for="nameWithTitle" class="form-label">Ke Kelas</label>
                                <input type="text" name="tujuan" id="namaEdit" class="form-control"
                                    placeholder="Tulis kelas tujuan" />
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
    <script src="https://code.jquery.com/jquery-3.6.1.slim.js"
    integrity="sha256-tXm+sa1uzsbFnbXt8GJqsgi2Tw+m4BLGDof6eUPjbtk=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#modalEdit').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var id = button.data('id') // Extract info from data-bs-* attributes
                var kelas = button.data('kelas')
                var nama = button.data('nama')
                document.getElementById('formEdit').action = '/data-raport/kenaikan/' + kelas + '/'+id;
                $('#namaSantri').text(nama);
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
