<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="refresh" content="{{ (config('session.lifetime') + 0.5) * 60 }}">
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
  @yield('customCSSLibrary')
  <!-- custom CSS -->
  <link rel="stylesheet" href="{{ asset('styles') }}/style.css">
</head>
<body class="hold-transition layout-top-nav layout-navbar-fixed" onclick="removeItemList()">
<div class="wrapper">
  <!-- Navbar -->
  @include('partials.navbar')
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background-image: url('{{ url('/') }}/img/BG Texture 2.png');">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      @if (isset($title_on_header) && $title_on_header == true)
      <div class="container">
        <div class="row mb-2">
          <div class="col-12 text-center">
            <h1 class="m-0 d-inline-block text-bold">{!! isset($page_title2) ? $page_title2 : $page_title !!}</h1>
          </div>
        </div>
      </div>
      @endif
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-lg">
            @yield('base_template')
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  @include('partials.footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('adminlte') }}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('adminlte') }}/plugins/moment/moment.min.js"></script>
<!-- Toastr -->
<script src="{{ asset('adminlte') }}/plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte') }}/dist/js/adminlte.min.js"></script>
<script src="{{ asset('adminlte') }}/plugins/chart.js/Chart.min.js"></script>
<script src="{{ asset('scripts') }}/script.js"></script>
@yield('customJSLibrary')
<script>
  @guest
    $("#btnLogin").removeClass('d-none');
  @endguest
  @if(session()->has('successMsg'))
    toastr.success('{{ session('successMsg') }}');
    @php session()->forget('successMsg') @endphp
  @endif
  @if(session()->has('errorMsg'))
    toastr.error('{{ session('errorMsg') }}');
    @php session()->forget('errorMsg') @endphp
  @endif
  var APP_URL = {!! json_encode(url('/')) !!};
  @yield('customJS')
</script>
</body>
</html>
