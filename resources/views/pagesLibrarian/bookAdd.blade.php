@extends('layouts.app')

@section('content')
    <div class="mx-5 mt-4">
        <div class="card-body ">
            <div class="row gx-4">

                <div class="col-auto my-auto text-white">
                    <div class="h-100">
                        <h5 class="mb-1">
                            Book Options
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            In this page you can add books
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1">
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center btn"
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
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                @if ($errors->any())
                                                    <div class="alert alert-danger">
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <li class="text-white pb-0 mb-0">{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                                @if (session('success'))
                                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                        <p class="text-white pb-0 mb-0">
                                                            {{ session('success') }}
                                                        </p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <form method="POST" action="{{ route('registerBook') }}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                                <label for="exampleInputText1">Book Title</label>
                                                                <input type="text" class="form-control" id="exampleInputText1"
                                                                       name="book_title">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <div class="d-flex justify-content-between">
                                                                <label class="" for="gender-select">Author </label>
                                                                <a href="#addAuthor" class="text-sm" data-bs-toggle="modal">Add author </a>
                                                            </div>
                                                           <select class="form-select form-control" id="gender-select"
                                                                    name="author_id">
                                                                @foreach ($authors as $author)
                                                                    <option value="{{ $author->id }}">{{ $author->author }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="exampleInputText1">Class Number</label>
                                                            <input type="number" class="form-control" id="exampleInputText1"
                                                                   name="class_no">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="gender-select">Section </label>
                                                            <select class="form-select form-control" id="gender-select"
                                                                    name="section_id">
                                                                @foreach ($sections as $section)
                                                                    <option value="{{ $section->id }}">{{ $section->section_name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <div class="form-group">
                                                                <label for="exampleInputText1">Edition</label>
                                                                <input type="text" class="form-control" id="exampleInputText1"
                                                                       name="edition">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <div class="form-group">
                                                                <label for="exampleInputText1">Publication Year</label>
                                                                <input type="number" class="form-control" id="exampleInputText1"
                                                                       min="1900" max="2100"
                                                                       name="publication_year">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="exampleInputText1">Date Acquired</label>
                                                            <input type="date" class="form-control" id="exampleInputText1"
                                                                   name="date_acquired">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="exampleInputText1">Number of Copies</label>
                                                            <input type="number" class="form-control" id="exampleInputText1"
                                                                   name="no_of_copies">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="exampleInputText1">Available Copies</label>
                                                            <input type="number" class="form-control" id="exampleInputText1"
                                                                   name="available_copies">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="exampleInputText1">On-hand Per Count</label>
                                                            <input type="number" class="form-control" id="exampleInputText1"
                                                                   name="on_hand_per_count">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <div class="form-group">
                                                                <label for="gender-select">Book Status:</label>
                                                                <select class="form-select form-control" id="gender-select"
                                                                        name="book_status">
                                                                    <option value="available" selected>Available</option>
                                                                    <option value="not-available">Not Available</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="gender-select">Book Condition:</label>
                                                            <select class="form-select form-control" id="gender-select"
                                                                    name="book_condition">
                                                                <option value="functional" selected>Functional</option>
                                                                <option value="not-functional">Not Functional</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="exampleInputText1">Publisher</label>
                                                            <input type="text" class="form-control" id="exampleInputText1"
                                                                   name="publisher">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <div class="form-group">
                                                                <label for="exampleInputText1">ISBN</label>
                                                                <input type="text" class="form-control" id="exampleInputText1"
                                                                       name="isbn">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <div class="form-group">
                                                                <label for="exampleInputText1">Book Cover</label>
                                                                <input type="file" class="form-control" id="exampleInputText1"
                                                                       name="book_cover" accept="image/*">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <div class="form-group">
                                                                    <label for="exampleInputText1">Number of Pages</label>
                                                                    <input type="number" class="form-control" id="exampleInputText1"
                                                                           name="number_of_pages">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="exampleInputText1">Language</label>
                                                                <input type="text" class="form-control" id="exampleInputText1"
                                                                       name="language">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="exampleInputText1">Genre</label>
                                                                <input type="text" class="form-control" id="exampleInputText1"
                                                                       name="genre">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="exampleInputText1">Location</label>
                                                                <select class="form-select form-control" id="gender-select"
                                                                        name="location_id">
                                                                    @foreach ($locations as $location)
                                                                        <option value="{{ $location->id }}">{{ $location->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr class="horizontal dark">
                                                    <p class="text-uppercase text-sm">Synopsis</p>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <textarea class="form-control" type="text" name="summary" rows="5"
                                                                          cols="12"></textarea>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <hr class="horizontal dark">
                                                    <input type="submit" class="btn btn-primary form-control">

                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                <div class="modal fade" id="addAuthor" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <form method="POST" action="{{ route('registerAuthor') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-dialog modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add new author</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                       <div class="col">
                                           <div class="form-group">
                                               <label for="exampleInputText1">Name</label>
                                               <input type="text" class="form-control" id="exampleInputText1"
                                                      name="author">
                                           </div>
{{--                                           <div class="col">--}}
{{--                                               <div class="form-group">--}}
{{--                                                   <label for="exampleInputText1">ID</label>--}}
{{--                                                   <input type="text" class="form-control" id="exampleInputText1"--}}
{{--                                                          name="author_id">--}}
{{--                                               </div>--}}
{{--                                           </div>--}}
                                       </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-success">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
@endsection
