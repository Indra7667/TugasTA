@extends('layouts.default')

@section('content')
    @include('partials.navbar-sibakul')
    <style>
        .tabbable .nav-tabs {
            overflow-x: auto;
            overflow-y: hidden;
            flex-wrap: nowrap;
        }

        .tabbable .nav-tabs .nav-link {
            white-space: nowrap;
        }

        .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
                background-color: #cfe1d8;
            }

        .nav-tabs {
            border-bottom: unset;
        }
    </style>
    <div style="background-color:#cfe1d8;">
        {{-- @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }} --}}
                {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
            {{-- </div>
        @endif --}}
        <nav class="tabbable" style="background-color:#f5f7fb; width: 100%;">
            <div class="container" style="width: 100%">
                <div class="nav nav-tabs" id="nav-tab" role="tablist" style="width: 100%;">
                    <button class="nav-link  @if(empty($status_agenda))active @endif" id="nav-fitur-tab" data-bs-toggle="tab" data-bs-target="#nav-fitur"
                        type="button" role="tab" aria-controls="nav-fitur" aria-selected=" @if(empty($status_agenda))true @else false @endif"
                        style="padding: 1rem 0.75rem;" onclick="removeslug()">
                        Fitur
                    </button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                        type="button" role="tab" aria-controls="nav-profile" aria-selected="false"
                        style="padding: 1rem 0.75rem;">
                        Profile
                    </button>
                    <button class="nav-link  @if(!empty($status_agenda))active @endif" id="nav-info-tab" data-bs-toggle="tab" data-bs-target="#nav-info"
                        type="button" role="tab" aria-controls="nav-info" aria-selected="@if(!empty($status_agenda))true @else false @endif"
                        style="padding: 1rem 0.75rem;">
                        Info
                    </button>
                    <button class="nav-link" id="nav-riwayat-tab" data-bs-toggle="tab" data-bs-target="#nav-riwayat"
                        type="button" role="tab" aria-controls="nav-riwayat" aria-selected="false"
                        style="padding: 1rem 0.75rem;">
                        Riwayat
                    </button>
                </div>
            </div>
        </nav>
        
        <div class="container">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade @if(empty($status_agenda))show active @endif" id="nav-fitur" role="tabpanel" aria-labelledby="nav-fitur-tab">

                    @include('partials.tabs_index.fitur')
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

                    @include('partials.tabs_index.profile')
                </div>
                <div class="tab-pane fade @if(!empty($status_agenda))show active @endif" id="nav-info" role="tabpanel" aria-labelledby="nav-info-tab">

                    @include('partials.tabs_index.info')
                </div>
                <div class="tab-pane fade" id="nav-riwayat" role="tabpanel" aria-labelledby="nav-riwayat-tab">
                    
                    @include('partials.tabs_index.riwayat')
                </div>
            </div>
        </div>
        @include('partials.footer')
    </div>
@endsection

<script>
    function removeslug() {
        // document.getElementById('urlSlug').value = '';
        history.replaceState(null, null, '?status_agenda=');
    }
</script>