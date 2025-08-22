@extends('partials.menu_tabs')

@section('customCSSLibrary')
<meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('menu_tab_content')
@php
    $answers = json_decode($proposal->step2_answers);
    $result = json_decode($proposal->step3_skemaps);
    $rekom_ps = [];
@endphp
<div class="">
    <input type="hidden" id="hdn_urlparam" name="hdn_urlparam" value="{{ $urlparam }}">
    <h4 class="icraf-orange pb-3"><strong>Ringkasan Hasil</strong></h4>
    <div class="mb-3 bg-light rounded p-3" id="result-step1">
        <h5 class="icraf-green"><strong>Langkah 1: Analisis Spasial</strong></h5>
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
                    <iframe>Peramban Anda tidak kompatibel</iframe>
                </div>
            </div>
        </div>
        <br><small>Langkah ini diselesaikan pada {{ date('j F Y, H:i:s', strtotime($proposal->step1_completed)) }}</small>
    </div>
    <div class="mb-3 bg-light rounded p-3" id="result-step2">
        <h5 class="icraf-green"><strong>Langkah 2: Penapisan</strong></h5>
        @if ($proposal->step2_completed)
            @foreach ($questions as $q)
                @php
                    $code = $q->code;
                @endphp
                <div class="p-1 row">
                    <div class="div-question col-lg-10 border">
                        {{ $loop->iteration }}. {{ $q->content }}
                    </div>
                    <div class="div-answer col-lg-2 px-3 border">
                        {{ $answers->$code }}
                    </div>
                </div>
            @endforeach
            <div class="my-2">Skema PS yang direkomendasikan: <strong class="icraf-orange">{{ str_replace('-', ', ', $proposal->step2_skemaps) }}</strong></div>
            <br><small>Langkah ini diselesaikan pada {{ date('j F Y, H:i:s', strtotime($proposal->step2_completed)) }}</small>
        @elseif (strlen($proposal->step1_skemaps) && count(explode('-', $proposal->step1_skemaps)) == 1)
            <em>Anda tidak melalui Langkah 2.</em>
        @else
            <em>Anda belum menyelesaikan Langkah 2.</em>
        @endif
    </div>
    <div class="mb-3 bg-light rounded p-3" id="result-step3">
        <h5 class="icraf-green"><strong>Langkah 3: Penentuan Preferensi</strong></h5>
        @if ($proposal->step3_completed)
            <div>
                Kriteria yang digunakan: "{{ str_replace(',', '", "', $proposal->step3_ahpcriteria) }}".<br>
                Rekomendasi skema PS beserta bobotnya:
                <table class="table table-bordered table-striped">
                    <tr><th>No</th><th>Skema PS</th><th>Bobot</th></tr>
                    @foreach ($result as $r)
                        @php if ($loop->first) $best_skema = 'Skema PS <strong class="icraf-orange">' . $r->alternative . '</strong> menjadi skema PS yang paling direkomendasikan, dengan nilai bobot sebesar <strong class="icraf-orange">' . $r->weight . '</strong>.'; @endphp
                        <tr><td>{{ $loop->iteration }}</td><td>{{ $r->alternative }}</td><td>{{ $r->weight }}</td></tr>
                        @php array_push($rekom_ps, $r->alternative) @endphp
                    @endforeach
                </table>
                {!! $best_skema !!}
            </div>
            <br><small>Langkah ini diselesaikan pada {{ date('j F Y, H:i:s', strtotime($proposal->step3_completed)) }}</small>
        @elseif ((strlen($proposal->step2_skemaps) && count(explode('-', $proposal->step2_skemaps)) == 1) || (strlen($proposal->step1_skemaps) && count(explode('-', $proposal->step1_skemaps)) == 1))
            <em>Anda tidak melalui Langkah 3.</em>
        @else
            <em>Anda belum menyelesaikan Langkah 3.</em>
        @endif
    </div>
    <div class="mb-3 bg-light rounded p-3" id="result-last">
        <h5 class="icraf-green"><strong>Hasil Akhir</strong></h5>
        @if (strlen($proposal->step1_skemaps) && count(explode('-', $proposal->step1_skemaps)) == '1')
            Berdasarkan <span class="txt-result-green">Analisis Spasial</span>, skema PS yang sesuai dengan daerah yang dipilih adalah <strong class="txt-result-orange">{{ $proposal->step1_skemaps }}.</strong><br><br>
            Proses penentuan skema PS ini telah Anda selesaikan pada {{ date('j F Y, H:i:s', strtotime($proposal->result_completed)) }}.<br><br>
            Silakan lanjutkan proses pengajuan izin PS melalui laman <span class="txt-result-green"><a class="text-white" href="https://akseslahan.lahanuntukkehidupan.id/" target="_blank">>>> Prasyarat Pengajuan >>></a></span>.
        @elseif (strlen($proposal->step2_skemaps) && count(explode('-', $proposal->step2_skemaps)) == '1')
            Berdasarkan <span class="txt-result-green">Analisis Spasial</span> dan <span class="txt-result-green">hasil Penapisan</span>, skema PS yang sesuai dengan daerah yang dipilih adalah <strong class="txt-result-orange">{{ $proposal->step2_skemaps }}.</strong><br><br>
            Proses penentuan skema PS ini telah Anda selesaikan pada {{ date('j F Y, H:i:s', strtotime($proposal->result_completed)) }}.<br><br>
            Silakan lanjutkan proses pengajuan izin PS melalui laman <span class="txt-result-green"><a class="text-white" href="https://akseslahan.lahanuntukkehidupan.id/" target="_blank">>>> Prasyarat Pengajuan >>></a></span>.
        @elseif ($proposal->step3_skemaps)
            @if ($proposal->result_skemaps)
                Berdasarkan <span class="txt-result-green">Analisis Spasial</span>, <span class="txt-result-green">hasil Penapisan</span>, dan <span class="txt-result-green">hasil Penentuan Preferensi</span>, skema PS yang direkomendasikan untuk daerah yang dipilih (diurutkan berdasarkan bobot AHP) adalah <strong class="icraf-orange">{{ implode(', ', $rekom_ps) }}</strong>.<br><br>
                Proses penentuan skema PS ini telah Anda selesaikan dengan memilih skema PS <strong class="txt-result-orange">{{ $proposal->result_skemaps }}</strong>, pada {{ date('j F Y, H:i:s', strtotime($proposal->result_completed)) }}.<br><br>
                Silakan lanjutkan proses pengajuan izin PS melalui laman <span class="txt-result-green"><a class="text-white" href="https://akseslahan.lahanuntukkehidupan.id/" target="_blank">>>> Prasyarat Pengajuan >>></a></span>.
            @else
                Berdasarkan <span class="txt-result-green">Analisis Spasial</span>, <span class="txt-result-green">hasil Penapisan</span>, dan <span class="txt-result-green">hasil Penentuan Preferensi</span>, skema PS yang direkomendasikan untuk daerah yang dipilih (diurutkan berdasarkan bobot Preferensi) adalah <strong class="icraf-orange">{{ implode(', ', $rekom_ps) }}</strong>.<br>
                Anda dipersilakan untuk memilih salah satu dari skema PS yang direkomendasikan.<br><br>
                Jawaban Anda:
                <table class="table table-hover"> @foreach ($rekom_ps as $r) <tr><td><input type="radio" id="rdo_skemaps" name="rdo_skemaps" value="{{ $r }}" onchange="activateSaveBtn()">&nbsp;&nbsp;&nbsp;&nbsp;{{ $r }}</td></tr> @endforeach </table>
                <input type="hidden" id="hdn_proposalID" name="hdn_proposalID" value="{{ $proposal->id }}">
                <button type="button" id="submit_skemaps" class="btn text-white bg-icraf-orange my-2" onclick="finalizeSkemaPS()" disabled><i class="fas fa-save"></i> Simpan</button>
            @endif
        @else
            <em>Hasil Akhir akan ditampilkan di sini.</em>
        @endif
    </div>

    @if ((strlen($proposal->step1_skemaps) && count(explode('-', $proposal->step1_skemaps)) == '1') || (strlen($proposal->step2_skemaps) && count(explode('-', $proposal->step2_skemaps)) == '1') || ($proposal->step3_skemaps && $proposal->result_skemaps))
    <a class="btn bg-icraf-orange text-white" href="#" onclick="exportPDF('{{ base64_encode($proposal->id . '_' . $proposal->user_id . '_' . $proposal->idd) }}', '{{ base64_encode($proposal->shpfile_src) }}', '{{ base64_encode($proposal->idd) }}')"><i class="fas fa-download"></i> Unduh PDF</a>
    @endif
    </div>
</div>
@stop

@section('customJS')
showSelectedRegionOnMap('{{ $proposal->shpfile_src }}', {{ $region->idd }});
@stop
