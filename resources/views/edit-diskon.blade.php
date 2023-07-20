@extends('layouts.default')

@section('content')
    @include('partials.navbar-home')
    <div style="background-color: #cfe1d8;">
        <div class="container" style="min-height:74vh; ">
            @php
                if (!empty($data->nama_diskon)) {
                    $p_namaDisc = $data->nama_diskon;
                } else {
                    $p_namaDisc = 'Nama Diskon';
                }
                if (!empty($data->nominal)) {
                    $p_nominal = $data->nominal;
                } else {
                    $p_nominal = 'Persen Diskon';
                }
            @endphp
            <form action="{{ route('post-diskon', ['id' => $id]) }}" method="POST">
                @csrf
                <div class="row d-flex justify-content-center">
                    <div class="col-12" style="padding-top:1rem">
                        <label for="nama_diskon" class="form-label">Nama Diskon</label>
                        <input type="text" class="form-control" name="nama_diskon" id="nama_diskon"
                            placeholder="{{ $p_namaDisc }}">
                    </div>
                    <div class="col-12" style="padding-top:1rem">
                        <label for="nominal" class="form-label">Nominal Diskon</label>
                        <div class=" input-group">

                            <input type="number" required class="form-control" name="nominal" id="nominal"
                                placeholder="{{ $p_nominal }}">
                            <span class="input-group-text" id="nominal">%</span>
                        </div>
                    </div>
                </div>

                    <div class="row" style="width: 100%;padding-top:2rem;margin:0">
                        <div class="col-6">
                            <button type="submit" class="btn btn-success w-100" style="text-transform: capitalize;">
                                <b>ubah</b>
                            </button>

                        </div>
                        <div class="col-6">
                            <a class="btn btn-danger w-100" style="width: 50%" href="{{ route('hapus-diskon',['id'=>$id])}}">
                                Hapus diskon
                            </a>
                        </div>

                    </div>

            </form>
        </div>
        <div class="container">
            @include('partials.back-url')
        </div>
    </div>
@endsection
