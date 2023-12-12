@extends('layouts.tema')
@section('menuRaportSantri', 'active open')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">List Tutorial</h5>
            <div class="text-nowrap table-responsive">
                <table class="table ">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Link</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <tr>
                            <td>1</td>
                            <td><i class="fab fa-angular fa-lg text-danger"></i>
                                <strong> Guru - Input Nilai</strong>
                            </td>
                            <td><a href="https://youtu.be/HBfRys60bxk" target="_blank"> Klik Disini</a></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td><i class="fab fa-angular fa-lg text-danger"></i>
                                <strong> Wali Kelas - Cetak Raport</strong>
                            </td>
                            <td><a href="https://youtu.be/MjW3kP84bVc" target="_blank"> Klik Disini</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
