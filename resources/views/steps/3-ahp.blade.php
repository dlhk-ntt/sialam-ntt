@extends('partials.menu_tabs')

@section('customCSSLibrary')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>.card {margin-bottom: 0.25rem; } .table td { padding: 0.5rem; } </style>
@stop

@section('menu_tab_content')
@php
    if (strlen($proposal->step3_ahpcriteria)) {
        $criteria = explode(',', $proposal->step3_ahpcriteria);
    } else {
        // $criteria = ['Sosial Budaya','Ekonomi','Lingkungan'];
        $criteria = [];
    }
    $alternative = explode('-', $proposal->step2_skemaps);
    $weight_criteria = json_decode($proposal->step3_ahpcomparison);
    $weight_alternative = json_decode($proposal->step3_ahpweight);
    $result = json_decode($proposal->step3_skemaps);
    $CR_alternative = json_decode($proposal->step3_ahpCRalternative);
    $set_pairwise = '';
    // dd($result);
    $idxCriteria = 0;
    $maxCriteria = 15; // TODO: dipindah ke halaman admin?
@endphp
<div class="">
    @if ((strlen($proposal->step2_skemaps) && count(explode('-', $proposal->step2_skemaps)) == 1) || strlen($proposal->step1_skemaps) && count(explode('-', $proposal->step1_skemaps)) == 1)
        <em>Langkah ini tidak dilakukan, karena sudah terpilih skema PS yang sesuai.</em>
        <input type="hidden" id="hdn_proposalID" name="hdn_proposalID" value="{{ $proposal->id }}">
        <input type="hidden" id="hdn_urlparam" name="hdn_urlparam" value="{{ $urlparam }}">
    @elseif (!strlen($proposal->step2_skemaps) && !$proposal->step2_completed)
        <em>Langkah ini belum dapat dilakukan, karena Langkah 2 belum diselesaikan.</em>
        <input type="hidden" id="hdn_proposalID" name="hdn_proposalID" value="{{ $proposal->id }}">
        <input type="hidden" id="hdn_urlparam" name="hdn_urlparam" value="{{ $urlparam }}">
    @else
    <h4 class="pb-3 icraf-orange"><strong>Penentuan Preferensi</strong></h4>
    <p>Halaman Ini merupakan halaman yang ditujukan untuk memudahkan pengguna melakukan Penentuan Preferensi terhadap skema perhutanan sosial yang akan dipilih. Ditujukan untuk melakukan penilaian kecenderungan untuk memilih skema PS yang lebih disukai berdasarkan berbagai kriteria yang telah ditentukan. Terdapat beberapa tahapan yang akan dilakukan:</p>
    <ol>
        <li>Menentukan tujuan pengajuan Perhutanan Sosial</li>
        <li>Menentukan kriteria yang akan digunakan sebagai pertimbangan pemilihan skema PS terhadap tujuan yang telah ditentukan (jumlah kriteria dapat disesuaikan)</li>
        <li>Melakukan penilaian perbandingan antar kriteria yang telah ditentukan dengan cara memilih bobot sesuai dengan pertimbangan pengguna</li>
        <li>Melakukan Perbandingan Berpasangan untuk Alternatif Skema PS terhadap Setiap Kriteria yang telah ditentukan dengan cara memilih bobot sesuai dengan pertimbangan pengguna</li>
    </ol>
    <h5 class="icraf-green"><strong>Tujuan AHP</strong></h5>
    <p>Menentukan skema Perhutanan Sosial terbaik untuk daerah yang sudah dipilih pada langkah sebelumnya.</p>
    <h5 class="icraf-green"><strong>Detail Daerah Terpilih</strong></h5>
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
                <label class="col-md-6">Skema PS (dari data spasial)</label>
                <div class="col-md-6">{{ str_replace('-', ', ', $proposal->step1_skemaps) }}</div>
            </div>
            <div class="form-group row">
                <label class="col-md-6">Skema PS (dari pengisian kuesioner)</label>
                <div class="col-md-6">{{ str_replace('-', ', ', $proposal->step2_skemaps) }}</div>
            </div>
        </div>
    </div>
    <h5 class="icraf-green"><strong>Alternatif Skema PS yang Mungkin Terpilih</strong></h5>
    <p id="lst-alternatives">{{ str_replace('-', ', ', $proposal->step2_skemaps) }}</p>
    <hr>
    <div class="p-2 border mb-3">
        <h5 class="icraf-green"><strong>Tujuan Pengajuan Perhutanan Sosial</strong></h5>
        <p>Deskripsikan tujuan pengajuan perhutanan dengan singkat dan jelas</p>
        <textarea id="txt_objective" class="form-control" rows="3" style="resize:none" placeholder="Tujuan spesifik pengajuan akses lahan adalah untuk ...">{{ strlen($proposal->step3_ahpobjective) ? $proposal->step3_ahpobjective : '' }}</textarea>
    </div>
    <div class="p-2 border mb-3">
        <h5 id="ahp-criteria" class="icraf-green"><strong>Kriteria yang Terlibat</strong></h5>
        <p>Tentukan opsi kriteria yang akan digunakan sebagai pertimbangan pemilihan skema PS berdasarkan tujuan pengajuan. Contoh opsi kriteria: Faktor Sosial, Faktor Ekonomi, dan Faktor Budaya</p>
        <button id="btn_criteria" type="button" class="btn text-white bg-icraf-orange btn-sm" onclick="addToAHP('criteria', {{ $maxCriteria }})"><i class="fas fa-plus"></i> Tambah</button>
        <table class="table table-borderless" id="tbl_criteria">
            @foreach ($criteria as $c)
                <tr id="tr_criteria_{{ $idxCriteria }}">
                    <td><input type="text" id="inp_criteria_{{ $idxCriteria }}" name="inp_criteria_{{ $idxCriteria }}" class="form-control" value="{{ $c }}" onchange="AHPShowHideCriteria({{ $idxCriteria }})"></td>
                </tr>
                @php $idxCriteria++; @endphp
            @endforeach
        </table>
    </div>
    <div class="p-2 border mb-3">
        <h5 class="icraf-green"><strong>Perbandingan Berpasangan untuk Kriteria sehubungan dengan Tujuan</strong></h5>
        <p>Tentukan prioritas pemilihan alternatif skema PS terhadap setiap kriteria berdasarkan tujuan yang ingin dicapai dengan pemberian bobot atau nilai. Seluruh kombinasi alternatif pasangan skema PS untuk setiap kriteria disajikan dalam matriks perbandingan berpasangan.</p>
        <div id="accordion-criteria">
            <div class="card card-primary">
                <div class="card-header bg-icraf-green">
                    <h4 class="card-title w-100">
                        <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapse-comparisoncriteria" aria-expanded="false">Perbandingan Antar Kriteria</a>
                    </h4>
                </div>
                <div id="collapse-comparisoncriteria" class="collapse" data-parent="#accordion-criteria" style="">
                    <div class="card-body">
                        @for ($i = 0; $i < $maxCriteria; $i++)
                            @for ($j = $i; $j < $maxCriteria; $j++)
                                @if ($i != $j)
                                <div class="pairwise-slider border p-1 mb-2 comp-{{ $i }} comp-{{ $j }}">
                                    <div class="row">
                                        <div class="col-1 text-left text-wrap align-top"><strong><span class="criteria-{{ $i }}">{{ isset($criteria[$i]) ? $criteria[$i] : '' }}</span></strong></div>
                                        <div class="col-1 text-center text-wrap align-top">
                                            <input type="radio" id="rdo_{{ $i }}_{{ $j }}" name="rdo_{{ $i }}_{{ $j }}" class="rdo-pairwise" value="9_1" onchange="updatePairwiseWeight2('tbl', {{ $i }}, {{ $j }}, 9, '1');updatePairwiseText('text', {{ $i }}, {{ $j }}, 9, '1')"><br>
                                                <small><strong>9</strong> - "mutlak lebih penting"</small>
                                        </div>
                                        <div class="col-1 text-center text-wrap align-top">
                                            <input type="radio" id="rdo_{{ $i }}_{{ $j }}" name="rdo_{{ $i }}_{{ $j }}" class="rdo-pairwise" value="7_1" onchange="updatePairwiseWeight2('tbl', {{ $i }}, {{ $j }}, 7, '1');updatePairwiseText('text', {{ $i }}, {{ $j }}, 7, '1')"><br>
                                                <small><strong>7</strong> - "sangat lebih penting"</small>
                                        </div>
                                        <div class="col-1 text-center text-wrap align-top">
                                            <input type="radio" id="rdo_{{ $i }}_{{ $j }}" name="rdo_{{ $i }}_{{ $j }}" class="rdo-pairwise" value="5_1" onchange="updatePairwiseWeight2('tbl', {{ $i }}, {{ $j }}, 5, '1');updatePairwiseText('text', {{ $i }}, {{ $j }}, 5, '1')"><br>
                                                <small><strong>5</strong> - "lebih penting"</small>
                                        </div>
                                        <div class="col-1 text-center text-wrap align-top">
                                            <input type="radio" id="rdo_{{ $i }}_{{ $j }}" name="rdo_{{ $i }}_{{ $j }}" class="rdo-pairwise" value="3_1" onchange="updatePairwiseWeight2('tbl', {{ $i }}, {{ $j }}, 3, '1');updatePairwiseText('text', {{ $i }}, {{ $j }}, 3, '1')"><br>
                                                <small><strong>3</strong> - "sedikit lebih penting"</small>
                                        </div>
                                        <div class="col-1 text-center text-wrap align-top border">
                                            <input type="radio" id="rdo_{{ $i }}_{{ $j }}" name="rdo_{{ $i }}_{{ $j }}" class="rdo-pairwise" value="1" onchange="updatePairwiseWeight2('tbl', {{ $i }}, {{ $j }}, 1, '1');updatePairwiseText('text', {{ $i }}, {{ $j }}, 1, '1')"><br>
                                                <small><strong>1</strong> - "sama pentingnya"</small>
                                        </div>
                                        <div class="col-1 text-center text-wrap align-top">
                                            <input type="radio" id="rdo_{{ $i }}_{{ $j }}" name="rdo_{{ $i }}_{{ $j }}" class="rdo-pairwise" value="3_2" onchange="updatePairwiseWeight2('tbl', {{ $i }}, {{ $j }}, 3, '2');updatePairwiseText('text', {{ $i }}, {{ $j }}, 3, '2')"><br>
                                                <small><strong>3</strong> - "sedikit lebih penting"</small>
                                        </div>
                                        <div class="col-1 text-center text-wrap align-top">
                                            <input type="radio" id="rdo_{{ $i }}_{{ $j }}" name="rdo_{{ $i }}_{{ $j }}" class="rdo-pairwise" value="5_2" onchange="updatePairwiseWeight2('tbl', {{ $i }}, {{ $j }}, 5, '2');updatePairwiseText('text', {{ $i }}, {{ $j }}, 5, '2')"><br>
                                                <small><strong>5</strong> - "lebih penting"</small>
                                        </div>
                                        <div class="col-1 text-center text-wrap align-top">
                                            <input type="radio" id="rdo_{{ $i }}_{{ $j }}" name="rdo_{{ $i }}_{{ $j }}" class="rdo-pairwise" value="7_2" onchange="updatePairwiseWeight2('tbl', {{ $i }}, {{ $j }}, 7, '2');updatePairwiseText('text', {{ $i }}, {{ $j }}, 7, '2')"><br>
                                                <small><strong>7</strong> - "sangat lebih penting"</small>
                                        </div>
                                        <div class="col-1 text-center text-wrap align-top">
                                            <input type="radio" id="rdo_{{ $i }}_{{ $j }}" name="rdo_{{ $i }}_{{ $j }}" class="rdo-pairwise" value="9_2" onchange="updatePairwiseWeight2('tbl', {{ $i }}, {{ $j }}, 9, '2');updatePairwiseText('text', {{ $i }}, {{ $j }}, 9, '2')"><br>
                                                <small><strong>9</strong> - "mutlak lebih penting"</small>
                                        </div>
                                        <div class="col-1 text-right text-wrap align-top"><strong><span class="criteria-{{ $j }}">{{ isset($criteria[$j]) ? $criteria[$j] : '' }}</span></strong></div>
                                    </div>
                                    <div class="d-none rounded my-2 px-2 pairwise-text text-{{ $i }} text-{{ $j }}">-</div>
                                </div>
                                @endif
                            @endfor
                        @endfor
                    </div>
                </div>
            </div>
            <div class="card card-primary">
                <div class="card-header bg-icraf-green">
                    <h4 class="card-title w-100">
                        <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapse-tablecriteria" aria-expanded="false">Matriks Perbandingan Berpasangan</a>
                    </h4>
                </div>
                <div id="collapse-tablecriteria" class="collapse" data-parent="#accordion-criteria" style="">
                    <div class="card-body" style="overflow-x: scroll">
                        <table id="tbl-criteria-goal" class="table">
                            <tr>
                                <th></th>
                                @for ($j = 0; $j < $maxCriteria; $j++)
                                    <th scope="col" class="tbl-col-{{ $j }} criteria-{{ $j }}">{{ isset($criteria[$j]) ? $criteria[$j] : '' }}</th>
                                @endfor
                            </tr>
                            @for ($i = 0; $i < $maxCriteria; $i++)
                                <tr>
                                    <th scope="row" class="tbl-row-{{ $i }} criteria-{{ $i }}">{{ isset($criteria[$i]) ? $criteria[$i] : '' }}</th>
                                    @for ($j = 0; $j < $maxCriteria; $j++)
                                        <td class="tbl-row-{{ $i }} tbl-col-{{ $j }}"><input type="number" class="form-control cell-pairwise" min="1" max="9" onfocus="addCellFocus('tbl', {{ $i }}, {{ $j }})" onblur="removeCellFocus('tbl', {{ $i }}, {{ $j }})" @if ($i==$j) value="1" readonly @else value="{{ isset($weight_criteria[$i][$j]) ? $weight_criteria[$i][$j] : '' }}" @endif onchange="updatePairwiseWeight('tbl', {{ $i }}, {{ $j }})"></td>
                                        @php if (($j > $i) && ($i<count($criteria)) && ($j<count($criteria))) $set_pairwise .= 'setPairwiseRdo("rdo", '.$i.', '.$j.', '.$weight_criteria[$i][$j].'); '; @endphp
                                    @endfor
                                </tr>
                            @endfor
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="p-2 border mb-3">
        <h5 class="icraf-green"><strong>Perbandingan Berpasangan untuk Alternatif Skema PS sehubungan dengan Setiap Kriteria</strong></h5>
        <p>Tentukan prioritas setiap kriteria berdasarkan tujuan yang ingin dicapai dengan pemberian bobot atau nilai. Seluruh kombinasi pasangan kriteria disajikan dalam matriks perbandingan berpasangan.</p>
        @for ($k = 0; $k < $maxCriteria; $k++)
            <div id="div-comp-criteria-{{ $k }}">
                @if ($k > 0) <hr> @endif
                <span class="d-inline-flex sub-subtitle criteria-{{ $k }} text-white bg-icraf-orange px-2 py-1 my-1 rounded">{{ isset($criteria[$k]) ? $criteria[$k] : '' }}</span>
                <div id="accordion-alternative-criteria-{{ $k }}">
                    <div class="card card-primary">
                        <div class="card-header bg-icraf-green">
                            <h4 class="card-title w-100">
                                <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapse-comparisonalternative-criteria-{{ $k }}" aria-expanded="false">Perbandingan Antar Alternatif</a>
                            </h4>
                        </div>
                        <div id="collapse-comparisonalternative-criteria-{{ $k }}" class="collapse" data-parent="#accordion-alternative-criteria-{{ $k }}" style="">
                            <div class="card-body">
                                @for ($i=0; $i < count($alternative); $i++)
                                    @for ($j=$i; $j < count($alternative); $j++)
                                        @if ($i != $j)
                                        <div class="pairwise-slider border p-1 mb-2 compalt-{{ $i }} compalt-{{ $j }}">
                                            <div class="row">
                                                <div class="col-1 text-left text-wrap align-top"><strong><span class="altcriteria-{{ $i }}">{{ $alternative[$i] }}</span></strong></div>
                                                <div class="col-1 text-center text-wrap align-top">
                                                    <input type="radio" id="rdoalt-{{ $k }}_{{ $i }}_{{ $j }}" name="rdoalt-{{ $k }}_{{ $i }}_{{ $j }}" class="rdo-pairwise" value="9_1" onchange="updatePairwiseWeight2('tbl-alt{{ $k }}', {{ $i }}, {{ $j }}, 9, '1');updatePairwiseText('textalt-{{ $k }}', {{ $i }}, {{ $j }}, 9, '1')"><br>
                                                        <small><strong>9</strong> - "mutlak lebih penting"</small>
                                                </div>
                                                <div class="col-1 text-center text-wrap align-top">
                                                    <input type="radio" id="rdoalt-{{ $k }}_{{ $i }}_{{ $j }}" name="rdoalt-{{ $k }}_{{ $i }}_{{ $j }}" class="rdo-pairwise" value="7_1" onchange="updatePairwiseWeight2('tbl-alt{{ $k }}', {{ $i }}, {{ $j }}, 7, '1');updatePairwiseText('textalt-{{ $k }}', {{ $i }}, {{ $j }}, 7, '1')"><br>
                                                        <small><strong>7</strong> - "sangat lebih penting"</small>
                                                </div>
                                                <div class="col-1 text-center text-wrap align-top">
                                                    <input type="radio" id="rdoalt-{{ $k }}_{{ $i }}_{{ $j }}" name="rdoalt-{{ $k }}_{{ $i }}_{{ $j }}" class="rdo-pairwise" value="5_1" onchange="updatePairwiseWeight2('tbl-alt{{ $k }}', {{ $i }}, {{ $j }}, 5, '1');updatePairwiseText('textalt-{{ $k }}', {{ $i }}, {{ $j }}, 5, '1')"><br>
                                                        <small><strong>5</strong> - "lebih penting"</small>
                                                </div>
                                                <div class="col-1 text-center text-wrap align-top">
                                                    <input type="radio" id="rdoalt-{{ $k }}_{{ $i }}_{{ $j }}" name="rdoalt-{{ $k }}_{{ $i }}_{{ $j }}" class="rdo-pairwise" value="3_1" onchange="updatePairwiseWeight2('tbl-alt{{ $k }}', {{ $i }}, {{ $j }}, 3, '1');updatePairwiseText('textalt-{{ $k }}', {{ $i }}, {{ $j }}, 3, '1')"><br>
                                                        <small><strong>3</strong> - "sedikit lebih penting"</small>
                                                </div>
                                                <div class="col-1 text-center text-wrap align-top border">
                                                    <input type="radio" id="rdoalt-{{ $k }}_{{ $i }}_{{ $j }}" name="rdoalt-{{ $k }}_{{ $i }}_{{ $j }}" class="rdo-pairwise" value="1" onchange="updatePairwiseWeight2('tbl-alt{{ $k }}', {{ $i }}, {{ $j }}, 1, '1');updatePairwiseText('textalt-{{ $k }}', {{ $i }}, {{ $j }}, 1, '1')"><br>
                                                        <small><strong>1</strong> - "sama pentingnya"</small>
                                                </div>
                                                <div class="col-1 text-center text-wrap align-top">
                                                    <input type="radio" id="rdoalt-{{ $k }}_{{ $i }}_{{ $j }}" name="rdoalt-{{ $k }}_{{ $i }}_{{ $j }}" class="rdo-pairwise" value="3_2" onchange="updatePairwiseWeight2('tbl-alt{{ $k }}', {{ $i }}, {{ $j }}, 3, '2');updatePairwiseText('textalt-{{ $k }}', {{ $i }}, {{ $j }}, 3, '2')"><br>
                                                        <small><strong>3</strong> - "sedikit lebih penting"</small>
                                                </div>
                                                <div class="col-1 text-center text-wrap align-top">
                                                    <input type="radio" id="rdoalt-{{ $k }}_{{ $i }}_{{ $j }}" name="rdoalt-{{ $k }}_{{ $i }}_{{ $j }}" class="rdo-pairwise" value="5_2" onchange="updatePairwiseWeight2('tbl-alt{{ $k }}', {{ $i }}, {{ $j }}, 5, '2');updatePairwiseText('textalt-{{ $k }}', {{ $i }}, {{ $j }}, 5, '2')"><br>
                                                        <small><strong>5</strong> - "lebih penting"</small>
                                                </div>
                                                <div class="col-1 text-center text-wrap align-top">
                                                    <input type="radio" id="rdoalt-{{ $k }}_{{ $i }}_{{ $j }}" name="rdoalt-{{ $k }}_{{ $i }}_{{ $j }}" class="rdo-pairwise" value="7_2" onchange="updatePairwiseWeight2('tbl-alt{{ $k }}', {{ $i }}, {{ $j }}, 7, '2');updatePairwiseText('textalt-{{ $k }}', {{ $i }}, {{ $j }}, 7, '2')"><br>
                                                        <small><strong>7</strong> - "sangat lebih penting"</small>
                                                </div>
                                                <div class="col-1 text-center text-wrap align-top">
                                                    <input type="radio" id="rdoalt-{{ $k }}_{{ $i }}_{{ $j }}" name="rdoalt-{{ $k }}_{{ $i }}_{{ $j }}" class="rdo-pairwise" value="9_2" onchange="updatePairwiseWeight2('tbl-alt{{ $k }}', {{ $i }}, {{ $j }}, 9, '2');updatePairwiseText('textalt-{{ $k }}', {{ $i }}, {{ $j }}, 9, '2')"><br>
                                                        <small><strong>9</strong> - "mutlak lebih penting"</small>
                                                </div>
                                                <div class="col-1 text-right text-wrap align-top"><strong><span class="altcriteria-{{ $j }}">{{ $alternative[$j] }}</span></strong></div>
                                            </div>
                                            <div class="d-none rounded my-2 px-2 pairwise-text textalt-{{ $k }}-{{ $i }} textalt-{{ $k }}-{{ $j }}">-</div>
                                        </div>
                                        @endif
                                    @endfor
                                @endfor
                            </div>
                        </div>
                    </div>
                    <div class="card card-primary">
                        <div class="card-header bg-icraf-green">
                            <h4 class="card-title w-100">
                                <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapse-tablealternative-criteria-{{ $k }}" aria-expanded="false">Matriks Perbandingan Berpasangan</a>
                            </h4>
                        </div>
                        <div id="collapse-tablealternative-criteria-{{ $k }}" class="collapse" data-parent="#accordion-alternative-criteria-{{ $k }}" style="">
                            <div class="card-body" style="overflow-x: scroll">
                                <table class="table">
                                    <tr>
                                        <th></th>
                                        @for ($j = 0; $j < count($alternative); $j++)
                                            <th scope="col" class="tbl-alt{{ $k }}-col-{{ $j }}">{{ $alternative[$j] }}</th>
                                        @endfor
                                    </tr>
                                    @for ($i = 0; $i < count($alternative); $i++)
                                        <tr>
                                            <th scope="row" class="tbl-alt{{ $k }}-row-{{ $i }}">{{ $alternative[$i] }}</th>
                                            @for ($j = 0; $j < count($alternative); $j++)
                                                <td class="tbl-alt{{ $k }}-row-{{ $i }} tbl-alt{{ $k }}-col-{{ $j }}"><input type="number" class="form-control cell-pairwise" min="1" max="9" onfocus="addCellFocus('tbl-alt{{ $k }}', {{ $i }}, {{ $j }})" onblur="removeCellFocus('tbl-alt{{ $k }}', {{ $i }}, {{ $j }})" @if ($i==$j) value="1" readonly @else value="{{ isset($weight_alternative[$k][$i][$j]) ? $weight_alternative[$k][$i][$j] : '' }}" @endif onchange="updatePairwiseWeight('tbl-alt{{ $k }}', {{ $i }}, {{ $j }})"></td>
                                                @php if (($j > $i) && ($k<count($criteria))) $set_pairwise .= 'setPairwiseRdo("rdoalt-'.$k.'", '.$i.', '.$j.', '.$weight_alternative[$k][$i][$j].'); '; @endphp
                                            @endfor
                                        </tr>
                                    @endfor
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endfor
    </div>
    <input type="hidden" id="hdn_alternative" name="hdn_alternative" value="{{ $proposal->step2_skemaps }}">
    <input type="hidden" id="hdn_maxCriteria" name="hdn_maxCriteria" value="{{ $maxCriteria }}">
    <input type="hidden" id="hdn_proposalID" name="hdn_proposalID" value="{{ $proposal->id }}">
    <input type="hidden" id="hdn_urlparam" name="hdn_urlparam" value="{{ $urlparam }}">
    @if (!$proposal->step3_completed)
    <div class="d-flex justify-content-end my-2">
        <button type="button" id="submit_step3" class="btn text-white bg-icraf-orange" onclick="processAHP()"><i class="fas fa-play"></i>&nbsp;&nbsp;Proses</button>
    </div>
    @endif
    <hr>
    <h5 class="icraf-green"><strong>Hasil Perhitungan AHP</strong></h5>
    <div class="mb-3 bg-light rounded p-3" id="ahp-result">
        Hasil perhitungan AHP mengacu kepada matriks berpasangan di atas yang proses perhitungannya digunakan sebagai vector eigen untuk menentukan bobot relatif dari setiap kriteria. Untuk memastikan keandalan hasil yang diperoleh, dilakukan pengujian kekonsistenan dengan menghitung rasio konsistensi (CR).<br><br>
        @if (strlen($proposal->step3_skemaps))
            @php $txt_consistency = [] @endphp
            Berdasarkan pengisian formulir Penentuan Preferensi di atas, hasil yang didapatkan adalah sebagai berikut.<br><br>Rekomendasi skema PS beserta bobotnya:<br>
            <table class="table table-bordered table-striped">
                <tr><th>No</th><th>Skema PS</th><th>Bobot</th></tr>
                @foreach ($result as $r)
                    @php if ($loop->first) $best_skema = '<li>Skema PS <strong>' . $r->alternative . '</strong> menjadi skema PS yang paling direkomendasikan, dengan nilai bobot sebesar <strong>' . number_format($r->weight, 5) . '</strong>.</li>'; @endphp
                    <tr><td>{{ $loop->iteration }}</td><td>{{ $r->alternative }}</td><td>{{ number_format($r->weight, 5) }}</td></tr>
                @endforeach
            </table><br>
            Uji Kekonsistenan Preferensi:<br>
            @if (strlen($proposal->step3_ahpCRalternative))
                <table class="table table-bordered table-striped">
                    <tr>
                        <td>Nilai kekonsistenan kriteria</td>
                        <td>
                            @if (count($criteria) > 2)
                                {{ number_format($proposal->step3_ahpCRcriteria, 5) }}
                                @php
                                    if ($proposal->step3_ahpCRcriteria > 0.1) array_push($txt_consistency, 'nilai kekonsistenan kriteria sama dengan ' . number_format($proposal->step3_ahpCRcriteria, 5))
                                @endphp
                            @else <em>Tidak dihitung, karena jumlah kriteria hanya 2.</em> 
                            @endif
                        </td>
                    </tr>
                    @if (count($CR_alternative))
                        @for ($i = 0; $i < count($criteria); $i++)
                            <tr><td>Nilai kekonsistenan alternatif (skema PS) sehubungan dengan kriteria "{{ $criteria[$i] }}"</td><td @if ($CR_alternative[$i] > 0.1) class="btn-danger" title="Tidak konsisten" @endif>{{ number_format($CR_alternative[$i], 5) }}</td></tr>
                            @php
                                if ($CR_alternative[$i] > 0.1) array_push($txt_consistency, 'nilai kekonsistenan alternatif (skema PS) sehubungan dengan kriteria ' . $criteria[$i] . ' sama dengan <u>' . number_format($CR_alternative[$i], 5) . '</u>')
                            @endphp
                        @endfor
                    @else
                        <tr><td>Nilai kekonsistenan alternatif (skema PS)</td><td><em>Tidak dihitung, karena jumlah alternatif (skema PS) hanya 2.</em></td></tr>
                    @endif
                    <tr><td>Nilai kekonsistenan yang diinginkan</td><td class="btn-success text-bold">&le; 0.1</td></tr>
                </table><br>
            @else
                <em>Belum dilakukan.</em><br><br>
            @endif
            Kesimpulan:
            <ul>
                {!! $best_skema !!}
                @if ($proposal->step3_ahpisconsistent)
                    @if (count($alternative) > 2 || count($criteria) > 2)
                        <li>Tidak terdapat nilai kekonsistenan yang lebih besar daripada nilai yang diinginkan. Dengan demikian, hasil penilaian preferensi <strong>konsisten</strong>.</li>
                    @endif
                @else
                    @if (strlen($proposal->step3_ahpCRalternative))
                    <li>
                        Terdapat nilai kekonsistenan yang lebih besar daripada nilai yang diinginkan. Dalam hal ini:<br>
                        <ul><li>{!! implode('</li><li>', $txt_consistency) !!}</li></ul>
                        Dengan demikian, hasil penilaian preferensi <strong>tidak konsisten</strong>, dan pemberian bobot preferensi <strong>perlu ditinjau kembali</strong>.
                    </li>
                    @else
                    <li>Uji kekonsistenan preferensi belum dilakukan, sehingga proses perhitungan bobot preferensi perlu diulang.</li>
                    @endif
                @endif
            </ul>
            @if (!$proposal->step3_completed)
                @if ($proposal->step3_ahpisconsistent) Jika Anda ingin @else Untuk @endif mengubah kriteria dan/atau bobot AHP, silakan klik Ubah AHP.
                @if ($proposal->step3_ahpisconsistent) Jika Anda merasa hasil perhitungan AHP sudah sesuai, silakan klik Lanjut. @endif <br><br>
                <button type="button" id="edit_step3" class="btn btn-primary mb-1" onclick="openAHP()"><i class="fas fa-edit"></i> Ubah AHP</button>
                @if ($proposal->step3_ahpisconsistent) <button type="button" id="proceed_step3" class="btn btn-success mb-1" onclick="finalizeAHP()"><i class="fas fa-angle-double-right"></i> Lanjut</button> @endif
            @else
                <br><small>Langkah ini diselesaikan pada {{ date('j F Y, H:i:s', strtotime($proposal->step3_completed)) }}</small>
            @endif
        @else
            <em>Hasil dari perhitungan AHP akan ditampilkan di sini.</em>
        @endif
    </div>
    @endif
    <div class="d-flex justify-content-end my-2">
        <a class="btn text-white bg-icraf-orange" href="/step-2/{{ $urlparam }}"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Sebelumnya</a>&nbsp;
        <button type="button" id="btn_next" class="btn text-white bg-icraf-orange" onclick="gotoNext(4)" @if (!$proposal->step3_completed && !(strlen($proposal->step2_skemaps) && count(explode('-', $proposal->step2_skemaps)) == 1) && !(strlen($proposal->step1_skemaps) && count(explode('-', $proposal->step1_skemaps)) == 1)) disabled @endif >Selanjutnya&nbsp;&nbsp;<i class="fas fa-arrow-right"></i></button>
    </div>
</div>
@stop

@section('customJS')
idxCriteria = {{ $idxCriteria }};
@for ($i = 0; $i < $maxCriteria; $i++) AHPShowHideCriteria({{ $i }}); @endfor
@if (strlen($proposal->step3_skemaps) || $proposal->status == 'cancelled')
    $('input').prop('disabled','disabled');
    $('#txt_objective').prop('disabled', 'disabled');
    $('#btn_criteria').prop('disabled','disabled');
    $('#submit_step3').prop('disabled','disabled');
@endif
console.log('{!! $set_pairwise !!}');
eval('{!! $set_pairwise !!}');
@stop
