@extends('layouts.default')
@section('content')
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #176e41;">
        <!-- Container wrapper -->
        <div class="container-fluid">
            <!-- Navbar brand -->
            <p style="padding:0 12px">&nbsp;</p>
            <h5 class="navbar-brand" style="margin:0">Ganti Kata Sandi</h5>
            <p style="padding:0 12px">&nbsp;</p>
        </div>
        <!-- Container wrapper -->
    </nav>
    <div style="width: 100%; min-height:6.83vh;">
        <div class="container" style="padding-top:5rem; ">
            <div class="row d-flex align-items-start justify-content-center">
                <div class="col-md-7 col-lg-5 col-xl-5">
                    <div class="alert alert-warning" style="padding-bottom:1rem">
                        pastikan anda selalu mengingat password baru anda untuk login kedepannya
                    </div>
                    <form class="form" action="{{ route('post_lupa', ['id' => $idsibakul]) }}" method="POST">
                        @csrf
                        @if (request('q'))
                            <input type="hidden" name="q" value="{{ request('q') }}">
                        @endif

                        <div class="form-outline mb-4">
                            <input type="text" id="no_wa" name="no_wa" maxlength="14"
                                class="form-control form-control-lg @error('no_wa') is-ivalid @enderror"
                                style="background-color:white;" required />
                            <label class="form-label" for="no_wa">No WA</label>
                        </div>
                        @error('no_wa')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                        <div class="input-group mb-2 d-flex justify-content-between">
                            <div class="form-outline flex-fill mb-2">
                                <input type="password" id="pwd_baru" name="password" minlength="6"
                                    class="form-control form-control-lg @error('password') is-ivalid @enderror"
                                    style="background-color:white;" required />
                                <label class="form-label" for="pwd_baru">Password Baru</label>
                            </div>
                            <button class="btn btn-outline-secondary mb-2 btn-lg" type="button"
                                style="padding-left: 0.75rem; padding-right: 0.75rem;" id="togglePassword"
                                onclick="changeIcon(this)">
                                <i class="fa fa-eye m-auto"></i>
                            </button>
                        </div>


                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                        <div class="input-group mb-2 d-flex justify-content-between">
                            <div class="form-outline flex-fill mb-2">
                                <input type="password" id="konf_pwd_baru" name="password_confirmation" minlength="6"
                                    class="form-control form-control-lg @error('password_confirmation') is-ivalid @enderror"
                                    style="background-color:white;" required />
                                <label class="form-label" for="konf_pwd_baru">Konfirmasi Password Baru</label>
                            </div>
                            <button class="btn btn-outline-secondary btn-lg mb-2" type="button"
                                style="padding-left: 0.75rem; padding-right: 0.75rem;" id="toggleConf"
                                onclick="changeIcon(this)">
                                <i class="fa fa-eye m-auto"></i>
                            </button>
                        </div>


                        <script>
                            const togglePassword = document.querySelector('#togglePassword');
                            const toggleConf = document.querySelector('#toggleConf');
                            const password = document.querySelector('#pwd_baru');
                            const conf = document.querySelector('#konf_pwd_baru');

                            togglePassword.addEventListener('click', function(e) {
                                // toggle the type attribute
                                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                                password.setAttribute('type', type);
                                // toggle the eye slash icon
                                // this.classList.toggle('fa-eye-slash');
                            });

                            toggleConf.addEventListener('click', function(e) {
                                // toggle the type attribute
                                const type = conf.getAttribute('type') === 'password' ? 'text' : 'password';
                                conf.setAttribute('type', type);
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
                        @error('password_confirmation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                        <button type="submit" class="btn btn-success btn-lg btn-block"
                            style="text-transform: capitalize; font-size: 100%; font-weight: bold; padding: 1rem 0;">Ubah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Content End -->
@endsection
