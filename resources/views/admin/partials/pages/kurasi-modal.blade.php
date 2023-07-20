<div class="modal fade" id="kurasiModal{{ $kurasi->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Kurasi Produk id.{{ $kurasi->id }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div id="carouselExampleIndicators{{ $kurasi->id }}" class="carousel carousel-dark slide"
                            data-bs-ride="false">
                            @php
                                $pic_count = 0;
                                $gambars = [];
                                if (empty($kurasi->produk_foto)) {
                                    $gambar[] = 'asset(images/SiBakul.png)';
                                    // $pic_count += 1;
                                } else {
                                    $gambar[] = 'https://sibakuljogja.jogjaprov.go.id/files/' . $kurasi->produk_foto . '';
                                    // $pic_count += 1;
                                }
                                if (empty($kurasi->foto_1)) {
                                    // $gambar = 'nonexistant';
                                } else {
                                    $gambar[] = 'https://sibakuljogja.jogjaprov.go.id/files/' . $kurasi->foto_1 . '';
                                    $pic_count += 1;
                                }
                                if (empty($kurasi->foto_2)) {
                                    // $gambar = 'nonexistant';
                                } else {
                                    $gambar[] = 'https://sibakuljogja.jogjaprov.go.id/files/' . $kurasi->foto_2 . '';
                                    $pic_count += 1;
                                }
                                if (empty($kurasi->foto_3)) {
                                    // $gambar = 'nonexistant';
                                } else {
                                    $gambar[] = 'https://sibakuljogja.jogjaprov.go.id/files/' . $kurasi->foto_3 . '';
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
                                            data-bs-target="#carouselExampleIndicators{{ $kurasi->id }}"
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
                                            <img src="{{ $gambar[0] }}" loading='lazy' alt="{{ $kurasi->nama }}0"
                                                class="d-block w-100">
                                        </div> --}}
                                    {{-- @else --}}
                                    <div class="carousel-item @if ($i == 0) active @endif">
                                        <img src="{{ $gambar[$i] }}"
                                            loading='lazy'alt="{{ $kurasi->nama }} {{ $i }}"
                                            class="d-block w-100">
                                    </div>
                                    {{-- @endif --}}
                                @endfor
                            </div>
                            @if ($pic_count > 0)
                                <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExampleIndicators{{ $kurasi->id }}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    {{-- <span class="visually-hidden">Previous</span> --}}
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExampleIndicators{{ $kurasi->id }}"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    {{-- <span class="visually-hidden">Next</span> --}}
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="table-responsive" style="padding-top:1rem; text-align: center">
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
                                    @if ($status == 'terjawab')
                                        <th>
                                            kurator
                                        </th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        {{$kurasi->detail_status_kurasi}}
                                    </td>
                                    <td>
                                        {{ $kurasi->nama }}
                                    </td>
                                    <td>
                                        {{ $kurasi->harga }}
                                    </td>
                                    <td>
                                        {{ $kurasi->berat }}gr
                                    </td>
                                    @if ($status == 'terjawab')
                                        <td>
                                            {{ $kurasi->kurator_markethub }}
                                        </td>
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <p class="col-12">
                        {!! $kurasi->deskripsi_produk !!}
                    </p>
                </div>
            </div>
            @php
                // if ($kurasi->lolos_kurasimarkethub == '1' || $kurasi->lolos_kurasimarkethub == 'Tidak') {
                //     $disabled = 'disabled';
                // } else {
                //     $disabled = '';
                // }
                if (!empty($kurasi->id_kurasi)) {
                    if ($kurasi->waktu_kurasimarkethub > $yesterday || $status != 'terjawab') {
                        $disabled = '';
                    } else {
                        $disabled = 'disabled';
                    }
                    $idkurasi = $kurasi->id_kurasi;
                } else {
                    $idkurasi = 'new';
                    $disabled = '';
                }
                if (!empty($kurasi->berat) || $kurasi->berat != 0) {
                    $berat = 1;
                } else {
                    $berat = 0;
                }
                if (!empty($kurasi->harga || $harga != 0)) {
                    $harga = 1;
                } else {
                    $harga = 0;
                }
            @endphp
            <form action="{{ route('kurasi_post-admin') }}" method="post">
                @csrf
                <input type="hidden" name="id_barang" value="{{ $kurasi->id }}">
                <input type="hidden" name="id_kurasi" value="{{ $idkurasi }}">
                <div class="row d-flex justify-content-center" style="padding-bottom:1rem;">
                    <div class="col-12">
                        Kelengkapan
                    </div>
                    <center>
                        <div class="row" style="width:90%; margin:0">
                            <div class="col-2">
                                <span>judul</span>
                            </div>
                            <div class="col-10">
                                <select {{ $disabled }}
                                    class="form-select form-select-sm rounded-0 @error('judul_sesuai') is-invalid @enderror"
                                    name="judul_sesuai" id="judul_sesuai" required>
                                    <option value='' hidden>pilih kesesuaian judul</option>
                                    @if (!empty(old('judul_sesuai')))
                                        @php $val_judul = old('judul_sesuai'); @endphp
                                    @else
                                        @php $val_judul = $kurasi->judul_sesuai; @endphp
                                    @endif
                                    <option value="1" @if (isset($val_judul) && $val_judul == 1) selected @endif>
                                        Sesuai
                                    </option>
                                    <option value="0" @if (isset($val_judul) && $val_judul == 0) selected @endif>
                                        Tidak Sesuai
                                    </option>
                                </select>
                                @error('judul_sesuai')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row" style="width:90%; margin:0">
                            <div class="col-2">
                                <span>Foto</span>
                            </div>
                            <div class="col-10">
                                <select {{ $disabled }}
                                    class="form-select form-select-sm rounded-0 @error('foto_bagus') is-invalid @enderror"
                                    name="foto_bagus" id="foto_bagus" required>
                                    <option value="" hidden>Apakah foto barang jelas?</option>
                                    @if (!empty(old('foto_bagus')))
                                        @php $val_foto = old('foto_bagus'); @endphp
                                    @else
                                        @php $val_foto = $kurasi->foto_bagus; @endphp
                                    @endif
                                    <option value="1" @if (isset($val_foto) && $val_foto == '1') selected @endif>
                                        Jelas
                                    </option>
                                    <option value="0" @if (isset($val_foto) && $val_foto == '0') selected @endif>
                                        Tidak Jelas
                                    </option>
                                </select>
                                @error('foto_bagus')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row" style="width:90%; margin:0">
                            <div class="col-2">
                                <span>Deskripsi</span>
                            </div>
                            <div class="col-10">
                                <select {{ $disabled }}
                                    class="form-select form-select-sm rounded-0 @error('deskripsi_jelas') is-invalid @enderror"
                                    name="deskripsi_jelas" id="deskripsi_jelas" required>
                                    <option value="" hidden>Deskripsi Barang jelas?</option>

                                    @php
                                        if (!empty(old('deskirpisi_jelas'))) {
                                            $val_foto = old('deskripsi_jelas');
                                        } else {
                                            $val_foto = $kurasi->deskripsi_jelas;
                                        }
                                        
                                        $jelas = '';
                                        $tidak_jelas = '';
                                        if ($val_foto == 1) {
                                            $jelas = 'selected';
                                        } elseif ($val_foto == 0) {
                                            $tidak_jelas = 'selected';
                                        }
                                    @endphp

                                    <option value="1" {{ $jelas }}>
                                        Jelas
                                    </option>
                                    <option value="0" {{ $tidak_jelas }}>
                                        Tidak Jelas
                                    </option>
                                </select>
                                @error('deskripsi_jelas')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </center>
                    <input type="hidden" name="harga_tidak_kosong" value="{{ $harga }}">
                    <input type="hidden" name="berat_tidak_kosong" value="{{ $berat }}">
                </div>
                <div class="row d-flex justify-content-center" style="padding-bottom:1rem;">
                    <div class="col-12">
                        Catatan
                    </div>
                    <div class="col-12" style="padding-top: 0; padding-bottom: 0; width:90%">
                        <textarea {{ $disabled }} class="form-control form-control-sm rounded-0 @error('catatan') is-invalid @enderror"
                            name="catatan" id="catatan" rows="3" placeholder="Tulis Catatan Kurasi disini"> @if (!empty(old('catatan')))
{{ old('catatan') }}@else{{ $kurasi->catatan_kurasimarkethub }}
@endif
</textarea>
                        @error('catatan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer d-flex justify-content-between">
                    <button {{ $disabled }} onclick="return confirm('tolak kurasi ini?')" name='lolos'
                        class="btn btn-danger" value="2" type="submit">Tolak
                    </button>
                    <button {{ $disabled }} onclick="return confirm('Minta perbaikan untuk kurasi ini?')"
                        name='lolos' class="btn btn-warning" value="3" type="submit">minta perbaikan data
                    </button>
                    <button {{ $disabled }} onclick="return confirm('terima kurasi ini?')" name='lolos'
                        class="btn btn-success" value="1" type="submit">Terima
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script></script>
