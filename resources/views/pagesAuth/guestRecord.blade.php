    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ url('assets/assets/img/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" href="{{ url('assets/assets/img/favicon.ico') }}">
        <title>BukNat - LMIS</title>

        @vite('resources/js/app.js')

        <!-- Fonts and icons -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
        <link href="{{ url('assets/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
        <link href="{{ url('assets/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
        
        <!-- CSS Files -->
        <link id="pagestyle" href="{{ url('assets/assets/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </head>

    <body>
    <div class="container position-sticky z-index-sticky top-0">
      <div class="row">

          <!-- Navbar -->
          <nav class="navbar navbar-expand-lg blur border-radius-sm z-index-3 shadow position-absolute mt-2 py-1 start-0 end-0">
            <div class="container-fluid">
            <button class="navbar-toggler shadow-none me-1" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon mt-1">
                  <span class="navbar-toggler-bar bar1"></span>
                  <span class="navbar-toggler-bar bar2"></span>
                  <span class="navbar-toggler-bar bar3"></span>
                </span>
              </button>

                <div class="col">
                  <a class="navbar-brand font-weight-bolder ms-lg-0 text-wrap text-start" href="">
                    Bukidnon National High School Library Management System
                  </a>
                </div>
              <div class="collapse navbar-collapse" id="navigation">
                <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link me-1" href="{{ route('inquireBooks') }}">
                        <i class="fa fa-book opacity-6 text-dark me-1"></i>
                      Catalog
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-1" href="{{ route('loginForm') }}">
                        <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                        Login
                    </a>
                </li>
                  <li class="nav-item">
                    <a class="nav-link me-1" href="#" onclick="openModal()">
                      <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                      Sign Up
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
          <!-- End Navbar -->

      </div>
    </div>
        
        <main class="main-content mt-0">
            <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg"
                style="background-image: url('{{ asset('assets/assets/img/buknat9.jpg') }}'); background-position-y: 60%; background-repeat: no-repeat; background-size: cover;">
                <span class="mask bg-gradient-dark opacity-6"></span>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 text-center mx-auto mt-4">
                        <h1 class="text-white test-justify mb-2">Welcome!</h1>
                        <p class="text-lead text-white">Our library warmly welcomes all guests and visitors. We kindly ask you to register upon arrival and follow our library guidelines to ensure a pleasant and enriching experience for everyone.</p>                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row mt-lg-n10 mt-md-n11 mt-n12 mb-4 justify-content-center">
                    <div class="col-xl-6 col-lg-5 col-md-7 mx-auto">
                        <div class="container d-flex justify-content-center align-items-center min-vh-100">
                            <div class="card shadow-lg" style="width: 100%; max-width: 600px;">
                                <div class="card-body">
                                    <h5 class="text-uppercase text-sm">Guest Attendance</h5>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col">
                                                        @if (session('success'))
                                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                            <p class="text-center text-white">
                                                                {{ session('success') }}
                                                            </p>
                                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">x</button>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <form action="{{ route('formGuest') }}" method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" class="form-control" id="name" name="name" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="school">School/Agency</label>
                                                        <input type="text" class="form-control" id="school" name="school">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="purpose">Purpose</label>
                                                        <input type="text" class="form-control" id="purpose" name="purpose" required>
                                                    </div>
                                                    <div class="row">
                                                        <button type="submit" class="btn btn-success">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    

            <!-- Display Records -->
            <div class="container mt-0 pb-4">
                <div class="card">
                    <div class="card-body">
                        <h5>Recent Logs</h5>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>School</th>
                                        <th>Purpose</th>
                                        <th>Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($guests->take(50) as $guest)
                                    <tr>
                                        <td>{{ $guest->created_at->format('M d, Y h:i A') }}</td>
                                        <td>{{ $guest->name }}</td>
                                        <td>{{ $guest->school }}</td>
                                        <td>{{ $guest->purpose }}</td>
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </body>

    <div id="signupModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Choose User</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" onclick="closeModal()"></button>
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

        // Function to close the modal
        function closeModal() {
            modal.style.display = 'none';
        }

        // Close the modal when user clicks outside of it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
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
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="{{ url('assets/assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ url('assets/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ url('assets/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>

    <!-- Github buttons -->
    {{-- <script async defer src="https://buttons.github.io/buttons.js"></script> --}}
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    
    @vite('resources/js/app.js')
    </html>
    