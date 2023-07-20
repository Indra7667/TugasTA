{{-- <link href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css" rel="stylesheet"> --}}
<form action="" method="get" style="padding-top:1rem">
    {{-- @csrf --}}
    <div class="row">
        {{-- <input type="hidden" name="page" value="{{$page}}"> --}}
        <div class="col-3">
            <div class="input-group">
                <label class="input-group-text" for="jenis">Status</label>
                <select name='jenis' class="form-select" id="jenis" aria-label="Default select example">
                    <option {{ $empty }} value="daring">Semua</option>
                    <option {{ $daring }} value="daring">Daring</option>
                    <option {{ $luring }} value="luring">Luring</option>
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
        @include('admin.partials.pages.parts.pembinaan-form')
    </div>
</div>
<div class="table-responsive" style="padding-top:1rem">
    <table class="table table-striped" id="table">
        <thead class="text-center">
            <tr>
                <th>
                    No.
                </th>
                <th>
                    jenis
                </th>
                <th>
                    Judul
                </th>
                <th>
                    Lampiran
                </th>
                <th>
                    Waktu Mulai
                </th>
                <th>
                    Waktu Selesai
                </th>
                <th></th>
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
                @php
                    if (!empty($list1->jenis)) {
                        $verif = $list1->jenis;
                    } else {
                        $verif = 'old';
                    }
                    switch ($list1->jenis) {
                        case 'daring':
                            $icon = 'fa-solid fa-signal text-primary';
                            break;
                    
                        case 'luring':
                            $icon = 'fa-solid fa-clipboard-list text-success';
                            break;
                    
                        default:
                            $icon = 'fa-solid fa-circle-question text-danger';
                            break;
                    }
                @endphp
                <tr class="text-center">
                    <td>{{ $num }}</td>
                    <td>
                        <i class="{{ $icon }}"></i><br>
                        {{ $verif }}
                    </td>
                    <td style="font-size:80%">{{ $list1->judul }}</td>
                    <td>{{ $list1->lampiran }}</td>
                    <td>{{ $list1->waktu_mulai }}</td>
                    <td>{{ $list1->waktu_selesai }}</td>
                    <td>
                        <button class="btn" data-bs-toggle="modal"
                            data-bs-target="#pedagangModal{{ $list1->id }}">
                            <i class="fa fa-circle-info text-info"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- @foreach ($data as $list2)
        @include('admin.partials.pages.pedagang_list-modal')
    @endforeach --}}
</div>
</div>
<div class="row">
    <div class="col-12">
        {{ $data->links('pagination::bootstrap-5') }}
    </div>
</div>
