@extends('layouts.app')

@section('content')
    <div class="mx-5 mt-4">
        <div class="card-body">
            <div class="row gx-4">

                <div class="col-auto my-auto text-white">
                    <div class="h-100">
                        <h5 class="mb-1">
                            Returned Book Lists
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            In this page librarian see the returned books.
                        </p>
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
                                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center btn"
                                    href="{{ route('returnedBook') }}">
                                    <i class="ni ni-books"></i>
                                    <span class="ms-2">Book Returned</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="container-fluid py-4 mt-2   ">
                    <div class="row">
                        <div class="col-md-12">
                            @if (session('successApprove'))
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
                                            <table class="table align-items-center mb-0" id="mytable">
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
                                                            Return Date</th>
                                                        <th
                                                            class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Title of Books/s Borrowed </th>
                                                        <th
                                                            class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Status</th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Returned Condition</th>
                                                        <th
                                                            class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Remarks</th>
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
                                                                        @if($transaction->user->role == 0)
                                                                        <p class="text-xs text-secondary mb-0">
                                                                            <strong>Student</strong>
                                                                        </p>
                                                                        <p class="text-xs text-secondary mb-0">
                                                                            <strong>LRN No.</strong>
                                                                            {{ $transaction->user->id_number }}
                                                                        </p>
                                                                        @else
                                                                        <p class="text-xs text-secondary mb-0">
                                                                            <strong>Teacher</strong>
                                                                        </p>
                                                                        <p class="text-xs text-secondary mb-0">
                                                                            <strong>ID No.</strong>
                                                                            {{ $transaction->user->id_number }}
                                                                        </p>
                                                                        @endif

                                                                    </div>
                                                                </div>
                                                            </td>


                                                            <td>
                                                                <p class="text-xs font-weight-bold mb-2">
                                                                    {{ \Carbon\Carbon::parse($transaction->borrowed_at)->format('M d, Y h:i A') }}</p>
                                                            </td>

                                                            <td class="align-middle text-center text-sm">
                                                                @foreach ($transaction->bookTransactions as $bookTransaction)
                                                                    <p class="text-xs font-weight-bold mb-2">
                                                                        {{ \Carbon\Carbon::parse($bookTransaction->returned_at)->format('M d, Y h:i A') }}</p>
                                                                @endforeach
                                                            </td>

                                                            <td class="text-start">
                                                                <?php $count = 1; ?>
                                                                @foreach ($transaction->bookTransactions as $bookTransaction)
                                                                    @foreach ($books as $book)
                                                                        @if ($bookTransaction->returned_at)
                                                                            @if ($bookTransaction->book_id == $book->id)
                                                                                <p class="text-xs font-weight-bold mb-2">
                                                                                    {{ $book->book_title }} </p>
                                                                                    <p class="text-xs mb-2">
                                                                                        {{ $book->author->author }} </p>
                                                                                    {{-- <p class="text-xs text-secondary mb-0">
                                                                                    <strong>Author:</strong> {{ $bookTransaction->book->author->author ?? ' No Author' }}
                                                                                </p>
                                                                                <p class="text-xs text-secondary mb-0">
                                                                                    <strong>Accession No.:</strong> {{ $bookTransaction->book->accession ?? ' No Accession Number'}}
                                                                                </p> --}}
                                                                                <?php $count++; ?>
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                @endforeach

                                                            </td>

                                                            <td>
                                                                @if ($bookTransaction->returned_at <= $transaction->expected_return_date)
                                                                    <span class="badge badge-sm bg-gradient-success">On Time</span>
                                                                @else
                                                                    <span class="badge badge-sm bg-gradient-danger">Overdue</span>
                                                                @endif
                                                            </td>

                                                            <td>
                                                                @foreach ($transaction->bookTransactions as $bookTransaction)
                                                                    @if ($bookTransaction->returned_at)
                                                                        <p class="text-center text-xs font-weight-bold mb-2">
                                                                            {{ $bookTransaction->return_book_condition }}
                                                                        </p>
                                                                    @endif
                                                                @endforeach
                                                            </td>

                                                            <td>
                                                                @php
                                                                    $counter=1
                                                                @endphp
                                                                @foreach ($transaction->bookTransactions as $bookTransaction)
                                                                    @if ($bookTransaction->returned_at)
                                                                        <p class="text-start text-xs font-weight-bold mb-2">
                                                                             &nbsp; {{ $bookTransaction->remarks }}
                                                                        </p>
                                                                        @php $counter++ @endphp
                                                                    @endif
                                                                @endforeach

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
    </div>
@endsection
