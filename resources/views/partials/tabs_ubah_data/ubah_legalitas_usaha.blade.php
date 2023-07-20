@if (isset($main_data))
    @php $legalitas_usaha = $main_data; @endphp
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
        <form action="{{ route('post_legalitas_usaha') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $id }}">
            <h5 class="card-title">Legalitas Usaha</h5>
            <table class="table table-striped table-borderless table-sm" style="margin: 0;">
                <tr>
                    <td>Legalitas</td>
                    <td style="padding-top: 0; padding-bottom: 0;">
                        <select name="jenis_legalitas" class="form-select form-select-sm rounded-0 @error('jenis_legalitas') is-invalid @enderror" required>
                            <option value="" hidden>Pilih Jenis Legalitas</option>
                            @foreach($jenis_legalitas as $jenislegalitas)
                                @if (!empty(old('jenis_legalitas')))
                                    @php $val_idjenis = old('jenis_legalitas'); @endphp
                                @else
                                    @if (isset($legalitas_usaha))
                                        @php $val_idjenis = $legalitas_usaha->idjenis; @endphp
                                    @else
                                        @php $val_idjenis = ''; @endphp
                                    @endif
                                @endif
                                <option value="{{ $jenislegalitas->id }}" {{{ (isset($val_idjenis) && $val_idjenis == $jenislegalitas->id) ? "selected=\"selected\"" : "" }}}>{{ $jenislegalitas->jenis }}</option>';
                            @endforeach 
                        </select>
                        @error('jenis_legalitas')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td>Nomor</td>
                    <td style="padding-top: 0; padding-bottom: 0;">
                        @if (isset($legalitas_usaha))
                            @php $val_nomor = $legalitas_usaha->nomor; @endphp
                        @else
                            @php $val_nomor = ''; @endphp
                        @endif
                        <input type="number" class="form-control form-control-sm rounded-0 @error('nomor') is-invalid @enderror"
                        name="nomor" id="nomor" value="@if(!empty(old('nomor'))){{old('nomor')}}@else{{$val_nomor}}@endif" placeholder="Nomor">
                        @error('nomor')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td>Berkas</td>
                    <td style="padding-top: 0; padding-bottom: 0;">
                        <input class="form-control form-control-sm rounded-0 @error('berkas') is-invalid @enderror" type="file" name="berkas" id="berkas"
                            onchange="previewImage()">
                        @error('berkas')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        @if(isset($legalitas_usaha->berkas))
                            <img class="img-preview img-fluid col-sm-5" src="https://sibakuljogja.jogjaprov.go.id/files/{{ $legalitas_usaha->berkas }}" style="max-height: 10rem; width: fit-content;">
                            <input type="hidden" value="{{ $legalitas_usaha->berkas }}" name="berkas_lama">
                        @else
                            <img class="img-preview img-fluid col-sm-5" style="max-height: 10rem; width: fit-content;">
                        @endif
                        <script>
                            function previewImage() {
                                const berkas = document.querySelector('#berkas');
                                const imgPreview = document.querySelector('.img-preview');

                                imgPreview.style.display = 'block';

                                const oFReader = new FileReader();
                                oFReader.readAsDataURL(berkas.files[0]);

                                oFReader.onload = function(oFREvent) {
                                    imgPreview.src = oFREvent.target.result;
                                }
                            }
                        </script>
                    </td>
            </table>
            <div style="padding-top: 0.5rem">
                <a href="{{ route('lengkapi_data').'#page_legalitas_usaha' }}" class="btn btn-danger btn-sm" type="button">Batal</a>
                @php
                    if (!empty($legalitas_usaha)) {
                        $action = 'ubah';
                    } else {
                        $action = 'tambah';
                    }
                @endphp
                
                <button class="btn btn-success btn-sm" onclick="return confirm('simpan data ini?')" type="submit">{{$action}}</button>
            </div>
        </form>
    </div>
</div>