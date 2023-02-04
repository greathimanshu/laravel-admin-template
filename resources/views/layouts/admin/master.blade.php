<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('merchant/logo/logo.png') }}">

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
        type="text/css">

    <link href={{ asset('merchant//css/icons/icomoon/styles.min.css') }} rel="stylesheet" type="text/css">
    <link href="{{ asset('merchant') }}/css/icons/fontawesome/styles.min.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('merchant') }}/css/extras/animate.min.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('merchant') }}/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('merchant') }}/css/main.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('merchant') }}/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('merchant') }}/css/common.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('merchant') }}/css/session-page.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>



    @yield('page_style')
</head>

<body>

    @include('layouts.admin.header')


    <!-- Page content -->
    <div class="page-content">

        @include('layouts.admin.sidebar')

        @yield('content')

    </div>
    <!-- /page content -->

    <!-- Core JS files -->
    <script src="{{ asset('merchant') }}/js/main/jquery.min.js"></script>
    <script src="{{ asset('merchant') }}/js/main/bootstrap.bundle.min.js"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="{{ asset('merchant') }}/js/plugins/visualization/d3/d3.min.js"></script>
    <script src="{{ asset('merchant') }}/js/plugins/visualization/d3/d3_tooltip.js"></script>
    {{-- <script src="{{ asset('admin') }}/js/plugins/ui/moment/moment.min.js"></script> --}}
    <script src="{{ asset('merchant') }}/js/plugins/pickers/daterangepicker.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <!-- Theme JS files -->
    <script src="{{ asset('merchant') }}/js/plugins/tables/datatables/datatables.min.js"></script>

    {{-- <script src="{{ asset('admin') }}/js/demo_pages/datatables_basic.js"></script> --}}

    {{-- <script src="{{ asset('admin') }}/js/demo_pages/dashboard.js"></script> --}}
    <script src="{{ asset('merchant') }}/js/jquery.validate.min.js"></script>
    <script src="{{ asset('merchant') }}/js/jquery.shorten.min.js"></script>
    <script src="{{ asset('merchant') }}/js/plugins/notifications/sweet_alert.min.js"></script>

    <script src="{{ asset('merchant') }}/js/bootstrap-confirm-delete.js"></script>

    <script src="{{ asset('merchant') }}/js/app.js"></script>
    {{-- <script src="{{ asset('admin') }}/js/demo_pages/extra_sweetalert.js"></script>     --}}
    <script src="{{ asset('merchant') }}/js/common.js"></script>

    <!-- /Datepicker JS Files -->
    <script src="{{ asset('merchant') }}datepicker/js/bootstrap-datepicker.min.js"></script>

    @yield('page_script')
</body>

</html>
