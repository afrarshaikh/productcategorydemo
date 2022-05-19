<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Product Category Demo</title>

    <!-- ================= Favicon ================== -->
    <!-- Standard -->
    <link rel="shortcut icon" href="http://placehold.it/64.png/000/fff">
    <!-- Retina iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="144x144" href="http://placehold.it/144.png/000/fff">
    <!-- Retina iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="114x114" href="http://placehold.it/114.png/000/fff">
    <!-- Standard iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="72x72" href="http://placehold.it/72.png/000/fff">
    <!-- Standard iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="57x57" href="http://placehold.it/57.png/000/fff">

    <!-- Styles -->
    <link href="{{ asset('assets/css/lib/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/lib/themify-icons.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/lib/data-table/buttons.bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/css/lib/menubar/sidebar.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/lib/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/lib/helper.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css')}}" rel="stylesheet">
</head>

<body>
        @include('layouts.sidebar')
        @include('layouts.header')
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                @include('layouts.errors')
                @yield('content')
            </div>
        </div>
    </div>
    <!-- jquery vendor -->
    <script src="{{ asset('assets/js/lib/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/js/lib/jquery.nanoscroller.min.js')}}"></script>
    <!-- nano scroller -->
    <script src="{{ asset('assets/js/lib/menubar/sidebar.js')}}"></script>
    <script src="{{ asset('assets/js/lib/preloader/pace.min.js')}}"></script>
    <!-- sidebar -->
    
    <!-- bootstrap -->

    <script src="{{ asset('assets/js/lib/bootstrap.min.js')}}"></script>
    <script src="{{ asset('assets/js/scripts.js')}}"></script>
    <!-- scripit init-->
    <script src="{{ asset('assets/js/lib/data-table/datatables.min.js')}}"></script>
    <script src="{{ asset('assets/js/lib/data-table/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('assets/js/lib/data-table/buttons.flash.min.js')}}"></script>
    <script src="{{ asset('assets/js/lib/data-table/jszip.min.js')}}"></script>
    <script src="{{ asset('assets/js/lib/data-table/pdfmake.min.js')}}"></script>
    <script src="{{ asset('assets/js/lib/data-table/vfs_fonts.js')}}"></script>
    <script src="{{ asset('assets/js/lib/data-table/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('assets/js/lib/data-table/buttons.print.min.js')}}"></script>
    <script src="{{ asset('assets/js/lib/data-table/datatables-init.js')}}"></script>
    @yield('pagescript')
</body>

</html>