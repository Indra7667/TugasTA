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
        <form action="{{ route('post_data_diri') }}" method="post">
            @csrf
            <h5 class="card-title">Data Diri</h5>
            <table class="table table-striped table-borderless table-sm" style="margin: 0;">
                <tr>
                    <td style="font-weight: 600;">ID Sibakul</td>
                    <td style="font-weight: 600;">{{ $data_usaha->idsibakul }}</td>
                </tr>
                <tr>
                    <td>NIK Mitra</td>
                    <td style="padding-top: 0; padding-bottom: 0;">
                        <input type="number" class="form-control form-control-sm rounded-0 @error('nik') is-invalid @enderror"
                        name="nik" id="nik" value="@if(!empty(old('nik'))){{old('nik')}}@else{{$data_usaha->nik}}@endif" placeholder="NIK">
                        @error('nik')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td style="padding-top: 0; padding-bottom: 0;">
                        <div class="row">
                            @if (!empty(old('gender')))
                                @php $val_gender = old('gender'); @endphp
                            @else
                                @php $val_gender = $data_usaha->gender; @endphp
                            @endif
                            <div class="col-auto">
                                <div class="form-check">
                                    <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" id="Laki-Laki" value="Laki-Laki" {{{ (isset($val_gender) && $val_gender == 'Laki-Laki') ? "checked" : "" }}}>
                                    <label class="form-check-label" for="Laki-Laki">
                                    Laki-Laki
                                    </label>
                                    @error('gender')
                                        <div class="invalid-feedback" style="margin-top: -1.1rem !important;  margin-left: -1.3rem !important;">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="form-check">
                                    <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" id="Perempuan" value="Perempuan" {{{ (isset($val_gender) && $val_gender == 'Perempuan') ? "checked" : "" }}}>
                                    <label class="form-check-label" for="Perempuan">
                                    Perempuan
                                    </label>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>TTL</td>
                    <td style="padding-top: 0; padding-bottom: 0;">
                        <div class="row w-100" style="margin: 0;">
                            <div class="col-lg-6 col-md-6 col-sm-12" style="padding: 0;">
                                <input type="text" class="form-control form-control-sm rounded-0 @error('tpt_lahir') is-invalid @enderror" name="tpt_lahir" id="tpt_lahir"
                                value="@if(!empty(old('tpt_lahir'))){{old('tpt_lahir')}}@else{{$data_usaha->tpt_lahir}}@endif" placeholder="Tempat Lahir">
                                @error('tpt_lahir')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12" style="padding: 0;">
                                <input type="date" class="form-control form-control-sm rounded-0 @error('tgl_lahir') is-invalid @enderror" name="tgl_lahir" id="tgl_lahir"
                                value="@if(!empty(old('tgl_lahir'))){{old('tgl_lahir')}}@else{{$data_usaha->tgl_lahir}}@endif" placeholder="Tanggal Lahir">
                                @error('tgl_lahir')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Alamat KTP</td>
                    <td style="padding-top: 0; padding-bottom: 0;">
                        <textarea class="form-control form-control-sm rounded-0 @error('alamat_ktp') is-invalid @enderror" name="alamat_ktp" id="alamat_ktp" rows="3"
                        placeholder="Alamat KTP">@if(!empty(old('alamat_ktp'))){{old('alamat_ktp')}}@else{{$data_usaha->alamat_ktp}}@endif</textarea>
                        @error('alamat_ktp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td>Domisili</td>
                    <td style="padding-top: 0; padding-bottom: 0;">
                        <textarea class="form-control form-control-sm rounded-0 @error('alamat_domisili') is-invalid @enderror" name="alamat_domisili" id="alamat_domisili" rows="3"
                        placeholder="Domisili">@if(!empty(old('alamat_domisili'))){{old('alamat_domisili')}}@else{{$data_usaha->alamat_domisili}}@endif</textarea>
                        @error('alamat_domisili')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td>No WA</td>
                    <td style="padding-top: 0; padding-bottom: 0;">
                        <input type="tel" name="no_hp" id="no_hp" class="form-control form-control-sm rounded-0 @error('no_hp') is-ivalid @enderror"
                        value="@if(!empty(old('no_hp'))){{old('no_hp')}}@else{{$data_usaha->no_hp}}@endif" pattern="/[0-9]{}/" maxlength="14" minlength="9"
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="Nomor WA" required>
                        @error('no_hp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td style="padding-top: 0; padding-bottom: 0;">
                        <input type="email" class="form-control form-control-sm rounded-0 @error('email') is-ivalid @enderror" name="email" id="email"
                        value="@if(!empty(old('email'))){{old('email')}}@else{{$data_usaha->email}}@endif" placeholder="Email">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td>Pendidikan</td>
                    <td style="padding-top: 0; padding-bottom: 0;">
                        <select class="form-select form-select-sm rounded-0 @error('pendidikan') is-ivalid @enderror" id="pendidikan" name="pendidikan" required>
                            @if (!empty(old('pendidikan')))
                                @php $val_pendidikan = old('pendidikan'); @endphp
                            @else
                                @php $val_pendidikan = $data_usaha->pendidikan; @endphp
                            @endif
                            <option value="" hidden>Pilih Pendidikan</option>
                            <option value="SD" {{{ (isset($val_pendidikan) && $val_pendidikan == "SD") ? "selected=\"selected\"" : "" }}}>SD</option>
                            <option value="SMP" {{{ (isset($val_pendidikan) && $val_pendidikan == "SMP") ? "selected=\"selected\"" : "" }}}>SMP</option>
                            <option value="SMA" {{{ (isset($val_pendidikan) && $val_pendidikan == "SMA") ? "selected=\"selected\"" : "" }}}>SMA</option>
                            <option value="Diploma" {{{ (isset($val_pendidikan) && $val_pendidikan == "Diploma") ? "selected=\"selected\"" : "" }}}>Diploma</option>
                            <option value="S1" {{{ (isset($val_pendidikan) && $val_pendidikan == "S1") ? "selected=\"selected\"" : "" }}}>S1</option>
                            <option value="S2" {{{ (isset($val_pendidikan) && $val_pendidikan == "S2") ? "selected=\"selected\"" : "" }}}>S2</option>
                            <option value="S3" {{{ (isset($val_pendidikan) && $val_pendidikan == "S3") ? "selected=\"selected\"" : "" }}}>S3</option>
                            <option value="Tidak Ada" {{{ (isset($val_pendidikan) && $val_pendidikan == "Tidak Ada") ? "selected=\"selected\"" : "" }}}>Tidak Ada</option>
                        </select>
                        @error('pendidikan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td>Disabilitas</td>
                    <td style="padding-top: 0; padding-bottom: 0;">
                        <select class="form-select form-select-sm rounded-0 @error('disabilitas') is-ivalid @enderror" id="disabilitas" name="disabilitas">
                            @if (!empty(old('disabilitas')))
                                @php $val_disabilitas = old('disabilitas'); @endphp
                            @else
                                @php $val_disabilitas = $data_usaha->disabilitas; @endphp
                            @endif
                            <option selected>Tidak Ada</option>
                            <option value="Tuna Daksa" {{{ (isset($val_disabilitas) && $val_disabilitas == "Tuna Daksa") ? "selected=\"selected\"" : "" }}}>Tuna Daksa</option>
                        </select>
                        @error('disabilitas')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                </tr>
            </table>
            {{-- @if ($errors->any())
            <div class="form-outline mt-4">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif --}}
            <div style="padding-top: 0.5rem">
                <a href="{{ route('lengkapi_data') }}" class="btn btn-danger btn-sm" type="button">Batal</a>
                <button onclick="return confirm('apakah anda yakin ingin menyimpan data ini?')" class="btn btn-success btn-sm" type="submit">Ubah</button>
            </div>
        </form>
    </div>
</div>
<br>