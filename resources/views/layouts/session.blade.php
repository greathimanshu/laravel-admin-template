<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo.png') }}">

    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('merchant') }}/css/icons/icomoon/styles.min.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('merchant') }}/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('merchant') }}/css/session-page.css" rel="stylesheet" type="text/css">

    @yield('page_style')
</head>

<body>

    <div class="page-content login-cover">
        <div class="overlay_black"></div>
        @yield('content')

    </div>

    <script src="{{ asset('merchant') }}/js/main/jquery.min.js"></script>
    <script src="{{ asset('merchant') }}/js/main/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('merchant') }}/js/app.js"></script>
    <script src="{{ asset('merchant') }}/js/jquery.validate.min.js"></script>
    <script src="{{ asset('merchant') }}/js/jquery.shorten.min.js"></script>
    @yield('page_script')

    <script>
        // Hide notification message
        $("div.alert").fadeTo(2000, 500).slideUp(500, function() {
            $("div.alert").slideUp(500);
        });
    </script>
</body>

</html>
