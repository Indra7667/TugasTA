<header id="main-header" class="header-one">
    <nav class="navbar navbar" style="width: 100%; background-color:rgb(15, 125, 74)">
    <div class="container d-flex justify-content-between">
        
            <a class="navbar-brand" href="{{route('index-admin')}}" style="margin: 0;">
                <img class="img-fluid logo_img" id="logo_img" src="{!! asset('images/sibakul-logo.png') !!}"
                    style="width: auto; height: 2.4rem;">
            </a>
            <div class="text-center flex-fill" style="margin: 0.5rem 0;">
                <div class="row">
                    <p style="font-weight: 600; color:white; margin: 0;">{{auth()->user()->nama}}</p>
                </div>
                <div class="row">
                    <p style="color:white; margin: 0; font-size: 70%"> Administrator </span> </p>
                </div>
            </div>
            <ul class="navbar-nav ml-auto justify-content-start">
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="offcanvas" href="#offcanvasMenu" role="button"
                        aria-controls="offcanvasMenu"><i class="fas fa-bars text-light" style="font-size:200%"></i></a>
                </li>
            <div class="offcanvas offcanvas-start" tabindex="-1" data-bs-backdrop="true"  data-bs-scroll="true" id="offcanvasMenu">
                <div class="offcanvas-body">
                    <div class="row text-center" style="width:100%">
                        <div class="col-12" style="padding-bottom:0.25rem; padding-top:0.5rem;">
                           <img style="height:2rem" src="{{asset('images/Logo SiBakul.png')}}" alt="">
                        </div>
                        <div class="container">
                            <hr class="rounded-5" style="border-top: 2px solid gray; border-bottom: unset;">
                        </div>
                        <div class="col-12" style="padding-bottom:1rem; padding-top:1rem">
                            <a class="btn btn-success" href="{{route('index-admin')}}" style="width:100%">Dashboard</a>
                        </div>
                        <div class="accordion" id="sidebar">
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="user">
                                <button class="accordion-button @if($active != 'user') collapsed @endif" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                  User
                                </button>
                              </h2>
                              <div id="collapseOne" class="accordion-collapse collapse @if($active == 'user') show @endif" aria-labelledby="headingOne" data-bs-parent="#sidebar">
                                <div class="accordion-body">
                                    <div class="col-12" style="padding-bottom:1rem; padding-top:1rem">
                                        <a class="btn btn-warning" href="{{route('pedagang_list-admin')}}" style="width:100%">daftar Pedagang</a>
                                    </div>
                                    <div class="col-12" style="padding-bottom:1rem; padding-top:1rem">
                                        <a class="btn {{--btn-warning--}} btn-secondary" href="javascript:void(0)" style="width:100%">daftar Konsultasi</a>
                                    </div>
                                    <div class="col-12" style="padding-bottom:1rem; padding-top:1rem">
                                        <a class="btn btn-warning" href="{{route('forgot_list-admin')}}" style="width:100%">daftar lupa password</a>
                                    </div>
                                </div>
                              </div>
                            </div>
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="event">
                                <button class="accordion-button @if($active != 'event') collapsed @endif" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                  Event
                                </button>
                              </h2>
                              <div id="collapseTwo" class="accordion-collapse collapse @if($active == 'event') show @endif" aria-labelledby="headingTwo" data-bs-parent="#sidebar">
                                <div class="accordion-body">
                                    <div class="col-12" style="padding-bottom:1rem">
                                        <a class="btn {{--btn-warning--}} btn-secondary" href="{{--{{route('reset-pass')}}--}} javascript:void(0)" style="width:100%">E-learning</a>
                                    </div>
                                    <div class="col-12" style="padding-bottom:1rem">
                                        <a class="btn {{--btn-warning--}} btn-secondary" href="{{--{{route('reset-pass')}}--}} javascript:void(0)" style="width:100%">Pelatihan</a>
                                    </div>
                                    <div class="col-12" style="padding-bottom:1rem">
                                        <a class="btn btn-warning" href="{{route('agenda_list-admin')}}" style="width:100%">Agenda</a>
                                    </div>
                                </div>
                              </div>
                            </div>
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="barang">
                                <button class="accordion-button @if($active != 'barang') collapsed @endif" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                  Barang
                                </button>
                              </h2>
                              <div id="collapseThree" class="accordion-collapse collapse @if($active == 'barang') show @endif" aria-labelledby="headingThree" data-bs-parent="#sidebar">
                                <div class="accordion-body">
                                    <div class="col-12" style="padding-bottom:1rem">
                                        <a class="btn btn-warning" href="{{route('kurasi_list-admin')}}" style="width:100%">Kurasi</a>
                                    </div>
                                    <div class="col-12" style="padding-bottom:1rem">
                                        <a class="btn btn-warning" href="{{route('diskon_list-admin')}}" style="width:100%">Barang Berdiskon</a>
                                    </div>
                                </div>
                              </div>
                            </div>
                          </div>

                        <div class="col-12" style="padding-bottom:1rem; padding-top:1rem">
                            <a class="btn btn-danger" href="{{route('logout')}}" onclick="return confirm('Apakah anda yakin?')" style="width:100%">logout</a>
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
