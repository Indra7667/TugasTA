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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"
        rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{!! asset('css/mdb.min.css') !!}" />
    <!-- Style -->
    {{-- <link rel="stylesheet" href="{!! asset('css/style.css') !!}" /> --}}
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <link rel="stylesheet" href="{!! asset('public/admin/vendors/toastify/toastify.css') !!}">
    <?php session_start(); ?>
</head>

<style>


</style>

<body id="scroller" data-role="page">
    <!-- Start your project here-->
    @include('partials.toast')
    @yield('content')
    <!-- End your project here-->

    <!-- toastify -->
    <script src="{!! asset('public/admin/vendors/toastify/toastify.js') !!}"></script>
    <!-- MDB -->
    <script type="text/javascript" src="{!! asset('js/mdb.min.js') !!}"></script>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- ajax -->
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
    <script src="https://kit.fontawesome.com/5014e491f0.js" crossorigin="anonymous"></script>
</body>

</html>
