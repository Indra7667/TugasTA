

{{-- <div class="form-outline mb-2">
    <input type="text" id="filter" class="form-control form-control-lg"
        style="background-color:white;"/>
    <label class="form-label" for="idsibakul" style="font-weight: normal;">Filter</label>
</div> --}}
{{-- <link rel="stylesheet" href="publik/css/datatable-style.css"> --}}
{{-- <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet"> --}}
{{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet"> --}}
{{-- <link href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css" rel="stylesheet"> --}}
<form action="" method="get" style="padding-top:1rem">
    {{-- @csrf --}}
    <div class="row">
        {{-- <input type="hidden" name="page" value="{{$page}}"> --}}
        <div class="col-3">
            <div class="input-group">
                <label class="input-group-text" for="status">Status</label>
                <select name='status' class="form-select" id="status" aria-label="Default select example">
                    <option {{ $empty }} value="empty">Semua</option>
                    <option {{ $active }} value="active">active</option>
                    <option {{ $sent }} value="sent">sent</option>
                    <option {{ $changed }} value="changed">changed</option>
                    <option {{ $expired }} value="expired">expired</option>
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
<div class="table-responsive" style="padding-top:1rem">
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
                    link
                </th>
                <th>
                    nomor hp
                </th>
                <th>
                    updated at
                </th>
                {{-- <th>
                    create
                </th> --}}
            </tr>
        </thead>
        <tbody class="searchable">
        {{-- <tbody class="searchable"> --}}
            @foreach ($data as $forgot)
            <tr>
                <td class="text-center">
                    @if($forgot->status == 4)
                    <i class="fa-solid fa-circle-xmark text-secondary"></i>
                    <p {{--class="visually-hidden"--}} style="font-size:80%">{{$forgot->status_str}}</p>
                    @elseif($forgot->status == 1)
                    <i class="fa-solid fa-circle-exclamation text-danger"></i>
                    <p {{--class="visually-hidden"--}} style="font-size:80%">{{$forgot->status_str}}</p>
                    @elseif($forgot->status == 2)
                    <i class="fa-solid fa-check-double text-primary"></i>
                    <p {{--class="visually-hidden"--}} style="font-size:80%">{{$forgot->status_str}}</p>
                    @elseif($forgot->status == 3)
                    <i class="fa-solid fa-circle-check text-success"></i>
                    <p {{--class="visually-hidden"--}} style="font-size:80%">{{$forgot->status_str}}</p>
                    @endif
                    
                </td>
                <td>{{$forgot->idsibakul}}</td>
                <td style="font-size:80%">{{$forgot->link}}</td>
                <td >
                    
                    @if (!empty($forgot->no_hp))
                    {{$forgot->no_hp}} 
                    {{-- <a  class="btn btn-success btn-lg rounded-circle d-flex justify-content-center align-items-center m-auto" target="_blank"
                    href="https://api.whatsapp.com/send?phone={{$forgot->no_hp}}&text={{$text}}" style="aspect-ratio: 1 / 1; width:2.5rem" role="button">
                            <i class="fa-solid fa-comment-dots"></i></div>
                    </a> --}}
                        @if($forgot->status == 3 || $forgot->status == 4)
                            <button disabled class="btn btn-success btn-lg rounded-circle d-flex justify-content-center align-items-center m-auto" target="_blank"
                            href="javascript:void(0)" style="aspect-ratio: 1 / 1; width:2.5rem" role="button">
                                    <i class="fa-solid fa-comment-dots"></i>
                            </button>    
                        @else
                            <a  class="btn btn-success btn-lg rounded-circle d-flex justify-content-center align-items-center m-auto" 
                            onclick="return confirm('apakah anda yakin?')" target="_blank"
                            href="{{route('sent-forgot',['id'=>$forgot->id])}}" style="aspect-ratio: 1 / 1; width:2.5rem" role="button">
                                    <i class="fa-solid fa-comment-dots"></i>
                            </a>
                        @endif

                    @else
                    
                    <button disabled class="btn btn-success btn-lg rounded-circle d-flex justify-content-center align-items-center m-auto" target="_blank"
                    href="javascript:void(0)" style="aspect-ratio: 1 / 1; width:2.5rem" role="button">
                            <i class="fa-solid fa-comment-dots"></i>
                    </button>              
                    @endif
                     
                </td>
                <td>{{Carbon\Carbon::parse($forgot->updated_at)->translatedFormat('l, d F Y')}}</td>
                {{-- <td>{{Carbon\Carbon::parse($forgot->created_at)->translatedFormat('l, d F Y')}}</td> --}}
            </tr>
            @endforeach
        </tbody>
    </table>    
</div>
<div class="col-12">
    {{ $data->links('pagination::bootstrap-5') }}
</div>
<!-- simple datatables -->
{{-- <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>

<script type="text/javascript">
    // Simple Datatable
    let table1= document.querySelector('#table');
    let dataTable = new simpleDatatables.DataTable(table1);
</script> --}}

{{-- <script src="https://code.jquery.com/jquery-3.5.1.js" type="text/javascript"></script> --}}
{{-- <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js" type="text/javascript"></script>

<script>$(document).ready(function () {
    $.noConflict();
    var table = $('#table').DataTable();
});</script> --}}


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