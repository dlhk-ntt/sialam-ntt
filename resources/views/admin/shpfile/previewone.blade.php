<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('leaflet/dist/leaflet.css') }}"/>
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('adminlte') }}/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="{{ asset('styles') }}/style.css">
    <title>Pratinjau Data Spasial Per Daerah: {{ $data->table_name }}</title>
    <style>
        * { margin: 0; padding: 0; }
    </style>
</head>
<body>
    <div class="px-2">
        <div id="reg" class="py-2">
            @php
                $selected_reg = (app('request')->input('d') ? app('request')->input('d') : base64_encode($id_reg[0]->idd));
                $dropdown_reg = '';
                $txt_selected_reg = '';
                foreach ($id_reg as $ir) {
                    $idd = base64_encode($ir->idd);
                    $dropdown_reg .= '<option value="'.$idd.'" '.($idd == $selected_reg ? 'selected' : '').'>'.$ir->nmdesa.' | '.$ir->nmkec.' | '.$ir->nmkab.' | '.$ir->nmprov.'</option>';
                    if ($idd == $selected_reg)
                        $txt_selected_reg = $ir->nmdesa.' | '.$ir->nmkec.' | '.$ir->nmkab.' | '.$ir->nmprov;
                }
            @endphp
            <div>Daerah terpilih: {{ $txt_selected_reg }}</div>
            <div>
                Pilih daerah:
                <select id="sel_region" class="form-control d-inline-block" style="width: 500px" onchange="refreshMap()">
                    {!! $dropdown_reg !!}
                </select>
            </div>
            <small><em>Catatan: daerah yang ditampilkan di sini hanya daerah yang dapat direkomendasikan Perhutanan Sosial</em></small>
        </div>
        <div id="map" style="height: 300px; width: 400px;"></div>
    </div>
</body>
<script src="{{ asset('adminlte') }}/plugins/jquery/jquery.min.js"></script>
<script src="{{ asset('leaflet/dist/leaflet.js') }}" fetchpriority="high"></script>
<script src='{{ asset('turf/turf.min.js') }}'></script>
<script src='{{ asset('leaflet-bing-layer/leaflet-bing-layer.min.js') }}'></script>
<script src='{{ asset('leaflet-easyPrint/bundle.js') }}'></script>
<script src='{{ asset('scripts/Bing.js') }}'></script>
<script>
document.body.style.cursor = 'wait';
var fields = '{{ $data->available_fields }}'.split(',');
var map = L.map('map', {
    center: [-2.28, 117.59],
    zoomSnap: 0.25,
    zoom: 4.65,
});

// var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
//     maxZoom: 19,
//     attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
// }).addTo(map);

var optionsbing = {
    bingMapsKey: 'AuhiCJHlGzhg93IqUH_oCpl_-ZUrIE6SPftlyGYUvr9Amx5nzA-WqGcPquyFZl4L',
    imagerySet: 'AerialWithLabelsOnDemand'
}
var tiles = L.tileLayer.bing(optionsbing).addTo(map);

lstFields = '{{ $data->selected_fields }}'.split(',');
var SHP_layer = L.layerGroup();
$.getJSON('/shpfile/load3/{{ $id }}/{{ $selected_reg }}', function(data) {
    L.geoJson(data, {
        onEachFeature: function(feature, layer) {
            var table = '<table class="infomap-landaccess table">';
            for (var key in feature.properties) {
                if (lstFields.includes(key)) {
                    switch (key) {
                        case 'nmprov': key2 = 'Provinsi'; break;
                        case 'nmkab': key2 = 'Kabupaten/Kota'; break;
                        case 'nmkec': key2 = 'Kecamatan'; break;
                        case 'nmdesa': key2 = 'Desa'; break;
                        case 'f_kws': key2 = 'Fungsi Kawasan Kehutanan'; break;
                        case 'skema_ps': key2 = 'Status PS'; break;
                        default: key2 = key; break;
                    }
                    if (key == 'skema_ps') {
                        if (feature.properties[key] == 'Tidak direkomendasi PS' || feature.properties[key] == '-') {
                            val = 'Sudah ada izin/sedang dalam pengajuan izin';
                        } else val = (feature.properties[key]).replace(/-/g, ', ');
                    } else val = feature.properties[key];
                    table += '<tr><td>'+key2+'</td><td>'+val+'</td></tr>';
                }
            }
            table += '</table>';
            layer.bindPopup(table);
            SHP_layer.addLayer(layer);
        }
    });
    bbox = turf.bbox(data);
    console.log(bbox);
    resize_diff = 0.05;
    lat_lt = bbox[1];
    long_lt = bbox[0];
    lat_rb = bbox[3];
    long_rb = bbox[2];
    if (lat_lt == Math.abs(lat_lt)) lat_lt -= resize_diff;
        else lat_lt += resize_diff;
    if (long_lt == Math.abs(long_lt)) long_lt -= resize_diff;
        else long_lt += resize_diff;
    if (lat_rb == Math.abs(lat_rb)) lat_rb += resize_diff;
        else lat_rb -= resize_diff;
    if (long_rb == Math.abs(long_rb)) long_rb += resize_diff;
        else long_rb -= resize_diff;
    console.log(long_lt, lat_lt, long_rb, lat_rb);
    map.fitBounds([[lat_lt,long_lt],[[lat_rb,long_rb]]]);
    // map.fitBounds([[bbox[1],bbox[0]],[[bbox[3],bbox[2]]]]);
    document.body.style.cursor = 'default';
});
SHP_layer.addTo(map);

var popup = L.popup();

var printer = L.easyPrint({
    tileLayer: tiles,
    sizeModes: ['Current'],
    filename: 'myMap',
    exportOnly: true,
    hideControlContainer: true,
}).addTo(map);

function refreshMap() {
    url = window.location.href.split('?')[0];
    region = $('#sel_region').val();
    window.location.href = url + "?d=" + region;
}

@if (app('request')->input('dl') == 'y')
    // setTimeout(function () {
        document.getElementsByClassName('CurrentSize')[0].click();
    // }, 10);
@endif
</script>