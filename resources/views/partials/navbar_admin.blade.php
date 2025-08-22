<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
  <div class="container">
    <a href="/" class="navbar-brand">
      <img src="{{ asset('img') }}/{{ strlen(Cache::get('app')->logo) ? Cache::get('app')->logo : 'NO_IMAGE.png' }}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><b>{{ Cache::get('app')->code }}</b></span>
    </a>

    <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item d-sm-inline-block">
          <a href="#" class="nav-link" onclick="window.close()"><i class='fas fa-times'></i> {{ __('Tutup halaman ini') }}</a>
        </li>
      </ul>
    </div>

    <!-- logout -->
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-cogs"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item"><i class="fas fa-user mr-2"></i> {{ isset(Auth::user()->name) ? Auth::user()->name : "" }} [{{ isset(Auth::user()->role) ? Auth::user()->role : "" }}]</span>
          <div class="dropdown-divider"></div>
          <span class="dropdown-footer" style="float:right">
            <a href="/logout" class="btn btn-danger btn-sm"><i class="fas fa-sign-out-alt"></i> {{ __('Keluar') }}</a>
          </span>
        </div>
      </li>
    </ul>
  </div>
</nav>
