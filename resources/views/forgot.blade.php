@extends('layouts.default')
@section('content')
<div class="container" style="padding-top: 25vh">
    <section class="m-auto">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-7 col-lg-5 col-xl-5">
                    <p class="text-center">Lupa passowrd? <br> Jangan khawatir, anda dapat mengubah password di sini</p>
                    <br>
                        @if(session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                          <br>
                        @endif
                              
                        <form class="form" action="{{route('post_forgot')}}" method="post">
                            @csrf
                            <div class="form-outline mb-4">
                                <input type="text" id="idsibakul" name="idsibakul" class="form-control form-control-lg" style="background-color:white;" maxlength="14" required/>
                                <label class="form-label" for="idsibakul">ID Sibakul</label>
                            </div>
                        <div class="form-outline mb-4">
                            <input type="text" id="momor_wa" name="no_wa" class="form-control form-control-lg" onkeypress="return hanyaAngka(event)" style="background-color:white;" maxlength="14" required/>
                            <label class="form-label" for="momor_wa">Isi nomor WhatsApp</label>
                        </div>

                        <button type="submit" class="btn btn-success btn-lg btn-block" style="text-transform: capitalize; font-size: 100%; font-weight: bold; padding: 1rem 0;">Kirim</button>
                        </form>

                        <script>
                            function hanyaAngka(evt) {
                                var charCode = (evt.which) ? evt.which : event.keyCode
                                if (charCode > 31 && (charCode < 48 || charCode > 57))
                                    return false;
                                return true;
                            }
                        </script>
                </div>
            </div>
        </div>
    </section>
</div>
@include('partials.footer')
@endsection