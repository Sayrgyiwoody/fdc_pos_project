<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>@yield('title')</title>

    <!-- Fontfaces CSS-->
    <link href="{{asset('admin/css/font-face.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    {{-- <link href="{{asset('admin/vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all"> --}}

    <!-- Vendor CSS-->
    <link href="{{asset('admin/vendor/animsition/animsition.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/wow/animate.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/css-hamburgers/hamburgers.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/slick/slick.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/select2/select2.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.css')}}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{asset('admin/css/theme.css')}}" rel="stylesheet" media="all">

    {{-- Bootstrap cdn --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

    <!-- Add SweetAlert CDN -->
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.min.js"></script>

     <!-- Add SweetAlert styles -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.min.css">

     {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        .shadow_2 {
            box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
        }
    </style>

</head>

<body>
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="{{asset('storage/logo/logo.png')}}" width="150px" alt="" class="img" />
                </a>
            </div>
            <div class="">
                <nav class="navbar-sidebar">
                    <ul class="nav flex-column nav-pills">
                        <li class="nav-item my-1 ">
                            <a href="{{route('category#list')}}" aria-current="page" class="nav-link text-dark ">
                                <i class="fas fa-list me-2"></i>Category</a>
                        </li>
                        <li class="nav-item my-1 ">
                            <a href="{{route('product#list')}}" class="nav-link text-dark">
                                <i class="fa-solid fa-gifts me-2"></i>Product</a>
                        </li>
                        <li class="nav-item my-1 ">
                            <a href="{{route('admin#orderListPage')}}" class="nav-link text-dark">
                                <i class="fa-solid fa-border-all me-2"></i>Order List</a>
                        </li>
                        <li class="nav-item my-1 ">
                            <a href="{{route('admin#adminAccountList')}}" class="nav-link text-dark">
                                <i class="fa-solid fa-user-shield me-2"></i>Admin List</a>
                        </li>
                        <li class="nav-item my-1 ">
                            <a href="{{route('admin#userAccountList')}}" class="nav-link text-dark">
                                <i class="fa-solid fa-users me-2"></i>User List</a>
                        </li>
                        <li class="nav-item my-1 ">
                            <a href="{{route('admin#contactPage')}}" class="nav-link text-dark">
                                <i class="fa-solid fa-envelope me-2"></i>Contact Messages</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            @yield('header')
                            <div class="header-button">
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            @if (Auth::user()->image==null && Auth::user()->gender=='male')
                                            <img class="" src="{{asset('images/default_user.png')}}"  />
                                            @endif
                                            @if (Auth::user()->image==null && Auth::user()->gender=='female')
                                            <img class="" src="{{asset('images/default_female_user.png')}}"  />
                                            @endif
                                            @if (Auth::user()->image)
                                            <div class="" style="width:45px;height:45px;overflow:hidden;">
                                                <img class="w-100 h-100" style="object-fit: cover; object-position:center;" src="{{asset('storage/profileImages/'.Auth::user()->image)}}"/>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">{{Auth::user()->name}}</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    @if (Auth::user()->image==null && Auth::user()->gender=='male')
                                                    <img class="" src="{{asset('images/default_user.png')}}"  />
                                                    @endif
                                                    @if (Auth::user()->image==null && Auth::user()->gender=='female')
                                                    <img class="" src="{{asset('images/default_female_user.png')}}"  />
                                                    @endif
                                                    @if (Auth::user()->image)
                                                    <div style="width: 65px; height: 65px; overflow: hidden;">
                                                        <img class="w-100 h-100" style="object-fit: cover; object-position:center;" src="{{asset('storage/profileImages/'.Auth::user()->image)}}"/>
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#">{{Auth::user()->name}}</a>
                                                    </h5>
                                                    <span class="email">{{Auth::user()->email}}</span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__item">
                                                <a href="{{route('admin#informationPage')}}">
                                                    <i class="fa-solid fa-user-secret"></i>Account</a>
                                            </div>
                                            <div class="account-dropdown__item">
                                                <a href="{{route('admin#changePasswordPage')}}">
                                                    <i class="fas fa-key"></i>Change Password</a>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <form action="{{route('logout')}}" method="post" class="p-3">
                                                    @csrf
                                                    <button class="btn btn-primary w-100">Logout</button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->
            @yield('content')
        {{-- End page container --}}
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="{{asset('admin/vendor/jquery-3.2.1.min.js')}}"></script>
    {{-- <!-- Bootstrap JS-->
    <script src="{{asset('admin/vendor/bootstrap-4.1/popper.min.js')}}"></script>
    <script src="{{asset('admin/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script> --}}
    <!-- Vendor JS       -->
    <script src="{{asset('admin/vendor/slick/slick.min.js')}}">
    </script>
    <script src="{{asset('admin/vendor/wow/wow.min.js')}}"></script>
    <script src="{{asset('admin/vendor/animsition/animsition.min.js')}}"></script>
    <script src="{{asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js')}}">
    </script>
    <script src="{{asset('admin/vendor/counter-up/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('admin/vendor/counter-up/jquery.counterup.min.js')}}">
    </script>
    <script src="{{asset('admin/vendor/circle-progress/circle-progress.min.js')}}"></script>
    <script src="{{asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('admin/vendor/chartjs/Chart.bundle.min.js')}}"></script>
    <script src="{{asset('admin/vendor/select2/select2.min.js')}}">
    </script>

    {{-- Bootstrap js --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Main JS-->
    <script src="{{asset('admin/js/main.js')}}"></script>

    <script src="{{asset('admin/js/app.js')}}"></script>

    @yield('scriptSource')

    <script>
        var currentUrl = window.location.href;

        $('.nav-link').each(function() {
            var linkUrl = $(this).attr('href');

            if(currentUrl.indexOf(linkUrl) != -1) {
                $(this).addClass('bg-secondary text-white');

            }
        })
    </script>

</body>

</html>
<!-- end document-->
