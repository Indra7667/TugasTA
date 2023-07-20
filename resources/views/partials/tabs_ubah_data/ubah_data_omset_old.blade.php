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
            <h5 class="card-title">{{$function}} Omset Bulanan</h5>
            @if (!empty($id))
                <input type="hidden" name="id" value="{{$id}}">
            @else
                <input type="hidden" name="id" value="new">
            @endif
            <table class="table table-striped table-borderless table-sm" style="margin: 0;">
                <tr>
                    <td>Periode</td>
                    <td style="padding-top: 0; padding-bottom: 0;">
                        <select class="form-select form-select-sm rounded-0 @error('periode') is-ivalid @enderror" id="periode" name="periode" required>
                            @php
                                if(!empty(old('periode'))){
                                    $val_periode = old('periode');
                                } elseif(!empty($id)){
                                    $val_periode = $omset->idperiode;
                                } else {
                                    $val_periode = '';
                                }
                            @endphp
                            <option value="" hidden>Pilih Periode</option>
                            @foreach($periode as $periode1)
                            <option value="{{$periode1->id}}" {{{ (isset($val_periode) && $val_periode == $periode1->id) ? "selected=\"selected\"" : "" }}}>{{$periode1->periode_tahun}} semester {{$periode1->periode_semester}}</option>
                            @endforeach
                        </select>
                        @error('periode')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td>omset_bulanan</td>
                    <td style="padding-top: 0; padding-bottom: 0;">
                        <input class="form-control form-control-sm rounded-0 @error('omset_bulanan') is-invalid @enderror" name="omset_bulanan" id="currency-field" 
                        pattern="^\'Rp'\d{1,3}(,\d{3})*(\.\d+)?$"  value="@if(!empty(old('omset_bulanan'))){{old('omset_bulanan')}}@elseif(!empty($omset)){{{$omset->omset_bulanan}}}@endif" data-type="currency" placeholder="omset bulanan" type="text">
                        @error('omset_bulanan')
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