@extends('partials.template_admin')

@section('menu_content')
@php
    $cntshown = 0;
@endphp
<h5>{{ $page_title2 }}</h5>
<div id="noteshown" class="alert alert-warning d-none"><i class="fas fa-edit"></i> Terdapat lebih dari satu data spasial yang ditampilkan</div>
<a class="btn btn-primary" href="/admin/shpfile/add"><i class="fas fa-upload"></i> Unggah</a>
<a class="btn btn-primary" href="/admin/shpfile/merge"><i class="fas fa-copy"></i> Gabung</a>
<table class="table table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Tabel</th>
            <th>Nama File SHP</th>
            <th>Sumber</th>
            <th>Regional</th>
            <th>Ditampilkan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @if (count($data))
        @foreach ($data as $d)
        <tr>
            {{-- <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td> --}}
            <td>{{ $loop->iteration }}</td>
            <td><span id="chevron_{{ $d->id }}" class="chevron" title="Klik untuk menampilkan/menyembunyikan detail data spasial" onclick="toggleDetail('admin/shpfile', {{ $d->id }})"><i class="fa fa-chevron-circle-down"></i></span> {{ $d->table_name }}</td>
            <td>{{ $d->shp_filename }}</td>
            <td>
                @if ($d->source == 'merge')
                    <i class="text-primary fas fa-copy" title="Gabung"></i>
                @else
                    <i class="text-primary fas fa-upload" title="Unggah"></i>
                @endif
            </td>
            <td>
                @if ($d->is_regional == 'yes')
                    <i class="text-success fas fa-check" title="Ya"></i>
                @else
                    <i class="text-danger fas fa-times" title="Tidak"></i>
                @endif
            </td>
            <td>
                @if ($d->is_shown == 'yes')
                    <i class="text-success fas fa-check" title="Ya"></i>
                    @php $cntshown++; @endphp
                @else
                    <i class="text-danger fas fa-times" title="Tidak"></i>
                @endif
            </td>
            <td>
                <a href="/admin/shpfile/{{ $d->id }}" class="btn btn-primary btn-sm mt-1" title="Edit"><i class="fas fa-pen"></i></a>
                <a class="btn btn-primary btn-sm mt-1" title="Pratinjau" onClick="previewSHP({{ $d->id }}, 'la')"><i class="fas fa-eye"></i></a>
                <a class="btn btn-primary btn-sm mt-1" title="Pratinjau Per Daerah" onClick="previewOne({{ $d->id }})"><i class="fas fa-search-location"></i></a>
                <form action="/admin/shpfile/{{ $d->id }}" method="POST" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="btn btn-danger btn-sm mt-1" title="Hapus" onclick="return confirm('Apakah anda yakin akan menghapus data?')"><i class="fas fa-trash"></i></button>
                </form>
            </td>
        </tr>
        <tr id="tr_{{ $d->id }}" style="display: none"><td id="td_{{ $d->id }}" class="td-detail" colspan="7">-</td></tr>
        @endforeach
        @else
        <tr><td colspan="7" style="text-align: center">--- Tidak ada data ---</td></tr>
        @endif
    </tbody>
</table>
@stop

@section('customJS')
function previewSHP(id, type) {
    if (type == 'la')
        window.open("/admin/shpfile/" + id + "/preview?mode=all", "_blank", "width=850,height=501");
    else window.open("/admin/shpfile-in/" + id + "/preview?mode=all", "_blank", "width=850,height=501");
}
function previewOne(id) {
    window.open("/admin/shpfile/" + id + "/one", "_blank", "width=620,height=450");
}
@if ($cntshown > 1) $("#noteshown").removeClass('d-none'); @endif
@stop