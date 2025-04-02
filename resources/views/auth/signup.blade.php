<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Library MIS | BukNat | Login</title>
    <!-- core:css -->
    <link rel="stylesheet" href="{{ url('assets/vendors/core/core.css') }}">
    <!-- endinject -->
    <!-- end plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ url('assets/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ url('assets/css/demo_1/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ url('assets/images/favicon.png') }}" />
</head>

<body class="sidebar-dark">
    <div class="main-wrapper">
        <div class="page-wrapper full-page">
            <div class="page-content d-flex align-items-center justify-content-center bg-secondary">

                <div class="row w-100 mx-0 auth-page">
                    <div class="col-md-12 col-xl-10 mx-auto">
                        <div class="card">
                            <div class="row">

                                <div class="col-md-12 pl-md-0">
                                    <div class="auth-form-wrapper px-4 py-5">
                                        <a href=""
                                            class="noble-ui-logo d-block mb-2">BukNat-<span>LMIS</span></a>
                                        <h5 class="text-muted font-weight-normal mb-4">REGISTRATION FORM</h5>

                                        <div class="card-body">

                                            <form action="{{ route('register.user') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div id="wizard">

                                                    <section>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <label for="exampleInputText1">Firstname</label>
                                                                        <input type="text" class="form-control"
                                                                            id="exampleInputText1"
                                                                            placeholder="Firstname" name="firstname">
                                                                    </div>
                                                                    <div class="col">
                                                                        <label
                                                                            for="exampleInputText1">Middlename</label>
                                                                        <input type="text" class="form-control"
                                                                            id="exampleInputText1"
                                                                            placeholder="Middlename" name="middlename">
                                                                    </div>
                                                                    <div class="col">
                                                                        <label for="exampleInputText1">Lastname</label>
                                                                        <input type="text" class="form-control"
                                                                            id="exampleInputText1"
                                                                            placeholder="Lastname" name="lastname">
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="col">
                                                                <p>PLEASE TAKE NOTE!</p>
                                                                <p class="text-muted mt-3">
                                                                    the default pass for the newly created account is "password".
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </section>
                                                    <section>

                                                        <div class="row mt-5">
                                                            <div class="col">
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <label for="exampleInputText1">ID Number</label>
                                                                        <input type="number" class="form-control"
                                                                            id="exampleInputText1" @error('id_number') is-invalid @enderror"  name="id_number">

                                                                            @error('id_number')
                                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                                            @enderror
                                                                    </div>
                                                                    <div class="col">
                                                                        <label for="exampleInputText1">Grade &
                                                                            Section</label>
                                                                        <input type="text" class="form-control"
                                                                            id="exampleInputText1" name="grade_and_section">
                                                                    </div>
                                                                    <div class="col">
                                                                        <label for="exampleInputText1">Office or
                                                                            Department</label>
                                                                        <input type="text" class="form-control"
                                                                            id="exampleInputText1" name="office_or_department">
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="col">
                                                                <div class="row">

                                                                    <label for="exampleInputText1">Upload ID for
                                                                        Validation</label>
                                                                    <input type="file" class="form-control"
                                                                        name="id_pic">
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </section>


                                                    <div class="mt-5">
                                                        <button type="submit" class="form-control btn btn-primary"
                                                            id="exampleInputText1"> REGISTER </button>
                                                    </div>
                                                    <div class="mt-3">
                                                        <a href="/" class="form-control btn btn-secondary"
                                                            id="exampleInputText1"> CANCEL </a>
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

        </div>
    </div>
    </div>


    <!-- core:js -->
    <script src="{{ url('assets/vendors/core/core.js') }}"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <!-- end plugin js for this page -->
    <script src="{{ url('assets/vendors/jquery-steps/jquery.steps.min.js') }}"></script>

    <!-- inject:js -->
    <script src="{{ url('assets/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ url('assets/js/template.js') }}"></script>
    <!-- endinject -->
    <!-- custom js for this page -->
    <!-- end custom js for this page -->
</body>

</html>
