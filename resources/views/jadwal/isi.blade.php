@extends('layouts.tema')
@section('menuJadwal', 'active open')
@section('head')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('template/css/vanilla-dataTables.min.css') }}">
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> <a href="{{ url('/jadwal') }}"> Jadwal</a> </span> /
            Isi Jadwal Kelas {{ $kelas->nama }}</h4>
        <x-alert />
        <div class="card mb-4">
            <h5 class="card-header">Tambah Jadwal Pelajaran</h5>
            <div class="card-body">
                <div>
                    <form enctype="multipart/form-data" action="{{ route('jadwal-simpan', ['kelas' => $kelas->id]) }}"
                        method="POST">
                        @csrf
                        <label class="form-label" for="basic-default-fullname">Pengampu</label>
                        <select class="cari form-select" name="guru_id" style="height: 200px !important"></select>
                        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
                        <script type="text/javascript">
                            $('.cari').select2({
                                placeholder: 'Cari Guru...',
                                ajax: {
                                    url: '/cariGuru',
                                    dataType: 'json',
                                    delay: 250,
                                    processResults: function(data) {
                                        return {
                                            results: $.map(data, function(item) {
                                                return {
                                                    text: item.nama,
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
                        <div class="mt-3">
                            <label for="defaultSelect" class="form-label">Mata Pelajaran</label>
                            <select id="defaultSelect" class="form-select" name="mapel_id">
                                <option>Pilih Mata Pelajaran..</option>
                                @forelse ($mapel as $m)
                                    <option value="{{ $m->id }}">{{ $m->nama }} ({{ ucfirst($m->jenis) }})
                                    </option>
                                @empty
                                    Belum ada Mata Pelajaran
                                @endforelse
                            </select>
                        </div>
                        <div class="mt-3">
                            <label for="defaultSelect" class="form-label">Hari</label>
                            <select id="defaultSelect" class="form-select" name="hari">
                                <option>Pilih Hari..</option>
                                <option value="sabtu">Sabtu</option>
                                <option value="ahad">Ahad</option>
                                <option value="senin">Senin</option>
                                <option value="selasa">Selasa</option>
                                <option value="rabu">Rabu</option>
                                <option value="kamis">Kamis</option>
                                <option value="jumat">Jumat</option>
                            </select>
                        </div>
                        <div class="mt-3">
                            <label class="form-label" for="basic-default-fullname">Jam Mulai</label>
                            <input type="time" class="form-control" id="basic-default-fullname" name="mulai"
                                onfocus="this.showPicker()">
                        </div>
                        <div class="mt-3">
                            <label class="form-label" for="basic-default-fullname">Jam Selesai</label>
                            <input type="time" class="form-control" id="basic-default-fullname" name="selesai"
                                onfocus="this.showPicker()">
                        </div>
                        <input type="hidden" name="kelas_id" value="{{ $kelas->id }}">
                        <input type="hidden" name="marhalah_id" value="{{ auth()->user()->marhalah_id }}">
                        <input type="hidden" name="periode_id" value="{{ $periodeId }}">
                        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Daftar Jadwal Kelas {{ $kelas->nama }}</h5>
            <div class="text-nowrap table-responsive">
                <table class="table " id="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Hari</th>
                            <th>Jam</th>
                            <th>Mapel</th>
                            <th>Pengampu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($jadwal as $i)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ ucfirst($i->hari) }}</td>
                                <td><span class="text-primary">{{ substr($i->mulai, 0, 5) }} -
                                        {{ substr($i->selesai, 0, 5) }}</span></td>
                                <td><i class="fab fa-angular fa-lg text-danger"></i>
                                    <strong>{{ $i->mapel->nama }}</strong>
                                </td>
                                <td>{{ $i->guru->nama }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <button class="dropdown-item " data-bs-toggle="modal"
                                                data-bs-target="#exampleModalCenter" data-id="{{ $i->id }}"
                                                data-santri="{{ $i->id }}" data-nama="{{ $i->namaLengkap }}">
                                                <i class="bx bx-trash me-1" aria-hidden="true"></i> Hapus</button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <td>
                                belum ada jadwal
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
                        <input type="hidden" name="santri_id" id="santriDelete">
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
                var santri = button.data('santri')
                var modal = $(this)
                modal.find('.modal-text').text('Yakin ingin menghapus nama ' + nama + ' ?')
                document.getElementById('formHapus').action = '/jadwal/delete/' + id;
                $('#santriDelete').val(santri);
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
@section('script')
    <script src="{{ asset('template/js/vanilla-dataTables.min.js') }}"></script>
    <script>
        var table = document.querySelector('#table');
        var datatable = new DataTable(table);
    </script>
@endsection
