@extends('partials.menu_tabs')

@section('customCSSLibrary')
<meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('menu_tab_content')
<div class="">
    <h4 class="pb-3"><strong>Konfirmasi Daerah</strong></h4>
    <p>Baru saja, Anda memilih daerah baru dengan detail sebagai berikut.</p>
    <ul>
        <li>Provinsi: {{ $new_region->nmprov }}</li>
        <li>Kabupaten / Kota: {{ $new_region->nmkab }}</li>
        <li>Kecamatan: {{ $new_region->nmkec }}</li>
        <li>Desa: {{ $new_region->nmdesa }}</li>
        <li>Skema PS tersedia: {{ str_replace('-', ', ', $new_region->skema_ps) }}</li>
    </ul>
    <p>Sebelumnya, Anda sudah memproses daerah dengan detail sebagai berikut.</p>
    <ul>
        <li>Provinsi: {{ $old_region->nmprov }}</li>
        <li>Kabupaten / Kota: {{ $old_region->nmkab }}</li>
        <li>Kecamatan: {{ $old_region->nmkec }}</li>
        <li>Desa: {{ $old_region->nmdesa }}</li>
        <li>Skema PS tersedia: {{ str_replace('-', ', ', $old_region->skema_ps) }}</li>
    </ul>
    <p>
        Daerah mana yang akan Anda proses lebih lanjut?<br>
        <input type="radio" id="rdo_region" name="rdo_region" value="keep_{{ $old_region->idd }}">&nbsp;&nbsp;<strong>Lanjutkan</strong> dengan daerah {{ $old_region->nmdesa }}<br>
        <input type="radio" id="rdo_region" name="rdo_region" value="change_{{ $new_region->idd }}">&nbsp;&nbsp;<strong>Ganti</strong> dengan daerah {{ $new_region->nmdesa }} (<em>Perhatian: progress terkait daerah {{ $old_region->nmdesa }} akan <u>dihapus</u></em>)
    </p>
    <button type="button" id="process_region" class="btn btn-primary" onclick="processRegion()"><i class="fas fa-arrow-right"></i> Proses</button>
</div>
@stop