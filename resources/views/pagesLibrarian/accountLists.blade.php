@extends('layouts.app')

@section('content')
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                           All Students
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            In this page you will see all the students with activated accounts.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="column-gap-4 nav nav-pills nav-fill p-1">
                            <div class="dropdown">
                                <button class="ni-circle-08 btn dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    All Pending Users
                                </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li><a class="dropdown-item" href="{{ route('accountPending') }}">Pending Students</a></li>  
                                        <li><a class="dropdown-item" href="{{ route('accountPendingTeacher') }}">Pending Teachers</a></li>  
                                    </ul>
                            </div>
                            <div class="dropdown">
                                <button class="ni ni-bullet-list-67 btn dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                All Students List   
                                </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item" href="{{ route('accountLists') }}">All Students List</a></li>
                                        <li><a class="dropdown-item" href="{{ route('accountListsTeacher') }}">All Teachers List</a></li>
                                    </ul>
                            </div>

                        </ul>
                    </div>
                </div>

                <div class="container-fluid py-0 mt-2">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-12">
                                <div class="card mb-4">
                                    <div class="card-body px-0 pt-0 pb-2">
                                        <div class="table-responsive p-0">

                                            <table class="table align-items-center mb-0" id="mytable">

                                                <thead>
                                                    <tr>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Photo</th>
                                                    
                                                        <th
                                                            class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            ID Number</th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                            Name</th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Grade</th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                            Section</th>

                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Account Status</th>

                                                        <th></th>
                                                        <th></th>
                                                        <th></th>

                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($students as $student)
                                                        <tr>
                                                            <td class="align-middle text-center">

                                                                <a target="_blank" class="avatar avatar-xxl position-relative"
                                                                   href="{{ asset('storage/avatar/' . $student->avatar) }}">
                                                                    @if($student->avatar)
                                                                        <img src="{{ asset('storage/avatar/' . $student->avatar) }}"
                                                                             alt="Image" class="w-75 h-75 border-radius-lg shadow-sm object-fit-cover border rounded">
                                                                    @else
                                                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQGhmTe4FGFtGAgbIwVBxoD3FmED3E5EE99UGPItI0xnQ&s"
                                                                             alt="Image" class="w-75 h-75 border-radius-lg shadow-sm object-fit-cover border rounded">
                                                                    @endif

                                                                </a>
                                                                <input type="text" id="avatar" name="avatar"
                                                                       value="{{ $student->avatar }}" hidden>
                                                            </td>
                                                            
                                                            <td>
                                                                <div class="d-flex px-2 py-1">
                                                                    <div class="d-flex flex-column justify-content-center">
                                                                        <h6 id="id_number" class="text-start mb-0 text-sm">
                                                                            {{ $student->id_number }}
                                                                        </h6> 
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <p id="name" class="text-xs font-weight-bold mb-0">
                                                                    {{ $student->name  ?? ''}}
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <p id="grade" class="text-center text-xs font-weight-bold mb-0">
                                                                    {{ $student->grade_and_section }} {{ $student->last_grade_level }}
                                                                </p>
                                                            </td>

                                                            <td>
                                                                <div class="d-flex px-2 py-1">
                                                                    <div class="d-flex flex-column justify-content-center">
                                                                        <h6 id="section" class="text-start mb-0 text-sm">
                                                                            {{ $student->section }}
                                                                        </h6> 
                                                                    </div>
                                                                </div>
                                                            </td>

                                                            <td class="align-middle text-center text-sm">
                                                                <span class="badge badge-sm 
                                                                    {{ $student->isGraduated() ? 'bg-gradient-secondary' : ($student->isInactive() ? 'bg-gradient-danger' : 'bg-gradient-success') }}">
                                                                    {{ $student->isGraduated() ? 'Graduated' : ($student->isInactive() ? 'Inactive' : 'Active') }}
                                                                </span>
                                                            </td>
                                                            
                                                            <td class="">
                                                                <a href="{{ route('studentDetails', ['student' => $student->id]) }}"
                                                                    class="" data-bs-placement="top" title="Manage Student">
                                                                    <span class="fas fa-edit btn bg-light bg-gradient"> Info</span></a>
                                                            </td>

                                                            <td class="">
                                                                <a href="{{ asset('storage/StudentQrCodes/' . $student->id.'.png') }}" target="_blank"
                                                                    onclick="printImage('{{ asset('storage/StudentQrCodes/' . $student->id.'.png') }}'); return false;">
                                                                    <span class="fas fa-print btn bg-warning bg-gradient"> Print QR</span> 
                                                                 </a>

                                                            </td> 

                                                            <td class="">                                         
                                                                    <a  href="{{ asset('storage/StudentQrCodes/' . $student->id .'.png') }}"
                                                                    onclick="downloadQR('{{ asset('storage/StudentQrCodes/' . $student->id .'.png') }}'); return false;">
                                                                    <p class="fas fa-download btn bg-primary bg-gradient"> Download QR</p> 
                                                                </a>    
                                                            </td> 

                                                        </tr>

                                                        </form>
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

        function downloadQR(imageUrl) {
            const link = document.createElement('a');
            link.href = imageUrl;
            link.download = 'QR {{ $student->id_number }}.png';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    </script>
@endsection