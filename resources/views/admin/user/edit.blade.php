@extends('partials.template_admin')

@section('menu_content')
<h5>{{ $page_title2 }}</h5>
<form action="/admin/user/{{ $data->id }}" method="POST">
    @csrf
    @method('put')
    <table class="table table-borderless">
        <tr><td>Nama Pengguna</td><td>{{ $data->username }}</td></tr>
        <tr>
            <td>Nama Lengkap</td>
            <td>
                <div class="row">
                    <div class="col-lg-6">
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" autocomplete="off" required value="{{ old('name', $data->name) }}" placeholder="Nama Depan">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-lg-6">
                        <input type="text" id="lastname" name="lastname" class="form-control @error('lastname') is-invalid @enderror" autocomplete="off" required value="{{ old('name', $data->lastname) }}" placeholder="Nama Belakang">
                        @error('lastname')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td>Email</td>
            <td>
                <input type="text" id="email" name="email" class="form-control @error('email') is-invalid @enderror" autocomplete="off" required value="{{ old('email', $data->email) }}" placeholder="name@example.com">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </td>
        </tr>
        <tr>
            <td>No. Telepon</td>
            <td>
                <input type="text" id="phone_no" name="phone_no" class="form-control @error('phone_no') is-invalid @enderror" autocomplete="off" required value="{{ old('phone_no', $data->phone_no) }}" placeholder="No. Telepon">
                @error('phone_no')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </td>
        </tr>
        <tr>
            <td>Peran</td>
            <td>
                <select id="role" name="role" class="form-control" required>
                    @if (Auth::user()->role == "superadmin")
                        <option value="">Pilih Peran</option>
                        <option value="admin" @if(old('role') == 'admin' || $data->role == 'admin') selected @endif>Admin</option>
                    @endif
                    <option value="moodle_user" @if(old('role') == 'moodle_user' || $data->role == 'moodle_user') selected @endif>Moodle User</option>
                    {{-- <option value="viewer">Viewer</option> --}}
                </select>
                @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
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
