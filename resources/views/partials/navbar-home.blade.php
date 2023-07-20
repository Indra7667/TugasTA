<header id="main-header" class="header-one">
    <nav class="navbar navbar" style="width: 100%; background-color:#198754">
    <div class="container d-flex justify-content-between">
        
            <a class="navbar-brand" href="{{route('index')}}" style="margin: 0;">
                <img class="img-fluid logo_img" id="logo_img" src="{!! asset('images/sibakul-logo.png') !!}"
                    style="width: auto; height: 2.4rem;">
            </a>
            <div class="text-center flex-fill" style="margin: 0.5rem 0;">
                <div class="row">
                    <p style="font-weight: 600; color:white; margin: 0;">{{auth()->user()->nama_lengkap}}</p>
                </div>
                <div class="row">
                    <p style="color:white; margin: 0; font-size: 70%"> ID SiBakul : <span style="font-weight: 600;">{{auth()->user()->idsibakul}}</span> </p>
                </div>
            </div>
            <ul class="navbar-nav ml-auto justify-content-start">
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="offcanvas" href="#offcanvasMenu" role="button"
                        aria-controls="offcanvasMenu"><i class="fas fa-bars text-light" style="font-size:200%"></i></a>
                </li>
            </ul>
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasMenu"
                aria-labelledby="offcanvasMenuLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasMenuLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="row text-center" style="width:100%">
                        <div class="col-12" style="padding-bottom:1rem; padding-top:1rem">
                           <img style="height:2rem" src="{{asset('images/Logo SiBakul.png')}}" alt="">
                        </div>
                        <div class="container">
                            <hr class="rounded-5" style="border-top: 2px solid gray; border-bottom: unset;">
                        </div>
                        <div class="col-12" style="padding-bottom:1rem; padding-top:1rem">
                            <a class="btn btn-success" href="{{route('index')}}" style="width:100%">Beranda</a>
                        </div>
                        <div class="col-12" style="padding-bottom:1rem; padding-top:1rem">
                            <a class="btn btn-warning" href="{{route('lengkapi_data')}}" style="width:100%">Lengkapi Dataku</a>
                        </div>
                        <div class="col-12" style="padding-bottom:1rem">
                            <a class="btn btn-warning" href="{{route('reset-pass')}}" style="width:100%">Ubah Passwordku</a>
                        </div>
                        <div class="col-12" style="padding-bottom:1rem">
                            <a class="btn btn-danger" href="{{route('logout')}}" style="width:100%">logout</a>
                        </div>
                        <div class="container">
                            <hr class="rounded-5" style="border-top: 2px solid gray; border-bottom: unset;">
                        </div>
                        <div class="col-12" style="padding-bottom:1.5rem; padding-top:1rem">
                            <a class="btn btn-danger" onclick="myTutup()" style="width:100%">Keluar Aplikasi</a>
                        </div>
                    </div>
                </div>
            </div>
        
    </div>
</nav>
</header>
