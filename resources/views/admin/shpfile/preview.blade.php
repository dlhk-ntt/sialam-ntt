<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin=""/>
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('adminlte') }}/dist/css/adminlte.min.css">
    <title>Pratinjau Data Spasial: {{ $data->table_name }}</title>
    <style>
        * { margin: 0; padding: 0; }
        #map { height: 500px; }
        #opt { position: absolute; top: 0; right: 0; z-index: 500; opacity: 0.8; }
        #opt-inner2 { width: 200px; border: 1px solid white; }
    </style>
</head>
<body>
    <div>
        <div id="map"></div>
        <div id="opt" class="p-1 bg-white">
            <span id="chevron-opt" class="d-inline-block align-top" onclick="toggleOpt()"><i class="fas fa-chevron-right"></i></span>
            <div id="opt-inner" style="display: inline-block">
                <div id="opt-inner2">
                    <input type="radio" name="rdo_col" onchange="refreshMap('all')" @if (app('request')->input('mode') == 'all') checked @endif> Tampilkan semua kolom<br>
                    <input type="radio" name="rdo_col" onchange="refreshMap('sel')" @if (app('request')->input('mode') == 'sel') checked @endif> Tampilkan kolom terpilih
                </div>
            </div>
        </div>
    </div>
</body>
<script src="{{ asset('adminlte') }}/plugins/jquery/jquery.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
<script src='https://unpkg.com/@turf/turf@6/turf.min.js'></script>
<script>
document.body.style.cursor = 'wait';
var fields = '{{ $data->available_fields }}'.split(',');
var map = L.map('map', {
    center: [-2.28, 117.59],
    zoomSnap: 0.25,
    zoom: 4.65,
});
var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

lstFields = '{{ $data->selected_fields }}'.split(',');
var SHP_layer = L.layerGroup();
$.getJSON('/shpfile/load/{{ $id }}', function(data) {
    L.geoJson(data, {
        onEachFeature: function(feature, layer) {
            var out = [];
            for (var key in feature.properties) {
                @if (app('request')->input('mode') == 'sel')
                if (lstFields.includes(key))
                    out.push(key+": "+feature.properties[key]);
                @else
                out.push(key+": "+feature.properties[key]);
                @endif
            }
            layer.bindPopup(out.join("<br>"));
            SHP_layer.addLayer(layer);
        }
    });
    bbox = turf.bbox(data);
    map.fitBounds([[bbox[1],bbox[0]],[[bbox[3],bbox[2]]]]);
    document.body.style.cursor = 'default';
});
SHP_layer.addTo(map);

function refreshMap(mode) {
    var url = window.location.href.split('?')[0];
    window.location.href = url + "?mode=" + mode;
}
function toggleOpt() {
    if ($("#opt-inner").css("display") == "none") {
        $("#chevron-opt").html('<i class="fas fa-chevron-right"></i>');
    } else {
        $("#chevron-opt").html('<i class="fas fa-chevron-left"></i>');
    }
    $("#opt-inner").toggle("slide");
}
toggleOpt();
</script>