<div class="modal fade" id="agendaNewModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Agenda</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('agenda_post-admin', ['type' => 'edit', 'id' => 'new']) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="container">
                                        <div class="table-responsive">
                                            <div class="col-12 mb-3">
                                                <label for="formFileSm" class="form-label">Pilih gambar</label>
                                                <input class="form-control" type="file" id="formFile"
                                                    name="gambar">
                                            </div>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">Nama Acara</span>
                                                <input type="text" class="form-control" name="nama"
                                                    placeholder="Nama Acara" aria-label="Nama" value="{{old('nama')}}"
                                                    aria-describedby="basic-addon1">
                                            </div>

                                            <div class="input-group mb-3" style="padding-bottom:1rem">
                                                <span class="input-group-text h-auto">Deskripsi</span>
                                                <textarea class="form-control h-100" name="deskripsi" rows=4 aria-label="Desc"
                                                placeholder="{{old('deskripsi')}}"></textarea>
                                            </div>

                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">Waktu Mulai</span>
                                                <input type="datetime-local" class="form-control" name="mulai" value="{{old('mulai')}}"
                                                    aria-label="Mulai" aria-describedby="basic-addon1">
                                            </div>

                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">Waktu Selesai</span>
                                                <input type="datetime-local" class="form-control" name="selesai" value="{{old('selesai')}}"
                                                    aria-label="Selesai" aria-describedby="basic-addon1">
                                            </div>

                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">Lokasi</span>
                                                <input type="text" class="form-control" placeholder="Lokasi" value="{{old('lokasi')}}"
                                                    name="lokasi" aria-label="Lokasi"
                                                    aria-describedby="basic-addon1">
                                            </div>

                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">Nama CP</span>
                                                <input type="text" class="form-control" placeholder="CP" value="{{old('cp')}}"
                                                    name="cp" aria-label="CP" aria-describedby="basic-addon1">
                                            </div>

                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">Kontak</span>
                                                <input type="text" class="form-control" placeholder="Kontak" value="{{old('kontak')}}"
                                                    name="kontak" aria-label="Kontak"
                                                    aria-describedby="basic-addon1">
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