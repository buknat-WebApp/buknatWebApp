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
                        <table class="table align-items-center ">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Transaction ID</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Date Borrowed</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Expected Return Date</th>
                                    <th class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Borrowed Book/s</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $today = date('Y-m-d');
                                    $dueCounter = 0; $newAccountCounter =0;
                                @endphp
                                @if ($transactions)
                                    @foreach ($transactions as $transaction)
                                        @if ($transaction->expected_return_date !== null)
                                        @php
                                            $dueCounter++;
                                        @endphp
                                            <tr>

                                                <td>

                                                    <div class="d-flex px-2 py-1 text-primary">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">
                                                                {{ $transaction->id }}
                                                            </h6>
                                                            <p class="text-xs text-secondary mb-0">
                                                                <strong>ID No.</strong>
                                                                {{ $transaction->user->id_number }}
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
                                                    <?php $count = 1; ?>
                                                    @foreach ($transaction->bookTransactions as $bookTransaction)
                                                        @foreach ($books as $book)
                                                            @if (is_null($bookTransaction->returned_at))
                                                                @if ($bookTransaction->book_id == $book->id)
                                                                    <p class="text-xs font-weight-bold mb-2">
                                                                        {{ $count }} .
                                                                        {{ $book->book_title }} </p>
                                                                    <p class="text-xs text-secondary mb-0"></p>
                                                                    <?php $count++; ?>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endforeach

                                                </td>
                                                <td class="text-center">
                                                    <span class="text-sm text-danger">Please Return Books on Time.</span>
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
