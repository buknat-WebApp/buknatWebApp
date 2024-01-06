<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        BukNat - LMIS
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ url('assets/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <!-- Recaptcha -->
    {!! htmlScriptTagJsApi() !!}

    <link href="{{ url('assets/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ url('assets/assets/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />
</head>

<body class="">
    <!-- Navbar -->
    <nav
        class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3 navbar-transparent mt-4">
        <div class="container">
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 text-white" href="{{ route('loginForm') }}">
                Login : BukNat - LMIS
            </a>
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
            style="background-image: url('https://media.licdn.com/dms/image/C561BAQGoO3WWkMBcCQ/company-background_10000/0/1632665721223?e=1698660000&v=beta&t=6k32kzNxn8BdFEJuJdO_KjZZLwnUOPEX6V_cVMv5yDQ'); background-position: top;">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 text-center mx-auto">
                        <h1 class="text-white test-justify mb-2 mt-5">Welcome!</h1>
                        <p class="text-lead text-white">Student that will use this registration form still needs to wait
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
                                    <form method="POST" action="{{ route('signup') }}" enctype="multipart/form-data">
                                        @csrf

                                        <div class="mb-3">
                                            <label for="id">Picture of your Student ID</label>
                                            <input type="file" class="form-control @if ($errors->has('id_pic')) is-invalid @endif"
                                                   name="id_pic" id="id_pic" value="{{ old('id_pic') }}">
                                            @if ($errors->has('id_pic'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('id_pic') }}
                                                </div>
                                            @endif
                                            <p class="text-sm font-weight-bold mb-2 text-secondary text-border d-inline z-index-2 bg-white px-3">
                                                and
                                            </p>
                                        </div>


                                            <div class="mb-3">
                                                <input type="text" class="form-control @if ($errors->has('name')) is-invalid @endif" aria-label="name" name="name"
                                                       id="name" placeholder="Firstname M.I Lastname" value="{{ old('name') }}">
                                                @if('name')
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('name') }}
                                                </div>
                                                @endif
                                            </div>

                                            <div class="mb-3">
                                                <input type="number" class="form-control @if('id_number') is-invalid @endif" placeholder="ID Number"
                                                       name="id_number" id="id_number" value="{{ old('id_number') }}">
                                                @if ($errors->has('id_number'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('id_number') }}
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="mb-3">
                                                <label for="cars">Grade Level</label>
                                                <select name="grade_and_section" id="cars" class="form-control">
                                                    <option value="Grade-7">I am Grade 7</option>
                                                    <option value="Grade-8">I am Grade 8</option>
                                                    <option value="Grade-9">I am Grade 9</option>
                                                    <option value="Grade-10">I am Grade 10</option>
                                                    <option value="Grade-11">I am Grade 11</option>
                                                    <option value="Grade-12">I am Grade 12</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="password">Default Pass is: "password"</label>
                                                <input type="text" class="form-control" value="password" name="password" id="password" aria-label="Password"
                                                       disabled>
                                            </div>

                                            <div class="form-check form-check-info text-start">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    I agree to the <a href="javascript:;" class="text-dark font-weight-bolder">Terms and Conditions</a>
                                                </label>
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

                                            <p class="text-sm mt-3 mb-0">Already have an account? <a href="{{ route('loginForm') }}"
                                                                                                     class="text-dark font-weight-bolder">Sign in</a></p>
                                    </form>

                            </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
