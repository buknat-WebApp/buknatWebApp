@extends('layouts.app')

@section('content')
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="row gx-4">

                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ $user->name }}
                        </h5>
                        @if($user->role == 0)
                        <p class="mb-0 font-weight-bold text-sm">
                            Student
                        </p>
                        <p class="mb-0 font-weight-bold text-sm">
                            {{ $user->id_number }} &nbsp; {{ $user->grade_and_section }}
                        </p>
                        @else
                        <p class="mb-0 font-weight-bold text-sm">
                            Teacher
                        </p>
                        <p class="mb-0 font-weight-bold text-sm">
                            {{ $user->id_number }}
                        </p>
                        @endif
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1">
                            <li class="nav-item">
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle w-100 text-center"  type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        Search
                                    </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li><a class="dropdown-item" href="{{ route('borrowingForm') }}">Students</a></li>
                                            <li><a class="dropdown-item" href="{{ route('borrowingFormTeacher') }}">Teachers</a></li>  
                                        </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center"
                                    href="{{ route('borrowerLists') }}">
                                    <i class="ni ni-books"></i>
                                    <span class="ms-2">Check Out</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center"
                                    href="{{ route('returnedBook') }}">
                                    <i class="ni ni-books"></i>
                                    <span class="ms-2">Book Returned</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center btn">
                                    <i class="ni ni-books"></i>
                                    <span class="ms-2">Check In</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('returnBook') }}">
        @csrf
        @method('PUT')

        @foreach ($bookTransactions as $bookTransaction)
            <div class="container-fluid py-2">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-8 d-flex ">
                        <div class="card">
                            <div class="card-header pb-0">
                                <div class="d-flex align-items-center">
                                    <p class="mb-0 text-uppercase">{{ $bookTransaction->book_title }}</p>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-check">
                                            <label class="form-check-label text-danger" for="check1">
                                                Check the box below for books to be returned
                                            </label>
                                            {{-- <input type="text" name="transaction_id" value="{{ $bookTransaction->id }}"> --}}
                                            <input class="form-check-input" name="transactionIDs[]" type="checkbox"
                                                value="{{ $bookTransaction->id }}" id="check1">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Remarks / Note</label>
                                            <input class="form-control" type="text" name="remarks[]" value="Returned">Returned</input>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                       
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Returned Date</label>
                                            <input class="form-control" name="returned_dates[]" value="{{ date('Y-m-d') }}"
                                                type="date">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Returned Book Condition</label>
                                            <select name="returned_book_conditions[]" class="form-control">
                                                <option value="functional">functional</option>
                                                <option value="not-functional">not-functional</option>
                                            </select>
                                        </div>
                                    </div>

                                    @if(!$isTeacher)
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fines">Fines</label>
                                                <input type="number" name="fines[]" class="form-control" value="{{ $bookTransaction->fines }}">
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fines">Fines</label>
                                                <input type="hidden" name="fines[]" value="0" readonly>
                                                <p class="text-info">No Fines for Teachers</p>
                                            </div>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        @endforeach
        <div class="row justify-content-center mt-2">
            <div class=" col-8">
                <button type="submit" class="justify-content-center btn btn-success form-control" name=""
                    id="">Submit</button>
            </div>
        </div>
    </form>

    @if (session('error'))
        <script>
            alert("Please select at least one book.");
        </script>
    @endif
@endsection
