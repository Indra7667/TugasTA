@extends('layouts.layout-login')

@section('content')

    <div class="container">
        <section class="vh-100">
            <div class="container py-5 h-100">
                <div class="row d-flex align-items-center justify-content-center h-100">
                    <div class="col-xl-4 col-lg-5 col-md-7 col-sm-9 col-12 h-100">
                        <div class="d-flex justify-content-center align-items-start">
                            {{-- <img src="https://sibakuljogja.jogjaprov.go.id/profil/images/Logo SiBakul.png" class="img-fluid"
                            alt="SiBakul Jogja"> --}}
                            <img src="{{ asset('images/Logo SiBakul.png') }}" class="img-fluid" alt="SiBakul Jogja">
                        </div>
                        <p class="text-center" style="font-size: 85%; font-weight: 600; margin-top: 0.5rem;">ngayomi sekaligus ngurubi<br>ngayemi sekaligus nguripi</p>
                    {{-- </div> --}}
                    {{-- <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1"> --}}
                        <br>
                        {{-- @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            <br>
                        @endif
                        @if (session()->has('loginError'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('loginError') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            <br>
                        @endif --}}
                        <form action="{{ route('post_login') }}" method="POST">
                            @csrf
                            <p style="font-size: 90%; color: grey; margin-bottom: 10px;">Tekan masuk untuk memulai sesi Anda
                            </p>
                            <!-- idsibakul input -->
                            <div class="form-outline mb-2">
                                <input type="text" name="idsibakul" id="idsibakul" class="form-control form-control-lg"
                                    style="background-color:white;" value="{{old('idsibakul')}}" required />
                                <label class="form-label" for="idsibakul" style="font-weight: normal;">ID SiBakul</label>
                            </div>

                            <!-- Password input -->

                            <div class="input-group mb-4 d-flex justify-content-between">
                                <div class="form-outline flex-fill">
                                    <input type="password" name="password"
                                        id="password" aria-describedby="password" class="form-control form-control-lg" style="background-color:white;"
                                        required />
                                    <label class="form-label" for="password" style="font-weight: normal;">Kata sandi
                                    </label>
                                </div>
                                    <button class="btn btn-outline-secondary btn-lg" type="button" style="padding-left: 0.75rem; padding-right: 0.75rem;"
                                    id="togglePassword" onclick="changeIcon(this)">
                                        <i class="fa fa-eye m-auto"></i>
                                    </button>

                                {{-- <a class="btn btn-light h-100" id="togglePassword" onclick="changeIcon(this)">
                                    <i class="fa fa-eye m-auto"></i> --}}
                                    {{-- <span>Show</span> --}}
                                {{-- </a> --}}
                            </div>

                            <script>
                                const togglePassword = document.querySelector('#togglePassword');
                                const password = document.querySelector('#password');

                                togglePassword.addEventListener('click', function(e) {
                                    // toggle the type attribute
                                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                                    password.setAttribute('type', type);
                                    // toggle the eye slash icon
                                    // this.classList.toggle('fa-eye-slash');
                                });

                                function changeIcon(anchor) {
                                    var icon = anchor.querySelector("i");
                                    icon.classList.toggle('fa-eye');
                                    icon.classList.toggle('fa-eye-slash');

                                    // anchor.querySelector("span").textContent = icon.classList.contains('fa-eye') ? "Show" : "Hide";
                                }
                            </script>

                            {{-- <p style="font-size: 90%; color: grey;">*Nomor telepon untuk User Ambilin, KTA untuk Mitra Perosok</p> --}}

                            <div class="d-flex justify-content-between align-items-start mb-4">
                                <!-- Checkbox -->
                                <style>
                                    .form-check-input:focus {
                                        border-color: #91ba04;
                                        background-color: #1a7019;
                                        outline: 0;
                                        box-shadow: 0 0 0 0.25rem rgb(145 186 4 / 25%);
                                    }

                                    .form-check-input[type=checkbox]:checked:focus {
                                        background-color: #1a7019;
                                    }

                                    .form-check-input[type=checkbox]:checked {
                                        background-color: #1a7019;
                                        border-color: #91ba04;
                                        background-image: none;
                                    }
                                </style>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="remember"
                                        id="flexCheckChecked">
                                    <label class="form-check-label" for="flexCheckChecked">Ingat Saya</label>
                                </div>
                                <a href="forgot" style="text-decoration: none;">Lupa kata sandi?</a>
                            </div>

                            <div class="d-flex justify-content-start align-items-start" style="padding-top: 10px">
                                <p>Belum mendaftar? <a href="registrasi" style="text-decoration: none;">Daftar di sini</a>
                                </p>
                            </div>

                            <!-- Submit button -->
                            <button type="submit" class="btn btn-success btn-block mb-4"
                                style="text-transform: capitalize;">
                                <b>Masuk</b>
                            </button>
                        </form>
                        <div class="mt-4">
                            {{-- <img src="{!! asset('public/img/logo_sponsor.png') !!}" class="img-fluid" alt="Sponsor"> --}}
                            {{-- <img src="{!! asset('https://ambilin.com/img/jpg/ambilinbg.jpg') !!}" class="img-fluid" alt="Sponsor"> --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
