@extends('layouts.app')

@section('content')
    <div class="mx-5 mt-4">
        <div class="card-body ">
            <div class="row gx-4">

                <div class="col-auto my-auto text-white">
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
                                    <span class="ms-2">Search</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center"
                                   href="{{ route('borrowerLists') }}">
                                    <i class="ni ni-books"></i>
                                    <span class="ms-2">Check/Out</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center"
                                   href="{{ route('returnedBook') }}">
                                    <i class="ni ni-books"></i>
                                    <span class="ms-2">Book Returned</span>
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
                            <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                                        <div class="nav-wrapper position-relative end-0">
                                            <ul class="nav nav-pills nav-fill p-1">
                                                <li class="nav-item">
                                                    <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center btn"
                                                    href="{{ route('borrowingForm') }}">
                                                        <i class="fas fa-user"></i>
                                                        <span class="ms-2">Students</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
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
                                                    Teacher should be Added First Before it can be
                                                    searched
                                                    <a href="#" onclick="openModal()"
                                                       class="alert-link">click here</a>, To
                                                    Register
                                                </div>
                                            @endif

                                            <div class="col">

                                            </div>
                                        </div>
                                    </div>  
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <form method="POST" action="{{ route('registerBorrowerTeacher') }}" id="form-borrow">
                                                    @csrf
                                                    
                                                        <div class="col">
                                                            <!-- Button to open the camera modal -->
                                                            <button type="button" class="btn btn-primary form-control" onclick="startScanner()" data-bs-toggle="modal" data-bs-target="#cameraBookModal">
                                                                Scan Book QR Code
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-4">
                                                            <label for="search">Teacher Name</label>
                                                            <input type="text" id="search-student-borrow"
                                                                   placeholder="Type Teacher Name or ID number"
                                                                   class="form-control">
                                                            <table>
                                                                <thead>
                                                                <tr>
                                                                    <th class="text-center">ID Number</th>
                                                                    <th class="text-center">Name</th>
                                                                    <th class="text-center" style="padding-left: 5em;">Tick &nbsp;</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody id="users-table">
                                                                @foreach ($users as $user)
                                                                    <tr class="user-row" style="display: none;">
                                                                        <td text-start>{{ $user->id_number }}&nbsp; &nbsp; &nbsp;</td>
                                                                        <td text-start>&nbsp; &nbsp; &nbsp;{{ $user->name }}</td>
                                                                        <td class="text-center" style="padding-left: 5em;">
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

                                                            <table class="text-center">
                                                                <thead class="thead-light">
                                                                    <tr>
                                                                        <th class="text-center">Book Title</th>
                                                                        <th class="text-center" style="padding-left: 2em;">Author</th>
                                                                        <th class="text-center">Check to select</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="table-book-toborrow">
                                                                    @foreach ($books as $book)
                                                                        <tr class="book-row" style="display: none;" data-section="{{ $book->section }}">
                                                                            <td style="text-align: start;">{{ $book->book_title }}</td>
                                                                            <td style="text-align: start;padding-left: 2em;">{{ $book->author?->author ?? '' }}</td>
                                                                            <td style="text-align: center;">
                                                                                <input type="checkbox"
                                                                                    name="books[]"
                                                                                    value="{{ $book->id }}"
                                                                                    data-section="{{ $book->section }}"
                                                                                    {{ in_array($book->id, old('books', [])) ? 'checked' : '' }}>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                        <div class="row">
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
                                                                            <label class="col-form-label">Book Title</label>
                                                                            <div id="selectedBookDisplay" class="form-control" readonly style="background-color: #f8f9fa;">
                                                                                No book selected
                                                                            </div>
                                                                        </div>

                                                                        <!-- User Search and Display -->
                                                                        <div class="mb-3">
                                                                            <label class="col-form-label">Selected User</label>
                                                                            <div id="selectedUserDisplay" class="form-control" readonly style="background-color: #f8f9fa;">
                                                                                No user selected
                                                                            </div>
                                                                        </div>

                                                                    

                                                                        <div class="mb-3">
                                                                            <label for="recipient-name" class="col-form-label">Due Date - Expected Date to be Returned</label>
                                                                            <input type="date" name="expected_return_date" class="form-control" id="recipient-name">
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

                <div>
                    <button class="btn btn-primary btn-lg font-weight-bold mx-4 mt-4" onclick="goBack()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
                        </svg><i></i> Back    
                    </button>
                    </div>

                    <div class="d-flex justify-content-center py-4 fw-bold lh-lg fst-italic">
                        <p>Library Management System</p>
                    </div>
                    
                <!-- Camera Book modal -->
                    <div class="modal fade" id="cameraBookModal" tabindex="-1" role="dialog" aria-labelledby="cameraModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="cameraModalLabel">Scan QR Code</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-0">
                                    <div class="scanner-container">
                                        <video id="scanner"></video>
                                        <div class="scan-region-highlight">
                                            <div class="scan-region-highlight-svg">
                                                <!-- Corner markers -->
                                                <svg width="100%" height="100%" viewBox="0 0 200 200">
                                                    <path d="M10,0 L0,0 L0,10" stroke="#00ff00" stroke-width="2" fill="none"/>
                                                    <path d="M190,0 L200,0 L200,10" stroke="#00ff00" stroke-width="2" fill="none"/>
                                                    <path d="M10,200 L0,200 L0,190" stroke="#00ff00" stroke-width="2" fill="none"/>
                                                    <path d="M190,200 L200,200 L200,190" stroke="#00ff00" stroke-width="2" fill="none"/>
                                                </svg>
                                            </div>
                                            <div class="scanning-line"></div>
                                        </div>
                                    </div>
                                    <div class="text-center py-2">
                                        <small class="text-muted">Align QR code within the frame</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Audio element -->
                    <audio id="scanSound" src="{{ asset('assets/sounds/beep.mp3') }}" preload="auto"></audio>



                <!-- sign up modal -->
                <div id="signupModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Choose User</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                      <div class="modal-body">
                        <p class="text-center">
                            Are you a Student or Teacher?
                        </p>
                          <a href="{{ route('signupForm') }}" role="button" class="btn btn-primary btn-lg" >Student</a>
                          <a href="{{ route('signupForms') }}" role="button" class="btn btn-secondary btn-lg">Teacher</a>
                      </div>
                    </div>
                </div>

                <style>
                        .scanner-container {
                            position: relative;
                            width: 100%;
                            height: 300px;
                            overflow: hidden;
                            background: #000;
                        }

                        #scanner1 {
                            width: 100%;
                            height: 100%;
                            object-fit: cover;
                        }

                        .scan-region-highlight {
                            position: absolute;
                            top: 50%;
                            left: 50%;
                            transform: translate(-50%, -50%);
                            width: 200px;
                            height: 200px;
                            border: 2px solid #fff;
                            border-radius: 20px;
                            box-shadow: 0 0 0 99999px rgba(0, 0, 0, .5);
                        }

                        .scan-region-highlight-svg {
                            position: absolute;
                            width: 100%;
                            height: 100%;
                        }

                        .scanning-line {
                            position: absolute;
                            width: 100%;
                            height: 2px;
                            background: #00ff00;
                            top: 50%;
                            animation: scan 2s linear infinite;
                            opacity: 0.7;
                            filter: drop-shadow(0 0 8px #00ff00);
                        }

                        @keyframes scan {
                            0% { transform: translateY(-50px); }
                            50% { transform: translateY(50px); }
                            100% { transform: translateY(-50px); }
                        }
                    </style>

                <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
                <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
                <script type="text/javascript" src="https://unpkg.com/instascan@1.0.0/dist/instascan.min.js"></script>

                <script>
                    const searchInputStudent = document.getElementById('search-student-borrow');
                    const usersTable = document.getElementById('users-table');
                    const userRows = usersTable.getElementsByClassName('user-row');

                    // Show first 25 rows initially
                    for (let i = 0; i < Math.min(25, userRows.length); i++) {
                        userRows[i].style.display = '';
                    }

                    // Add an event listener to the search input
                    searchInputStudent.addEventListener('input', function () {
                        const searchTerm = searchInputStudent.value.toLowerCase();
                        let matchCount = 0;

                        // Loop through each row in the users table
                        Array.from(userRows).forEach(row => {
                            const name = row.cells[1].textContent.toLowerCase();
                            const idNumber = row.cells[0].textContent.toLowerCase();

                            // Check if the row matches the search term
                            if (name.includes(searchTerm) || idNumber.includes(searchTerm)) {
                                row.style.display = '';
                                matchCount++;
                            } else {
                                row.style.display = 'none';
                            }
                        });

                        // If no search term, show only first 25
                        if (searchTerm === '') {
                            Array.from(userRows).forEach((row, index) => {
                                row.style.display = index < 25 ? '' : 'none';
                            });
                        }
                    });

                    const searchInputBook = document.getElementById('search-book-toborrow');
                    const bookRows = document.getElementsByClassName('book-row');

                    // Show first 25 book rows initially
                    for (let i = 0; i < Math.min(25, bookRows.length); i++) {
                        bookRows[i].style.display = '';
                    }

                    // Add an event listener to the book search input
                    searchInputBook.addEventListener('input', function () {
                        const searchTerm = searchInputBook.value.toLowerCase();
                        let matchCount = 0;

                        // Loop through each row in the books table
                        Array.from(bookRows).forEach(row => {
                            const bookTitle = row.cells[0].textContent.toLowerCase();
                            const bookAuthor = row.cells[1].textContent.toLowerCase();

                            // Check if the row matches the search term
                            if (bookTitle.includes(searchTerm) || bookAuthor.includes(searchTerm)) {
                                row.style.display = '';
                                matchCount++;
                            } else {
                                row.style.display = 'none';
                            }
                        });

                        // If no search term, show only first 25
                        if (searchTerm === '') {
                            Array.from(bookRows).forEach((row, index) => {
                                row.style.display = index < 25 ? '' : 'none';
                            });
                        }
                    });
                </script>

                            <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                let scanner = null;
                                // Pre-load the audio
                                const audio = document.getElementById('scanSound');
                                // Create audio context on user interaction
                                let audioContext = null;

                                window.startScanner = async function() {
                                    try {
                                        // Initialize scanner only if not already created
                                        if (!scanner) {
                                            scanner = new Instascan.Scanner({
                                                video: document.getElementById('scanner'),
                                                scanPeriod: 5,
                                                mirror: false
                                            });

                                            scanner.addListener('scan', function(content) {
                                                try {
                                                    // Find and check the checkbox corresponding to the scanned book ID
                                                    const checkbox = document.querySelector(`input[name="books[]"][value="${content}"]`);
                                                    if (checkbox) {
                                                        // Uncheck all other checkboxes first
                                                        document.querySelectorAll('input[name="books[]"]').forEach(box => {
                                                            box.checked = false;
                                                        });
                                                        checkbox.checked = true;
                                                        
                                                        // Close camera modal and open confirmation modal
                                                        const cameraModal = bootstrap.Modal.getInstance(document.getElementById('cameraBookModal'));
                                                        if (cameraModal) cameraModal.hide();
                                                        
                                                        const borrowModal = new bootstrap.Modal(document.getElementById('borrowModal'));
                                                        borrowModal.show();
                                                    } else {
                                                        alert('Book not found in the list!');
                                                    }
                                                } catch (error) {
                                                    console.error('Error handling scan:', error);
                                                }
                                            });
                                        }

                                        // Get cameras and start scanner
                                        const cameras = await Instascan.Camera.getCameras();
                                        if (cameras.length > 0) {
                                            // Prefer back camera if available
                                            const selectedCamera = cameras[cameras.length - 1];
                                            await scanner.start(selectedCamera);
                                            
                                            const modal = new bootstrap.Modal(document.getElementById('cameraBookModal'));
                                            modal.show();
                                        } else {
                                            throw new Error('No cameras found on your device.');
                                        }
                                    } catch (error) {
                                        console.error('Scanner error:', error);
                                        alert('Error accessing camera: ' + error.message);
                                    }
                                };

                                // Clean up scanner when modal is closed
                                document.getElementById('cameraBookModal')?.addEventListener('hidden.bs.modal', function() {
                                    if (scanner) {
                                        scanner.stop().catch(console.error);
                                    }
                                });
                            });
                            </script>

                        <style>
                        /* Add some animation to the frame */
                        @keyframes pulse {
                            0% { opacity: 0.8; }
                            50% { opacity: 0.5; }
                            100% { opacity: 0.8; }
                        }

                        .modal-body .text-center > div > div:not(#scanner) {
                            animation: pulse 2s infinite;
                        }
                        </style>


                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                const checkboxes = document.querySelectorAll('input[type="checkbox"][name="books[]"]');
                                
                                checkboxes.forEach(function(checkbox) {
                                    checkbox.addEventListener('click', function() {
                                        checkboxes.forEach(function(otherCheckbox) {
                                            if (otherCheckbox !== checkbox) {
                                                otherCheckbox.checked = false;
                                            }
                                        });
                                    });
                                });
                            });
                        </script>

                        <script>
                             document.addEventListener('DOMContentLoaded', function () {
                                const today = new Date();
                                
                                // Function to set date limits based on book section
                                function updateDateLimits() {
                                    const selectedBook = document.querySelector('input[name="books[]"]:checked');
                                    if (!selectedBook) return;
                                    
                                    const row = selectedBook.closest('tr');
                                    const bookSection = row.getAttribute('data-section'); // We'll need to add this attribute to the book rows
                                    
                                    const dd = String(today.getDate()).padStart(2, '0');
                                    const mm = String(today.getMonth() + 1).padStart(2, '0');
                                    const yyyy = today.getFullYear();
                                    
                                    const minDate = yyyy + '-' + mm + '-' + dd;
                                    
                                    // Calculate max date based on section
                                    let maxDays = bookSection === 'fiction' ? 5 : 2; // 5 days for fiction, 2 for others
                                    const maxDate = new Date(today);
                                    maxDate.setDate(today.getDate() + maxDays);
                                    const maxDD = String(maxDate.getDate()).padStart(2, '0');
                                    const maxMM = String(maxDate.getMonth() + 1).padStart(2, '0');
                                    const maxYYYY = maxDate.getFullYear();
                                    
                                    const dateInput = document.getElementById('recipient-name');
                                    dateInput.setAttribute('min', minDate);
                                    dateInput.setAttribute('max', `${maxYYYY}-${maxMM}-${maxDD}`);
                                }

                                // Add event listeners to book checkboxes
                                const bookCheckboxes = document.querySelectorAll('input[name="books[]"]');
                                bookCheckboxes.forEach(checkbox => {
                                    checkbox.addEventListener('change', updateDateLimits);
                                });

                                // Initial setup
                                updateDateLimits();
                            });
                        </script>

                    <script>
                        // Get the modal
                        var modal = document.getElementById('signupModal');

                        // Function to open the modal
                        function openModal() {
                            modal.style.display = 'block';
                        }

                        // Close the modal when user clicks outside of it
                        window.onclick = function(event) {
                            if (event.target == modal) {
                                modal.style.display = 'none';
                            }
                        }
                    </script>  

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                        // Update selected book in modal when checkbox is clicked
                        const bookCheckboxes = document.querySelectorAll('input[name="books[]"]');
                        bookCheckboxes.forEach(checkbox => {
                            checkbox.addEventListener('change', function() {
                                if (this.checked) {
                                    const bookTitle = this.closest('tr').cells[0].textContent;
                                    const bookAuthor = this.closest('tr').cells[1].textContent;
                                    document.getElementById('selectedBookDisplay').textContent = 
                                        `${bookTitle} by ${bookAuthor}`;
                                }
                            });
                        });

                        // Update selected user in modal when radio button is clicked
                        const userRadios = document.querySelectorAll('input[name="user_id"]');
                        userRadios.forEach(radio => {
                            radio.addEventListener('change', function() {
                                if (this.checked) {
                                    const idNumber = this.closest('tr').cells[0].textContent;
                                    const userName = this.closest('tr').cells[1].textContent;
                                    document.getElementById('selectedUserDisplay').textContent = 
                                        `${idNumber} - ${userName}`;
                                }
                            });
                        });

                        // Update modal when it's opened
                        const borrowModal = document.getElementById('borrowModal');
                        borrowModal.addEventListener('show.bs.modal', function() {
                            // Update book display
                            const selectedBook = document.querySelector('input[name="books[]"]:checked');
                            if (selectedBook) {
                                const bookTitle = selectedBook.closest('tr').cells[0].textContent;
                                const bookAuthor = selectedBook.closest('tr').cells[1].textContent;
                                document.getElementById('selectedBookDisplay').textContent = 
                                    `${bookTitle} by ${bookAuthor}`;
                            }

                            // Update user display
                            const selectedUser = document.querySelector('input[name="user_id"]:checked');
                            if (selectedUser) {
                                const idNumber = selectedUser.closest('tr').cells[0].textContent;
                                const userName = selectedUser.closest('tr').cells[1].textContent;
                                document.getElementById('selectedUserDisplay').textContent = 
                                    `${idNumber} - ${userName}`;
                            }
                        });
                    });
                    </script>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            // Safely handle DOM manipulations
                            const initializeUI = () => {
                                const elements = document.querySelectorAll('[data-toggle="tooltip"]');
                                if (elements.length > 0) {
                                    elements.forEach(element => {
                                        // Only clone if element exists
                                        if (element) {
                                            const clone = element.cloneNode(true);
                                            // Additional tooltip initialization if needed
                                        }
                                    });
                                }
                            };

                            // Initialize UI elements after DOM is loaded
                            initializeUI();

                            // Optional: Handle dynamic content
                            const observer = new MutationObserver(() => {
                                initializeUI();
                            });

                            // Observe the body for changes
                            observer.observe(document.body, {
                                childList: true,
                                subtree: true
                            });
                        });
                    </script>
@endsection