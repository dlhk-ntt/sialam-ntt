@extends('partials.original_menu')

@section('menu_content')
<form action="/user/update" method="POST">
    @csrf
    @method('put')
    <div class="row">
        <div class="col-md-6">
            <table class="table table-borderless">
                <tr><td>Nama Pengguna</td><td>{{ Auth::user()->username }}</td></tr>
                <tr>
                    <td>Nama Lengkap<span class="text-danger">*</span></td>
                    <td>
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" autocomplete="off" required value="{{ old('name', $data->name) }}" placeholder="Nama Depan">
                                @error('name') <div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-lg-6">
                                <input type="text" id="lastname" name="lastname" class="form-control @error('lastname') is-invalid @enderror" autocomplete="off" required value="{{ old('lastname', $data->lastname) }}" placeholder="Nama Belakang">
                                @error('lastname') <div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Email <span class="text-danger">*</span></td>
                    <td>
                        <input type="text" id="email" name="email" class="form-control @error('email') is-invalid @enderror" autocomplete="off" required value="{{ old('email', $data->email) }}">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div>@enderror
                    </td>
                </tr>
                <tr>
                    <td>No. Telepon <span class="text-danger">*</span></td>
                    <td>
                        <input type="text" id="phone_no" name="phone_no" class="form-control @error('phone_no') is-invalid @enderror" autocomplete="off" required value="{{ old('phone_no', $data->phone_no) }}">
                        @error('phone_no') <div class="invalid-feedback">{{ $message }}</div>@enderror
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-md-6">
            <table class="table table-borderless">
                <tr>
                    <td>Provinsi</td>
                    <td><input type="text" id="provinsi" name="provinsi" class="form-control" autocomplete="off" value="{{ $data->provinsi }}"></td>
                </tr>
                <tr>
                    <td>Kabupaten/Kota</td>
                    <td><input type="text" id="kabkota" name="kabkota" class="form-control" autocomplete="off" value="{{ $data->kabkota }}"></td>
                </tr>
                <tr>
                    <td>Kecamatan</td>
                    <td><input type="text" id="kecamatan" name="kecamatan" class="form-control" autocomplete="off" value="{{ $data->kecamatan }}"></td>
                </tr>
                <tr>
                    <td>Desa</td>
                    <td><input type="text" id="desa" name="desa" class="form-control" autocomplete="off" value="{{ $data->desa }}"></td>
                </tr>
            </table>
        </div>
        <div class="col-12 py-2 d-flex justify-content-end">
            <a class='btn btn-primary' href='#' onClick='history.back()'><i class="fas fa-times"></i> Batal</a>&nbsp;
            <button type='submit' class='btn btn-primary' value='Simpan'><i class="fas fa-save"></i> Simpan</button>
        </div>
    </div>
</form>
@stop