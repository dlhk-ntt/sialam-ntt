<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ringkasan Hasil :: {{ Cache::get('app')->code }}</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Archivo:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lexend:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{ public_path('adminlte') }}/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="{{ public_path('adminlte') }}/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="{{ public_path('styles') }}/print.css">
  <link rel="stylesheet" href="{{ public_path('leaflet/dist/leaflet.css') }}"/>
</head>
<body class="hold-transition layout-top-nav layout-navbar-fixed">
    @php
        $desc_skemaps = [
            'HA' => 'Hutan Adat',
            'HD' => 'Hutan Desa',
            'HKm' => 'Hutan Kemasyarakatan',
            'HTR' => 'Hutan Tanaman Rakyat',
            'KK' => 'Kemitraan Kehutanan',
        ];
        $answers = json_decode($proposal->step2_answers);
        $result = json_decode($proposal->step3_skemaps);
        $rekom_ps = [];
    @endphp
    <div class="">
        <footer class="icraf-green">
            <small style="font-style: italic">Lembar ringkasan hasil ini dicetak pada {{ date('j F Y, H:i:s') }}</small>
        </footer>
        <div style="text-align: right;">
            <img src="{{ public_path('img') }}/{{ strlen(Cache::get('app')->logo) ? Cache::get('app')->logo : 'NO_IMAGE.png' }}" style="width: 100px;">
        </div>
        Yang kami hormati,<br>
        <div id="address" class="bg-icraf-orange text-white d-inline-block">
            <strong>Bapak / Ibu {{ $user->name }} [{{ $user->username }}]</strong><br>
            <span class="address-in">Desa {{ strlen($user->desa) ? $user->desa : '-' }}, Kecamatan {{ strlen($user->kecamatan) ? $user->kecamatan : '-' }}</span><br>
            <span class="address-in">Kabupaten / Kota {{ strlen($user->kabkota) ? $user->kabkota : '-' }}, Provinsi {{ strlen($user->provinsi) ? $user->provinsi : '-' }}</span><br>
            <span class="address-in">No. Telepon: {{ $user->phone_no }}, Email: {{ $user->email }}
        </div><br>
        Anda telah menyelesaikan proses penentuan skema Perhutanan Sosial untuk daerah yang Anda pilih. Berikut merupakan ringkasan hasil dari proses yang telah Anda lalui.
        <hr>
        <h4 class="icraf-orange pb-3"><strong>Ringkasan Hasil</strong></h4>
        <div class="mb-3 bg-light rounded p-3" id="result-step1">
            <h5 class="icraf-green"><strong>Langkah 1: Analisis Spasial</strong></h5>
            @php
                $txt_skemaps = '';
                $arr_skemaps = explode('-', $region->skema_ps);
                foreach ($arr_skemaps as $key => $value) {
                    if ($key > 0) $txt_skemaps .= ', ' . $desc_skemaps[$value];
                        else $txt_skemaps = $desc_skemaps[$value];
                }
            @endphp
            <div class="row">
                <div class="col">
                    <table class="table table-bordered table-striped" style="width: 670px">
                        <tr><td style="width: 185px">Provinsi</td><td>{{ $region->nmprov }}</td></tr>
                        <tr><td>Kabupaten / Kota</td><td>{{ $region->nmkab }}</td></tr>
                        <tr><td>Kecamatan</td><td>{{ $region->nmkec }}</td></tr>
                        <tr><td>Desa</td><td>{{ $region->nmdesa }}</td></tr>
                        <tr><td>Skema PS tersedia</td><td>{{ str_replace('-', ', ', $region->skema_ps) }}</td></tr>
                        <tr><td>Rekomendasi skema PS</td><td>Memiliki potensi perhutanan sosial dengan skema {{ $txt_skemaps }}</td></tr>
                        <tr><td>Peta daerah</td><td><img src="{{ public_path('map') }}/{{ $map->id }}/{{ base64_encode($proposal->idd) }}.png" style="height: 200px"></td></tr>
                    </table>
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
                    <div class="py-1 row">
                        <div class="div-question col-lg-10">
                            {{ $loop->iteration }}. {{ $q->content }}
                        </div>
                        <div class="div-answer col-lg-2 px-4">
                            &raquo; {{ $answers->$code }}
                        </div>
                    </div>
                @endforeach
                @php
                    $txt_skemaps = '';
                    $arr_skemaps = explode('-', $proposal->step2_skemaps);
                    foreach ($arr_skemaps as $key => $value) {
                        if ($key > 0) $txt_skemaps .= ', ' . $desc_skemaps[$value];
                            else $txt_skemaps = $desc_skemaps[$value];
                    }
                @endphp
                <div class="my-2">Skema PS yang direkomendasikan: <strong class="icraf-orange">{{ $txt_skemaps }}</strong></div>
                <br><small>Langkah ini diselesaikan pada {{ date('j F Y, H:i:s', strtotime($proposal->step2_completed)) }}</small>
            @elseif (strlen($proposal->step1_skemaps) && count(explode('-', $proposal->step1_skemaps)) == 1)
                <em>Anda tidak melalui Langkah 2.</em>
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
                            @php if ($loop->first) $best_skema = 'Skema PS <strong class="icraf-orange">' . $desc_skemaps[$r->alternative] . '</strong> menjadi skema PS yang paling direkomendasikan, dengan nilai bobot sebesar <strong class="icraf-orange">' . $r->weight . '</strong>.'; @endphp
                            <tr><td>{{ $loop->iteration }}</td><td>{{ $desc_skemaps[$r->alternative] }}</td><td>{{ $r->weight }}</td></tr>
                            @php array_push($rekom_ps, $desc_skemaps[$r->alternative]) @endphp
                        @endforeach
                    </table>
                    {!! $best_skema !!}
                </div>
                <br><small>Langkah ini diselesaikan pada {{ date('j F Y, H:i:s', strtotime($proposal->step3_completed)) }}</small>
            @elseif ((strlen($proposal->step2_skemaps) && count(explode('-', $proposal->step2_skemaps)) == 1) || (strlen($proposal->step1_skemaps) && count(explode('-', $proposal->step1_skemaps)) == 1))
                <em>Anda tidak melalui Langkah 3.</em>
            @endif
        </div>
        <div class="mb-3 bg-light rounded p-3" id="result-last">
            <h5 class="icraf-green"><strong>Hasil Akhir</strong></h5>
            @if (strlen($proposal->step1_skemaps) && count(explode('-', $proposal->step1_skemaps)) == '1')
                Berdasarkan <span class="txt-result-green">Analisis Spasial</span>, skema PS yang sesuai dengan daerah yang dipilih adalah <strong class="txt-result-orange">{{ $desc_skemaps[$proposal->step1_skemaps] }}.</strong><br><br>
                Proses penentuan skema PS ini telah Anda selesaikan pada {{ date('j F Y, H:i:s', strtotime($proposal->result_completed)) }}.
            @elseif (strlen($proposal->step2_skemaps) && count(explode('-', $proposal->step2_skemaps)) == '1')
                Berdasarkan <span class="txt-result-green">Analisis Spasial</span> dan <span class="txt-result-green">hasil Penapisan</span>, skema PS yang sesuai dengan daerah yang dipilih adalah <strong class="txt-result-orange">{{ $desc_skemaps[$proposal->step2_skemaps] }}.</strong><br><br>
                Proses penentuan skema PS ini telah Anda selesaikan pada {{ date('j F Y, H:i:s', strtotime($proposal->result_completed)) }}.
            @elseif ($proposal->step3_skemaps && $proposal->result_skemaps)
                Berdasarkan <span class="txt-result-green">Analisis Spasial</span>, <span class="txt-result-green">hasil Penapisan</span>, dan <span class="txt-result-green">hasil Penentuan Preferensi</span>, skema PS yang direkomendasikan untuk daerah yang dipilih (diurutkan berdasarkan bobot AHP) adalah <strong class="icraf-orange">{{ implode(', ', $rekom_ps) }}</strong>.<br><br>
                Proses penentuan skema PS ini telah Anda selesaikan dengan memilih skema PS <strong class="txt-result-orange">{{ $desc_skemaps[$proposal->result_skemaps] }}</strong>, pada {{ date('j F Y, H:i:s', strtotime($proposal->result_completed)) }}.
            @endif
        </div>
        <div>
            <div style="text-align: right">
                <div>
                    <img src="{{ public_path('img/Canada.png') }}" alt="Logo" class="instances-logo p-2">
                    <img src="{{ public_path('img/CIFOR.png') }}" alt="Logo" class="instances-logo p-2">
                    <img src="{{ public_path('img/ICRAF.png') }}" alt="Logo" class="instances-logo p-2">
                    <img src="{{ public_path('img/HastagL4L.png') }}" alt="Logo" class="instances-logo p-2">
                </div>
            </div>
        </div>
    </div>
    <footer class="icraf-green">
        <small style="font-style: italic">Lembar ringkasan hasil ini dicetak pada {{ date('j F Y, H:i:s') }}</small>
    </footer>
</body>
</html>
