@extends('layouts.default')
@section('content')
    <div style="background-color:#cfe1d8; min-height: 100vh">
        @include('partials.navbar-sibakul')
        <div class="container" style="padding-top: 1rem">
            <section>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Statistik Data Aset Omset</h5>
                        <div style="padding-bottom: 2rem">
                            <form action="" method="get">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <input type="date" class="form-control form-control-sm rounded-0"
                                            name="tanggal_mulai"
                                            value="@if (!empty($mulai)){{ Carbon\Carbon::parse($mulai)->format('Y-m-d') }}@else{{ old('tanggal_mulai') }}@endif"
                                            aria-label="tanggal_mulai" aria-describedby="basic-addon1" required>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <input type="date" class="form-control form-control-sm rounded-0"
                                            name="tanggal_selesai"
                                            value="@if (!empty($selesai)){{ Carbon\Carbon::parse($selesai)->format('Y-m-d') }}@else{{ old('tanggal_selesai') }}@endif"
                                            aria-label="tanggal_selesai" aria-describedby="basic-addon1" required>
                                    </div>
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <button class="btn btn-sm btn-success w-100" type="submit">filter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive" style="padding-bottom: 1rem">
                            <table class="table table-striped table-borderless table-sm" style="margin: 0;">
                                <tr>
                                    <th>
                                        tanggal
                                    </th>
                                    <th>
                                        jenis
                                    </th>
                                    <th>
                                        kategori
                                    </th>
                                    <th>
                                        nominal
                                    </th>
                                </tr>
                                @foreach ($data as $data1)
                                    <tr>
                                        <td>
                                            {{ Carbon\Carbon::parse($data1->tanggal)->translatedformat('l j F Y') }}
                                        </td>
                                        <td>
                                            {{ $data1->jenis }}
                                        </td>
                                        <td>
                                            {{ $data1->kategori }}
                                        </td>
                                        <td>
                                            Rp. {{ number_format($data1->nominal, 0, '0', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4">
                                        <br>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        Total pemasukan:
                                    </td>
                                    <td>
                                        Rp. {{ number_format($sum_income, 0, '0', '.') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        Total Pengeluaran:
                                    </td>
                                    <td>
                                        Rp. {{ number_format($sum_outcome, 0, '0', '.') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        Omzet
                                    </td>
                                    <td>
                                        Rp. {{ number_format($omzet, 0, '0', '.') }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <a class="btn btn-success" href="{{route('lengkapi_data')}}">kembali</a>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
