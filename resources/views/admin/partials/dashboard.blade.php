<div id="main-content">
    <div class="page-heading" style="padding-top:1rem">
        <div class="page-title">
            <h3 class="title">Dashboard</h3>
        </div>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-12 col-sm-12" style="padding-top:0.5rem">
                        <div class="card">
                            <div class="card-body">
                                <div class="row justify-content-between" style="padding-left: 1rem;">
                                    <div class="col-2">
                                        <div class="stats-icon purple">
                                            <i class="iconly-boldUser"></i>
                                        </div>
                                    </div>
                                    <div class="col-6" style="padding-left:0; padding-right:0">
                                        <h6 class="text-muted font-semibold">Pedagang</h6>
                                        <h6 class="font-extrabold justify-content-center d-flex"
                                            style="color: darkslategray">
                                            <i class="fa fa-globe text-primary"></i>
                                            {{ $counts['dagang_all'] }} | &nbsp;
                                            <span><i class="fa fa-power-off text-success"></i></span>
                                            {{ $counts['dagang_on'] }}
                                        </h6>
                                    </div>
                                    <div class="col-4 d-flex align-items-center justify-content-center">
                                        <a class="btn btn-success" href="{{route('pedagang_list-admin')}}">detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12" style="padding-top:0.5rem">
                        <div class="card">
                            <div class="card-body">
                                <div class="row justify-content-between" style="padding-left: 1rem;">
                                    <div class="col-2">
                                        <div class="stats-icon green">
                                            <i class="iconly-boldAdd-User"></i>
                                        </div>
                                    </div>
                                    <div class="col-6" style="padding-left:0; padding-right:0">
                                        <h6 class="text-muted font-semibold">Konsultasi</h6>
                                        <h6 class="font-extrabold mb-0 justify-content-center d-flex"
                                            style="color: darkslategray">
                                            <i class="fa fa-globe text-primary"></i>
                                            [404] | &nbsp;
                                            <span><i class="fa fa-triangle-exclamation text-warning"></i></span>
                                            [404]
                                        </h6>
                                    </div>
                                    <div class="col-4 d-flex align-items-center justify-content-center">
                                        <a class="btn btn-success" href="javascript:void(0)">detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12" style="padding-top:0.5rem">
                        <div class="card">
                            <div class="card-body">
                                <div class="row justify-content-between" style="padding-left: 1rem;">
                                    <div class="col-2">
                                        <div class="stats-icon red">
                                            <i class="iconly-boldAdd-User"></i>
                                        </div>
                                    </div>
                                    <div class="col-6" style="padding-left:0; padding-right:0">
                                        <h6 class="text-muted font-semibold">Request password</h6>
                                        <h6 class="font-extrabold mb-0 justify-content-center d-flex"
                                            style="color: darkslategray">
                                            <i class="fa fa-globe text-primary"></i>
                                            {{$counts["forgot_all"]}} | &nbsp;
                                            <span><i class="fa fa-triangle-exclamation text-warning"></i></span>
                                            {{$counts["forgot_new"]}}
                                        </h6>
                                    </div>
                                    <div class="col-4 d-flex align-items-center justify-content-center">
                                        <a class="btn btn-success" href="{{route('forgot_list-admin')}}">detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12" style="padding-top:0.5rem">
                        <div class="card">
                            <div class="card-body">
                                <div class="row justify-content-between" style="padding-left: 1rem;">
                                    <div class="col-2">
                                        <div class="stats-icon green">
                                            <i class="iconly-boldAdd-User"></i>
                                        </div>
                                    </div>
                                    <div class="col-6" style="padding-left:0; padding-right:0">
                                        <h6 class="text-muted font-semibold">E-Learning</h6>
                                        <h6 class="font-extrabold mb-0 justify-content-center d-flex"
                                            style="color: darkslategray">
                                            <i class="fa fa-globe text-primary"></i>
                                            [404] | &nbsp;
                                            <span><i class="fa fa-power-off text-success"></i></span>
                                            [404]
                                        </h6>
                                    </div>
                                    <div class="col-4 d-flex align-items-center justify-content-center">
                                        <a class="btn btn-success" href="javascript:void(0)">detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12" style="padding-top:0.5rem">
                        <div class="card">
                            <div class="card-body">
                                <div class="row justify-content-between" style="padding-left: 1rem;">
                                    <div class="col-2">
                                        <div class="stats-icon green">
                                            <i class="iconly-boldAdd-User"></i>
                                        </div>
                                    </div>
                                    <div class="col-6" style="padding-left:0; padding-right:0">
                                        <h6 class="text-muted font-semibold">Pelatihan</h6>
                                        <h6 class="font-extrabold mb-0 justify-content-center d-flex"
                                            style="color: darkslategray"> 
                                            <i class="fa fa-globe text-primary"></i>
                                            [404] | &nbsp; 
                                            <span><i class="fa fa-power-off text-success"></i></span>
                                            [404]
                                        </h6>
                                    </div>
                                    <div class="col-4 d-flex align-items-center justify-content-center">
                                        <a class="btn btn-success" href="javascript:void(0)">detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12" style="padding-top:0.5rem">
                        <div class="card">
                            <div class="card-body">
                                <div class="row justify-content-between" style="padding-left: 1rem;">
                                    <div class="col-2">
                                        <div class="stats-icon green">
                                            <i class="iconly-boldAdd-User"></i>
                                        </div>
                                    </div>
                                    <div class="col-6" style="padding-left:0; padding-right:0">
                                        <h6 class="text-muted font-semibold">Agenda</h6>
                                        <h6 class="font-extrabold mb-0 justify-content-center d-flex"
                                            style="color: darkslategray">
                                            <i class="fa fa-globe text-primary"></i>
                                            [404] | &nbsp;
                                            <span><i class="fa fa-power-off text-success"></i></span>
                                            [404]
                                        </h6>
                                    </div>
                                    <div class="col-4 d-flex align-items-center justify-content-center">
                                        <a class="btn btn-success" href="javascript:void(0)">detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12" style="padding-top:0.5rem">
                        <div class="card">
                            <div class="card-body">
                                <div class="row justify-content-between" style="padding-left: 1rem;">
                                    <div class="col-2">
                                        <div class="stats-icon blue">
                                            <i class="iconly-boldPaper"></i>
                                        </div>
                                    </div>
                                    <div class="col-6" style="padding-left:0; padding-right:0">
                                        <h6 class="text-muted font-semibold">Kurasi</h6>
                                        <h6 class="font-extrabold mb-0 justify-content-center d-flex"
                                            style="color: darkslategray">
                                            <i class="fa fa-globe text-primary"></i>
                                            {{ $counts['kur_all'] }} | &nbsp;
                                            <span><i class="fa fa-triangle-exclamation text-warning"></i></span>
                                            {{ $counts['kur_new'] }}
                                        </h6>
                                    </div>
                                    <div class="col-4 d-flex align-items-center justify-content-center">
                                        <a class="btn btn-success" href="javascript:void(0)">detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12" style="padding-top:0.5rem">
                        <div class="card">
                            <div class="card-body">
                                <div class="row justify-content-between" style="padding-left: 1rem;">
                                    <div class="col-2">
                                        <div class="stats-icon green">
                                            <i class="iconly-boldAdd-User"></i>
                                        </div>
                                    </div>
                                    <div class="col-6" style="padding-left:0; padding-right:0">
                                        <h6 class="text-muted font-semibold">Barang Berdiskon</h6>
                                        <h6 class="font-extrabold mb-0 justify-content-center d-flex"
                                            style="color: darkslategray"> 
                                            <i class="fa fa-globe text-primary"></i>
                                            [404] | &nbsp; 
                                            <span><i class="fa fa-triangle-exclamation text-warning"></i></span>
                                            [404]
                                        </h6>
                                    </div>
                                    <div class="col-4 d-flex align-items-center justify-content-center">
                                        <a class="btn btn-success" href="javascript:void(0)">detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
