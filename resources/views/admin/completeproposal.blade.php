@extends('partials.template_admin')

@section('menu_content')
<h5>{{ $page_title2 }}</h5>
<table class='table table-hover'>
    <thead>
    <tr>
        <th>No</th>
        <th>Nama Pengguna</th>
        <th>Keterangan</th>
        <th>Diselesaikan</th>
        <th>Proses ke Moodle</th>
        <th>Aksi</th>
    </tr>
    </thead>
    <tbody>
        @if (count($data))
        @foreach ($data as $d)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $d->user->username }}</td>
                <td>
                    Skema PS Terpilih: <strong>{{ $d->skemaps }}</strong><br>
                    Daerah: <span id="chevron_{{ $d->id }}" class="chevron" title="Klik untuk menampilkan/menyembunyikan detail daerah" onClick="toggleDetailRegion({{ $d->id }})"><i class="fa fa-chevron-circle-down"></i></span>
                </td>
                <td>{{ date('j F Y, H:i:s', strtotime($d->completed)) }}</td>
                <td>
                    @php
                        switch ($d->process_to_moodle) {
                            case false: echo '<i class="fas fa-times text-danger" title="Belum"></i>'; break;
                            case true: echo '<i class="fas fa-check text-success" title="Sudah"></i>'; break;
                        }
                    @endphp
                </td>
                <td>
                    @if (!$d->process_to_moodle)
                    <form action="/admin/proposal/{{ $d->id }}" method="POST" class="d-inline">
                        @method('put')
                        @csrf
                        <button class="btn btn-success btn-sm" title="Klik di sini jika data PS sudah diproses ke Moodle Akses Lahan"><i class="fas fa-check"></i></button>
                    </form>
                    @endif
                </td>
            </tr>
            <tr id="tr_{{ $d->id }}" style="display: none"><td class="td-detail" colspan="6">Provinsi: {{ $d->nmprov }}, Kabupaten / Kota: {{ $d->nmkab }}, Kecamatan: {{ $d->nmkec }}, Desa: {{ $d->nmdesa }}</td></tr>
        @endforeach
        @else
        <tr><td colspan="6" style="text-align: center">--- Tidak ada data ---</td></tr>
        @endif
    </tbody>
</table>
@stop

