<div class="modal fade" id="agendaNewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Agenda</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pembinaan_post-admin', ['type' => 'edit', 'id' => 'new']) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="container">
                                <div class="table-responsive">
                                    <div class="col-12 mb-3">
                                        <label for="formFileSm" class="form-label">Pilih cover</label>
                                        <input class="form-control" type="file" id="formFile" name="cover">
                                    </div>

                                    <div class="input-group mb-3">
                                        @php
                                            $daring = '';
                                            $luring = '';
                                            switch (old('jenis')) {
                                                case 'daring':
                                                    $daring = 'selected';
                                                    break;
                                                case 'luring':
                                                    $luring = 'selected';
                                                    break;
                                            }
                                        @endphp
                                        <div class="row w-100">
                                            <div class="col-3">
                                                Jenis
                                            </div>
                                            <div class="col-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="jenis"
                                                        onchange="hideJenis(this.value);" id="inlineRadio1"
                                                        value="daring">
                                                    <label class="form-check-label" for="inlineRadio1">Daring</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="jenis"
                                                        onchange="hideJenis(this.value);" id="inlineRadio2"
                                                        value="luring">
                                                    <label class="form-check-label" for="inlineRadio2">Luring</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Judul</span>
                                        <input type="text" class="form-control" name="judul" placeholder="judul"
                                            aria-label="judul" value="{{ old('judul') }}"
                                            aria-describedby="basic-addon1">
                                    </div>

                                    <div class="input-group mb-3">
                                        @php
                                            $daring = '';
                                            $luring = '';
                                            switch (old('jenis_lampiran')) {
                                                case 'link':
                                                    $link = 'selected';
                                                    break;
                                                case 'file':
                                                    $lampiran = 'file';
                                                    break;
                                            }
                                        @endphp
                                        <div class="row w-100">
                                            <div class="col-3">
                                                Jenis Lampiran
                                            </div>
                                            <div class="col-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="jenis_lampiran"
                                                        onchange="hideLampiran(this.value);" id="link-form"
                                                        value="link">
                                                    <label class="form-check-label" for="link-form">Link</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="jenis_lampiran"
                                                        onchange="hideLampiran(this.value);" id="file-form"
                                                        value="file">
                                                    <label class="form-check-label" for="file-form">File</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="jenis_lampiran"
                                                        onchange="hideLampiran(this.value);" id="none-form"
                                                        value="none">
                                                    <label class="form-check-label" for="none-form">Tanpa
                                                        Lampiran</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="lampiran" class="visually-hidden">
                                        <label for="formLampiranSm" class="form-label">Pilih lampiran</label>
                                        <input class="form-control" type="file" id="FormLampiran"
                                            name="lampiran_file">
                                    </div>

                                    <div id="link" class="visually-hidden">
                                        <span class="input-group-text" id="basic-addon1">Link lampiran</span>
                                        <input class="form-control" type="text" id="link"
                                            name="lampiran_link" value="{{old('lampiran_link')}}">
                                    </div>

                                    <div id='mulai' class="visually-hidden">
                                        <span class="input-group-text" id="basic-addon1">Waktu Mulai</span>
                                        <input type="datetime-local" class="form-control" name="mulai"
                                            value="{{ old('mulai') }}" aria-label="Mulai"
                                            aria-describedby="basic-addon1">
                                    </div>

                                    <div id="selesai" class="visually-hidden">
                                        <span class="input-group-text" id="basic-addon1">Waktu Selesai</span>
                                        <input type="datetime-local" class="form-control" name="selesai"
                                            value="{{ old('selesai') }}" aria-label="Selesai"
                                            aria-describedby="basic-addon1">
                                    </div>

                                    <div id="lokasi" class="visually-hidden">
                                        <span class="input-group-text" id="basic-addon1">Lokasi</span>
                                        <input type="text" class="form-control" placeholder="Lokasi"
                                            value="{{ old('lokasi') }}" name="lokasi" aria-label="Lokasi"
                                            aria-describedby="basic-addon1">
                                    </div>

                                    <div class="input-group mb-3" style="padding-bottom:1rem">
                                        <span class="input-group-text h-auto">Detail</span>
                                        <textarea class="form-control h-100" style="white-space: pre-wrap;" name="detail" rows=4 aria-label="Desc"
                                            placeholder="{{ old('detail') }}"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="containter d-flex justify-content-center">
                        <div class="row" style="width:90%">
                            <div class="col-6">
                                <button class="btn btn-danger w-100" type="reset" class="btn-close"
                                    data-bs-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-arrow-left"></i> Cancel
                                </button>
                            </div>
                            <div class="col-6">
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

<script>
    var mulai = document.getElementById("mulai")
    var selesai = document.getElementById("selesai")
    var lokasi = document.getElementById("lokasi")
    var link = document.getElementById('link')
    var lampiran = document.getElementById('lampiran')

    function hideJenis(value) {
        if (value == 'luring') {
            mulai.className = 'input-group mb-3';
            selesai.className = 'input-group mb-3';
            lokasi.className = 'input-group mb-3';
        }
        if (value == 'daring') {
            mulai.className = 'visually-hidden';
            selesai.className = 'visually-hidden';
            lokasi.className = 'visually-hidden';
        }
    }

    function hideLampiran(value) {
        switch (value) {
            case 'file':
                lampiran.className = 'col-12 mb-3';
                link.className = 'visually-hidden';
                break;

            case 'link':
                lampiran.className = 'visually-hidden';
                link.className = 'input-group mb-3';
                break;

            case 'none':
                lampiran.className = 'visually-hidden';
                link.className = 'visually-hidden';
                break;


            default:
                break;
        }
    }
</script>
