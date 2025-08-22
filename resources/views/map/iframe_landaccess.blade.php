<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Cache-control" content="public, max-age=2592000">
    <link rel="stylesheet" href="{{ asset('leaflet/dist/leaflet.css') }}"/>
    <link rel="stylesheet" href="{{ asset('leaflet-geoman-free/dist/leaflet-geoman.min.css') }}" />
    <title>Interactive Map</title>
    <style>
        * { margin: 0; padding: 0; }
        /* #map { height: 500px; } */
        .locate-active { fill: red; }
        .located-animation { width: 17px; height: 17px; border: 1px solid #fff; border-radius: 50%; background: #2a93ee; animation: border-pulse 2s infinite; }
    </style>
    <script> var APP_URL = {!! json_encode(url('/')) !!}; </script>
    <script src="{{ asset('adminlte') }}/plugins/jquery/jquery.min.js"></script>
    <script src="{{ asset('leaflet/dist/leaflet.js') }}" fetchpriority="high"></script>
</head>
<body>
    <div>
        <div id="map" @if (app('request')->input('d')) style="height: 300px; width: 400px;" @else style="height: 500px;" @endif></div>
        <input type="hidden" id="hdn_geojson" name="hdn_geojson">
    </div>
</body>
<script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=Promise"></script>
<script src="{{ asset('leaflet-geoman-free/dist/leaflet-geoman.min.js') }}"></script>
<script src='{{ asset('turf/turf.min.js') }}'></script>
<script src='{{ asset('leaflet-bing-layer/leaflet-bing-layer.min.js') }}'></script>
<script src='{{ asset('scripts/Bing.js') }}'></script>
<script src='{{ asset('scripts/script.js') }}'></script>
<script src='{{ asset('scripts/map_styles.js') }}'></script>
<script>
setTimeout(() => {
    var URLvars = getQueryVariables();
    var lat = (URLvars['lat'] === undefined ? -2.28 : URLvars['lat']);
    var long = (URLvars['long'] === undefined ? 117.59 : URLvars['long']);
    var zoom = (URLvars['zoom'] === undefined ? 5 : URLvars['zoom']);

    var map = L.map('map', {
        center: [lat, long],
        zoomSnap: 0.25,
        zoom: zoom,
        zoomControl: false,
    });

    // baseLayer
    var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.opensteetmap.org/copyright">OpenStreetMap</a> contributors'
    });
    osm.addTo(map);
    var gmap = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
        subdomains:['mt0','mt1','mt2','mt3'],
        attribution: 'Imagery © <a href="http://maps.google.com">Google</a>'
    });
    var Esri_NatGeoWorldMap = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/NatGeo_World_Map/MapServer/tile/{z}/{y}/{x}', {
        attribution: 'Tiles &copy; Esri &mdash; National Geographic, Esri, DeLorme, NAVTEQ, UNEP-WCMC, USGS, NASA, ESA, METI, NRCAN, GEBCO, NOAA, iPC',
        maxZoom: 16
    });
    var Esri_DeLorme = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/Specialty/DeLorme_World_Base_Map/MapServer/tile/{z}/{y}/{x}', {
        attribution: 'Tiles &copy; Esri &mdash; Copyright: &copy;2012 DeLorme',
        minZoom: 1,
        maxZoom: 11
    });
    var optionsbing = {
        bingMapsKey: 'AuhiCJHlGzhg93IqUH_oCpl_-ZUrIE6SPftlyGYUvr9Amx5nzA-WqGcPquyFZl4L',
        imagerySet: 'AerialWithLabelsOnDemand'
    }
    var bingmap = L.tileLayer.bing(optionsbing);
    // bingmap.addTo(map);

    @if (app('request')->input('i'))
        var Regional = L.layerGroup();
        var Input = L.layerGroup();
        input = JSON.parse(atob('{{ app('request')->input('i') }}'));
        region = function() {
            var data;
            $.ajax({ url: APP_URL + '/shpfile/load2/{{ $map->id }}/{{ app('request')->input('i') }}', type: 'GET', dataType: 'json', async: false, success: function(data) { ret = data; } });
            return ret;
        }();
        lstFieldsRegional = '{{ $map->selected_fields }}';
        L.geoJson(input, {
            style: styleMaps,
            onEachFeature: function(feature, layer) {
                Input.addLayer(layer);
            }
        });
        if (region.features) {
            L.geoJson(region, {
                style: styleRegional,
                onEachFeature: function(feature, layer) {
                    var out = [];
                    for (var key in feature.properties) {
                        if (lstFieldsRegional.includes(key))
                            out.push(key+": "+feature.properties[key]);
                        if (key == 'skema_ps' && feature.properties[key] != '-')
                            // out.push('<a href="#" onclick="openLandAccessApp(\'' + btoa(feature.properties['kdprov']+'-'+feature.properties['kdkab']+'-'+feature.properties['kdkec']+'-'+feature.properties['kddesa']) + '\')">Proses</a>');
                            out.push('<a href="#" onclick="openLandAccessApp(\'' + btoa(feature.properties['idd']) + '\')">Proses</a>');
                    }
                    layer.bindPopup(out.join('<br>'));
                    Regional.addLayer(layer);
                }
            })
            bbox = turf.bbox(region);
            map.fitBounds([[bbox[1],bbox[0]],[[bbox[3],bbox[2]]]]);
        }
        Input.addTo(map);
        Regional.addTo(map);
    @elseif (app('request')->input('d'))
        var Regional = L.layerGroup();
        region = function() {
            var data;
            $.ajax({ url: APP_URL + '/shpfile/load3/{{ $map->id }}/{{ app('request')->input('d') }}', type: 'GET', dataType: 'json', async: false, success: function(data) { ret = data; } });
            return ret;
        }();
        lstFieldsRegional = '{{ $map->selected_fields }}';
        L.geoJson(region, {
            style: styleRegional,
            onEachFeature: function(feature, layer) {
                var out = [];
                for (var key in feature.properties) {
                    if (lstFieldsRegional.includes(key))
                        out.push(key+": "+feature.properties[key]);
                }
                layer.bindPopup(out.join('<br>'));
                Regional.addLayer(layer);
            }
        })
        bbox = turf.bbox(region);
        map.fitBounds([[bbox[1],bbox[0]],[[bbox[3],bbox[2]]]]);
        Regional.addTo(map);
    @endif
    baseMaps = {
        'OpenStreetMap': osm,
        'Google Maps': gmap,
        'ESRI NatGeo World Map': Esri_NatGeoWorldMap,
        'ESRI DeLorme': Esri_DeLorme,
        'Bing': bingmap,
    }
    otherLayers = {
        @if (app('request')->input('i'))
        'Regional': Regional,
        'Input Pengguna': Input,
        @elseif (app('request')->input('d'))
        'Regional': Regional,
        @endif
    }
    L.control.layers(baseMaps, otherLayers, { position: 'bottomright' }).addTo(map);

    L.control.zoom({ position: 'topright' }).addTo(map);

    // enabled only when iframe is loaded without any input params
    @if (!app('request')->input('i') && !app('request')->input('d'))
    // my location
    // ref: https://tomickigrzegorz.github.io/leaflet-examples/#49.location-button
    const customControl = L.Control.extend({
        options: {
            position: 'topleft',
            className: 'locate-button leaflet-bar',
            html: '<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="width: 30px; height: 30px;"><path d="M0 0h24v24H0z" fill="yellow"/><path d="M12 8c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm8.94 3A8.994 8.994 0 0 0 13 3.06V1h-2v2.06A8.994 8.994 0 0 0 3.06 11H1v2h2.06A8.994 8.994 0 0 0 11 20.94V23h2v-2.06A8.994 8.994 0 0 0 20.94 13H23v-2h-2.06zM12 19c-3.87 0-7-3.13-7-7s3.13-7 7-7 7 3.13 7 7-3.13 7-7 7z"/></svg>',
            style: 'display: flex; cursor: pointer; justify-content: center; font-size: 2rem;',
        },
        onAdd: function (map) {
            this._map = map;
            const button = L.DomUtil.create('div');
            L.DomEvent.disableClickPropagation(button);
            button.title = 'Locate';
            button.innerHTML = this.options.html;
            button.className = this.options.className;
            button.setAttribute("style", this.options.style);
            L.DomEvent.on(button, "click", this._clicked, this);
            return button;
        },
        _clicked: function (e) {
            L.DomEvent.stopPropagation(e);
            this._checkLocate();
            return;
        },
        _checkLocate: function () {
            return this._locateMap();
        },
        _locateMap: function () {
            const locateActive = document.querySelector('.locate-button');
            const locate = locateActive.classList.contains('locate-active');
            locateActive.classList[locate ? 'remove' : 'add']('locate-active');
            if (locate) {
                this.removeLocate();
                this._map.stopLocate();
                return;
            }
            this._map.on('locationfound', this.onLocationFound, this);
            this._map.on('locationerror', this.onLocationError, this);
            this._map.locate({ setView: true, enableHighAccuracy: true });
        },
        onLocationFound: function (e) {
            this.addCircle(e).addTo(this.featureGroup()).addTo(map);
            this.addMarker(e).addTo(this.featureGroup()).addTo(map);
            var geojson = {
                "type":"Feature","properties":{},"geometry":{"type":"Point","coordinates":[e.longitude,e.latitude]}
            };
            $('#hdn_geojson').val(JSON.stringify(geojson));
            $('.description.leaflet-control').remove();
        },
        onLocationError: function (e) {
            this.addLegend('Location access denied.');
        },
        featureGroup: function() {
            return new L.FeatureGroup();
        },
        addLegend: function (text) {
            const checkIfDescriptionExist = document.querySelector('.description');
            if (checkIfDescriptionExist) {
                checkIfDescriptionExist.textContent = text;
                return;
            }
            const legend = L.control({ position: 'bottomleft' });
            legend.onAdd = function () {
                let div = L.DomUtil.create('div', 'description');
                div.setAttribute("style", "background-color: lightgray; padding: 0 5px;")
                L.DomEvent.disableClickPropagation(div);
                const textInfo = text;
                div.insertAdjacentHTML('beforeend', textInfo);
                return div;
            };
            legend.addTo(this._map);
        },
        addCircle: function ({ accuracy, latitude, longitude }) {
            return L.circle([latitude, longitude], accuracy/2, {
                className: 'circle-test',
                weight: 2,
                stroke: false,
                fillColor: '#136aec',
                fillOpacity: 0.15,
            });
        },
        addMarker: function ({ latitude, longitude }) {
            coords = longitude+', '+latitude;
            return L.marker([latitude, longitude], {
                icon: L.divIcon({
                    className: 'located-animation',
                    iconSize: L.point(17,17),
                    popupAnchor: [0, -15],
                }),
            }).bindPopup(coords+'<br><a href="#" onclick="processLayer2()">Proses</a>');
        },
        removeLocate: function () {
            this._map.eachLayer(function (layer) {
                if (layer instanceof L.Marker) {
                    const { icon } = layer.options;
                    if (icon?.options.className === 'located-animation') {
                        map.removeLayer(layer);
                    }
                }
                if (layer instanceof L.Circle) {
                    if (layer.options.className === 'circle-test') {
                        map.removeLayer(layer);
                    }
                }
            });
        },
    });
    map.addControl(new customControl());

    // leaflet.pm
    // reference: https://github.com/tomickigrzegorz/leaflet-examples/tree/master/docs/66.leaflet-geoman
    const options = {
        position: 'topleft',
        drawMarker: true,
        drawPolygon: true,
        drawPolyline: true,
        drawCircle: true,
        drawCircleMarker: false,
        drawText: false,
        editPolygon: true,
        deleteLayer: true,
    };

    // add leaflet.pm controls to the map
    map.pm.addControls(options);

    map.pm.setGlobalOptions({ templineStyle: { color: '#28a745' }, hintlineStyle: { color: '#28a745' } });

    map.pm.setPathOptions({ color: 'orange', fillColor: 'green', fillOpacity: 0.3 });

    function makeLayer(feature) {
        // console.log(feature);
        coords = `${feature.geometry.coordinates}`;
        return coords;
    }

    function setLayer(layer) {
        if (layer.options.radius) {
            layer2 = L.PM.Utils.circleToPolygon(layer, 10);
            var feature = layer2.toGeoJSON();
        } else var feature = layer.toGeoJSON();
        var coords = makeLayer(feature);
        layer.bindPopup(coords+'<br><a href="#" onclick="processLayer2()">Proses</a>');
        $('#hdn_geojson').val(JSON.stringify(feature));
    }

    // get array of all available shapes
    map.pm.Draw.getShapes();

    // disable drawing mode
    map.pm.disableDraw("Polygon");

    // listen to when drawing mode gets enabled
    map.on("pm:drawstart", function (e) {
        // console.log(e);
    });

    // listen to when drawing mode gets disabled
    map.on("pm:drawend", function (e) {
        // console.log(e);
    });

    // listen to when a new layer is created
    map.on("pm:create", function (e) {
        // console.log(e);
        var layer = e.layer;
        setLayer(layer);

        // listen to changes on the new layer
        e.layer.on("pm:edit", function (x) {
            console.log("edit", x);
            setLayer(e.layer);
        });
    });

    @endif

}, 1000);
</script>