<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/css/style.css">
  <title>{{ $page_title }} :: {{ Cache::get('app')->code }}</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Archivo:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lexend:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('adminlte') }}/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="{{ asset('styles') }}/style.css">
  <style>
    .col-lg { margin-top: 1em; }
    .row { margin-right: 0; margin-left: 0; }
  </style>
</head>

<body class="hold-transition layout-top-nav layout-navbar-fixed">
  <div class="wrapper">
    @include('partials.navbar')
    <div class="content-wrapper bg-icraf-green" style="background-image: url('{{ url('/') }}/img/BG Texture 2.png');">
      <div class="content">
        <div class="container">
          <div class="row">
            <div class="col-lg">
              <div class="login-logo">
                <img src="{{ asset('img') }}/{{ strlen(Cache::get('app')->logo) ? Cache::get('app')->logo : 'NO_IMAGE.png' }}" alt="Logo" class="elevation-3" style="width: 100px">
              </div>
              <div class="card">
                <div class="card-body login-card-body">
                  <h3 class="login-box-msg">Form Pendaftaran Pengguna</h3>
                  <hr>
                  <form action="/register" method="POST" class="form-horizontal">
                    @csrf
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group row">
                          <label class="col-sm-5 col-md-4">Nama Pengguna <span class="text-danger">*</span></label>
                          <div class="col-sm-7 col-md-8">
                            <input type="text" name="username" class="form-control rounded-top @error('username') is-invalid @enderror" id="username" placeholder="Nama Pengguna" required value="{{ old('username') }}" autocomplete="off">
                            @error('username')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                            @enderror
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-5 col-md-4">Nama Lengkap <span class="text-danger">*</span></label>
                          <div class="col-sm-7 col-md-8">
                            <div class="row">
                              <div class="col-lg-6">
                                <input type="text" name="name" class="form-control rounded-top @error('name') is-invalid @enderror" id="name" placeholder="Nama Depan" required value="{{ old('name') }}" autocomplete="off">
                                @error('name')
                                <div class="invalid-feedback">
                                  {{ $message }}
                                </div>
                                @enderror
                              </div>
                              <div class="col-lg-6">
                                <input type="text" name="lastname" class="form-control rounded-top @error('lastname') is-invalid @enderror" id="lastname" placeholder="Nama Belakang" required value="{{ old('lastname') }}" autocomplete="off">
                                @error('lastname')
                                <div class="invalid-feedback">
                                  {{ $message }}
                                </div>
                                @enderror
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-5 col-md-4">Email <span class="text-danger">*</span></label>
                          <div class="col-sm-7 col-md-8">
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" required value="{{ old('email') }}" autocomplete="off">
                            @error('email')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                            @enderror
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group row">
                          <label class="col-sm-5 col-md-4">No. Telepon <span class="text-danger">*</span></label>
                          <div class="col-sm-7 col-md-8">
                            <input type="text" name="phone_no" class="form-control @error('phone_no') is-invalid @enderror" id="phone_no" placeholder="No. Telepon" required value="{{ old('phone_no') }}" autocomplete="off">
                            @error('phone_no')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                            @enderror
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-5 col-md-4">Password <span class="text-danger">*</span></label>
                          <div class="col-sm-7 col-md-8">
                            <input type="password" name="password" class="form-control rounded-bottom @error('password') is-invalid @enderror" id="password" placeholder="Password" required autocomplete="off">
                            @error('password')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                            @enderror
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-5 col-md-4">Ketik Ulang Password <span class="text-danger">*</span></label>
                          <div class="col-sm-7 col-md-8">
                            <input type="password" name="password_confirmation" class="form-control rounded-bottom @error('password_confirmation') is-invalid @enderror" id="password_confirmation" placeholder="Ketik Ulang Password" required autocomplete="off">
                            @error('password_confirmation')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                            @enderror
                          </div>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="row">
                          <div class="col-sm-9"></div>
                          <div class="col-sm-3"><button class="my-2 w-100 btn btn-lg text-white bg-icraf-orange" type="submit"><i class="fas fa-paper-plane"></i> Daftar</button></div>
                        </div>
                      </div>
                    </div>
                  </form>
                  <hr>
                  <p class="d-block text-center">Sudah terdaftar? <a href="/login">Silakan masuk</a></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @include('partials.footer')
  </div>
</body>
<!-- jQuery -->
<script src="{{ asset('adminlte') }}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

{{-- <body>
    <div class="container p-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <main class="form-registration">
                <form action="/register" method="POST">
                    @csrf
                    <h1 class="h3 mb-3 fw-normal text-center">Form Pendaftaran Pengguna</h1>
                    <div class="form-floating">
                    <input type="text" name="username" class="form-control rounded-top @error('username') is-invalid @enderror" id="username" placeholder="Nama Pengguna" required value="{{ old('username') }}" autocomplete="off">
                    <label for="floatingInput">Nama Pengguna</label>
                    @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    </div>
                    <div class="form-floating">
                    <input type="text" name="name" class="form-control rounded-top @error('name') is-invalid @enderror" id="name" placeholder="Nama" required value="{{ old('name') }}" autocomplete="off">
                    <label for="floatingInput">Nama</label>
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    </div>
                    <div class="form-floating">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" required value="{{ old('email') }}" autocomplete="off">
                    <label for="floatingInput">Email</label>
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    </div>
                    <div class="form-floating">
                        <input type="text" name="phone_no" class="form-control @error('phone_no') is-invalid @enderror" id="phone_no" placeholder="No. Telepon" required value="{{ old('phone_no') }}" autocomplete="off">
                        <label for="floatingInput">No. Telepon</label>
                        @error('phone_no')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="password" name="password" class="form-control rounded-bottom @error('password') is-invalid @enderror" id="password" placeholder="Password" required autocomplete="off">
                        <label for="floatingPassword">Password</label>
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="password" name="password_confirmation" class="form-control rounded-bottom @error('password_confirmation') is-invalid @enderror" id="password_confirmation" placeholder="Ketik Ulang Password" required autocomplete="off">
                        <label for="floatingPassword">Ketik Ulang Password</label>
                        @error('password_confirmation')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                
                    <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Daftar</button>
                </form>
                <small class="d-block text-center mt-3">Sudah terdaftar? <a href="/login">Silakan masuk</a></small>
                </main>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body> --}}

<script>
  $("#btnLogin").remove();
  $("#username").focus();
</script>
</html>
