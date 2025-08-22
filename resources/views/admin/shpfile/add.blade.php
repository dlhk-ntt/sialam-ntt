@extends('partials.template_admin')

@section('menu_content')
<h5>{{ $page_title2 }}</h5>
<div class="card card-primary card-outline card-outline-tabs">
    <div class="card-header p-0 border-bottom-0">
        <ul class="nav nav-tabs" id="tabs-file" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="tab-file-tab" data-toggle="pill" href="#tab-file" role="tab" aria-controls="tab-file" aria-selected="true">File Terpisah</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tab-zip-tab" data-toggle="pill" href="#tab-zip" role="tab" aria-controls="tab-zip" aria-selected="false">File ZIP</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="tab-file-content">
            <div class="tab-pane fade show active" id="tab-file" role="tabpanel" aria-labelledby="tab-file-tab">
                <form action="/admin/shpfile/store" method="POST" enctype="multipart/form-data">
                    @csrf
                    <table class="table table-borderless">
                        <tr>
                            <td>Pilih file SHP<span class="text-danger">*</span></td>
                            <td><input type="file" id="shp_file" name="shp_file" required accept=".shp"></td>
                        </tr>
                        <tr>
                            <td>Pilih file SHX<span class="text-danger">*</span></td>
                            <td><input type="file" id="shx_file" name="shx_file" required accept=".shx"></td>
                        </tr>
                        <tr>
                            <td>Pilih file DBF<span class="text-danger">*</span></td>
                            <td><input type="file" id="dbf_file" name="dbf_file" required accept=".dbf"></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: right">
                                <a class='btn btn-primary' href='/admin/shpfile'><i class="fas fa-times"></i> Batal</a>
                                <button type='submit' class='btn btn-primary' value='Process'><i class="fas fa-arrow-right"></i> Proses</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="tab-pane fade" id="tab-zip" role="tabpanel" aria-labelledby="tab-zip-tab">
                <form action="/admin/shpfile/storezip" method="POST" enctype="multipart/form-data">
                    @csrf
                    <table class="table table-borderless">
                        <tr>
                            <td>Pilih file ZIP<span class="text-danger">*</span></td>
                            <td><input type="file" id="zip_file" name="zip_file" required accept=".zip"></td>
                        </tr>
                        <tr>
                            <td>Struktur File</td>
                            <td><img src="{{ asset('img/shpzipfile_structure.png') }}"></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: right">
                                <a class='btn btn-primary' href='/admin/shpfile'><i class="fas fa-times"></i> Batal</a>
                                <button type='submit' class='btn btn-primary' value='Process'><i class="fas fa-arrow-right"></i> Proses</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

@stop