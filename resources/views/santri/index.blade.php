@extends('layouts.tema')
@section('menuSantri', 'active open')
@section('subMenuSantri2', 'active')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">
            </span>Daftar Santri</h4>
        <x-alert />
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Daftar Santri</h5>
            <div class="text-nowrap">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NISN</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($santri as $i)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $i->nisn }}</td>
                                <td>{{ $i->kelas->first()->nama }}</td>
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
                                            <a class="dropdown-item"
                                                href="{{ route('edit-marhalah', ['id' => $i->id]) }}"><i
                                                    class="bx bx-edit-alt me-1"></i> Edit</a>
                                            <button class="dropdown-item " data-bs-toggle="modal"
                                                data-bs-target="#exampleModalCenter" data-id="{{ $i->id }}"
                                                data-nama="{{ $i->nama }}">
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
@endsection
