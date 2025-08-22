@extends('partials.template_admin')

@section('menu_content')
<h5>{{ $page_title2 }}</h5>
<a class="btn btn-primary" href="/admin/user/add"><i class="fas fa-plus"></i> Tambah</a>
<table class='table table-hover'>
    <thead>
    <tr>
        <th>No</th>
        <th>Nama Pengguna</th>
        <th>Nama</th>
        <th>Peran</th>
        <th>Aksi</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($data as $d)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td><span id="chevron_{{ $d->id }}" class="chevron" title="Klik untuk menampilkan/menyembunyikan detail pengguna" onClick="toggleDetail('admin/user', {{ $d->id }})"><i class="fa fa-chevron-circle-down"></i></span> {{ $d->username }}</td>
                <td>{{ $d->name }} {{ $d->lastname }}</td>
                <td>{{ ucwords($d->role) }}</td>
                <td>
                    @if ($d->role != Auth::user()->role & $d->role != 'superadmin')
                        <a href="/admin/user/{{ $d->id }}" class="btn btn-primary btn-sm" title="Edit"><i class="fas fa-pen"></i></a>
                        <a href="/admin/user/pass/{{ $d->id }}" class="btn btn-primary btn-sm" title="Edit Password"><i class="fas fa-lock"></i></a>
                    @endif
                    @if ($d->id != Auth::user()->id & $d->role != Auth::user()->role & $d->role != 'superadmin')
                    <form action="/admin/user/{{ $d->id }}" method="POST" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Apakah anda yakin akan menghapus data?')"><i class="fas fa-trash"></i></button>
                    </form>
                    @endif
                </td>
            </tr>
            <tr id="tr_{{ $d->id }}" style="display: none"><td id="td_{{ $d->id }}" class="td-detail" colspan="5">-</td></tr>
        @endforeach
    </tbody>
</table>
@stop

