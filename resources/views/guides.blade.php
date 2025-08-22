{{-- @dd($data) --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __('Panduan Penggunaan') }} [{{ strtoupper($type) }}]</title>
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte') }}/dist/css/adminlte.min.css">
</head>
<body class="p-0 m-0">
    <div style="text-align:center">
        <iframe id="media" src="/file/guide/{{ $data->guide_pdf }}" allowfullscreen webkitallowfullscreen class="w-100" frameBorder="0"></iframe>
    </div>
</body>
<!-- jQuery -->
<script src="{{ asset('adminlte') }}/plugins/jquery/jquery.min.js"></script>
<script>
    $(window).resize(function() {
        resizeDiv();
    });
    function resizeDiv() {
        height = $(window).height();
        $('#media').css('height', height);
    }
    resizeDiv();
</script>

</html>
