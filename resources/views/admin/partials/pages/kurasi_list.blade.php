<link href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link @if ($status == 'proses') active @endif" aria-current="page"
            href="{{ route('kurasi_list-admin', ['status' => 'proses']) }}">Pengajuan</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if ($status == 'terjawab') active @endif"
            href="{{ route('kurasi_list-admin', ['status' => 'terjawab']) }}">Terjawab</a>
    </li>
</ul>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
        <form action="" style="padding-top:1rem">
            <div class="row justify-content-center">

                {{-- <div class="col-lg-4 col-md-6 col-sm-12 d-flex align-items-center justify-content-center">
                    <label for="take" class="col-form-label">Show &nbsp;</label>
                    <input type="number" name="take" id="take" class="form-control" style="width:5rem" aria-describedby="detail">
                    <span id="detail" class="form-text">
                        &nbsp;Data per page
                    </span>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 d-flex align-items-center justify-content-center">
                    <label for="filter" class="col-form-label">Search &nbsp;</label>
                    <input type="text" name="filter" id="filter" class="form-control" style="width:10rem">
                </div> --}}

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-group">
                        <span class="input-group-text">keyword</span>
                        <input type="text" aria-label="filter" name="filter" value="{{ $filter }}"
                            class="form-control">
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="input-group">
                        <span class="input-group-text">Per laman</span>
                        <input type="number" aria-label="take" min="1" max="32" name="take"
                            value="{{ $take }}" class="form-control">
                    </div>
                </div>

                <div class="col-lg-4 col-md-12 col-sm-12">
                    <button class="btn btn-success w-100" type="submit">Apply filter</button>
                </div>
            </div>
        </form>
        <div class="table-responsive" style="padding-top:1rem; text-align: center; overflow-x:scroll;">
            <table class="table table-striped" id="table">
                <thead>
                    <tr>
                        <th>
                            No.
                        </th>
                        <th>
                            status
                        </th>
                        <th>
                            judul
                        </th>
                        <th>
                            harga
                        </th>
                        @if ($status == 'terjawab')
                            <th>
                                kurator
                            </th>
                        @endif
                        <th>
                            tanggal diajukan
                        </th>
                        <th>
                            detail
                        </th>
                    </tr>
                </thead>
                <tbody class="text-center searchable">
                    {{-- {{dd($data)}} --}}
                    @php
                        $num = $data->firstItem() - 1;
                    @endphp
                    @foreach ($data as $kurasi)
                        @php
                            $num = $num + 1;
                        @endphp
                        <tr>
                            <td>
                                {{ $num }}
                            </td>
                            <td class="text-center">
                                {{-- @if (empty($kurasi->kurator_markethub) || $kurasi->lolos_kurasimarkethub == 'proses') --}}
                                @php
                                    $status_kurasi = $kurasi->id_status_kurasimarkethub;
                                    if ($status_kurasi == 4) {
                                        $icon = 'fa-circle-exclamation text-danger';
                                    } elseif ($status_kurasi == 1) {
                                        $icon = 'fa-circle-check text-success';
                                    } elseif ($status_kurasi == 2) {
                                        $icon = 'fa-circle-xmark text-warning';
                                    } elseif ($status_kurasi == 3) {
                                        $icon = 'fa-pen-to-square text-warning';
                                    }
                                @endphp
                                <i class="fa-solid {{ $icon }}"></i>
                                <p style="font-size:80%">{{ $kurasi->detail_status_kurasi }} </p>
                            </td>
                            <td>{{ $kurasi->nama }}</td>
                            <td>{{ $kurasi->harga }}</td>
                            @if ($status == 'terjawab')
                                <td>{{ $kurasi->kurator_markethub }}</td>
                            @endif
                            <td>
                                @if (!empty($kurasi->waktu_kurasimarkethub))
                                    {{ Carbon\Carbon::parse($kurasi->waktu_kurasimarkethub)->translatedFormat('l, d F Y, h:i A') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <button class="btn" data-bs-toggle="modal"
                                    data-bs-target="#kurasiModal{{ $kurasi->id }}">
                                    <i class="fa fa-circle-info text-info"></i>
                                </button>
                            </td>
                            {{-- <td>{{Carbon\Carbon::parse($forgot->created_at)->translatedFormat('l, d F Y')}}</td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @foreach ($data as $kurasi)
                @include('admin.partials.pages.kurasi-modal')
            @endforeach
        </div>
    </div>
    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0"></div>
    {{-- {{$data->links('pagination::bootstrap-5')}} --}}
    <div class="row">
        {{-- <div class="col-lg-3 col-md-3 col-sm-6 text-center">
            showing data {{ $data->firstItem() }} - {{ $data->lastItem() }} from {{ $data->total() }} data
        </div>
    
        <div class="col-lg-3 col-md-3 col-sm-6 text-center">
        </div>
     --}}
        <div class="col-12">
            {{ $data->withQueryString()->links('pagination::bootstrap-5') }}
        </div>
    </div>

    {{-- <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js" type="text/javascript"></script>

<script>
    $(document).ready(function() {
        $.noConflict();
        var table = $('#table').DataTable();
    });
    $('#table').DataTable({
        searching: false,
        paging: false,
        info:false,
        columnDefs: [{
            targets: '_all',
            className: 'dt-head-center'
        }]
    });
</script> --}}

    {{-- <script>
    function changevar(){

    }
</script> --}}

    {{-- <script>
$(document).ready(function () {

(function ($) {

    $('#filter').keyup(function () {

        var rex = new RegExp($(this).val(), 'i');
        $('.searchable tr').hide();
        $('.searchable tr').filter(function () {
            return rex.test($(this).text());
        }).show();

    })

}(jQuery));

});

</script> --}}

    {{-- <div class="container mx-auto justify-content-center d-flex mb-7" style="width:100%">
    {{ $data->links('pagination::bootstrap-4') }}
</div> --}}
