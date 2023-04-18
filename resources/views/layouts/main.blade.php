<!DOCTYPE html>
<html
    {{--  @if(app()->getLocale() == 'ar') dir="rtl" @endif--}}
>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{__('Course Marks')}} - @yield('title')</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/css/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{asset('assets/vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/jvectormap/jquery-jvectormap.css')}}">
    <!-- End plugin css for this page -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset('assets/css/demo/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/demo/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/scss/demo/_sidebar.scss')}}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}"/>

    <!-- Alertity CSS-->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>

    {{-- select 2 --}}
    <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>

    {{--    DataTable--}}
    <link href="{{ asset('assets/css/jquery_ui.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/dataTable.jqueryui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/dataTable.scroller.min.css') }}" rel="stylesheet">


    <link rel="stylesheet" href={{ asset('assets/css/myStyle.css') }}>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>
<script src="{{asset('assets/js/preloader.js')}}"></script>
<div class="body-wrapper">
    <aside class="mdc-drawer mdc-drawer--dismissible mdc-drawer--open">
        <div class="mdc-drawer__header">
            <a href="{{route('dashboard.index' , app()->getLocale())}}"
               class="brand-logo text-white text-decoration-none text-center">
                <h3>  {{__('Courses Marks')}}</h3>
            </a>
        </div>
        <div class="mdc-drawer__content">
            <div class="user-info">
                <p class="name">{{Auth::user()->name}}</p>
                <p class="email">{{Auth::user()->email}}</p>
            </div>
            <div class="mdc-list-group">
                <nav class="mdc-list mdc-drawer-menu">
                    <div class="mdc-list-item mdc-drawer-item">
                        <a class="mdc-drawer-link" href="{{route('dashboard.index' , app()->getLocale())}}">
                            <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon mt-2"
                               aria-hidden="true">dashboard</i>
                            <h6 class="mt-3 mr-2"> {{__('Dashboard')}}  </h6>
                        </a>
                    </div>

                    <div class="mdc-list-item mdc-drawer-item">
                        <a class="mdc-drawer-link"
                           href=" @if(Auth::user()->role->name === 'Admin'){{route('year_semesters' , [ 'language' => app()->getLocale()])}} @endif
                                  @if(Auth::user()->role->name === 'Teacher'){{route('year_semesters' , [ 'language' => app()->getLocale()])}} @endif
                                  ">
                            <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon mt-2"
                               aria-hidden="true">add</i>
                            <h6 class="mt-3 mr-2"> {{__('Enrollments')}}  </h6>
                        </a>
                    </div>

                    {{--                    <div class="mdc-list-item mdc-drawer-item">--}}
                    {{--                        <a class="mdc-drawer-link" href="{{route('bills.index' , app()->getLocale())}}">--}}
                    {{--                            <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon"--}}
                    {{--                               aria-hidden="true">add</i>--}}
                    {{--                            @if(app()->getLocale() === 'ar')--}}
                    {{--                                <h5--}}
                    {{--                                    class="mt-3 mr-2"> {{__('Add')}} {{__('Bills')}}  </h5>--}}
                    {{--                            @else--}}
                    {{--                                <h6 class="mt-3 mr-2"> {{__('Add')}}  {{__('Bills')}}  </h6>--}}
                    {{--                            @endif--}}
                    {{--                        </a>--}}
                    {{--                    </div>--}}

                    {{--                    <div class="mdc-list-item mdc-drawer-item">--}}
                    {{--                        <a class="mdc-drawer-link" href="{{route('item_numbers.index' , app()->getLocale())}}">--}}
                    {{--                            <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon"--}}
                    {{--                               aria-hidden="true">add</i>--}}
                    {{--                            @if(app()->getLocale() === 'ar')--}}
                    {{--                                <h5--}}
                    {{--                                    class="mt-3 mr-2"> {{__('Add')}} {{__('Items Numbers')}}  </h5>--}}
                    {{--                            @else--}}
                    {{--                                <h6 class="mt-3 mr-2"> {{__('Add')}}  {{__('Items Numbers')}}  </h6>--}}
                    {{--                            @endif--}}
                    {{--                        </a>--}}
                    {{--                    </div>--}}

                    {{--                    <div class="mdc-list-item mdc-drawer-item">--}}
                    {{--                        <a class="mdc-drawer-link" href="{{route('bookings.index' , app()->getLocale())}}">--}}
                    {{--                            <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon"--}}
                    {{--                               aria-hidden="true">book</i>--}}
                    {{--                            @if(app()->getLocale() === 'ar')--}}
                    {{--                                <h5 class="mt-3 mr-2"> {{__('Bookings')}}  </h5>--}}
                    {{--                            @else--}}
                    {{--                                <h6 class="mt-3 mr-2"> {{__('Bookings')}}  </h6>--}}
                    {{--                            @endif--}}

                    {{--                        </a>--}}
                    {{--                    </div>--}}
                    {{--                    <div class="mdc-list-item mdc-drawer-item">--}}
                    {{--                        <a class="mdc-drawer-link" href="{{route('rents.index' , app()->getLocale())}}">--}}
                    {{--                            <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon"--}}
                    {{--                               aria-hidden="true">stars</i>--}}
                    {{--                            @if(app()->getLocale() === 'ar')--}}
                    {{--                                <h5 class="mt-3 mr-2"> {{__('Rents')}}  </h5>--}}
                    {{--                            @else--}}
                    {{--                                <h6 class="mt-3 mr-2"> {{__('Rents')}}  </h6>--}}
                    {{--                            @endif--}}
                    {{--                        </a>--}}
                    {{--                    </div>--}}
                    {{--  Settings--}}
                    @if(Auth::user()->role->name === 'Admin')
                        <div class="mdc-list-item mdc-drawer-item">
                            <a class="mdc-expansion-panel-link" href="#" data-toggle="expansionPanel"
                               data-target="ui-sub-menu">
                                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon mt-2"
                                   aria-hidden="true">settings</i>

                                <h6 class="mt-3 mr-2"> {{__('System Settings')}} </h6>

                                <i class="mdc-drawer-arrow material-icons mr-2">chevron_right</i>
                            </a>
                            <div class="mdc-expansion-panel" id="ui-sub-menu">
                                <nav class="mdc-list mdc-drawer-submenu">
                                    <div class="mdc-list-item mdc-drawer-item">
                                        <a class="mdc-drawer-link" href="{{route('users.index' , app()->getLocale())}}">
                                            <h6 class="mt-3 mr-2"> {{__('Users')}}  </h6>
                                        </a>
                                    </div>

                                    <div class="mdc-list-item mdc-drawer-item">
                                        <a class="mdc-drawer-link"
                                           href="{{route('_courses.index' , app()->getLocale())}}">
                                            <h6 class="mt-3 mr-2"> {{__('Courses')}}  </h6>
                                        </a>
                                    </div>

                                    <div class="mdc-list-item mdc-drawer-item">
                                        <a class="mdc-drawer-link"
                                           href="{{route('teachers.index' , app()->getLocale())}}">
                                            <h6 class="mt-3 mr-2"> {{__('Teachers')}}  </h6>
                                        </a>
                                    </div>

                                    <div class="mdc-list-item mdc-drawer-item">
                                        <a class="mdc-drawer-link"
                                           href="{{route('students.index' , app()->getLocale())}}">
                                            <h6 class="mt-3 mr-2"> {{__('Students')}}  </h6>
                                        </a>
                                    </div>

                                    <div class="mdc-list-item mdc-drawer-item">
                                        <a class="mdc-drawer-link"
                                           href="{{route('semesters.index' , app()->getLocale())}}">
                                            <h6 class="mt-3 mr-2"> {{__('Semesters')}}  </h6>
                                        </a>
                                    </div>


                                </nav>
                            </div>
                        </div>
                    @endif

                </nav>
            </div>
        </div>
    </aside>

    {{-- Top bar--}}
    <div class="main-wrapper mdc-drawer-app-content">
        <header class="mdc-top-app-bar">
            <div class="mdc-top-app-bar__row">
                <div class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
                    <button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button sidebar-toggler">menu
                    </button>
                </div>
                <div
                    class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end mdc-top-app-bar__section-right">
                    <div class="menu-button-container menu-profile d-none d-md-block">
                        <button class="mdc-button mdc-menu-button">
                <span class="d-flex align-items-center">
                </span>
                        </button>
                        <div class="mdc-menu mdc-menu-surface" tabindex="-1">
                            <ul class="mdc-list" role="menu" aria-hidden="true" aria-orientation="vertical">
                                <li class="mdc-list-item" role="menuitem">
                                    <div class="item-thumbnail item-thumbnail-icon-only">
                                        <i class="mdi mdi-account-edit-outline text-primary"></i>
                                    </div>
                                    <div
                                        class="item-content d-flex align-items-start flex-column justify-content-center">
                                        <h6 class="item-subject font-weight-normal">Edit profile</h6>
                                    </div>
                                </li>
                                <li class="mdc-list-item" role="menuitem">
                                    <div class="item-thumbnail item-thumbnail-icon-only">
                                        <i class="mdi mdi-settings-outline text-primary"></i>
                                    </div>
                                    <div
                                        class="item-content d-flex align-items-start flex-column justify-content-center">
                                        <h6 class="item-subject font-weight-normal">Logout</h6>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="divider d-none d-md-block"></div>

                    {{--                    @php--}}
                    {{--                        // set the laguage with other parames url--}}
                    {{--                        $params = request()--}}
                    {{--                            ->route()--}}
                    {{--                            ->parameterNames();--}}
                    {{--                        $params_values = [];--}}

                    {{--                        foreach ($params as $param) {--}}
                    {{--                            $params_values = request()--}}
                    {{--                                ->route()--}}
                    {{--                                ->parameters($param);--}}
                    {{--                        }--}}

                    {{--                        if (app()->getLocale() === 'ar') {--}}
                    {{--                            $params_values['language'] = 'en';--}}
                    {{--                        } else {--}}
                    {{--                            $params_values['language'] = 'ar';--}}
                    {{--                        }--}}

                    {{--                    @endphp--}}

                    {{--                    @if (app()->getLocale() === 'ar')--}}

                    {{--                        <a id="languages" rel="nofollow"--}}
                    {{--                           href="{{ route(Route::CurrentRouteName(), $params_values) }} "--}}
                    {{--                           class="nav-link language dropdown-toggle ml-2">--}}
                    {{--                            <img src={{ asset('assets/images/flags/GB.png') }} alt="English"><span--}}
                    {{--                                class="d-none d-sm-inline-block mr-2 ml-2">English</span></a>--}}

                    {{--                    @else--}}

                    {{--                        <a id="languages" rel="nofollow"--}}
                    {{--                           href="{{ route(Route::CurrentRouteName(), $params_values) }} "--}}
                    {{--                           class="nav-link language dropdown-toggle mr-2">--}}
                    {{--                            <img src={{ asset('assets/images/flags/OM.png') }} alt="Arabic"><span--}}
                    {{--                                class="d-none d-sm-inline-block ml-2 mr-2">عربي</span></a>--}}

                    {{--                    @endif--}}

                    <div class="menu-button-container ">

                        <button class="mdc-button mdc-menu-button" title="{{__('Logout')}}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="mdi mdi-logout-variant "></i>
                        </button>
                        <form id="logout-form" action="{{ route('logout', app()->getLocale()) }}" method="POST"
                              class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <div class="page-wrapper mdc-toolbar-fixed-adjust">
            <main class="content-wrapper">
                <div class="mdc-layout-grid">
                    <div class="mdc-layout-grid__inner">
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                            <div class="mdc-card">

                                <div class="message mt-5">
                                    @if (Session::has('message'))
                                        <p class="alert text-center {{ Session::get('alert-class', 'alert-info') }}">
                                            @foreach(explode(' ' ,Session::get('message')) as $message)
                                                {{ __($message) }}
                                            @endforeach
                                        </p>
                                    @endif
                                </div>

                                <div class="d-flex justify-content-between"
                                     @if(app()->getLocale() === 'ar') dir="rtl" @endif>
                                    @yield('content')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <footer>
                <div class="mdc-layout-grid">
                    <div class="mdc-layout-grid__inner">
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                            <span class="text-center text-sm-left d-block d-sm-inline-block tx-14">Copyright © Courses Marks 2023</span>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</div>

<!-- plugins:js -->
<script src="{{asset('assets/vendors/js/vendor.bundle.base.js')}}"></script>
{{--    select2 --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
{{--   Alertify --}}
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<script src="{{asset('assets/vendors/chartjs/Chart.min.js')}}"></script>
<script src="{{asset('assets/vendors/jvectormap/jquery-jvectormap.min.js')}}"></script>
<script src="{{asset('assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="{{asset('assets/js/material.js')}}"></script>
<script src="{{asset('assets/js/misc.js')}}"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="{{asset('assets/js/dashboard.js')}}"></script>
<script src={{ asset('assets/js/myScript.js') }}></script>

@yield('scripts')

</body>
</html>
