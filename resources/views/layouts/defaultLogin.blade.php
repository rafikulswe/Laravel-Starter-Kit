<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{ asset('adminAssets/css/icons/icomoon/styles.min.css') }} " rel="stylesheet" type="text/css">
    <link href="{{ asset('adminAssets/css/all.min.css') }} " rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->
</head>

<body>
    <!-- Page content -->
    <div class="page-content">
        <!-- Main content -->
        <div class="content-wrapper">
            <!-- Inner content -->
            <div class="content-inner">

                <!-- Content area -->
                <div class="content d-flex justify-content-center align-items-center">
                    @yield('content')

                </div>
                <!-- /content area -->
            </div>
            <!-- /inner content -->
        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

    <!-- Core JS files -->
    <script src="{{ asset('adminAssets/js/main/jquery.min.js') }} "></script>
    <script src="{{ asset('adminAssets/js/main/bootstrap.bundle.min.js') }} "></script>
    <!-- /core JS files -->

    <script src="{{ asset('adminAssets/js/app.js') }} "></script>
    <!-- /theme JS files -->
</body>

</html>
