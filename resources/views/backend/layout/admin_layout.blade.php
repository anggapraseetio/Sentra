<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title> Dashboard </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ 'admin/assets_2/images/favicon.png' }}">
    <link rel="stylesheet" href="{{ 'admin/assets_2/vendor/owl-carousel/css/owl.carousel.min.css' }}">
    <link rel="stylesheet" href="{{ 'admin/assets_2/vendor/owl-carousel/css/owl.theme.default.min.css' }}">
    <!-- Form step -->
    <link href="{{ 'admin/assets_2/vendor/jquery-steps/css/jquery.steps.css' }}" rel="stylesheet">
    <link href="{{ 'admin/assets_2/vendor/jqvmap/css/jqvmap.min.css' }}" rel="stylesheet">
    <link href="{{ 'admin/assets_2/css/style.css' }}" rel="stylesheet">
    <!-- Datatable -->
    <link href="{{ 'admin/assets_2/vendor/datatables/css/jquery.dataTables.min.css' }}" rel="stylesheet">
    <!-- DataTables + Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
    <!-- Styles -->
    <link href="{{ 'admin/assets/css/lib/themify-icons.css' }}" rel="stylesheet">

</head>

<body>
    <div id="main-wrapper" class="d-flex">

    {{-- Sidebar --}}
    <div class="sidebar-fixed">
        @include('backend.components.sidebar')
    </div>

    {{-- Konten Utama --}}
    <div class="content-wrapper flex-grow-1">
        @include('backend.components.navbar')
        <div class="header"></div>
        <div class="content-body">
            @yield('admin')
        </div>
        @include('backend.components.footer')
    </div>

    @stack('scripts')

    {{-- Font Awesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

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

    {{-- Form-wizard --}}
    <script src="{{ 'admin/assets_2/vendor/jquery-steps/build/jquery.steps.min.js' }}"></script>
    <script src="{{ 'admin/assets_2/vendor/jquery-validation/jquery.validate.min.js' }}"></script>
    <!-- Form validate init -->
    <script src="{{ 'admin/assets_2/js/plugins-init/jquery.validate-init.js' }}"></script>
    <!-- Form step init -->
    <script src="{{ 'admin/assets_2/js/plugins-init/jquery-steps-init.js' }}"></script>

    <!-- Datatable -->
    <script src="{{ 'admin/assets_2/vendor/datatables/js/jquery.dataTables.min.js' }}"></script>
    <script src="{{ 'admin/assets_2/js/plugins-init/datatables.init.js' }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

</body>

</html>
