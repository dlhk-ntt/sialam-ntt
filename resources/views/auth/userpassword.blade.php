@extends('partials.original_menu')

@section('menu_content')
<form action="/user/updatepass" method="POST">
    @csrf
    @method('put')
    <table class="table table-borderless">
        <tr><td>Nama Pengguna</td><td>{{ Auth::user()->username }}</td></tr>
        <tr>
            <td>Password Baru <span class="text-danger">*</span></td>
            <td>
                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" autocomplete="off" required>
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </td>
        </tr>
        <tr>
            <td>Ketik Ulang Password Baru <span class="text-danger">*</span></td>
            <td>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control @error('password_comfirmation') is-invalid @enderror" autocomplete="off" required>
                @error('password_confirmation') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: right">
                <a class='btn btn-primary' href='#' onClick='history.back()'><i class="fas fa-times"></i> Batal</a>&nbsp;
                <button type='submit' class='btn btn-primary' value='Simpan'><i class="fas fa-save"></i> Simpan</button>    
            </td>
        </tr>
    </table>
</form>
@stop