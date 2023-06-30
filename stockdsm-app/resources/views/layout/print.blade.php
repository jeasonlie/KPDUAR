<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('/css/print.css') }}" rel="stylesheet">

    <!-- Script -->

    @yield('head')
    <title>@yield('title')</title>
</head>
<body>
    <div class="header">
        <img src="{{ asset('logo.png')}}" alt="" style="width:80px;height:80px">
        <div class="header-text">
            <div class="header-title" style="border-bottom:solid black 1px; font-size: 30px; padding-bottom:4px">PT. Dewa Sukses Mandiri</div>
            <div class="header-slogan" style="font-size: 24px; padding-top:4px">General Contractor & Supplier</div>
        </div>
    </div>
    @yield('content')
</body>
<script type="text/javascript">
    window.print();
</script>
</html>