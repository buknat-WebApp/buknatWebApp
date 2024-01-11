@extends('layouts.app')

@section('content')
    <div class="mx-5 mt-4">
        <div class="card-body ">
            <div class="row gx-4">

                <div class="col-auto my-auto text-white">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ $book->book_title }}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            <strong> by </strong> : {{ $book->author->author }}.
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
                                    <span class="ms-2">Add</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center"
                                    href="{{ route('bookLists') }}">
                                    <i class="ni ni-books"></i>
                                    <span class="ms-2">All</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a
                                    class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center btn disabled">
                                    <i class="ni ni-books"></i>
                                    <span class="ms-2">Book Info</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="container-fluid py-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header pb-0">
                                    <div class="d-flex align-items-center">
                                        <p class="mb-0">Edit Book</p>
                                    </div>
                                </div>
                                <div class="card-body">
                                    @if (session('success'))
                                    <div class="alert-success alert-dismissible fade show"
                                        role="alert">

                                        <p class="text-center text-white">
                                            {{ session('success') }}
                                        </p>
                                        <button type="button" class="btn-close"
                                            data-bs-dismiss="alert"
                                            aria-label="Close">x</button>
                                    </div>
                                    @endif

                                    <form method="POST" action="{{ route('updateBook') }}">
                                        @csrf
                                        @method('PUT')

                                        <div class="row">
                                            <div class="col col-md-5">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">Book
                                                        Title</label>
                                                    <input name="book_id" value="{{ $book->id }}" hidden>
                                                    <input class="form-control" name="book_title" type="text"
                                                        value="{{ $book->book_title }}">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">Book
                                                        Author</label>
                                                    <input name="authorID" value="{{ $book->author->id }}" hidden>
                                                    <input class="form-control" name="author_name" type="text"
                                                        value="{{ $book->author->author }}">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">Author
                                                        ID</label>
                                                    <input class="form-control" name="author_id" type="number"
                                                        value="{{ $book->author->author_id }}">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="example-text-input"
                                                        class="form-control-label">Section</label>
                                                    <select class="form-select form-control" id="gender-select"
                                                        name="section">
                                                        @foreach ($sections as $section)
                                                            @if ($book->section->id == $section->id)
                                                                <option value="{{ $section->id }}" selected>
                                                                    {{ $section->section_name }}
                                                                </option>
                                                            @endif
                                                            <option value="{{ $section->id }}">
                                                                {{ $section->section_name }}
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">Added
                                                        by</label>
                                                    <input class="form-control" type="text"
                                                        value="{{ $book->added_by }}" disabled>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">Class
                                                        Number</label>
                                                    <input class="form-control" name="class_no" type="number"
                                                        value="{{ $book->class_no }}">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="example-text-input"
                                                        class="form-control-label">Edition</label>
                                                    <input class="form-control" name="edition" type="text"
                                                        value="{{ $book->edition }}">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="example-text-input"
                                                        class="form-control-label">Publisher</label>
                                                    <input class="form-control" name="publisher" type="text"
                                                        value="{{ $book->publisher }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">Number of
                                                        Pages</label>
                                                    <input class="form-control" name="number_of_pages" type="text"
                                                        value="{{ $book->number_of_pages }}">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="example-text-input"
                                                        class="form-control-label">ISBN</label>
                                                    <input class="form-control" name="isbn" type="number"
                                                        value="{{ $book->isbn }}">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="example-text-input"
                                                        class="form-control-label">Location</label>
                                                    <select class="form-select form-control" id="gender-select"
                                                            name="location">
                                                        @foreach ($locations as $location)
                                                            @if ($book->location->id == $location->id)
                                                                <option value="{{ $location->id }}" selected>
                                                                    {{ $location->name }}
                                                                </option>
                                                            @endif
                                                            <option value="{{ $location->id }}">
                                                            {{ $location->name }}
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">Publication
                                                        Year</label>
                                                    <input class="form-control" name="publication_year" type="number"
                                                        value="{{ $book->publication_year }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col col-6">
                                                <div class="form-group">
                                                    <label for="summary">Synopsis</label>
                                                    <textarea rows="4" cols="50" id="summary" name="summary" class="form-control text-justify">{{ $book->summary }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="book_section" class="form-control-label">Book
                                                        Condition</label>
                                                    <select class="form-select form-control" id="book_section"
                                                        name="book_condition">

                                                        {{-- @if ($book->book_condition == 'not-functional')
                                        <option value="functional">functional</option>
                                        <option value="not-functional" selected>not-functional</option>
                                        @else
                                        <option value="functional" selected>functional</option>
                                        <option value="not-functional">not-functional</option>
                                        @endif --}}
                                                        <option value="functional"
                                                            @if ($book->book_condition == 'functional') selected @endif>functional
                                                        </option>
                                                        <option value="not-functional"
                                                            @if ($book->book_condition == 'not-functional') selected @endif>not-functional
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="example-text-input"
                                                        class="form-control-label">No. Of copies</label>
                                                    <input class="form-control" name="no_of_copies" type="number"
                                                        value="{{ $book->no_of_copies }}">
                                                </div>
                                            </div>


                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <a href="{{ route('bookLists') }}"
                                                        class="btn btn-sm form-control mt-4 btn-secondary">Cancel</a>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <a class="btn btn-sm form-control mt-4 btn-success" href="#updateBook"
                                                        data-bs-toggle="modal">Update</a>
                                                </div>
                                            </div>

                                        </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Delete Student -->
                <div class="modal fade" id="updateBook" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modify This Book?</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p class="text-center">
                                    Do you want to proceed in updating this Book?
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-success">Proceed</button>

                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
