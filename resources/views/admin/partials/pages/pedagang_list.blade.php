{{-- <link href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css" rel="stylesheet"> --}}
<form action="" method="get" style="padding-top:1rem">
    {{-- @csrf --}}
    <div class="row">
        {{-- <input type="hidden" name="page" value="{{$page}}"> --}}
        <div class="col-3">
            <div class="input-group">
                <label class="input-group-text" for="Status">Status</label>
                <select name='status' class="form-select" id="Status" aria-label="Default select example">
                    <option {{ $empty }} value="empty">Semua</option>
                    <option {{ $ajuan }} value="pengajuan">pengajuan</option>
                    <option {{ $diterima }} value="diterima">diterima</option>
                    <option {{ $ditolak }} value="ditolak">ditolak</option>
                    <option {{ $test_accounts }} value="test accounts">akun uji coba</option>
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
<div class="table-responsive" style="overflow-x:scroll; padding-top:1rem">
    <table class="table table-striped" id="table">
        <thead class="text-center">
            <tr>
                <th>
                    status
                </th>
                <th>
                    idsibakul
                </th>
                <th>
                    Nama Usaha
                </th>
                <th>
                    Merk Dagang
                </th>
                <th>
                    Nama Pemilik
                </th>
                <th>
                    Alamat KTP
                </th>
                <th>
                    Tanggal input
                </th>
                <th>
                    detail
                </th>
            </tr>
        </thead>
        <tbody class="searchable">
            @foreach ($data as $list1)
                @php
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
                @endphp
                <tr class="text-center">
                    <td class="text-center">
                        <i class="{{ $icon }}"></i><br>
                        {{ $verif }}
                    </td>
                    <td>{{ $list1->idsibakul }}</td>
                    <td style="font-size:80%">{{ $list1->nama_usaha }}</td>
                    <td>{{ $list1->merkdagang }}</td>
                    <td>{{ $list1->nama_lengkap }}</td>
                    <td>{{ $list1->alamat_ktp }}</td>
                    {{-- <td>
                        <a class="btn btn-lg rounded-circle d-flex justify-content-center align-items-center m-auto"
                            onclick="return confirm('apakah anda yakin?')" target="_blank" href="javascript.void(0)"
                            style="aspect-ratio: 1 / 1; width:2.5rem" role="button">
                            <i class="fa fa-circle-info text-info"></i>
                        </a>
                    </td> --}}
                    <td>
                        @if (!empty($list1->waktu))
                            {{ Carbon\Carbon::parse($list1->waktu)->translatedFormat('l, d F Y, h:i A') }}
                        @else
                            -
                        @endif
                    </td>
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
    @foreach ($data as $list2)
        @include('admin.partials.pages.pedagang_list-modal')
    @endforeach
</div>
<div class="row">
    {{-- <div class="col-lg-3 col-md-3 col-sm-6 text-center">
        showing data {{ $data->firstItem() }} - {{ $data->lastItem() }} from {{ $data->total() }} data
    </div>

    <div class="col-lg-3 col-md-3 col-sm-6 text-center">
    </div> --}}

    {{-- <div class="col-lg-6 col-md-6 col-sm-12 justify-content-evenly d-flex"> --}}
    <div class="col-12">
        {{-- @php
            $slugs = "&show=".$show."&search=".$search."&status=".$status."";    
        @endphp

        @if ($page > 1)
            <a class="btn btn-success" href="?page={{ $page - 1 }}{{$slugs}}">prev</a>
            <a class="btn btn-success" href="?page=1{{$slugs}}">1</a>
        @else
            <a class="btn btn-success disabled" href="java.void(0)">prev</a>
            <a class="btn btn-success " href="?page=2{{$slugs}}">2</a>
        @endif

        @if ($page < $max_page)
            <a class="btn btn-success" href="?page={{ $max_page }}{{$slugs}}">{{ $max_page }}</a>
            <a class="btn btn-success" href="?page={{ $page + 1 }}{{$slugs}}"> next</a>
        @else
            <a class="btn btn-success" href="?page={{ $max_page-1 }}{{$slugs}}">{{ $max_page-1 }}</a>
            <a class="btn btn-success disabled" href="java.void(0)"> next</a>
        @endif --}}
        {{ $data->links('pagination::bootstrap-5') }}
    </div>
</div>
{{-- <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js" type="text/javascript"></script>

<script>
    $(document).ready(function() {
        $.noConflict();
        var table = $('#table').DataTable({
            serverSide: true,
            ajax: '/data-source'
        });
    });
</script> --}}
