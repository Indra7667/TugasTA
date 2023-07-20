<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SiBakul Jogja</title>
    <!-- MDB icon -->
    <link rel="icon" href="https://sibakuljogja.jogjaprov.go.id/profil/images/SiBakul.png" type="image/x-icon" />
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{!! asset('css/mdb.min.css') !!}" />
    <!-- Style -->
    {{-- <link rel="stylesheet" href="{!! asset('css/style.css') !!}" /> --}}
    <!-- Bootstrap CSS -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> --}}
    <script src="https://cdn.tiny.cloud/1/iuefc21ujfs3xxcirbb9hbf327pgugyxqx9rz7npvh5dwoft/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    
    {{-- openstreet --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
    {{-- openstreetend --}}
    <link rel="stylesheet" href="{!! asset('public/admin/vendors/toastify/toastify.css') !!}">
    <?php session_start(); ?>
</head>

<style>
p {
    margin: 0;
}
</style>

<body id="scroller" data-role="page">
    @include('partials.toast')
    <!-- Start your project here-->
    @if($status->status != 'normal' && empty($admin))
    {{-- {{dd(get_defined_vars())}} --}}
    <div class="container d-flex align-items-center" style="height: 100%; padding-top:7.5rem">
        <section>
            <div class="container">
                <div class="row d-flex align-items-center justify-content-center">
                    <div class="col-md-8 col-lg-7 col-xl-6">
                        <img src="{!! asset('public/images/error.png') !!}" class="img-fluid" alt="Maintenance">
                    </div>
                    <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                        <div class="container d-flex justify-content-center align-items-center">
                            <div class="row d-flex justify-content-center align-items-center">
                                <h2 class="col-12 text-center" style="font-size: 5rem; font-weight:600; margin: 0;"></h2>
                                <p class="col-12 text-center" style="font-size: 1.5rem; font-weight:400; margin: 0; padding-bottom: 0.5rem;">Server Maintenance</p>
                                <hr style="text-align: center; width: 75%;">
                                <p class="col-12 text-center" style="font-size: 1rem; font-weight:600; margin: 0; padding-bottom: 1rem;">Saat ini sedang dilakukan perawatan server, mohon tunggu beberapa saat</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @else
    @yield('content')
    @endif
    <!-- End your project here-->

    <!-- toastify -->
    <script src="{!! asset('public/admin/vendors/toastify/toastify.js') !!}"></script>
    <!-- MDB -->
    <script type="text/javascript" src="{!! asset('js/mdb.min.js')!!}"></script>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- ajax -->
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
    <script src="https://kit.fontawesome.com/5014e491f0.js" crossorigin="anonymous"></script>
</body>

</html>
