@extends('partials.template_admin')

@section('menu_content')
<h5>{{ $page_title2 }}</h5>
<form action="/admin/shpfile/domerge" method="POST">
    @csrf
    {{-- @dd($data) --}}
    <table class="table table-borderless">
        <tr>
            <td>Data 1</td>
            <td>
                <select id="sel_data1" name="sel_data1" class="form-control" onchange="checkInput(1)">
                    <option value=''>--- Pilih data ---</option>
                    @foreach ($data as $d)
                        <option value="{{ $d->table_name }}">{{ $d->table_name }}</option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td>Data 2</td>
            <td>
                <select id="sel_data2" name="sel_data2" class="form-control" onchange="checkInput(2)">
                    <option value=''>--- Pilih data ---</option>
                    @foreach ($data as $d)
                        <option value="{{ $d->table_name }}">{{ $d->table_name }}</option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                Pilihan
                <table class="table">
                    <tr>
                        <td>
                            <input type="checkbox" id="chk_new_table" name="chk_new_table" onchange="toggleInput('new_table')">&nbsp;&nbsp;Nama untuk tabel baru
                        </td>
                        <td><input type="text" id="new_table" name="new_table" class="form-control" disabled></td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" id="chk_new_fields" name="chk_new_fields" onchange="showFields()">&nbsp;&nbsp;Nama kolom pada tabel baru
                        </td>
                        <td>
                            <div id="div_fields" style="display: none">-</div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: right">
                <a class='btn btn-primary' href='/admin/shpfile'><i class="fas fa-times"></i> Batal</a>
                <button id="btnProcess" type='submit' class='btn btn-primary' value='Process' disabled><i class="fas fa-arrow-right"></i> Proses</button>
            </td>
        </tr>
    </table>
</form>
@stop

@section('customJS')
function checkInput(which) {
    sel_data1 = $("#sel_data1").val();
    sel_data2 = $("#sel_data2").val();
    if (which == "1") {
        if (sel_data1) {
            sel = $("#sel_data1 option:selected").val();
            $("#sel_data2 option[value='"+sel+"']").attr('disabled','disabled');
        } else $("#sel_data2 option").removeAttr('disabled');
    } else {
        if (sel_data2) {
            sel = $("#sel_data2 option:selected").val();
            $("#sel_data1 option[value='"+sel+"']").attr('disabled','disabled');
        } else $("#sel_data1 option").removeAttr('disabled');
    }
    resetNewFields();
    $("#new_table").val(sel_data1.replace(/_/g, '') + '_' + sel_data2.replace(/_/g, ''));
    if (sel_data1 && sel_data2)
        $("#btnProcess").removeAttr("disabled");
    else $("#btnProcess").prop("disabled", "disabled");
}
function toggleInput(which) {
    if ($("#chk_" + which).prop("checked")) $("#" + which).removeAttr("disabled");
    else $("#" + which).prop("disabled", "disabled");
}
function showFields() {
    $(".wrapper").css('cursor','wait');
    sel_data1 = $("#sel_data1").val();
    sel_data2 = $("#sel_data2").val();
    if (sel_data1 && sel_data2 && $("#chk_new_fields").prop("checked") && $("#div_fields").html() == "-") {
        lstFields = [];
        tblFields = '';
        $.getJSON('/shpfile/field/' + sel_data1, function(data) {
            sel_data1 = sel_data1.replace(/_/g, '');
            (data.split(",")).forEach(f => lstFields.push([sel_data1, f]));
            $.getJSON('/shpfile/field/' + sel_data2, function(data) {
                sel_data2 = sel_data2.replace(/_/g, '');
                (data.split(",")).forEach(f => lstFields.push([sel_data2, f]));
                lstFields.forEach(f => tblFields += '<tr><td>'+f[0]+'</td><td>'+f[1]+'</td><td><input type="text" id="name_'+f[0]+'_'+f[1]+'" name="name_'+f[0]+'_'+f[1]+'" value="'+f[0]+'__'+f[1]+'" class="form-control"></td></tr>');
                tblFields = '<table class="table"><thead><tr><th>Nama Tabel</th><th>Nama Kolom Semula</th><th>Nama Kolom Baru</th></tr></thead><tbody>' + tblFields + '</tbody></table>';
                $("#div_fields").html(tblFields);
            });
        });
    }
    setTimeout(function() {
        $("#div_fields").slideToggle();
        $(".wrapper").css('cursor','default');
    }, 500);
}

function resetNewFields() {
    if ($("#div_fields").css("display") == "block") $("#div_fields").slideUp();
    $("#div_fields").html("-");
    $("#chk_new_fields").prop("checked", null);
}
@stop