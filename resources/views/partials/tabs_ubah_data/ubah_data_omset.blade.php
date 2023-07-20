{{-- @php $data_usaha = $main_data; @endphp --}}
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
        <form action="{{ route('post_omset') }}" method="post">
            @csrf
                @php
                    if (!empty($id)) {
                        $function = "edit";
                    } else {
                        $function = "Tambah";
                    }
                @endphp
            <h5 class="card-title">{{$function}} Data Aset Omset</h5>
            @if (!empty($id))
                <input type="hidden" name="id" value="{{$id}}">
            @else
                <input type="hidden" name="id" value="new">
            @endif
            <table class="table table-striped table-borderless table-sm" style="margin: 0;">
                <tr>
                    <td>Jenis</td>
                    <td style="padding-top: 0; padding-bottom: 0;">
                        <select class="form-select form-select-sm rounded-0 @error('jenis') is-ivalid @enderror" id="jenis" name="jenis" required>
                            @php
                                if(!empty(old('jenis'))){
                                    $val_jenis = old('jenis');
                                } elseif(!empty($id)){
                                    $val_jenis = $omset->id_jenis;
                                } else {
                                    $val_jenis = '';
                                }
                            @endphp
                            <option value="" hidden>Pilih jenis</option>
                            @foreach($jenis as $jenis1)
                            <option value="{{$jenis1->id_jenis}}" @if ($val_jenis == $jenis1->id_jenis) selected @endif>
                                {{$jenis1->jenis}}</option>
                            @endforeach
                        </select>
                        @error('jenis')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td>Kategori</td>
                    <td style="padding-top: 0; padding-bottom: 0;">
                        <select class="form-select form-select-sm rounded-0 @error('kategori') is-ivalid @enderror" id="kategori" name="kategori" required>
                            @php
                                if(!empty(old('kategori'))){
                                    $val_kategori = old('kategori');
                                } elseif(!empty($id)){
                                    $val_kategori = $omset->id_kategori;
                                } else {
                                    $val_kategori = '';
                                }
                            @endphp
                            <option value="" hidden>Pilih kategori</option>
                            @foreach($kategori as $kategori1)
                            <option value="{{$kategori1->id_kategori}}" @if ($val_kategori == $kategori1->id_kategori) selected @endif>
                                {{$kategori1->kategori}}</option>
                            @endforeach
                        </select>
                        @error('kategori')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td>tanggal</td>
                    <td style="padding-top: 0; padding-bottom: 0;">
                        <input type="date" class="form-control form-control-sm rounded-0" name="tanggal" value="@if(!empty($omset->tanggal)){{Carbon\Carbon::parse($omset->tanggal)->format('Y-m-d')}}@else{{old('tanggal')}}@endif"
                        aria-label="tanggal" aria-describedby="basic-addon1">
                        @error('tanggal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td>nominal</td>
                    <td style="padding-top: 0; padding-bottom: 0;">
                        <input class="form-control form-control-sm rounded-0 @error('nominal') is-invalid @enderror" name="nominal" id="currency-field" 
                        pattern="^\'Rp'\d{1,3}(,\d{3})*(\.\d+)?$"  value="@if(!empty(old('nominal'))){{old('nominal')}}@elseif(!empty($omset)){{{$omset->nominal}}}@endif" 
                        data-type="currency" placeholder="nominal" type="text">
                        @error('nominal')
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
            <div style="padding-top: 0.5rem" class="d-flex justify-content-between">
                <a href="{{ route('lengkapi_data') }}" class="btn btn-danger btn-sm" type="button">Batal</a>
                <button class="btn btn-success btn-sm" onclick="return confirm('Simpan data ini?')" type="submit">{{$function}}</button>
            </div>
        </form>
    </div>
</div>
<br>
<script>
    $("input[data-type='currency']").on({
    keyup: function() {
      formatCurrency($(this));
    },
    blur: function() { 
      formatCurrency($(this), "blur");
    }
});


function formatNumber(n) {
  // format number 1000000 to 1,234,567
  return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}


function formatCurrency(input, blur) {
  // appends $ to value, validates decimal side
  // and puts cursor back in right position.
  
  // get input value
  var input_val = input.val();
  
  // don't validate empty input
  if (input_val === "") { return; }
  
  // original length
  var original_len = input_val.length;

  // initial caret position 
  var caret_pos = input.prop("selectionStart");
    
  // check for decimal
  if (input_val.indexOf(".") >= 0) {

    // get position of first decimal
    // this prevents multiple decimals from
    // being entered
    var decimal_pos = input_val.indexOf(".");

    // split number by decimal point
    var left_side = input_val.substring(0, decimal_pos);
    var right_side = input_val.substring(decimal_pos);

    // add commas to left side of number
    left_side = formatNumber(left_side);

    // validate right side
    right_side = formatNumber(right_side);
    
    // On blur make sure 2 numbers after decimal
    if (blur === "blur") {
      right_side += "00";
    }
    
    // Limit decimal to only 2 digits
    right_side = right_side.substring(0, 2);

    // join number by .
    input_val = "Rp" + left_side + "." + right_side;

  } else {
    // no decimal entered
    // add commas to number
    // remove all non-digits
    input_val = formatNumber(input_val);
    input_val = "Rp" + input_val;
    
    // final formatting
    if (blur === "blur") {
      input_val += "";
    }
  }
  
  // send updated string to input
  input.val(input_val);

  // put caret back in the right position
  var updated_len = input_val.length;
  caret_pos = updated_len - original_len + caret_pos;
  input[0].setSelectionRange(caret_pos, caret_pos);
}
</script>