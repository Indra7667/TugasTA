@extends('layouts.layout-login')

@section('content')
    <div class="container">
        <section class="vh-100">
            <div class="container py-5 h-100">
                <div class="row d-flex align-items-center justify-content-center h-100">
                    <div class="col-xl-4 col-lg-5 col-md-7 col-sm-9 col-12 h-100">
                        <div class="d-flex justify-content-center align-items-start">
                            <img src="https://sibakuljogja.jogjaprov.go.id/profil/images/Logo SiBakul.png" class="img-fluid"
                                alt="SiBakul Jogja">
                        </div>
                        <p class="text-center" style="font-size: 85%; font-weight: 600; margin-top: 0.5rem;">ngayomi
                            sekaligus ngurubi<br>ngayemi sekaligus nguripi</p>
                        {{-- </div> --}}
                        {{-- <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1"> --}}
                        @if (session()->has('loginError'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('loginError') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            <br>
                        @endif

                        <p style="font-size: 90%; color: grey; margin-bottom: 10px; text-align: center;">Formulir
                            pendaftaran Usaha Mikro Kecil Menengah SiBakul Jogja</p>

                        <style>
                            .is-invalid {
                                margin-bottom: 0 !important;
                            }
                            .form-floating>.form-select {
                                border: 1px solid #bdbdbd;
                            }
                            .form-floating>.form-control {
                                border: 1px solid #bdbdbd;
                            }
                            .form-floating>.form-label {
                                color: black;
                            }
                            .form-outline>.form-control {
                                border: 1px solid #bdbdbd;
                            }
                        </style>

                        <form action="{{ route('post_registrasi') }}" method="POST">
                            @csrf
                            <br>
                            <!-- nama_usaha input -->
                            <div class="form-outline">
                                <input type="text" name="nama_usaha" id="nama_usaha"
                                    class="form-control form-control-md @error('nama_usaha') is-invalid @enderror"
                                    style="background-color:white;" value="{{ old('nama_usaha') }}" required />
                                <label class="form-label" for="nama_usaha" style="font-weight: normal;">Nama Usaha <font
                                        color='#ff0000'>*</font></label>
                            </div>
                            <p class="text-secondary mb-3" style="font-size: 75%; margin: 0" disabled>Isi sesuai nama usaha
                                anda</p>
                            @error('nama_usaha')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <h6 style="font-weight: normal; color:lightslategray">Alamat Usaha</h6>

                            <div class="form-floating mb-2">
                                <select class="form-select @error('kota') is-invalid @enderror" name="kota"
                                    id="kota" required>
                                    <option value='' hidden>Pilih Kabupaten/Kota</option>
                                    @foreach ($kota as $kot)
                                        <option value="{{ $kot->id }}">{{ $kot->nama }}</option>
                                    @endforeach
                                </select>
                                <label for="kota" class="form-label" style="font-weight: normal;">Kabupaten/Kota <font
                                        color='#ff0000'>*</font></label>
                            </div>
                            @error('kota')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="form-floating mb-2">
                                <select class="form-select @error('kecamatan') is-invalid @enderror"
                                    name="kecamatan" id="kecamatan" required>
                                    <option value='' hidden>Pilih Kecamatan</option>
                                </select>
                                <label for="kecamatan" class="form-label" style="font-weight: normal;">Kecamatan <font
                                        color='#ff0000'>*</font></label>
                            </div>
                            @error('kecamatan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="form-floating mb-2">
                                <select class="form-select @error('kelurahan') is-invalid @enderror"
                                    name="kelurahan" id="kelurahan" required>
                                    <option value='' hidden>Pilih Kelurahan</option>
                                </select>
                                <label for="kelurahan" class="form-label" style="font-weight: normal;">Kelurahan <font
                                        color='#ff0000'>*</font></label>
                            </div>
                            @error('kelurahan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="form-outline">
                                <textarea class="form-control @error('alamat_usaha') is-invalid @enderror" name="alamat_usaha"
                                    id="alamat_usaha" rows="2" required>{{ old('alamat_usaha') ?? '' }}</textarea>
                                <label for="alamat_usaha" class="form-label" style="font-weight: normal;">Alamat <font
                                        color='#ff0000'>*</font></label>
                            </div>
                            <p class="text-secondary mb-3" style="font-size: 75%; margin: 0" disabled>Isi dengan alamat
                                usaha</p>
                            @error('alamat_usaha')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <!-- nik input -->
                            <div class="form-outline">
                                <input type="number" name="nik" id="nik"
                                    class="form-control form-control-md @error('nik') is-invalid @enderror"
                                    style="background-color:white;" value="{{ old('nik') }}" required />
                                <label class="form-label" for="nik" style="font-weight: normal;">NIK <font
                                        color='#ff0000'>*</font></label>
                            </div>
                            <p class="text-secondary mb-3" style="font-size: 75%; margin: 0" disabled>Isi dengan No KTP</p>
                            @error('nik')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <!-- Password input -->

                            <div class="input-group mb-2 d-flex justify-content-between">
                                <div class="form-outline flex-fill">
                                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror"
                                        style="background-color:white;" required />
                                    <label class="form-label" for="password" style="font-weight: normal;">Kata Sandi <font
                                            color='#ff0000'>*</font>
                                    </label>
                                </div>
                                    <button class="btn btn-outline-secondary" type="button"
                                        id="togglePassword" onclick="changeIcon(this)">
                                        <i class="fa fa-eye m-auto"></i>
                                    </button>

                                <!-- <a class="btn btn-light h-100" id="togglePassword" onclick="changeIcon(this)">
                                        <i class="fa fa-eye m-auto"></i>
                                </a> -->
                            </div>
                            <!-- <p class="text-secondary mb-3" style="font-size: 75%; margin: 0" disabled>minimal 8 karakter kombinasi huruf dan angka</p> -->

                            <!-- password_confirmation input -->

                            <div class="input-group d-flex justify-content-between">
                                <div class="form-outline flex-fill">
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                                        style="background-color:white;" required />
                                    <label class="form-label" for="password_confirmation"
                                        style="font-weight: normal;">Konfirmasi Kata Sandi <font color='#ff0000'>*</font>
                                    </label>
                                </div>
                                    <button class="btn btn-outline-secondary" type="button"
                                        id="togglePassword2" onclick="changeIcon(this)">
                                        <i class="fa fa-eye m-auto"></i>
                                    </button>

                                <!-- <a class="btn btn-light h-100" id="togglePassword2" onclick="changeIcon(this)">
                                        <i class="fa fa-eye m-auto"></i>
                                </a> -->
                            </div>
                            <p class="text-secondary mb-3" style="font-size: 75%; margin: 0" disabled>minimal 8 karakter
                                kombinasi huruf dan angka</p>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <script>
                                const togglePassword = document.querySelector('#togglePassword');
                                const togglePassword2 = document.querySelector('#togglePassword2');
                                const password = document.querySelector('#password');
                                const password2 = document.querySelector('#password_confirmation');

                                togglePassword.addEventListener('click', function(e) {
                                    // toggle the type attribute
                                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                                    password.setAttribute('type', type);
                                    // toggle the eye slash icon
                                    // this.classList.toggle('fa-eye-slash');
                                });

                                togglePassword2.addEventListener('click', function(e) {
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

                            <!-- nama_lengkap input -->
                            <div class="form-outline">
                                <input type="text" name="nama_lengkap" id="nama_lengkap"
                                    class="form-control form-control-md @error('nama_lengkap') is-invalid @enderror"
                                    style="background-color:white;" value="{{ old('nama_lengkap') }}" required />
                                <label class="form-label" for="nama_lengkap" style="font-weight: normal;">Nama Lengkap
                                    <font color='#ff0000'>*</font></label>
                            </div>
                            <p class="text-secondary mb-3" style="font-size: 75%; margin: 0" disabled>Nama lengkap sesuai
                                KTP</p>
                            @error('nama_lengkap')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <!-- no_hp input -->
                            <div class="form-outline">
                                <input type="tel" name="no_hp" id="no_hp"
                                    class="form-control form-control-md @error('no_hp') is-invalid @enderror"
                                    value="{{ old('no_hp') }}" pattern="[0-9]{}" maxlength="14" minlength="9"
                                    onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                                <label class="form-label" for="no_hp">Nomor HP/WA <font color='#ff0000'>*</font>
                                    </label>
                            </div>
                            <p class="text-secondary mb-3" style="font-size: 75%; margin: 0" disabled>Isi dengan nomor WA
                                aktif untuk keperluan komunikasi dengan admin</p>
                            @error('no_hp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            {{-- <div class="form-outline">
                                    <input type="email" name="email" id="email" class="form-control form-control-md" style="background-color:white;" value="{{ old('email') }}"/>
                                    <label class="form-label" for="email">Email</label>
                                </div>
                                <p class="text-secondary mb-3" style="font-size: 75%; margin: 0" disabled>Isi dengan alamat email aktif, kosongkan jika tidak punya</p> --}}

                            {{-- <p style="font-size: 90%; color: grey;">*Nomor telepon untuk User Ambilin, KTA untuk Mitra Perosok</p> --}}

                            {{-- @if ($errors->any())
                                    <div class="form-outline mt-4">
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li><p style="margin: 0; font-size: 75%;">{{ $error }}</p></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif --}}

                            <div class="mt-3 mb-3">
                                <p style="font-size: 80%; color: #ff0000;">Kolom dengan tanda bintang (*) wajib diisi</p>
                            </div>

                            <!-- Submit button -->
                            <div class="row">
                                <div class="col-6">
                                    <a class="btn btn-danger btn-block mb-4" style="text-transform: capitalize"
                                        href="{{ route('login') }}">Batal</a>
                                </div>
                                <div class="col-6">
                                    <button type="submit" class="btn btn-success btn-block mb-4"
                                        style="text-transform: capitalize;">
                                        <b>Daftar</b>
                                    </button>
                                </div>
                            </div>
                            {{-- </div> --}}
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        $(function() {
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });
    
            $(function() {
                $('#kota').on('change', function() {
                    let kotID = $('#kota').val();
    
                    $.ajax({
                        type: 'POST',
                        dataType: "html",
                        url: "getkecamatan",
                        data: {kotID: kotID},
                        cache: false,
    
                        success: function(msg) {
                            $('#kecamatan').html(msg);
                            $("#kelurahan").html("<select class='form-control form-select active @error('kelurahan') is-invalid @enderror' name='kelurahan' id='kelurahan' required><option value='' hidden>Pilih Kelurahan</option></select>");
                        },
    
                        error: function(data) {
                            console.log('error: ', data)
                        },
    
                    })
                })
            })
    
            $(function() {
                $('#kecamatan').on('change', function() {
                    let kecID = $('#kecamatan').val();
    
                    $.ajax({
                        type: 'POST',
                        dataType: "html",
                        url: "getkelurahan",
                        data: {
                            kecID: kecID
                        },
                        cache: false,
    
                        success: function(msg) {
                            $('#kelurahan').html(msg);
                        },
    
                        error: function(data) {
                            console.log('error: ', data)
                        },
    
                    })
                })
            })
        });
    
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

@endsection
