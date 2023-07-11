@extends('layouts.tema')
@section('menuKelas', 'active open')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> Kelas </span></h4>
        <x-alert />
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Daftar Kelas</h5>
            <div class="text-nowrap table-responsive">
                <table class="table ">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kelas</th>
                            <th>Wali Kelas</th>
                            <th>Aksi</th>
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
                                    @if ($i->waliKelas)
                                        <span class="text-primary">{{ $i->waliKelas->guru->nama }}</span>
                                    @else
                                        <span class="text-danger">Tidak ada Wali Kelas</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">

                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            @if ($i->waliKelas)
                                                <a class="dropdown-item"
                                                    href="{{ route('waliKelas-edit', ['kelas' => $i->id]) }}"><i
                                                        class="bx bx-edit-alt me-1"></i>
                                                    Ubah Wali Kelas</a>
                                            @else
                                                <a class="dropdown-item"
                                                    href="{{ route('waliKelas-tambah', ['kelas' => $i->id]) }}"><i
                                                        class="bx bx-edit-alt me-1"></i>
                                                    Tambah Wali Kelas</a>
                                            @endif
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
