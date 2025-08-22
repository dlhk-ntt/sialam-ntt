<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('leaflet/dist/leaflet.css') }}"/>
</head>
<body>
    <span>Sistem sedang memproses permintaan Anda. Mohon tunggu...</span>
    <div id="peta" style="width: 300px; height: 200px"></div><img id="region-map">
    <script type="text/javascript" src="{{ asset('adminlte') }}/plugins/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('leaflet/dist/leaflet.js') }}" fetchpriority="high"></script>
    <script type="text/javascript" src="{{ asset('scripts/dom-to-image.min.js') }}" fetchpriority="high"></script>
    <script type="text/javascript" src='{{ asset('turf/turf.min.js') }}'></script>
    <script type="text/javascript" src='{{ asset('leaflet-bing-layer/leaflet-bing-layer.min.js') }}'></script>
    <script type="text/javascript" src='{{ asset('scripts/Bing.js') }}'></script>
    <script type="text/javascript">
        const map = L.map('peta', {
            attributionControl: false,
            center: [-2.28, 117.59],
            fadeAnimation: false,
            // zoom: 4.65,
            zoomAnimation: false,
            zoomControl: false,
            // zoomSnap: 0.25,
        });

        // var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png');
        // tiles.addTo(map);

        var optionsbing = {
            bingMapsKey: 'AuhiCJHlGzhg93IqUH_oCpl_-ZUrIE6SPftlyGYUvr9Amx5nzA-WqGcPquyFZl4L',
            imagerySet: 'AerialWithLabelsOnDemand'
        }
        var tiles = L.tileLayer.bing(optionsbing).addTo(map);

        tiles.on('load', function() {
            setTimeout(function() {
                domtoimage.toPng(document.querySelector('#peta'), {
                    width: 300,
                    height: 200
                })
                .then(function(dataUrl) {
                    $.ajaxSetup({
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                    });
                    $.ajax({
                        url: '/result/genmap',
                        type: 'POST',
                        data: { img: dataUrl, folder: '{{ $map }}', file: '{{ $idd }}' },
                        async: false,
                        success: function(response) {
                            console.log(response);
                        }
                    })
                    document.getElementById('region-map').src = dataUrl;
                    setTimeout(function() { window.close(); }, 200);
                });
            }, 200);
        });

        var SHP_layer = L.layerGroup();
        $.getJSON('/shpfile/load3/{{ $map }}/{{ $idd }}', function(data) {
            L.geoJson(data, {
                onEachFeature: function(feature, layer) {
                    SHP_layer.addLayer(layer);
                }
            });
            bbox = turf.bbox(data);
            lat_lt = bbox[1];
            long_lt = bbox[0];
            lat_rb = bbox[3];
            long_rb = bbox[2];
            map.fitBounds([[lat_lt,long_lt],[[lat_rb,long_rb]]]);
        });
        SHP_layer.addTo(map);
    </script>
</body>
</html>
