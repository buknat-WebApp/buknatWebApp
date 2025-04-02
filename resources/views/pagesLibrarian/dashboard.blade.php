@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <a href="{{ route('bookLists') }}" class="text-decoration-none text-black">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Books</p>
                                        <h5 class="font-weight-bolder">
                                            {{ $noOfBooks }}
                                        </h5>
                            </a>

                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                            <a href="{{ route('bookLists') }}"> <i class="ni ni-books text-lg opacity-10"
                                    aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <a href="{{ route('accountPending') }}" class="text-decoration-none text-black">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Available Books</p>
                                <h5 class="font-weight-bolder">
                                    {{ $noOfAvailable }}
                                </h5>
                    </a>

                </div>
            </div>
            <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                    <a href="{{ route('accountPending') }}"> <i class="ni ni-paper-diploma text-lg opacity-10"
                            aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <a href="{{ route('accountLists') }}" class="text-decoration-none text-black">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Number Of Students</p>
                                <h5 class="font-weight-bolder">
                                    {{ $noOfStudents }}
                                </h5>
                    </a>

                </div>
            </div>
            <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                    <a href="{{ route('accountLists') }}" > <i class="ni ni-circle-08 text-lg opacity-10"
                            aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    
    <div class="col-xl-3 col-sm-6">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                <a href="{{ route('borrowerLists') }}" class="text-decoration-none text-black">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Unreturned Books</p>
                            <h5 class="font-weight-bolder">
                                {{ $unreturnedBooks }}
                            </h5>

                        </div>
</a>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                             <a href="{{ route('borrowerLists') }}">
                                <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                        </div> </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-8 mb-lg-0 mb-4">
            <div class="col-lg-12 d-flex justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="100">
                <ul class="nav nav-pills my-4 fs-6 light-bg" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-left active" id="pills-education-tab" data-bs-toggle="pill" data-bs-target="#pills-education" type="button" role="tab" aria-controls="pills-education" aria-selected="true">Overdue</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-right" id="pills-work-tab" data-bs-toggle="pill" data-bs-target="#pills-work" type="button" role="tab" aria-controls="pills-work" aria-selected="false">Unreturned</button>
                    </li>
                </ul>
            </div>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-education" role="tabpanel" aria-labelledby="pills-education-tab">
                    <div class="card ">
                        <div class="card-header pb-0 p-3">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-2">Overdue Books</h6>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center ">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Borrower's Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Date Borrowed</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Due Date</th>
                                    <th class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Borrowed Book/s</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Accession Number</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $today = date('Y-m-d');
                                    $dueCounter = 0; $newAccountCounter =0;
                                @endphp
                                @if ($overdueTransactions)
                                    @foreach ($overdueTransactions->take(25) as $overdueTransaction)
                                        @if ($overdueTransaction->expected_return_date !== null && $overdueTransaction->expected_return_date < $today)
                                            @php
                                                $dueCounter++;
                                            @endphp
                                            <tr>
                                                <td class="text-center">
                                                    <a href="{{ route('updateBorrow', ['transaction' => $overdueTransaction->id]) }}"
                                                        ddata-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Update Borrow">
                                                        <span class="fas fa-edit fa-lg"></span>
                                                    </a>

                                                </td>

                                                <td>

                                                    <div class="d-flex px-2 py-1 text-primary">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm text-capitalize">
                                                                {{ $overdueTransaction->user->name }}
                                                            </h6>
                                                            @if ($overdueTransaction->user->role == 0)
                                                                 <p class="text-xs text-secondary mb-0">
                                                                    <strong>Student</strong></p>
                                                                <p class="text-xs text-secondary mb-0">
                                                                    <strong>LRN No. :</strong>
                                                                    &nbsp;{{ $overdueTransaction->user->id_number }}</p>
                                                            @else
                                                                 <p class="text-xs text-secondary mb-0">
                                                                    <strong>Teacher</strong></p>
                                                                <p class="text-xs text-secondary mb-0">
                                                                    <strong>ID No. :</strong>
                                                                    &nbsp;{{ $overdueTransaction->user->id_number }}</p>
                                                            @endif
                                                            <p class="text-xs text-secondary mb-0">
                                                                <strong>Contact No. :</strong>
                                                                &nbsp;{{ $overdueTransaction->user->contact_number }}</p>
                                                            <p class="text-xs text-secondary mb-0">
                                                                <strong>Email:</strong>
                                                                &nbsp;{{ $overdueTransaction->user->email }}</p>
                                                        </div>
                                                    </div>

                                                </td>

                                                <td>
                                                    <p class="text-xs font-weight-bold mb-2">
                                                        {{ $overdueTransaction->borrowed_at }}</p>
                                                </td>

                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs font-weight-bold mb-2">
                                                        {{ $overdueTransaction->expected_return_date }}</p>
                                                </td>

                                                <td class="text-start">
                                                    @foreach ($overdueTransaction->bookTransactions as $bookTransaction)
                                                        @foreach ($books as $book)
                                                            @if (is_null($bookTransaction->returned_at))
                                                                @if ($bookTransaction->book_id == $book->id)
                                                                    <p class="text-xs font-weight-bold mb-2">
                                                                        {{ $book->book_title }} </p>
                                                                    <p class="text-xs text-secondary mb-0"></p>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                </td>

                                                <td class="align-middle text-start">
                                                    @foreach ($overdueTransaction->bookTransactions as $bookTransaction)
                                                        @if (is_null($bookTransaction->returned_at))
                                                            <p class="text-center text-xs font-weight-bold mb-2">{{ $bookTransaction->books->accession ?? '' }}</p>
                                                        @endif
                                                    @endforeach
                                                </td>


                                            </tr>

                                        @endif
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                            @if ($dueCounter == 0)
                                <div class="alert text-center alert-success text-white" role="alert">
                                    No overdue books!.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-work" role="tabpanel" aria-labelledby="pills-work-tab">
                    <div class="card ">
                        <div class="card-header pb-0 p-3">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-2">Unreturned Books</h6>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center ">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Borrower's Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Date Borrowed</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Due Date</th>
                                    <th class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Borrowed Book/s</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Accession Number</th>                                
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $today = date('Y-m-d');
                                    $dueCounter = 0; $newAccountCounter =0;
                                @endphp
                                @if ($transactions)
                                    @foreach ($transactions->take(25) as $transaction)
                                        @if ($transaction->expected_return_date !== null)
                                            @php
                                                $dueCounter++;
                                            @endphp
                                            <tr>

                                                <td class="text-center">
                                                    <a href="{{ route('updateBorrow', ['transaction' => $transaction->id]) }}"
                                                       ddata-bs-toggle="tooltip" data-bs-placement="top"
                                                       title="Update Borrow">
                                                        <span class="fas fa-edit fa-lg"></span>
                                                    </a>

                                                </td>

                                                <td>

                                                    <div class="d-flex px-2 py-1 text-primary">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm text-capitalize">
                                                                {{ $transaction->user->name }}
                                                            </h6>
                                                            @if ($transaction->user->role == 0)
                                                            <p class="text-xs text-secondary mb-0">
                                                               <strong>Student</strong></p>
                                                           <p class="text-xs text-secondary mb-0">
                                                               <strong>LRN No. :</strong>
                                                               &nbsp;{{ $transaction->user->id_number }}</p>
                                                       @else
                                                            <p class="text-xs text-secondary mb-0">
                                                               <strong>Teacher</strong></p>
                                                           <p class="text-xs text-secondary mb-0">
                                                               <strong>ID No. :</strong>
                                                               &nbsp;{{ $transaction->user->id_number }}</p>
                                                       @endif
                                                       @if ($overdueTransaction->user->role == 0)
                                                       <p class="text-xs text-secondary mb-0">
                                                          <strong>Student</strong></p>
                                                      <p class="text-xs text-secondary mb-0">
                                                          <strong>LRN No. :</strong>
                                                          &nbsp;{{ $overdueTransaction->user->id_number }}</p>
                                                        @else
                                                            <p class="text-xs text-secondary mb-0">
                                                                <strong>Teacher</strong></p>
                                                            <p class="text-xs text-secondary mb-0">
                                                                <strong>ID No. :</strong>
                                                                &nbsp;{{ $overdueTransaction->user->id_number }}</p>
                                                        @endif
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
                                                                    <p class="text-xs text-secondary mb-0"></p>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                </td>

                                                <td class="align-middle text-start">
                                                    @foreach ($transaction->bookTransactions as $bookTransaction)
                                                        @if (is_null($bookTransaction->returned_at))
                                                            <p class="text-center text-xs font-weight-bold mb-2">{{ $bookTransaction->books->accession ?? '' }}</p>
                                                        @endif
                                                    @endforeach
                                                </td>
                                            </tr>

                                        @endif
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                            @if ($dueCounter == 0)
                                <div class="alert text-center alert-success text-white" role="alert">
                                    Hooray! No Books Due Today.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header pb-0 p-3">
                    <h6 class="mb-0">Accounts Waiting for Validation</h6>
                </div>
                <div class="card-body p-3">
                    <ul class="list-group">

                        @if ($noOfPending == 0)
                            <div class="alert-secondary alert-dismissible fade show" role="alert">

                                <div class="alert text-center alert-success text-white" role="alert">
                                    Hooray!  No new Students are created, and None required Validation..
                                    </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close">x</button>
                            </div>
                        @endif
                        @if ($noOfPendingTeacher == 2)
                            <div class="alert-secondary alert-dismissible fade show" role="alert">

                                <div class="alert text-center alert-success text-white" role="alert">
                                    Hooray!  No new Teachers are created, and None required Validation..
                                    </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close">x</button>
                            </div>
                        @endif
                        @foreach ($pendingStudents->take(10) as $student)
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex align-items-center">
                                <div class="icon icon-shape icon-sm me-3 text-center">
                                    @if($student->avatar)
                                        <img src="{{ asset('storage/avatar/' . $student->avatar) }}" class="card-img-top rounded-circle" alt="{{ $student->name }}" />
                                    @else
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQGhmTe4FGFtGAgbIwVBxoD3FmED3E5EE99UGPItI0xnQ&s" class="card-img-top rounded-circle" alt="Default Avatar" />
                                    @endif
                                </div>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm text-capitalize">{{ $student->name }}</h6>
                                        <span class="text-bold text-xs">Student</span>
                                        <span class="text-xs">{{ $student->grade_and_section }} <br>
                                            <span class="font-weight-bold">&nbsp;LRN Number: {{ $student->id_number }}</span></span>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <a href="{{ route('accountPending') }}"> <button
                                            class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                                                class="ni ni-bold-right text-lg" aria-hidden="true"></i></button></a>
                                </div>
                            </li>
                        @endforeach

                        @foreach ($pendingTeachers->take(10) as $teacher)
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex align-items-center">
                                <div class="icon icon-shape icon-sm me-3 text-center">
                                    @if($teacher->avatar)
                                        <img src="{{ asset('storage/avatar/' . $teacher->avatar) }}" class="card-img-top rounded-circle" alt="{{ $teacher->name }}" />
                                    @else
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQGhmTe4FGFtGAgbIwVBxoD3FmED3E5EE99UGPItI0xnQ&s" class="card-img-top rounded-circle" alt="Default Avatar" />
                                    @endif
                                </div>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm text-capitalize">{{ $teacher->name }}</h6>
                                        <span class="text-bold text-xs">Teacher</span>
                                        <span class="text-xs">{{ $teacher->office_or_department }} <br>
                                            <span class="font-weight-bold">&nbsp;ID Number: {{ $teacher->id_number }}</span></span>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <a href="{{ route('accountPendingTeacher') }}"> <button
                                            class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                                                class="ni ni-bold-right text-lg" aria-hidden="true"></i></button></a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>



    </div>

    @if (session('error'))
        <script>
            alert("Passwords Don't Match");
        </script>
    @endif
    @if (session('success'))
    <script>
        alert("Passwords Changed. Try Logging out");
    </script>
@endif
@endsection