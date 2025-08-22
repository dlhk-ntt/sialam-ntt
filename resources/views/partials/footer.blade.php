@if (isset($modal_ps) && $modal_ps == true)
  <a href="#" title="Istilah Perhutanan Sosial" data-toggle="modal" data-target="#modal-legend" id="a-legend">
    <i class="fas fa-info"></i>
  </a>
  <div class="modal fade" id="modal-legend">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" title="Tutup" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body" id="modal-container" name="modal-container" style="text-align: center">
          <h5 class="icraf-orange">Daftar Istilah Perhutanan Sosial</h5>
          <table id="tbl-legendps" class="table table-striped table-bordered">
            <tr class="bg-icraf-green text-white"><th>Singkatan</th><th>Kepanjangan</th></tr>
            <tr><td>HA</td><td>Hutan Adat</td></tr>
            <tr><td>HD</td><td>Hutan Desa</td></tr>
            <tr><td>HKm</td><td>Hutan Kemasyarakatan</td></tr>
            <tr><td>HTR</td><td>Hutan Tanaman Rakyat</td></tr>
            <tr><td>KK</td><td>Kemitraan Kehutanan</td></tr>
          </table>
        </div>
      </div>
    </div>
  </div>
@endisset
<footer class="main-footer" style="background-color: #F2F2F2">
  <img src="{{ asset('img/Element L4L Corner.png') }}" class="position-absolute" style="height: 50px; right: 0px;">
  <!-- Default to the left -->
  @if (!isset($simple_footer))
  <div class="row p-2">
    <div class="col-xl-6">
      <div class="row">
        <div class="col-md-2 col-xl-3">
          <img src="{{ asset('img') }}/{{ strlen(Cache::get('app')->logo) ? Cache::get('app')->logo : 'NO_IMAGE.png' }}" alt="Logo" class="img-fluid elevation-2" style="max-width: 110px">
        </div>
        <div class="col-md-8 my-2">
          <small style="color: black">Adaptasi perubahan iklim dan akses masyarakat terhadap lahan memiliki hubungan yang erat.<br>Dalam konteks perubahan iklim, akses lahan dapat mempengaruhi kemampuan masyarakat untuk mengadaptasikan diri terhadap perubahan iklim.</small>
        </div>
      </div>
      <div class="py-4">
        <span class="link-footer">&raquo; <a href="/home">Beranda</a></span>
        <span class="link-footer">&raquo; <a href="/about">Tentang</a></span>
        <span class="link-footer">&raquo; <a href="/guides/pdf" target="_blank">Panduan Penggunaan</a></span>
        <br>
        <span class="link-footer">&raquo; <a href="https://pkps.menlhk.go.id/" target="_blank">Perhutanan Sosial</a></span>
        <span class="link-footer">&raquo; <a href="https://gokups.menlhk.go.id/" target="_blank">GoKUPS</a></span>
        @auth
        <span class="link-footer">&raquo; <a href="https://akseslahan.lahanuntukkehidupan.id/" target="_blank">Prasyarat Pengajuan</a></span>
        {{-- <span class="link-footer">&raquo; <a href="/guides/panduan_penggunaan_modul2_sialam[REV01].pdf" target="_blank">Panduan Prasyarat Pengajuan</a></span> --}}
        @endauth
      </div>
    </div>
    <div class="col-xl-6 d-xl-flex align-items-center justify-content-end">
      <div>
        <img src="{{ asset('img/Canada.png') }}" alt="Logo" class="img-fluid instances-logo p-2">
        <img src="{{ asset('img/CIFOR.png') }}" alt="Logo" class="img-fluid instances-logo p-2">
        <img src="{{ asset('img/ICRAF.png') }}" alt="Logo" class="img-fluid instances-logo p-2">
        <img src="{{ asset('img/HastagL4L.png') }}" alt="Logo" class="img-fluid instances-logo p-2">
      </div>
    </div>
  </div>
  @endif
  <div class="row p-2"><div class="col-12">Copyright &copy; 2023 {{ (date("Y") > 2023 ? " - " . date("Y") : "") }} CIFOR-ICRAF Indonesia. All rights reserved.</div></div>
</footer>
