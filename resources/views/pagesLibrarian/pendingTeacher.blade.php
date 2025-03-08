@extends('layouts.app')

@section('content')
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                           All Teachers
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            In this page you will see all the teachers with activated accounts.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="column-gap-4 nav nav-pills nav-fill p-1">
                            <div class="dropdown">
                                <button class="ni-circle-08 btn dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    Pending Teachers
                                </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li><a class="dropdown-item" href="{{ route('accountPending') }}">Pending Student</a></li>  
                                    </ul>
                            </div>
                            <div class="dropdown">
                                <button class="ni ni-bullet-list-67 btn dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    All Users List
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

                                           @if (session('successApprove'))
                                                    <div class="alert-success alert-dismissible fade show" role="alert">

                                                        <p class="text-center text-white">
                                                            {{ session('successApprove') }}
                                                        </p>
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">x</button>
                                                      </div>
                                            @elseif (session('successDelete'))
                                                    <div class="alert-success alert-dismissible fade show" role="alert">

                                                        <p class="text-center text-white">
                                                            {{ session('successDelete') }}
                                                        </p>
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">x</button>
                                                  </div>
                                                  @else
                                            @endif

                                            <table class="table align-items-center mb-0" id="mytable">

                                                <thead>
                                                    <tr>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Photo</th>
                                                        <th
                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            ID Number</th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                            Name</th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Grade Level</th>

                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Account Status</th>
                                                        <th>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($pendingTeachers as $teacher)
                                                        <tr>
                                                        <td class="align-middle text-center">

                                                            @if($teacher->avatar)
                                                                <a target="_blank"
                                                                href="{{ asset('storage/avatar/' . $teacher->avatar) }}">
                                                                    <img src="{{ asset('storage/avatar/' . $teacher->avatar) }}"
                                                                        alt="Image" width="100px" height="100px">
                                                                </a>
                                                                <input type="text" id="avatar" name="avatar"
                                                                    value="{{ $teacher->avatar }}" hidden>
                                                            @endif
                                                            </td>         
                                                            <td>
                                                                <div class="d-flex px-2 py-1">
                                                                    <div class="d-flex flex-column justify-content-center">
                                                                        <h6 id="id_number" class="mb-0 text-sm">
                                                                            {{ $teacher->id_number }}
                                                                        </h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <p id="name" class="text-center text-xs font-weight-bold mb-0">
                                                                    {{ $teacher->name }}
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <p id="office_or_department" class="text-xs text-center font-weight-bold mb-0">
                                                                    {{ $teacher->office_or_department }}
                                                                </p>
                                                            </td>

                                                            <td class="align-middle text-center text-sm">
                                                                <span
                                                                    class="badge badge-sm bg-gradient-danger">inactive</span>

                                                            </td>                                                           
                                                            <td class="">

                                                                <a type="button" class="btn btn-success btn-sm"
                                                                    title="Approve Teacher?" href="#approve"
                                                                    data-bs-toggle="modal" onclick="approveTeacher(this)"
                                                                    data-ID="{{ $teacher->id }}"
                                                                    data-idNumber="{{ $teacher->id_number }}"
                                                                    data-named="{{ $teacher->name }}"
                                                                    data-office="{{ $teacher->office_or_department }}">
                                                                    <i class="fas fa-edit"></i> Approve</a>
                                                                <a type="button" class="btn btn-sm"
                                                                    title="Delete this Teacher?" href="#delete"
                                                                    data-bs-toggle="modal" onclick="deleteTeacher(this)"
                                                                    data-ID2="{{ $teacher->id }}"
                                                                    data-idFile="{{ $teacher->avatar }}">
                                                                    <i class="fas fa-trash"></i> Delete</a>

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

    <!-- Modal -->
    <div class="modal fade" id="approve" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Validation</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-center">
                        Do you want to confirm this account?
                    </p>
             
                    <form method="POST" action="{{ route('confirmAccountTeacher') }}">
                        @csrf
                        @method('PUT')
                        <input type="text" id="ids" name="id_account" hidden>

                        <label for="named">Name:</label>
                            <input type="text" id="named" name="name" class="form-control" required>
                        <label for="name">ID Number:</label>
                            <input type="number" name="id_number" class="form-control" id="idNumber" required>
                
                        <div class="row">
                        <div class="col">
                            <label for="office" class="text-warning">Grade Level Teacher Selected</label>
                            <input type="text" class="form-control" name="" id="office">
                        </div>
                        <div class="col">
                            <label for="office">Kindly Re- Select</label>
                            <select id="office" name="office_or_department" class="form-control" required>
                                <option value="Teacher">Teacher</option>
                            </select>
                            <input type="number" value="1" hidden>
                        </div>
                    </div>
                        

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success ">Confirm</button>
                </div>
                </form>
                </div>
            </div>
        </div>

    <!-- Delete Student -->
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete this Account?</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-center">
                        Do you want to Proceed in deleting this account?
                    </p>

                    <form method="POST" action="{{ route('deleteAccountTeacher') }}" >
                    @csrf
                    @method('DELETE')
                    <input type="text" id="ids2" name="id_account" hidden>
                    <input type="text" id="idFile" name="idFile" hidden>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning ">Proceed</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        function approveTeacher(that) {
            ids = $(that).attr('data-ID');
            idNumber = $(that).attr('data-idNumber');
            named = $(that).attr('data-named');
            office = $(that).attr('data-office');

            $('#ids').val(ids)
            $('#idNumber').val(idNumber)
            $('#named').val(named)
            $('#office').val(office)
        }

        function deleteTeacher(that) {
            ids2 = $(that).attr('data-ID2');
            idFile = $(that).attr('data-idFile');

            $('#ids2').val(ids2)
            $('#idFile').val(idFile)

        }
    </script>
@endsection
