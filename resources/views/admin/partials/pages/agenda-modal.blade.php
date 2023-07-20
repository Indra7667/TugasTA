<div class="modal fade" id="agendaModal{{ $list2->id_agenda }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Agenda - {{ $list2->nama_agenda }}
                    ({{ $list2->id_agenda }})</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-3">
                        @php
                            $url_logo = 'https://sibakuljogja.jogjaprov.go.id/green.png';
                            if (!empty($list2->gambar)) {
                                # code...
                                $url_logo = rawurlencode($list2->gambar);
                            }
                        @endphp
                        <div class="card"
                            style="background: url({{ asset('images/agenda/'.$url_logo.'') }});
                            background-size:cover; background-position: center; width:100%; aspect-ratio: 1 / 1; ">
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="container">
                            <div class="table-responsive">
                                <table class=" table table-striped" style="text-center">
                                    <tr>
                                        <td>Nama Acara</td>
                                        <td style="width:10%">:</td>
                                        <td>{{ $list2->nama_agenda }}</td>
                                    </tr>
                                    <tr>
                                        <td>Detail</td>
                                        <td style="width:10%">:</td>
                                        <td>{{ $list2->deskripsi }}</td>
                                    </tr>
                                    <tr>
                                        <td>Waktu Mulai</td>
                                        <td style="width:10%">:</td>
                                        <td>
                                            {{ Carbon\Carbon::parse($list2->waktu_mulai)->translatedFormat('h:i l, d F Y') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Waktu Selesai</td>
                                        <td style="width:10%">:</td>
                                        <td>{{ Carbon\Carbon::parse($list2->waktu_selesai)->translatedFormat('h:i l, d F Y') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>lokasi</td>
                                        <td style="width:10%">:</td>
                                        <td>{{ $list2->lokasi }}</td>
                                    </tr>
                                    <tr>
                                        <td>Contact Person</td>
                                        <td style="width:10%">:</td>
                                        <td>{{ $list2->nama_kontak_person }}</td>
                                    </tr>
                                    <tr>
                                        <td>nomor kontak</td>
                                        <td style="width:10%">:</td>
                                        <td>{{ $list2->kontak }}</td>
                                    </tr>
                                </table>
                            </div>
                            {{-- <nav class="w-100 d-flex justify-content-center">
                                <div class="nav nav-tabs w-100" id="nav-tab" role="tablist">
                                    <div class="row w-100 m-0">
                                        <div class="col-4">
                                            <button class="nav-link active w-100" id="nav-diri-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-diri" type="button" role="tab"
                                                aria-controls="nav-diri" aria-selected="true">Data <br> diri
                                            </button>
                                        </div>
        
                                        <div class="col-4">
                                            <button class="nav-link w-100" id="nav-usaha-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-usaha" type="button" role="tab"
                                                aria-controls="nav-usaha" aria-selected="false">Data <br> usaha
                                            </button>
                                        </div>
        
                                        <div class="col-4">
                                            <button class="nav-link w-100" id="nav-profil-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-profil" type="button" role="tab"
                                                aria-controls="nav-profil" aria-selected="false">Profil <br> usaha
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </nav> --}}
                        </div>
                    </div>
                </div>
                <div class="containter d-flex justify-content-center">
                    <div class="row" style="width:90%">
                        <div class="col-6">
                            <a href="{{ route('agenda_delete-admin', ['type' => 'delete', 'id' => $list2->id_agenda]) }}"
                                class="btn btn-danger" onclick="return confirm('apakah anda yakin?')" style="width: 100%">
                                <i class="fa fa-trash"></i> Delete
                            </a>
                        </div>
                        <div class="col-6">
                            {{-- <a href="javascript:void(0)" class="btn btn-warning"
                             style="width: 100%">
                                <i class="fa fa-edit"></i>
                            </a> --}}
                            <button class="btn btn-warning w-100" data-bs-toggle="modal"
                                data-bs-target="#agendaEditModal{{ $list2->id_agenda }}">
                                <i class="fa fa-circle-info text-light"></i> Edit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="agendaEditModal{{ $list2->id_agenda }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Agenda - {{ $list2->nama_agenda }}
                    ({{ $list2->id_agenda }})</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('agenda_post-admin',['type'=>'edit', 'id'=>$list2->id_agenda])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-3">
                            @php
                                $url_logo = 'https://sibakuljogja.jogjaprov.go.id/green.png';
                                if (!empty($list2->gambar)) {
                                    $url_logo = rawurlencode($list2->gambar);
                                }
                            @endphp
                            <div class="row">
                                <div class="col-12">
                                    <div class="card"
                                        style="background: url({{ asset('images/agenda/' . $url_logo . '') }});
                                    background-size:cover; background-position: center; width:100%; aspect-ratio: 1 / 1; ">
                                    </div>
                                    <div class="col-12 mt-3">
                                        <label for="formFileSm" class="form-label">Pilih gambar baru</label>
                                        <input class="form-control" type="file" id="formFile" name="gambar">
                                    </div>
                                    {{-- <div class="col-12 text-center">
                                        Gambar sebelumnya
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="container">
                                <div class="table-responsive">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Nama Acara</span>
                                        <input required type="text" class="form-control" name="nama"
                                            aria-label="Nama" value="{{old('nama', $list2->nama_agenda)}}" aria-describedby="basic-addon1">
                                    </div>
    
                                    <div class="input-group mb-3" style="padding-bottom:1rem">
                                        <span class="input-group-text h-auto">Deskripsi</span>
                                        <textarea class="form-control h-100" name="deskripsi" rows=4 aria-label="Desc">{{old('deskripsi', $list2->deskripsi)}}</textarea>
                                    </div>
    
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Waktu Mulai</span>
                                        <input required type="datetime-local" class="form-control" value="{{old('mulai', $list2->waktu_mulai)}}" name="mulai" aria-label="Mulai"
                                            aria-describedby="basic-addon1">
                                    </div>
    
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Waktu Selesai</span>
                                        <input required type="datetime-local" class="form-control" name="selesai" value="{{old('selesai', $list2->waktu_selesai)}}"
                                            aria-label="Selesai" aria-describedby="basic-addon1">
                                    </div>
    
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Lokasi</span>
                                        <input required type="text" class="form-control" name="lokasi" value="{{old('lokasi', $list2->lokasi)}}"
                                            aria-label="Lokasi" aria-describedby="basic-addon1">
                                    </div>
    
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Nama CP</span>
                                        <input type="text" class="form-control" name="cp" value="{{old('cp', $list2->nama_kontak_person)}}"
                                            aria-label="CP" aria-describedby="basic-addon1">
                                    </div>
    
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Kontak</span>
                                        <input type="text" class="form-control" name="kontak" value="{{old('kontak', $list2->kontak)}}"
                                            aria-label="Kontak" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="containter d-flex justify-content-center">
                        <div class="row" style="width:90%">
                            <div class="col-6">
                                <button class="btn btn-danger w-100" data-bs-toggle="modal" type="reset"
                                onclick="return confirm('perubahan tidak disimpan, apakah anda yakin ingin kembali?')"
                                    data-bs-target="#agendaModal{{ $list1->id_agenda }}">
                                    <i class="fa fa-arrow-left"></i> Back
                                </button>
                            </div>
                            <div class="col-6">
                                {{-- <a href="{{route('agenda_post-admin', ['type'=>'delete', 'id' => $list2->id_agenda])}}" class="btn btn-danger" 
                                onclick="return confirm('apakah anda yakin?')" style="width: 100%">
                                    <i class="fa fa-trash"></i>
                                </a> --}}
                                <button class="btn btn-success w-100" type="submit" 
                                onclick="return confirm('apakah anda yakin?')">
                                    Submit <i class="fa fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script></script>
