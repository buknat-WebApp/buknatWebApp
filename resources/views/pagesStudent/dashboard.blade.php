@extends('layouts.app')

@section('content')

        <div class="row mt-12">
            <center>

                <div class="col-lg-10 mb-lg-0 mb-4">
                    <div class="card ">
                        <div class="card-header pb-0 p-3">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-2">Your Due Today & Pass Due Books</h6>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Date Borrowed</th>
                                        <th class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Due Date</th>
                                        <th class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Title of Book/s  Borrowed</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Accession</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $today = date('Y-m-d');
                                        $dueCounter = 0; $newAccountCounter = 0;
                                    @endphp
                                    @if ($transactions)
                                        @foreach ($transactions as $transaction)
                                            @if ($transaction->expected_return_date !== null)
                                            @php
                                                $dueCounter++;
                                            @endphp
                                                <tr>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-2">
                                                            {{ \Carbon\Carbon::parse($transaction->borrowed_at)->format('M d, Y h:i A') }}</p>
                                                    </td>

                                                    <td class="text-xs font-weight-bold mb-2">
                                                        <p>
                                                            {{ \Carbon\Carbon::parse($transaction->expected_return_date)->format('M d, Y') }}</p>
                                                    </td>

                                                    <td class="text-start">
                                                        @foreach ($transaction->bookTransactions as $bookTransaction)
                                                            @foreach ($books as $book)
                                                                @if (is_null($bookTransaction->returned_at))
                                                                    @if ($bookTransaction->book_id == $book->id)
                                                                        <p class="text-xs font-weight-bold mb-2">
                                                                            {{ $book->book_title }} </p>
                                                                        <p class="text-xs text-secondary mb-0">{{ $book->author->author }}</p>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        
                                                    </td>
                                                    <td class="text-center"><p>{{ $bookTransaction->books->accession ?? '' }}</p></td>
                                                    @endforeach
                                                    <td class="text-center">
                                                        <span class="text-sm text-danger text-bold">Please Return Books on Time.</span>
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
    </center>


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
