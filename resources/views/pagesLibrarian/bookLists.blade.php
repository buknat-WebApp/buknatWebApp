@extends('layouts.app')

@section('content')
    <div class="mx-5 mt-4">
        <div class="card-body ">
            <div class="row gx-4">

                <div class="col-auto my-auto text-white">
                    <div class="h-100">
                        <h5 class="mb-1">
                            Book Lists
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            In this page you see all the books
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1">
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center"
                                    href="{{ route('addBook') }}">
                                    <i class="ni ni-fat-add"></i>
                                    <span class="ms-2">Add Book</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center btn"
                                    href="{{ route('bookLists') }}">
                                    <i class="ni ni-books"></i>
                                    <span class="ms-2">All Book</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a
                                    class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center disabled">
                                    <i class="ni ni-books"></i>
                                    <span class="ms-2">Book Info</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>


                <div class="container-fluid py-4 mt-2">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-12">
                                    <div class="card mb-4 p-2">
                                        <div class="card-body pb-2">
                                        @if (session('success'))
                                <div class="alert-success alert-dismissible fade show"
                                    role="alert">

                                    <p class="text-center text-white">
                                        {{ session('success') }}</p>
                                    <button type="button" class="btn-close"
                                        data-bs-dismiss="alert"
                                        aria-label="Close">x</button></div>
                                @else
                                <div class="alert-danger alert-dismissible fade show"
                                    role="alert">

                                    <p class="text-center text-white">
                                        {{ session('error') }}
                                    </p>
                                    <button type="button" class="btn-close"
                                        data-bs-dismiss="alert"
                                        aria-label="Close">x</button>
                                </div>
                                @endif
                                            <div class="table-responsive ">
                                                <table class="table align-items-center mb-0"  id="mytable">
                                                <thead>
                                                    <tr>
                                                        <th
                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Book Title</th>
                                                        <th
                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                            Publisher</th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Status</th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Book Section
                                                        </th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Book Location
                                                        </th>
                                                        <th class="text-secondary opacity-7"></th>
                                                        <th class="text-secondary opacity-7"></th>
                                                        <th class="text-secondary opacity-7"></th>

                                                    </tr>
                                                </thead>
                                                <tbody>


                                                    @foreach ($booksWSections as $booksWSection)
                                                        @foreach ($booksWSection->books as $book)
                                                            <tr>
                                                                <td>
                                                                    <div class="d-flex px-2 py-1">
                                                                        <div
                                                                            class="d-flex flex-column justify-content-center">
                                                                            <h6 class="mb-0 text-sm">
                                                                                {{ $book->book_title }}
                                                                            </h6>
                                                                            <p class="text-xs text-secondary mb-0">
                                                                            {{ $book->author ? $book->author->author : 'No Author' }}</p>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <p class="text-xs font-weight-bold mb-0">
                                                                        {{ $book->publisher }}</p>
                                                                    <p class="text-xs text-secondary mb-0">
                                                                        {{ $book->publication_year }}</p>
                                                                </td>
                                                                <td class="align-middle text-center text-sm">
                                                                    @if ($book->available_copies >= 1)
                                                                        <span
                                                                            class="badge badge-sm bg-gradient-success">Available</span>
                                                                    @else
                                                                        <span class="badge badge-sm bg-gradient-danger">Not
                                                                            -
                                                                            Available</span>
                                                                    @endif

                                                                </td>
                                                                <td class="align-middle text-center">
                                                                    <span
                                                                        class="text-secondary text-xs font-weight-bold">{{ $book->section->section_name }}</span>
                                                                </td>
                                                                <td class="align-middle text-center">
                                                                    <span
                                                                        class="text-secondary text-xs font-weight-bold"> {{ $book->location?->name ?? 'No Location' }}</span>
                                                                </td>
                                                                @if ($book->section_id === 8)
                                                                <td>

                                                                </td>
                                                                <td>


                                                                <a target="_blank"
                                                                    class="text-secondary font-weight-bold text-xs btn"
                                                                    ddata-bs-toggle="tooltip" data-bs-placement="top" title="View Book"
                                                                    ic  href="{{ Storage::url('UploadedBooks/' . $book->location) }}">

                                                                    <span class="fas fa-eye"> view PDF</span>
                                                                </a>
                                                                </td>
                                                                @else

                                                                <td class="">
                                                                    <a href="{{ route('bookInfo', ['book' => $book->id]) }}"
                                                                        class=""
                                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                                        title="Manage Book">
                                                                        <span class="fas fa-edit">  </span> Book </a>
                                                                </td>
                                                                <td class="">
                                                                    <a href="{{ asset('storage/BookQRCodes/' . $book->id.'.png') }}" target="_blank"
                                                                        onclick="printImage('{{ asset('storage/BookQRCodes/' . $book->id.'.png') }}'); return false;">
                                                                        <span class="fas fa-print"></span> Print QR
                                                                     </a>
                                                                     <a class="m-3" href="{{ asset('storage/BookQRCodes/' . $book->id.'.png') }}" download>
                                                                        <span class="fas fa-download"></span> Download QR
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    <form action="{{ route('deleteBook', ['book' => $book->id]) }}" method="POST" 
                                                                        onsubmit="return confirm('Are you sure you want to delete this book?');">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <div class="pt-3">
                                                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete this Log?">
                                                                                <i class="fas fa-trash"> Delete</i>
                                                                            </button>
                                                                        </div>
                                                                    </form>
                                                                </td>
                                                                @endif
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
