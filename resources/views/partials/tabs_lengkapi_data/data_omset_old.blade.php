@if (session()->has('successDataOmset'))
    <div class="alert alert-success alert-dismissible fade show rounded-0" role="alert">
        {{ session('successDataOmset') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"
            aria-label="Close"></button>
    </div>
@endif

<a href="{{route('tambah_data', ['data' => 'data_omset'])}}" type="button" class="btn btn-success btn-sm" style="text-transform: capitalize; font-weight: 600;"><i class="fa-solid fa-plus"></i>&nbsp;&nbsp;Tambah data omset</a>

@if (count($data_omset) > 0)
    <div class="row d-flex justify-content-center w-100" style="margin: 0">
        <div class="table-responsive">
            <table class="table table-striped" id="table2">
                <thead>
                    <tr>
                        <th>
                            Periode
                        </th>
                        <th>
                            Omset
                        </th>
                        <th>
                            Nilai Modal Usaha
                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_omset as $omset)
                        <tr>
                            <td>
                                {{ $omset->periode_tahun }} @if ($omset->periode_semester == 1) Ganjil @elseif ($omset->periode_semester == 2) Genap @endif
                            </td>
                            <td>
                                Rp. {{ number_format($omset->omset_bulanan,0,"",".") }}
                            </td>
                            <td>
                                {{($omset->nilai_modal_usaha) }}
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-6">
                                        <a class="btn btn-warning w-100" href="{{route('tambah_data', ['data' => 'data_omset', 'id' => $omset->id])}}">Ubah</a>        
                                    </div>
                                    <div class="col-6">
                                        <a class="btn btn-danger w-100" href="{{route('delete_omset',['id'=>$omset->id])}}" onclick="return confirm('Hapus data ini?')">Hapus</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- @foreach ($data_omset as $omset)
        <div class="col-lg-6 col-md-6 col-sm-12" style="margin: 0.5rem 0">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Periode: {{ $omset->periode_tahun }} @if ($omset->periode_semester == 1) Ganjil @elseif ($omset->periode_semester == 2) Genap @endif</h5>
                    <table class="table table-striped table-borderless table-sm" style="margin:0;">
                        <tr>
                            <td>Omset Bulanan</td>
                            <td class="text-end">Rp. {{ number_format($omset->omset_bulanan,0,"",".") }}</td>
                        </tr>
                        <tr>
                            <td>Nilai Modal Usaha</td>
                            <td class="text-end">Rp. {{ number_format($omset->nilai_modal_usaha,0,"",".") }}</td>
                        </tr>
                    </table>
                    <div class="row d-flex justify-content-around" style="margin-top: 0.5rem;">
                        <div class="col-6">
                            <a href="{{route('tambah_data', ['data' => 'data_omset', 'id' => $omset->id])}}" type="button" class="btn btn-warning btn-sm" style="width: 100%;">Ubah</a>
                        </div>
                        <div class="col-6">
                            <a href="{{route('delete_omset',['id'=>$omset->id])}}" onclick="return confirm('Hapus data ini?')" type="button" class="btn btn-danger btn-sm" style="width: 100%;">Hapus</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach --}}
    </div>
@else
    <p class="text-center text-danger" style="margin: 1rem 0;">Belum menambahkan Data Omset</p>
@endif
