<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ url('assets/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ url('assets/assets/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />
</head>

<body class="">
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <!-- Navbar -->
                <nav
                    class="navbar navbar-expand-lg blur border-radius-lg top-0 z-index-3 shadow position-absolute mt-4 py-2 start-0 end-0 mx-4 text-center">
                    <div class="container-fluid">
                        <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 text-wrap " href="">
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
                                <a class="nav-link me-2" href="{{ route('loginForm') }}">
                                  <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                                  Login
                                </a>
                              </li>

                            <li class="nav-item">
                              <a class="nav-link me-2" href="{{ route('signupForm') }}">
                                <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                                Signup
                              </a>
                            </li>
                          </ul>
                          <ul class="navbar-nav d-lg-block d-none">
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
       {{-- <div class="page-header min-vh-100" style="background-image: url('{{ asset('assets/assets/img/catalog.jpg') }}'); background-position-y: 50%"> --}}
            <div class="page-header min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1481627834876-b7833e8f5570?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8bGlicmFyeXxlbnwwfHwwfHx8MA%3D%3D&w=1000&q=80'); background-position-y: 50%">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="card" style="background-color: #b1ccd7">
                                <div class="card-header pb-0 text-start" style="background-color: #b1ccd7">
                                    <h4 class="font-weight-bolder">LIBRARY SEARCH CATALOG</h4>
                                    <p class="mb-0">Input the Book Title to begin Search <br><em
                                            class="text-sm text-success">Authors and Sections are also searchable</em>
                                    </p>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <input class="form-control form-control-lg" type="text" id="searchInput"
                                            placeholder="Search">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-7 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0  flex-column mt-6 text-wrap">
                            <div
                                class="position-relative h-100 m-3 px-7 border-radius-lg d-flex flex-column overflow-hidden" style="background-color: #1F2833;">

                                <table id="bookTable">
                                    <thead>
                                        <tr>
                                            <th style="color: white; padding: 20px;">Book Title</th>
                                            <th style="color: white; padding: 20px;">Author</th>
                                            <th style="color: white; padding: 20px;">Edition</th>
                                            <th style="color: white; padding: 20px;">Location</th>
                                            <!-- <th style="color: white; padding: 20px;">Section</th> -->
                                            <th style="color: white; padding: 20px; ">Number of Copies</th>
                                            <th style="color: white; padding: 20px;">Available Copies</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($books as $book)
                                        <tr>
                                            <td style="color: white; padding: 20px;">{{ $book->book_title }}</td>
                                            <td style="color: white; padding: 20px;">{{ $book->author ? $book->author->author : 'No Author' }}</td>
                                            <td style="color: white; padding: 20px;">{{ $book->edition }}</td>
                                            <td style="color: white; padding: 20px;">{{ $book->location ? $book->location->name : 'No Location' }}</td>
                                            <!-- <td style="color: white; padding: 20px;">{{ $book->section_id }}</td> -->
                                            <td class="text-center" style="color: white; padding: 20px;">{{ $book->no_of_copies }}</td>
                                            @if ($book->available_copies >= 1)
                                                                        <td class="text-center" style="color: white;">{{ $book->available_copies }}</td>
                                                                    @else
                                                                        <td class="badge badge-sm bg-gradient-danger">Not-Available</td>
                                                                    @endif
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            </div>
        </section>
    </main>

    <script>
        // document.addEventListener('DOMContentLoaded', function() {
        //     const searchInput = document.getElementById('searchInput');
        //     const bookTable = document.getElementById('bookTable');
        //     const tableRows = bookTable.getElementsByTagName('tr');

        //     searchInput.addEventListener('input', function() {
        //         const searchTerm = searchInput.value.toLowerCase();

        //         for (let i = 1; i < tableRows.length; i++) {
        //             const row = tableRows[i];
        //             const rowData = row.textContent.toLowerCase();

        //             if (rowData.includes(searchTerm)) {
        //                 row.style.display = '';
        //             } else {
        //                 row.style.display = 'none';
        //             }
        //         }
        //     });
        // });
        document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const bookTable = document.getElementById('bookTable');
    const tableRows = bookTable.getElementsByTagName('tr');

    // Hide the table initially
    bookTable.style.display = 'none';

    searchInput.addEventListener('input', function() {
        const searchTerm = searchInput.value.toLowerCase();

        if (searchTerm.trim() === '') {
            // If the input is empty, hide the table
            bookTable.style.display = 'none';
        } else {
            // If input is not empty, show the table and filter rows
            bookTable.style.display = '';
            for (let i = 1; i < tableRows.length; i++) {
                const row = tableRows[i];
                const rowData = row.textContent.toLowerCase();

                if (rowData.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        }
    });
});

    </script>

    <!--   Core JS Files   -->
    <script src="{{ url('assets/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ url('assets/assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ url('assets/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            // Only initialize if the element exists
            const scrollbarElement = document.querySelector('#sidenav-scrollbar');
            if (scrollbarElement) {
                Scrollbar.init(scrollbarElement, options);
            }
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
</body>

</html>
