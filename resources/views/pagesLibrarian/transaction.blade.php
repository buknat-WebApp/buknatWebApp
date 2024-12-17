@extends('layouts.app')

@section('content')
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                    @if( $transaction->user->avatar)
                            <img src="{{ asset('storage/avatar/' . $transaction->user->avatar) }}" alt="profile_image" class="w-100 h-100 border-radius-lg shadow-sm object-fit-cover border rounded">
                        @else
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQGhmTe4FGFtGAgbIwVBxoD3FmED3E5EE99UGPItI0xnQ&s" class="w-100 h-100 border-radius-lg shadow-sm object-fit-cover border rounded" />
                        @endif
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ $transaction->user->name }}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            this are the transactions of {{ $transaction->user->name }} from
                            {{ $transaction->user->grade_and_section }}
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1">

                        </ul>
                    </div>
                </div>


                <div class="container-fluid py-4 mt-2">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="card mt-2"></div>

                            <div class="col-12">
                                <div class="card mb-4">
                                    <div class="card-header pb-0">
                                        <h6>Borrower's Information</h6>
                                    </div>
                                    
                                    <div class="card-body px-0 pt-0 pb-2">
                                        <div class="table-responsive p-0">

                                            <table class="table align-items-center mb-0">

                                                <thead>
                                                    <tr>

                                                        <th
                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            List of Books Borrowed</th>

                                                        <th
                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Author/s</th>
                                                        <th
                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                            Date Borrowed</th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Date Returned</th>

                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Remarks</th>


                                                        <th></th>

                                                    </tr>
                                                </thead>
                                                <tbody>



                                                    <tr>

                                                        <td>
                                                            <div class="d-flex px-2 py-1">
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    @foreach ($books as $book)
                                                                        <p id="grade"
                                                                            class="text-xs font-weight-bold mb-0">
                                                                            {{ $book['book_title'] }}
                                                                        </p>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </td>
                                                        {{--@foreach ($sections as $section)
                                                                @if ($book->section->id == $section->id)
                                                                    <option value="{{ $section->id }}" selected>
                                                                        {{ $section->section_name }}
                                                                    </option>
                                                                @endif
                                                                <option value="{{ $section->id }}">
                                                                    {{ $section->section_name }}
                                                            @endforeach--}}
                                                        <td>
                                                            @foreach ($books as $book)
                                                                <p id="grade" class="text-xs font-weight-bold mb-0">
                                                                    {{ $book['authors->author'] }}
                                                                </p>
                                                            @endforeach
                                                        </td>

                                                        <td class="align-middle text-center text-sm">
                                                            <p id="grade" class="text-xs font-weight-bold mb-0">
                                                                {{ $transaction->borrowed_at }}
                                                            </p>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            <p id="grade" class="text-xs font-weight-bold mb-0">
                                                                {{ $transaction->expected_return_date }}
                                                            </p>
                                                        </td>

                                                        <td class="">
                                                            <p id="grade" class="text-xs font-weight-bold mb-0">
                                                                {{ $transaction->remarks }}
                                                            </p>

                                                        </td>

                                                    </tr>

                                                    </form>


                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <a href="/Librarian/transactions"><button class="btn btn-secondary form-control">
                                Back to Student Transactions
                            </button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function printImage(imageUrl) {
            var printWindow = window.open(imageUrl, '_blank');
            printWindow.onload = function() {
                printWindow.print();
            }
        }
    </script>
@endsection
