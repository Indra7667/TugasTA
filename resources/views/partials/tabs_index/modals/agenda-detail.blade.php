<div class="modal fade" id="agendaDetail{{ $agenda1->id_agenda }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Agenda - {{ $agenda1->nama_agenda }}
                    ({{ $agenda1->id_agenda }})</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-3">
                        @php
                            $url_logo = 'https://sibakuljogja.jogjaprov.go.id/green.png';
                            if (!empty($agenda1->gambar)) {
                                $url_logo = rawurlencode($agenda1->gambar);
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
                                        <td>{{ $agenda1->nama_agenda }}</td>
                                    </tr>
                                    <tr>
                                        <td>Detail</td>
                                        <td style="width:10%">:</td>
                                        <td>{{ $agenda1->deskripsi }}</td>
                                    </tr>
                                    <tr>
                                        <td>Waktu Mulai</td>
                                        <td style="width:10%">:</td>
                                        <td>
                                            {{ Carbon\Carbon::parse($agenda1->waktu_mulai)->translatedFormat('h:i l, d F Y') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Waktu Selesai</td>
                                        <td style="width:10%">:</td>
                                        <td>{{ Carbon\Carbon::parse($agenda1->waktu_selesai)->translatedFormat('h:i l, d F Y') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>lokasi</td>
                                        <td style="width:10%">:</td>
                                        <td>{{ $agenda1->lokasi }}</td>
                                    </tr>
                                    <tr>
                                        <td>Contact Person</td>
                                        <td style="width:10%">:</td>
                                        <td>{{ $agenda1->nama_kontak_person }}</td>
                                    </tr>
                                    <tr>
                                        <td>nomor kontak</td>
                                        <td style="width:10%">:</td>
                                        <td>{{ $agenda1->kontak }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="containter d-flex justify-content-center">
                    <div class="row" style="width:90%">
                        <div class="col-12">
                            {{-- {{dd($agenda1->id_agenda, $agenda_joined)}} --}}
                            @php
                                if (in_array($agenda1->id_agenda,$agenda_joined)) {
                                    $action = "batalkan pendaftaran";
                                    $btn = "btn-danger";
                                } else {
                                    $action = "mendaftar";
                                    $btn = "btn-success";
                                }
                            @endphp
                            <a href="{{route('daftar-agenda', ['id_agenda' => $agenda1->id_agenda])}}"
                                class="btn {{$btn}}" onclick="return confirm('apakah anda yakin?')" style="width: 100%">
                                <i class="fa fa-clipboard-list"></i> {{$action}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>