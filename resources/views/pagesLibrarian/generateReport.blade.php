@extends('layouts.app')

@section('content')
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="row gx-4">

                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">

                        </p>
                    </div>
                    <p class="mb-0 font-weight-bold text-sm"><strong> Generate Report </strong>
                    </p>
                </div>

            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('printGeneratedReport') }}">
        @csrf


        <div class="container-fluid py-2">
            <div class="row mt-3">
                <div class="col-3">
                    <p class="text-center font-weight-bold">
                        Select a User
                    </p>
                </div>
                    <div class="col-5 text-center font-weight-bold">
                        <select class="form-control custom-select" id="usersType" name="usersType">  
                            <option value="students">Student</option>
                            <option value="teachers">Teacher</option>
                            <option value="all">All User</option>
                            <option value="guests">Guests</option>  
                        </select>
                    </div>
            </div>

            <div class="row mt-3">
                <div class="col-3">
                    <p class="text-center font-weight-bold">
                        Select a report
                    </p>
                </div>
                <div class="col-5 text-center font-weight-bold">
                    <select class="form-control custom-select" id="reportType" name="reportType">
                        <option value="attendanceLogs">Attendance Log</option>
                        <option value="borrowed">Borrowed Books</option>
                        
                    </select>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-3">
                    <p class="text-center font-weight-bold">
                        Select Type
                    </p>
                </div>
                <div class="col-5 text-center font-weight-bold">
                    <select class="form-control custom-select" id="itemType" name="itemType">
                        <option value=""></option>
                        <option value="sequence">Monthly Report of book/s Borrowed</option>
                        <option value="overAll">Summary of Book/s Borrowed</option>
                        <option value="sequenceFines">Fines</option>
                    </select>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-3">
                    <p class="text-center font-weight-bold">Select Section</p>
                </div>
                <div class="col-5 text-center font-weight-bold">
                    <select class="form-control custom-select" id="sectionType" name="sectionType">
                        <option value=""></option>
                        @foreach($sections as $section)
                            <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-3">
                    <p class="text-center font-weight-bold">Select Location</p>
                </div>
                <div class="col-5 text-center font-weight-bold">
                    <select class="form-control custom-select" id="locationType" name="locationType">
                        <option value=""></option>
                        @foreach($locations as $locate)
                            <option value="{{ $locate->id }}">{{ $locate->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mt-3">
               <div class="col-3">
                    <p class="text-center font-weight-bold">Select Author</p>
                </div>
                <div class="col-5 text-center font-weight-bold">
                    <select class="form-control custom-select" id="authorType" name="authorType">
                        <option value=""></option>
                        @foreach($authors as $author)
                            <option value="{{ $author->id }}">{{ $author->author }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-3">
                    <p class="text-center font-weight-bold">
                        Select Type
                    </p>
                </div>
                    <div class="col-5 text-center font-weight-bold">
                        <select class="form-control custom-select" id="logType" name="logType">
                            <option value=""></option>
                            <option value="monthly_record">Monthly Statistics of Library Users</option>
                            <option value="general_record">Monthly Summary of Library Users by Grade Level</option>
                            <option value="top3">Top 3 Library Users</select>
                    </div>
            </div>


            <div class="row mt-2">

                <div class="col-3">
                    <p class="text-center font-weight-bold">    
                        From:
                    </p>
                </div>
                <div class="col-3 text-center font-weight-bold">
                    <input class="form-control " type="date" id="check1" name="from_date">
                </div>
         
                
                <div class="col-1">
                    <p class="text-center font-weight-bold">
                        To:
                    </p>
                </div>
                <div class="col-3 text-center font-weight-bold">
                    <input class="form-control " type="date" id="check2" name="to_date">
                </div>
            </div>


        </div>

        <div class="row justify-content-center mt-2">
            <div class=" col-11">
                <a style="display: block; width: 300px; margin: 0 auto;" class="btn btn-sm mt-4 btn-success" href="#changePass" data-bs-toggle="modal">Generate
                    Report</a>
            </div>
        </div>

        <!-- Change Pass  -->
        <div class="modal fade" id="changePass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Print Report?</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-center">
                            Do you want to Proceed in Printing?
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


    </form>
    <script>
      $(document).ready(function () {
    $('#sectionType').on('change', function () {
        const sectionId = $(this).val();

        if (sectionId) {
            $.ajax({
                url: "{{ route('fetchLocationsAndAuthors') }}", // Laravel route
                type: "GET",
                data: { section_id: sectionId },
                success: function (data) {
                    // Update the locations dropdown
                    const locationSelect = $('#locationType');
                    locationSelect.empty().append('<option value=""></option>');
                    data.locations.forEach(location => {
                        locationSelect.append(`<option value="${location.id}">${location.name}</option>`);
                    });

                    // Update the authors dropdown
                    const authorSelect = $('#authorType');
                    authorSelect.empty().append('<option value=""></option>');
                    data.authors.forEach(author => {
                        authorSelect.append(`<option value="${author.id}">${author.author}</option>`);
                    });
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                    alert('Failed to fetch data. Please try again.');
                }
            });
        } else {
            // Clear dropdowns if no section is selected
            $('#locationType, #authorType').empty().append('<option value=""></option>');
        }
    });
    
});

    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Reference to the report type dropdown
        const reportTypeSelect = document.getElementById('reportType');

        // References to the rows to hide (excluding the first row with "Select a report")
        const rowsToHide = [
            document.querySelector('.row:nth-of-type(3)'), // Select type row
            document.querySelector('.row:nth-of-type(4)'), // Select Section row
            document.querySelector('.row:nth-of-type(5)'), // Select Location row
            document.querySelector('.row:nth-of-type(6)')  // Select Author row
        ];

        // Initially hide all rows
        rowsToHide.forEach(row => row.style.display = 'none');

        // Function to toggle visibility based on selected report type
        function toggleVisibility() {
            const selectedValue = reportTypeSelect.value;

            if (selectedValue === '' || selectedValue === 'attendanceLogs') {
                // Hide rows if no report is selected or Attendance Logs is selected
                rowsToHide.forEach(row => row.style.display = 'none');
            } else {
                // Show rows for other report types
                rowsToHide.forEach(row => row.style.display = 'flex');
            }
        }

        // Add event listener to report type dropdown
        reportTypeSelect.addEventListener('change', toggleVisibility);
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const reportTypeSelect = document.getElementById('reportType');
        const logTypeRow = document.querySelector('.row:nth-of-type(7)'); // Select logType row

        function toggleLogTypeVisibility() {
            const selectedValue = reportTypeSelect.value;
            if (selectedValue === 'borrowed') {
                logTypeRow.style.display = 'none';
            } else {
                logTypeRow.style.display = 'flex';
            }
        }

        reportTypeSelect.addEventListener('change', toggleLogTypeVisibility);
        toggleLogTypeVisibility(); // Initial call to set the correct state on page load
    });
</script>


@endsection

