<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/css/style.css">
    <title>{{ $page_title }} :: {{ Cache::get('app')->code }}</title>
</head>

<body>
    <div class="container p-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <main class="form-registration">
                <form action="/regadmin" method="POST">
                    @csrf
                    <h1 class="h3 mb-3 fw-normal text-center">Form Pendaftaran Admin</h1>
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
                    <label for="floatingInput">Nama Lengkap</label>
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
</body>

</html>
