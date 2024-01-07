<!--
=========================================================
* Argon Dashboard 2 - v2.0.4
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ url('assets/assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ url('assets/assets/img/favicon.png') }}">
    <title>
        BukNat - LMIS
    </title>

    @vite('resources/js/app.js')

    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ url('assets/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/assets/css/nucleo-svg.css') }}" rel="stylesheet" />

    {{-- <link href="{{ url('assets/assets/css/bootstrap.min.css') }}"> --}}
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ url('assets/assets/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>

    <!-- Popper.js -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script> --}}

    <!-- Bootstrap 4 -->
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> --}}
</head>

<body class="g-sidenav-show   bg-gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100"
        style="background-image: url('https://media.licdn.com/dms/image/C561BAQGoO3WWkMBcCQ/company-background_10000/0/1632665721223?e=1698660000&v=beta&t=6k32kzNxn8BdFEJuJdO_KjZZLwnUOPEX6V_cVMv5yDQ'); background-position-y: 50%;">
        <span class="mask bg-primary opacity-6"></span>
    </div>

    @include('layouts.sidenav')

    <main class="main-content position-relative border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur"
            data-scroll="false">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm">
                            <a class="opacity-5 text-white" href="javascript:;">
                                @if (Auth::user()->role == 1)
                                    Librarian
                                @elseif (Auth::user()->role == 0)
                                    Student
                                @elseif (Auth::user()->role == 2)
                                    Teacher
                                @endif
                            </a>
                        </li>
                        <li class="breadcrumb-item text-sm text-white active" aria-current="page">
                            {{ Auth::user()->name }}</li>
                    </ol>

                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                        <div class="input-group">
                            {{-- <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span> --}}
                            {{-- <input type="text" class="form-control" placeholder="Type here..."> --}}
                        </div>
                    </div>
                    <ul class="navbar-nav  justify-content-end">
                        <li class="nav-item d-flex align-items-center">
                            @if (Auth::user())
                            <a id="openModalBtn"
                                class="nav-link text-white font-weight-bold cursor-pointer" title="Notifications">
                                <i class="fa fa-bell"></i>&nbsp;&nbsp;
                            </a>

                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"
                                class="nav-link text-white font-weight-bold" title="Logout?">
                                <i class="fa fa-user me-sm-1"></i>
                            </a>


                            @else
                                <a href="javascript:;" class="nav-link text-white font-weight-bold px-0">
                                    <i class="fa fa-user me-sm-1"></i>
                                    <span class="d-sm-inline d-none">Sign In</span>
                                </a>
                            @endif



                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->


        <!-- Logout Form-->
        <form method="POST" id="profileUser" action="{{ route('profile') }}" class="d-none">
            <input type="text" name="userID" value="{{ Auth::user()->id }}" hidden>
            @csrf
        </form>


        <!-- Logout Form-->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>

        <!-- The Modal -->
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" id="closeModalBtn">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <p>For pass due books and unreturned books, it can be seen in the dashboard Section</p>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                    @if(Auth::user()->role === 1)
                        <a type="button" class="btn btn-success" href="/Librarian/dashboard">Go to dashboard</a>

                        @elseif(Auth::user()->role === 0)
                            <a type="button" class="btn btn-success" href="/Student/dashboard">Go to dashboard</a>
                        @elseif(Auth::user()->role === 2)
                            <a type="button" class="btn btn-success" href="/Teacher/dashboard">Go to dashboard</a>

                        @endif
                    </div>
                </div>
            </div>
        </div>

        @yield('content')
        <div class="d-flex justify-content-center py-4 fw-bold lh-lg fst-italic">
            <p>Library Management System</p>
        </div>


    </main>

    <script>
        // Trigger the modal on page load
        $(document).ready(function () {
            $("#myModal").modal("hide");
        });

        // Close the modal when the "Close" button is clicked
        $("#closeModalBtn").click(function () {
            $("#myModal").modal("hide");
        });

        $("#openModalBtn").click(function () {
            $("#myModal").modal("show");
        });

    </script>

    <!--   Core JS Files   -->
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    {{-- <script src="{{ url('assets/assets/js/core/popper.min.js') }}"></script> --}}
    {{-- <script src="{{ url('assets/assets/js/core/bootstrap.min.js') }}"></script> --}}
    {{-- <script src="{{ url('assets/assets/js/plugins/perfect-scrollbar.min.js') }}"></script> --}}
    {{-- <script src="{{ url('assets/assets/js/plugins/smooth-scrollbar.min.js') }}"></script> --}}
    {{-- <script src="{{ url('assets/assets/js/plugins/chartjs.min.js') }}"></script> --}}

    <!-- Github buttons -->
    {{-- <script async defer src="https://buttons.github.io/buttons.js"></script> --}}
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ url('assets/assets/js/argon-dashboard.min.js?v=2.0.4') }}"></script>

    {{-- <script src="{{ url('assets/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('assets/assets/js/jquery.min.js') }}"></script> --}}
    @vite('resources/js/app.js')
</body>


</html>
