<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $page_title }} :: {{ Cache::get('app')->code }}</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Archivo:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lexend:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/fontawesome-free/css/all.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte') }}/dist/css/adminlte.min.css">
  <!-- custom CSS -->
  <link rel="stylesheet" href="{{ asset('styles') }}/style.css">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">
  <!-- Navbar -->
  @include('partials.navbar')
  <!-- /.navbar -->
  <div class="login-page bg-icraf-green" style="margin-top: -80px; margin-bottom: -34px; background-image: url('{{ url('/') }}/img/BG Texture 2.png');">
    {{-- @if(session()->has('registerSuccess'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('registerSuccess') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    @if(session()->has('loginError'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('loginError') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif --}}
    <div class="login-box">
      <div class="login-logo">
        <img src="{{ asset('img') }}/{{ strlen(Cache::get('app')->logo) ? Cache::get('app')->logo : 'NO_IMAGE.png' }}" alt="Logo" class="elevation-3" style="width: 100px">
      </div>
      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg">Masuk untuk memulai sesi Anda</p>
          <form action="/login" method="post">
            @csrf
            <div class="input-group mb-2">
              <input type="text" class="form-control" placeholder="Username" id="username" name="username" autocomplete="off" autofocus required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-2">
              <input type="password" class="form-control" placeholder="Password" id="password" name="password" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Masuk</button>
              </div>
              <!-- /.col -->
            </div>
          </form>
          @if (!(session()->get('url.intended') && strpos(session()->get('url.intended'), '/oauth/authorize') > -1))
            <hr>
            <p class="text-center my-2">Belum punya akun?</p>
            <a href="/register" class="text-center btn bg-icraf-orange text-white d-block my-2">Daftar</a>
            @if (!App\Models\User::cntSuperAdmin())
              <a href="/regadmin" class="text-center btn bg-icraf-orange text-white d-block my-2">Daftarkan Super Admin</a>
            @endif
          @endif
        </div>
        <!-- /.login-card-body -->
      </div>    
    </div>
  </div>
  @include('partials.footer')
</div>
<!-- jQuery -->
<script src="{{ asset('adminlte') }}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Toastr -->
<script src="{{ asset('adminlte') }}/plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte') }}/dist/js/adminlte.min.js"></script>
<script>
    $("#btnLogin").remove();
    @if(session()->has('registerSuccess'))
      toastr.success('{{ session('registerSuccess') }}');
    @endif
    @if(session()->has('loginError'))
      toastr.error('{{ session('loginError') }}');
    @endif
</script>
</body>
</html>