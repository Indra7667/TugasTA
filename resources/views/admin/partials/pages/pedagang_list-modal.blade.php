<div class="modal fade" id="pedagangModal{{ $list2->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Pedagang - {{ $list2->nama_usaha }}
                    ({{ $list2->idsibakul }})</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        @php
                            $url_logo = 'https://sibakuljogja.jogjaprov.go.id/green.png';
                            if (!empty($list2->logo)) {
                                # code...
                                $url_logo = 'https://sibakuljogja.jogjaprov.go.id/files/' . $list2->logo . '';
                            }
                        @endphp
                        <div class="card"
                            style="background:  url({!! $url_logo !!});
                            background-size:cover; background-position: center;width:100% ;height:25rem">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <nav class="w-100 d-flex justify-content-center">
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
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-diri" role="tabpanel"
                            aria-labelledby="nav-diri-tab" tabindex="0">
                            <div class="table-responsive" style="padding-top:1rem">
                                @include('admin.partials.pages.parts.pedagang-modal_datadiri')
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-usaha" role="tabpanel" aria-labelledby="nav-usaha-tab"
                            tabindex="0">
                            <div class="table-responsive" style="padding-top:1rem">
                                @include('admin.partials.pages.parts.pedagang-modal_datausaha')
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-profil" role="tabpanel" aria-labelledby="nav-profil-tab"
                            tabindex="0">
                            <div class="table-responsive" style="padding-top:1rem">
                                @include('admin.partials.pages.parts.pedagang-modal_profilusaha')
                            </div>
                        </div>
                    </div>
                </div>
                <form action="{{route('pedagang_post-admin')}}" method="post">
                    {{-- adminPostController -> pedagang_post() --}}
                    @csrf
                    <div class="row">
                        <input type="hidden" name="id" value="{{$list2->id}}">
                        <div class="col-12" style="padding-bottom:2rem">
                            <textarea {{$disabled}} class="form-control form-control-sm rounded-0 @error('catatan') is-invalid @enderror" name="catatan"
                                id="catatan" rows="3" placeholder="Tulis Catatan Verifikasi disini"> 
                                @if (!empty(old('catatan')))
{{ old('catatan') }}@else{{ $list2->catatan_verifikasi }}
@endif
                            </textarea>
                            @error('catatan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <button {{ $disabled }} onclick="return confirm('tolak akun ini?')" 
                            class="btn btn-danger w-100" name="verify" value="ditolak" type="submit">Tolak</button>
                        </div>

                        <div class="col-6">
                            <button {{ $disabled }} onclick="return confirm('verifikasi akun ini?')" 
                            class="btn btn-success w-100" name="verify" value="diterima" type="submit">Terima</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script></script>
