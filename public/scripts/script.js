function openSetting() { window.open("/admin", "_blank", "width=1200,height=700"); }

function openValidation(id) { window.open("/admin/validation/" + id, "_blank", "width=1200,height=700"); }

function openInbox(id) { window.open("/admin/inbox/" + id, "_blank", "width=1200,height=700"); }

function toggleDetail(what, id) {
    if ($("#tr_" + id).css("display") == "none") {
        $("#chevron_" + id).html('<i class="fa fa-chevron-circle-up"></i>');
        if ($("#td_" + id).html() == "-")
            $.ajax({
                url: '/' + what + '/' + id + '/detail',
                type: "GET",
                cache: false,
                success: function (response) {
                    res = [];
                    $.each(response.data, function(f, v) {
                        f2 = f.split("_");
                        for (i=0; i<f2.length; i++) {
                            f2[i] = f2[i][0].toUpperCase() + f2[i].substr(1);
                        }
                        res.push(f2.join(' ') + ": " + v);
                    })
                    $("#td_" + id).html(res.join("<br>"));
                }
            });
    } else $("#chevron_" + id).html('<i class="fa fa-chevron-circle-down"></i>');
    $("#tr_" + id).fadeToggle();
}

function toggleValidationDetail() {
    if ($("#validation-detail").css("display") == "none")
        $("#chevron-validation").html('<i class="fa fa-chevron-circle-up"></i>');
    else $("#chevron-validation").html('<i class="fa fa-chevron-circle-down"></i>');
    $("#validation-detail").slideToggle();
}

function showCategory() {
    if ($("#sel_category").val() != "-") window.location = "/article/category/" + $("#sel_category").val();
}

function generateSlug(obj, target) {
    str = obj.value;
    slug = str.replace(/[^a-zA-Z0-9 \-_]/g, '').replaceAll(' ', '-').toLowerCase();
    $("#" + target).val(slug);
}

function downloadTabularTemplate(id) { window.location = "/admin/tabular/" + id + "/gettemplate"; }

function cntNotification() {
    $.ajax({
        url: '/notification/cnt',
        type: 'GET',
        cache: false,
        success: function (result) {
            if (result > 0) {
                $('#nav-badge').html(result).removeClass('d-none');
                $('#dropdown-badge').html(result).removeClass('d-none');
            } else {
                $('#nav-badge').html("").addClass('d-none');
                $('#dropdown-badge').html("").addClass('d-none');
            }
        }
    });
}

function openNotification() {
    window.location = '/notification';
}

function setNotificationSeen() {
    ids = $('#ids').val();
    if (ids.length) {
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });
        $.ajax({
            url: '/notification/seen',
            type: 'POST',
            data: { ids: ids },
            cache: false,
            success: function(result) { cntNotification(); }
        });
    }
}

function showMap(where) {
    var loc = NTT_kabOption[where];
    map.fitBounds([[loc[0],[loc[1]]],[loc[2],loc[3]]]);
}

function showMap2(is_do=false) {
    var selectedLayer = [];
    var urlParam = [];
    var where = $('input[name="region"]:checked').val();
    $('.layermap:checkbox:checked').each(function() {
        checkmap = $(this).attr('value');
        featuremap = $('input[name="opt'+checkmap+'"]:checked').val();
        selectedLayer.push(checkmap + '|' + (typeof featuremap !== 'undefined' ? featuremap : ''));
    });
    if (typeof where !== 'undefined') urlParam.push('r=' + encodeURIComponent(where));
    if (selectedLayer.length) urlParam.push('l=' + selectedLayer.join(','));

    if (typeof where !== 'undefined' && selectedLayer.length)
        $("#btn_proses").prop('disabled', '');
    else $("#btn_proses").prop('disabled', 'disabled');

    target = APP_URL + '/map-iframe/?' + urlParam.join("&") + (is_do ? '&do=yes' : '');
    console.log(target);
    $("#interactive-map").load(target);
}

function showMap3() {
    region = $('#sel_region').val();
    param = $('#hdn_qry').val();
    // target = APP_URL + '/iframe-landaccess/?' + "r=" + region + "&param=" + btoa(param);
    target = APP_URL + '/iframe-landaccess/?';
    // console.log(target);
    $("#interactive-map").load(target);
    // if ($("#map-opt-inner").css("display") != "none") toggleOpt();
    clearMapResult();
}

function showMap4(url = '') {
    if (APP_URL.length) theurl = APP_URL;
        else if (url.length) theurl = url;
        else theurl = '';
    target = (theurl) + '/land-access/iframe/?';
    $("#interactive-map").load(target);
}

function showMap5() {
    target = APP_URL + '/land-access/iframe-plus/?';
    $('#land-access').load(target);
}

function showSelectedRegionOnMap(shp, idd) {
    target = APP_URL + '/land-access/iframe/?d=' + btoa(idd) + '&shp=' + btoa(shp);
    $("#region-map").load(target);
}

function toggleInteractiveColor(which) {
    $('#color-'+which).fadeToggle();
}

function showInteractiveMap(param = '') {
    target = APP_URL + '/iframe-interactive/?' + (param.length ? param : '');
    $('#interactive-map').load(target);
}

function showInteractiveFeature() {
    feature = [];
    $.each($('input[name="sel_filter"]:checked'), function() {
        map = $(this).val();
        clr = $('#selcolor-'+map).val();
        feature.push(map+','+clr);
    });
    showInteractiveMap('f=' + feature.join('.'));
}

function parseInteractiveMapName(name) {
    name2 = name.substring(0, name.indexOf('_interactive'));
    name2 = name2.split('_');
    name3 = [];
    $.each(name2, function(f, v) {
        v2 = v.charAt(0).toUpperCase() + v.slice(1);
        name3.push(v2);
    });
    return name3.join(' ');
}

function openKuesioner(id) {
    window.open('/kuesioner/' + id, "_blank", "width=900,height=600");
}

function openLandAccessApp(param) {
    window.open(APP_URL + '/region/' + param, "_blank");
}

function processLayer() {
    input = $('#hdn_geojson').val();
    target = APP_URL + '/iframe-landaccess/?i=' + btoa(input);
    $('#interactive-map').load(target);
}

function processLayer2() {
    input = $('#hdn_geojson').val();
    target = APP_URL + '/land-access/iframe/?i=' + btoa(input);
    $('#interactive-map').load(target);
}

function genQuery() {
    query = [];
    query2 = [];
    region = $('#sel_region').val();
    if (region != 'all') {
        query.push("daerah = '" + decodeURIComponent(region) + "'");
        query2.push("daerah = '" + decodeURIComponent(region) + "'");
    }
    lstFields.forEach(a => {
        b = a.split("__");
        if (b.length > 1) c = b[1].split("_"); else c = b[0].split("_");
        for (i=0; i < c.length; i++) { c[i] = c[i].charAt(0).toUpperCase() + c[i].slice(1); }
        t = $('#sel_' + a + ' option:selected').text();
        if (t != '') {
            query.push((c.length > 1 ? c.join(' ') : c[0]) + " = '" + t + "'");
            query2.push(a + "='" + t + "'");
        }
    });
    if ($("#qry-res-inner").css("display") == "none") toggleQry();
    $("#txt_qry").html(query.join('<br>AND '));
    $("#hdn_qry").val(query2.join(' AND '));
    $("#btnProcess").removeAttr("disabled");
    clearMapResult();
}

function clearMapResult() {
    $('#txt_result').html('');
}

function processRegion() {
    opt = $('input[name=rdo_region]:checked').val();
    opt2 = opt.split('_');
    if (opt2[0] == 'keep') window.location.replace('/step-2');
    else {
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });
        $.ajax({
            url: '/region/change',
            type: 'POST',
            data: { param: opt },
            success: function(response) {
                alert('Sukses mengganti daerah yang diproses');
                window.location.replace('/step-2');
            }
        })
    }
}

function gotoNext(idx) {
    param = $('#hdn_urlparam').val();
    if (idx == 1 || idx == 2 || idx == 3) {
        window.location = '/step-'+idx+'/' + param;
    } else if (idx == 4) {
        window.location = '/result/' + param;
    }
}

function updateQuestions() {
    $.each(prerequisites, function(k1, v1) {
        isDisabled = true;
        // if (k1 == 'A' || k1 == 'B') {
            if (Object.keys(v1).length) {
                // console.log('k1:'+k1);
                $.each(v1, function(k2, v2) {
                    // console.log('k2:'+k2);
                    // console.log('v2:'+v2);
                    ans = $('input[name=rdo_'+k2+']:checked').val();
                    // console.log('ans:'+ans);
                    if (ans !== 'undefined') {
                        if (ans !== v2) isDisabled = (isDisabled && false);
                            else isDisabled = (isDisabled && true);
                    } else return false;
                });
                // console.log('isDisabled:'+isDisabled);
                if (isDisabled) {
                    $('input[name=rdo_'+k1+']').prop('disabled', 'disabled');
                    $('input[name=rdo_'+k1+'][value=Tidak]').prop('checked', true);
                    $('.opt-yes.opt-'+k1).removeClass('bg-primary').addClass('bg-secondary');
                    $('.opt-no.opt-'+k1).removeClass('bg-danger').addClass('bg-secondary');
                } else {
                    $('input[name=rdo_'+k1+']').prop('disabled', '');
                    // $('input[name=rdo_'+k1+'][value=Tidak]').prop('checked', false);
                    $('.opt-yes.opt-'+k1).removeClass('bg-secondary').addClass('bg-primary');
                    $('.opt-no.opt-'+k1).removeClass('bg-secondary').addClass('bg-danger');
                }
            }
        // }
    });
}

function processQuestionnaire() {
    proposal_id = $('#hdn_proposalID').val();
    idd = $('#hdn_idd').val();
    skema_ps = $('#hdn_skemaps').val();
    questionCodes = ($('#hdn_questionCodes').val()).split(',');
    quest_ans = {};
    $.each(questionCodes, function(k, v) {
        opt = $('input[name=rdo_'+v+']:checked').val();
        if (opt === undefined) {
            alert('Terdapat pertanyaan yang belum dijawab');
            exit;
            return false;
        } else quest_ans[v] = opt;
    });
    $('input[class=rdo-questionnaire]').prop('disabled', 'disabled');
    $('.opt-yes').removeClass('bg-primary').addClass('bg-secondary');
    $('.opt-no').removeClass('bg-danger').addClass('bg-secondary');
    $('#submit_step2').prop('disabled', 'disabled');
    param = btoa(JSON.stringify(quest_ans));
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });
    $.ajax({
        url: '/questionnaire/assess',
        type: 'POST',
        data: { proposal_id: proposal_id, param: param, idd: idd, skema_ps: skema_ps },
        success: function(response) {
            // console.log(skema_ps);
            if (response[0]!='-') {
                txt1 = 'Berdasarkan hasil pengisian kuesioner di atas, skema PS yang direkomendasikan adalah <strong>'+response[0]+'</strong>.<br>';
                txtlanjut = 'Jika Anda merasa jawaban kuesioner sudah sesuai, silakan klik Lanjut. ';
                btnlanjut = '<button type="button" id="proceed_step2" class="btn btn-success mb-1" onclick="finalizeQuestionnaire()"><i class="fas fa-angle-double-right"></i>&nbsp;&nbsp;Lanjut</button>';
            } else {
                txt1 = 'Berdasarkan hasil pengisian kuesioner di atas, tidak ada skema PS yang dapat direkomendasikan.<br>';
                txtlanjut = '';
                btnlanjut = '';
            }
            txtExcluded = '';
            if (response[0].indexOf('HA') === -1 && skema_ps.indexOf('HA') !== -1) {
                txtExcluded += '<div class="card card-primary"><div class="card-header bg-icraf-orange collapsed" data-toggle="collapse" href="#collapseHA"><a>Skema <strong>Hutan Adat (HA)</strong> tidak direkomendasikan, kemungkinan karena beberapa faktor:</a></div><div id="collapseHA" class="collapse" data-parent="#why"><div class="card-body"><ol><li>Belum ada MHA (Masyarakat Hukum Adat) yang ditetapkan dengan Perda (jika MHA berada di dalam kawasan hutan negara), atau Perda atau Keputusan Gubernur dan/atau Bupati/Walikota (jika MHA di luar kawasan hutan) [<a href="#" onClick="gotoQuestion(\'K\')">Pertanyaan K</a>]; <strong>atau</strong></li><li>MHA tersebut tidak tinggal di dalam kawasan hutan atau areal yang akan diusulkan, serta belum lama memanfaatkannya [<a href="#" onClick="gotoQuestion(\'L\')">Pertanyaan L</a>]</li></ol></div></div></div>';
            }
            if (response[0].indexOf('HD') === -1 && skema_ps.indexOf('HD') !== -1) {
                txtExcluded += '<div class="card card-primary"><div class="card-header bg-icraf-orange collapsed" data-toggle="collapse" href="#collapseHD"><a>Skema <strong>Hutan Desa (HD)</strong> tidak direkomendasikan, kemungkinan karena beberapa faktor:</a></div><div id="collapseHD" class="collapse" data-parent="#why"><div class="card-body"><ol><li>Areal yang Anda usulkan tidak berada di dalam wilayah desa Anda, atau merupakan areal hasil kesepakatan batas pengelolaan antara desa yang berdampingan dengan desa Anda [<a href="#" onClick="gotoQuestion(\'A\')">Pertanyaan A</a>, <a href="#" onClick="gotoQuestion(\'B\')">Pertanyaan B</a>];</li><li>Anda tidak mengusulkan melalui lembaga desa/kelurahan, yang dibentuk melalui peraturan yang berlaku [<a href="#" onClick="gotoQuestion(\'C\')">Pertanyaan C</a>, <a href="#" onClick="gotoQuestion(\'D\')">Pertanyaan D</a>];</li><li>Areal berada di dalam kawasan yang telah dibebani perizinan berusaha pemanfaatan hutan, atau dibebani persetujuan penggunaan kawasan hutan [<a href="#" onClick="gotoQuestion(\'G\')">Pertanyaan G</a>, <a href="#" onClick="gotoQuestion(\'H\')">Pertanyaan H</a>];</li><li>Areal tidak berada di dalam satu kesatuan lansekap/bentang alam [<a href="#" onClick="gotoQuestion(\'M\')">Pertanyaan M</a>]; <strong>atau</strong></li><li>Areal belum dimanfaatkan oleh warga setempat [<a href="#" onClick="gotoQuestion(\'N\')">Pertanyaan N</a>]</li></ol></div></div></div>';
            }
            if (response[0].indexOf('HKm') === -1 && skema_ps.indexOf('HKm') !== -1) {
                txtExcluded += '<div class="card card-primary"><div class="card-header bg-icraf-orange collapsed" data-toggle="collapse" href="#collapseHKm"><a>Skema <strong>Hutan Kemasyarakatan (HKm)</strong> tidak direkomendasikan, kemungkinan karena beberapa faktor:</a></div><div id="collapseHKm" class="collapse" data-parent="#why"><div class="card-body"><ol><li>Areal berada di dalam kawasan yang telah dibebani perizinan berusaha pemanfaatan hutan, atau dibebani persetujuan penggunaan kawasan hutan [<a href="#" onClick="gotoQuestion(\'G\')">Pertanyaan G</a>, <a href="#" onClick="gotoQuestion(\'H\')">Pertanyaan H</a>]; <strong>atau</strong></li><li>Areal belum dimanfaatkan oleh warga setempat [<a href="#" onClick="gotoQuestion(\'N\')">Pertanyaan N</a>]</li></ol></div></div></div>';
            }
            if (response[0].indexOf('HTR') === -1 && skema_ps.indexOf('HTR') !== -1) {
                txtExcluded += '<div class="card card-primary"><div class="card-header bg-icraf-orange collapsed" data-toggle="collapse" href="#collapseHTR"><a>Skema <strong>Hutan Tanaman Rakyat (HTR)</strong> tidak direkomendasikan, kemungkinan karena beberapa faktor:</a></div><div id="collapseHTR" class="collapse" data-parent="#why"><div class="card-body"><ol><li>Khusus skema HTR, areal yang hendak diusulkan sebagai Perhutanan Sosial tidak diperbolehkan berada di areal Gambut [<a href="#" onClick="gotoQuestion(\'E\')">Pertanyaan E</a>];</li><li>Areal yang Anda usulkan merupakan areal yang tidak produktif dengan tutupan lahan rendah sampai sedang [<a href="#" onClick="gotoQuestion(\'F\')">Pertanyaan F</a>];</li><li>Areal berada di dalam kawasan yang telah dibebani perizinan berusaha pemanfaatan hutan, atau dibebani persetujuan penggunaan kawasan hutan [<a href="#" onClick="gotoQuestion(\'G\')">Pertanyaan G</a>, <a href="#" onClick="gotoQuestion(\'H\')">Pertanyaan H</a>];</li><li>Areal tidak berada di dalam satu kesatuan lansekap/bentang alam [<a href="#" onClick="gotoQuestion(\'M\')">Pertanyaan M</a>];</li><li>Areal sudah dimanfaatkan oleh warga setempat [<a href="#" onClick="gotoQuestion(\'N\')">Pertanyaan N</a>]; <strong>atau</strong></li><li>Pada areal terpilih terdapat tegakan sawit, dan sudah dikelola oleh masyarakat (perseorangan) yang telah tinggal di dalam dan/atau sekitar kawasan tersebut selama minimal 5 tahun secara terus menerus [<a href="#" onClick="gotoQuestion(\'O\')">Pertanyaan O</a>]</li></ol></div></div></div>';
            }
            if (response[0].indexOf('KK') === -1 && skema_ps.indexOf('KK') !== -1) {
                txtExcluded += '<div class="card card-primary"><div class="card-header bg-icraf-orange collapsed" data-toggle="collapse" href="#collapseKK"><a>Skema <strong>Kemitraan Kehutanan (KK)</strong> tidak direkomendasikan, kemungkinan karena beberapa faktor:</a></div><div id="collapseKK" class="collapse" data-parent="#why"><div class="card-body"><ol><li>Areal tidak berada di dalam kawasan yang telah dibebani perizinan berusaha pemanfaatan hutan, atau dibebani persetujuan penggunaan kawasan hutan [<a href="#" onClick="gotoQuestion(\'G\')">Pertanyaan G</a>, <a href="#" onClick="gotoQuestion(\'H\')">Pertanyaan H</a>];</li><li>Areal yang Anda usulkan tidak memiliki potensi menjadi sumber penghidupan masyarakat setempat [<a href="#" onClick="gotoQuestion(\'I\')">Pertanyaan I</a>];</li><li>Areal yang Anda usulkan bukan merupakan areal konflik atau berpotensi konflik (persoalan masalah pemanfaatan, baik tumpang tindih lahan atau perbedaan hak akses pemanfaatan) [<a href="#" onClick="gotoQuestion(\'J\')">Pertanyaan J</a>]; <strong>atau</strong></li><li>Areal sudah dimanfaatkan oleh warga setempat [<a href="#" onClick="gotoQuestion(\'N\')">Pertanyaan N</a>]</li></ol></div></div></div>';
            }
            if (txtExcluded.length) {
                txtExcluded = '<div id="why" class="p-3">'+txtExcluded+'</div>';
            }
            txtubah = 'Jika Anda ingin mengubah jawaban kuesioner, silakan klik Ubah Jawaban. ';
            btnubah = '<button type="button" id="edit_step2" class="btn btn-primary mb-1" onclick="openQuestionnaire()"><i class="fas fa-edit"></i>&nbsp;&nbsp;Ubah Jawaban</button> ';
            $('#questionnaire-result').html(txt1+txtExcluded+txtubah+txtlanjut+'<br><br>'+btnubah+btnlanjut);
            $('html,body').animate({scrollTop: $('#questionnaire-result').offset().top - 60},'slow');
        }
    });
}

function finalizeQuestionnaire() {
    if (confirm('Dengan mengklik tombol Lanjut, pengisian kuesioner akan dianggap selesai dan jawaban kuesioner tidak akan bisa diubah lagi.\n\nApakah Anda yakin ingin melanjutkan?')) {
        $('#proceed_step2').prop('disabled','disabled').html('<i class="fas fa-angle-double-right"></i> <em>Mohon tunggu...</em>');
        $("body").css("cursor", "progress");
        proposal_id = $('#hdn_proposalID').val();
        urlParam = $('#hdn_urlparam').val();
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });
        $.ajax({
            url: '/questionnaire/finalize',
            type: 'POST',
            data: { proposal_id: proposal_id },
            success: function(response) {
                window.location.replace('/' + response + '/' + urlParam);
                $("body").css("cursor", "default");
            }
        });
    }
}

function openQuestionnaire() {
    $('input[class=rdo-questionnaire]').prop('disabled', '');
    $('.opt-yes').removeClass('bg-secondary').addClass('bg-primary');
    $('.opt-no').removeClass('bg-secondary').addClass('bg-danger');
    $('#submit_step2').prop('disabled', '');
    $('#questionnaire-result').html('<em>Hasil penilaian penapisan akan ditampilkan di sini.</em>');
    $('html,body').animate({scrollTop: $('#questionnaire-questions').offset().top - 60},'slow');
    updateQuestions();
}

function gotoQuestion(code) {
    $('html,body').animate({scrollTop: $('#question-' + code).offset().top - 60},'slow');
}

function addToAHP(type, max) {
    if (idxCriteria < max) {
        $('#tbl_' + type).append('<tr id="tr_'+type+'_'+idxCriteria+'"><td><input type="text" id="inp_'+type+'_'+idxCriteria+'" name="inp_'+type+'_'+idxCriteria+'" class="form-control" onchange="AHPShowHideCriteria('+idxCriteria+')"></td></tr>');
        $('#inp_'+type+'_'+idxCriteria).focus();
        idxCriteria++;
    } else {
        alert('Jumlah kriteria maksimal adalah ' + max);
    }
}

function addCellFocus(prefix, row, col) {
    $('.'+prefix+'-row-'+row+',.'+prefix+'-col-'+col).addClass('bg-cell-focus');
}

function removeCellFocus(prefix, row, col) {
    $('.'+prefix+'-row-'+row+',.'+prefix+'-col-'+col).removeClass('bg-cell-focus');
}

function AHPShowHideCriteria(idx) {
    txt = $('#inp_criteria_' + idx).val();
    if (txt && txt.length) {
        $('.criteria-'+idx).html(txt);
        for (i=0; i<=idx; i++) {
            for (j=0; j<=idx; j++) {
                $('.tbl-row-'+i+'.tbl-col-'+j).removeClass('d-none');
            }
            for (j=0; j<i; j++) {
                $('.comp-'+j+'.comp-'+i).removeClass('d-none');
            }
            $('.tbl-col-'+i+'.criteria-'+i).removeClass('d-none');
            $('.tbl-row-'+i+'.criteria-'+i).removeClass('d-none');
        }
        $('#div-comp-criteria-'+idx).removeClass('d-none');
    } else {
        $('.criteria-'+idx).html('');
        $('.tbl-row-'+idx+',.tbl-col-'+idx).addClass('d-none');
        $('.comp-'+idx+',.comp-'+idx).addClass('d-none');
        $('#div-comp-criteria-'+idx).addClass('d-none');
    }
}

function updatePairwiseWeight(prefix, row, col) {
    val = $('.'+prefix+'-row-'+row+'.'+prefix+'-col-'+col).children(0).val();
    val2 = Math.round(100000/val) / 100000;
    $('.'+prefix+'-row-'+col+'.'+prefix+'-col-'+row).children(0).val(val2);
}

function updatePairwiseWeight2(prefix, row, col, val0, which) {
    switch (which) {
        case '1': val1 = val0; val2 = Math.round(100000/val0) / 100000; break;
        case '2': val2 = val0; val1 = Math.round(100000/val0) / 100000; break;
    }
    $('.'+prefix+'-row-'+row+'.'+prefix+'-col-'+col).children(0).val(val1);
    $('.'+prefix+'-row-'+col+'.'+prefix+'-col-'+row).children(0).val(val2);
}

function updatePairwiseText(prefix, row, col, val0, which) {
    prefix2 = prefix.split('-');
    if (prefix2[0] == 'text') {
        prefix_txt = '';
        if (which == '1') {
            item1 = 'Kriteria "' + $('.criteria-' + row).html() + '"';
            item2 = 'kriteria "' + $('.criteria-' + col).html() + '"';
        } else {
            item1 = 'Kriteria "' + $('.criteria-' + col).html() + '"';
            item2 = 'kriteria "' + $('.criteria-' + row).html() + '"';
        }
    } else {
        crit = $('.criteria-'+prefix2[1]).html();
        alt = ($('#lst-alternatives').html()).split(', ');
        prefix_txt = 'Berdasarkan kriteria "' + crit + '", ';
        if (which == '1') {
            item1 = 'skema PS "' + alt[row] + '"';
            item2 = 'skema PS "' + alt[col] + '"';
        } else {
            item1 = 'skema PS "' + alt[col] + '"';
            item2 = 'skema PS "' + alt[row] + '"';
        }
    }
    switch (val0) {
        case 1: pred = ' <strong>sama pentingnya</strong> dengan '; break;
        case 3: pred = ' <strong>sedikit lebih penting</strong> daripada '; break;
        case 5: pred = ' <strong>lebih penting</strong> daripada '; break;
        case 7: pred = ' <strong>sangat lebih penting</strong> daripada '; break;
        case 9: pred = ' <strong>mutlak lebih penting</strong> daripada '; break;
    }
    txt = prefix_txt + item1 + pred + item2;
    // console.log(txt);
    // console.log('.pairwise-text.'+prefix+'-'+row+'.'+prefix+'-'+col);
    $('.pairwise-text.'+prefix+'-'+row+'.'+prefix+'-'+col).removeClass('d-none').html(txt);
}

function setPairwiseRdo(prefix, row, col, val0) {
    if (val0 == 1) {
        val1 = 1;
        valrdo = '1';
        which = '1';
    } else {
        if (val0 < 1) {
            val1 = Math.round(1/val0);
            which = "2";
        } else {
            val1 = val0;
            which = "1";
        }
        valrdo = val1+'_'+which;
    }
    $('input[name='+prefix+'_'+row+'_'+col+'][value='+valrdo+']').prop('checked', true);
    prefix = prefix.replace('rdo', 'text');
    updatePairwiseText(prefix, row, col, val1, which)
}

function processAHP() {
    alternative = $('#hdn_alternative').val();
    alternative_split = alternative.split('-');
    lst_criteria = [];
    maxCriteria = $('#hdn_maxCriteria').val();
    proposal_id = $('#hdn_proposalID').val();
    objective = $('#txt_objective').val();
    for (i=0; i<maxCriteria; i++) {
        txtCriteria = $('#inp_criteria_'+i).val();
        if (txtCriteria && txtCriteria.length) lst_criteria.push(txtCriteria);
    }
    if (alternative_split.length <= 1) {
        alert('Jumlah Alternatif Luaran tidak memenuhi syarat');
        return false;
    } else if (lst_criteria.length <= 1) {
        alert('Jumlah Kriteria tidak memenuhi syarat');
        return false;
    } else {
        weight_criteria = [];
        for (i=0; i<lst_criteria.length; i++) {
            temp = [];
            for (j=0; j<lst_criteria.length; j++) {
                val = $('.tbl-row-'+i+'.tbl-col-'+j).children(0).val();
                if (val === '') {
                    alert('Matriks perbandingan berpasangan untuk kriteria belum terisi semua.');
                    return false;
                } else temp.push(val);
            }
            weight_criteria.push(temp);
        }
        weight_alternative = [];
        for (k=0; k<lst_criteria.length; k++) {
            arr = [];
            for (i=0; i<alternative_split.length; i++) {
                temp = [];
                for (j=0; j<alternative_split.length; j++) {
                    val = $('.tbl-alt'+k+'-row-'+i+'.tbl-alt'+k+'-col-'+j).children(0).val();
                    if (val === '') {
                        alert('Matriks perbandingan berpasangan untuk aternatif belum terisi semua.')
                        return false;
                    } else temp.push(val);
                }
                arr.push(temp);
            }
            weight_alternative.push(arr);
        }
        $('input').prop('disabled','disabled');
        $('#btn_criteria').prop('disabled','disabled');
        $('#submit_step3').prop('disabled','disabled');
        $('#txt_objective').prop('disabled','disabled');
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });
        $.ajax({
            url: '/ahp/do',
            type: 'POST',
            data: { proposal_id: proposal_id, objective: objective, criteria: JSON.stringify(lst_criteria), alternative: alternative, weight_criteria: JSON.stringify(weight_criteria), weight_alternative: JSON.stringify(weight_alternative) },
            success: function(response) {
                // console.log(response);
                txt_consistency = [];
                txt = 'Berdasarkan pengisian formulir Penentuan Preferensi di atas, hasil yang didapatkan adalah sebagai berikut.<br><br>Rekomendasi skema PS beserta bobotnya:<br><table class="table table-bordered table-striped"><tr><th>No</th><th>Skema PS</th><th>Bobot</th></tr>';
                best_skema = '';
                $.each(response[0], function(f, v) {
                    if (f == 0) best_skema = '<li>Skema PS <strong>' + v.alternative + '</strong> menjadi skema PS yang paling direkomendasikan, dengan nilai bobot sebesar <strong>' + (v.weight).toFixed(5) + '</strong>.</li>';
                    txt += '<tr><td>'+(f+1)+'</td><td>'+v.alternative+'</td><td>'+(v.weight).toFixed(5)+'</td></tr>';
                });
                txt += '</table><br>';
                txt += 'Uji Kekonsistenan Preferensi:<br><table class="table table-bordered table-striped">';
                if (lst_criteria.length > 2){
                    txt += '<tr><td>Nilai kekonsistenan kriteria</td><td>'+(response[1]).toFixed(5)+'</td></tr>';
                    if (response[1] > 0.1)
                        txt_consistency.push('nilai kekonsistenan kriteria sama dengan ' + (response[1]).toFixed(5));
                } else txt += '<tr><td>Nilai kekonsistenan kriteria</td><td><em>Tidak dihitung, karena jumlah kriteria hanya 2.</em></td></tr>';
                if (response[2].length) {
                    $.each(response[2], function(f, v) {
                        txt += '<tr><td>Nilai kekonsistenan alternatif (skema PS) sehubungan dengan kriteria "'+lst_criteria[f]+'"</td><td'+(v > 0.1 ? ' class="btn-danger" title="Tidak konsisten"' : '')+'>'+v.toFixed(5)+'</td></tr>';
                        if (v > 0.1) txt_consistency.push('nilai kekonsistenan alternatif (skema PS) sehubungan dengan kriteria ' + lst_criteria[f] + ' sama dengan <u>' + v.toFixed(5) + '</u>');
                    });
                } else txt += '<tr><td>Nilai kekonsistenan alternatif (skema PS)</td><td><em>Tidak dihitung, karena jumlah alternatif (skema PS) hanya 2.</em></td></tr>';
                txt += '<tr><td>Nilai kekonsistenan yang diinginkan</td><td class="btn-success text-bold">&le; 0.1</td></tr></table><br>';
                btnubah = '<button type="button" id="edit_step3" class="btn btn-primary mb-1" onclick="openAHP()"><i class="fas fa-edit"></i> Ubah AHP</button> ';
                if (response[3]) {
                    if (alternative_split.length > 2 || lst_criteria.length > 2)
                        txtkonsisten = '<li>Tidak terdapat nilai kekonsistenan yang lebih besar daripada nilai yang diinginkan. Dengan demikian, hasil penilaian preferensi <strong>konsisten</strong>.</li>';
                    else txtkonsisten = '';
                    txtubah = 'Jika Anda ingin mengubah kriteria dan/atau bobot AHP, silakan klik Ubah AHP. ';
                    txtlanjut = 'Jika Anda merasa hasil perhitungan AHP sudah sesuai, silakan klik Lanjut. ';
                    btnlanjut = '<button type="button" id="proceed_step3" class="btn btn-success mb-1" onclick="finalizeAHP()"><i class="fas fa-angle-double-right"></i> Lanjut</button>';
                } else {
                    txtkonsisten = '<li>Terdapat nilai kekonsistenan yang lebih besar daripada nilai yang diinginkan. Dalam hal ini:<br><ul><li>' + txt_consistency.join('</li><li>') + '</li></ul>Dengan demikian, hasil penilaian preferensi <strong>tidak konsisten</strong>, dan pemberian bobot preferensi <strong>perlu ditinjau kembali</strong>.</li>';
                    txtubah = 'Untuk mengubah kriteria dan/atau bobot AHP, silakan klik Ubah AHP. ';
                    txtlanjut = '';
                    btnlanjut = '';
                }
                txt += 'Kesimpulan:<ul>'+best_skema+txtkonsisten+'</ul>';
                $('#ahp-result').html(txt+txtubah+txtlanjut+'<br><br>'+btnubah+btnlanjut);
                $('html,body').animate({scrollTop: $('#ahp-result').offset().top - 60},'slow');
            }
        });
    }
}

function openAHP() {
    $('input').prop('disabled','');
    $('#btn_criteria').prop('disabled','');
    $('#submit_step3').prop('disabled','');
    $('#txt_objective').prop('disabled','');
    $('#ahp-result').html('<em>Hasil dari perhitungan AHP akan ditampilkan di sini.</em>');
    $('html,body').animate({scrollTop: $('#ahp-criteria').offset().top - 60},'slow');
}

function finalizeAHP() {
    if (confirm('Dengan mengklik tombol Lanjut, pengisian AHP akan dianggap selesai. Kriteria dan/atau bobot AHP tidak akan bisa diubah lagi.\n\nApakah Anda yakin ingin melanjutkan?')) {
        $('#proceed_step3').prop('disabled','disabled').html('<i class="fas fa-angle-double-right"></i> <em>Mohon tunggu...</em>');
        $("body").css("cursor", "progress");
        proposal_id = $('#hdn_proposalID').val();
        urlParam = $('#hdn_urlparam').val();
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });
        $.ajax({
            url: '/ahp/finalize',
            type: 'POST',
            data: { proposal_id: proposal_id },
            success: function(response) {
                window.location.replace('/' + response + '/' + urlParam);
                $("body").css("cursor", "default");
            }
        });
    }
}

function activateSaveBtn() {
    skema_ps = $('input[name=rdo_skemaps]:checked').val();
    if (skema_ps) $('#submit_skemaps').prop('disabled', '');
        else $('#submit_skemaps').prop('disabled', 'disabled');
}

function finalizeSkemaPS() {
    $('#submit_skemaps').prop('disabled', 'disabled').html('<i class="fas fa-save"></i> <em>Mohon tunggu...</em>');
    $("body").css("cursor", "progress");
    proposal_id = $('#hdn_proposalID').val();
    skema_ps = $('input[name=rdo_skemaps]:checked').val();
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });
    $.ajax({
        url: '/result/finalize',
        type: 'POST',
        data: { proposal_id: proposal_id, skema_ps: skema_ps },
        success: function(response) {
            $("body").css("cursor", "default");
            window.location.reload();
        }
    });
}

function toggleDetailRegion(id) {
    if ($("#tr_" + id).css("display") == "none")
        $("#chevron_" + id).html('<i class="fa fa-chevron-circle-up"></i>');
    else $("#chevron_" + id).html('<i class="fa fa-chevron-circle-down"></i>');
    $("#tr_" + id).fadeToggle();
}

function getDetailTabular() {
    id = $('#master_tabular_id').val();
    if (id) {
        $.ajax({
            url: '/tabular/listdetail/' + id,
            type: 'GET',
            cache: false,
            success: function (response) {
                list = '<option value="">Pilih Data</option>';
                $.each(response, function(f, v) {
                    list += '<option value="'+v.id+'">'+v.name+'</option>';
                });
                $('#detail_tabular_id').html(list).prop('disabled', '');
            }
        })
    } else {
        $('#detail_tabular_id').html('').prop('disabled', 'disable');
    }
    $('#span_datatype').html('');
}

function getDtlTabDatatype() {
    id = $('#detail_tabular_id').val();
    if (id) {
        $.ajax({
            url: '/tabular/datatype/' + id,
            type: "GET",
            cache: false,
            success: function (response) {
                $('#span_datatype').html(response);
            }
        })
    } else $('#span_datatype').html('');
}

function updateEcoVal() {
    amount = $('#production_amount').val();
    price = $('#unit_price').val();
    if (amount && price) {
        ecoval = amount * price;
        $('#span_ecovalue').html(ecoval.toLocaleString('id-ID'));
        $('#economic_value').val(ecoval);
    }
}

// https://css-tricks.com/snippets/javascript/get-url-variables/
function getQueryVariable(variable) {
    var query = window.location.search.substring(1);
    var vars = query.split("&");
    for (var i=0;i<vars.length;i++) {
        var pair = vars[i].split("=");
        if(pair[0] == variable){ return pair[1]; }
    }
    return(false);
}
function getQueryVariables() {
    var query = window.location.search.substring(1);
    var vars = query.split("&");
    var arrays = {};
    for (var i=0;i<vars.length;i++) {
        var pair = vars[i].split("=");
        // if(pair[0] == variable){ return pair[1]; }
        arrays[pair[0]] = pair[1];
    }
    if (arrays) return arrays;
        else return(false);
}

// src: https://blog.abelotech.com/posts/number-currency-formatting-javascript/
function formatNumber(num) {
    return num.toString().replace(/\./g, ',').replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
}

function removeNonNumeric(where) {
	elm = $("#" + where.id);
    elm.val((elm.val()).replace(/[^+0-9.,]/g, ''));
}

function removeItemList() {
    $(".itemlist").remove();
}

function clearInput(id) {
    $("#" + id + "-name").val("");
    $("#" + id).val("");
}

function getItemList(type, target) {
    removeItemList();
    if (type == 'kabkota') idref = $('#provinsi').val();
        else idref = '';
    term = $('#' + target).val();
    if (term.length > 2) {
        $.ajax({
            url: '/' + type + '/getlist/' + term + (idref.length ? '/' + idref : ''),
            type: 'GET',
            cache: true,
            success: function (response) {
                list = '<div id="list-'+type+'" class="itemlist"><ul>';
                i = 0;
                if (response.length) {
                    $.each(response, function (f, v) {
                        list += '<li onClick="setItemList(\''+type+'\', '+v.id+')">'+v.name+'</li>';
                        i++;
                    });
                } else {
                    list += '<li onClick="clearInput(\''+type+'\'); removeItemList();">Tidak ada saran</li>';
                    i = 1;
                }
                list += '</ul></div>';
                elm = $('#' + target);
                posX = elm.offset().left;
                posY = elm.offset().top - 20;
                zIndex = 100;
                $(".content-wrapper").append(list);
                $("#list-" + type).css({'top': posY, 'left': posX, 'height': (i*28 + 2), 'zIndex': zIndex});
            }
        })
    }
}

function setItemList(type, id) {
    removeItemList();
    $.ajax({
        url: '/' + type + '/set/' + id,
        type: 'GET',
        cache: false,
        success: function (response) {
            $('#' + type + '-name').val(response.name);
            $('#' + type).val(response.id);
        }
    })
}

function clearFile(type, where) {
    $('#cur_' + where).val('');
    if (type == 'image') {
        $('#a-' + where).attr('href', APP_URL + '/img/NO_IMAGE.png');
        $('#img-' + where).attr('src', APP_URL + '/img/NO_IMAGE.png');
    } else {
        $('#a-' + where).attr('href', '#');
        $('#a-' + where).html('');
    }
    $('#btn_del' + where).attr('disabled', 'disabled');
}

function exportPDF(url, shp, idd) {
    var genmap = window.open('/result/map/'+url+'?s='+shp+'&d='+idd, '_blank', 'width=450, height=250');
    var timer = setInterval(function() { if (genmap.closed) { window.open('/result/pdf/'+url); clearInterval(timer); } }, 500);
}

function addToDashboard(type, where='', id=0) {
    if (type == 'slider') idxSlider++;
    if (type == 'infobox') idxInfobox++;
    if (type == 'chart') idxChart++;
    if (type == 'article') idxArticle++;
    if (idxSlider) $('#tbl_slider').removeClass('d-none');
    if (idxInfobox) $('#tbl_infobox').removeClass('d-none');
    if (idxChart) $('#tbl_chart').removeClass('d-none');
    if (idxArticle) $('#tbl_article').removeClass('d-none');
    if (type == 'slider') {
        $('#tbl_' + type).append('<tr id="tr_slider_' + idxSlider + '"><td class="col-5"><input type="file" id="file_slider_' + idxSlider + '" name="file_slider_' + idxSlider + '" accept="image/png, image/jpeg"></td><td class="col-6"><input type="text" id="title_slider_' + idxSlider + '" name="title_slider_' + idxSlider + '" class="form-control" placeholder="Judul"><input type="text" id="description_slider_' + idxSlider + '" name="description_slider_' + idxSlider + '" class="form-control" placeholder="Deskripsi"><input type="text" id="url_slider_' + idxSlider + '" name="url_slider_' + idxSlider + '" class="form-control" placeholder="URL"></td><td class="col-1"><span class="text-danger" title="Hapus" onclick="$(\'#tr_slider_' + idxSlider + '\').fadeOut(500, function() { $(this).remove() })"><i class="fas fa-trash"></i></span></td></tr>');
    } else {
        $.ajax({
            url: '/' + type + '/getlist',
            type: 'GET',
            cache: true,
            success: function(response) {
                sel = '<input type="hidden" id="hdn_' + type + '_' + (type=='chart' ? idxChart : (type=='article' ? idxArticle : idxInfobox)) + '" name="hdn_' + type + '_' + (type=='chart' ? idxChart : (type=='article' ? idxArticle : idxInfobox)) + '"><select id="sel_' + type + '_' + (type=='chart' ? idxChart : (type=='article' ? idxArticle : idxInfobox)) + '" name="sel_' + type + '_' + (type=='chart' ? idxChart : (type=='article' ? idxArticle : idxInfobox)) + '" class="item-dashboard2 form-control" onchange="$(\'#sel_' + type + '_' + (type=='chart' ? idxChart : (type=='article' ? idxArticle : idxInfobox)) + '\').prop(\'disabled\', \'disabled\');$(\'#hdn_' + type + '_' + (type=='chart' ? idxChart : (type=='article' ? idxArticle : idxInfobox)) + '\').val($(\'#sel_' + type + '_' + (type=='chart' ? idxChart : (type=='article' ? idxArticle : idxInfobox)) + '\').val())"><option value="">--- Pilih ---</option>';
                if (response.length) {
                    $.each(response, function(f, v) {
                        if (type == 'article') {
                            sel += '<option value="' + v.id + '">' + ((v.title).length < 70 ? v.title : (v.title).substring(0, 70) + '...')  + ' [' + v.name + ', ' + v.published_at + ']</option>';
                        } else if (type == 'chart') {
                            sel += '<option value="' + v.id + '">' + ((v.name).length < 100 ? v.name : (v.name).substring(0, 100) + '...') + '</option>';
                        } else {
                            sel += '<option value="' + v.id + '">' + ((v.title).length < 100 ? v.title : (v.title).substring(0, 100) + '...') + '</option>';
                        }
                    });
                } else {
                    sel += '<option value="">--- Tidak ada data ---</option>';
                }
                sel += '</option>';
                $('#tbl_' + type).append('<tr id="tr_' + type + '_' + (type=='chart' ? idxChart : (type=='article' ? idxArticle : idxInfobox)) + '"><td class="col-11">' + sel + '</td><td class="col-1"><span class="text-danger" title="Hapus" onclick="$(\'#tr_' + type + '_' + (type=='chart' ? idxChart : (type=='article' ? idxArticle : idxInfobox)) + '\').fadeOut(500, function() { $(this).remove() })"><i class="fas fa-trash"></i></span></td></tr>');
            }
        });
    }
}

function getDashboardItemName(type, id, where) {
    switch (type) {
        case 'infobox': method = 'title'; break;
        case 'chart': method = 'name'; break;
        case 'article': method = 'title'; break;
    }
    $.ajax({
        url: '/' + type + '/' + method + '/' + id,
        type: 'GET',
        cache: false,
        success: function (response) {
            // console.log(response);
            if (type == 'article') {
                txt = ((response.title).length < 70 ? response.title : (response.title).substring(0, 70) + '...')  + ' [' + response.name + ', ' + response.published_at + ']';
                $('#' + where).val(txt);    
                $('#' + where).attr('title', txt);    
            } else $('#' + where).val(response.name);
        }
    });
}

function genDashboardArticle(id, target) {
    if (id) {
        $.ajax({
            url: '/article/title/' + id,
            type: 'GET',
            cache: false,
            success: function (response) {
                // console.log(response);
                elm = '<div class="item-dashboard"><img class="img-thumbnail img-fluid img-lst-thumbnail mb-2 mx-auto d-block" src="' + APP_URL + '/img/' + ((response.headline_image).length ? 'headline/' + response.headline_image : 'NO_IMAGE.png') + '"/><h5><a href="/article/' + response.slug + '">' + response.title + '</a></h5><p>' + response.excerpt + '</p></div>';
                // elm = '<div class="item-dashboard row"><div class="col-2"><img class="img-thumbnail img-fluid img-lst-thumbnail" src="' + APP_URL + '/img/' + ((response.headline_image).length ? 'headline/' + response.headline_image : 'NO_IMAGE.png') + '"/></div><div class="col-10"><h5>' + response.title + '</h5><p>' + response.excerpt + '</p></div></div>';
                // elm = '<div class="card bg-dark text-white"><img class="card-img" src="' + APP_URL + '/img/' + ((response.headline_image).length ? 'headline/' + response.headline_image : 'NO_IMAGE.png') + '"/><div class="card-img-overlay"><h5 class="card-title"><strong>' + response.title + '</strong></h5><p class="card-text">' + response.excerpt + '</p></div></div>';
                $('#' + target).html(elm);
            }
        });
    }
}

function genInfobox(id='', data='', target) {
    if (data == '' && id != '') {
        data_infobox = function() {
            var ret;
            $.ajax({ url: '/infobox/load/' + id, type: 'GET', cache: false, dataType: 'json', async: false, success: function (response) { ret = response; } });
            return ret;
        }();
    } else data_infobox = data;
    if (data_infobox != '') {
        innerhtml = '<div class="inner"><p>'+data_infobox.title+'</p><h3>'+data_infobox.amount+'</h3></div><div class="icon"><i class="fas fa-'+data_infobox.icon+'"></i></div>';
        switch (data_infobox.color) {
            case 'blue': bg = 'bg-primary'; break;
            case 'green': bg = 'bg-success'; break;
            case 'yellow': bg = 'bg-warning'; break;
            case 'red': bg = 'bg-danger'; break;
        }
        $("#"+target).html(innerhtml).addClass(bg);
    }
}

function genChart(id='', data='', target) {
    if (data == '' && id != '') {
        data_chart = function() {
            var ret;
            $.ajax({ url: '/chart/load/' + id, type: "GET", cache: false, dataType: 'json', async: false, success: function (response) { ret = response; } });
            return ret;
        }();
    } else data_chart = data;
    if (data_chart != '') {
        // console.log(data_chart);
        // var colors = ['#00a65a', '#f3cc12', '#00c0ef', '#f56954', '#d26dde', '#3c8dbc', '#605cff', '#3d9970', '#ff851b', '#3344cc', '#FFCD56', '#4BC0C0', '#36A2EB', '#FF6384', '#FF9F40'];
        var colors = ['#218B82', '#F4C815', '#4382BB', '#F27348', '#EEB8C5', '#8EA4C8', '#DB93A5', '#938F43', '#A9C8C0', '#F9968B', '#26474E', '#9C9359', '#F7CE76', '#81B1CC', '#CA9C95'];
        var chartCanvas = $('#' + target).get(0).getContext('2d');
        var datasets = [];
        for (var i=0; i<data_chart[1].length; i++) {
            var dataset = {};
            dataset['data'] = data_chart[1][i].data;
            if (data_chart[4] == 'pie') {
                dataset['backgroundColor'] = colors;
                dataset['borderColor'] = colors;
            } else {
                dataset['label'] = data_chart[1][i].label;
                dataset['backgroundColor'] = colors[i];
                dataset['borderColor'] = colors[i];
            }
            if (data_chart[4] == 'line') dataset['fill'] = false;
            datasets[i] = dataset;
        }
        var chartData = {
            "labels"  : (data_chart[0].length ? data_chart[0] : [data_chart[2]]),
            "datasets": datasets,
        };
        switch (data_chart[4]) {
            case 'stackbar': case 'bar': chartType = 'bar'; break;
            case 'line': case 'area': chartType = 'line'; break;
            case 'pie': chartType = 'pie'; break;
        }
        switch (data_chart[4]) {
            case 'line': case 'area':
                chartOptions = {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: { position: 'bottom' },
                    scales: {
                        yAxes: [{
                            ticks: { beginAtZero: true },
                            scaleLabel: {
                                display: true,
                                labelString: 'Jumlah'
                            },
                        }]
                    },
                    title: {
                        text: data_chart[2],
                        display: true,
                    },
                };
                break;
            case 'pie':
                chartOptions = {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: { position: 'bottom' },
                    animation: { animateScale: true },
                    title: {
                        text: data_chart[2],
                        display: true,
                    },
                };
                break;
            case 'stackbar':
                chartOptions = {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: { position: 'bottom' },
                    scales: {
                        xAxes: [{ stacked: true }],
                        yAxes: [{
                            stacked: true,
                            ticks: { beginAtZero: true },
                            scaleLabel: {
                                display: true,
                                labelString: 'Jumlah'
                            },
                        }],
                    },
                    title: {
                        text: data_chart[2],
                        display: true,
                    },
                }
                break;
            case 'bar':
                chartOptions = {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: { position: 'bottom' },
                    scales: {
                        xAxes: [{ stacked: false }],
                        yAxes: [{
                            stacked: false,
                            ticks: { beginAtZero: true },
                            scaleLabel: {
                                display: true,
                                labelString: 'Jumlah'
                            },
                        }],
                    },
                    title: {
                        text: data_chart[2],
                        display: true,
                    },
                };
                break;
        }
        new Chart(chartCanvas, {
            type: chartType,
            data: chartData,
            options: chartOptions,
        });
    }
}