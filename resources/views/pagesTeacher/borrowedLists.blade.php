@extends('layouts.app')

@section('content')
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">Borrowed Lists</h5>
                        <p class="mb-0 font-weight-bold text-sm">In this page librarian see the borrowed books.</p>
                    </div>
                </div>
                <div class="container-fluid py-4 mt-2">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mt-2"></div>
                            @if (session('success'))
                                <div class="alert-success alert-dismissible fade show" role="alert">
                                    <p class="text-center text-white">{{ session('success') }}</p>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">x</button>
                                </div>
                            @endif
                            <div class="col-12">
                                <div class="card mb-4">
                                    <div class="card-header pb-0">
                                        <h6>Transactions</h6>
                                    </div>
                                    <div class="card-body px-0 pt-0 pb-2">
                                        <div class="table-responsive p-0">
                                            <table class="table align-items-center mb-0" id="mytable">
                                                <thead>
                                                    <tr>
                                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Date Borrowed</th>
                                                        <th class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Expected Return Date</th>
                                                        <th class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Return Date</th>
                                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Borrowed Book/s</th>
                                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fines</th>
                                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Borrow Status</th>
                                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Note</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($transactions->take(30) as $transaction)
                                                        <tr>
                                                            <td class="text-start"><p>{{ \Carbon\Carbon::parse($transaction->borrowed_at)->format('M d, Y h:i A') }}</p></td>
                                                            <td class="text-start"><p>{{ \Carbon\Carbon::parse($transaction->expected_return_date)->format('M d, Y') }}</p></td>
                                                            <td class="text-start"><p>{{ \Carbon\Carbon::parse($transaction->expected_return_date)->format('M d, h:i A') }}</p></td>
                                                            <td class="text-start">
                                                               
                                                                @foreach ($transaction->bookTransactions as $bookTransaction)
                                                                    @foreach ($books as $book)
                                                                        @if ($bookTransaction->book_id == $book->id)
                                                                            <p class="text-capitalize text-bold mb-1">{{ $book->book_title }}</p>
                                                                            <p class="text-capitalize text-sm mb-1">{{ $book->author->author }}</p>
                                                                           
                                                                        @endif
                                                                    @endforeach
                                                                @endforeach
                                                            </td>
                                                            <td class="text-start"><p>{{ ($transaction->fines) }}</p></td>
                                                            <td class="text-start">
                                                                @foreach ($transaction->bookTransactions as $bookTransaction)
                                                                    @if (!is_null($bookTransaction->returned_at))
                                                                        <p class="badge badge-pill badge-lg bg-gradient-success" style="font-size: 14px;">ON TIME</p>
                                                                    @else
                                                                        @if (now()->greaterThan($transaction->expected_return_date))
                                                                            <p class="badge badge-pill badge-lg bg-gradient-danger" style="font-size: 14px;">OVERDUE</p>
                                                                        @else
                                                                            <p class="badge badge-pill badge-lg bg-gradient-warning" style="font-size: 14px;">NOT YET RETURN</p>
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                            <td class="text-start"><p>{{ ($transaction->summary) }}</p></td>
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
