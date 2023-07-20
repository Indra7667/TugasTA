<div class="alert alert-light" style="margin-top: 1rem;">
    @php
    if(!empty($id)){
        $p_berat        = $data->berat;
        $p_panjang       = $data->panjang;
        $p_lebar        = $data->lebar;
        $p_tinggi        = $data->tinggi;
    } else{
        $p_berat        = 'berat';
        $p_panjang       = 'panjang';
        $p_lebar        = 'berat';
        $p_tinggi        = 'tinggi';
    }
@endphp
    <div class="row">
        <div class="col-lg-8 col-md-9 col-sm-12 mb-3">
            <label for="berat" class="form-label">Berat<span class='text-danger'>*</span></label>
            <div class="input-group">
                <input type="number" class="form-control" name="berat" id="berat" value="{{$p_berat}}"
                    aria-describedby="gram">
                    <span class="input-group-text" id="gram">gram</span>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-6 mb-3">
            <label for="panjang" class="form-label">Panjang</label>
            <div class="input-group">
                <input type="number" class="form-control" name="panjang" id="panjang" value="{{$p_panjang}}"
                    aria-describedby="cm1">
                    <span class="input-group-text" id="cm1">cm</span>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-6 mb-3">
            <label for="lebar" class="form-label">Lebar</label>
            <div class="input-group">
                <input type="number" class="form-control" name="lebar" id="lebar" value="{{$p_lebar}}"
                    aria-describedby="cm2">
                    <span class="input-group-text" id="cm2">cm</span>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-6 mb-3">
            <label for="tinggi" class="form-label">Tinggi</label>
            <div class="input-group">
                <input type="number" class="form-control" name="tinggi" id="tinggi" value="{{$p_tinggi}}"
                    aria-describedby="cm3">
                    <span class="input-group-text" id="cm3">cm</span>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center" style="padding-top:1.5rem">
        <div class="col-6 d-flex justify-content-center">
            <button class="btn btn-success" type="submit">Submit</button>
        </div>
    </div>
</div>