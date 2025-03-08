@extends('layouts.app')

@section('content')
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                          Update Student Records
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                           This section has the option to update the Grade level of students base on the record.
                        </p>
                    </div>
                </div>
                

                <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1">

                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center btn" @disabled(true)>
                                    <i class="ni ni-folder-17"></i>
                                    <span class="ms-2">Student Records</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>

                    <div class="container-fluid py-4 mt-2">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                        <form method="POST" action="{{ route('updateStudentsRecord') }}">
                                        @csrf

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label for="gender-select">Current Grade Level:</label>
                                                        <select class="form-select form-control" id="grade_levelA" name="grade_levelA" onchange="toggleGradeLevelB()">
                                                            <option value="Grade 7" selected>Grade 7</option>
                                                            <option value="Grade 8" selected>Grade 8</option>
                                                            <option value="Grade 9" selected>Grade 9</option>
                                                            <option value="Grade 10" selected>Grade 10</option>
                                                            <option value="Grade 11" selected>Grade 11</option>
                                                            <option value="Grade 12" selected>Grade 12</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="gender-select">Grade Level Update:</label>
                                                    <select class="form-select form-control" id="grade_levelB" name="grade_levelB" disabled>
                                                        <option value="Grade 7" selected>Grade 7</option>
                                                        <option value="Grade 8" selected>Grade 8</option>
                                                        <option value="Grade 9" selected>Grade 9</option>
                                                        <option value="Grade 10" selected>Grade 10</option>
                                                        <option value="Grade 11" selected>Grade 11</option>
                                                        <option value="Grade 12" selected>Grade 12</option>
                                                    </select>
                                                </div>
                                            </div>
                                                <div class="d-flex justify-content-between">
                                                    <button type="submit" class="btn btn-primary form-control" onclick="return confirm('Are you sure you want to update grade level?')">Update Grade Level</button>
                                                </div>
                                                
                                            </form>
                                                <form action="{{ route('deleteGrade12Students') }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="d-flex justify-content-between">
                                                        <button type="submit" class="btn btn-danger form-control" onclick="return confirm('Are you sure you want to mark all Grade 12 students as graduated? This action cannot be undone.')">
                                                            Mark Grade 12 Students as Graduated
                                                        </button>
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

    <script>
        function toggleGradeLevelB() {
            var gradeLevelA = document.getElementById('grade_levelA');
            var gradeLevelB = document.getElementById('grade_levelB');

            // Enable or disable Grade Level to be Promoted based on the selected Grade Level
            gradeLevelB.disabled = (gradeLevelA.value === 'Grade 12');
        }
    </script>

@endsection
