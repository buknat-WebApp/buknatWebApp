@extends('layouts.app')

@section('content')
    <div class="mx-5 mt-4">
        <div class="card-body">
            <div class="row gx-4">

                <div class="col-auto my-auto text-white">
                    <div class="h-100">
                        <h5 class="mb-1">
                            Borrowers Lists
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            In this page librarian see the borrowed books.
                        </p>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1">
                            <div class="dropdown">
                                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    Search
                                </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li><a class="dropdown-item" href="{{ route('borrowingForm') }}">Students</a></li>
                                        <li><a class="dropdown-item" href="{{ route('borrowingFormTeacher') }}">Teachers</a></li>  
                                    </ul>
                            </div>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center btn"
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
                        </ul>
                    </div>
                </div>

                <div class="container-fluid py-4 mt-2">
                    <div class="row">
                        <div class="col-md-12">
                            @if (session('success'))
                                <div class="alert-success alert-dismissible fade show" role="alert">
                                    <p class="text-center text-white">
                                        {{ session('success') }}
                                    </p>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close">x</button>
                                </div>
                            @endif
                                <div class="col-12">
                                    <div class="card mb-4 p-2">
                                        <div class="card-body pb-2">
                                            <div class="table-responsive ">
                                            <table class="table align-items-center mb-0"  id="mytable">
                                                <thead>
                                                    <tr>
                                                        <th
                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Borrower's Name</th>
                                                        <th
                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                            Date Borrowed</th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Due Date</th>
                                                        <th
                                                            class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Title of Book/s Borrowed</th>
                                                            
                                                        <th
                                                            class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                                        <th class="text-secondary opacity-7"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($transactions as $transaction)
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex px-2 py-1">
                                                                    <div class="d-flex flex-column justify-content-center">
                                                                        <h6 class="mb-0 text-sm">

                                                                            {{ $transaction->user->name }}

                                                                        </h6>
                                                                        <p class="text-xs text-secondary mb-0">
                                                                            <strong>ID No.</strong>
                                                                            {{ $transaction->user->id_number }}
                                                                        </p>
                                                                        <p class="text-xs text-secondary mb-0">
                                                                            <strong>Contact No.</strong>
                                                                            {{ $transaction->user->contact_number }}
                                                                        </p>

                                                                    </div>
                                                                </div>
                                                            </td>


                                                            <td>
                                                                <p class="text-xs font-weight-bold mb-2">
                                                                    {{ $transaction->borrowed_at }}</p>
                                                            </td>

                                                            <td class="align-middle text-center text-sm">
                                                                <p class="text-xs font-weight-bold mb-2">
                                                                    {{ $transaction->expected_return_date }}</p>
                                                            </td>

                                                            <td class="text-start">
                                                                
                                                                @foreach ($transaction->bookTransactions as $bookTransaction)
                                                                    @foreach ($books as $book)
                                                                        @if (is_null($bookTransaction->returned_at))
                                                                            @if ($bookTransaction->book_id == $book->id)
                                                                                <p class="text-xs font-weight-bold mb-2">
                                                                                    {{ $book->book_title }} </p>
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                @endforeach

                                                            </td>

                                                            <td class="text-start align-middle">
                                                                @if (now()->greaterThan($transaction->expected_return_date))
                                                                    <span class="badge badge-sm bg-gradient-danger">Overdue</span>
                                                                @else
                                                                    <span class="badge badge-sm bg-gradient-warning">Borrowed</span>
                                                                @endif
                                                            </td>

                                                            <td class="align-middle">
                                                                <a href="{{ route('updateBorrow', ['transaction' => $transaction->id]) }}"
                                                                    class="text-secondary font-weight-bold text-xs btn"
                                                                    ddata-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="Manage Book">
                                                                    <span class="fas fa-edit"> Check In</span>
                                                                </a>

                                                            </td>

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
    </div>

  
    
@endsection
