<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
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
    .disabled { background-color: #6c757d!important; color: #aaa; transition: all 1s ease; }
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
                  <h3 class="login-box-msg">Form Ubah Password Pengguna</h3>
                  <hr>
                  <form action="/updpassword" method="POST" class="form-horizontal">
                    @csrf
                    <div class="row">
                      <div id="div-left" class="col-lg-6 p-2" style="border-right: 1px solid #333;">
                        <h6 class="p-2">PERIKSA PENGGUNA</h6>
                        <div class="form-group row">
                          <label class="col-sm-5 col-md-4">Nama Pengguna</label>
                          <div class="col-sm-7 col-md-8">
                            <input type="text" id="username" name="username" class="form-control input-left" id="username" placeholder="Nama Pengguna" autocomplete="off">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-5 col-md-4">No. Telepon</label>
                          <div class="col-sm-7 col-md-8">
                            <input type="text" id="phone_no" name="phone_no" class="form-control input-left" id="phone_no" placeholder="No. Telepon" autocomplete="off">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-9"></div>
                          <div class="col-sm-3"><button id="btnCheck" class="my-2 w-100 btn text-white bg-icraf-orange input-left" type="button" onclick="pubCheckUser()"><i class="fas fa-search"></i> Periksa</button></div>
                        </div>
                      </div>
                      <div id="div-right" class="col-lg-6 p-2 disabled">
                        <h6 class="p-2">UBAH PASSWORD</h6>
                        <div class="form-group row">
                          <label class="col-sm-5 col-md-4">Nama Lengkap</label>
                          <div class="col-sm-7 col-md-8">
                            <span id="txt_name" name="txt_name">-</span>
                            <input type="hidden" id="hdn_userid" name="hdn_userid">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-5 col-md-4">Password <span class="text-danger">*</span></label>
                          <div class="col-sm-7 col-md-8">
                            <input type="password" name="password" class="form-control rounded-bottom input-right @error('password') is-invalid @enderror" id="password" placeholder="Password" required autocomplete="off" disabled>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-5 col-md-4">Ketik Ulang Password <span class="text-danger">*</span></label>
                          <div class="col-sm-7 col-md-8">
                            <input type="password" name="password_confirmation" class="form-control rounded-bottom input-right @error('password_confirmation') is-invalid @enderror" id="password_confirmation" placeholder="Ketik Ulang Password" required autocomplete="off" disabled>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-9"></div>
                          <div class="col-sm-3"><button id="btnSubmit" class="my-2 w-100 btn text-white bg-icraf-orange input-right" type="button" onclick="pubUpdatePass()" disabled><i class="fas fa-save"></i> Simpan</button></div>
                        </div>
                      </div>
                    </div>
                  </form>
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
<script>
  $('#btnLogin').remove();
  $('#username').focus();
  function pubCheckUser() {
    name = ($('#username').val()).trim();
    phone_no = ($('#phone_no').val()).trim();
    if (name.length && phone_no.length) {
      $.ajaxSetup({
          headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
      });
      $.ajax({
        url: '/chkuser',
        type: 'POST',
        data: { username: name, phone_no: phone_no },
        cache: false,
        success: function(response) {
          resp = response.data;
          if (resp) {
            $('#txt_name').html(resp.name + ' (' + resp.username + ')');
            $('#hdn_userid').val(resp.id);
            $('.input-left').prop('disabled', 'disabled');
            $('#div-left').addClass('disabled');
            $('#btnCheck').html('<i class="fas fa-check"></i> Ditemukan')
            $('.input-right').prop('disabled', '');
            $('#div-right').removeClass('disabled');
            $('#password').focus();
          } else {
            alert('Pengguna tidak ditemukan');
          }
        }
      });
    } else {
      alert('Nama dan No. Telepon harus diisi');
    }
  }
  function pubUpdatePass() {
    id = $('#hdn_userid').val();
    pass = $('#password').val();
    pass_conf = $('#password_confirmation').val();
    if (pass.length && pass_conf.length) {
      $.ajaxSetup({
          headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
      });
      $.ajax({
        url: '/updpassword',
        type: 'POST',
        data: { id: id, password: pass, password_confirmation: pass_conf },
        cache: false,
        success: function(response) {
          if (response) alert('Berhasil mengubah password pengguna');
            else alert('Gagal mengubah password pengguna');
          window.location.reload();
        },
        error: function (err) {
          if (err.status == 422) {
            $.each(err.responseJSON.errors, function(i, error) {
              $('#err_' + i).remove();
              var el = $(document).find('[name="'+i+'"]');
              el.after($('<span id="err_'+i+'" style="color: red">'+error[0]+'</span>'));
            });
          }
        }
      });
    } else {
      alert('Password dan Ketik Ulang Password harus diisi');
    }
  }
</script>
</html>
