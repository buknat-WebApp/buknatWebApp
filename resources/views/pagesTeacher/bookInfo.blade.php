@extends('layouts.app')

@section('content')
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ $book->book_title }}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            <strong> Author/s </strong> : {{ $book->author->author }}.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1">
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center"
                                    href="{{ route('StudentbookLists') }}">
                                    <i class="ni ni-books"></i>
                                    <span class="ms-2">All Books</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center disabled btn">
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
                                        <p class="mb-0"> Book Info</p>
                                    </div>
                                </div>
                                <div class="card-body">

                                        <div class="row">
                                            <div class="col col-md-6">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">Book
                                                        Title</label>
                                                    <input name="book_id" value="{{ $book->id }}" hidden>
                                                    <input class="form-control text-uppercase" name="book_title" type="text"
                                                        value="{{ $book->book_title }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">Book
                                                        Author</label>
                                                    <input class="form-control" name="author_name" type="text"
                                                        value="{{ $book->author->author }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">Author
                                                        Number</label>
                                                    <input class="form-control" name="author_no" type="text"
                                                        value="{{ $book->author_no }}" readonly>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">Class
                                                        Number</label>
                                                    <input class="form-control" name="class_no" type="number"
                                                        value="{{ $book->class_no }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="example-text-input"
                                                        class="form-control-label">Edition</label>
                                                    <input class="form-control" name="edition" type="text"
                                                        value="{{ $book->edition }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="example-text-input"
                                                        class="form-control-label">Publisher</label>
                                                    <input class="form-control" name="publisher" type="text"
                                                        value="{{ $book->publisher }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="example-text-input"
                                                        class="form-control-label">Section</label>
                                                    <select class="form-select form-control" id="gender-select"
                                                        name="section" disabled>
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
                                                    <label for="example-text-input" class="form-control-label">Accession
                                                        Number</label>
                                                    <input class="form-control" name="accesion" type="text"
                                                        value="{{ $book->accession }}" readonly>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">Number of
                                                        Pages</label>
                                                    <input class="form-control" name="number_of_pages" type="text"
                                                        value="{{ $book->number_of_pages }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="example-text-input"
                                                        class="form-control-label">ISBN</label>
                                                    <input class="form-control" name="isbn" type="text"
                                                        value="{{ $book->isbn }}" readonly>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="example-text-input"
                                                        class="form-control-label">Subject/Location</label>
                                                    <select class="form-select form-control" id="gender-select"
                                                        name="location_id" disabled>
                                                        @foreach ($location as $locate)
                                                            @if ($book->location_id == $locate->id)
                                                                <option value="{{ $locate->id }}" selected>
                                                                    {{ $locate->name }}
                                                                </option>
                                                            @endif
                                                            <option value="{{ $section->id }}">
                                                                {{ $section->name }}
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">Date of Publication</label>
                                                    <input class="form-control" name="publication_year" type="number"
                                                        value="{{ $book->publication_year }}" readonly>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="book_section" class="form-control-label">Book
                                                        Condition</label>
                                                    <select class="form-select form-control" id="book_section"
                                                        name="book_condition" disabled>


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
                                                        class="form-control-label">No. Of Available Copies</label>
                                                    <input class="form-control" name="no_of_copies" type="number"
                                                        value="{{ $book->available_copies }}" readonly>
                                                </div>
                                            </div>
                                        </div>


                                        </div>
                                        <div class="row">
                                            <div class="col col-6">
                                                <div class="form-group">
                                                    <label for="summary">Synopsis</label>
                                                    <textarea rows="4" cols="50" id="summary" name="summary" class="form-control text-justify" readonly>{{ $book->summary }}</textarea>
                                                </div>
                                            </div>
                                        


                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <a href="{{ route('teacherbookLists') }}"
                                                        class="btn btn-sm form-control mt-4 btn-secondary">Back</a>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <a class="btn btn-sm form-control mt-4 btn-success" href="{{ route('teacherDashboard') }}"
                                                       >Back to Dashboard</a>
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
