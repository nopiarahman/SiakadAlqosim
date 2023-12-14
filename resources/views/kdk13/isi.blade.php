@extends('layouts.tema')
@section('menuKD', 'active open')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Kompetensi Dasar </h4>
        <x-alert />
        <div class="section-header">
            <button class="btn btn-primary" onclick="tampilForm1()" id="btnPengetahuan">KD Pengetahuan</button>
            <button class="btn btn-secondary ml-2" onclick="tampilForm2()" id="btnKeterampilan">KD Keterampilan</button>
            <script>
                function tampilForm1() {
                    document.getElementById('formPengetahuan').classList.remove('d-none');
                    document.getElementById('formKeterampilan').classList.add('d-none');

                    // Mengaktifkan tombol KD Keterampilan
                    document.getElementById('btnKeterampilan').classList.remove('btn-primary');
                    document.getElementById('btnKeterampilan').classList.add('btn-secondary');
                    document.getElementById('btnPengetahuan').classList.remove('btn-secondary');
                    document.getElementById('btnPengetahuan').classList.add('btn-primary');

                }

                function tampilForm2() {
                    document.getElementById('formPengetahuan').classList.add('d-none');
                    document.getElementById('formKeterampilan').classList.remove('d-none');
                    // Menonaktifkan tombol KD Keterampilan dan mengubah warnanya menjadi abu-abu
                    document.getElementById('btnKeterampilan').classList.remove('btn-secondary');
                    document.getElementById('btnKeterampilan').classList.add('btn-primary');
                    document.getElementById('btnPengetahuan').classList.remove('btn-primary');
                    document.getElementById('btnPengetahuan').classList.add('btn-secondary');
                }
            </script>
        </div>
        <div class="card mb-4" id="formPengetahuan">
            <h5 class="card-header">Tambah KD Pengetahuan</h5>
            <div class="card-body">
                <div>
                    <form enctype="multipart/form-data" action="{{ url('kd-guru/simpan') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleFormControlSelect1" class="form-label">Kode KD</label>
                            <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example"
                                required name="kode">
                                <option selected="">Pilih Kode</option>
                                <option value="h1">H1</option>
                                <option value="h2">H2</option>
                                <option value="h3">H3</option>
                                <option value="h4">H4</option>
                                <option value="h5">H5</option>
                                <option value="h6">H6</option>
                                <option value="h7">H7</option>
                                <option value="h8">H8</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Deskripsi</label>
                            <input type="text" class="form-control" id="basic-default-fullname"
                                placeholder="Masukkan deskripsi singkat kompetensi dasar" name="deskripsi">
                            <input type="hidden" name="kelas_id" value="{{ $kelas->id }}">
                            <input type="hidden" name="mapel_id" value="{{ $mapel->id }}">
                            <input type="hidden" name="periode_id" value="{{ getPeriodeAktif()->id }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
        {{-- FORM KETERAMPILAN --}}
        <div class="card mb-4 d-none" id="formKeterampilan">
            <h5 class="card-header">Tambah KD Keterampilan</h5>
            <div class="card-body">
                <div>
                    <form enctype="multipart/form-data" action="{{ url('kd-guru/simpan') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleFormControlSelect1" class="form-label">Kode KD</label>
                            <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example"
                                required name="kode">
                                <option selected="">Pilih Kode</option>
                                <option value="k1">K1</option>
                                <option value="k2">K2</option>
                                <option value="k3">K3</option>
                                <option value="k4">K4</option>
                                <option value="k5">K5</option>
                                <option value="k6">K6</option>
                                <option value="k7">K7</option>
                                <option value="k8">K8</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Deskripsi</label>
                            <input type="text" class="form-control" id="basic-default-fullname"
                                placeholder="Masukkan deskripsi singkat kompetensi dasar" name="deskripsi">
                            <input type="hidden" name="kelas_id" value="{{ $kelas->id }}">
                            <input type="hidden" name="mapel_id" value="{{ $mapel->id }}">
                            <input type="hidden" name="periode_id" value="{{ getPeriodeAktif()->id }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Daftar KD Kelas {{ $kelas->nama }}
                {{ $mapel->nama }}</h5>
            <div class="text-nowrap table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <tr class="table-success">
                            <td colspan="3">
                                <span class="text-primary fw-bold">Aspek Pengetahuan</span>
                            </td>
                        </tr>
                        @forelse ($kdPengetahuan as $index => $item)
                            @php
                                $itemArray = $item->toArray();
                                $deskripsiH = array_filter(
                                    $itemArray,
                                    function ($value, $key) {
                                        return preg_match('/^h\d+$/i', $key) && !is_null($value);
                                    },
                                    ARRAY_FILTER_USE_BOTH,
                                );
                            @endphp

                            @foreach ($deskripsiH as $kode => $deskripsi)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ strtoupper($kode) }}</td>
                                    <td>{{ $deskripsi }}</td>
                                </tr>
                            @endforeach
                        @empty
                            <tr>
                                <td>
                                    tidak ada data
                                </td>
                            </tr>
                        @endforelse
                        <tr class="table-success">
                            <td colspan="3">
                                <span class="text-primary fw-bold">Aspek Keterampilan</span>
                            </td>
                        </tr>
                        @forelse ($kdKeterampilan as $index => $item)
                            @php
                                $itemArray = $item->toArray();
                                $deskripsiK = array_filter(
                                    $itemArray,
                                    function ($value, $key) {
                                        return preg_match('/^k\d+$/i', $key) && !is_null($value);
                                    },
                                    ARRAY_FILTER_USE_BOTH,
                                );
                            @endphp

                            @foreach ($deskripsiK as $kode => $deskripsi)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ strtoupper($kode) }}</td>
                                    <td>{{ $deskripsi }}</td>
                                </tr>
                            @endforeach
                        @empty
                            <tr>
                                <td>
                                    tidak ada data
                                </td>
                            </tr>
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Hapus Halaqoh </h5>
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
                document.getElementById('formHapus').action = '/halaqoh/delete/' + id;
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
