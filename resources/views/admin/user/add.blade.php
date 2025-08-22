@extends('partials.template_admin')

@section('menu_content')
<h5>{{ $page_title2 }}</h5>
<form action="/admin/user/store" method="POST">
    @csrf
    <table class="table table-borderless">
        <tr>
            <td>Nama Pengguna <span class="text-danger">*</span></td>
            <td>
                <input type="text" id="username" name="username" class="form-control @error('username') is-invalid @enderror" autocomplete="off" required value="{{ old('username') }}" placeholder="Nama Pengguna">
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </td>
        </tr>
        <tr>
            <td>Nama Lengkap <span class="text-danger">*</span></td>
            <td>
                <div class="row">
                    <div class="col-lg-6">
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" autocomplete="off" required value="{{ old('name') }}" placeholder="Nama Depan">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-lg-6">
                        <input type="text" id="lastname" name="lastname" class="form-control @error('lastname') is-invalid @enderror" autocomplete="off" required value="{{ old('lastname') }}" placeholder="Nama Belakang">
                        @error('lastname')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td>Email <span class="text-danger">*</span></td>
            <td>
                <input type="text" id="email" name="email" class="form-control @error('email') is-invalid @enderror" autocomplete="off" required value="{{ old('email') }}" placeholder="name@example.com">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </td>
        </tr>
        <tr>
            <td>No. Telepon <span class="text-danger">*</span></td>
            <td>
                <input type="text" id="phone_no" name="phone_no" class="form-control @error('phone_no') is-invalid @enderror" autocomplete="off" required value="{{ old('phone_no') }}" placeholder="No. Telepon">
                @error('phone_no')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </td>
        </tr>
        <tr>
            <td>Peran <span class="text-danger">*</span></td>
            <td>
                <select id="role" name="role" class="form-control" required>
                    @if (Auth::user()->role == "superadmin")
                        <option value="">Pilih Peran</option>
                        <option value="admin">Admin</option>
                    @endif
                    <option value="moodle_user">Moodle User</option>
                    {{-- <option value="viewer">Viewer</option> --}}
                </select>
                @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </td>
        </tr>
        <tr>
            <td>Password <span class="text-danger">*</span></td>
            <td>
                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" autocomplete="off" required placeholder="Password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </td>
        </tr>
        <tr>
            <td>Ketik Ulang Password <span class="text-danger">*</span></td>
            <td>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" autocomplete="off" required placeholder="Ketik Ulang Password">
                @error('password_confirmation')
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