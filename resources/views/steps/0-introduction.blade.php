@extends('partials.menu_tabs')

@section('menu_tab_content')
<div class="">
    <h4 class="pb-3 icraf-orange"><strong>Pengantar: Sistem Informasi Akses Lahan</strong></h4>
    <p>
        Adaptasi perubahan iklim dan akses masyarakat terhadap lahan memiliki hubungan yang erat. Ini tercermin dalam dokumen <i>Indonesia Long-Term Strategy for Low Carbon and Climate Resilience 2050</i> (LTS-LCCR 2050), yang menyatakan bahwa akses lahan dapat mempengaruhi kemampuan masyarakat untuk mengadaptasi diri terhadap perubahan iklim.
    </p>
    <p>
        Akses lahan yang terbatas dapat memperburuk dampak perubahan iklim pada masyarakat, terutama bagi masyarakat yang bergantung pada lahan untuk bertahan hidup, seperti pertanian, hutan, dan sumberdaya alam lainnya. Kondisi tersebut dapat mengurangi kemampuan masyarakat untuk memperoleh makanan, air bersih, dan sumber daya yang diperlukan untuk bertahan hidup. Sebaliknya, akses yang memadai pada lahan dapat membantu masyarakat mengatasi dampak perubahan iklim dengan menghasilkan sumber daya alam berkelanjutan, membangun infrastruktur dan sistem perlindungan.
    </p>
    <p>
        <strong>Perhutanan Sosial (PS)</strong>, disebutkan dalam dokumen LTS-LCCR, sebagai salah satu solusi untuk mengatasi hambatan akses lahan dalam menghadapi perubahan iklim. Ini adalah pendekatan mutakhir dalam pengelolaan hutan yang dipercaya mampu mengatasi berbagai masalah kemiskinan, lingkungan, dan kesejahteraan masyarakat desa hutan, serta persoalan sosial budaya lainnya.
    </p>
    <p>
        Berdasarkan Permen LHK No. 9 Tahun 2021, skema perhutanan sosial diselenggarakan melalui pemberian akses legal kepada masyarakat (dalam bentuk Kelompok Perhutanan Sosial/KPS) terhadap lahan hutan, yang lebih dikenal dengan “Persetujuan Pengelolaan Perhutanan Sosial”. Pemberian akses legal tersebut dilakukan melalui beberapa bentuk tenur, seperti <strong>Hutan Desa (HD)</strong>, <strong>Hutan Kemasyarakatan (HKm)</strong>, <strong>Hutan Tanaman Rakyat (HTR)</strong>, <strong>kemitraan kehutanan</strong>, dan <strong>Hutan Adat (HA) pada kawasan Hutan Lindung</strong>, <strong>Hutan Produksi</strong> atau <strong>Hutan Konservasi sesuai dengan fungsinya</strong>.
    </p>
    <p>Untuk itu, pengembangan sistem informasi ini memiliki beberapa tujuan, diantaranya:</p>
    <ol>
        <li>Mewujudkan akses kelola lahan yang baik untuk mendukung pembangunan daerah</li>
        <li>Mendukung Pemerintah Provinsi dalam meningkatkan penyebarluasan pengetahuan dan informasi terkini mengenai akses lahan, melalui penguatan kapasitas</li>
        <li>Memberikan kemudahan akses pengetahuan dan informasi kepada para petani yang belum memiliki akses terhadap skema legal pemanfaatan lahan, melalui program Perhutanan Sosial</li>
    </ol>
    <p>
        Sistem informasi ini diharapkan dapat memberikan rekomendasi skema perhutanan sosial yang sesuai dengan kebutuhan masyarakat dan peraturan yang berlaku, serta meningkatkan pengetahuan dan informasi masyarakat dalam pengajuan skema perhutanan sosial.
    </p>
    <div class="d-flex justify-content-end my-2">
        <input type="hidden" id="hdn_urlparam" name="hdn_urlparam" value="{{ $urlparam }}">
        <button type="button" id="btn_next" class="btn text-white bg-icraf-orange" onclick="gotoNext(1)">Selanjutnya&nbsp;&nbsp;<i class="fas fa-arrow-right"></i></button>
    </div>
</div>
@stop
