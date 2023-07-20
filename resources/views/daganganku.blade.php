@extends('layouts.default')

@section('content')
    @include('partials.navbar-home')
    <div style="background-color: #cfe1d8; ">
        <div class="container" style="padding: 1rem 0;min-height:74vh">
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
                                        <i class="fa fa-circle-question text-danger"></i>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseTwo" aria-expanded="true" aria-controls="flush-collapseTwo">
                            Kurasi Markethub
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse show" aria-labelledby="flush-headingTwo"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <form action="" method="get" style="padding-top:1rem">
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-6" style="padding-bottom: 1rem">
                                        <div class="input-group">
                                            <label class="input-group-text" for="filter">Status</label>
                                            <select name='filter' class="form-select" id='filter'
                                                aria-label="Default select example">
                                                <option @if ($filter == 'empty') selected @endif value="empty">
                                                    Semua</option>
                                                @foreach ($id_status_kurasi as $status_kurasi)
                                                    <option @if ($filter == $status_kurasi->id_status_kurasi) selected @endif
                                                        value="{{ $status_kurasi->id_status_kurasi }}">
                                                        {{ $status_kurasi->status_kurasi }}
                                                    </option>
                                                @endforeach
                                                {{-- <option {{ $proses }} value="proses">Proses</option>
                                                <option {{ $lolos }} value="lolos">Lolos</option>
                                                <option {{ $tidak_lolos }} value="tidak_lolos">Tidak lolos</option>
                                                <option {{ $perbaikan }} value="perbaikan">Perbaikan</option> --}}
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-sm-6 col-6" style="padding-bottom: 1rem">
                                        <div class="input-group">
                                            <span class="input-group-text">Data Perlaman</span>
                                            <input type="number" aria-label="show" min="1" max="32"
                                                name="show" value="{{ $show }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-10 col-sm-10 col-10" style="padding-bottom: 1rem">
                                        <div class="input-group">
                                            <span class="input-group-text">keyword</span>
                                            <input type="text" aria-label="search" name="search"
                                                value="{{ $search }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-lg-1 col-md-2 col-sm-2 col-2" style="padding-bottom: 1rem">
                                        <div class="row">
                                            <div class="col-12 w-100 d-flex justify-content-center">
                                                <input class="form-check-input mt-0" type="checkbox" name="diskon"
                                                    value="true" {{ $diskon }}>
                                            </div>
                                            <div class="col-12 w-100 d-flex justify-content-center">
                                                berdiskon?
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-12 col-sm-12 col-12" style="padding-bottom: 1rem">
                                        <button class="btn btn-success w-100" type="submit">Filter</button>
                                    </div>
                                </div>
                            </form>
                            <hr>
                            <div class="row" style="padding-bottom: 1rem">
                                <div class="col-12 d-flex justify-content-center" style="padding-top:1rem">
                                    <a href='{{ route('tambah-barang') }}' class="btn btn-success" style="width:50%">
                                        <i class="fa fa-plus text-light"></i> tambah data
                                    </a>
                                </div>
                            </div>
                            @foreach ($produk as $produk0)
                                @php
                                    $produk1 = $produk0[0];
                                    $url0 = 'https://sibakuljogja.jogjaprov.go.id/files/' . $produk1->produk_foto . '';
                                    [$status1] = get_headers($url0);
                                    $logo = asset('images/SiBakul.png');
                                    
                                    if (empty($produk1->produk_foto) || strpos($status1, '404') !== false) {
                                        $gambar = $logo;
                                    } else {
                                        $gambar = 'https://sibakuljogja.jogjaprov.go.id/files/' . $produk1->produk_foto . '';
                                        // $gambar = '../files/' . $produk1->produk_foto . '';
                                    }
                                    
                                    if (!empty($produk1->nominal)) {
                                        $harga = $produk1->harga - ($produk1->harga * $produk1->nominal) / 100;
                                    }
                                    
                                    $kurasi = $produk1->id_status_kurasimarkethub;
                                    
                                    if ($kurasi != 1){
                                        $kurasi_bandara = 'javascript:void(0)';
                                        $button_bandara = 'btn-secondary';
                                        $bandara_opacity = '50%';
                                        $onClick = '';
                                    } else {
                                        $kurasi_bandara = 'javascript:void(0)';
                                        $button_bandara = 'btn-success';
                                        $bandara_opacity = '100%';
                                        $onclick = "return confirm('apakah anda yakin?')";
                                    }
                                    
                                    if ($kurasi == 3 || $kurasi == 4){
                                        $kurasi_markethub = 'javascript:void(0)';
                                        $button_kurasi = 'btn-secondary';
                                        $kurasi_opacity = '50%';
                                        $onClick = '';
                                    } else {
                                        $kurasi_markethub = route('post-kurasiMarkethub', ['id' => $produk1->id]);
                                        $button_kurasi = 'btn-success';
                                        $kurasi_opacity = '100%';
                                        $onClick = "return confirm('apakah anda yakin?')";
                                    }
                                @endphp

                                <div style="padding-bottom:1rem">
                                    <div class="card">
                                        <a class="btn btn-success" href="{{route('history_kurasi',['id'=>$produk1->id])}}" style="position:absolute; top:1rem; right:1rem">
                                            <i class="fa fa-clock"></i>
                                        </a>
                                        <div style="padding:0.5rem">
                                            <div class="row">
                                                <div class="col-lg-7 col-md-7 col-sm-12 d-flex h-100">
                                                    <div style="width:100%">
                                                        <img style="width:100%" src="{{ $gambar }}"
                                                            alt="{{ $produk1->nama }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-5 col-md-5 col-sm-12 h-100"
                                                    style="padding-bottom: 1rem;">
                                                    <p style="font-size: 80%; font-weight:600; margin:0%">
                                                        {{ $produk1->nama }}
                                                    </p>
                                                    <br>
                                                    <p>Harga: Rp. {{ number_format($produk1->harga, 0, ',', '.') }},-
                                                    </p>
                                                    <br>
                                                    @if (!empty($produk1->nominal))
                                                        <p>Diskon {{ $produk1->nama_diskon }}
                                                            {{ $produk1->nominal }}%</p>
                                                        <p>harga diskon: Rp.
                                                            {{ number_format($harga, 0, ',', '.') }},-
                                                        </p>
                                                        <br>
                                                    @endif

                                                    {{ $produk1->deskripsi_produk }}
                                                    <div class="row" style="padding-right: 1rem">
                                                        <div class="col-lg-6 col-md-12 col-sm-6 col-xs-12"
                                                            style="padding-top:0.5rem">
                                                            <a class="btn btn-warning" style="width: 100%"
                                                                href='{{ route('edit-dagangan', ['id' => $produk1->id]) }}'>edit</a>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12 col-sm-6 col-xs-12"
                                                            style="padding-top:0.5rem">
                                                            @if (!empty($produk1->nominal))
                                                                <a class="btn btn-warning" style="width: 100%"
                                                                    href='{{ route('edit-diskon', ['id' => $produk1->id]) }}'>
                                                                    edit diskon
                                                                </a>
                                                            @else
                                                                <a class="btn btn-success" style="width: 100%"
                                                                    href='{{ route('edit-diskon', ['id' => $produk1->id]) }}'>
                                                                    beri diskon
                                                                </a>
                                                            @endif
                                                        </div>
                                                        <div class="col-lg-6 col-md-12 col-sm-6 col-xs-12"
                                                            style="padding-top:0.5rem">
                                                            @if ($produk1->status_produk == 'tidak tampil')
                                                                <a class="btn btn-success"
                                                                    style="width: 100%; font-size:80%"
                                                                    href="{{ route('aktifkan', ['id' => $produk1->id]) }}">
                                                                    Aktifkan
                                                                </a>
                                                            @else
                                                                <a class="btn btn-danger" style="width: 100%"
                                                                    href="{{ route('nonaktifkan', ['id' => $produk1->id]) }}">
                                                                    Nonaktifkan
                                                                </a>
                                                            @endif
                                                        </div>
                                                        <div class="col-lg-6 col-md-12 col-sm-6 col-xs-12"
                                                            style="padding-top:0.5rem">
                                                            <a class="btn btn-danger" style="width: 100%;"
                                                                href="{{ route('hapus-barang', ['id' => $produk1->id]) }}"
                                                                onclick="return confirm('Apakah anda yakin?')">
                                                                Hapus
                                                            </a>
                                                        </div>
                                                        @if ($kurasi == 1)
                                                            <div class="col-12" style="padding-top:0.5rem">
                                                                <a class="btn {{$button_bandara}}" style="width: 100%; opacity:{{$bandara_opacity}}"
                                                                    href="{{$kurasi_bandara}}" onclick="{{$onClick}}">
                                                                    Ajukan kurasi bandara
                                                                </a>
                                                            </div>
                                                        @elseif($kurasi != 1)
                                                            <div class="col-12" style="padding-top:0.5rem">
                                                                <a class="btn {{$button_kurasi}}" style="width: 100%; opacity:{{$kurasi_opacity}}"
                                                                    href="{{$kurasi_markethub}}" onclick="{{$onClick}}">
                                                                    Ajukan kurasi MarketHUB
                                                                </a>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                Status: {{ $produk1->detail_status_kurasi }}
                                                <p>
                                                    {{ $produk1->catatan_kurasimarkethub }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="row">
                                <div class="col-12">
                                    {{-- {{ $produk->links('pagination::bootstrap-5') }} --}}
                                </div>
                            </div>
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
