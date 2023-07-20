@extends('layouts.default')
@section('content')
    <div style="background-color:#cfe1d8; min-height: 100vh">
        @include('partials.navbar-sibakul')
        <div class="container">
            <section>
                <div style="padding-top: 1rem;">
                    <div class="alert alert-danger" role="alert">
                        Isilah data dengan jujur sesuai kondisi, data bersifat rahasia dan digunakan hanya untuk kebutuhan
                        pembinaan yang tepat untuk Anda
                    </div>
                </div>
                <div class="accordion accordion-flush" id="accordionFlushData" style="padding-bottom: 1rem;">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-heading1">
                            <button class="accordion-button @if($open != 'data' && !empty($open)) collapsed @endif" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapse1" onclick="remove()"
                                @if ($open == 'data' || empty($open)) aria-expanded="true" @else aria-expanded="false" @endif
                                aria-controls="flush-collapse1">
                                1. Data Usaha
                            </button>
                        </h2>
                        <div id="flush-collapse1" class="accordion-collapse collapse @if($open == 'data' || empty($open)) show @endif" aria-labelledby="flush-heading1"
                            data-bs-parent="#accordionFlushData">
                            <div class="accordion-body">
                                @include('partials.tabs_lengkapi_data.data_usaha')
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-heading3">
                            <button class="accordion-button @if($open != 'lokasi') collapsed @endif" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapse3" onclick="onoff()"
                                @if ($open == 'lokasi') aria-expanded="true" @else aria-expanded="false" @endif
                                aria-controls="flush-collapse3">
                                2. Lokasi UKM (GPS)
                            </button>
                        </h2>
                        <div id="flush-collapse3" class="accordion-collapse collapse @if($open == 'lokasi') show @endif" aria-labelledby="flush-heading3"
                            data-bs-parent="#accordionFlushData">
                            <div class="accordion-body">
                                @include('partials.tabs_lengkapi_data.lokasi_ukm')
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-heading2">
                            <button class="accordion-button @if($open != 'omset') collapsed @endif" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapse2" onclick="remove()"
                                @if ($open == 'omset') aria-expanded="true" @else aria-expanded="false" @endif
                                aria-controls="flush-collapse2">
                                3. Data Omset
                            </button>
                        </h2>
                        <div id="flush-collapse2" class="accordion-collapse collapse @if($open == 'omset') show @endif" aria-labelledby="flush-heading2"
                            data-bs-parent="#accordionFlushData">
                            <div class="accordion-body">
                                @include('partials.tabs_lengkapi_data.data_omset')
                            </div>
                        </div>
                    </div>
                    {{-- <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-heading4">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse4" aria-expanded="false" aria-controls="flush-collapse4">
                        4. Aspek Kelembagaan
                        </button>
                    </h2>
                    <div id="flush-collapse4" class="accordion-collapse collapse" aria-labelledby="flush-heading4" data-bs-parent="#accordionFlushData">
                        <div class="accordion-body">
                            @include('partials.tabs_lengkapi_data.aspek_kelembagaan')
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-heading5">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse5" aria-expanded="false" aria-controls="flush-collapse5">
                        5. Aspek Produksi
                        </button>
                    </h2>
                    <div id="flush-collapse5" class="accordion-collapse collapse" aria-labelledby="flush-heading5" data-bs-parent="#accordionFlushData">
                        <div class="accordion-body">
                            @include('partials.tabs_lengkapi_data.aspek_produksi')
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-heading6">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse6" aria-expanded="false" aria-controls="flush-collapse6">
                        6. Aspek Keuangan
                        </button>
                    </h2>
                    <div id="flush-collapse6" class="accordion-collapse collapse" aria-labelledby="flush-heading6" data-bs-parent="#accordionFlushData">
                        <div class="accordion-body">
                            @include('partials.tabs_lengkapi_data.aspek_keuangan')
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-heading7">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse7" aria-expanded="false" aria-controls="flush-collapse7">
                        7. Aspek Pasar
                        </button>
                    </h2>
                    <div id="flush-collapse7" class="accordion-collapse collapse" aria-labelledby="flush-heading7" data-bs-parent="#accordionFlushData">
                        <div class="accordion-body">
                            @include('partials.tabs_lengkapi_data.aspek_pasar')
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-heading8">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse8" aria-expanded="false" aria-controls="flush-collapse8">
                        8. Aspek Pemasaran Online
                        </button>
                    </h2>
                    <div id="flush-collapse8" class="accordion-collapse collapse" aria-labelledby="flush-heading8" data-bs-parent="#accordionFlushData">
                        <div class="accordion-body">
                            @include('partials.tabs_lengkapi_data.aspek_pemasaran_online')
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-heading9">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse9" aria-expanded="false" aria-controls="flush-collapse4">
                        9. Aspek SDM
                        </button>
                    </h2>
                    <div id="flush-collapse9" class="accordion-collapse collapse" aria-labelledby="flush-heading9" data-bs-parent="#accordionFlushData">
                        <div class="accordion-body">
                            @include('partials.tabs_lengkapi_data.aspek_sdm')
                        </div>
                    </div>
                </div> --}}
                </div>
            </section>
        </div>
    </div>
@endsection
