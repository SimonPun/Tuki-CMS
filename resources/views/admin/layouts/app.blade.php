<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>TukiSoft- @yield('title')</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <link href="{{ asset('main.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">

</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow">
            <div class="app-header__logo">
                <div class="app-header__logo">
                    <a href="{{ route('admin.dashboard') }}">
                        <img src="{{ asset('assets/images/tuki_logo.png') }}" alt="Logo"
                            style="height: 23px; width: auto;">
                    </a>
                </div>


                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                            data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button"
                        class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>
            <div class="app-header__content">
                <div class="app-header-left">
                </div>
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="btn-group">
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                            class="p-0 btn">
                                            <img class="rounded-circle"
                                                src="{{ asset('assets/images/avatars/11.svg') }}" alt=""
                                                style="width: 40px; height: 40px;">
                                            <span class="ml-2">Hello, {{ auth()->user()->name }}</span>
                                            <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                        </a>

                                        <div tabindex="-1" role="menu" aria-hidden="true"
                                            class="dropdown-menu dropdown-menu-right">
                                            <button type="button" tabindex="0" class="dropdown-item">User
                                                Account</button>


                                            <form method="POST" action="{{ route('admin.logout') }}"
                                                style="display: inline;">
                                                @csrf
                                                <button type="submit" class="dropdown-item"
                                                    tabindex="0">Logout</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="app-main">
            <div class="app-sidebar sidebar-shadow">
                <div class="app-header__logo">
                    <div class="logo-src"></div>
                    <div class="header__pane ml-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                                data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="app-header__menu">
                    <span>
                        <button type="button"
                            class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                        </button>
                    </span>
                </div>
                <div class="scrollbar-sidebar">
                    <div class="app-sidebar__inner">
                        <ul class="vertical-nav-menu">
                            <li class="app-sidebar__heading">Admin Dashboards</li>
                            <li>
                                <a href="{{ route('admin.dashboard') }}" class="mm-active">
                                    <i class="metismenu-icon pe-7s-photo-gallery"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="metismenu-icon pe-7s-users"></i>
                                    Teams
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>

                                <ul class="mm-collapse">
                                    <li>
                                        <a href="{{ route('admin.employee.list') }}" class="mm-active">
                                            <i class="metismenu-icon pe-7s-copy-file"></i>
                                            List
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.employee.add') }}" class="mm-active">
                                            <i class="metismenu-icon pe-7s-rocket"></i>
                                            Add New
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="#">
                                    <i class="metismenu-icon pe-7s-rocket"></i>
                                    Projects
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>

                                <ul class="mm-collapse">
                                    <li>
                                        <a href="{{ route('admin.task.list') }}" class="mm-active">
                                            <i class="metismenu-icon pe-7s-rocket"></i>
                                            List
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.task.add') }}" class="mm-active">
                                            <i class="metismenu-icon pe-7s-rocket"></i>
                                            Add New
                                        </a>
                                    </li>
                                </ul>
                            </li>


                            <li>
                                <a href="#">
                                    <i class="metismenu-icon pe-7s-box1"></i>
                                    Vacancy
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>

                                <ul class="mm-collapse">
                                    <li>
                                        <a href="{{ route('admin.vacancy.list') }}" class="mm-active">
                                            <i class="metismenu-icon pe-7s-rocket"></i>
                                            List
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.vacancy.create') }}" class="mm-active">
                                            <i class="metismenu-icon pe-7s-rocket"></i>
                                            Add New
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="metismenu-icon pe-7s-box1"></i>
                                    Applicants
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul class="mm-collapse">
                                    <li>
                                        <a href="{{ route('admin.applicants.index') }}">
                                            <i class="metismenu-icon pe-7s-rocket"></i>
                                            Applicants List
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.applicants.create') }}">
                                            <i class="metismenu-icon pe-7s-plus"></i>
                                            Add Applicant
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="metismenu-icon pe-7s-box1"></i>
                                    Attandence
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul class="mm-collapse">
                                    <li>
                                        <a href="">
                                            <i class="metismenu-icon pe-7s-rocket"></i>
                                            View Attandence
                                        </a>
                                    </li>

                                </ul>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="metismenu-icon pe-7s-unlock"></i>
                                    Admin
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>

                                <ul class="mm-collapse">
                                    <li>
                                        <a href="{{ route('admin.admin.list') }}" class="mm-active">
                                            <i class="metismenu-icon pe-7s-rocket"></i>
                                            List
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.admin.add') }}" class="mm-active">
                                            <i class="metismenu-icon pe-7s-rocket"></i>
                                            Add New
                                        </a>
                                    </li>
                                </ul>
                            </li>


                        </ul>
                    </div>
                </div>
            </div>
            @yield('content')
            <script src="https://maps.google.com/maps/api/js?sensor=true"></script>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('assets/scripts/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/scripts/main.js') }}"></script>
    <script type="text/javascript" src="{{ asset('app.js') }}"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>

    @yield('footer')
</body>

</html>
