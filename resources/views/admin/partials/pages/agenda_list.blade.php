{{-- <link href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css" rel="stylesheet"> --}}
<form action="" method="get" style="padding-top:1rem">
    {{-- @csrf --}}
    <div class="row">
        {{-- <input type="hidden" name="page" value="{{$page}}"> --}}
        <div class="col-3">
            <div class="input-group">
                <label class="input-group-text" for="Status">Status</label>
                <select name='status' class="form-select" id='Status' aria-label="Default select example">
                    <option {{ $empty }} value="empty">Semua</option>
                    <option {{ $future }} value="future">yang akan datang</option>
                    <option {{ $active }} value="active">sedang berlangsung</option>
                    <option {{ $history }} value="history">riwayat</option>
                </select>
            </div>
        </div>

        <div class="col-3">
            <div class="input-group">
                <span class="input-group-text">keyword</span>
                <input type="text" aria-label="search" name="search" value="{{ $search }}"
                    class="form-control">
            </div>
        </div>
        <div class="col-3">
            <div class="input-group">
                <span class="input-group-text">Per laman</span>
                <input type="number" aria-label="show" min="1" max="32" name="show"
                    value="{{ $show }}" class="form-control">
            </div>
        </div>
        <div class="col-3">
            <button class="btn btn-success w-100" type="submit">Filter</button>
        </div>
    </div>
</form>
<div class="row">
    <div class="col-12 d-flex justify-content-center" style="padding-top:1rem">
        <button class="btn btn-success" style="width:50%" data-bs-toggle="modal" data-bs-target="#agendaNewModal">
            <i class="fa fa-plus text-light"></i> tambah data
        </button>
        @include('admin.partials.pages.parts.agenda-form')
    </div>
</div>
<div class="table-responsive" style="overflow-x:scroll; padding-top:1rem">
    <table class="table table-striped" id="table">
        <thead class="text-center">
            <tr>
                <th>
                    No.
                </th>
                <th>
                    Nama Agenda
                </th>
                {{-- <th>
                    Deskripsi
                </th> --}}
                <th>
                    Waktu Mulai
                </th>
                <th>
                    Waktu Selesai
                </th>
                <th>
                    Lokasi
                </th>
                {{-- <th>
                    Nama CP
                </th>
                <th>
                    kontak
                </th> --}}
                <th>
                    Tanggal Input
                </th>
                <th>
                    detail
                </th>
            </tr>
        </thead>
        <tbody class="searchable">
            @php
                $num = $data->firstItem() - 1;
            @endphp
            @foreach ($data as $list1)
                @php
                    $num = $num + 1;
                @endphp
                {{-- @php
                    $verif = $list1->verified;
                    switch ($list1->verified) {
                        case 'pengajuan':
                            $icon = 'fa-solid fa-circle-exclamation text-danger';
                            break;
                        case 'diterima':
                            $icon = 'fa-solid fa-circle-check text-success';
                            break;
                        case 'ditolak':
                            $icon = 'fa-solid fa-circle-xmark text-warning';
                            break;
                        case 'test accounts':
                            $icon = 'fa-solid fa-circle-user text-primary';
                            break;
                        default:
                            $icon = 'fa-solid fa-circle-question text-danger';
                            $verif = 'old';
                            break;
                    }
                @endphp --}}
                <tr class="text-center">
                    {{-- <td class="text-center">
                        <i class="{{$icon}}"></i><br>
                        {{ $verif }}
                    </td> --}}
                    <td>{{ $num }}</td>
                    <td style="font-size:80%">{{ $list1->nama_agenda }}</td>
                    <td>{{ Carbon\Carbon::parse($list1->waktu_mulai)->translatedFormat('l, d F Y, h:i A') }}
                    </td>
                    <td>{{ Carbon\Carbon::parse($list1->waktu_selesai)->translatedFormat('l, d F Y, h:i A') }}
                    </td>
                    <td>{{ $list1->lokasi }}</td>
                    {{-- <td>
                        <a class="btn btn-lg rounded-circle d-flex justify-content-center align-items-center m-auto"
                            onclick="return confirm('apakah anda yakin?')" target="_blank" href="javascript.void(0)"
                            style="aspect-ratio: 1 / 1; width:2.5rem" role="button">
                            <i class="fa fa-circle-info text-info"></i>
                        </a>
                    </td> --}}
                    <td>
                        @if (!empty($list1->date_created))
                            {{Carbon\Carbon::parse($list1->date_created)->translatedFormat('l, d F Y, h:i A')}}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <button class="btn" data-bs-toggle="modal"
                            data-bs-target="#agendaModal{{ $list1->id_agenda }}">
                            <i class="fa fa-circle-info text-info"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @foreach ($data as $list2)
        @include('admin.partials.pages.agenda-modal')
    @endforeach
</div>
<div class="row">
    <div class="col-12">
        {{ $data->links('pagination::bootstrap-5') }}
    </div>
</div>
