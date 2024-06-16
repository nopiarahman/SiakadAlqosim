<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel=Stylesheet href={{ asset('asset2/css/pask13.css') }}>
</head>

<body>
    {{-- Raport Semester --}}
    <table style="margin-left: 30px" cellpadding=0 cellspacing=0
        style='border-collapse:collapse;table-layout:fixed;width:644pt'>
        <col width=28 style='mso-width-source:userset;mso-width-alt:1075;width:21pt'>
        <col width=93 style='mso-width-source:userset;mso-width-alt:3584;width:70pt'>
        <col width=71 style='mso-width-source:userset;mso-width-alt:2713;width:53pt'>
        <col width=41 style='mso-width-source:userset;mso-width-alt:1587;width:31pt'>
        <col width=40 style='mso-width-source:userset;mso-width-alt:1536;width:30pt'>
        <col width=64 style='mso-width-source:userset;mso-width-alt:2457;width:48pt'>
        <col width=83 style='mso-width-source:userset;mso-width-alt:3174;width:62pt'>
        <col width=379 style='mso-width-source:userset;mso-width-alt:14540;width:284pt'>
        <col width=60 style='width:45pt'>
        <tr height=40></tr>
        <tr height=25 style='mso-height-source:userset;height:19.5pt'>
            <td colspan=8 height=25 class=xl75 width=799 style='height:19.5pt;width:599pt'>
                <font class="font5">PENCAPAIAN KOMPETENSI PESERTA DIDIK</font>
            </td>
            <td width=60 style='width:45pt'></td>
        </tr>
        <tr height=20></tr>
        <tr height=76 style='mso-height-source:userset;height:70.0pt'>
            <td colspan=7 height=76 class=xl76 width=420 style='height:57.0pt;width:315pt'>
                <font class="font7">Nama Sekolah<span style='mso-spacerun:yes'>       </span></font>
                <font class="font6">: PK-PPS AL-QOSIM JAMBI <br>
                </font>
                <font class="font7">Nama Marhalah<span style='mso-spacerun:yes'>     </span></font>
                <font class="font6">: {{ strtoupper($santri->marhalah->nama) }} <br>
                </font>
                <font class="font7">Alamat<span style='mso-spacerun:yes'>                 </span>
                </font>
                <font class="font6">:
                    Jl. Sungai Beluru, RT 01, Muaro Jambi<br>
                </font>
                <font class="font7">Nama<span style='mso-spacerun:yes'>                   </span>
                </font>
                <font class="font6">:
                    {{ $santri->namaLengkap }}<br>
                </font>
                <font class="font7">NIS / NISN<span style='mso-spacerun:yes'>           </span></font>
                <font class="font6">: {{ $santri->nis }}
                    / {{ $santri->nisn }}</font>
            </td>
            <td class=xl65 width=379 style='width:284pt'>
                <font class="font7">Kelas<span style='mso-spacerun:yes'>                      </span>
                </font>
                <font class="font6">: {{ $santri->kelas->first()->nama }}<br>
                </font>
                <font class="font7">Semester<span style='mso-spacerun:yes'>                </span>
                </font>
                <font class="font6">:
                    {{ ucfirst(getPeriodeAktif()->semester) }}<br>
                </font>
                <font class="font7">Tahun Pelajaran<span style='mso-spacerun:yes'>       </span></font>
                <font class="font6">: {{ getPeriodeAktif()->tahun }}</font>
            </td>

        </tr>
        <tr height=37 style='mso-height-source:userset;height:28.5pt'>
            <td colspan=8 height=37 class=xl76 width=799 style='height:28.5pt;width:599pt'>
                <font class="font6">A.<span style='mso-spacerun:yes'>    </span>SIKAP<br>
                </font>
                <font class="font6">1.<span style='mso-spacerun:yes'>
                    </span>Sikap Spiritual</font>
            </td>

        </tr>
        <tr height=21 style='mso-height-source:userset;height:16.25pt'>
            <td colspan=2 height=21 class=xl77 width=121
                style='border-right:.5pt solid black; height:16.25pt;width:91pt'>
                <font class="font6">Predikat</font>
            </td>
            <td colspan=6 class=xl77 width=678 style='border-right:.5pt solid black;border-left:none;width:508pt'>
                <font class="font6">Deskripsi</font>
            </td>
        </tr>
        <tr height=104 style='mso-height-source:userset;height:78.0pt'>
            <td colspan=2 height=104 class=xl80 width=121
                style='border-right:.5pt solid black;height:78.0pt;width:91pt'>
                <font class="font7">
                    {{ sikapWaliKelas($santri->id, getPeriodeAktif()->id, $key = 'predikat_spiritual') }}
                </font>
            </td>
            <td colspan=6 class=xl82 width=678 style='border-right:.5pt solid black;border-left:none;width:508pt'>
                <font class="font7">
                    {{ sikapWaliKelas($santri->id, getPeriodeAktif()->id, $key = 'deskripsi_spiritual') }}
                </font>
            </td>

        </tr>
        <tr height=19 style='mso-height-source:userset;height:14.25pt'>
            <td colspan=8 height=19 class=xl84 width=799 style='height:14.25pt;width:599pt'>
                <font class="font6">2.<span style='mso-spacerun:yes'>
                    </span>Sikap Sosial</font>
            </td>

        </tr>
        <tr height=21 style='mso-height-source:userset;height:16.25pt'>
            <td colspan=2 height=21 class=xl77 width=121
                style='border-right:.5pt solid black;height:16.25pt;width:91pt'>
                <font class="font6">Predikat</font>
            </td>
            <td colspan=6 class=xl77 width=678
                style='border-right:.5pt solid black;
            border-left:none;width:508pt'>
                <font class="font6">Deskripsi</font>
            </td>

        </tr>
        <tr height=104 style='mso-height-source:userset;height:78.0pt'>
            <td colspan=2 height=104 class=xl80 width=121
                style='border-right:.5pt solid black; height:78.0pt;width:91pt'>
                <font class="font7">
                    {{ sikapWaliKelas($santri->id, getPeriodeAktif()->id, $key = 'predikat_sosial') }}
                </font>
            </td>
            <td colspan=6 class=xl82 width=678 style='border-right:.5pt solid black; border-left:none;width:508pt'>
                <font class="font7">
                    {{ sikapWaliKelas($santri->id, getPeriodeAktif()->id, $key = 'deskripsi_sosial') }}
                </font>
            </td>

        </tr>
        <tr height=19 style='mso-height-source:userset;height:14.25pt'>
            <td colspan=8 height=19 class=xl84 width=799 style='height:14.25pt; width:599pt'>
                <font class="font6">B.<span style='mso-spacerun:yes'>
                    </span>PENGETAHUAN</font>
            </td>

        </tr>
        <tr height=24 style='mso-height-source:userset;height:18.0pt'>
            <td height=24 class=xl67 width=28 style='height:18.0pt;width:21pt'>
                <font class="font8">No</font>
            </td>
            <td colspan=2 class=xl85 width=164 style='border-right:.5pt solid black; border-left:none;width:123pt'>
                <font class="font8">Mata Pelajaran</font>
            </td>
            <td class=xl67 width=41 style='border-left:none;width:31pt'>
                <font class="font8">KKM</font>
            </td>
            <td class=xl67 width=40 style='border-left:none;width:30pt'>
                <font class="font8">Nilai</font>
            </td>
            <td class=xl68 width=64 style='border-left:none;width:48pt'>
                <font class="font9">Predikat</font>
            </td>
            <td colspan=2 class=xl87 width=462 style='border-right:.5pt solid black; border-left:none;width:346pt'>
                <font class="font8">Deskripsi</font>
            </td>

        </tr>
        {{-- Nilai Pengetahuan --}}
        @forelse ($nilaiPengetahuan as $i)
            <tr height=40 style='mso-height-source:userset; height:30pt'>
                <td height=45 class=xl69 style='height:34.25pt;border-top:none'>{{ $loop->iteration }}
                </td>
                <td colspan=2 class=xl93 width=164 style='border-right:.5pt solid black;border-left:none;width:123pt'>
                    <font class="font11">{{ $i->mapel->nama }}</font>
                </td>
                <td class=xl70 style='border-top:none;border-left:none'>
                    {{ $i->mapel->kkm }}
                </td>
                <td class=xl69 style='border-top:none;border-left:none'>
                    @if($i->PTS==null || $i->PAS==null||$i->keyOfHighestValueH()==null)
                                        {{$i->hitungNilaiAkhir()}}
                                    @elseif($i->hitungNilaiAkhir()<75)
                                        {{$i->mapel->kkm}}
                                    @else
                                        {{$i->hitungNilaiAkhir()}}
                                    @endif
                </td>
                <td class=xl71 width=64 style='border-top:none;border-left:none;width:48pt'>
                    <font class="font7">
                        @if($i->hitungNilaiAkhir()<$i->mapel->kkm)
                        {{$i->getPredikatNilai($i->mapel->kkm)}}
                    @else
                        {{$i->getPredikatNilai($i->hitungNilaiAkhir())}}
                    @endif
                    </font>
                </td>
                <td colspan=2 class=xl95 width=46
                    style='border-right:.5pt solid black;border-left:none;width:346pt;padding:0 12pt;'>
                    <font class="font13">{{ $i->getDeskripsiKD() }}</font>
                </td>
            </tr>
        @empty
            <tr>
                <td>
                    tidak ada data
                </td>
            </tr>
        @endforelse
        <tr height=17 style='height:13.0pt'>
            <td colspan=9 height=17 class=xl84 width=859 style='height:13.0pt;width:644pt'>C.<span
                    style='mso-spacerun:yes'>    </span>KETERAMPILAN</td>
        </tr>
        <tr height=17 style='height:13.0pt'>
            <td height=17 class=xl67 width=28 style='height:13.0pt;width:21pt'>
                <font class="font8">No</font>
            </td>
            <td colspan=2 class=xl85 width=164
                style='border-right:.5pt solid black;
            border-left:none;width:123pt'>
                <font class="font8">Mata Pelajaran</font>
            </td>
            <td class=xl67 width=41 style='border-left:none;width:31pt'>
                <font class="font8">KKM</font>
            </td>
            <td class=xl67 width=40 style='border-left:none;width:30pt'>
                <font class="font8">Nilai</font>
            </td>
            <td class=xl68 width=64 style='border-left:none;width:48pt'>
                <font class="font9">Predikat</font>
            </td>
            <td colspan=2 class=xl87 width=462
                style='border-right:.5pt solid black;
            border-left:none;width:346pt'>
                <font class="font8">Deskripsi</font>
            </td>
        </tr>
        {{-- Nilai Keterampilan --}}
        @forelse ($nilaiKeterampilan as $i)
            <tr height=40 style='mso-height-source:userset; height:30pt'>
                <td height=45 class=xl69 style='height:34.25pt;border-top:none'>{{ $loop->iteration }}
                </td>
                <td colspan=2 class=xl93 width=164 style='border-right:.5pt solid black;border-left:none;width:123pt'>
                    <font class="font11">{{ $i->mapel->nama }}</font>
                </td>
                <td class=xl70 style='border-top:none;border-left:none'>{{ $i->mapel->kkm }}</td>
                <td class=xl69 style='border-top:none;border-left:none'>
                    @if($i->keyOfHighestValueK() == null)
                                    {{ $i->hitungNilaiAkhirKeterampilan() }}
                                @elseif($i->hitungNilaiAkhirKeterampilan()<$i->mapel->kkm)
                                    {{$i->mapel->kkm}}
                                @else
                                    {{ $i->hitungNilaiAkhirKeterampilan() }}
                                @endif
                </td>
                <td class=xl71 width=64 style='border-top:none;border-left:none;width:48pt'>
                    <font class="font7">
                        @if($i->hitungNilaiAkhirKeterampilan()<$i->mapel->kkm)
                        {{$i->getPredikatNilai($i->mapel->kkm)}}
                    @else
                        {{ $i->getPredikatNilai($i->hitungNilaiAkhirKeterampilan()) }}
                    @endif
                    </font>
                </td>
                <td colspan=2 class=xl95 width=46
                    style='border-right:.5pt solid black;border-left:none;width:346pt;padding:0 12pt;'>
                    <font class="font13">{{ $i->getDeskripsiKDKeterampilan() }}</font>
                </td>
            </tr>
        @empty
            <tr>
                <td>
                    tidak ada data
                </td>
            </tr>
        @endforelse
        {{-- <tr height=17 style='height:13.0pt; margin-top: 12pt'>
                            <td height=17 class=xl67 width=28 style='height:13.0pt;width:21pt'>
                                <font class="font8">No</font>
                            </td>
                            <td colspan=2 class=xl85 width=164
                                style='border-right:.5pt solid black;
            border-left:none;width:123pt'>
                                <font class="font8">Mata Pelajaran</font>
                            </td>
                            <td class=xl67 width=41 style='border-left:none;width:31pt'>
                                <font class="font8">KKM</font>
                            </td>
                            <td class=xl67 width=40 style='border-left:none;width:30pt'>
                                <font class="font8">Nilai</font>
                            </td>
                            <td class=xl68 width=64 style='border-left:none;width:48pt'>
                                <font class="font9">Predikat</font>
                            </td>
                            <td colspan=2 class=xl87 width=462
                                style='border-right:.5pt solid black;
            border-left:none;width:346pt'>
                                <font class="font8">Deskripsi</font>
                            </td>
                        </tr> --}}
        <tr height=17 style='mso-height-source:userset;height:13.0pt'>
            <td colspan=8 height=17 class=xl108 width=799 style='height:13.0pt;
            width:599pt'>
                <font class="font6">D.<span style='mso-spacerun:yes'>
                    </span>EKSTRAKURIKULER</font>
            </td>
            <td class=xl100 width=60 style='width:45pt'></td>
        </tr>
        <tr class=xl97 height=37 style='height:28.0pt'>
            <td height=37 class=xl101 width=28 style='height:28.0pt;border-top:none;
            width:21pt'>
                <font class="font6">No.</font>
            </td>
            <td colspan=4 class=xl102 width=245
                style='border-right:.5pt solid black;
            border-left:none;width:184pt'>
                <font class="font6">Kegiatan Ekstrakurikuler</font>
            </td>
            <td class=xl101 width=64 style='border-top:none;border-left:none;width:48pt'>
                <font class="font6">Nilai</font>
            </td>
            <td colspan=2 class=xl105 width=462
                style='border-right:.5pt solid black;
            border-left:none;width:346pt'>
                <font class="font6">Keterangan</font>
            </td>

        </tr>
        {{-- Ekstrakurikuler --}}
        @if ($dataRaport)
            @foreach ($dataRaport->ekstrakurikuler as $i)
                <tr height=17 style='mso-height-source:userset;height:13.0pt'>
                    <td height=17 class=xl72 style='height:13.0pt;border-top:none'>{{ $loop->iteration }}
                    </td>
                    <td colspan=4 class=xl89 width=245
                        style='border-right:.5pt solid black;border-left:none;width:184pt'>
                        <font class="font11">{{ $i->nama }}</font>
                    </td>
                    <td class=xl73 width=64 style='border-top:none;border-left:none;width:48pt'>
                        <font class="font11">{{ $i->nilai }}</font>
                    </td>
                    <td colspan=2 class=xl89 width=462
                        style='border-right:.5pt solid black;border-left:none;width:346pt'>
                        <font class="font11">    {{ $i->keterangan }}</font>
                    </td>
                </tr>
            @endforeach
        @else
            <tr height=17 style='mso-height-source:userset;height:13.0pt'>
                <td height=17 class=xl72 style='height:13.0pt;border-top:none'>
                </td>
                <td colspan=4 class=xl89 width=245 style='border-right:.5pt solid black;border-left:none;width:184pt'>
                    <font class="font11"></font>
                </td>
                <td class=xl73 width=64 style='border-top:none;border-left:none;width:48pt'>
                    <font class="font11"></font>
                </td>
                <td colspan=2 class=xl89 width=462 style='border-right:.5pt solid black;border-left:none;width:346pt'>
                    <font class="font11">    </font>
                </td>
            </tr>
        @endif

        <tr height=17 style='mso-height-source:userset;height:13.0pt'>
            <td colspan=8 height=17 class=xl108 width=799 style='height:13.0pt;width:599pt'>
                <font class="font6">E.<span style='mso-spacerun:yes'>
                    </span>PRESTASI</font>
            </td>
            <td class=xl100 width=60 style='width:45pt'></td>
        </tr>
        <tr class=xl97 height=37 style='height:28.0pt'>
            <td height=37 class=xl101 width=28 style='height:28.0pt;border-top:none;width:21pt'>
                <font class="font6">No.</font>
            </td>
            <td colspan=4 class=xl102 width=245
                style='border-right:.5pt solid black;
            border-left:none;width:184pt'>
                <font class="font6">Jenis Prestasi</font>
            </td>
            <td colspan=3 class=xl105 width=526
                style='border-right:.5pt solid black;
            border-left:none;width:394pt'>
                <font class="font6">Keterangan</font>
            </td>

        </tr>
        @if ($dataRaport)
            @foreach ($dataRaport->prestasi as $i)
                <tr height=17 style='mso-height-source:userset;height:13.0pt'>
                    <td height=17 class=xl74 style='height:13.0pt;border-top:none'>1,</td>
                    <td colspan=4 class=xl82 width=245
                        style='border-right:.5pt solid black;border-left:none;width:184pt'>
                        <font class="font7">{{ $i->nama }}</font>
                    </td>
                    <td colspan=3 class=xl82 width=526
                        style='border-right:.5pt solid black;border-left:none;width:394pt'>
                        <font class="font7">    {{ $i->keterangan }}</font>
                    </td>
                </tr>
            @endforeach
        @else
            <tr height=17 style='mso-height-source:userset;height:13.0pt'>
                <td height=17 class=xl74 style='height:13.0pt;border-top:none'>1,</td>
                <td colspan=4 class=xl82 width=245 style='border-right:.5pt solid black;border-left:none;width:184pt'>
                    <font class="font7"></font>
                </td>
                <td colspan=3 class=xl82 width=526 style='border-right:.5pt solid black;border-left:none;width:394pt'>
                    <font class="font7">    </font>
                </td>
            </tr>
        @endif
        <tr height=17 style='mso-height-source:userset;height:13.0pt'>
            <td colspan=8 height=17 class=xl112 width=799 style='height:13.0pt;
            width:599pt'>
                <font class="font6">F.<span style='mso-spacerun:yes'>
                    </span>KETIDAKHADIRAN</font>
            </td>

        </tr>
        <tr height=19 style='mso-height-source:userset;height:14.0pt'>
            <td colspan=5 height=19 class=xl113 width=273 style='height:14.0pt;
            width:205pt'>
                <font class="font7">Sakit</font>
            </td>
            <td class=xl111 style='border-left:none'>{{ $dataRaport ? $dataRaport->s : '' }}</td>
            <td class=xl66 width=83 style='width:62pt'>
                <font class="font7">   hari</font>
            </td>
            <td colspan=2 style='mso-ignore:colspan'></td>
        </tr>
        <tr height=19 style='mso-height-source:userset;height:14.0pt'>
            <td colspan=5 height=19 class=xl113 width=273 style='height:14.0pt;
            width:205pt'>
                <font class="font7">Izin</font>
            </td>
            <td class=xl111 style='border-top:none;border-left:none'>
                {{ $dataRaport ? $dataRaport->i : '' }}</td>
            <td class=xl66 width=83 style='border-top:none;width:62pt'>
                <font class="font7">   hari</font>
            </td>
            <td colspan=2 style='mso-ignore:colspan'></td>
        </tr>
        <tr height=19 style='mso-height-source:userset;height:14.0pt'>
            <td colspan=5 height=19 class=xl113 width=273 style='height:14.0pt;
            width:205pt'>
                <font class="font7">Tanpa Keterangan</font>
            </td>
            <td class=xl111 style='border-top:none;border-left:none'>
                {{ $dataRaport ? $dataRaport->a : '' }}</td>
            <td class=xl66 width=83 style='border-top:none;width:62pt'>
                <font class="font7">   hari</font>
            </td>
            <td colspan=2 style='mso-ignore:colspan'></td>
        </tr>
        <tr height=17 style='mso-height-source:userset;height:13.0pt'>
            <td colspan=8 height=17 class=xl84 width=799 style='height:13.0pt;width:599pt'>
                <font class="font6">G.<span style='mso-spacerun:yes'>    </span>CATATAN WALI KELAS
                </font>
            </td>

        </tr>
        <tr class=xl97 height=64 style='mso-height-source:userset;height:48.0pt'>
            <td colspan=8 height=64 class=xl114 width=799 style='height:48.0pt;
            width:599pt'>
                <font class="font7">{{ $dataRaport ? $dataRaport->catatan : '' }}</font>
            </td>

        </tr>
        <tr height=17 style='mso-height-source:userset;height:13.0pt'>
            <td colspan=8 height=17 class=xl84 width=799 style='height:13.0pt;width:599pt'>
                <font class="font6">H.<span style='mso-spacerun:yes'>   </span>TANGGAPAN
                    ORANGTUA/WALI</font>
            </td>

        </tr>
        <tr height=65 style='mso-height-source:userset;height:49.0pt'>
            <td colspan=8 height=65 class=xl115 width=799 style='height:49.0pt;
            width:599pt'>
                &nbsp;
            </td>

        </tr>
        @if ($dataRaport->status != null && getPeriodeAktif()->semester === 'genap')
        <tr height=136 style='mso-height-source:userset;height:102.0pt'>
            <td colspan=7 height=136 class=xl118 width=420
                style='height:102.0pt;
width:315pt'>
                <font class="font6">Keputusan:<br>
                </font>
                <font class="font7">Berdasarkan pencapaian kompetensi pada semester
                    ke-1 dan ke-2, peserta didik ditetapkan *)<br>
                </font>
                @if($dataRaport->status=="naik")
                <font class="font7">naik ke kelas<span style='mso-spacerun:yes'>
                    </span>{{$dataRaport->tujuan}}<br>
                </font>
                @elseif($dataRaport->status=="tinggal")
                <font class="font7">tinggal di kelas<span style='mso-spacerun:yes'>
                </span>{{$dataRaport->tujuan}}<br>
                </font>
                @endif
            </td>
            <td colspan=2 style='mso-ignore:colspan'></td>
        </tr>
    @endif
        <tr height=40></tr>
        <tr height=132 style='mso-height-source:userset;height:99.0pt'>
            <td colspan="3" height=150 class=xl121 width=233 style='height:99.0pt;width:175pt'>
                Mengetahui: Orang Tua/Wali,<br>
            </td>
            <td colspan="4" class=xl121 width=233 style='width:175pt;text-align:center'>Wali Kelas</td>
            <td colspan="" class=xl121 width=233 style='width:175pt'>            Mekar Jaya, <span
                    id="currentDate"></span><br>
                <span style='mso-spacerun:yes'></span>            Kepala Sekolah<br>
            </td>
        </tr>
        <tr>
            <td colspan="3" height=150 class=xl121 width=233 style='height:99.0pt;width:175pt'>
                ........................................
            </td>
            <td colspan="4" class=xl121 style="text-align:center">
                {{ $santri->kelas->first()->waliKelas->guru->nama }}
            </td>
            <td class=xl121></span>            {{ $santri->marhalah->kepsek }}
            </td>
        </tr>
    </table>
    </div>
    </div>
    </div>
    </div>
</body>
<script>
    // Fungsi untuk mendapatkan tanggal saat ini dalam format Bahasa Indonesia
    function getCurrentDate() {
            const options = {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            };
            const currentDate = new Date().toLocaleDateString('id-ID', options);
            return currentDate;
        }

        // Mengganti nilai pada elemen dengan id "currentDate" dengan tanggal saat ini
        document.getElementById('currentDate').innerText = getCurrentDate();
    // Use window.onload to ensure the entire page is loaded before printing
    window.onload = function() {
        // Use the print() function to trigger the print dialog
        window.print();
        window.onafterprint = function() {
            // Kode yang dijalankan setelah selesai mencetak
            window.location.href = '{{ redirect()->back()->getTargetUrl() }}'
        };
    };
</script>

</html>
