{{-- <div style="padding-bottom:1rem"> --}}
    <div class="alert alert-warning" role="alert">
        Kami menyarankan penggunaan ponsel genggam dalam pengambilan lokasi jika lokasi anda meleset jauh
    </div>
<div class="card">
    <div class="card-body">
        <div class="col-12">
            <div id="map" style="width: 100%; height: 20rem;"></div>
        </div>

        <table class="table table-striped table-borderless table-sm">
            <tr>
                <td>
                    <p>
                        latitude :
                    </p>
                </td>
                <td>
                    <p id="latitude"></p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>
                        longitude :
                    </p>
                </td>
                <td>
                    <p id="longitude"></p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>
                        Akurasi :
                    </p>
                </td>
                <td>
                    <p id="accuracy"></p>
                </td>
            </tr>
        </table>
        <div class="d-flex justify-content-between">
            <a href="{{ route('lengkapi_data') }}" class="btn btn-danger">Batal</a>
            <button class="btn btn-secondary" onclick="getLocation()" id="getloc">Dapatkan Lokasi</button>
            <a href="javascript:void(0)" onclick="return confirm('Simpan lokasi ini?')" class="btn btn-success disabled"
                id="save">simpan</a>
        </div>
    </div>
</div>
{{-- </div> --}}


<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
    integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
<script>
    var x = document.getElementById("latitude");
    var y = document.getElementById("longitude");
    var rad = document.getElementById("accuracy");
    var save = document.getElementById("save");
    // map = new OpenLayers.Map("map");

    // use geolocation to get latitude and longitude
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPos);
            navigator.geolocation.getCurrentPosition(enableBtn);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
            disableBtn();
        }
    }

    //show position and map on screen
    function showPos(position) {
        var lat = position.coords.latitude;
        var long = position.coords.longitude;
        var acc = position.coords.accuracy;
        x.innerHTML = lat;
        y.innerHTML = long;
        rad.innerHTML = acc;

        // Creating map options
        // Creating map options
        var mapOptions = {
            center: [lat, long],
            enableHighAccuracy: true,
            zoom: 10
        }

        // Creating a map object
        if (map != undefined) { 
            map.remove(); 
            setTimeout(function() {
            var map = new L.map('map', mapOptions);
            }, 500);
        } else {
            var map = new L.map('map', mapOptions);
        }

        // Creating a Layer object
        if (layer == null) {
            var layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
        } else {
            var layer = L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
        }
        // Adding layer to the map
        map.addLayer(layer);

        // Creating a marker
        var marker = L.marker([lat, long]);

        // Adding marker to the map
        marker.addTo(map);

        //adding accuracy circle radius thingamajig to the map
        if(acc != null || acc != ''){
        var accuracy = L.circle([lat, long], acc);

        accuracy.addTo(map);
        }
    }

    //enable submit button after location is found
    function enableBtn(position) {
        var lat = position.coords.latitude;
        var long = position.coords.longitude;
        var acc = position.coords.accuracy;
        var url = "{{ route('post_location', ['x' => ':lat', 'y' => ':long', 'acc' => ':acc']) }}";
        url = url.replace(':lat', lat);
        url = url.replace(':long', long);
        url = url.replace(':acc', acc);
        if (save.classList.contains("disabled") && lat != null) {
            save.classList.remove("disabled");
            save.href = url;
        }
    }

    //disable submit button if the button (somehow) is enabled but location is not found
    function disableBtn() {
        if (!save.classList.contains("disabled")) {
            save.classList.add("disabled");
            save.href = "javascript:void(0)";
        }
    }
</script>
