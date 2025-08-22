@extends('partials.original_menu')

@section('menu_content')
<div class="row">
    <div class="col-md-6">
        <table class="table table-borderless">
            <tr><td class="col-4">Nama Pengguna</td><td class="col-8">: {{ $data->username }}</td></tr>
            <tr><td>Nama Lengkap</td><td>: {{ $data->name }} {{ $data->lastname }}</td></tr>
            <tr><td>Email</td><td>: {{ $data->email }}</td></tr>
            <tr><td>No. Telepon</td><td>: {{ $data->phone_no }}</td></tr>
        </table>
    </div>
    <div class="col-md-6">
        <table class="table table-borderless">
            <tr><td class="col-4">Provinsi</td><td class="col-8">: {{ (strlen($data->provinsi) ? $data->provinsi : '-') }}</td></tr>
            <tr><td>Kabupaten/Kota</td><td>: {{ (strlen($data->kabkota) ? $data->kabkota : '-') }}</td></tr>
            <tr><td>Kecamatan</td><td>: {{ (strlen($data->kecamatan) ? $data->kecamatan : '-') }}</td></tr>
            <tr><td>Desa</td><td>: {{ (strlen($data->desa) ? $data->desa : '-') }}</td></tr>
        </table>
    </div>
    <div class="col-12 py-2 d-flex justify-content-end">
        <a href="/user/edit" class="btn btn-primary"><i class="fas fa-edit"></i> Ubah Detail</a>&nbsp;
        <a href="/user/password" class="btn btn-primary"><i class="fas fa-lock"></i> Ubah Password</a>
    </div>
</div>
@stop