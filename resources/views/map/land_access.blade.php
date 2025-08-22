@extends('partials.original_menu')

@section('menu_content')
<div id="map-opt" class="p-1 bg-white">
    <div>
        <button type="button" class="btn btn-secondary btn-sm" onclick="location.reload()" title="Muat Ulang"><i class="fas fa-sync"></i></button>
    </div>
</div>
<div id="interactive-map" class="embed-responsive">
    <iframe>Peramban Anda tidak kompatibel</iframe>
</div>
@stop

@section('customJS')
showMap4();
@stop