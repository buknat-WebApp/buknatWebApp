@extends('layouts.app')

@section('content')
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="row gx-4">

                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            Book Lists
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            In this page you see all the books and its availability
                        </p>
                        <p class="text-danger text-sm">
                            Use the search to filter what book you're looking
                        </p>
                    </div>
                </div>

                <div class="container-fluid py-4 mt-2">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="card mt-2"></div>

                            <div class="col-12">
                                <div class="card mb-4">
                                    <div class="card-header pb-0">
                                        <h6>Books table</h6>
                                    </div>
                                    <div class="card-body px-0 pt-0 pb-2">
                                        <div class="table-responsive p-0">
                                            <table class="table align-items-center mb-0" id="mytable">
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
                                                            Book Status</th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Book Section</th>
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
                                                                            <h6 class="mb-0 text-sm text-capitalize">
                                                                                {{ $book->book_title }}
                                                                            </h6>
                                                                            <p class="text-xs text-secondary mb-0 text-capitalize">
                                                                                {{ $book->author ? $book->author->author : '' }}</p>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <p class="text-xs font-weight-bold mb-0 text-capitalize">
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
                                                                <td class="align-middle">
                                                                    @if ($book->section_id === 8)
                                                                    <a target="_blank"
                                                                        class="text-secondary font-weight-bold text-xs btn"
                                                                        ddata-bs-toggle="tooltip" data-bs-placement="top" title="View Book"
                                                                        ic  href="{{ Storage::url('UploadedBooks/' . $book->location) }}">

                                                                        <span class="fas fa-eye"> view PDF</span>
                                                                    </a>

                                                                    @else
                                                                        <a href="{{ route('bookInfoStudent', ['book' => $book->id]) }}"
                                                                        class="text-secondary font-weight-bold text-xs btn"
                                                                        ddata-bs-toggle="tooltip" data-bs-placement="top" title="View Book">
                                                                        <span class="fas fa-eye"> view</span>
                                                                    </a>
                                                                    @endif
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

                    </div>
                </div>
            </div>
        </div>
    </div>

        @endsection
