@extends('layouts.default')

@section('content')
    <div style="background-color: #cfe1d8; min-height: 100vh; max-height: 100%;">
        @include('partials.navbar-home')
        <style>
            .tabbable .nav-tabs {
                overflow-x: auto;
                overflow-y: hidden;
                flex-wrap: nowrap;
            }

            .tabbable .nav-tabs .nav-link {
                white-space: nowrap;
            }

            .nav-tabs .nav-item.show .nav-link,
            .nav-tabs .nav-link.active {
                background-color: #cfe1d8;
            }

            .nav-tabs {
                border-bottom: unset;
            }
        </style>
        <nav class="tabbable" style="background-color:#f5f7fb; width: 100%;">
            <div class="container" style="width: 100%">
                <div style="padding: 1rem 0;">
                    <div class="alert alert-warning" role="alert" style="margin: 0;">
                        <p style="font-size: 80%; font-weight: 600; text-align: justify;">
                            Mohon isi ketiga tab di bawah ini untuk menambahkan barang!
                        </p>
                    </div>
                </div>
                <div class="nav nav-tabs" id="nav-tab" role="tablist" style="width: 100%;">
                    <button class="nav-link active" id="nav-data_utama-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-data_utama" type="button" role="tab" aria-controls="nav-data_utama"
                        aria-selected="true" style="padding: 1rem 0.75rem;">
                        Data Utama
                    </button>
                    <button class="nav-link" id="nav-foto_tambahan-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-foto_tambahan" type="button" role="tab" aria-controls="nav-foto_tambahan"
                        aria-selected="false" style="padding: 1rem 0.75rem;">
                        Foto Tambahan
                    </button>
                    <button class="nav-link" id="nav-isian_ekspedisi-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-isian_ekspedisi" type="button" role="tab"
                        aria-controls="nav-isian_ekspedisi" aria-selected="false" style="padding: 1rem 0.75rem;">
                        Isian Ekspedisi
                    </button>
                </div>
            </div>
        </nav>

        <div class="container">
            @php
                $idnew = 'new';
                if(!empty($id)){
                    $idnew = $id;
                }
            @endphp
            <form action="{{route('post-barang',['id'=>$idnew])}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-data_utama" role="tabpanel"
                        aria-labelledby="nav-data_utama-tab">
                        @include('partials.tabs_tambah_dagangan.data_utama')
                    </div>
                    <div class="tab-pane fade" id="nav-foto_tambahan" role="tabpanel"
                        aria-labelledby="nav-foto_tambahan-tab">
                        @include('partials.tabs_tambah_dagangan.foto_tambahan')
                    </div>
                    <div class="tab-pane fade" id="nav-isian_ekspedisi" role="tabpanel"
                        aria-labelledby="nav-isian_ekspedisi-tab">
                        @include('partials.tabs_tambah_dagangan.isian_ekspedisi')
                    </div>
                </div>
            </form>
            {{-- <div style="padding: 2rem 0">
                <a class="btn btn-danger" href="{{ route('daganganku') }}">Kembali</a>
            </div> --}}
            @include('partials.back-url')
        </div>
    </div>
@endsection
