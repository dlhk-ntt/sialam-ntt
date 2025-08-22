@extends('partials.menu_tabs')

@section('customCSSLibrary')
<meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('menu_tab_content')
@php
    $skemaps = [];
    foreach ($skema_ps as $s) {
        if ($s == 'HA') array_push($skemaps, 'Hutan Adat');
        else if ($s == 'HD') array_push($skemaps, 'Hutan Desa');
        else if ($s == 'HKm') array_push($skemaps, 'Hutan Kemasyarakatan');
        else if ($s == 'HTR') array_push($skemaps, 'Hutan Tanaman Rakyat');
        else if ($s == 'KK') array_push($skemaps, 'Kemitraan Kehutanan');
    }
    $rekomPS = "Memiliki potensi perhutanan sosial dengan skema " . implode(", ", $skemaps);
    $questionCodes = [];
    $prerequisites = [];
    if ($proposal->step2_answers) $answers = json_decode($proposal->step2_answers); else $answers = [];
@endphp
<div class="">
    @if (count(explode('-', $proposal->step1_skemaps)) == 1)
        <em>Langkah ini tidak dilakukan, karena sudah terpilih skema PS yang sesuai.</em>
        <input type="hidden" id="hdn_proposalID" name="hdn_proposalID" value="{{ $proposal->id }}">
        <input type="hidden" id="hdn_urlparam" name="hdn_urlparam" value="{{ $urlparam }}">
    @else
    <h4 class="pb-3 icraf-orange"><strong>Kuesioner Skema Perhutanan Sosial</strong></h4>
    <h5 class="pb-2 icraf-green"><strong>A. Informasi Umum</strong></h5>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-md-4">Provinsi</label>
                <div class="col-md-8">{{ $region->nmprov }}</div>
            </div>
            <div class="form-group row">
                <label class="col-md-4">Kabupaten / Kota</label>
                <div class="col-md-8">{{ $region->nmkab }}</div>
            </div>
            <div class="form-group row">
                <label class="col-md-4">Kecamatan</label>
                <div class="col-md-8">{{ $region->nmkec }}</div>
            </div>
            <div class="form-group row">
                <label class="col-md-4">Desa</label>
                <div class="col-md-8">{{ $region->nmdesa }}</div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-md-4">Kriteria PIAPS</label>
                <div class="col-md-8">{{ implode(', ', $skema_ps) }}</div>
            </div>
            <div class="form-group row">
                <label class="col-md-4">Rekomendasi Skema PS</label>
                <div class="col-md-8">{{ $rekomPS }}</div>
            </div>
        </div>
    </div>
    <hr>
    <h5 class="pb-2 icraf-green"><strong>B. Pengantar Kuesioner</strong></h5>
    <div id="accordion">
        <div class="card card-primary">
            <div class="card-header bg-icraf-green collapsed" data-toggle="collapse" href="#collapseOne" aria-expanded="false">
                <a>Sekilas Perhutanan Sosial</a>
            </div>
            <div id="collapseOne" class="collapse" data-parent="#accordion" style="">
                <div class="card-body">
                    <p>
                        Program Perhutanan Sosial menjadi kebijakan pemerintah dalam rangka memberikan akses legal kepada masyarakat untuk mengelola kawasan hutan. Tujuan utama program tersebut adalah tercapainya kelestarian hutan baik lestari secara sosial, ekologi, maupun ekonomi. Terdapat sejumlah skema pengelolaan dalam program perhutanan sosial, diantaranya: <strong>Hutan Desa (HD)</strong>, <strong>Hutan Kemasyarakatan (HKm)</strong>, <strong>Hutan Tanaman Rakyat (HTR)</strong>, <strong>Kemitraan Kehutanan (KK)</strong>, dan <strong>Hutan Adat (HA)</strong>.
                    </p>
                    <p>
                    Pada proses pengajuan usulan Perhutanan Sosial (PS), seringkali masyarakat calon pengaju menghadapi kebingungan untuk memilih skema mana yang sesuai dengan regulasi dan kondisi areal setempat. Hal tersebut disebabkan oleh minimnya pengetahuan masyarakat, terbatasnya akses informasi, dan kurangnya pendampingan yang optimal.
                    </p>
                </div>
            </div>
        </div>
        <div class="card card-primary">
            <div class="card-header bg-icraf-green collapsed" data-toggle="collapse" href="#collapseTwo">
                <a>Penjelasan singkat dan definisi skema PS</a>
            </div>
            <div id="collapseTwo" class="collapse" data-parent="#accordion">
                <div class="card-body">
                    <ul>
                        <li><strong>Hutan Desa (HD)</strong> adalah kawasan hutan yang belum dibebani izin, yang dikelola oleh desa dan dimanfaatkan untuk kesejahteraan desa.</li>
                        <li><strong>Hutan Kemasyarakatan (HKm)</strong> adalah kawasan hutan yang pemanfaatan utamanya ditujukan untuk memberdayakan masyarakat.</li>
                        <li><strong>Hutan Tanaman Rakyat (HTR)</strong> adalah hutan tanaman pada Hutan Produksi yang dibangun oleh kelompok Masyarakat untuk meningkatkan potensi dan kualitas Hutan Produksi dengan menerapkan sistem silvikultur dalam rangka menjamin kelestarian sumber daya hutan.</li>
                        <li><strong>Hutan Adat (HA)</strong> adalah hutan yang berada di dalam wilayah Masyarakat Hukum Adat.</li>
                        <li><strong>Persetujuan Pengelolaan HD</strong> adalah akses legal yang diberikan oleh Menteri kepada Lembaga Desa untuk mengelola dan/atau memanfaatkan hutan pada kawasan Hutan Lindung dan/atau kawasan Hutan Produksi.</li>
                        <li><strong>Persetujuan Pengelolaan HKm</strong> adalah akses legal yang diberikan oleh Menteri kepada perorangan, kelompok tani, gabungan kelompok tani hutan atau koperasi Masyarakat Setempat untuk mengelola dan/atau memanfaatkan hutan pada kawasan Hutan Lindung dan/atau kawasan Hutan Produksi.</li>
                        <li><strong>Persetujuan Pengelolaan HTR</strong> adalah akses legal yang diberikan oleh Menteri kepada kelompok tani hutan, gabungan kelompok tani hutan, koperasi tani hutan, profesional kehutanan atau perorangan untuk memanfaatkan hasil hutan berupa kayu dan hasil hutan ikutannya pada kawasan Hutan Produksi dengan menerapkan teknik budidaya tanaman (silvikultur) yang sesuai tapaknya untuk menjamin kelestarian sumber daya hutan.</li>
                        <li><strong>Persetujuan Kemitraan Kehutanan</strong> adalah persetujuan kemitraan yang diberikan kepada pemegang perizinan berusaha Pemanfaatan Hutan atau pemegang persetujuan penggunaan kawasan hutan dengan mitra/Masyarakat untuk memanfaatkan hutan pada kawasan Hutan Lindung atau kawasan Hutan Produksi.</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card card-primary">
            <div class="card-header bg-icraf-green collapsed" data-toggle="collapse" href="#collapseThree">
                <a>Tujuan pengisian kuisoner</a>
            </div>
            <div id="collapseThree" class="collapse" data-parent="#accordion">
                <div class="card-body">
                    Kuesioner ini hadir dalam rangka membantu masyarakat hutan calon pengusul Perhutanan Sosial untuk memilih dan menentukan skema pengelolaan yang sesuai dengan regulasi dan kondisi lokasi setempat.
                </div>
            </div>
        </div>
    </div>
    <hr>
    <h5 class="pb-2 icraf-green" id="questionnaire-questions"><strong>C. Pertanyaan Penapisan Kuesioner</strong></h5>
    <p>Silakan menjawab pertanyaan di bawah ini, dengan mempertimbangkan situasi dan kondisi calon lokasi/areal yang akan Anda usulkan untuk persetujuan Perhutanan Sosial.<br>Jawablah dengan memilih salah satu dari <strong>Ya</strong> atau <strong>Tidak</strong>.</p>
    <div class="mb-3 bg-light rounded p-3">
        @foreach ($questions as $q)
            @php
                $code = $q->code;
                array_push($questionCodes, $code);
                $prerequisites[$code] = $q->prerequisite;
            @endphp
            <div class="p-1 row">
                <div id="question-{{ $q->code }}" class="div-question col-lg-9 col-xl-10 border">
                    {{ $loop->iteration }}. [{{ $q->code }}] {{ $q->content }}<br>
                    <small class="questionnaire-legal text-secondary d-block p-1">Referensi: {{ $q->legal_reference }}</small>
                </div>
                <div class="div-answer col-lg-3 col-xl-2 px-2 border">
                    <input type="radio" id="rdo_{{ $q->code }}" name="rdo_{{ $q->code }}" class="rdo-questionnaire" value="Ya" onchange="updateQuestions()" @if ($answers && $answers->$code == 'Ya') checked @endif> <div class="opt opt-{{ $q->code }} opt-yes bg-primary text-white my-1 px-2 d-inline-block text-center rounded">Ya</div>
                    &nbsp;
                    <input type="radio" id="rdo_{{ $q->code }}" name="rdo_{{ $q->code }}" class="rdo-questionnaire" value="Tidak" onchange="updateQuestions()" @if ($answers && $answers->$code == 'Tidak') checked @endif> <div class="opt opt-{{ $q->code }} opt-no bg-danger text-white my-1 px-2 d-inline-block text-center rounded">Tidak</div>
                </div>
            </div>
        @endforeach
    </div>
    <input type="hidden" id="hdn_proposalID" name="hdn_proposalID" value="{{ $proposal->id }}">
    <input type="hidden" id="hdn_questionCodes" name="hdn_questionCodes" value="{{ implode(',', $questionCodes) }}">
    <input type="hidden" id="hdn_cntQuestions" name="hdn_cntQuestions" value="{{ count($questionCodes) }}">
    <input type="hidden" id="hdn_skemaps" name="hdn_skemaps" value="{{ implode(',', $skema_ps) }}">
    <input type="hidden" id="hdn_idd" name="hdn_idd" value="{{ $proposal->idd }}">
    <input type="hidden" id="hdn_urlparam" name="hdn_urlparam" value="{{ $urlparam }}">
    @if (!$proposal->step2_completed)
    <div class="d-flex justify-content-end my-2">
        <button type="button" id="submit_step2" class="btn text-white bg-icraf-orange" onclick="processQuestionnaire()"><i class="fas fa-play"></i>&nbsp;&nbsp;Proses</button>
    </div>
    @endif
    <hr>
    <h5 class="pb-2 icraf-green"><strong>D. Hasil Penilaian Penapisan</strong></h5>
    <div class="mb-3 bg-light rounded p-3" id="questionnaire-result">
        @if (strlen($proposal->step2_skemaps))
            @php
                if ($proposal->step2_skemaps != '-') {
                    $txt1 = 'Berdasarkan hasil pengisian kuesioner di atas, skema PS yang direkomendasikan adalah <strong>' . str_replace('-', ', ', $proposal->step2_skemaps) . '</strong>.<br>';
                } else {
                    $txt1 = 'Berdasarkan hasil pengisian kuesioner di atas, tidak ada skema PS yang dapat direkomendasikan.<br>';
                }
                $why_excluded = '';
                if (!(strpos($proposal->step2_skemaps, 'HA') > -1) && in_array('HA', $skema_ps)) {
                    $why_excluded .= '<div class="card card-primary"><div class="card-header bg-icraf-orange collapsed" data-toggle="collapse" href="#collapseHA"><a>Skema <strong>Hutan Adat (HA)</strong> tidak direkomendasikan, kemungkinan karena beberapa faktor:</a></div><div id="collapseHA" class="collapse" data-parent="#why"><div class="card-body"><ol><li>Belum ada MHA (Masyarakat Hukum Adat) yang ditetapkan dengan Perda (jika MHA berada di dalam kawasan hutan negara), atau Perda atau Keputusan Gubernur dan/atau Bupati/Walikota (jika MHA di luar kawasan hutan) [<a href="#" onClick="gotoQuestion(\'K\')">Pertanyaan K</a>]; <strong>atau</strong></li><li>MHA tersebut tidak tinggal di dalam kawasan hutan atau areal yang akan diusulkan, serta belum lama memanfaatkannya [<a href="#" onClick="gotoQuestion(\'L\')">Pertanyaan L</a>]</li></ol></div></div></div>';
                }
                if (!(strpos($proposal->step2_skemaps, 'HD') > -1) && in_array('HD', $skema_ps)) {
                    $why_excluded .= '<div class="card card-primary"><div class="card-header bg-icraf-orange collapsed" data-toggle="collapse" href="#collapseHD"><a>Skema <strong>Hutan Desa (HD)</strong> tidak direkomendasikan, kemungkinan karena beberapa faktor:</a></div><div id="collapseHD" class="collapse" data-parent="#why"><div class="card-body"><ol><li>Areal yang Anda usulkan tidak berada di dalam wilayah desa Anda, atau merupakan areal hasil kesepakatan batas pengelolaan antara desa yang berdampingan dengan desa Anda [<a href="#" onClick="gotoQuestion(\'A\')">Pertanyaan A</a>, <a href="#" onClick="gotoQuestion(\'B\')">Pertanyaan B</a>];</li><li>Anda tidak mengusulkan melalui lembaga desa/kelurahan, yang dibentuk melalui peraturan yang berlaku [<a href="#" onClick="gotoQuestion(\'C\')">Pertanyaan C</a>, <a href="#" onClick="gotoQuestion(\'D\')">Pertanyaan D</a>];</li><li>Areal berada di dalam kawasan yang telah dibebani perizinan berusaha pemanfaatan hutan, atau dibebani persetujuan penggunaan kawasan hutan [<a href="#" onClick="gotoQuestion(\'G\')">Pertanyaan G</a>, <a href="#" onClick="gotoQuestion(\'H\')">Pertanyaan H</a>];</li><li>Areal tidak berada di dalam satu kesatuan lansekap/bentang alam [<a href="#" onClick="gotoQuestion(\'M\')">Pertanyaan M</a>]; <strong>atau</strong></li><li>Areal belum dimanfaatkan oleh warga setempat [<a href="#" onClick="gotoQuestion(\'N\')">Pertanyaan N</a>]</li></ol></div></div></div>';
                }
                if (!(strpos($proposal->step2_skemaps, 'HKm') > -1) && in_array('HKm', $skema_ps)) {
                    $why_excluded .= '<div class="card card-primary"><div class="card-header bg-icraf-orange collapsed" data-toggle="collapse" href="#collapseHKm"><a>Skema <strong>Hutan Kemasyarakatan (HKm)</strong> tidak direkomendasikan, kemungkinan karena beberapa faktor:</a></div><div id="collapseHKm" class="collapse" data-parent="#why"><div class="card-body"><ol><li>Areal berada di dalam kawasan yang telah dibebani perizinan berusaha pemanfaatan hutan, atau dibebani persetujuan penggunaan kawasan hutan [<a href="#" onClick="gotoQuestion(\'G\')">Pertanyaan G</a>, <a href="#" onClick="gotoQuestion(\'H\')">Pertanyaan H</a>]; <strong>atau</strong></li><li>Areal belum dimanfaatkan oleh warga setempat [<a href="#" onClick="gotoQuestion(\'N\')">Pertanyaan N</a>]</li></ol></div></div></div>';
                }
                if (!(strpos($proposal->step2_skemaps, 'HTR') > -1) && in_array('HTR', $skema_ps)) {
                    $why_excluded .= '<div class="card card-primary"><div class="card-header bg-icraf-orange collapsed" data-toggle="collapse" href="#collapseHTR"><a>Skema <strong>Hutan Tanaman Rakyat (HTR)</strong> tidak direkomendasikan, kemungkinan karena beberapa faktor:</a></div><div id="collapseHTR" class="collapse" data-parent="#why"><div class="card-body"><ol><li>Khusus skema HTR, areal yang hendak diusulkan sebagai Perhutanan Sosial tidak diperbolehkan berada di areal Gambut [<a href="#" onClick="gotoQuestion(\'E\')">Pertanyaan E</a>];</li><li>Areal yang Anda usulkan merupakan areal yang tidak produktif dengan tutupan lahan rendah sampai sedang [<a href="#" onClick="gotoQuestion(\'F\')">Pertanyaan F</a>];</li><li>Areal berada di dalam kawasan yang telah dibebani perizinan berusaha pemanfaatan hutan, atau dibebani persetujuan penggunaan kawasan hutan [<a href="#" onClick="gotoQuestion(\'G\')">Pertanyaan G</a>, <a href="#" onClick="gotoQuestion(\'H\')">Pertanyaan H</a>];</li><li>Areal tidak berada di dalam satu kesatuan lansekap/bentang alam [<a href="#" onClick="gotoQuestion(\'M\')">Pertanyaan M</a>];</li><li>Areal sudah dimanfaatkan oleh warga setempat [<a href="#" onClick="gotoQuestion(\'N\')">Pertanyaan N</a>]; <strong>atau</strong></li><li>Pada areal terpilih terdapat tegakan sawit, dan sudah dikelola oleh masyarakat (perseorangan) yang telah tinggal di dalam dan/atau sekitar kawasan tersebut selama minimal 5 tahun secara terus menerus [<a href="#" onClick="gotoQuestion(\'O\')">Pertanyaan O</a>]</li></ol></div></div></div>';
                }
                if (!(strpos($proposal->step2_skemaps, 'KK') > -1) && in_array('KK', $skema_ps)) {
                    $why_excluded .= '<div class="card card-primary"><div class="card-header bg-icraf-orange collapsed" data-toggle="collapse" href="#collapseKK"><a>Skema <strong>Kemitraan Kehutanan (KK)</strong> tidak direkomendasikan, kemungkinan karena beberapa faktor:</a></div><div id="collapseKK" class="collapse" data-parent="#why"><div class="card-body"><ol><li>Areal tidak berada di dalam kawasan yang telah dibebani perizinan berusaha pemanfaatan hutan, atau dibebani persetujuan penggunaan kawasan hutan [<a href="#" onClick="gotoQuestion(\'G\')">Pertanyaan G</a>, <a href="#" onClick="gotoQuestion(\'H\')">Pertanyaan H</a>];</li><li>Areal yang Anda usulkan tidak memiliki potensi menjadi sumber penghidupan masyarakat setempat [<a href="#" onClick="gotoQuestion(\'I\')">Pertanyaan I</a>];</li><li>Areal yang Anda usulkan bukan merupakan areal konflik atau berpotensi konflik (persoalan masalah pemanfaatan, baik tumpang tindih lahan atau perbedaan hak akses pemanfaatan) [<a href="#" onClick="gotoQuestion(\'J\')">Pertanyaan J</a>]; <strong>atau</strong></li><li>Areal sudah dimanfaatkan oleh warga setempat [<a href="#" onClick="gotoQuestion(\'N\')">Pertanyaan N</a>]</li></ol></div></div></div>';
                }
                if (!$proposal->step2_completed) {
                    $txtUbah = 'Jika Anda ingin mengubah jawaban kuesioner, silakan klik Ubah Jawaban. ';
                    $btnUbah = '<button type="button" id="edit_step2" class="btn btn-primary mb-1" onclick="openQuestionnaire()"><i class="fas fa-edit"></i>&nbsp;&nbsp;Ubah Jawaban</button> ';
                    if ($proposal->step2_skemaps != '-') {
                        $txtLanjut = 'Jika Anda merasa jawaban kuesioner sudah sesuai, silakan klik Lanjut. ';
                        $btnLanjut = '<button type="button" id="proceed_step2" class="btn btn-success mb-1" onclick="finalizeQuestionnaire()"><i class="fas fa-angle-double-right"></i>&nbsp;&nbsp;Lanjut</button>';
                    } else {
                        $txtLanjut = '';
                        $btnLanjut = '';
                    }
                } else {
                    $txtUbah = ''; $btnUbah = ''; $txtLanjut = ''; $btnLanjut = '';
                }
            @endphp
            {!! $txt1 !!}
            @if (strlen($why_excluded)) <div id="why" class="p-3">{!! $why_excluded !!}</div> @endif
            {!! $txtUbah . $txtLanjut !!}
            @if (strlen($btnUbah) || strlen($btnLanjut)) <br><br> @endif
            {!! $btnUbah . $btnLanjut !!}
            @if ($proposal->step2_completed) <br><small>Langkah ini diselesaikan pada {{ date('j F Y, H:i:s', strtotime($proposal->step2_completed)) }}</small> @endif
        @else
            <em>Hasil penilaian penapisan akan ditampilkan di sini.</em>
        @endif
    </div>
    @endif
    <div class="d-flex justify-content-end my-2">
        <a class="btn text-white bg-icraf-orange" href="/step-1/{{ $urlparam }}"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Sebelumnya</a>&nbsp;
        <button type="button" id="btn_next" class="btn text-white bg-icraf-orange" onclick="gotoNext(3)" @if (!$proposal->step2_completed && !(strlen($proposal->step1_skemaps) && count(explode('-', $proposal->step1_skemaps)) == 1)) disabled @endif >Selanjutnya&nbsp;&nbsp;<i class="fas fa-arrow-right"></i></button>
    </div>
</div>
@stop

@section('customJS')
prerequisites = JSON.parse('{!! str_replace('"{', '{', str_replace('}"', '}', json_encode($prerequisites))) !!}');
@if (strlen($proposal->step2_skemaps) || $proposal->status == 'cancelled')
    $('input[class=rdo-questionnaire]').prop('disabled', 'disabled');
    $('#submit_step2').prop('disabled', 'disabled');
    $('.opt-yes').removeClass('bg-primary').addClass('bg-secondary');
    $('.opt-no').removeClass('bg-danger').addClass('bg-secondary');
@endif
@stop
