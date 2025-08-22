@extends('partials.template_admin')

@section('menu_content')
<h5>{{ $page_title2 }}</h5>
<form action="/admin/appinfo" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put')
    <table class="table table-borderless">
        <tr>
            <td>Kode Aplikasi <span class="text-danger">*</span></td>
            <td>
                <input type="text" id="code" name="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code', $data->code) }}" required>
                @error('code')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </td>
        </tr>
        <tr>
            <td>Nama Aplikasi <span class="text-danger">*</span></td>
            <td>
                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $data->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </td>
        </tr>
        <tr>
            <td>Deskripsi <span class="text-danger">*</span></td>
            <td>
                <input type="text" id="description" name="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description', $data->description) }}" required>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </td>
        </tr>
        <tr>
            <td>Logo Aplikasi</td>
            <td>
                <a id="a-logo" href="{{ $data->logo ? asset('img') . "/" . $data->logo : asset('img') . "/NO_IMAGE.png" }}" target="_blank"><img id="img-logo" class="img-fluid img-dtl-commodity d-block mb-1" src="{{ $data->logo ? asset('img') . "/" . $data->logo : asset('img') . "/NO_IMAGE.png" }}"></a>
                <input type="hidden" id="hdn_logo" name="hdn_logo" value="{{ $data->logo }}">
                <input type="hidden" id="cur_logo" name="cur_logo" value="{{ $data->logo }}">
                <button type="button" id="btn_delphoto" class="btn btn-danger btn-sm" onclick="clearFile('image','logo')" title="Hapus gambar" @if (!$data->logo) disabled @endif><i class="fas fa-trash"></i></button> <input type="file" id="logo" name="logo" accept="image/png, image/jpeg"></textarea>
            </td>
        </tr>
        <tr>
            <td>No. Telepon</td>
            <td><input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', $data->phone) }}"></td>
        </tr>
        <tr>
            <td>No. WhatsApp</td>
            <td><input type="text" id="whatsapp" name="whatsapp" class="form-control" value="{{ old('whatsapp', $data->whatsapp) }}"></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="text" id="email" name="email" class="form-control" value="{{ old('email', $data->email) }}"></td>
        </tr>
        <tr>
            <td>Link Facebook</td>
            <td><input type="text" id="facebook" name="facebook" class="form-control" value="{{ old('facebook', $data->facebook) }}"></td>
        </tr>
        <tr>
            <td>Akun Twitter</td>
            <td><input type="text" id="twitter" name="twitter" class="form-control" value="{{ old('twitter', $data->twitter) }}"></td>
        </tr>
        <tr>
            <td>Akun Instagram</td>
            <td><input type="text" id="instagram" name="instagram" class="form-control" value="{{ old('instagram', $data->instagram) }}"></td>
        </tr>
        <tr>
            <td>Link Kanal YouTube</td>
            <td><input type="text" id="youtube" name="youtube" class="form-control" value="{{ old('youtube', $data->youtube) }}"></td>
        </tr>
        <tr>
            <td>Akun TikTok</td>
            <td><input type="text" id="tiktok" name="tiktok" class="form-control" value="{{ old('tiktok', $data->tiktok) }}"></td>
        </tr>
        <tr>
            <td>Panduan (MP4)</td>
            <td>
                @if ($data->guide_mp4) <a id="a-guide_mp4" href="/guides/mp4" target="_blank" title="Tampilkan">{{ $data->guide_mp4 }}</a><br> @endif
                <input type="hidden" id="hdn_guide_mp4" name="hdn_guide_mp4" value="{{ $data->guide_mp4 }}">
                <input type="hidden" id="cur_guide_mp4" name="cur_guide_mp4" value="{{ $data->guide_mp4 }}">
                <button type="button" id="btn_delguide_mp4" class="btn btn-danger btn-sm" onclick="clearFile('nonimage', 'guide_mp4')" title="Hapus file" @if (!$data->guide_mp4) disabled @endif><i class="fas fa-trash"></i></button> <input type="file" id="guide_mp4" name="guide_mp4" accept="video/mp4,video/x-m4v,video/*"></td>
        </tr>
        <tr>
            <td>Panduan (PDF)</td>
            <td>
                @if ($data->guide_pdf) <a href="/guides/pdf" target="_blank" title="Tampilkan">{{ $data->guide_pdf }}</a><br> @endif
                <input type="hidden" id="hdn_guide_pdf" name="hdn_guide_pdf" value="{{ $data->guide_pdf }}">
                <input type="hidden" id="cur_guide_pdf" name="cur_guide_pdf" value="{{ $data->guide_pdf }}">
                <button type="button" id="btn_delguide_pdf" class="btn btn-danger btn-sm" onclick="clearFile('nonimage', 'guide_pdf')" title="Hapus file" @if (!$data->guide_pdf) disabled @endif><i class="fas fa-trash"></i></button> <input type="file" id="guide_pdf" name="guide_pdf" accept="application/pdf">
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