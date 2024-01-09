@extends('layouts.app')

@section('content')
    <div class="mx-5 mt-4">
        <div class="card-body ">
            <div class="row gx-4">

                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            Borrowing Form
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            In this page librarian can tally borrowed books
                        </p>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1">
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center btn"
                                   href="{{ route('borrowingForm') }}">
                                    <i class="ni ni-fat-add"></i>
                                    <span class="ms-2">Borrow</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center"
                                   href="{{ route('borrowerLists') }}">
                                    <i class="ni ni-books"></i>
                                    <span class="ms-2">Borrowed</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center"
                                   href="{{ route('returnedBook') }}">
                                    <i class="ni ni-books"></i>
                                    <span class="ms-2">Returned</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a
                                    class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center disabled">
                                    <i class="ni ni-books"></i>
                                    <span class="ms-2">Update</span>
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
                                                            <li class="text-white">{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            @if (session('success'))
                                                <div
                                                    class="alert alert-success alert-dismissible fade show text-white"
                                                    role="alert">
                                                    {{ session('success') }}
                                                </div>
                                            @elseif(session('error'))
                                                <div
                                                    class="alert alert-danger alert-dismissible fade show text-white"
                                                    role="alert">
                                                    {{ session('error') }}
                                                </div>
                                            @else
                                                <div class="alert alert-light" role="alert">
                                                    Student should be Added First Before it can be
                                                    searched
                                                    <a href="{{ route('signupForm') }}"
                                                       class="alert-link">click here</a>, To
                                                    Register
                                                </div>
                                            @endif

                                            <div class="col">

                                            </div>
                                        </div>
                                    </div>
                                    {{-- <input type="text" name="" class="form form-control" id="search-box"> --}}
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">

                                                <form method="POST" action="{{ route('registerBorrower') }}" id="form-borrow">
                                                    @csrf

                                                    <div class="row">
                                                        <div class="col-4">
                                                            <!-- Button to open the camera modal -->
                                                            <button type="button" class="btn btn-primary form-control" data-bs-toggle="modal" data-bs-target="#cameraStudentModal">
                                                                Scan Student QR Code
                                                            </button>
                                                        </div>
                                                        <div class="col">
                                                            <!-- Button to open the camera modal -->
                                                            <button type="button" class="btn btn-primary form-control" data-bs-toggle="modal" data-bs-target="#cameraBookModal">
                                                                Scan Book QR Code
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-4">
                                                            <label for="search">Student Name</label>
                                                            <input type="text" id="search-student-borrow"
                                                                   placeholder="Type Student Name or ID number"
                                                                   class="form-control">
                                                            <table>
                                                                <thead>
                                                                <tr>
                                                                    <th>ID Number</th>
                                                                    <th>&nbsp; &nbsp; Name</th>
                                                                    <th>Tick &nbsp;</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody id="users-table">
                                                                @foreach ($users as $user)
                                                                    <tr>
                                                                        <td>{{ $user->id_number }}</td>
                                                                        <td> &nbsp; &nbsp; &nbsp;
                                                                            {{ $user->name }}</td>
                                                                        <td class="text-center">
                                                                            <input type="radio"
                                                                                   name="user_id"
                                                                                   value="{{ $user->id }}"
                                                                                {{ old('user_id', '') == $user->id ? 'checked' : '' }}>

                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="col">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <label for="search-book-toborrow">Book / Books to
                                                                        Borrow</label>
                                                                    <input type="text" id="search-book-toborrow"
                                                                           placeholder="Type the Book Title or Author"
                                                                           class="form-control">
                                                                </div>


                                                            </div>

                                                            <table class="">
                                                                <thead class="thead-light">
                                                                <tr>
                                                                    <th>Book Title</th>
                                                                    <th>Author</th>
                                                                    <th>Check to select</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody id="table-book-toborrow">
                                                                @foreach ($books as $book)
                                                                    <tr>
                                                                        <td>{{ $book->book_title }}</td>
                                                                        <td>{{ $book->author->author }}</td>
                                                                        <td>
                                                                            <input type="checkbox"
                                                                                   name="books[]"
                                                                                   value="{{ $book->id }}"
                                                                                {{ in_array($book->id, old('books', [])) ? 'checked' : '' }}>
                                                                        </td>
                                                                        <input type="text"
                                                                               name="borrowed_book_condition[]"
                                                                               value="{{ $book->book_condition }}"
                                                                               id="" hidden>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                        <div class="row">
                                                            {{-- <button type="submit" id="submitBtnBorrow"  class="btn mt-2 btn-primary">Submit</button> --}}
                                                            {{-- <button type="submit" id="submitBtn" class="btn btn-primary">Submit</button> --}}
                                                            <button style="display: block; width: 300px; margin: 0 auto;"
                                                                    type="button" class="btn btn-success mt-3"
                                                                    data-bs-toggle="modal" data-bs-target="#borrowModal">
                                                                Submit
                                                            </button>

                                                        </div>


                                                        <hr class="horizontal dark">

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="borrowModal" tabindex="-1" role="dialog"
                                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-md" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                                                                        <button type="button" class="btn-close btn-close-white"
                                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p class="text=-center">Do you want to submit the borrowing
                                                                            form?
                                                                        </p>

                                                                        <div class="mb-3">
                                                                            <label for="recipient-name" class="col-form-label">Expected
                                                                                Date to be Returned</label>
                                                                            <input type="date" name="expected_return_date"
                                                                                   class="form-control" id="recipient-name">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="message-text"
                                                                                   class="col-form-label">Note:</label>
                                                                            <textarea class="form-control" name="remarks"
                                                                                      id="message-text"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Cancel
                                                                        </button>
                                                                        <button type="submit" class="btn btn-success">Confirm</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </form>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                <!-- Camera Student modal -->
                <div class="modal fade" id="cameraStudentModal" tabindex="-1" aria-labelledby="cameraModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="cameraModalLabel">Scan Student QR Code</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <video id="scanner1"></video>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Camera Book modal -->
                <div class="modal fade" id="cameraBookModal" tabindex="-1" aria-labelledby="cameraModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="cameraModalLabel">Scan Book QR Code</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <video id="scanner"></video>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>

                <script type="text/javascript"
                        src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
                <script type="text/javascript"
                        src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
                <script type="text/javascript"
                        src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js">
                </script>

                        <script>
                            const searchInputStudent = document.getElementById('search-student-borrow');
                            const usersTable = document.getElementById('users-table');

                            // Add an event listener to the search input
                            searchInputStudent.addEventListener('input', function () {
                                // Get the search term
                                const searchTerm = searchInputStudent.value.toLowerCase();

                                // Loop through each row in the users table
                                for (let i = 0; i < usersTable.rows.length; i++) {
                                    const row = usersTable.rows[i];
                                    const name = row.cells[0].textContent.toLowerCase();
                                    const email = row.cells[1].textContent.toLowerCase();

                                    // Check if the row matches the search term
                                    if (name.includes(searchTerm) || email.includes(searchTerm)) {
                                        row.style.display = '';
                                    } else {
                                        row.style.display = 'none';
                                    }
                                }
                            });

                            const searchInputBook = document.getElementById('search-book-toborrow');
                            const BooksToBorrowTable = document.getElementById('table-book-toborrow');

                            // Add an event listener to the search input
                            searchInputBook.addEventListener('input', function () {
                                // Get the search term
                                const searchBook = searchInputBook.value.toLowerCase();

                                // Loop through each row in the users table
                                for (let i = 0; i < BooksToBorrowTable.rows.length; i++) {
                                    const rowBook = BooksToBorrowTable.rows[i];
                                    const bookTitle = rowBook.cells[0].textContent.toLowerCase();
                                    const bookAuthor = rowBook.cells[1].textContent.toLowerCase();
                                    const bookID = rowBook.cells[2].textContent.toLowerCase();


                                    // Check if the row matches the search term
                                    if (bookTitle.includes(searchBook) || bookAuthor.includes(searchBook) || bookID.includes(searchBook)) {
                                        rowBook.style.display = '';
                                    } else {
                                        rowBook.style.display = 'none';
                                    }
                                }
                            });

                            function initializeScanner(videoElement, inputField, modalElement, searchInput) {
                                const scanner = document.getElementById(videoElement);
                                const instascanScanner = new Instascan.Scanner({ video: scanner });

                                instascanScanner.addListener('scan', function (content) {
                                    $(inputField).val(content);
                                    $(modalElement).modal('hide');
                                });

                                // instascanScanner.addListener('scan', function (content) {
                                //     // Set the scanned content to the input field
                                //     $(inputField).val(content);
                                //     // Hide the camera modal
                                //     $(modalElement).modal('hide');
                                //     // Trigger the input event on the search input
                                //     const inputEvent = new Event('input');
                                //     searchInput.dispatchEvent(inputEvent);
                                // });


                                $(modalElement).on('shown.bs.modal', function () {
                                    Instascan.Camera.getCameras()
                                        .then(function (cameras) {
                                            if (cameras.length > 0) {
                                                const selectedCamera = cameras[0];
                                                instascanScanner.start(selectedCamera);
                                            } else {
                                                alert('No cameras found.');
                                            }
                                        })
                                        .catch(function (error) {
                                            alert('Failed to access camera: ' + error);
                                        });
                                });

                                $(modalElement).on('hidden.bs.modal', function () {
                                    instascanScanner.stop();
                                });
                            }

                            // Initialize Book Scanner
                            initializeScanner('scanner', '#search-book-toborrow', '#cameraBookModal', 'searchInputBook');

                            // Initialize Student Scanner
                            initializeScanner('scanner1', '#search-student-borrow', '#cameraStudentModal', 'searchInputStudent');

                        </script>

@endsection
