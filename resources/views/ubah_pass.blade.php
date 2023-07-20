@extends('layouts.default')
@section('content')
@include('partials.navbar-home')
@include('partials.toast')
<div class="grey-bg" style="max-width:100%; padding-bottom:1rem;padding-top:1rem">
    <section id="content" class="iq-banner-12 light-bg" style="">
        <div style="width:100%">
            <div class="alert alert-success d-flex justify-content-center align-items-center" role="alert">
                <div class="row">
                    <div class="col-12" style="padding:0%;">
                        <div class="col" style="text-align: center">
                            <div class="container">
                                <p style="font-size: 90%">Ganti password anda secara rutin untuk meningkatkan keamanan dari akun anda.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <div class="container">
            <section>
                <div class="container py-2 h-100">
                    <div class="row d-flex align-items-start justify-content-center h-100">
                        <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                            @if(session()->has('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
                            </div>
                            @endif
                            <form class="form" action="{{route('new-pass')}}" method="post">
                            @csrf
                            <div class="input-group mb-4 d-flex justify-content-between">
                                <div class="form-outline flex-fill">
                                    <input type="password" id="password_lama" name="password_lama" class="form-control form-control-lg" style="background-color:white;" required/>
                                    <label class="form-label" for="password_lama">Password Lama</label>
                                </div>
                                <button class="btn btn-outline-secondary btn-lg" type="button" style="padding-left: 0.75rem; padding-right: 0.75rem;"
                                    id="togglePasswordLama" onclick="changeIcon(this)">
                                    <i class="fa fa-eye m-auto"></i>
                                </button>
                                {{-- <a class="btn btn-light h-100" id="togglePasswordLama" onclick="changeIcon(this)">
                                    <i class="fa fa-eye m-auto"></i>
                                </a> --}}
                            </div>
                            <div class="input-group mb-4 d-flex justify-content-between">
                                <div class="form-outline flex-fill">
                                    <input type="password" id="password" name="password" class="form-control form-control-lg" style="background-color:white;" required/>
                                    <label class="form-label" for="password">Password Baru</label>
                                </div>
                                <button class="btn btn-outline-secondary btn-lg" type="button" style="padding-left: 0.75rem; padding-right: 0.75rem;"
                                    id="togglePasswordBaru" onclick="changeIcon(this)">
                                    <i class="fa fa-eye m-auto"></i>
                                </button>
                            </div>
                            
                            <div class="input-group mb-4 d-flex justify-content-between">
                                <div class="form-outline flex-fill">
                                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control form-control-lg" style="background-color:white;" required/>
                                    <label class="form-label" for="password_confirmation">Konfirmasi Password Baru</label>
                                </div>
                                <button class="btn btn-outline-secondary btn-lg" type="button" style="padding-left: 0.75rem; padding-right: 0.75rem;"
                                    id="togglePasswordBaru2" onclick="changeIcon(this)">
                                    <i class="fa fa-eye m-auto"></i>
                                </button>
                            </div>
        
                                <button type="submit" class="btn btn-success btn-lg btn-block" style="text-transform: capitalize; font-size: 100%; font-weight: bold; padding: 1rem 0;">Ganti</button>
                            </form>
                        </div>
                    </div>
                    <script>
                        const togglePasswordLama = document.querySelector('#togglePasswordLama');
                        const togglePasswordBaru = document.querySelector('#togglePasswordBaru');
                        const togglePasswordBaru2 = document.querySelector('#togglePasswordBaru2');
                        const password_lama = document.querySelector('#password_lama');
                        const password = document.querySelector('#password');
                        const password2 = document.querySelector('#password_confirmation');

                        togglePasswordLama.addEventListener('click', function(e) {
                            // toggle the type attribute
                            const type = password_lama.getAttribute('type') === 'password' ? 'text' : 'password';
                            password_lama.setAttribute('type', type);
                            // toggle the eye slash icon
                            // this.classList.toggle('fa-eye-slash');
                        });
                        togglePasswordBaru.addEventListener('click', function(e) {
                            // toggle the type attribute
                            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                            password.setAttribute('type', type);
                            // toggle the eye slash icon
                            // this.classList.toggle('fa-eye-slash');
                        });
                        togglePasswordBaru2.addEventListener('click', function(e) {
                            // toggle the type attribute
                            const type = password2.getAttribute('type') === 'password' ? 'text' : 'password';
                            password2.setAttribute('type', type);
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
                    <div style="padding-top: 5rem">
                        <a type="button" class="btn btn-danger"  href="{{ url('/') }}">Kembali</a>
                    </div>
                </div>
            </section>
        </div>
    </section>
</div>
@include('partials.footer')
@endsection