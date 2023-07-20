{{-- <style>
    ::placeholder {
      color: red;
      opacity: 0.8; /* Firefox */
    }
    
    :-ms-input-placeholder { /* Internet Explorer 10-11 */
     color: red;
     opacity: 0.8;
    }
    
    ::-ms-input-placeholder { /* Microsoft Edge */
     color: red;
     opacity: 0.8;
    }
    </style> --}}
{{-- <form action="{{route('post_1')}}" method="post" id="form_1"> --}}
    {{-- @csrf --}}
    <h5>Data Diri</h5>
    @if (session()->has('successDataDiri'))
        <div class="alert alert-success alert-dismissible fade show rounded-0" role="alert">
            {{ session('successDataDiri') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"
                aria-label="Close"></button>
        </div>
    @endif
    <table class="table table-striped table-borderless table-sm">
        <tr>
            <td style="font-weight: 600;">ID Sibakul</td>
            <td style="font-weight: 600;">{{ $data_usaha->idsibakul }}</td>
        </tr>
        <tr>
            <td>NIK Mitra</td>
            <td>{{ $data_usaha->nik }}</td>
            {{-- <td style="padding: 0; padding-left: 0.25rem;">
                <input type="text" class="form-control-plaintext form-control-sm rounded-0" name="nik_1" id="nik_1" value="{{ $data_usaha->nik }}" placeholder="Data Belum Diisi">
            </td> --}}
        </tr>
        <tr>
            <td>Nama Mitra</td>
            <td>{{ $data_usaha->nama_lengkap }}</td>
            {{-- <td style="padding: 0; padding-left: 0.25rem;">
                <input type="text" class="form-control-plaintext form-control-sm rounded-0" name="nama_lengkap_1" id="nama_lengkap_1" value="{{ $data_usaha->nama_lengkap }}" placeholder="Data Belum Diisi">
            </td> --}}
        </tr>
        <tr>
            <td>Gender</td>
            @if ($data_usaha->gender)
                <td>{{ $data_usaha->gender }}</td>
            @else
                <td style="font-weight: 600; color:red;">Data Belum Diisi</td>
            @endif
            {{-- <td style="padding: 0;" id="td_gender_1">
                <select class="form-control-plaintext form-control-sm rounded-0" id="gender_1" name="gender_1" style="padding-left: 0">
                    <option hidden>Data Belum diisi</option>
                    <option value="Laki-Laki" {{{ (isset($data_usaha->gender) && $data_usaha->gender == "Laki-Laki") ? "selected=\"selected\"" : "" }}}>Laki-Laki</option>
                    <option value="Perempuan" {{{ (isset($data_usaha->gender) && $data_usaha->gender == "Perempuan") ? "selected=\"selected\"" : "" }}}>Perempuan</option>
                  </select>
            </td> --}}
        </tr>
        <tr>
            <td>TTL</td>
            @if ($data_usaha->tpt_lahir)
                @if ($data_usaha->tgl_lahir)
                    <td>{{ $data_usaha->tpt_lahir }}, {{ $data_usaha->tgl_lahir }}</td>
                @else
                    <td>{{ $data_usaha->tpt_lahir }}, <span style="font-weight: 600; color:red;">Data Belum Diisi</span></td>
                @endif
            @else
                <td style="font-weight: 600; color:red;">Data Belum Diisi</td>
            @endif
            {{-- <td style="padding: 0; padding-left: 0.25rem;">
                <div class="row" style="width: 100%;">
                    <div class="col-lg-auto">
                        <input type="text" class="form-control-plaintext form-control-sm rounded-0" name="tpt_lahir_1" id="tpt_lahir_1" value="{{ $data_usaha->tpt_lahir }}@if($data_usaha->tgl_lahir),@endif" style="width: auto;">
                    </div>
                    <div class="col-lg-auto">
                        <input type="text" class="form-control-plaintext form-control-sm rounded-0" name="tgl_lahir_1" id="tgl_lahir_1" value="{{ $data_usaha->tgl_lahir }}" placeholder="Data Belum Diisi">
                    </div>
                </div>
            </td> --}}
        </tr>
        <tr>
            <td>Alamat KTP</td>
            @if ($data_usaha->alamat_ktp)
                <td>{{ $data_usaha->alamat_ktp }}</td>
            @else
                <td style="font-weight: 600; color:red;">Data Belum Diisi</td>
            @endif
        </tr>
        <tr>
            <td>Domisili</td>
            @if ($data_usaha->alamat_domisili)
                <td>{{ $data_usaha->alamat_domisili }}</td>
            @else
                <td style="font-weight: 600; color:red;">Data Belum Diisi</td>
            @endif
        </tr>
        <tr>
            <td>Nomor WA</td>
            <td>{{ $data_usaha->no_hp }}</td>
        </tr>
        <tr>
            <td>Email</td>
            @if ($data_usaha->email)
                <td>{{ $data_usaha->email }}</td>
            @else
                <td style="font-weight: 600; color:red;">Data Belum Diisi</td>
            @endif
        </tr>
        <tr>
            <td>Pendidikan</td>
            @if ($data_usaha->pendidikan)
                <td>{{ $data_usaha->pendidikan }}</td>
            @else
                <td style="font-weight: 600; color:red;">Data Belum Diisi</td>
            @endif
        </tr>
        <tr>
            <td>Disabilitas</td>
            <td>{{ $data_usaha->disabilitas }}</td>
        </tr>
    </table>
    <a href="{{route('ubah_data', ['data' => 'data_diri'])}}" type="button" class="btn btn-warning btn-sm">Ubah Data</a>
    {{-- <div id="tombol_1">
        <button type="button" class="btn btn-warning" onclick="change1()" id="ubah_1">Ubah Data</button>
    </div> --}}
{{-- </form> --}}
{{-- <script type="text/javascript">
    document.getElementById('nik_1').readOnly = true;
    document.getElementById('nama_lengkap_1').readOnly = true;
    document.getElementById('gender_1').disabled = true;
    document.getElementById('tpt_lahir_1').disabled = true;
    document.getElementById('tgl_lahir_1').disabled = true;
    function change1() {
        document.getElementById("nik_1").className = "form-control form-control-sm rounded-0";
        document.getElementById('nik_1').readOnly = false;
        document.getElementById("nama_lengkap_1").className = "form-control form-control-sm rounded-0";
        document.getElementById('nama_lengkap_1').readOnly = false;
        document.getElementById("gender_1").className = "form-select form-select-sm rounded-0";
        document.getElementById('gender_1').disabled = false;
        document.getElementById("gender_1").style.paddingLeft = "0.5rem";
        document.getElementById("td_gender_1").style.paddingLeft = "0.25rem";
        $("#tombol_1").html("<button type='button' class='btn btn-danger' onclick='change1Alter()'' id='ubah_1'>Batal</button> <button type='submit' class='btn btn-success' id='submit_1'>Ubah Data</button>");
    }

    function change1Alter() {
        document.getElementById("nik_1").className = "form-control-plaintext form-control-sm rounded-0";
        document.getElementById('nik_1').readOnly = true;
        document.getElementById('form_1').reset();
        document.getElementById("nama_lengkap_1").className = "form-control-plaintext form-control-sm rounded-0";
        document.getElementById('nama_lengkap_1').readOnly = true;
        document.getElementById("gender_1").className = "form-control-plaintext form-control-sm rounded-0";
        document.getElementById('gender_1').disabled = true;
        document.getElementById("gender_1").style.paddingLeft = "0";
        document.getElementById("td_gender_1").style.paddingLeft = "0";
        $("#tombol_1").html("<button type='button' class='btn btn-warning' onclick='change1()' id='ubah_1'>Ubah Data</button>");
    }
</script> --}}

<hr id="page_data_usaha">

<h5>Data Usaha</h5>
@if (session()->has('successDataUsaha'))
    <div class="alert alert-success alert-dismissible fade show rounded-0" role="alert">
        {{ session('successDataUsaha') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"
            aria-label="Close"></button>
    </div>
@endif
<table class="table table-striped table-borderless table-sm">
    <tr>
        <td>Nama Usaha</td>
        @if ($data_usaha->nama_usaha)
            <td>{{ $data_usaha->nama_usaha }}</td>
        @else
            <td style="font-weight: 600; color:red;">Data Belum Diisi</td>
        @endif
    </tr>
    <tr>
        <td>logo</td>
        @if ($data_usaha->logo)
            <td><img src="https://sibakuljogja.jogjaprov.go.id/files/{{ $data_usaha->logo }}" alt="Logo {{ $data_usaha->nama_usaha }}" style="max-height: 7.5rem; max-width: 100%;"></td>
        @else
            <td style="font-weight: 600; color:red;">Data Belum Diisi</td>
        @endif
    </tr>
    <tr>
        <td>Merk Dagang</td>
        @if ($data_usaha->merkdagang)
            <td>{{ $data_usaha->merkdagang }}</td>
        @else
            <td style="font-weight: 600; color:red;">Data Belum Diisi</td>
        @endif
    </tr>
    <tr>
        <td>Mulai Usaha</td>
        @if ($data_usaha->mulai_usaha)
            <td>{{ $data_usaha->mulai_usaha }}</td>
        @else
            <td style="font-weight: 600; color:red;">Data Belum Diisi</td>
        @endif
    </tr>
    <tr>
        <td>Alamat Usaha</td>
        @if ($data_usaha->alamat_usaha)
            @if ($data_usaha->id_kelurahan && $data_usaha->id_kecamatan && $data_usaha->id_kota)
                <td>{{ $data_usaha->alamat_usaha }}, {{ $kelurahan->nama }} {{ $kecamatan->nama }} {{ $kota->nama }}</td>
            @else
                <td>{{ $data_usaha->alamat_usaha }}</td>
            @endif
        @else
            <td style="font-weight: 600; color:red;">Data Belum Diisi</td>
        @endif
    </tr>
    <tr>
        <td>Sektor Usaha</td>
        @if ($data_usaha->id_sektor)
            <td>{{ $data_usaha->id_sektor }}</td>
        @else
            <td style="font-weight: 600; color:red;">Data Belum Diisi</td>
        @endif
    </tr>
    <tr>
        <td>Jenis Ekraf</td>
        @if ($data_usaha->id_ekraf && $data_usaha->id_ekraf != 0)
            <td>{{ $data_usaha->id_ekraf }}</td>
        @else
            <td style="font-weight: 600; color:red;">Data Belum Diisi</td>
        @endif
    </tr>
    <tr>
        <td>Kegiatan Usaha</td>
        @if ($data_usaha->kegiatan_usaha)
            <td>{{ $data_usaha->kegiatan_usaha }}</td>
        @else
            <td style="font-weight: 600; color:red;">Data Belum Diisi</td>
        @endif
    </tr>
    <tr>
        <td>Produk Usaha</td>
        @if ($data_usaha->produk_usaha)
            <td>{{ $data_usaha->produk_usaha }}</td>
        @else
            <td style="font-weight: 600; color:red;">Data Belum Diisi</td>
        @endif
    </tr>
    <tr>
        <td>Profil Usaha</td>
        @if ($data_usaha->profil_usaha)
            <td>{!! $data_usaha->profil_usaha !!}</td>
        @else
            <td style="font-weight: 600; color:red;">Data Belum Diisi</td>
        @endif
    </tr>
</table>
<a href="{{route('ubah_data', ['data' => 'data_usaha'])}}" type="button" class="btn btn-warning btn-sm">Ubah Data</a>

<hr id="page_legalitas_usaha">

<div class="w-100">
    <div class="row d-flex justify-content-between align-items-center w-100" style="margin: 0 0 0.5rem 0;">
        <div class="col-auto" style="padding: 0;">
            <h5>Legalitas Usaha</h5>
        </div>
        <div class="col-auto">
            <a href="{{route('tambah_data', ['data' => 'legalitas_usaha'])}}" type="button" class="btn btn-success btn-sm" style="text-transform: capitalize; font-weight: 600;"><i class="fa-solid fa-plus"></i>&nbsp;&nbsp;Tambah</a>
        </div>
    </div>
    @if (session()->has('successLegalitasUsaha'))
        <div class="alert alert-success alert-dismissible fade show rounded-0" role="alert">
            {{ session('successLegalitasUsaha') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"
                aria-label="Close"></button>
        </div>
    @endif
    <div class="row d-flex justify-content-center w-100" style="margin: 0;">
        @if (count($legalitas_usaha) > 0)
            @foreach ($legalitas_usaha as $legalitas)
            <div class="col-lg-6 col-md-6 col-sm-12" style="margin: 0.5rem 0">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped table-borderless table-sm" style="margin: 0;">
                            <tr>
                                <td>LEGALITAS</td>
                                <td>{{ $legalitas->jenis }}</td>
                            </tr>
                            <tr>
                                <td style="font-weight: 600;">Nomor</td>
                                <td style="font-weight: 600;">{{ $legalitas->nomor }}</td>
                            </tr>
                            <tr>
                                <td>Berkas</td>
                                <td><a href="https://sibakuljogja.jogjaprov.go.id/files/{{ rawurlencode($legalitas->berkas) }}" target="_blank" style="text-decoration: none;">Lihat Berkas</a></td>
                            </tr>
                        </table>
                        <div class="row d-flex justify-content-around" style="margin-top: 0.5rem;">
                            <div class="col-6">
                                <a href="{{route('ubah_data', ['data' => 'legalitas_usaha', 'id' => $legalitas->id])}}" type="button" class="btn btn-warning btn-sm" style="width: 100%;">Ubah</a>
                            </div>
                            <div class="col-6">
                                <a href="{{route('hapus_legalitas_usaha', ['id' => $legalitas->id])}}" onclick="return confirm('hapus data ini?')" type="button" class="btn btn-danger btn-sm" style="width: 100%;">Hapus</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <p class="text-center text-danger" style="margin: 1rem 0;">Belum menambahkan legalitas usaha</p>
        @endif
    </div>
</div>

<hr id="page_model_bisnis">

<h5>Model Bisnis</h5>
<table class="table table-striped table-borderless table-sm">
    <tr>
        <td>Nilai Manfaat Produk</td>
        @if (isset($model_bisnis))
            @if ($model_bisnis->nilai_manfaat)
                <td>{{ $model_bisnis->nilai_manfaat }}</td>
            @else
                <td style="font-weight: 600; color:red;">Data Belum Diisi</td>
            @endif
        @else
            <td style="font-weight: 600; color:red;">Data Belum Diisi</td>
        @endif
    </tr>
    <tr>
        <td>Bentuk Pemberdayaan Masyarakat Sekitar dalam Proses Produksi</td>
        @if (isset($model_bisnis))
            @if ($model_bisnis->pemberdayaan_masyarakat)
                <td>{{ $model_bisnis->pemberdayaan_masyarakat }}</td>
            @else
                <td style="font-weight: 600; color:red;">Data Belum Diisi</td>
            @endif
        @else
            <td style="font-weight: 600; color:red;">Data Belum Diisi</td>
        @endif
    </tr>
    <tr>
        <td>Foto kegiatan Pemberdayaan</td>
        @if (isset($model_bisnis))
            @if ($model_bisnis->foto_kegiatan)
                <td><img src="https://sibakuljogja.jogjaprov.go.id/files/{{ rawurlencode($model_bisnis->foto_kegiatan) }}" alt="Foto Kegiatan {{ $data_usaha->nama_usaha }}" style="max-height: 15rem; max-width: 100%;"></td>
            @else
                <td style="font-weight: 600; color:red;">Data Belum Diisi</td>
            @endif
        @else
            <td style="font-weight: 600; color:red;">Data Belum Diisi</td>
        @endif
    </tr>
    <tr>
        <td>Mitra Utama dalam Produksi</td>
        @if (isset($model_bisnis))
            @if ($model_bisnis->mitra_utama)
                <td>{{ $model_bisnis->mitra_utama }}</td>
            @else
                <td style="font-weight: 600; color:red;">Data Belum Diisi</td>
            @endif
        @else
            <td style="font-weight: 600; color:red;">Data Belum Diisi</td>
        @endif
    </tr>
    <tr>
        <td>Aktivitas Utama Usaha</td>
        @if (isset($model_bisnis))
            @if ($model_bisnis->aktivitas_utama)
                <td>{{ $model_bisnis->aktivitas_utama }}</td>
            @else
                <td style="font-weight: 600; color:red;">Data Belum Diisi</td>
            @endif
        @else
            <td style="font-weight: 600; color:red;">Data Belum Diisi</td>
        @endif
    </tr>
    <tr>
        <td>Sumber Bahan Baku Utama</td>
        @if (isset($model_bisnis))
            @if ($model_bisnis->sumber_bahan_baku)
                <td>{{ $model_bisnis->sumber_bahan_baku }}</td>
            @else
                <td style="font-weight: 600; color:red;">Data Belum Diisi</td>
            @endif
        @else
            <td style="font-weight: 600; color:red;">Data Belum Diisi</td>
        @endif
    </tr>
    <tr>
        <td>Target Pasar/Segmentasi Konsumen</td>
        @if (isset($model_bisnis))
            @if ($model_bisnis->target_pasar)
                <td>{{ $model_bisnis->target_pasar }}</td>
            @else
                <td style="font-weight: 600; color:red;">Data Belum Diisi</td>
            @endif
        @else
            <td style="font-weight: 600; color:red;">Data Belum Diisi</td>
        @endif
    </tr>
    <tr>
        <td>Pola Hubungan dengan Konsumen</td>
        @if (isset($model_bisnis))
            @if ($model_bisnis->hubungan_konsumen)
                <td>{{ $model_bisnis->hubungan_konsumen }}</td>
            @else
                <td style="font-weight: 600; color:red;">Data Belum Diisi</td>
            @endif
        @else
            <td style="font-weight: 600; color:red;">Data Belum Diisi</td>
        @endif
    </tr>
    <tr>
        <td>Jaringan Distribusi</td>
        @if (isset($model_bisnis))
            @if ($model_bisnis->jaringan_distribusi)
                <td>{{ $model_bisnis->jaringan_distribusi }}</td>
            @else
                <td style="font-weight: 600; color:red;">Data Belum Diisi</td>
            @endif
        @else
            <td style="font-weight: 600; color:red;">Data Belum Diisi</td>
        @endif
    </tr>
    <tr>
        <td>Lampiran Business plan (pdf)</td>
        @if (isset($model_bisnis))
            @if ($model_bisnis->lampiran_business_plan)
                {{-- {{ $model_bisnis->lampiran_business_plan }} --}}
                <td><a href="https://sibakuljogja.jogjaprov.go.id/files/{{ rawurlencode($model_bisnis->lampiran_business_plan) }}" target="_blank" style="text-decoration: none;">Lihat Berkas</a></td>
            @else
                <td style="font-weight: 600; color:red;">Data Belum Diisi</td>
            @endif
        @else
            <td style="font-weight: 600; color:red;">Data Belum Diisi</td>
        @endif
    </tr>
</table>
<a href="{{route('ubah_data', ['data' => 'model_bisnis'])}}" type="button" class="btn btn-warning btn-sm">Ubah Data</a>