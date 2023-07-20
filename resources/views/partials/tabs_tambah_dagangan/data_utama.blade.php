<div class="alert alert-light" style="margin-top: 1rem;">
    @php
    $pesanan        = '';
    $rutin          = '';
        if(!empty($id)){
            $p_namaProduk   = $data->nama;
            $p_deskripsi    = $data->deskripsi_produk;
            $p_harga        = $data->harga;
            if ($data->stok == 'pesanan') {
                $pesanan = 'checked';
            } elseif ($data->stok == 'rutin') {
                $rutin = 'checked';
            }
        } else{
            $p_namaProduk   = 'Nama Produk';
            $p_deskripsi    = 'Deskripsi';
            $p_harga        = 'Harga';
        }
    @endphp
    <div class="row">
        <div class="col-lg-8 col-md-9 col-sm-12 mb-3">
            @if (!empty($data->produk_foto))
            @php
                $pfoto = rawurlencode($data->produk_foto);
                $pimgurl = 'https://sibakuljogja.jogjaprov.go.id/files/' . $pfoto . '';
            @endphp
            <div class="row" style="padding-bottom:1rem; padding-top:2rem">
                Foto lama
                <img src="{!! $pimgurl !!}" alt="">
            </div>
            @endif
            <label for="foto" class="form-label">Foto<span class='text-danger'>*</span></label>
            <img class="img-preview img-fluid mb-2 col-sm-5">
            <input class="form-control @error('foto') is-invalid @enderror" type="file" name="foto" id="foto"
                onchange="previewImage()">
            @error('foto')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <script>
                function previewImage() {
                    const foto = document.querySelector('#foto');
                    const imgPreview = document.querySelector('.img-preview');

                    imgPreview.style.display = 'block';

                    const oFReader = new FileReader();
                    oFReader.readAsDataURL(foto.files[0]);

                    oFReader.onload = function(oFREvent) {
                        imgPreview.src = oFREvent.target.result;
                    }
                }
            </script>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-9 col-sm-12 mb-3">
            <label for="nama_produk" class="form-label">Nama Produk<span class='text-danger'>*</span></label>
            <input type="text" class="form-control" name="nama_produk" id="nama_produk" value="{{$p_namaProduk}}">
        </div>
        <div class="col-lg-6 col-md-9 col-sm-12 mb-3">
            <label for="jenis_produk" class="form-label">Jenis Produk<span class='text-danger'>*</span></label>
            <select class="form-select" name="jenis_produk" aria-label="Default select example" aria-placeholder="pilih jenis">
                <option value="" hidden>Pilih Jenis Produk</option>
                @foreach ($jenis as $jns)
                    <option @if (!empty($data) && $data->jenis == $jns->id_jenis) selected @endif value="{{$jns->id_jenis}}">{{$jns->jenis}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mb-3">
            <label for="deskripsi" class="form-label">Deskripsi<span class='text-danger'>*</span></label>
            <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3">{{$p_deskripsi}}</textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-9 col-sm-12 mb-3">
            <label for="harga" class="form-label">Harga<span class='text-danger'>*</span></label>
            <div class="input-group">
                <span class="input-group-text" id="rp">Rp.</span>
                <input type="number" class="form-control" name="harga" id="harga" step="500" value="{{$p_harga}}"
                    aria-describedby="rp">
            </div>
        </div>
        <div class="col-lg-6 col-md-9 col-sm-12 mb-3">
            <label for="stok" class="form-label">Stok<span class='text-danger'>*</span></label>
            <div class="row d-flex align-items-center">
                <div class="col-auto">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="stok" {{$pesanan}} id="pesanan" value="pesanan">
                        <label class="form-check-label" for="pesanan">
                            Berdasar Pesanan
                        </label>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="stok" {{$rutin}} id="rutin" value="rutin">
                        <label class="form-check-label" for="rutin">
                            Ready Stok/Produksi rutin
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
