@extends('layouts.default')
@section('content')
    <div style="background-color:#cfe1d8; min-height: 100vh">
        @include('partials.navbar-sibakul')
        <div class="container" style="padding-top: 1rem">
            <section>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Sejarah kurasi</h5>
                        <div style="padding-bottom: 2rem">
                            <form action="" method="get">
                                <div class="row">
                                    <div class="col-9">
                                        <select name='status_f' class="form-select form-select-sm" id='status'
                                            aria-label="Default select example">
                                            <option @if ($status_f == 'empty') selected @endif value="">
                                                Semua</option>
                                            @foreach ($status_k as $status_k1)
                                                <option @if ($status_k1->id_status_kurasi == $status_f) selected @endif
                                                    value="{{ $status_k1->id_status_kurasi }}">
                                                    {{ $status_k1->status_kurasi }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-3">
                                            <button class="btn btn-sm btn-success w-100" type="submit">filter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive" style="padding-bottom: 1rem">
                            <table class="table table-striped table-borderless table-sm" style="margin: 0;">
                                <tr>
                                    <th>waktu</th>
                                    <th>status</th>
                                    <th>keseuaian judul</th>
                                    <th>kualitas foto</th>
                                    <th>kesesuaian deskripsi</th>
                                    <th>harga</th>
                                    <th>berat</th>
                                </tr>
                                @foreach ($data as $data1)
                                    @php
                                        if ($data1->judul_sesuai == '1') {
                                            $judul = 'fa-check text-success';
                                        } elseif ($data1->judul_sesuai == '0') {
                                            $judul = 'fa-xmark text-danger';
                                        } else {
                                            $judul = 'fa-question text-warning';
                                        }
                                        
                                        if ($data1->foto_bagus == '1') {
                                            $fotob = 'fa-check text-success';
                                        } elseif ($data1->judul_sesuai == '0') {
                                            $fotob = 'fa-xmark text-danger';
                                        } else {
                                            $fotob = 'fa-question text-warning';
                                        }
                                        
                                        if ($data1->deskripsi_jelas == '1') {
                                            $desc = 'fa-check text-success';
                                        } elseif ($data1->judul_sesuai == '0') {
                                            $desc = 'fa-xmark text-danger';
                                        } else {
                                            $desc = 'fa-question text-warning';
                                        }
                                        
                                        if ($data1->harga_isset == '1') {
                                            $hargaset = 'fa-check text-success';
                                        } elseif ($data1->judul_sesuai == '0') {
                                            $hargaset = 'fa-xmark text-danger';
                                        } else {
                                            $hargaset = 'fa-question text-warning';
                                        }
                                        
                                        if ($data1->weight_isset == '1') {
                                            $weight = 'fa-check text-success';
                                        } elseif ($data1->judul_sesuai == '0') {
                                            $weight = 'fa-xmark text-danger';
                                        } else {
                                            $weight = 'fa-question text-warning';
                                        }
                                        
                                    @endphp
                                    <tr>
                                        <td>{{ $data1->waktu_kurasimarkethub }}</td>
                                        <td>{{ $data1->status_kurasi }}</td>
                                        <td><i class="fa {{ $judul }}"></i></td>
                                        <td><i class="fa {{ $fotob }}"></i></td>
                                        <td><i class="fa {{ $desc }}"></i></td>
                                        <td><i class="fa {{ $hargaset }}"></i></td>
                                        <td><i class="fa {{ $weight }}"></i></td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <a class="btn btn-success" href="{{ route('daganganku') }}">kembali</a>
                </div>
        </div>
        </section>
    </div>
    </div>
@endsection
