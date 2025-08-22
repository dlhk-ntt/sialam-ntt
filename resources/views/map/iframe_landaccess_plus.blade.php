<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Land Access</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Archivo:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lexend:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('adminlte') }}/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="{{ asset('styles') }}/style.css">
    <style>
        body { font-family: 'Archivo', 'Source Sans Pro'; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Lexend', 'Source Sans Pro'; }
        .container { max-width: inherit; }
        .bg-icraf-orange { background-color: #F26A21 !important; }
        .bg-icraf-green { background-color: #066155 !important; }
        .icraf-orange { color: #F26A21 !important; }
        .icraf-green { color: #066155 !important; }
        .icon-steps { font-size: 24pt; position: absolute; right: 0px; bottom: 0px; width: 52px; text-align: center; border-radius: 10px; }
        .steps { border-radius: 20px; }
        .step-green {
            background-size: 200% 200%;
            background-image: linear-gradient(to right bottom, #066155 50%, #F26A21 50%);
            -webkit-transition: background-position 0.75s;
            -moz-transition: background-position 0.75s;
            transition: background-position 0.75s;
        }
        .step-green:hover { background-position: 100% 100%; }
        #interactive-map { border: 1px solid #066155; }
    </style>
</head>
<body>
    <h2 class="text-bold text-center icraf-green">Selamat Datang di Halaman Antar Muka</h2>
    <h2 class="text-bold text-center icraf-orange">Sistem Informasi Akses Lahan Untuk Masyarakat</h2>
    <p class="px-5 py-4 text-center">
        Sistem informasi ini merupakan alat bantu yang dikembangkan untuk mendukung diseminasi pengetahuan<br>dan informasi yang diharapkan mampu meningkatkan kapasitas petani dan/atau masyarakat dalam<br>mengelola bentang lahan, yang berkaitan dengan pemanfaatan Program Perhutanan Sosial (PS).
    </p>
    <div class="row d-flex justify-content-center p-2">
        <div class="card steps step-green text-white col-md-3 mx-2">
            <h5 class="card-header">Analisis Spasial</h5>
            <p class="card-body">Membantu menganalisis variabel penentu rekomendasi skema PS yang mudah ditunjukkan secara keruangan</p>
            <div class="px-2 m-2 icon-steps bg-icraf-orange"><i class="fas fa-map"></i></div>
        </div>
        <div class="card steps step-green text-white col-md-3 mx-2">
            <h5 class="card-header">Penapisan Kriteria</h5>
            <p class="card-body">Membantu menganalisis variabel penentu rekomendasi skema PS berdasarkan peraturan perundangan yang berlaku terkait pemilihan skema PS</p>
            <div class="px-2 m-2 icon-steps bg-icraf-orange"><i class="fas fa-clipboard-list"></i></div>
        </div>
        <div class="card steps step-green text-white col-md-3 mx-2">
            <h5 class="card-header">Penentuan Preferensi</h5>
            <p class="card-body">Melakukan penilaian kecenderungan untuk memilih skema PS yang lebih disukai berdasarkan berbagai kriteria yang telah ditentukan</p>
            <div class="px-2 m-2 icon-steps bg-icraf-orange"><i class="fas fa-comment-dots"></i></div>
        </div>
    </div>
    <div id="accordion" class="p-2">
        <div class="card card-primary">
            <div class="card-header bg-icraf-orange collapsed" data-toggle="collapse" href="#collapseOne" aria-expanded="false">
                <h5 class="d-inline">Bagaimana cara menggunakannya?</h5>
            </div>
            <div id="collapseOne" class="collapse" data-parent="#accordion" style="">
                <div class="card-body">
                    <ul>
                        <li>Pada halaman peta ini, pengguna diminta untuk mengidentifikasi area/lokasi yang akan dinilai terhadap alokasi Perhutanan Sosial dengan cara <strong>memilih salah satu area berwarna biru</strong> yang ingin diidentifikasi.</li>
                        <li>Pengguna juga dapat memilih/meng-klik <strong>tombol kuning (lokasi sekarang)</strong> pada bagian kiri atas peta apabila pengguna berada langsung di lokasi.</li>
                        <li>Selanjutnya, pengguna dapat memilih/meng-klik tombol <strong>Pilih dan Proses</strong> untuk melanjutkan ke langkah berikutnya.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="interactive-map" class="embed-responsive mt-3 mb-5">
        <iframe>Peramban Anda tidak kompatibel</iframe>
    </div>
</body>
<script> var APP_URL = {!! json_encode(url('/')) !!}; </script>
<script src="{{ asset('adminlte') }}/plugins/jquery/jquery.min.js"></script>
<script src="{{ asset('adminlte') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src='{{ asset('scripts/script.js') }}'></script>
<script> showMap4(APP_URL); </script>
</html>
