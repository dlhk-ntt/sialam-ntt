@extends('partials.template_admin')

@section('menu_content')
<h5>{{ $page_title2 }}</h5>
<form action="/admin/linkmoodle" method="POST">
    @csrf
    @method('put')
    <table class="table table-borderless">
        <tr>
            <td>URL Moodle</td>
            <td>
                <input type="text" id="moodle_url" name="moodle_url" class="form-control" value="{{ old('moodle_url', $data->moodle_url) }}">
            </td>
        </tr>
        <tr>
            <td>Token Moodle</td>
            <td>
                <input type="text" id="moodle_token" name="moodle_token" class="form-control" value="{{ old('moodle_token', $data->moodle_token) }}">
            </td>
        </tr>
        <tr>
            <td>Token Moodle Kedaluwarsa Pada</td>
            <td>
                <input type="date" id="moodle_token_expired" name="moodle_token_expired" class="form-control" value="{{ old('moodle_token_expired', $data->moodle_token_expired) }}">
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: right">
                <button type='submit' class='btn btn-primary' value='Simpan'><i class="fas fa-save"></i> Simpan</button>
            </td>
        </tr>
    </table>
</form>
@stop