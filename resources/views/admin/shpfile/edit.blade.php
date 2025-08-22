@extends('partials.template_admin')

@section('menu_content')
<h5>{{ $page_title2 }}</h5>
<form action="/admin/shpfile/{{ $data->id }}" method="POST">
    @csrf
    @method('put')
    <table class="table table-borderless">
        <tr>
            <td>Nama Tabel</td>
            <td>{{ $data->table_name }}</td>
        </tr>
        <tr>
            <td>Nama File SHP</td>
            <td>{{ $data->shp_filename }}</td>
        </tr>
        <tr>
            <td>Kolom Tersedia</td>
            <td>{{ str_replace(',', ', ', $data->available_fields) }}</td>
        </tr>
        <tr>
            <td>Kolom Terpilih</td>
            <td class="row">
                @php $fields = explode(',', $data->available_fields) @endphp
                @foreach ($fields as $f)
                    <div class="form-group col-3">
                        <input type="checkbox" id="sel_fields" name="sel_fields[]" value="{{ $f }}" @if (str_contains($data->selected_fields, $f)) checked @endif> {{ $f }}
                    </div>
                @endforeach
            </td>
        </tr>
        <tr>
            <td>Regional</td>
            <td>
                <input type="checkbox" id="is_regional" name="is_regional" @if($data->is_regional == "yes") checked @endif> Ya
            </td>
        </tr>
        <tr>
            <td>Ditampilkan</td>
            <td>
                <input type="checkbox" id="is_shown" name="is_shown" @if($data->is_shown == "yes") checked @endif> Ya
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: right">
                <a class='btn btn-primary' href='#' onClick='history.back()'><i class="fas fa-times"></i> Batal</a>
                <button type='submit' class='btn btn-primary' value='Simpan'><i class="fas fa-save"></i> Simpan</button>
            </td>
        </tr>
    </table>
</form>
@stop