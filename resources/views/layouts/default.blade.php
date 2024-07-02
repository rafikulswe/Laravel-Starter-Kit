<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset('adminAssets/images/logo_icon_dark.png') }}">
    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('adminAssets/css/icons/icomoon/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('adminAssets/css/icons/material/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('adminAssets/css/icons/fontawesome/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('adminAssets/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('adminAssets/js/toastr/toastr.min.css') }}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->
</head>

<body>

    <!-- Main navbar -->
    <div class="navbar navbar-expand-lg navbar-dark navbar-static">
        <div class="d-flex flex-1 d-lg-none">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
                <i class="icon-paragraph-justify3"></i>
            </button>
            <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
                <i class="icon-transmission"></i>
            </button>
        </div>

        <div class="navbar-brand text-center text-lg-left">
            <a href="index.html" class="d-inline-block">
                <img src="{{ asset('adminAssets/images/logo_light.png') }} " class="d-none d-sm-block" alt="">
                <img src="{{ asset('adminAssets/images/logo_icon_light.png') }}" class="d-sm-none" alt="">
            </a>
        </div>

        <div class="collapse navbar-collapse order-2 order-lg-1" id="navbar-mobile"></div>

        <ul class="navbar-nav flex-row order-1 order-lg-2 flex-1 flex-lg-0 justify-content-end align-items-center">
            <li class="nav-item nav-item-dropdown-lg dropdown dropdown-user h-100">
                <a href="#"
                    class="navbar-nav-link navbar-nav-link-toggler dropdown-toggle d-inline-flex align-items-center h-100"
                    data-toggle="dropdown">
                    <img src="{{ asset('adminAssets/images/placeholders/placeholder.jpg') }} "
                        class="rounded-pill mr-lg-2" height="34" alt="">
                    <span class="d-none d-lg-inline-block">{{ Auth::user()->name }}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right data-list">

                    <a modal-title="" modal-type="show" modal-size="extra-large" modal-class="" selector="EditUser"
                        modal-link="{{ route('provider.profileEdit') }}" class="dropdown-item open-modal"><i
                            class="icon-user-plus"></i> My profile</a>

                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item"><i class="icon-cog5"></i> Account settings</a>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="dropdown-item"><i class="icon-switch2"></i>
                        Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
    <!-- /main navbar -->



    <!-- Page content -->
    <div class="page-content">

        <!-- Main sidebar -->
        <div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg">

            <!-- Sidebar content -->
            <div class="sidebar-content">

                <!-- User menu -->
                <div class="sidebar-section sidebar-user my-1">
                    <div class="sidebar-section-body">
                        <div class="media">
                            <a href="{{ url('/') }}" class="mr-3">
                                <img src="{{ asset('adminAssets/images/placeholders/placeholder.jpg') }} "
                                    class="rounded-circle" alt="">
                            </a>

                            <div class="media-body">
                                <div class="font-weight-semibold">{{ Auth::user()->name }}</div>
                                <div class="font-size-sm line-height-sm opacity-50">
                                    Senior developer
                                </div>
                            </div>

                            <div class="ml-3 align-self-center">
                                <button type="button"
                                    class="btn btn-outline-light-100 text-white border-transparent btn-icon rounded-pill btn-sm sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
                                    <i class="icon-transmission"></i>
                                </button>

                                <button type="button"
                                    class="btn btn-outline-light-100 text-white border-transparent btn-icon rounded-pill btn-sm sidebar-mobile-main-toggle d-lg-none">
                                    <i class="icon-cross2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /user menu -->

                <!-- Main navigation -->
                <div class="sidebar-section">
                    <ul class="nav nav-sidebar" data-nav-type="accordion">
                        <!-- Main -->
                        <li class="nav-item-header">
                            <div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu"
                                title="Main"></i>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('provider.home') }}"
                                class="{{ request()->is('provider/home*') ? 'nav-link active' : 'nav-link' }}">
                                <i class="mi-dashboard"></i>
                                <span>
                                    Dashboard
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('provider.example.index') }}"
                                class="{{ request()->is('provider/example*') ? 'nav-link active' : 'nav-link' }}">
                                <i class="fas fa-users"></i>
                                <span>
                                    Example
                                </span>
                            </a>
                        </li>
                        <li class="nav-item nav-item-submenu">
                            <a href="#" class="nav-link"><i class="fas fa-cog"></i>
                                <span>Setting</span></a>
                            <ul class="nav nav-group-sub" data-submenu-title="Setting">
                                <li class="nav-item">
                                    <a href="{{ route('provider.role.index') }}"
                                        class="{{ request()->is('provider/role*') ? 'nav-link active' : 'nav-link' }}">
                                        <i class="fas fa-users"></i>
                                        <span>
                                            Role
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('provider.user.index') }}"
                                        class="{{ request()->is('provider/user*') ? 'nav-link active' : 'nav-link' }}">
                                        <i class="fas fa-user"></i>
                                        <span>
                                            User
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item nav-item-submenu">
                            <a href="#" class="nav-link"><i class="icon-color-sampler"></i>
                                <span>Setup</span></a>
                            <ul class="nav nav-group-sub" data-submenu-title="Setup">
                                <li class="nav-item">
                                    <a href="{{ route('provider.organization.index') }}"
                                        class="{{ request()->is('provider/organization*') ? 'nav-link active' : 'nav-link' }}">
                                        <i class="fas fa-building"></i>
                                        <span>
                                            Organization
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('provider.organogram.index') }}"
                                        class="{{ request()->is('provider/organogram*') ? 'nav-link active' : 'nav-link' }}">
                                        <i class="fas fa-building"></i>
                                        <span>
                                            Organogram
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('provider.lookup.index') }}"
                                        class="{{ request()->is('provider/lookup*') ? 'nav-link active' : 'nav-link' }}">
                                        <i class="fas fa-search"></i>
                                        <span>
                                            Lookup
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('provider.location.index') }}"
                                        class="{{ request()->is('provider/location*') ? 'nav-link active' : 'nav-link' }}">
                                        <i class="fas fa-map-marker"></i>
                                        <span>
                                            Location
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('provider.roleGroup.index') }}"
                                class="{{ request()->is('provider/roleGroup*') ? 'nav-link active' : 'nav-link' }}">
                                <i class="fas fa-user-tie"></i>
                                <span>
                                    Role Group
                                </span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('provider.resource.index') }}"
                                class="{{ request()->is('provider/resource*') ? 'nav-link active' : 'nav-link' }}">
                                <i class="fas fa-bolt"></i>
                                <span>
                                    Resource
                                </span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('provider.scope.index') }}"
                                class="{{ request()->is('provider/scope*') ? 'nav-link active' : 'nav-link' }}">
                                <i class="fas fa-crosshairs"></i>
                                <span>
                                    Scope
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('provider.permission.index') }}"
                                class="{{ request()->is('provider/permission*') ? 'nav-link active' : 'nav-link' }}">
                                <i class="far fa-check-square"></i>
                                <span>
                                    Permissions
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- /main navigation -->

            </div>
            <!-- /sidebar content -->

        </div>
        <!-- /main sidebar -->


        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Inner content -->
            <div class="content-inner">

                @yield('content')

                <!-- Footer -->
                <div class="navbar navbar-expand-lg navbar-light border-bottom-0 border-top">
                    <div class="text-center d-lg-none w-100">
                        <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse"
                            data-target="#navbar-footer">
                            <i class="icon-unfold mr-2"></i>
                            Footer
                        </button>
                    </div>

                    <div class="navbar-collapse collapse" id="navbar-footer">
                        <span class="navbar-text">
                            &copy; {{ date('Y') }} <a href="#">Limitless Web App Kit</a> by <a
                                href="https://themeforest.net/user/Kopyov" target="_blank">Md. Najmul Hasan</a>
                        </span>

                        <ul class="navbar-nav ml-lg-auto">
                            <li class="nav-item"><a href="https://kopyov.ticksy.com/" class="navbar-nav-link"
                                    target="_blank"><i class="icon-lifebuoy mr-2"></i> Support</a></li>
                            <li class="nav-item"><a href="https://demo.interface.club/limitless/docs/"
                                    class="navbar-nav-link" target="_blank"><i class="icon-file-text2 mr-2"></i>
                                    Docs</a></li>
                            <li class="nav-item"><a
                                    href="https://themeforest.net/item/limitless-responsive-web-application-kit/13080328?ref=kopyov"
                                    class="navbar-nav-link font-weight-semibold"><span class="text-pink"><i
                                            class="icon-cart2 mr-2"></i> Purchase</span></a></li>
                            <li class="nav-item">
                                <a href="#" class="navbar-nav-link" target="_blank">
                                    <i class="icon-versions mr-2"></i>
                                    Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP
                                    v{{ PHP_VERSION }})
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /footer -->

            </div>
            <!-- /inner content -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

    <!-- Core JS files -->
    <script src="{{ asset('adminAssets/js/main/jquery.min.js') }}"></script>
    <script src="{{ asset('adminAssets/js/main/bootstrap.bundle.min.js') }}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    {{-- <script src="{{ asset('adminAssets/js/plugins/visualization/d3/d3.min.js') }}"></script>
    <script src="{{ asset('adminAssets/js/plugins/visualization/d3/d3_tooltip.js ') }}"></script>
    <script src="{{ asset('adminAssets/js/plugins/ui/moment/moment.min.js') }}"></script>
    <script src="{{ asset('adminAssets/js/plugins/pickers/daterangepicker.js') }}"></script> --}}

    <script src="{{ asset('adminAssets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('adminAssets/js/plugins/tables/datatables/extensions/buttons.min.js') }}"></script>
    <script src="{{ asset('adminAssets/js/plugins/notifications/sweet_alert.min.js') }}"></script>
    <script src="{{ asset('adminAssets/js/plugins/extensions/jquery_ui/interactions.min.js') }}"></script>
    <script src="{{ asset('adminAssets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('adminAssets/js/plugins/media/glightbox.min.js') }}"></script>

    <script src="{{ asset('adminAssets/js/plugins/forms/inputs/inputmask.js') }}"></script>
    <script src="{{ asset('adminAssets/js/plugins/forms/inputs/autosize.min.js') }}"></script>
    <script src="{{ asset('adminAssets/js/plugins/forms/inputs/formatter.min.js') }}"></script>
    <script src="{{ asset('adminAssets/js/plugins/forms/inputs/typeahead/typeahead.bundle.min.js') }}"></script>
    <script src="{{ asset('adminAssets/js/plugins/forms/inputs/typeahead/handlebars.min.js') }}"></script>
    <script src="{{ asset('adminAssets/js/plugins/forms/inputs/passy.js') }}"></script>
    <script src="{{ asset('adminAssets/js/plugins/forms/inputs/maxlength.min.js') }}"></script>

    {{-- <script type="text/javascript" src="{{ asset('adminAssets/js/bootbox/bootbox.js') }}"></script>
    <script type="text/javascript" src="{{ asset('adminAssets/js/bootbox/bootbox.locales.min.js') }}"></script> --}}

    <!-- Theme JS files -->
    {{-- <script src="{{ asset('adminAssets/js/plugins/extensions/rowlink.js') }}"></script>
    <script src="{{ asset('adminAssets/js/plugins/visualization/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('adminAssets/js/plugins/ui/fullcalendar/core/main.min.js') }}"></script>
    <script src="{{ asset('adminAssets/js/plugins/ui/fullcalendar/daygrid/main.min.js') }}"></script>
    <script src="{{ asset('adminAssets/js/plugins/ui/fullcalendar/timegrid/main.min.js') }}"></script>
    <script src="{{ asset('adminAssets/js/plugins/ui/fullcalendar/interaction/main.min.js') }}"></script> --}}


    <script src="{{ asset('adminAssets/js/plugins/ui/prism.min.js') }}"></script>
    <script src="{{ asset('adminAssets/js/plugins/notifications/bootbox.min.js') }}"></script>
    <script src="{{ asset('adminAssets/js/plugins/editors/summernote/summernote.min.js') }}"></script>

    <script src="{{ asset('adminAssets/js/app.js') }}"></script>

    {{-- <script src="{{ asset('adminAssets/js/demo_pages/user_pages_profile_tabbed.js') }}"></script>
    <script src="{{ asset('adminAssets/js/demo_charts/echarts/light/bars/tornado_negative_stack.js') }}"></script>
    <script src="{{ asset('adminAssets/js/demo_charts/pages/profile/light/balance_stats.js') }}"></script>
    <script src="{{ asset('adminAssets/js/demo_charts/pages/profile/light/available_hours.js') }}"></script> --}}

    {{-- <script src="{{ asset('adminAssets/js/demo_pages/blog_single.js') }}"></script>
    <script src="{{ asset('adminAssets/js/demo_pages/components_modals.js') }}"></script> --}}
    <script src="{{ asset('adminAssets/js/demo_pages/form_select2.js') }}"></script>

    <script src="{{ asset('adminAssets/js/custom.js') }}"></script>
    {{-- <script src="{{ asset('adminAssets/js/demo_pages/content_cards_content.js') }}"></script> --}}

    {{-- <script src="{{ asset('adminAssets/js/demo_pages/extra_sweetalert.js') }}"></script> --}}

    {{-- <script src="{{ asset('adminAssets/js/demo_pages/form_controls_extended.js') }}"></script>

    <script src="{{ asset('adminAssets/js/demo_pages/gallery.js') }}"></script>
    <script src="{{ asset('adminAssets/js/demo_pages/form_layouts.js') }}"></script>
    <script src="{{ asset('adminAssets/js/demo_pages/datatables_advanced.js') }}"></script>
    <script src="{{ asset('adminAssets/js/demo_pages/datatables_extension_buttons_init.js') }}"></script> --}}

    <script src="{{ asset('adminAssets/js/toastr/toastr.min.js') }}"></script>
    {!! Toastr::message() !!}
    <!-- /theme JS files -->
    @stack('script')


</body>

</html>
