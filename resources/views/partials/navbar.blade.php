<nav class="main-header navbar navbar-expand-sm navbar-light navbar-white">
    <div class="container">
      <a href="/" class="navbar-brand">
        <img src="{{ asset('img') }}/{{ strlen(Cache::get('app')->logo) ? Cache::get('app')->logo : 'NO_IMAGE.png' }}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item dropdown d-sm-inline-block">
            {{-- <a href="#" id="dropdownMap" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><i class='fas fa-map'></i> Akses Lahan</a>
            <ul aria-labelledby="dropdownMap" class="dropdown-menu border-0 shadow">
              <li><a class="dropdown-item" href="/land-access">Peta Akses Lahan</a></li>
            </ul> --}}
            <a class="dropdown-item {{ (isset($active) && $active == 'map') ? 'icraf-green text-bold' : '' }}" href="/land-access">Peta Akses Lahan</a>
          </li>
          @auth
          <li class="nav-item dropdown d-sm-inline-block">
            {{-- <a href="#" id="dropdownRequest" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><i class='fas fa-list-ol'></i> Pengajuan</a>
            <ul aria-labelledby="dropdownRequest" class="dropdown-menu border-0 shadow">
              <li><a class="dropdown-item" href="/proposals">Daftar Pengajuan</a></li>
            </ul> --}}
            <a class="dropdown-item {{ (isset($active) && $active == 'proposal') ? 'icraf-green text-bold' : '' }}" href="/proposals">Daftar Pengajuan</a>
          </li>
          <li class="nav-item dropdown d-sm-inline-block">
            <a class="dropdown-item" href="https://akseslahan.lahanuntukkehidupan.id/" target="_blank">Prasyarat Pengajuan</a>
          </li>
          @endauth
          <li class="nav-item dropdown d-sm-inline-block">
            <a class="dropdown-item" href="https://akseslahan.lahanuntukkehidupan.id/" target="_blank">Pembelajaran Pasca Izin PS</a>
          </li>
        </ul>
      </div>
      <!-- Login/logout -->
      @auth
      @php
        $exp = new DateTime(Cache::get('app')->moodle_token_expired);
        $diff = $exp->diff(now());
        $day = $diff->format('%a');
        $sign = $diff->format('%R');
        if ($day < 7 || $sign == '+') $show_danger = true;
          else $show_danger = false;
      @endphp
      <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-user-circle icraf-orange" style="font-size: 20pt"></i>
          @if (Auth::user()->role == 'admin' && $show_danger)
            <span class="badge badge-danger navbar-badge text-bold">EX</span>
          @endif
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item"><i class="fas fa-user mr-2"></i> <a href="/user">{{ Auth::user()->name }} {{ Auth::user()->lastname }} @if (Auth::user()->role == 'admin') [{{ Auth::user()->role }}] @endif</a></span>
          <div class="dropdown-divider"></div>
          @if (Auth::user()->role == "admin" || Auth::user()->role == "superadmin")
            <span class="dropdown-item">
              <a href="#" onclick="openSetting()"><i class="fas fa-wrench mr-2"></i>Pengaturan Aplikasi</a>
              @if ($day < 7 || $sign == '+')
                <br><small class="font-italic d-block"><span class="text-danger">*</span> Token Moodle LMS {!! ($sign == '-' ? 'akan kedaluwarsa dalam<br>' . $day+1 . ' hari.' : ($day == 0 ? 'kedaluwarsa pada<br>hari ini.' : 'telah kedaluwarsa sejak<br>' . $day . ' hari lalu.')) !!}</em></small>
              @endif
            </span>
            <div class="dropdown-divider"></div>
          @endif
          <span class="dropdown-footer" style="float:right">
            <a href="/logout" class="btn btn-danger btn-sm"><i class="fas fa-sign-out-alt"></i> Keluar</a>
          </span>
        </div>
      </li>
      </ul>
      @else
      <a id="btnLogin" class="btn text-white bg-icraf-orange d-none" href="/login" title="Masuk">Masuk/Daftar&nbsp;&nbsp;<i class="fas fa-sign-in-alt"></i></a>
      @endauth
      </div>
  </nav>
