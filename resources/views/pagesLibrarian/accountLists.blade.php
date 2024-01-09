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
                        <ul class="nav nav-pills nav-fill p-1">
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center"
                                    href="{{ route('accountPending') }}">
                                    <i class="ni ni-circle-08"></i>
                                    <span class="ms-2">Pending</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center btn"
                                    href="{{ route('accountLists') }}">
                                    <i class="ni ni-lock-circle-open"></i>
                                    <span class="ms-2">All Lists</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>


                <div class="container-fluid py-4 mt-2">
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
                                                            ID Picture</th>
                                                        <th
                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            ID Number</th>
                                                        <th
                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                            Name</th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Grade</th>

                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Account Status</th>

                                                        <th></th>

                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($students as $student)
                                                        <tr>
                                                            <td class="align-middle text-center">

                                                                <a target="_blank"
                                                                    href="{{ Storage::url('IDPic/' . $student->id_pic) }}">
                                                                    <img src="{{ Storage::url('IDPic/' . $student->id_pic) }}"
                                                                        alt="Image" width="100px" height="100px">
                                                                </a>
                                                                <input type="text" id="id_pic" name="id_pic"
                                                                    value="{{ $student->id_pic }}" hidden>

                                                            </td>
                                                            <td>
                                                                <div class="d-flex px-2 py-1">
                                                                    <div class="d-flex flex-column justify-content-center">
                                                                        <h6 id="id_number" class="mb-0 text-sm">
                                                                            {{ $student->id_number }}l
                                                                        </h6>
                                                                        <p id="id"
                                                                            class="text-xs text-secondary mb-0">
                                                                            {{ $student->id }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <p id="name" class="text-xs font-weight-bold mb-0">
                                                                    {{ $student->name }}
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <p id="grade" class="text-xs font-weight-bold mb-0">
                                                                    {{ $student->grade_and_section }}
                                                                </p>
                                                            </td>

                                                            <td class="align-middle text-center text-sm">
                                                                <span
                                                                    class="badge badge-sm bg-gradient-success">active</span>

                                                            </td>

                                                            <td class="">
                                                                <a href="{{ asset('storage/StudentQrCodes/' . $student->id.'.png') }}" target="_blank"
                                                                    onclick="printImage('{{ asset('storage/StudentQrCodes/' . $student->id.'.png') }}'); return false;">
                                                                    <span class="fas fa-print"></span> Print QR
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
        </script>
@endsection
