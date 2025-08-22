@extends('partials.menu_tabs')

@section('menu_tab_content')
<div class="">
    <h4 class="pb-3 icraf-orange"><strong>Analisis Spasial</strong></h4>
    <p>
        Anda sudah memilih daerah yang akan Anda proses. Detail dari daerah tersebut adalah sebagai berikut.
    </p>
    <div class="row">
        <div class="col-lg-8 p-2">
            <table class="table table-bordered table-striped">
                <tr><td>Provinsi</td><td>{{ $region->nmprov }}</td></tr>
                <tr><td>Kabupaten / Kota</td><td>{{ $region->nmkab }}</td></tr>
                <tr><td>Kecamatan</td><td>{{ $region->nmkec }}</td></tr>
                <tr><td>Desa</td><td>{{ $region->nmdesa }}</td></tr>
                <tr><td>Skema PS tersedia</td><td>{{ str_replace('-', ', ', $region->skema_ps) }}</td></tr>
                <tr><td>Rekomendasi skema PS</td><td>Memiliki potensi perhutanan sosial dengan skema {{ str_replace('-', ', ', $region->skema_ps) }}</td></tr>
            </table>
        </div>
        <div class="col-lg-4 p-2">
            <div id="region-map" class="embed-responsive">
                <iframe title="Detail Daerah Terpilih">Peramban Anda tidak kompatibel</iframe>
            </div>
        </div>
    </div>
    <br>
    <small>Langkah ini diselesaikan pada {{ date('j F Y, H:i:s', strtotime($proposal->step1_completed)) }}</small>
    <div class="d-flex justify-content-end my-2">
        <input type="hidden" id="hdn_urlparam" name="hdn_urlparam" value="{{ $urlparam }}">
        <a class="btn text-white bg-icraf-orange" href="/introduction/{{ $urlparam }}"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Sebelumnya</a>&nbsp;
        <button type="button" id="btn_next" class="btn text-white bg-icraf-orange" onclick="gotoNext(2)">Selanjutnya&nbsp;&nbsp;<i class="fas fa-arrow-right"></i></button>
    </div>
</div>
@stop

@section('customJS')
showSelectedRegionOnMap('{{ $proposal->shpfile_src }}', {{ $region->idd }});
@stop