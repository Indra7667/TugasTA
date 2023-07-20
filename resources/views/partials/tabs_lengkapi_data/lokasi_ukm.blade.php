@if (!empty($data_usaha->lokasi_x) && !empty($data_usaha->lokasi_y))
    <div class="col-12" id='container'>
        {{-- <div id="map" style="width: 100%; height: 20rem;"></div> --}}
    </div>
@endif
<table class="table table-striped table-borderless table-sm">
    <tr>
        <td>Latitude</td>
        @if (!empty($data_usaha->lokasi_x))
            <td>{{ $data_usaha->lokasi_x }}</td>
        @else
            <td style="font-weight: 600; color:red;">Data Belum Diisi</td>
        @endif
    </tr>
    <tr>
        <td>Longitude</td>
        @if (!empty($data_usaha->lokasi_y))
            <td>{{ $data_usaha->lokasi_y }}</td>
        @else
            <td style="font-weight: 600; color:red;">Data Belum Diisi</td>
        @endif
    </tr>
    <tr>
        <td>Akurasi</td>
        @if (!empty($data_usaha->akurasi_lokasi))
            <td>±{{ (int) $data_usaha->akurasi_lokasi }} meter</td>
        @else
            <td style="font-weight: 600; color:red;">Data Belum Diisi</td>
        @endif
    </tr>
</table>
<div class="d-flex justify-content-between">
    <a class="btn btn-warning" href="{{ route('ubah_data', ['data' => 'koordinat_gps', 'id' => auth()->user()->id]) }}"
        type="button">Ubah Data</a>
    @php
        if (!empty($data_usaha->lokasi_y && $data_usaha->lokasi_x)) {
            $button = '';
        } else {
            $button = 'disabled';
        }
    @endphp
    <a class="btn btn-danger {{ $button }}" href="{{ route('delete_location') }}"
        onclick="return confirm('Hapus lokasi ini?')" type="button">Hapus Data</a>
</div>

<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
    integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>

<script>
    var lat = parseFloat({!! json_encode($data_usaha->lokasi_x) !!});
    var long = parseFloat({!! json_encode($data_usaha->lokasi_y) !!});
    var acc = parseFloat({!! json_encode($data_usaha->akurasi_lokasi) !!});
    var container = document.getElementById("container");
    var place = document.createElement('div');
        place.id = 'map';
        place.style.width= '100%'; 
        place.style.height= '20rem';
    var on = ({!! json_encode($open) !!} == "lokasi") ? add() : 0;
    function onoff() {
        on = (on == 1) ? remove() : add();
    };

    function add() {
        on = 1;
        var mapOptions = {
        center: [lat, long],
        zoom: 15
    }
        // Creating a map object
        if (map == undefined) {
            container.appendChild(place);
            var map = new L.map('map', mapOptions);
        } 

        // Creating a Layer object
        var layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');

        // Adding layer to the map
        map.addLayer(layer);

        // Creating a marker
        var marker = L.marker([lat, long]);

        // Adding marker to the map
        marker.addTo(map);

        //adding accuracy circle radius thingamajig to the map
        // if (acc != null || acc != '') {
        var accuracy = L.circle([lat, long], acc);

        accuracy.addTo(map);
        setTimeout(function() {
        }, 500);
        // }
    }

    function remove() {
        on = 0;
        var map = document.getElementById('map');
        if (map != undefined) {
            map.remove();
        }
    }
</script>
