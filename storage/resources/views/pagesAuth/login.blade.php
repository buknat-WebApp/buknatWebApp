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
    <link rel="icon" type="image/png" href="{{ url('assets/assets/img/favicon.ico') }}">
    <title>
        BukNat - LMIS
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ url('assets/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Recaptcha -->
   {!! htmlScriptTagJsApi([
        'action' => 'login',
        'callback_then' => 'onRecaptchaSuccess',
        'callback_catch' => 'onRecaptchaError'
    ]) !!}
    <link href="{{ url('assets/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ url('assets/assets/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />
</head>

<body class="">
    <div class="container position-sticky z-index-sticky top-0">
      <div class="row">
        <div class="col-12">
          <!-- Navbar -->
          <nav class="navbar navbar-expand-lg blur border-radius-lg top-0 z-index-3 shadow position-absolute mt-4 py-2 start-0 end-0 mx-4">
            <div class="container-fluid">
              <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 text-wrap" href="">
                Bukidnon National High School Library Management System
              </a>
              <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon mt-2">
                  <span class="navbar-toggler-bar bar1"></span>
                  <span class="navbar-toggler-bar bar2"></span>
                  <span class="navbar-toggler-bar bar3"></span>
                </span>
              </button>
              <div class="collapse navbar-collapse" id="navigation">
                <ul class="navbar-nav mx-auto">

                  <li class="nav-item">
                    <a class="nav-link me-2" href="{{ route('inquireBooks') }}">
                      <i class="fa fa-book opacity-6 text-dark me-1"></i>
                      Catalog
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link me-2" href="#" onclick="openModal()">
                      <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                      Sign Up
                    </a>
                  </li>
                </ul>
                <ul class="navbar-nav d-lg-block d-none">
                  {{-- <li class="nav-item">
                    <a href="https://www.creative-tim.com/product/argon-dashboard" class="btn btn-sm mb-0 me-1 btn-primary">Free Download</a>
                  </li> --}}
                </ul>
              </div>
            </div>
          </nav>
          <!-- End Navbar -->
        </div>
      </div>
    </div>
    <main class="main-content  mt-0">
      <section>
        <div class="page-header min-vh-100">
          <div class="container">
            <div class="row">
              <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                <div class="card card-plain">
                  <div class="card-header pb-0 text-start">
                    <h4 class="font-weight-bolder">Sign In</h4>
                    <p class="mb-0">Enter your LRN/ID Number and password to sign in</p>
                  </div>
                  <div class="card-body">
                    <form role="form" method="POST" action="{{ route('login') }}">
                        @csrf
                      <div class="mb-3">
                        <input type="number" class="form-control @if ($errors->has('id_number')) is-invalid @endif" placeholder="LRN Number/ID Number" name="id_number" id="id_number" value="{{ old('id_number') }}">
                        @if ($errors->has('id_number'))
                            <div class="invalid-feedback">
                                {{ $errors->first('id_number') }}
                            </div>
                        @endif
                      </div>
                      <div class="mb-3">
                        <input type="password" class="form-control @if ($errors->has('password')) is-invalid @endif" placeholder="Password" name="password" id="password" value="{{ old('password') }}">
                        @if ($errors->has('password'))
                            <div class=" invalid-feedback ">
                                {{ $errors->first('password') }}
                            </div>
                          @endif
                      </div>
                     <div class="mb-3">
                            {!! htmlFormSnippet() !!}
                            @if($errors->has('g-recaptcha-response'))
                                <div>
                                    <small class="text-danger">
                                        {{ $errors->first('g-recaptcha-response') }}
                                    </small>
                                </div>
                            @endif
                        </div>
                      <div class="text-center">
                        <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Sign in</button>
                      </div>
                    </form>
                  </div>
                  <div class="card-footer text-center pt-0 px-lg-2 px-1">
                    <p class="mb-4 text-sm mx-auto">
                      Don't have an account?
                      <a href="#" onclick="openModal()" class="text-primary text-gradient font-weight-bold">Sign up</a>
                    </p>
                  </div>
                  
                </div>
              </div>

            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signin-ill.jpg');
            background-size: cover;">
                  <span class="mask bg-gradient-primary opacity-6"></span>
                  <h4 class="mt-5 text-white font-weight-bolder position-relative text-justify">"The more that you read, the more things you will know. The more you learn, the more places you'll go. <br>-Dr. Seuss, "I Can Read With My Eyes Shut!""</h4>
                  <hr>
                  <p class="text-white position-relative">Dr. Seuss is probably best known for his books to help children learn to read, such as One Fish Two Fish Red Fish Blue Fish, Green Eggs and Ham, and Hop on Pop, his cautionary tales including The Lorax, and the inspirational Oh, the Places You'll Go!.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

    <div id="signupModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Choose User</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                      <div class="modal-body" style="text-align:center;">
                        <p class="text-center">
                            Are you a Student or Teacher?
                        </p>
                          <a href="{{ route('signupForm') }}" role="button" class="btn btn-primary btn-lg">Student</a>
                          <a href="{{ route('signupForms') }}" role="button" class="btn btn-secondary btn-lg">Teacher</a>
                      </div>
                    </div>
                </div>

    <script>
    // Get the modal
    var modal = document.getElementById('signupModal');

    // Function to open the modal
    function openModal() {
        modal.style.display = 'block';
    }

    // Close the modal when user clicks outside of it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
</script>

       <!--   Core JS Files   -->
    <!-- Add PerfectScrollbar JS before other scripts -->
    <script src="{{ url('assets/assets/js/core/bootstrap.min.js') }}"></script>
  
    <script src="{{ url('assets/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        var sidenavScrollbar = document.querySelector('#sidenav-scrollbar');
        if (win && sidenavScrollbar) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(sidenavScrollbar, options);
        }
    </script>
      <!-- Github buttons -->
      <script async defer src="https://buttons.github.io/buttons.js"></script>
      <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    </body>
</html>
                  
