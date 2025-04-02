@extends('layouts.app')

@section('content')
<div class="card shadow-lg mx-4 card-profile-bottom">
    <div class="card-body p-3">
        <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                        <div class="nav-wrapper position-relative end-0">
                            <ul class="nav nav-pills nav-fill p-1">
                                <li class="nav-item">
                                    <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center btn"
                                        href="/Librarian/transaction/logs">
                                        <i class="fas fa-user"></i>
                                        <span class="ms-2">Students/Teachers Attendance</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
            <div class="row gx-4">
        <div class="row gx-4">
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        Attendance Log
                    </h5>
                    <p class="mb-0 font-weight-bold text-sm">
                        In this page, the librarian can input the guest's name, school, and purpose of visit. The librarian can also view the recent logs of the guest's attendance.
                    </p>
                </div>
            </div>
            <div class="container-fluid py-4 mt-2">
                <div class="row">
                    <!-- Guest Attendance Form -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <p class="text-uppercase text-sm">Guest Attendance</p>
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
                                            <form action="{{ route('recordGuests') }}" method="POST">
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

                    <!-- Display Records -->
                    <div class="col-md-6">
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
                                             @foreach($guests->take(15) as $guest)
                            <tr>
                                <td>{{ $guest->name }}</td>
                                <td>{{ $guest->school }}</td>
                                <td>{{ $guest->purpose }}</td>
                                <td>{{ $guest->created_at->format('M d, Y h:i A') }}</td>
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
        </div>
    </div>
</div>
@endsection
