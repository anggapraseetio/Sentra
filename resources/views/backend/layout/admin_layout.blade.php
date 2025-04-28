<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Focus - Bootstrap Admin Dashboard </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ 'admin/assets_2/images/favicon.png' }}">
    <link rel="stylesheet" href="{{ 'admin/assets_2/vendor/owl-carousel/css/owl.carousel.min.css' }}">
    <link rel="stylesheet" href="{{ 'admin/assets_2/vendor/owl-carousel/css/owl.theme.default.min.css' }}">
    <link href="{{ 'admin/assets_2/vendor/jqvmap/css/jqvmap.min.css' }}" rel="stylesheet">
    <link href="{{ 'admin/assets_2/css/style.css' }}" rel="stylesheet">


</head>

<body>
    <div id="main-wrapper">
        @include('backend.components.navbar')
        <div class="header">
        </div>
        @include('backend.components.sidebar')
        <div class="content-body">
            @yield('admin')
        </div>
        @include('backend.components.footer')
    </div>

    <!-- Required vendors -->
    <script src="{{ 'admin/assets_2/vendor/global/global.min.js' }}"></script>
    <script src="{{ 'admin/assets_2/js/quixnav-init.js' }}"></script>
    <script src="{{ 'admin/assets_2/js/custom.min.js' }}"></script>


    <!-- Vectormap -->
    <script src="{{ 'admin/assets_2/vendor/raphael/raphael.min.js' }}"></script>
    <script src="{{ 'admin/assets_2/vendor/morris/morris.min.js' }}"></script>


    <script src="{{ 'admin/assets_2/vendor/circle-progress/circle-progress.min.js' }}"></script>
    <script src="{{ 'admin/assets_2/vendor/chart.js/Chart.bundle.min.js' }}"></script>

    <script src="{{ 'admin/assets_2/vendor/gaugeJS/dist/gauge.min.js' }}"></script>

    <!--  flot-chart js -->
    <script src="{{ 'admin/assets_2/vendor/flot/jquery.flot.js' }}"></script>
    <script src="{{ 'admin/assets_2/vendor/flot/jquery.flot.resize.js' }}"></script>

    <!-- Owl Carousel -->
    <script src="{{ 'admin/assets_2/vendor/owl-carousel/js/owl.carousel.min.js' }}"></script>

    <!-- Counter Up -->
    <script src="{{ 'admin/assets_2/vendor/jqvmap/js/jquery.vmap.min.js' }}"></script>
    <script src="{{ 'admin/assets_2/vendor/jqvmap/js/jquery.vmap.usa.js' }}"></script>
    <script src="{{ 'admin/assets_2/vendor/jquery.counterup/jquery.counterup.min.js' }}"></script>


    <script src="{{ 'admin/assets_2/js/dashboard/dashboard-1.js' }}"></script>

</body>

</html>
