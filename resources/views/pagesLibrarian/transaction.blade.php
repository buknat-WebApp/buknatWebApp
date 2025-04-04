@extends('layouts.app')

@section('content')
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="row gx-4">
                <!-- User Profile Section -->
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        @if($transactions->first()->user->avatar)
                            <img src="{{ asset('storage/avatar/' . $transactions->first()->user->avatar) }}" 
                                alt="profile_image" 
                                class="w-100 h-100 border-radius-lg shadow-sm object-fit-cover border rounded">
                        @else
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQGhmTe4FGFtGAgbIwVBxoD3FmED3E5EE99UGPItI0xnQ&s" 
                                class="w-100 h-100 border-radius-lg shadow-sm object-fit-cover border rounded" />
                        @endif
                    </div>
                </div>

                <!-- User Info Section -->
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1 font-weight-bold text-capitalize">{{ $transactions->first()->user->name }}</h5>
                        <p class="mb-0 text-sm">
                         {{ $transactions->first()->user->grade_and_section }}
                        </p>
                        <p class="mb-0 text-sm text-capitalize">
                           <strong>Section:</strong> {{ $transactions->first()->user->section }}
                        </p>
                    </div>
                </div>

                <!-- Transaction Details Table -->
                <div class="col-12 mt-4">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Transaction History</h6>
                        </div>
                        
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Book Title</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Author</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Date Borrowed</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Expected Return</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Returned Date</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Fines</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Status</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($transactions as $transaction)
                                        @foreach($booksMap[$transaction->id] ?? [] as $bookData)
                                                <tr>
                                                    <td class="ps-3">
                                                        <p class="text-xs font-weight-bold mb-0">
                                                            {{ $bookData['book']->book_title }}
                                                        </p>
                                                    </td>
                                                    <td class="ps-3">
                                                        <p class="text-xs font-weight-bold mb-0">
                                                            {{ $bookData['book']->author->author ?? 'N/A' }}
                                                        </p>
                                                    </td> 
                                                    <td class="text-center">
                                                        <p class="text-xs font-weight-bold mb-0">
                                                            {{ \Carbon\Carbon::parse($transaction->borrowed_at)->format('M d, Y h:i A') }}
                                                        </p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p class="text-xs font-weight-bold mb-0">
                                                            {{ \Carbon\Carbon::parse($transaction->expected_return_date)->format('M d, Y') }}
                                                        </p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p class="text-xs font-weight-bold mb-0">
                                                            {{ \Carbon\Carbon::parse($transaction->returned_at ?? '')->format('M d, Y h:i A') }}
                                                        </p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p class="text-xs font-weight-bold mb-0">
                                                            {{ $bookData['fines'] ?? 'No fines' }} <!-- Display fines -->
                                                        </p>
                                                    </td>
    
                                                    <td class="text-center">
                                                        @php
                                                            $bookTransaction = $transaction->bookTransactions->where('book_id', $bookData['book']->id)->first();
                                                            $expectedReturnDate = \Carbon\Carbon::parse($transaction->expected_return_date);
                                                            $returnedAt = $bookTransaction ? \Carbon\Carbon::parse($bookTransaction->returned_at) : null;
                                                    
                                                            // Conditions
                                                            $isReturned = $returnedAt !== null;
                                                            $isOverdue = !$isReturned && $expectedReturnDate->isPast();
                                                            $wasOverdue = $isReturned && $returnedAt->greaterThan($expectedReturnDate);
                                                        @endphp
                                                        <span class="badge badge-sm 
                                                            {{ $isReturned ? ($wasOverdue ? 'bg-gradient-danger' : 'bg-gradient-success') : ($isOverdue ? 'bg-gradient-danger' : 'bg-gradient-warning') }}">
                                                            {{ $isReturned ? ($wasOverdue ? 'Overdue' : 'On Time') : ($isOverdue ? 'Overdue' : 'Borrowed') }}
                                                        </span>
                                                    </td>
                                                    
                                                    <td class="text-center">
                                                        @php
                                                            $bookTransaction = $transaction->bookTransactions->where('book_id', $bookData['book']->id)->first(); // Fetch the specific book transaction
                                                        @endphp
                                                        <p class="text-xs font-weight-bold mb-0">
                                                            {{ $bookTransaction->remarks ?? 'No remarks' }} <!-- Fetch remarks from bookTransaction -->
                                                        </p>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back Button -->
            <div class="text-center mt-3">
                <a href="/Librarian/transactions" class="btn btn-secondary">
                    Back to Student Transactions
                </a>
            </div>
        </div>
    </div>
@endsection