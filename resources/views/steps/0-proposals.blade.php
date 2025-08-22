@extends('partials.original_menu')

@section('menu_content')
<div class="table-responsive">
    <table class="table table-bordered table-striped">
        {{-- <caption>Daftar Pengajuan Perhutanan Sosial</caption> --}}
        <thead>
            <tr class="bg-icraf-green text-white">
                <th>No</th>
                <th>Daerah</th>
                <th>Sumber Data</th>
                <th>Skema PS Tersedia</th>
                <th>Skema PS Terpilih</th>
                <th>Ditambahkan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if (count($data))
                @foreach ($data as $d)
                @php
                    switch ($d->status) {
                        case 'cancelled': $status = '<img class="icon-proposal" src="' . asset('img/Dibatalkan.png') . '" title="Dibatalkan">'; break;
                        case 'onprocess': $status = '<img class="icon-proposal" src="' . asset('img/On Progress.png') . '" title="Dalam Proses">'; break;
                        case 'completed': $status = '<img class="icon-proposal" src="' . asset('img/Selesai.png') . '" title="Selesai">'; break;
                    }
                    $url = base64_encode($d->id . '_' . $d->user_id . '_' . $d->idd);
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        Provinsi: {{ $d->nmprov }}<br>
                        Kabupaten / Kota: {{ $d->nmkab }}<br>
                        Kecamatan: {{ $d->nmkec }}<br>
                        Desa: {{ $d->nmdesa }}
                    </td>
                    <td>{{ $d->shpfile_src }}</td>
                    <td>{{ str_replace('-', ', ', $d->step1_skemaps) }}</td>
                    <td>{{ strlen($d->result_skemaps) ? $d->result_skemaps : '-' }}</td>
                    <td>{{ date('j F Y, H:i:s', strtotime($d->created_at)) }}</td>
                    <td class="text-center">{!! $status !!}</td>
                    <td>
                        <a class="btn btn-primary btn-sm mb-1" href="/introduction/{{ $url }}" target="_blank" title="Lihat detail pengajuan">
                            <i class="fas fa-eye"></i>&nbsp;&nbsp;Lihat
                        </a>
                        @if ($d->status == 'onprocess')
                        <form action="/proposals/cancel/{{ $url }}" method="POST" class="d-inline">
                            @method('put')
                            @csrf
                            <button class="btn btn-danger btn-sm mb-1" title="Batalkan pengajuan ini" onclick="return confirm('Apakah Anda yakin akan membatalkan pengajuan ini?')">
                                <i class="fas fa-times"></i>&nbsp;&nbsp;Batal
                            </button>
                        </form>
                        @endif
                        @if ($d->status == 'completed')
                            <a class="btn btn-sm bg-icraf-orange text-white mb-1" href="#" onclick="exportPDF('{{ $url }}', '{{ base64_encode($d->shpfile_src) }}', '{{ base64_encode($d->idd) }}')"><i class="fas fa-download"></i> Unduh PDF</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            @else
            <tr><td colspan="8" style="text-align: center">--- Tidak ada data ---</td></tr>
            @endif
        </tbody>
    </table>
</div>
@stop
