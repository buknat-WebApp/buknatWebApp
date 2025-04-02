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

    @vite('resources/js/app.js')

    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ url('assets/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/assets/css/nucleo-svg.css') }}" rel="stylesheet" />

    <!-- Recaptcha -->
    {!! htmlScriptTagJsApi() !!}
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ url('assets/assets/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
</head>

<body class="">
    <!-- Navbar -->
    <nav
        class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3 navbar-transparent mt-4">
        <div class="container">
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
                data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon mt-2">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </span>
            </button>
            <div class="collapse navbar-collapse" id="navigation">


            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <main class="main-content  mt-0">
        <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg"
            style="background-image: url('{{ asset('assets/assets/img/buknat9.jpg') }}'); background-position-y: 60%; background-repeat: no-repeat; background-size: cover;">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 text-center mx-auto">
                        <h1 class="text-white test-justify mb-2 mt-5">Welcome!</h1>
                        <p class="text-lead text-white">Teacher that will use this registration form still needs to wait
                            for the validation of the librarian before the account being created will be used.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10 mb-4 justify-content-center">
                <div class="col-xl-6 col-lg-5 col-md-7 mx-auto">
                    <div class="card z-index-0">
                        <div class="card-header text-center pt-4">
                            <h5>Register with your ID</h5>
                        </div>
                        <div class="row px-xl-5 px-sm-4 px-3">
                            <div class="col-3 ms-auto px-1">

                            </div>
                            <div class="col-3 px-1">

                            </div>
                            <div class="col-3 me-auto px-1">

                            </div>
                            <div class="mt-2 position-relative text-center">
                                @if (session('success'))
                                    <div class="alert-success alert-dismissible fade show" role="alert">

                                        <p class="text-white">
                                            {{ session('success') }}
                                        </p>

                                    </div>
                                @endif
                                    <form method="POST" action="{{ route('signup_teacher') }}" enctype="multipart/form-data">
                                        @csrf

                                        <div class="mb-3">
                                            <label for="id">Picture of your ID</label>
                                            <input type="file" class="form-control @if ($errors->has('avatar')) is-invalid @endif"
                                                   name="avatar" id="avatar" value="{{ old('avatar') }}">
                                            @if ($errors->has('avatar'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('avatar') }}
                                                </div>
                                            @endif
                                           
                                        </div>


                                            <div class="mb-3">
                                            <label class="text-md-left d-block text-left" style="text-align: left;">Full Name</label>
                                                <input type="text" class="form-control @if ($errors->has('name')) is-invalid @endif" aria-label="name" name="name"
                                                       id="name" placeholder="Firstname M.I Lastname" value="{{ old('name') }}">
                                                @if('name')
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('name') }}
                                                </div>
                                                @endif
                                            </div>

                                            <div class="mb-3">
                                            <label class="text-md-left d-block text-left" style="text-align: left;">ID Number</label>
                                                <input type="number" class="form-control @if($errors->has('id_number')) is-invalid @endif" placeholder="Input Your ID Number"
                                                       name="id_number" id="id_number" value="{{ old('id_number') }}">
                                                @if ($errors->has('id_number'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('id_number') }}
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="mb-3">
                                                <label for="cars" class="text-md-left d-block text-left" style="text-align: left;">Grade Level</label>
                                                <select name="office_or_department" id="cars" class="form-control">
                                                    <option value="Teacher" {{ old('office_or_department') == 'Teacher' ? 'selected' : '' }}>Teacher</option>
                                                </select>
                                                <input type="number" value="1" hidden>

                                                <div class="mb-3">
                                            <label class="text-md-left d-block text-left" style="text-align: left;">Contact Number</label>
                                                <input type="number" class="form-control @if ($errors->has('contact_number')) is-invalid @endif" aria-label="contact_number" name="contact_number"
                                                       id="contact_number" placeholder="Input Your Phone Number" value="{{ old('contact_number') }}">
                                                @if('contact_number')
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('contact_number') }}
                                                </div>
                                                @endif
                                            </div>

                                            <div class="mb-3">
                                            <label class="text-md-left d-block text-left" style="text-align: left;">Birth Date</label>
                                                <input type="date" class="form-control @if ($errors->has('birthdate')) is-invalid @endif" aria-label="birthdate" name="birthdate"
                                                       id="birthdate" value="{{ old('birthdate') }}">
                                                @if('birthdate')
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('birthdate') }}
                                                </div>
                                                @endif
                                            </div>

                                            <div class="mb-3">
                                            <label class="text-md-left d-block text-left" style="text-align: left;">Email</label>
                                                <input type="email" class="form-control @if ($errors->has('email')) is-invalid @endif" aria-label="email" name="email"
                                                       id="email" placeholder="Input Your Email" value="{{ old('email') }}">
                                                @if('email')
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('email') }}
                                                </div>
                                                @endif
                                            </div>

                                            <div class="mb-3">
                                            <label class="text-md-left d-block text-left" style="text-align: left;">Address</label>
                                                <input type="text" class="form-control @if ($errors->has('address')) is-invalid @endif" aria-label="address" name="address"
                                                       id="address" placeholder="Enter Your Address" value="{{ old('address') }}">
                                                @if('address')
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('address') }}
                                                </div>
                                                @endif
                                            </div>

                                            <div class="mb-3">
                                                <label for="password">Default Pass is: "password"</label>
                                                <input type="text" class="form-control" value="password" name="password" id="password" aria-label="Password"
                                                       disabled>
                                            </div>

                                            <div class="form-check form-check-info text-start">
                                                <input class="form-check-input @if('terms') is-invalid @endif" type="checkbox" name="terms" id="terms"
                                                       value="1" {{ old('terms') ? 'checked' : '' }}>
                                                <label class="form-check-label text-dark" for="flexCheckDefault">
                                                    I agree to the <a href="#termsModal" data-bs-toggle="modal" class="text-dark font-weight-bolder text-decoration-underline">Terms and Conditions</a>
                                                </label>
                                                @if ($errors->has('terms'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('terms') }}
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="d-flex justify-content-center py-2">
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
                                                <button type="submit" class="btn bg-gradient-primary w-100">Register</button>
                                                <a href="/" class="btn bg-gradient-dark w-100 mb-2">Back</a>
                                            </div>

                                            <p class="text-sm mt-3 mb-0">Already have an account? <a href="{{ route('loginForm') }}" class="text-dark font-weight-bolder">Sign in</a></p>
                                    </form>
                            </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="termsModal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Terms and Conditions - School Library System</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                            <div class="mb-4">
                                <h4>1. Library Membership</h4>
                                <p>
                                    <strong>1.1. Eligibility:</strong> The library services are available to all registered students, faculty, and staff of [School Name].
                                </p>
                                <p>
                                    <strong>1.2. Library Card:</strong> To borrow materials, users must present a valid school identification card, which serves as the library card.
                                </p>
                            </div>

                            <div class="mb-4">
                                <h4>2. Borrowing and Returning</h4>
                                <p>
                                    <strong>2.1. Loan Period:</strong> The standard loan period for books is [X] days, and for other materials, it may vary. Users are responsible for returning items on or before the due date.
                                </p>
                                <p>
                                    <strong>2.2. Renewal:</strong> Borrowed items may be renewed unless there is a hold on the material or it has reached the maximum renewal limit.
                                </p>
                                <p>
                                    <strong>2.3. Overdue Items:</strong> Users are responsible for returning items on time. Overdue fines may be imposed for late returns.
                                </p>
                                <p>
                                    <strong>2.4. Lost or Damaged Items:</strong> Users are responsible for the replacement cost of lost or damaged materials. A processing fee may also apply.
                                </p>
                            </div>

                            <div class="mb-4">
                                <h4>3. Conduct and Responsibilities</h4>
                                <p>
                                    <strong>3.1. Respectful Behavior:</strong> Users must maintain a quiet and respectful environment within the library. Disruptive behavior may result in suspension of library privileges.
                                </p>
                                <p>
                                    <strong>3.2. Computer Use:</strong> Library computers are to be used for educational purposes. Users must comply with the school's acceptable use policy.
                                </p>
                                <p>
                                    <strong>3.3. Personal Belongings:</strong> The library is not responsible for the loss or theft of personal belongings. Users are advised to keep their belongings secure.
                                </p>
                            </div>

                            <div class="mb-4">
                                <h4>4. Privacy and Data Security</h4>
                                <p>
                                    <strong>4.1. Confidentiality:</strong> The library respects the privacy of users. Personal information collected is used solely for library services and is kept confidential.
                                </p>
                                <p>
                                    <strong>4.2. Data Security:</strong> Users are advised to log out of library accounts and computers to ensure the security of their personal information.
                                </p>
                            </div>

                            <div class="mb-4">
                                <h4>5. Library Programs and Events</h4>
                                <p>
                                    <strong>5.1. Participation:</strong> Users are encouraged to participate in library programs, events, and workshops to enhance their educational experience.
                                </p>
                                <p>
                                    <strong>5.2. Registration:</strong> Some programs may require pre-registration. Details will be communicated in advance.
                                </p>
                            </div>

                            <div class="mb-4">
                                <h4>6. Policy Changes</h4>
                                <p>
                                    <strong>6.1. Updates:</strong> The library reserves the right to update or modify these terms and conditions. Users will be notified of any changes.
                                </p>
                            </div>

                            <p>By using the School Library System, you acknowledge and agree to these terms and conditions. Violation of these terms may result in the suspension of library privileges.</p>

                            <p class="mb-5">For any questions or concerns, please contact the library staff.</p>

                            <p class="text-center">Thank you for your cooperation!</p>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="{{ url('assets/assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ url('assets/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ url('assets/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>

    <!-- Github buttons -->
    {{-- <script async defer src="https://buttons.github.io/buttons.js"></script> --}}
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    
    @vite('resources/js/app.js')
</body>

</html>


