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
    <link rel="apple-touch-icon" sizes="76x76" href="{{ url('assets/assets/img/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ url('assets/assets/img/favicon.ico') }}">
    <title>
        BukNat - LMIS
    </title>

    @vite('resources/js/app.js')
    

    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ url('assets/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/assets/css/nucleo-svg.css') }}" rel="stylesheet" />

    <!-- CSS Files -->
    <!-- <link rel="stylesheet" href="{{ url('assets/assets/css/book_qrcode.css') }}"> -->
    <link id="pagestyle" href="{{ url('assets/assets/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

     <!-- First load Popper.js -->
     <script src="https://unpkg.com/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    
    <!-- Then load Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Finally load Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</head>

<body class="g-sidenav-show bg-gray-100">
    <div class="min-height-300 position-absolute w-100" style="background-image: url('{{ asset('assets/assets/img/buknat9.jpg') }}'); background-position-y: 60%; background-repeat: no-repeat; background-size: cover;">
        <span class="mask bg-gradient-faded-dark opacity-6"></span>
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
                            <a class="opacity-75 text-white text-decoration-none" href="javascript:;">
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
                        </div>
                    </div>
                    <ul class="navbar-nav justify-content-end">

                        <li class="nav-item dropdown pe-2 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-bell cursor-pointer text-white"></i>
                                <span class="badge badge-light bg-dark badge-xs">{{auth()->user()->unreadNotifications->count()}}</span>
                            </a>
                            <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                                @if (auth()->user()->unreadNotifications)
                                <li class="d-flex justify-content-end mx-1 my-2">
                                    <form action="{{ route('mark-as-delete') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">Delete All</button>
                                    </form>
                                </li>
                                @endif

                                @foreach (auth()->user()->unreadNotifications as $notification)
                                
                                <li class="mb-2">
                                    <a class="dropdown-item border-radius-md bg-gradient-faded-info" href="javascript:;">
                                        <div class="d-flex py-1">
                                            <div class="my-auto">
                                                <!-- Update image path to use asset() helper -->
                                                <img src="{{ asset('assets/assets/img/logo.png') }}" class="avatar avatar-sm  me-3 ">
                                            </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="text-sm font-weight-normal mb-1">
                                                            <span class="font-weight-bold">{{$notification->data['name']}} {{$notification->data['data']}}</span>
                                                        
                                                        </h6>
                                                        <p class="text-xs text-secondary mb-0">
                                                            <i class="fa fa-clock me-1"></i>
                                                            {{$notification->created_at->diffForHumans()}}
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>

                                @endforeach
                                @foreach (auth()->user()->readNotifications as $notification)
                                <li class="mb-2">
                                    <a class="dropdown-item border-radius-lg " href="javascript:;">
                                        <div class="d-flex py-1">
                                            {{-- <div class="my-auto">
                                                <!-- Update image path here as well -->
                                                <img src="{{ asset('assets/assets/img/logo.png') }}" class="avatar avatar-sm  me-3 ">
                                            </div> --}} 
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="text-sm font-weight-normal mb-1">
                                                            <span class="font-weight-bold">{{$notification->data['data']}}</span>
                                                            @if(isset($notification->data['message']))
                                                                {{$notification->data['message']}}
                                                            @endif
                                                        </h6>
                                                        <p class="text-xs text-secondary mb-0">
                                                            <i class="fa fa-clock me-1"></i>
                                                            {{$notification->created_at->diffForHumans()}}
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                @endforeach
                            </ul>
                        </li>
                        
                        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line bg-white"></i>
                                    <i class="sidenav-toggler-line bg-white"></i>
                                    <i class="sidenav-toggler-line bg-white"></i>
                                </div>
                            </a>
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
        
        <div>
        
        <button class="btn btn-dark btn-lg font-weight-bold mx-4 mt-4" onclick="goBack()">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
            </svg><i></i> Back    
        </button>
        </div>

        <div class="d-flex justify-content-center py-4 fw-bold lh-lg fst-italic">
            <p>Library Management System</p>
        </div>

    </main>
    
    <script>
        // Function to navigate back to the previous page
        function goBack() {
            window.history.back();
        }
    </script>
    
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
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <script src="{{ url('assets/assets/js/core/popper.min.js') }}"></script> -->
    <script src="{{ url('assets/assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ url('assets/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ url('assets/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ url('assets/assets/js/plugins/chartjs.min.js') }}"></script>
    <script src="{{ url('assets/assets/js/argon-dashboard.min.js') }}"></script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    
    <script src="{{ url('assets/assets/js/custom.js') }}"></script>
    <script src="{{ url('assets/assets/js/instascan.min.js') }}"></script>
    <script src="{{ url('assets/assets/js/vue.min.js') }}"></script>
    <script src="{{ url('assets/assets/js/adapter.min.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Audio element -->
    <audio id="scanSound" src="{{ asset('assets/sounds/beep.mp3') }}" preload="auto"></audio>

</body>
</html>