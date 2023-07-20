<div class="modal fade" id="diskonModal{{ $diskon2->id_diskon }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Diskon id.{{ $diskon2->id_diskon }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div id="carouselExampleIndicators{{ $diskon2->id }}" class="carousel slide"
                            data-bs-ride="false">
                            @php
                                $pic_count = 0;
                                $gambars = [];
                                if (empty($diskon2->produk_foto)) {
                                    $gambar[] = 'asset(images/SiBakul.png)';
                                    // $pic_count += 1;
                                } else {
                                    $gambar[] = 'https://sibakuljogja.jogjaprov.go.id/files/' . $diskon2->produk_foto . '';
                                    // $pic_count += 1;
                                }
                                if (empty($diskon2->foto_1)) {
                                    // $gambar = 'nonexistant';
                                } else {
                                    $gambar[] = 'https://sibakuljogja.jogjaprov.go.id/files/' . $diskon2->foto_1 . '';
                                    $pic_count += 1;
                                }
                                if (empty($diskon2->foto_2)) {
                                    // $gambar = 'nonexistant';
                                } else {
                                    $gambar[] = 'https://sibakuljogja.jogjaprov.go.id/files/' . $diskon2->foto_2 . '';
                                    $pic_count += 1;
                                }
                                if (empty($diskon2->foto_3)) {
                                    // $gambar = 'nonexistant';
                                } else {
                                    $gambar[] = 'https://sibakuljogja.jogjaprov.go.id/files/' . $diskon2->foto_3 . '';
                                    $pic_count += 1;
                                }
                            @endphp
                            <div class="carousel-indicators">
                                @if ($pic_count > 0)
                                    @for ($e = 0; $e <= $pic_count; $e++)
                                        {{-- @if ($e == 0)
                                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" 
                                        class="active" aria-current="true" aria-label="Slide 1"></button> --}}
                                        {{-- @else --}}
                                        <button type="button"
                                            data-bs-target="#carouselExampleIndicators{{ $diskon2->id }}"
                                            data-bs-slide-to="{{ $e }}"
                                            @if ($e == 0) class="active" aria-current="true" @endif
                                            aria-label="Slide{{ $e + 1 }}"></button>
                                        {{-- @endif --}}
                                    @endfor
                                @endif
                            </div>
                            <div class="carousel-inner">
                                @for ($i = 0; $i <= $pic_count; $i++)
                                    {{-- @if ($i == 0) --}}
                                    {{-- <div class="carousel-item active">
                                            <img src="{{ $gambar[0] }}" loading='lazy' alt="{{ $diskon2->nama }}0"
                                                class="d-block w-100">
                                        </div> --}}
                                    {{-- @else --}}
                                    <div class="carousel-item @if ($i == 0) active @endif">
                                        <img src="{{ $gambar[$i] }}"
                                            loading='lazy'alt="{{ $diskon2->nama }}{{ $i }}"
                                            class="d-block w-100">
                                    </div>
                                    {{-- @endif --}}
                                @endfor
                            </div>
                            @if ($pic_count > 0)
                                <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExampleIndicators{{ $diskon2->id }}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExampleIndicators{{ $diskon2->id }}"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="table-responsive" style="padding-top:1rem; text-align: center">
                        @php
                            if (!empty($diskon2->kurator_markethub) || $diskon2->lolos_kurasimarkethub == 'ya') {
                                $status = 'terjawab';
                            } else {
                                $status = '';
                            }
                            // if ($diskon2->harga >= 1000) {
                            //     $harga2 = $diskon2->harga / 1000 . '.000';
                            // }
                        @endphp
                        <table class="table table-striped" id="table2">
                            <thead>
                                <tr>
                                    <th>
                                        status
                                    </th>
                                    <th>
                                        judul
                                    </th>
                                    <th>
                                        harga
                                    </th>
                                    <th>
                                        berat
                                    </th>
                                    @if (!empty($status) && $status == 'terjawab')
                                        <th>
                                            kurator
                                        </th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        @if ($diskon2->lolos_kurasimarkethub == 'Ya')
                                            lolos
                                        @elseif($diskon2->lolos_kurasimarkethub == 'Tidak')
                                            tidak lolos
                                        @elseif($diskon2->lolos_kurasimarkethub == 'Proses')
                                            proses
                                        @endif
                                    </td>
                                    <td>
                                        {{ $diskon2->nama }}
                                    </td>
                                    <td>
                                        {{-- Rp. {{ $harga2 }} --}}
                                        Rp. {{$diskon2->harga}}
                                    </td>
                                    <td>
                                        {{ $diskon2->berat }}gr
                                    </td>
                                    @if (!empty($status) && $status == 'terjawab')
                                        <td>
                                            {{ $diskon2->kurator_markethub }}
                                        </td>
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <p class="col-12">
                        '{!! $diskon2->deskripsi_produk !!}'
                    </p>
                </div>
                <div class="row">
                    <table class="table table-striped" id="table2">
                        <thead>
                            <tr>
                                <th>
                                    Diskon
                                </th>
                                <th>
                                    Harga Akhir
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    {{$diskon2->nominal}}%
                                </td>
                                <td>
                                    @php
                                        $harga_akhir_raw = $diskon2->harga - ($diskon2->harga*($diskon2->nominal/100));
                                        // if($harga_akhir_raw >= 1000){
                                        //     $harga_akhir = $harga_akhir_raw/1000 . ".000";
                                        // }
                                    @endphp
                                    Rp. {{$harga_akhir_raw}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script></script>
