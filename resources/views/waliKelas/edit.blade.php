@extends('layouts.tema')
@section('menuJadwal', 'active open')
@section('head')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('template/css/vanilla-dataTables.min.css') }}">

@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> <a href="{{ url('/kelas') }}"> Kelas</a> </span> /
            Wali Kelas {{ $kelas->nama }}</h4>
        <x-alert />
        <div class="card mb-4">
            <h5 class="card-header">Edit Wali Kelas</h5>
            <div class="card-body">
                <div>
                    <form enctype="multipart/form-data" action="{{ route('waliKelas-update', ['kelas' => $kelas->id]) }}"
                        method="POST">
                        @method('patch')
                        @csrf
                        <label class="form-label" for="basic-default-fullname">Wali Kelas</label>
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
                        <input type="hidden" name="kelas_id" value="{{ $kelas->id }}">
                        <input type="hidden" name="periode_id" value="{{ getPeriodeAktif()->id }}">
                        <button type="submit" class="btn btn-primary mt-3">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
