<div class="alert alert-light" style="margin-top: 1rem;">
    <div class="row">
        <div class="col-lg-8 col-md-9 col-sm-12 mb-3">
            @if (!empty($id))
                @if (!empty($data->foto_1))
                    @php
                        $foto1 = rawurlencode($data->foto_1);
                        $imgurl_1 = 'https://sibakuljogja.jogjaprov.go.id/files/' . $foto1 . '';
                    @endphp
                    <div class="row" style="padding-bottom:1rem; padding-top:2rem">
                        Foto lama 1
                        <img src="{!! $imgurl_1 !!}" alt="">
                    </div>
                @endif
            @endif
            <label for="foto_detail_1" class="form-label">Foto Detail 1</label>
            <img class="img-preview-1 img-fluid mb-2 col-sm-5">
            <input class="form-control @error('foto_detail_1') is-invalid @enderror" type="file" name="foto_detail_1"
                id="foto_detail_1" onchange="previewImage1()">
            @error('foto_detail_1')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col-lg-8 col-md-9 col-sm-12 mb-3">
            @if (!empty($id))
                @if (!empty($data->foto_2))
                    @php
                        $foto2 = rawurlencode($data->foto_2);
                        $imgurl_2 = 'https://sibakuljogja.jogjaprov.go.id/files/' . $foto2 . '';
                    @endphp
                    <div class="row" style="padding-bottom:1rem; padding-top:2rem">
                        Foto lama 2
                        <img src="{!! $imgurl_2 !!}" alt="">
                    </div>
                @endif
            @endif
            <label for="foto_detail_2" class="form-label">Foto Detail 2</label>
            <img class="img-preview-2 img-fluid mb-2 col-sm-5">
            <input class="form-control @error('foto_detail_2') is-invalid @enderror" type="file" name="foto_detail_2"
                id="foto_detail_2" onchange="previewImage2()">
            @error('foto_detail_2')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="col-lg-8 col-md-9 col-sm-12 mb-3">
        @if (!empty($id))
            @if (!empty($data->foto_3))
                @php
                    $foto3 = rawurlencode($data->foto_3);
                    $imgurl_3 = 'https://sibakuljogja.jogjaprov.go.id/files/' . $foto3 . '';
                @endphp
                <div class="row"style="padding-bottom:1rem; padding-top:2rem">
                    Foto lama 3
                    <img src="{!! $imgurl_3 !!}" alt="">
                </div>
            @endif
        @endif
        <label for="foto_detail_3" class="form-label">Foto Detail 3</label>
        <img class="img-preview-3 img-fluid mb-2 col-sm-5">
        <input class="form-control @error('foto_detail_3') is-invalid @enderror" type="file" name="foto_detail_3"
            id="foto_detail_3" onchange="previewImage3()">
        @error('foto_detail_3')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

<script>
    function previewImage1() {
        const foto_detail_1 = document.querySelector('#foto_detail_1');
        const imgPreview1 = document.querySelector('.img-preview-1');

        imgPreview1.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(foto_detail_1.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview1.src = oFREvent.target.result;
        }
    }

    function previewImage2() {
        const foto_detail_2 = document.querySelector('#foto_detail_2');
        const imgPreview2 = document.querySelector('.img-preview-2');

        imgPreview2.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(foto_detail_2.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview2.src = oFREvent.target.result;
        }
    }

    function previewImage3() {
        const foto_detail_3 = document.querySelector('#foto_detail_3');
        const imgPreview3 = document.querySelector('.img-preview-3');

        imgPreview3.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(foto_detail_3.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview3.src = oFREvent.target.result;
        }
    }
</script>
