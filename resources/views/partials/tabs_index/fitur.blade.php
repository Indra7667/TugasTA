<div style="padding-top:1rem;  min-height:65vh">
    <div class="alert alert-light">
        <h5>Halo Mitra SiBakul, Salam Sukses Salam Sehat</h5>
        <p style="font-size:85%; margin: 0; text-align: justify;">Temukan berbagai kemudahan akses layanan pembinaan dan pengembangan usaha, untuk
            informasi lebih lanjut dan dukungan teknis silahkan Klik Tombol WA</p>
    </div>
    <div class="alert alert-light" style="padding:1rem">
        <p style="margin-bottom: 0.5rem;">Kelengkapan seluruh Isian data:</p>
        <div class="progress">
            <div class="progress-bar bg-success" style="width: 95%">n/a%</div>
        </div>
    </div>
    <div class="container" style="padding-top: 0.5rem;">
        <div class="row d-flex justify-content-evenly">
            <div class="text-center">
                <p class="m-auto" style="font-weight: 700; padding-bottom: 1rem;">Pilih Layanan</p>
            </div>
            {{-- <div class="col-lg-1 col-md-3 col-sm-4 col-4 d-flex justify-content-center" style="padding: 0 1rem 1rem 1rem;">
                <a href="" style="color:black;text-decoration: none; ">
                    <div class="card">
                        <div class="card-body rounded-circle" style="background-color:#f5f7fb;">
                            <i class="fa fa-credit-card text-success" style="font-size:7vh"></i>
                        </div>
                    </div>
                    <p class="text-center" style="font-size: 70%; font-weight: 600; margin: 0;">
                        Kartu Sibakul
                    </p>
                </a>
            </div> --}}
            <div class="col-lg-1 col-md-3 col-sm-4 col-4 d-flex justify-content-center" style="padding: 0 1rem 1rem 1rem;">
                <a href="{{ route('lengkapi_data') }}" style="color:black;text-decoration: none;">
                    <div class="card">
                        <div class="card-body rounded-circle" style="background-color:#f5f7fb;">
                            <i class="fa fa-list text-info" style="font-size:7vh"></i>
                        </div>
                    </div>
                    <p class="text-center" style="font-size: 70%; font-weight: 600; margin: 0;">
                        Lengkapi <br> data
                    </p>
                </a>
            </div>
            <div class="col-lg-1 col-md-3 col-sm-4 col-4 d-flex justify-content-center" style="padding: 0 1rem 1rem 1rem;">
                <a href="@if($verified_only == 'disabled') javascript:void(0) @else {{route('daganganku')}} @endif " style="color:black;text-decoration: none; ">
                    <div class="card">
                        <div class="card-body rounded-circle" style="background-color:#f5f7fb;">
                            <i class="fa fa-boxes text-warning" style="font-size:7vh"></i>
                        </div>
                    </div>
                    <p class="text-center" style="font-size: 70%; font-weight: 600; margin: 0;">
                        Kurasi <br> Markethub
                    </p>
                </a>
            </div>
            <div class="col-lg-1 col-md-3 col-sm-4 col-4 d-flex justify-content-center" style="padding: 0 1rem 1rem 1rem;">
                <a href="@if($verified_only == 'disabled') javascript:void(0) @else javascript:void(0) @endif" 
                style="color:black;text-decoration: none; " {{$verified_only}}>
                    <div class="card">
                        <div class="card-body rounded-circle" style="background-color:#f5f7fb;">
                            <i class="fa fa-bag-shopping text-success" style="font-size:7vh"></i>
                        </div>
                    </div>
                    <p class="text-center" style="font-size: 70%; font-weight: 600; margin: 0;">
                        Free <br> ongkir
                    </p>
                </a>
            </div>
            <div class="col-lg-1 col-md-3 col-sm-4 col-4 d-flex justify-content-center" style="padding: 0 1rem 1rem 1rem;">
                <a href="@if($verified_only == 'disabled') javascript:void(0) @else javascript:void(0) @endif" 
                style="color:black;text-decoration: none; " {{$verified_only}}>
                    <div class="card">
                        <div class="card-body rounded-circle" style="background-color:#f5f7fb;">
                            <i class="fa fa-bag-shopping text-primary" style="font-size:7vh"></i>
                        </div>
                    </div>
                    <p class="text-center" style="font-size: 70%; font-weight: 600; margin: 0;">
                        PKG YIA
                    </p>
                </a>
            </div>
            <div class="col-lg-1 col-md-3 col-sm-4 col-4 d-flex justify-content-center" style="padding: 0 1rem 1rem 1rem;">
                <a href="@if($verified_only == 'disabled') javascript:void(0) @else javascript:void(0) @endif" 
                style="color:black;text-decoration: none;">
                    <div class="card">
                        <div class="card-body rounded-circle" style="background-color:#f5f7fb;">
                            <i class="fa fa-comment-dots text-secondary" style="font-size:7vh"></i>
                        </div>
                    </div>
                    <p class="text-center" style="font-size: 70%; font-weight: 600; margin: 0;">
                        Konsultasi
                    </p>
                </a>
            </div>
            <div class="col-lg-1 col-md-3 col-sm-4 col-4 d-flex justify-content-center" style="padding: 0 1rem 1rem 1rem;">
                <a href="@if($verified_only == 'disabled') javascript:void(0) @else javascript:void(0) @endif" 
                style="color:black;text-decoration: none;">
                    <div class="card">
                        <div class="card-body rounded-circle" style="background-color:#f5f7fb;">
                            <i class="fa fa-bookmark text-danger" style="font-size:7vh"></i>
                        </div>
                    </div>
                    <p class="text-center" style="font-size: 70%; font-weight: 600; margin: 0;">
                        E-Learning
                    </p>
                </a>
            </div>
            {{-- <div class="col-lg-1 col-md-3 col-sm-4 col-4 d-flex justify-content-center" style="padding: 0 1rem 1rem 1rem;">
                <a href="" style="color:black;text-decoration: none; ">
                    <div class="card">
                        <div class="card-body rounded-circle" style="background-color:#f5f7fb;">
                            <i class="fa fa-whatsapp text-success" style="font-size:7vh"></i>
                        </div>
                    </div>
                    <p class="text-center" style="font-size: 70%; font-weight: 600; margin: 0;">
                        WA Admin
                    </p>
                </a>
            </div> --}}
        </div>
    </div>
    <div class="div" style="padding-bottom: 1rem">
        <div class="alert alert-light">
            <div class="d-flex">
                <h5>Kelengkapan data utama mitra SiBakul</h5>
            </div>
            <table class="table table-striped table-borderless table-hover">
                <tr>
                    <td style="font-weight: 600;"><a href="{{route('lengkapi_data', ['open'=>'data'])}}" style="text-decoration: none;">Data Usaha</a></td>
                    <td class="col-1 text-center"><i class="fa fa-check-circle text-success"></i></td>
                </tr>
                <tr>
                    <td style="font-weight: 600;"><a href="{{route('lengkapi_data', ['open'=>'lokasi'])}}" style="text-decoration: none;">Lokasi UKM (GPS)</a></td>
                    @if (empty($data->lokasi_x) || empty($data->lokasi_y))
                        <td class="col-1 text-center"><i class="fa fa-xmark-circle text-danger"></i></td>
                    @else
                        <td class="col-1 text-center"><i class="fa fa-check-circle text-success"></i></td>
                    @endif
                </tr>
                <tr>
                    <td style="font-weight: 600;"><a href="{{route('lengkapi_data', ['open'=>'omset'])}}" style="text-decoration: none;">Data Omset</a></td>
                    @if ($omset->count() == 0)
                        <td class="col-1 text-center"><i class="fa fa-xmark-circle text-danger"></i></td>  
                    @else
                        <td class="col-1 text-center"><i class="fa fa-check-circle text-success"></i></td> 
                    @endif
                </tr>
                {{-- <tr>
                    <td style="font-weight: 600;"><a href="javascript:void(0);" style="text-decoration: none;">Aspek Kelembagaan</a></td>
                    <td class="col-1 text-center"><i class="fa fa-check-circle text-success"></i></td>
                </tr>
                <tr>
                    <td style="font-weight: 600;"><a href="javascript:void(0);" style="text-decoration: none;">Aspek Produksi</a></td>
                    <td class="col-1 text-center"><i class="fa fa-check-circle text-success"></i></td>
                </tr>
                <tr>
                    <td style="font-weight: 600;"><a href="javascript:void(0);" style="text-decoration: none;">Aspek Keuangan</a></td>
                    <td class="col-1 text-center"><i class="fa fa-check-circle text-success"></i></td>
                </tr>
                <tr>
                    <td style="font-weight: 600;"><a href="javascript:void(0);" style="text-decoration: none;">Aspek Pasar</a></td>
                    <td class="col-1 text-center"><i class="fa fa-check-circle text-success"></i></td>
                </tr>
                <tr>
                    <td style="font-weight: 600;"><a href="javascript:void(0);" style="text-decoration: none;">Aspek Pemasaran Online</a></td>
                    <td class="col-1 text-center"><i class="fa fa-check-circle text-success"></i></td>
                </tr>
                <tr>
                    <td style="font-weight: 600;"><a href="javascript:void(0);" style="text-decoration: none;">Aspek SDM</a></td>
                    <td class="col-1 text-center"><i class="fa fa-check-circle text-success"></i></td>
                </tr> --}}
            </table>
        </div>
    </div>
</div>
