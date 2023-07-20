@extends('layouts.default')
@section('content')
<div style="background-color:#cfe1d8; min-height: 100vh">
    @include('partials.navbar-sibakul')

    <div class="container">
        <section>
            <div style="padding-top: 1rem;">
                <div class="alert alert-danger" role="alert">
                    Isilah data dengan jujur sesuai kondisi, data bersifat rahasia dan digunakan hanya untuk kebutuhan pembinaan yang tepat untuk Anda
                </div>
            </div>

            @if ($data == 'data_diri')
                @include('partials.tabs_ubah_data.ubah_data_diri')
            @endif

            @if ($data == 'data_usaha')
                @include('partials.tabs_ubah_data.ubah_data_usaha')
            @endif

            @if ($data == 'legalitas_usaha')
                @include('partials.tabs_ubah_data.ubah_legalitas_usaha')
            @endif

            @if ($data == 'model_bisnis')
                @include('partials.tabs_ubah_data.ubah_model_bisnis')
            @endif

            @if ($data == 'koordinat_gps')
                @include('partials.tabs_ubah_data.ubah_koordinat_gps')
            @endif

            @if ($data == 'data_omset')
                @include('partials.tabs_ubah_data.ubah_data_omset')
            @endif

        </section>
    </div>
</div>
@endsection