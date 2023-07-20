@extends('layouts.default')

@section('content')
    @include('partials.navbar-home')
    <div style="background-color: #cfe1d8; ">
        <div class="container" style="padding: 1rem 0;min-height:74vh">
            @if (session()->has('warning'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ session('warning') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <br>
            @endif
            <div class="alert alert-light">
                Halo Mitra SiBakul Jogja, silahkan mengisi produk anda dengan foto dan deskripsi yang menarik dan ikuti
                fasilitas pemasaran kami
            </div>
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Lengkapi Syarat Administrasi MarketHUB
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <p style="font-weight: 700; font-size:80%">Tambahan Kelengkapan data Wajib MarketHUB</p>
                            <table class="table table-striped">
                                <tr>
                                    <td>
                                        Lokasi UKM (GPS)
                                    </td>
                                    <td>
                                        {{-- {{dd($profil)}} --}}
                                        @if (empty($profil->lokasi_x) || empty($profil->lokasi_y))
                                            <i class="fa fa-circle-xmark text-danger"></i>
                                        @else
                                            <i class="fa fa-circle-check text-success"></i>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Rekening Pembayaran
                                    </td>
                                    <td>
                                        <i class="fa fa-circle-question text-danger"></i>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Profil Usaha
                                    </td>
                                    <td>
                                        {{-- @if (auth()->user())
                                        @else
                                        @endif --}}
                                        <i class="fa fa-circle-question text-danger"></i>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            Produk Baru/Pengajuan Kurasi
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <a class="btn btn-success" href='{{ route('tambah-barang') }}'><i
                                    class="fa fa-square-plus"></i></a>
                            <hr>
                            @foreach ($tidak as $dagangan_n)
                                @php
                                    if (empty($dagangan_n->produk_foto)) {
                                        $gambar = 'asset(images/SiBakul.png)';
                                    } else {
                                        $gambar = 'https://sibakuljogja.jogjaprov.go.id/files/' . $dagangan_n->produk_foto . '';
                                    }
                                    
                                    // $kurasi = '';
                                    $kurasi_raw = $dagangan_n->lolos_kurasimarkethub;
                                    switch ($kurasi_raw) {
                                        case 'Ya':
                                        $kurasi = 'lolos kurasi';
                                            break;
                                        case 'Tidak':
                                        $kurasi = 'tidak lolos kurasi';
                                            break;
                                        case 'Proses':
                                        $kurasi = 'Proses kurasi';
                                            break;
                                        case 'Revisi':
                                        $kurasi = 'mohon perbaiki data barang ini';
                                            break;
                                    }
                                    // $kurasi_raw = $dagangan_n->lolos_kurasimarkethub;
                                    // if ($kurasi_raw == 'N') {
                                    //     $kurasi = 'TIDAK LOLOS KURASI';
                                    // } else {
                                    //     $kurasi = 'DALAM PROSES';
                                    // }
                                    
                                    if (!empty($dagangan_n->nominal)) {
                                        $harga = $dagangan_n->harga - ($dagangan_n->harga * $dagangan_n->nominal) / 100;
                                    } else {
                                        $harga = $dagangan_n->harga;
                                    }
                                    
                                @endphp
                                <div style="padding-bottom:1rem">
                                    <div class="card">
                                        <div style="padding:0.5rem">
                                            <div class="row">
                                                <div class="col-lg-7 col-md-7 col-sm-12 d-flex h-100">
                                                    <div style="width:100%">
                                                        <img style="width:100%" src="{{ $gambar }}"
                                                            alt="{{ $dagangan_n->nama }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-5 col-md-5 col-sm-12 h-100"
                                                    style="padding-bottom: 1rem;">
                                                    <p style="font-size: 80%; font-weight:600; margin:0%">
                                                        {{ $dagangan_n->nama }}
                                                    </p>
                                                    <p>Harga: Rp. {{ number_format($dagangan_n->harga, 0, ',', '.') }},-
                                                    </p>

                                                    {{ $dagangan_n->deskripsi_produk }}
                                                    <div class="row" style="padding-right: 1rem">
                                                        <div class="col-lg-6 col-md-12 col-sm-6 col-xs-12"
                                                            style="padding-top:0.5rem">
                                                            <a class="btn btn-warning" style="width: 100%"
                                                                href='{{ route('edit-dagangan', ['id' => $dagangan_n->id]) }}'>edit</a>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12 col-sm-6 col-xs-12"
                                                            style="padding-top:0.5rem">
                                                            @if ($dagangan_n->status_produk == 'tidak tampil')
                                                                <a class="btn btn-success"
                                                                    style="width: 100%; font-size:80%"
                                                                    href="{{ route('aktifkan', ['id' => $dagangan_n->id]) }}">Aktifkan</a>
                                                            @else
                                                                <a class="btn btn-danger" style="width: 100%;"
                                                                    href="{{ route('hapus-barang', ['id' => $dagangan_n->id]) }}"
                                                                    onclick="return confirm('Apakah anda yakin?')">
                                                                    Hapus </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                Status: {{ $kurasi }}
                                                <p>
                                                    {{ $dagangan_n->catatan_kurasimarkethub }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                            Lolos Kurasi MarketHUB
                        </button>
                    </h2>
                    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            @foreach ($lolos as $dagangan_y)
                                @php
                                    if (empty($dagangan_y->produk_foto)) {
                                        $gambar = 'asset(images/SiBakul.png)';
                                    } else {
                                        $gambar = 'https://sibakuljogja.jogjaprov.go.id/files/' . $dagangan_y->produk_foto . '';
                                    }
                                    $kurasi_raw = $dagangan_y->lolos_kurasimarkethub;
                                    switch ($kurasi_raw) {
                                        case 'Ya':
                                        $kurasi = 'lolos kurasi';
                                            break;
                                        case 'Tidak':
                                        $kurasi = 'tidak lolos kurasi';
                                            break;
                                        case 'Proses':
                                        $kurasi = 'Proses kurasi';
                                            break;
                                        case 'Revisi':
                                        $kurasi = 'mohon perbaiki data barang ini';
                                            break;
                                    }
                                    // $kurasi = 'LOLOS KURASI';
                                    if (!empty($dagangan_y->nominal)) {
                                        $terdiskon_y = $dagangan_y->harga - ($dagangan_y->harga * $dagangan_y->nominal) / 100;
                                    } else {
                                        $terdiskon_y = $dagangan_y->harga;
                                    }
                                    
                                @endphp
                                <div style="padding-bottom:1rem">
                                    <div class="card">
                                        <div style="padding:0.5rem">
                                            <div class="row">
                                                <div class="col-lg-7 col-md-7 col-sm-12 d-flex h-100">
                                                    <div style="width:100%">
                                                        <img style="width:100%" src="{{ $gambar }}"
                                                            alt="{{ $dagangan_y->nama }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-5 col-md-5 col-sm-12 h-100"
                                                    style="padding-bottom: 1rem;">
                                                    <p style="font-size: 80%; font-weight:600; margin:0%">
                                                        {{ $dagangan_y->nama }}
                                                    </p>
                                                    <p>Harga: Rp. {{ number_format($dagangan_y->harga, 0, ',', '.') }},-
                                                    </p>
                                                    <br>
                                                    @if (!empty($dagangan_y->nominal))
                                                        <p>Diskon {{ $dagangan_y->nama_diskon }}
                                                            {{ $dagangan_y->nominal }}%</p>
                                                        <p>harga diskon: Rp.
                                                            {{ number_format($terdiskon_y, 0, ',', '.') }},-</p>
                                                    @endif


                                                    {{ $dagangan_y->deskripsi_produk }}
                                                    <div class="row d-flex justify-content-center"
                                                        style="padding-right: 1rem;padding-top:1rem;">
                                                        <div class="col-lg-6 col-md-12 col-sm-6 col-xs-12"
                                                            style="padding-top:.5rem">
                                                            @if (!empty($dagangan_y->nominal))
                                                                <a class="btn btn-warning" style="width: 100%"
                                                                    href='{{ route('edit-diskon', ['id' => $dagangan_y->id]) }}'>
                                                                    edit diskon
                                                                </a>
                                                            @else
                                                                <a class="btn btn-success" style="width: 100%"
                                                                    href='{{ route('edit-diskon', ['id' => $dagangan_y->id]) }}'>
                                                                    beri diskon
                                                                </a>
                                                            @endif
                                                        </div>
                                                        <div class="col-lg-6 col-md-12 col-sm-6 col-xs-12"
                                                            style="padding-top:.5rem">
                                                            @if ($dagangan_y->status_produk == 'Tidak')
                                                                <a class="btn btn-success" style="width: 100%"
                                                                    href="{{ route('aktifkan', ['id' => $dagangan_y->id]) }}">Aktifkan</a>
                                                            @else
                                                                <a class="btn btn-danger" style="width: 100%"
                                                                    href="{{ route('nonaktifkan', ['id' => $dagangan_y->id]) }}">
                                                                    Nonaktifkan </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="row" style="padding-right: 1rem;padding-top:1rem;">
                                                        <div class="col-lg-6 col-md-12 col-sm-6 col-xs-12"
                                                            style="padding-top:.5rem">
                                                            <a class="btn btn-success" style="width: 100%; font-size:80%"
                                                                href="{{-- {{route('ajukan_kurasi', ['id' => $dagangan_y->id])}} --}} javascript:void(0)">Ajukan
                                                                Kurasi Bandara</a>

                                                        </div>
                                                        <div class="col-lg-6 col-md-12 col-sm-6 col-xs-12"
                                                            style="padding-top:.5rem">
                                                            <a class="btn btn-danger" style="width: 100%;"
                                                                href="{{ route('hapus-barang', ['id' => $dagangan_y->id]) }}"
                                                                onclick="return confirm('Apakah anda yakin?')">
                                                                Hapus </a>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                Status: {{ $kurasi }}
                                                <p>
                                                    {{ $dagangan_y->catatan_kurasimarkethub }}
                                                </p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-TidakLolos">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#TidakLolos" aria-expanded="false" aria-controls="TidakLolos">
                            Tidak Lolos Kurasi MarketHUB
                        </button>
                    </h2>
                    <div id="TidakLolos" class="accordion-collapse collapse" aria-labelledby="flush-TidakLolos"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            @foreach ($tidak as $dagangan_x)
                                @php
                                    if (empty($dagangan_x->produk_foto)) {
                                        $gambar = 'asset(images/SiBakul.png)';
                                    } else {
                                        $gambar = 'https://sibakuljogja.jogjaprov.go.id/files/' . $dagangan_x->produk_foto . '';
                                    }
                                    $kurasi_raw = $dagangan_x->lolos_kurasimarkethub;
                                    switch ($kurasi_raw) {
                                        case 'Ya':
                                        $kurasi = 'lolos kurasi';
                                            break;
                                        case 'Tidak':
                                        $kurasi = 'tidak lolos kurasi';
                                            break;
                                        case 'Proses':
                                        $kurasi = 'Proses kurasi';
                                            break;
                                        case 'Revisi':
                                        $kurasi = 'mohon perbaiki data barang ini';
                                            break;
                                    }
                                    // if ($kurasi_raw == 'N') {
                                    //     $kurasi = 'TIDAK LOLOS KURASI';
                                    // } else {
                                    //     $kurasi = 'DALAM PROSES';
                                    // }
                                    if (!empty($dagangan_x->nominal)) {
                                        $terdiskon_y = $dagangan_x->harga - ($dagangan_x->harga * $dagangan_x->nominal) / 100;
                                    } else {
                                        $terdiskon_y = $dagangan_x->harga;
                                    }
                                    
                                @endphp
                                <div style="padding-bottom:1rem">
                                    <div class="card">
                                        <div style="padding:0.5rem">
                                            <div class="row">
                                                <div class="col-lg-7 col-md-7 col-sm-12 d-flex h-100">
                                                    <div style="width:100%">
                                                        <img style="width:100%" src="{{ $gambar }}"
                                                            alt="{{ $dagangan_x->nama }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-5 col-md-5 col-sm-12 h-100"
                                                    style="padding-bottom: 1rem;">
                                                    <p style="font-size: 80%; font-weight:600; margin:0%">
                                                        {{ $dagangan_x->nama }}
                                                    </p>
                                                    <p>Harga: Rp. {{ number_format($dagangan_x->harga, 0, ',', '.') }},-
                                                    </p>
                                                    <br>
                                                    @if (!empty($dagangan_x->nominal))
                                                        <p>Diskon {{ $dagangan_x->nama_diskon }}
                                                            {{ $dagangan_x->nominal }}%</p>
                                                        <p>harga diskon: Rp.
                                                            {{ number_format($terdiskon_y, 0, ',', '.') }},-</p>
                                                    @endif


                                                    {{ $dagangan_x->deskripsi_produk }}
                                                    <div class="row d-flex justify-content-center"
                                                        style="padding-right: 1rem;padding-top:1rem;">
                                                        <div class="col-lg-6 col-md-12 col-sm-6 col-xs-12"
                                                            style="padding-top:.5rem">
                                                            @if (!empty($dagangan_x->nominal))
                                                                <a class="btn btn-warning" style="width: 100%"
                                                                    href='{{ route('edit-diskon', ['id' => $dagangan_x->id]) }}'>
                                                                    edit diskon
                                                                </a>
                                                            @else
                                                                <a class="btn btn-success" style="width: 100%"
                                                                    href='{{ route('edit-diskon', ['id' => $dagangan_x->id]) }}'>
                                                                    beri diskon
                                                                </a>
                                                            @endif
                                                        </div>
                                                        <div class="col-lg-6 col-md-12 col-sm-6 col-xs-12"
                                                            style="padding-top:.5rem">
                                                            @if ($dagangan_x->status_produk == 'Tidak')
                                                                <a class="btn btn-success" style="width: 100%"
                                                                    href="{{ route('aktifkan', ['id' => $dagangan_x->id]) }}">Aktifkan</a>
                                                            @else
                                                                <a class="btn btn-danger" style="width: 100%"
                                                                    href="{{ route('nonaktifkan', ['id' => $dagangan_x->id]) }}">
                                                                    Nonaktifkan </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="row" style="padding-right: 1rem;padding-top:1rem;">
                                                        <div class="col-lg-6 col-md-12 col-sm-6 col-xs-12"
                                                            style="padding-top:.5rem">
                                                            <a class="btn btn-success" style="width: 100%; font-size:80%"
                                                                href="{{-- {{route('ajukan_kurasi', ['id' => $dagangan_x->id])}} --}} javascript:void(0)">Ajukan
                                                                Kurasi Bandara</a>

                                                        </div>
                                                        <div class="col-lg-6 col-md-12 col-sm-6 col-xs-12"
                                                            style="padding-top:.5rem">
                                                            <a class="btn btn-danger" style="width: 100%;"
                                                                href="{{ route('hapus-barang', ['id' => $dagangan_x->id]) }}"
                                                                onclick="return confirm('Apakah anda yakin?')">
                                                                Hapus </a>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                Status: {{ $kurasi }}
                                                <p>
                                                    {{ $dagangan_x->catatan_kurasimarkethub }}
                                                </p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseFour" aria-expanded="false"
                            aria-controls="flush-collapseFour">
                            Produk Berdiskon
                        </button>
                    </h2>
                    <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            @foreach ($diskon as $dagangan_d)
                                @php
                                    if (empty($dagangan_d->produk_foto)) {
                                        $gambar = 'asset(images/SiBakul.png)';
                                    } else {
                                        $gambar = 'https://sibakuljogja.jogjaprov.go.id/files/' . $dagangan_d->produk_foto . '';
                                    }
                                    $kurasi_raw = $dagangan_d->lolos_kurasimarkethub;
                                    
                                    switch ($kurasi_raw) {
                                        case 'Ya':
                                        $kurasi = 'lolos kurasi';
                                            break;
                                        case 'Tidak':
                                        $kurasi = 'tidak lolos kurasi';
                                            break;
                                        case 'Proses':
                                        $kurasi = 'Proses kurasi';
                                            break;
                                        case 'Revisi':
                                        $kurasi = 'mohon perbaiki data barang ini';
                                            break;
                                    }
                                    if (!empty($dagangan_d->nominal)) {
                                        $terdiskon_d = $dagangan_d->harga - ($dagangan_d->harga * $dagangan_d->nominal) / 100;
                                    } else {
                                        $terdiskon_d = $dagangan_d->harga;
                                    }
                                    
                                @endphp
                                <div style="padding-bottom:1rem">
                                    <div class="card">
                                        <div style="padding:0.5rem">
                                            <div class="row">
                                                <div class="col-lg-7 col-md-7 col-sm-12 d-flex h-100">
                                                    <div style="width:100%">
                                                        <img style="width:100%" src="{{ $gambar }}"
                                                            alt="{{ $dagangan_d->nama }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-5 col-md-5 col-sm-12 h-100"
                                                    style="padding-bottom: 1rem;">
                                                    <p style="font-size: 80%; font-weight:600; margin:0%">
                                                        {{ $dagangan_d->nama }}
                                                    </p>
                                                    <p>Harga: Rp. {{ number_format($dagangan_d->harga, 0, ',', '.') }},-
                                                    </p>
                                                    <br>
                                                    <p>{{ $dagangan_d->nama_diskon }} {{ $dagangan_d->nominal }}%</p>
                                                    <p>harga diskon: Rp. {{ number_format($terdiskon_d, 0, ',', '.') }},-
                                                    </p>

                                                    {{ $dagangan_d->deskripsi_produk }}
                                                    <div class="row d-flex justify-content-center"
                                                        style="padding-right: 1rem;padding-top:1rem;">
                                                        <div class="col-lg-6 col-md-12 col-sm-6 col-xs-12"
                                                            style="padding-top:.5rem">
                                                            <a class="btn btn-warning" style="width: 100%"
                                                                href='{{ route('edit-diskon', ['id' => $dagangan_d->id]) }}'>edit
                                                                diskon</a>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12 col-sm-6 col-xs-12"
                                                            style="padding-top:.5rem">
                                                            @if ($dagangan_d->status_produk == 'Tidak')
                                                                <a class="btn btn-success" style="width: 100%"
                                                                    href="{{ route('aktifkan', ['id' => $dagangan_d->id]) }}">Aktifkan</a>
                                                            @else
                                                                <a class="btn btn-danger" style="width: 100%"
                                                                    href="{{ route('nonaktifkan', ['id' => $dagangan_d->id]) }}">
                                                                    Nonaktifkan </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="row" style="padding-right: 1rem;padding-top:1rem;">
                                                        <div class="col-lg-6 col-md-12 col-sm-6 col-xs-12"
                                                            style="padding-top:.5rem">
                                                            <a class="btn btn-success" style="width: 100%; font-size:80%"
                                                                href="{{-- {{route('ajukan_kurasi', ['id' => $dagangan_d->id])}} --}} javascript:void(0)">Ajukan
                                                                Kurasi Bandara</a>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12 col-sm-6 col-xs-12"
                                                            style="padding-top:.5rem">
                                                            <a class="btn btn-danger" style="width: 100%;"
                                                                href="{{ route('hapus-barang', ['id' => $dagangan_d->id]) }}"
                                                                onclick="return confirm('Apakah anda yakin?')">
                                                                Hapus </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                Status: {{ $kurasi }}
                                                <p>
                                                    {{ $dagangan_d->catatan_kurasimarkethub }}
                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            @include('partials.back-home')
        </div>
    </div>
@endsection
