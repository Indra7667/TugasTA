@if (isset($main_data))
    @php $model_bisnis = $main_data; @endphp
@endif
<style>
    .is-invalid {
        margin-bottom: 1.3rem !important;
    }

    .invalid-feedback {
        margin-top: -1.4rem !important;
    }
</style>
<div class="card">
    <div class="card-body">
        <form action="{{ route('post_model_bisnis') }}" method="post" enctype="multipart/form-data">
            @csrf
            @if (isset($model_bisnis))
                @php $val_id = $model_bisnis->id_model; @endphp
            @else
                @php $val_id = ''; @endphp
            @endif
            <input type="hidden" name="id" value="{{ $val_id }}">
            <h5 class="card-title">Model Bisnis</h5>
            <table class="table table-striped table-borderless table-sm" style="margin: 0;">
                <tr>
                    <td width="50%">Nilai Manfaat Produk</td>
                    <td width="50%" style="padding-top: 0; padding-bottom: 0;">
                        @if (isset($model_bisnis))
                            @php $val_nilai_manfaat = $model_bisnis->nilai_manfaat; @endphp
                        @else
                            @php $val_nilai_manfaat = ''; @endphp
                        @endif
                        <textarea class="form-control form-control-sm rounded-0 @error('nilai_manfaat') is-invalid @enderror" name="nilai_manfaat" id="nilai_manfaat"
                        rows="3" placeholder="Nilai Manfaat Produk">@if(!empty(old('nilai_manfaat'))){{old('nilai_manfaat')}}@else{{$val_nilai_manfaat}}@endif</textarea>
                        @error('nilai_manfaat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td width="50%">Bentuk Pemberdayaan Masyarakat Sekitar dalam Proses Produksi</td>
                    <td width="50%" style="padding-top: 0; padding-bottom: 0;">
                        @if (isset($model_bisnis))
                            @php $val_pemberdayaan_masyarakat = $model_bisnis->pemberdayaan_masyarakat; @endphp
                        @else
                            @php $val_pemberdayaan_masyarakat = ''; @endphp
                        @endif
                        <textarea class="form-control form-control-sm rounded-0 @error('pemberdayaan_masyarakat') is-invalid @enderror" name="pemberdayaan_masyarakat" id="pemberdayaan_masyarakat"
                        rows="3" placeholder="Bentuk Pemberdayaan Masyarakat Sekitar dalam Proses Produksi">@if(!empty(old('pemberdayaan_masyarakat'))){{old('pemberdayaan_masyarakat')}}@else{{$val_pemberdayaan_masyarakat}}@endif</textarea>
                        @error('pemberdayaan_masyarakat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td width="50%">Foto kegiatan Pemberdayaan</td>
                    <td width="50%" style="padding-top: 0; padding-bottom: 0;">
                        <input class="form-control form-control-sm rounded-0 @error('foto_kegiatan') is-invalid @enderror" type="file" name="foto_kegiatan" id="foto_kegiatan"
                            onchange="previewImage()">
                        @error('foto_kegiatan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        @if(isset($model_bisnis->foto_kegiatan) && file_exists('https://sibakuljogja.jogjaprov.go.id/files/{{ $model_bisnis->foto_kegiatan }}'))
                            <img class="img-preview img-fluid col-sm-5" src="https://sibakuljogja.jogjaprov.go.id/files/{{ $model_bisnis->foto_kegiatan }}" style="max-height: 15rem; width: fit-content;">
                            <input type="hidden" value="{{ $model_bisnis->foto_kegiatan }}" name="foto_kegiatan_lama">
                        @else
                            <img class="img-preview img-fluid col-sm-5" style="max-height: 15rem; width: fit-content;">
                        @endif
                        <script>
                            function previewImage() {
                                const foto_kegiatan = document.querySelector('#foto_kegiatan');
                                const imgPreview = document.querySelector('.img-preview');

                                imgPreview.style.display = 'block';

                                const oFReader = new FileReader();
                                oFReader.readAsDataURL(foto_kegiatan.files[0]);

                                oFReader.onload = function(oFREvent) {
                                    imgPreview.src = oFREvent.target.result;
                                }
                            }
                        </script>
                    </td>
                </tr>
                <tr>
                    <td width="50%">Mitra Utama dalam Produksi</td>
                    <td width="50%" style="padding-top: 0; padding-bottom: 0;">
                        @if (isset($model_bisnis))
                            @php $val_mitra_utama = $model_bisnis->mitra_utama; @endphp
                        @else
                            @php $val_mitra_utama = ''; @endphp
                        @endif
                        <textarea class="form-control form-control-sm rounded-0 @error('mitra_utama') is-invalid @enderror" name="mitra_utama" id="mitra_utama"
                        rows="3" placeholder="Mitra Utama dalam Produksi">@if(!empty(old('mitra_utama'))){{old('mitra_utama')}}@else{{$val_mitra_utama}}@endif</textarea>
                        @error('mitra_utama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td width="50%">Aktivitas Utama Usaha</td>
                    <td width="50%" style="padding-top: 0; padding-bottom: 0;">
                        @if (isset($model_bisnis))
                            @php $val_aktivitas_utama = $model_bisnis->aktivitas_utama; @endphp
                        @else
                            @php $val_aktivitas_utama = ''; @endphp
                        @endif
                        <textarea class="form-control form-control-sm rounded-0 @error('aktivitas_utama') is-invalid @enderror" name="aktivitas_utama" id="aktivitas_utama"
                        rows="3" placeholder="Aktivitas Utama Usaha">@if(!empty(old('aktivitas_utama'))){{old('aktivitas_utama')}}@else{{$val_aktivitas_utama}}@endif</textarea>
                        @error('aktivitas_utama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td width="50%">Sumber Bahan Baku Utama</td>
                    <td width="50%" style="padding-top: 0; padding-bottom: 0;">
                        @if (isset($model_bisnis))
                            @php $val_sumber_bahan_baku = $model_bisnis->sumber_bahan_baku; @endphp
                        @else
                            @php $val_sumber_bahan_baku = ''; @endphp
                        @endif
                        <textarea class="form-control form-control-sm rounded-0 @error('sumber_bahan_baku') is-invalid @enderror" name="sumber_bahan_baku" id="sumber_bahan_baku"
                        rows="3" placeholder="Sumber Bahan Baku Utama">@if(!empty(old('sumber_bahan_baku'))){{old('sumber_bahan_baku')}}@else{{$val_sumber_bahan_baku}}@endif</textarea>
                        @error('sumber_bahan_baku')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td width="50%">Target Pasar/Segmentasi Konsumen</td>
                    <td width="50%" style="padding-top: 0; padding-bottom: 0;">
                        @if (isset($model_bisnis))
                            @php $val_target_pasar = $model_bisnis->target_pasar; @endphp
                        @else
                            @php $val_target_pasar = ''; @endphp
                        @endif
                        <textarea class="form-control form-control-sm rounded-0 @error('target_pasar') is-invalid @enderror" name="target_pasar" id="target_pasar"
                        rows="3" placeholder="Target Pasar/Segmentasi Konsumen">@if(!empty(old('target_pasar'))){{old('target_pasar')}}@else{{$val_target_pasar}}@endif</textarea>
                        @error('target_pasar')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td width="50%">Pola Hubungan dengan Konsumen</td>
                    <td width="50%" style="padding-top: 0; padding-bottom: 0;">
                        @if (isset($model_bisnis))
                            @php $val_hubungan_konsumen = $model_bisnis->hubungan_konsumen; @endphp
                        @else
                            @php $val_hubungan_konsumen = ''; @endphp
                        @endif
                        <textarea class="form-control form-control-sm rounded-0 @error('hubungan_konsumen') is-invalid @enderror" name="hubungan_konsumen" id="hubungan_konsumen"
                        rows="3" placeholder="Pola Hubungan dengan Konsumen">@if(!empty(old('hubungan_konsumen'))){{old('hubungan_konsumen')}}@else{{$val_hubungan_konsumen}}@endif</textarea>
                        @error('hubungan_konsumen')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td width="50%">Jaringan Distribusi</td>
                    <td width="50%" style="padding-top: 0; padding-bottom: 0;">
                        @if (isset($model_bisnis))
                            @php $val_jaringan_distribusi = $model_bisnis->jaringan_distribusi; @endphp
                        @else
                            @php $val_jaringan_distribusi = ''; @endphp
                        @endif
                        <textarea class="form-control form-control-sm rounded-0 @error('jaringan_distribusi') is-invalid @enderror" name="jaringan_distribusi" id="jaringan_distribusi"
                        rows="3" placeholder="Jaringan Distribusi">@if(!empty(old('jaringan_distribusi'))){{old('jaringan_distribusi')}}@else{{$val_jaringan_distribusi}}@endif</textarea>
                        @error('jaringan_distribusi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td width="50%">Lampiran Business plan (pdf)</td>
                    <td width="50%" style="padding-top: 0; padding-bottom: 0;">
                        @if (isset($model_bisnis))
                            @php $val_lampiran_business_plan = $model_bisnis->lampiran_business_plan; @endphp
                        @else
                            @php $val_lampiran_business_plan = ''; @endphp
                        @endif
                        <input type="hidden" name="lampiran_lama" value="{{ $val_lampiran_business_plan }}">
                        <input class="form-control form-control-sm rounded-0 @error('lampiran_business_plan') is-invalid @enderror" type="file" name="lampiran_business_plan" id="lampiran_business_plan">
                        @if (!empty($val_lampiran_business_plan))
                            <a href="https://sibakuljogja.jogjaprov.go.id/files/{{ $val_lampiran_business_plan }}" target="_blank">Lihat Berkas Lama</a>
                        @endif
                        @error('lampiran_business_plan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                </tr>
            </table>
            <div style="padding-top: 0.5rem">
                <a href="{{ route('lengkapi_data').'#page_bodel_bisnis' }}" class="btn btn-danger btn-sm" type="button">Batal</a>
                <button class="btn btn-success btn-sm" onclick="return confirm('simpan data ini?')" type="submit">Simpan</button>
            </div>
        </form>
    </div>
</div>