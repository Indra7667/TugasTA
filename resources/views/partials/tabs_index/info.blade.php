<div style="padding-top:1rem;  min-height:68.5vh">
    <div class="card">
        <div class="card-header" style="padding:1rem">
            Agenda Kegiatan
        </div>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link @if ($status_agenda == 'aktif' || empty($status_agenda)) active @endif" aria-current="page"
                    href="?status_agenda=aktif">Aktif</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if ($status_agenda == 'lampau') active @endif"
                    href="?status_agenda=lampau">Lampau</a>
            </li>
        </ul>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                <div class="card-body">
                    @if ($agenda_c == 0)
                        Belum ada Informasi
                    @else
                        <div class="row d-flex justify-content-center">
                            @foreach ($agenda as $agenda1)
                            @php
                                $icon = 'fa-circle-notch text-success';
                                if (in_array($agenda1->id_agenda, $agenda_joined)&& $status_agenda == 'aktif') {
                                    $icon = 'fa-circle-play text-warning';
                                } elseif (in_array($agenda1->id_agenda, $agenda_joined)&& $status_agenda == 'lampau') {
                                    $icon = 'fa-clock text-secondary';
                                }
                                // dd($agenda1, $agenda_joined)
                            @endphp
                                <div class="col-4 d-flex justify-content-center" style="padding-bottom:1rem">
                                    <div class="card" style="width: 90%;">
                                        <div class="card-header h-100 d-flex justify-content-center align-items-center" style="padding: 0">
                                            <div style="position:absolute; top:1rem; right:1rem">
                                                <a href="javascript:void(0)" class="btn btn-light">
                                                    <i class="fa {{$icon}}"></i>
                                                </a>
                                            </div>
                                            <img src="{{ asset('images/agenda/' . $agenda1->gambar . '') }}" class="card-img-top"
                                                alt="{{ $agenda1->nama_agenda }}">
                                        </div>
                                        <div class="card-body">
                                            <center>
                                                <div class="row">
                                                    <h5 class="card-title">{{ $agenda1->nama_agenda }}</h5>
                                                </div>
                                                <div class="row">
                                                    <p class="card-text">{!! $agenda1->deskripsi !!}</p>
                                                </div>
                                                <div class="row" style="padding:1rem 1rem 0rem 1rem">
                                                    <button class="btn btn-success" {{$disabled}} data-bs-toggle="modal"
                                                        data-bs-target="#agendaDetail{{ $agenda1->id_agenda }}">
                                                        <i class="fa fa-circle-info text-light"></i> detail
                                                    </button>
                                                </div>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                                @include('partials.tabs_index.modals.agenda-detail')
                            @endforeach
                        </div>
                    @endif
                </div>
        
            </div>
        </div>
    </div>
</div>
