@php $data_usaha = $main_data; @endphp
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
        <form action="{{ route('post_data_usaha') }}" method="post" enctype="multipart/form-data">
            @csrf
            <h5 class="card-title">Data Usaha</h5>
            <table class="table table-striped table-borderless table-sm" style="margin: 0;">
                <tr>
                    <td>Nama Usaha</td>
                    <td style="padding-top: 0; padding-bottom: 0;">
                        <input type="text" class="form-control form-control-sm rounded-0 @error('nama_usaha') is-invalid @enderror"
                        name="nama_usaha" id="nama_usaha" value="@if(!empty(old('nama_usaha'))){{old('nama_usaha')}}@else{{$data_usaha->nama_usaha}}@endif" placeholder="Nama Usaha">
                        @error('nama_usaha')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td>Logo</td>
                    <td style="padding-top: 0; padding-bottom: 0;">
                        <input type="hidden" value="{{ $data_usaha->logo }}" name="logo_lama">
                        <input class="form-control form-control-sm rounded-0 @error('logo') is-invalid @enderror" type="file" name="logo" id="logo"
                            onchange="previewImage()">
                        @error('logo')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        @if($data_usaha->logo)
                            <img class="img-preview img-fluid col-sm-5" src="https://sibakuljogja.jogjaprov.go.id/files/{{ $data_usaha->logo }}" style="max-height: 7.5rem; width: fit-content;">
                        @else
                            <img class="img-preview img-fluid col-sm-5" style="max-height: 7.5rem; width: fit-content;">
                        @endif
                        <script>
                            function previewImage() {
                                const logo = document.querySelector('#logo');
                                const imgPreview = document.querySelector('.img-preview');

                                imgPreview.style.display = 'block';

                                const oFReader = new FileReader();
                                oFReader.readAsDataURL(logo.files[0]);

                                oFReader.onload = function(oFREvent) {
                                    imgPreview.src = oFREvent.target.result;
                                }
                            }
                        </script>
                    </td>
                    <tr>
                        <td>Merk Dagang</td>
                        <td style="padding-top: 0; padding-bottom: 0;">
                            <input type="text" class="form-control form-control-sm rounded-0 @error('merk_dagang') is-invalid @enderror"
                            name="merk_dagang" id="merk_dagang" value="@if(!empty(old('merk_dagang'))){{old('merk_dagang')}}@else{{$data_usaha->merkdagang}}@endif" placeholder="Merk Dagang">
                            @error('merk_dagang')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td>Mulai Usaha</td>
                        <td style="padding-top: 0; padding-bottom: 0;">
                            <input type="date" class="form-control form-control-sm rounded-0 @error('mulai_usaha') is-invalid @enderror"
                            name="mulai_usaha" id="mulai_usaha" value="@if(!empty(old('mulai_usaha'))){{old('mulai_usaha')}}@else{{$data_usaha->mulai_usaha}}@endif" placeholder="Mulai Usaha">
                            @error('mulai_usaha')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td>Alamat Usaha</td>
                        <td style="padding-top: 0; padding-bottom: 0;">
                            <div class="row" style="padding-right: calc(var(--bs-gutter-x) * .5); padding-left: calc(var(--bs-gutter-x) * .5);">
                                <div class="col-lg-4 col-md-4 col-sm-12" style="padding: 0;">
                                    <select class="form-select form-select-sm rounded-0 @error('kota') is-invalid @enderror" name="kota" id="kota" required>
                                        <option hidden>Pilih Kabupaten/Kota</option>
                                        @foreach ($kota as $kot)
                                            @if (!empty(old('kota')))
                                                @php $val_kota = old('kota'); @endphp
                                            @else
                                                @php $val_kota = $data_usaha->id_kota; @endphp
                                            @endif
                                            <option value="{{ $kot->id }}" {{{ (isset($val_kota) && $val_kota == $kot->id) ? "selected=\"selected\"" : "" }}}>{{ $kot->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('kota')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12" style="padding: 0;">
                                    <select class="form-select form-select-sm rounded-0 @error('kecamatan') is-invalid @enderror" name="kecamatan" id="kecamatan" required>
                                        <option value='{{ $data_usaha->id_kecamatan }}' hidden>Pilih Kecamatan</option>
                                    </select>
                                    @error('kecamatan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12" style="padding: 0;">
                                    <select class="form-select form-select-sm rounded-0 @error('kelurahan') is-invalid @enderror" name="kelurahan" id="kelurahan" required>
                                        <option value='{{ $data_usaha->id_kelurahan }}' hidden>Pilih Kelurahan</option>
                                    </select>
                                    @error('kelurahan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12" style="padding: 0;">
                                    <textarea class="form-control form-select-sm rounded-0 @error('alamat_usaha') is-invalid @enderror" name="alamat_usaha"
                                    id="alamat_usaha" rows="2" required>@if(!empty(old('alamat_usaha'))){{old('alamat_usaha')}}@else{{$data_usaha->alamat_usaha}}@endif</textarea>
                                    @error('alamat_usaha')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Sektor Usaha</td>
                        <td style="padding-top: 0; padding-bottom: 0;">
                            {{-- <select class="form-select form-select-sm rounded-0 @error('sektor_usaha') is-invalid @enderror" name="sektor_usaha" id="sektor_usaha" required>
                                <option hidden>Pilih Sektor Usaha</option>
                                @foreach ($sektor_usaha as $sektor)
                                    @if (!empty(old('sektor_usaha')))
                                        @php $val_sektor = old('sektor_usaha'); @endphp
                                    @else
                                        @php $val_sektor = $data_usaha->id_sektor; @endphp
                                    @endif
                                    <option value="{{ $sektor->id }}" {{{ (isset($val_sektor) && $val_sektor == $sektor->id) ? "selected=\"selected\"" : "" }}}>{{ $sektor->nama }}</option>
                                @endforeach
                            </select> --}}
                            <input type="number" class="form-control form-control-sm rounded-0 @error('sektor_usaha') is-invalid @enderror"
                            name="sektor_usaha" id="sektor_usaha" value="@if(!empty(old('sektor_usaha'))){{old('sektor_usaha')}}@else{{$data_usaha->id_sektor}}@endif" placeholder="Sektor Usaha">
                            @error('sektor_usaha')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td>Jenis Ekraf</td>
                        <td style="padding-top: 0; padding-bottom: 0;">
                            <select class="form-select form-select-sm rounded-0 @error('jenis_ekraf') is-invalid @enderror" name="jenis_ekraf" id="jenis_ekraf" required>
                                <option hidden>Pilih Jenis Ekraf</option>
                                @if (!empty(old('jenis_ekraf')))
                                    @php $val_ekraf = old('jenis_ekraf'); @endphp
                                @else
                                    @php $val_ekraf = $data_usaha->id_ekraf; @endphp
                                @endif
                                <option value="Kuliner" {{{ (isset($val_ekraf) && $val_ekraf == "Kuliner") ? "selected=\"selected\"" : "" }}}>Kuliner</option>
                                <option value="Fashion" {{{ (isset($val_ekraf) && $val_ekraf == "Fashion") ? "selected=\"selected\"" : "" }}}>Fashion</option>
                                <option value="Kerajinan" {{{ (isset($val_ekraf) && $val_ekraf == "Kerajinan") ? "selected=\"selected\"" : "" }}}>Kerajinan</option>
                            </select>
                            @error('jenis_ekraf')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td>Kegiatan Usaha</td>
                        <td style="padding-top: 0; padding-bottom: 0;">
                            <input type="text" class="form-control form-control-sm rounded-0 @error('kegiatan_usaha') is-invalid @enderror"
                            name="kegiatan_usaha" id="kegiatan_usaha" value="@if(!empty(old('kegiatan_usaha'))){{old('kegiatan_usaha')}}@else{{$data_usaha->kegiatan_usaha}}@endif" placeholder="Kegiatan Usaha">
                            @error('kegiatan_usaha')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td>Produk Usaha</td>
                        <td style="padding-top: 0; padding-bottom: 0;">
                            <input type="text" class="form-control form-control-sm rounded-0 @error('produk_usaha') is-invalid @enderror"
                            name="produk_usaha" id="produk_usaha" value="@if(!empty(old('produk_usaha'))){{old('produk_usaha')}}@else{{$data_usaha->produk_usaha}}@endif" placeholder="Produk Usaha">
                            @error('produk_usaha')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </td>
                    </tr>
            </table>
            <hr>
            <p>Profil Usaha</p>
            <style>
                .tox-tinymce {
                    border-radius: 0!important;
                }
            </style>
            <div>
                <textarea class="form-control form-control-sm rounded-0" id="tiny" name="profil_usaha" placeholder="Profil Usaha">
                    @if(!empty(old('profil_usaha'))){{old('profil_usaha')}}@else{{$data_usaha->profil_usaha}}@endif
                </textarea>
            </div>
            <script>
                tinymce.init({
                    selector: 'textarea#tiny',
                    height: 300,
                    plugins: [
                        'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                        'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                        'insertdatetime', 'media', 'table', 'help', 'wordcount'
                    ],
                    toolbar: 'undo redo | blocks | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                });

                // Prevent Bootstrap dialog from blocking focusin
                document.addEventListener('focusin', (e) => {
                if (e.target.closest(".tox-tinymce, .tox-tinymce-aux, .moxman-window, .tam-assetmanager-root") !== null) {
                    e.stopImmediatePropagation();
                }
                });
            </script>
            @error('profil_usaha')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <br>
            <div style="padding-top: 0.5rem">
                <a href="{{ route('lengkapi_data').'#page_data_usaha' }}" class="btn btn-danger btn-sm" type="button">Batal</a>
                <button class="btn btn-success btn-sm" type="submit">Ubah</button>
            </div>
        </form>
    </div>
</div>
<br>
<script>
    $(function() {
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });

        $(function() {
            $('#kota').on('change', function() {
                let kotID = $('#kota').val();

                $.ajax({
                    type: 'POST',
                    dataType: "html",
                    url: "/ukm/ubah-data/getkecamatan",
                    data: {kotID: kotID},
                    cache: false,

                    success: function(msg) {
                        $('#kecamatan').html(msg);
                        $("#kelurahan").html("<select class='form-control form-select active @error('kelurahan') is-invalid @enderror' name='kelurahan' id='kelurahan' required><option value='' hidden>Pilih Kelurahan</option></select>");
                    },

                    error: function(data) {
                        console.log('error: ', data)
                    },

                })
            })
        })

        $(function() {
            $('#kecamatan').on('change', function() {
                let kecID = $('#kecamatan').val();

                $.ajax({
                    type: 'POST',
                    dataType: "html",
                    url: "/ukm/ubah-data/getkelurahan",
                    data: {kecID: kecID},
                    cache: false,

                    success: function(msg) {
                        $('#kelurahan').html(msg);
                    },

                    error: function(data) {
                        console.log('error: ', data)
                    },

                })
            })
        })

        $(function() {
            var kotID = $('#kota').val();
            if (null != kotID) {$(function() {
            let kotID = $('#kota').val();
    
                $.ajax({
                    type : 'POST',
                    dataType: "html",
                    url : "/ukm/ubah-data/getkecamatan",
                    data : {kotID:kotID},
                    cache : false,
        
                    success: function(msg) {
                        $('#kecamatan').html(msg);
                        $("#kelurahan").html("<select class='form-control form-select active @error('kelurahan') is-invalid @enderror' name='kelurahan' id='kelurahan' required><option value='' hidden>Pilih Kelurahan</option></select>");
                    },

                    error: function(data) {
                        console.log('error: ', data)
                    },
        
                })
            })}

            $(function kecamatan() {
                var kecID = $('#kecamatan').val();
                if (null != kecID) {$(function() {
                    let kecID = $('#kecamatan').val();
        
                    $.ajax({
                        type : 'POST',
                        dataType: "html",
                        url : "/ukm/ubah-data/getkelurahan",
                        data : {kecID:kecID},
                        cache : false,
            
                        success: function(msg) {
                        $('#kelurahan').html(msg);
                        },
            
                        error: function(data){
                        console.log('error: ', data)
                        },
            
                    })
                })}
            })
        })
    });

    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>