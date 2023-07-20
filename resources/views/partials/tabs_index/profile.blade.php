<div style="padding:1rem 0; min-height:68.5vh">
    {{-- <div class="alert alert-light">
        <p style="font-size:85%">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint debitis, suscipit deleniti fuga expedita esse
            natus minus porro animi cumque sequi culpa rerum? Enim odio eveniet dolorem inventore consequatur nisi.
        </p>
    </div>
    <div class="accordion accordion-flush" id="accordionFlushExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    Usahaku
                </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <table style="width:100%">
                        @php
                            if (empty(auth()->user()->idsibakul)) {
                                $merek = $toko->merkdagang;
                            } else {
                                $merek = auth()->user()->idsibakul;
                            }
                        @endphp
                        <tr>
                            <td style="width: 40%">
                                ID SiBakul
                            </td>
                            <td style="width: 60%">
                                {{ auth()->user()->idsibakul }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Nama usaha
                            </td>
                            <td>
                                {{ $merek }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                logo
                            </td>
                            <td>
                                @if (empty($toko->logo))
                                <span class="text-danger">Tidak ada data</span>
                                @else
                                <img src="https://sibakuljogja.jogjaprov.go.id/files/{{ $toko->logo }}"
                                    alt='{{ $merek }}' loading='lazy' style="height: 5rem">
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Merek Dagang
                            </td>
                            <td>
                                @if (empty($toko->merkdagang))
                                <span class="text-danger">Tidak ada data</span>
                                @else
                                {{ $toko->merkdagang }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Mulai Usaha
                            </td>
                            <td>
                                @if (empty(auth()->user()->mulai_usaha))
                                <span class="text-danger">Tidak ada data</span>
                                @else
                                {{ Carbon\Carbon::parse(auth()->user()->mulai_usaha)->translatedFormat('l, d F Y') }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Alamat Usaha
                            </td>
                            <td>
                                @if (empty(auth()->user()->alamat_usaha))
                                    <span class="text-danger">Tidak ada data</span>
                                @else
                                    {{ auth()->user()->alamat_usaha }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Sektor Usaha
                            </td>
                            <td>
                                @if (empty($toko->id_sektor))
                                <span class="text-danger">Tidak ada data</span>
                                @else
                                {{ $toko->id_sektor }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Jenis Ekraft
                            </td>
                            <td>
                                @if (empty($toko->id_ekraf))
                                <span class="text-danger">Tidak ada data</span>
                                @else
                                {{ $toko->id_ekraf }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Kegiatan Usaha
                            </td>
                            <td>
                                @if (empty(auth()->user()->kegiatan_usaha))
                                    <span class="text-danger">Tidak ada data</span>
                                @else
                                    {{ auth()->user()->kegiatan_usaha }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Produk Usaha
                            </td>
                            <td>
                                @if (empty(auth()->user()->produk_usaha))
                                    <span class="text-danger">Tidak ada data</span>
                                @else
                                    {{ auth()->user()->produk_usaha }}
                                @endif
                            </td>
                        </tr>
                    </table>
                    <hr>
                    Titik Lokasi Usaha
                    <table style="width:100%">
                        <tr>
                            <th>
                                Koordinat X
                            </th>
                            <th>
                                Koordinat Y
                            </th>
                        </tr>
                        <tr>
                            <th>
                                @if (empty($toko->lokasi_x))
                                <span class="text-danger">Tidak ada data</span>
                                @else
                                {{ $toko->lokasi_x }}
                                @endif
                            </th>
                            <th>
                                @if (empty($toko->lokasi_y))
                                <span class="text-danger">Tidak ada data</span>
                                @else
                                {{ $toko->lokasi_y }}
                                @endif
                            </th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                    Kelas Binaan
                </button>
            </h2>
            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
                data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <div class="alert alert-success">
                        untuk lebih memahami grafik kelas binaan usaha anda silahkan lakukan konsultasi di PLUT DISKOPUKM DIY
                    </div>
                    <div>
                        <!-- GRAPH GOES HERE -->
                    </div>
                    <div>
                        Klaster pembinaan: <span style="font-weight:600">Kelas 2</span>
                        <table class="table table-striped table-borderless table-hover">
                            <thead>
                                <tr>
                                    <th style="width:60%">
                                        uraian
                                    </th>
                                    <th style="width:40%" class=" text-center">
                                        nilai
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="font-weight: 600;width:60%"><a href="javascript:void(0);" style="text-decoration: none;">Aspek Kelembagaan</a></td>
                                    <td class="col-1 text-center"><!--NILAI GOES HERE-->1</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: 600;width:60%"><a href="javascript:void(0);" style="text-decoration: none;">Aspek Produksi</a></td>
                                    <td class="col-1 text-center"><!--NILAI GOES HERE-->2</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: 600;width:60%"><a href="javascript:void(0);" style="text-decoration: none;">Aspek Keuangan</a></td>
                                    <td class="col-1 text-center"><!--NILAI GOES HERE-->4</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: 600;width:60%"><a href="javascript:void(0);" style="text-decoration: none;">Aspek Pasar</a></td>
                                    <td class="col-1 text-center"><!--NILAI GOES HERE-->16</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: 600;width:60%"><a href="javascript:void(0);" style="text-decoration: none;">Aspek Pemasaran Online</a></td>
                                    <td class="col-1 text-center"><!--NILAI GOES HERE-->32</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: 600;width:60%"><a href="javascript:void(0);" style="text-decoration: none;">Aspek SDM</a></td>
                                    <td class="col-1 text-center"><!--NILAI GOES HERE-->64</td>
                                </tr>
                            </tbody>
                        </table> 
                    </div>
                    <hr>

                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                    Data Diri
                </button>
            </h2>
            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree"
                data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <table style="width:100%">
                        <tr>
                            <td style="width:20%">
                                NIK Mitra
                            </td>
                            <td style="width:80%; font-size:85%">
                                {{ auth()->user()->nik }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Nama Mitra
                            </td>
                            <td style="font-size:85%">
                                {{ auth()->user()->nama_lengkap }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Gender
                            </td>
                            <td style="font-size:85%">
                                @if (empty(auth()->user()->gender))
                                <span class="text-danger">Tidak ada data</span>
                                @else
                                {{ auth()->user()->gender }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>
                                TTL
                            </td>
                            <td style="font-size:85%">
                                @if (empty(auth()->user()->tpt_lahir) && empty(auth()->user()->tgl_lahir))
                                <span class="text-danger">Tidak ada data</span>
                                @else
                                {{ auth()->user()->tpt_lahir }},
                                {{ Carbon\Carbon::parse(auth()->user()->tgl_lahir)->translatedFormat('l, d F Y') }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Alamat KTP
                            </td>
                            <td style="font-size:85%">
                                {{ auth()->user()->alamat_ktp }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Domisili
                            </td>
                            <td style="font-size:85%">
                                @if (empty(auth()->user()->alamat_domisili))
                                <span class="text-danger">Tidak ada data</span>
                                @else
                                {{ auth()->user()->alamat_domisili }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Nomor WA
                            </td>
                            <td style="font-size:80%">
                                @if (empty(auth()->user()->no_hp))
                                <span class="text-danger">Tidak ada data</span>
                                @else
                                {{ auth()->user()->no_hp }}
                                <span style="font-size:75%">
                                    nomor ini digunakan untuk reset password jika anda lupa password
                                </span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="container">
        <!-- username -->
        <div class="row">
            <div class="col-12">
                <div class="card border-light">
                    <div class="card-body">
                        <h5 class="text-success">Detail User </h5>
                        <p style="margin: 0;">{{ auth()->user()->nama_lengkap }} | {{ auth()->user()->nama_usaha }}
                        </p>
                    </div>
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- username end -->
        <!-- data usaha -->
        <!-- toko -->
        <div class="row" >
            <div class="col-lg-5 col-md-5 col-sm-12 iq-mb-10" style="padding-top:1rem">
                    <div class="card border-light">
                        <div class="card-header border-light" style="background-color: #eeeeee">
                            <h5>Data Usaha</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12" style="padding-bottom:1rem">
                                    {{-- <td>
                                    logo
                                </td>
                                <td>
                                    @if (empty($toko->logo))
                                    <span class="text-danger">Tidak ada data</span>
                                    @else
                                    <img src="https://sibakuljogja.jogjaprov.go.id/files/{{ $toko->logo }}"
                                        alt='{{ $merek }}' loading='lazy' style="height: 5rem">
                                    @endif
                                </td> --}}

                                    @php
                                        $url_logo = 'https://sibakuljogja.jogjaprov.go.id/green.png';
                                        if (!empty($toko->logo)) {
                                            # code...
                                            $url_logo = 'https://sibakuljogja.jogjaprov.go.id/files/' . $toko->logo . '';
                                        }
                                    @endphp
                                    <div class="card"
                                        style="                                  
                                background:  url({!! $url_logo !!});
                                background-size:cover;
                                background-position: center;width:100% ;height:25rem">

                                    </div>
                                </div>
                                <div class="col-12">
                                    <table class="table table-striped table-borderless table-sm" style="margin: 0;">
                                        <tr>
                                            <td>Nama Usaha</td>
                                            <td>:</td>
                                            <td>
                                                @if (!empty(auth()->user()->nama_usaha))
                                                    {{ auth()->user()->nama_usaha }}
                                                @else
                                                    <span class="text-danger">Tidak ada data</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Merek Dagang</td>
                                            <td>:</td>
                                            <td>
                                                @if (!empty(auth()->user()->merkdagang))
                                                    {{ auth()->user()->merkdagang }}
                                                @else
                                                    <span class="text-danger">Tidak ada data</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>mulai usaha</td>
                                            <td>:</td>
                                            <td>
                                                @if (!empty(auth()->user()->mulai_usaha))
                                                    {{ Carbon\Carbon::parse(auth()->user()->mulai_usaha)->translatedFormat('l, d F Y') }}
                                                @else
                                                    <span class="text-danger">Tidak ada data</span>
                                                @endif

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Alamat usaha</td>
                                            <td>:</td>
                                            <td>
                                                @if (!empty(auth()->user()->alamat_usaha))
                                                    {{ auth()->user()->alamat_usaha }}
                                                @else
                                                    <span class="text-danger">Tidak ada data</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Sektor usaha</td>
                                            <td>:</td>
                                            <td>
                                                @if (!empty(auth()->user()->id_sektor))
                                                    {{ auth()->user()->id_ekraf }}<span class="text-danger">*</span>
                                                @else
                                                    <span class="text-danger">Tidak ada data</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Jenis Ekraft</td>
                                            <td>:</td>
                                            <td>
                                                @if (!empty(auth()->user()->id_ekraf))
                                                    {{ auth()->user()->id_ekraf }}<span class="text-danger">*</span>
                                                @else
                                                    <span class="text-danger">Tidak ada data</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kegiatan usaha</td>
                                            <td>:</td>
                                            <td>
                                                @if (!empty(auth()->user()->kegiatan_usaha))
                                                    {{ auth()->user()->kegiatan_usaha }}
                                                @else
                                                    <span class="text-danger">Tidak ada data</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Produk usaha</td>
                                            <td>:</td>
                                            <td>
                                                @if (!empty(auth()->user()->produk_usaha))
                                                    {{ auth()->user()->produk_usaha }}
                                                @else
                                                    <span class="text-danger">Tidak ada data</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <!-- data diri -->
            <div class="col-lg-7 col-md-7 col-sm-12 iq-mb-10" style="padding: 1rem 1.5rem">
                <div class="row">
                    <div class="card border-light"  style="padding:0">
                        <div class="card-header border-light" style="background-color: #eeeeee">
                            <h5>Data Diri</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                {{-- <div class="col-12" style="padding-bottom:1rem">
                                    <div class="card"
                                        style="                                  
                                    background:  url({!! $url_foto_diri !!});
                                    /* background-alt: {{ $data_pkl->nama_lengkap }}; */
                                    background-size:cover;
                                    background-position: center;width:100% ;height:25rem">
                                        
                                    </div>
                                </div> --}}
                                <div class="col-12">
                                    <table class="table table-striped table-borderless table-sm"
                                        style="width:100%; margin: 0;">
                                        <tr>
                                            <td>ID Sibakul</td>
                                            <td>:</td>
                                            <td>
                                                {{ auth()->user()->idsibakul }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Nama Lengkap</td>
                                            <td>:</td>
                                            <td>{{ auth()->user()->nama_lengkap }}</td>
                                        </tr>
                                        <tr>
                                            <td>Nomor WA</td>
                                            <td>:</td>
                                            <td>{{ auth()->user()->no_hp }}</td>
                                        </tr>
                                        <tr>
                                            <td>Gender</td>
                                            <td>:</td>
                                            <td>
                                                @if (!empty(auth()->user()->gender))
                                                    {{ auth()->user()->gender }}
                                                @else
                                                    <span class="text-danger">Tidak ada data</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Alamat KTP</td>
                                            <td>:</td>
                                            <td>
                                                @if (!empty(auth()->user()->alamat_ktp))
                                                    {{ auth()->user()->alamat_ktp }}
                                                @else
                                                    <span class="text-danger">Tidak ada data</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
    
                                            <td>Tempat tanggal lahir</td>
                                            <td>:</td>
                                            <td>
                                                @if (!empty(auth()->user()->tpt_lahir || auth()->user()->tgl_lahir))
                                                    {{ auth()->user()->tpt_lahir }},
                                                    {{ Carbon\Carbon::parse(auth()->user()->tgl_lahir)->translatedFormat('l d F Y') }}
                                                @else
                                                    <span class="text-danger">Tidak ada data</span>
                                                @endif
    
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Domisili</td>
                                            <td>:</td>
                                            <td>
                                                @if (!empty(auth()->user()->alamat_domisili))
                                                    {{ auth()->user()->alamat_domisili }}
                                                @else
                                                    <span class="text-danger">Tidak ada data</span>
                                                @endif
    
                                            </td>
                                        </tr>
                                        <tr>
    
                                            <td>NIK</td>
                                            <td>:</td>
                                            <td>{{ auth()->user()->nik }}</td>
                                        </tr>
                                        <tr>
    
                                            <td>Email</td>
                                            <td>:</td>
                                            <td>
                                                @if (!empty(auth()->user()->email))
                                                    {{ auth()->user()->email }}
                                                @else
                                                    <span class="text-danger">Tidak ada data</span>
                                                @endif
    
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Pendidikan</td>
                                            <td>:</td>
                                            <td>
                                                @if (!empty(auth()->user()->pendidikan))
                                                    {{ auth()->user()->pendidikan }}
                                                @else
                                                    <span class="text-danger">Tidak ada data</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>disabilitas</td>
                                            <td>:</td>
                                            <td>{{ auth()->user()->disabilitas }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="padding-top:1rem">
                    <div class="card border-light"  style="padding:0">
                        <div class="card-header border-light" style="background-color: #eeeeee">
                            <h5>Profil Usaha</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    @if (!empty(auth()->user()->profil_usaha))
                                    {!! auth()->user()->profil_usaha !!}
                                @else
                                    <span class="text-danger">Tidak ada data</span>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 iq-mb-10" style="padding-top:2rem">
                <div class="card border-light">
                    <div class="card-header border-light" style="background-color: #eeeeee">
                        <h5>Kelas Binaan</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="alert alert-warning">
                                untuk lebih memahami grafik kelas binaan usaha anda, silahkan lakukan konsultasi di PLUT
                                DISKOPUKM DIY
                            </div>
                            <div>
                                <!-- GRAPH GOES HERE -->
                            </div>
                            <div>
                                Klaster pembinaan: <span style="font-weight:600">Kelas 2</span>
                                <table class="table table-striped table-borderless table-hover">
                                    <thead>
                                        <tr>
                                            <th style="width:60%">
                                                uraian
                                            </th>
                                            <th style="width:40%" class=" text-center">
                                                nilai
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="font-weight: 600;width:60%"><a href="javascript:void(0);"
                                                    style="text-decoration: none;">Aspek Kelembagaan</a></td>
                                            <td class="col-1 text-center">
                                                <!--NILAI GOES HERE-->1
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: 600;width:60%"><a href="javascript:void(0);"
                                                    style="text-decoration: none;">Aspek Produksi</a></td>
                                            <td class="col-1 text-center">
                                                <!--NILAI GOES HERE-->2
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: 600;width:60%"><a href="javascript:void(0);"
                                                    style="text-decoration: none;">Aspek Keuangan</a></td>
                                            <td class="col-1 text-center">
                                                <!--NILAI GOES HERE-->4
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: 600;width:60%"><a href="javascript:void(0);"
                                                    style="text-decoration: none;">Aspek Pasar</a></td>
                                            <td class="col-1 text-center">
                                                <!--NILAI GOES HERE-->16
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: 600;width:60%"><a href="javascript:void(0);"
                                                    style="text-decoration: none;">Aspek Pemasaran Online</a></td>
                                            <td class="col-1 text-center">
                                                <!--NILAI GOES HERE-->32
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: 600;width:60%"><a href="javascript:void(0);"
                                                    style="text-decoration: none;">Aspek SDM</a></td>
                                            <td class="col-1 text-center">
                                                <!--NILAI GOES HERE-->64
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- userdata end -->
        <div class="d-flex justify-content-between">
            <div style="padding-top:1rem">
                <a type="button" class="btn btn-danger" href="{{ url('index') }}">Kembali</a>
            </div>
            <div class="ml-auto" style="padding-top:1rem">
                <a href='{{ url('lengkapi-data') }}' class="btn btn-danger">Ubah Data</a>
            </div>
        </div>
    </div>
</div>
