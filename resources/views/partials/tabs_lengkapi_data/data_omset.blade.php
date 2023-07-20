@if (session()->has('successDataOmset'))
    <div class="alert alert-success alert-dismissible fade show rounded-0" role="alert">
        {{ session('successDataOmset') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"
            aria-label="Close"></button>
    </div>
@endif

<div class="row justify-content-between">
    <div class="col-3">
        <a href="{{route('tambah_data', ['data' => 'data_omset'])}}" type="button" class="btn btn-success btn-sm w-100" style="text-transform: capitalize; font-weight: 600;"><i class="fa-solid fa-plus"></i>&nbsp;&nbsp;Tambah data omset</a>
    </div>
    <div class="col-3">
        <a href="{{route('stat_omset')}}" type="button" class="btn btn-success btn-sm w-100" style="text-transform: capitalize; font-weight: 600;"><i class="fa-solid fa-info"></i>&nbsp;&nbsp;statistik aset omset</a>
    </div>
</div>

@if (count($data_omset) > 0)
    <div class="row d-flex justify-content-center w-100" style="margin: 0">
        <div class="table-responsive">
            <table class="table table-striped" id="table2">
                <thead>
                    <tr>
                        <th>
                            Tanggal
                        </th>
                        <th>
                            nominal
                        </th>
                        <th>
                            Jenis
                        </th>
                        <th>
                            Kategori
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
                                {{-- {{ $omset->periode_tahun }} @if ($omset->periode_semester == 1) Ganjil @elseif ($omset->periode_semester == 2) Genap @endif --}}
                                {{Carbon\Carbon::parse($omset->tanggal)->translatedFormat('d F Y')}}
                            </td>
                            <td>
                                Rp. {{ number_format($omset->nominal,0,"",".") }}
                            </td>
                            <td>
                                {{$omset->jenis}}
                            </td>
                            <td>
                                {{$omset->kategori}}
                            </td>
                            <td>
                                {{($omset->nilai_modal_usaha) }}
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-6">
                                        <a class="btn btn-warning w-100" href="{{route('tambah_data', ['data' => 'data_omset', 'id' => $omset->id_aset_omset])}}">Ubah</a>        
                                    </div>
                                    <div class="col-6">
                                        <a class="btn btn-danger w-100" href="{{route('delete_omset',['id'=>$omset->id_aset_omset])}}" onclick="return confirm('Hapus data ini?')">Hapus</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@else
    <p class="text-center text-danger" style="margin: 1rem 0;">Belum menambahkan Data Omset</p>
@endif
