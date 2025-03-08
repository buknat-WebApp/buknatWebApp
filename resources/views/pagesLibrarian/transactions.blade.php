@extends('layouts.app')

@section('content')
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="row gx-4">

                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                           Student Transactions
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            Only the validated students and with transaction will show in this panel.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1">


                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center btn"
                                href="{{ route('studentTransactions') }}">
                                    <i class="ni ni-archive-2"></i>
                                    <span class="ms-2">Transaction Lists</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="mb-0 px-0 py-1 d-flex align-items-center justify-content-center btn "
                         href="transaction/logs">
                                    <i class="ni ni-collection"></i>
                                    <span class="ms-2">Login Lists</span>
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

                                            <table class="table align-items-center" id="mytable">

                                            <thead>
                                                    <tr>
                                                        <th
                                                            class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="padding-left: 5em;">
                                                            Pic</th>
                                                        <th
                                                            class="text-uppercase text-start text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Id Number</th>
                                                        <th
                                                            class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Name</th>
                                                        <th
                                                            class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Grade</th>
                                                        <th
                                                            class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Section</th>

                                                        {{-- <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Borrowed Date</th> 

                                                            <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Expected Return Date</th> --}}

                                                        <th></th>

                                                    </tr>
                                                </thead>
                                                <tbody>

                                                @foreach ($students as $student)
                                                    @if ($student['transactions']->isNotEmpty())
                                                        <tr>
                                                            <td class="align-middle text-start">

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
                                                                        <h6 id="id_number" class="mb-0 text-sm text-start">{{ $student->id_number }}</h6>
                                                                        {{-- <p id="id" class="text-xs text-secondary mb-0">{{ $student->id }}</p> --}}
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <p id="name" class="text-xs font-weight-bold mb-0">{{ $student->name }}</p>
                                                            </td>
                                                            <td>
                                                                <p id="grade" class="text-xs font-weight-bold mb-0">{{ $student->grade_and_section }}</p>
                                                            </td>
                                                            <td>
                                                                <p id="section" class="text-start text-xs font-weight-bold mb-0">{{ $student->section }}</p>
                                                            </td>
                                                            {{-- <td class="align-middle text-center text-sm">
                                                                <p id="grade" class="text-xs font-weight-bold mb-0">
                                                                    {{ $student['transactions']->first()->borrowed_at }}
                                                                </p>
                                                            </td>
                                                            <td class="align-middle text-center text-sm">
                                                                <p id="grade" class="text-xs font-weight-bold mb-0">
                                                                    {{ $student['transactions']->first()->expected_return_date }}
                                                                </p>
                                                            </td> --}}
                                                            <td class="">
                                                                <a href="{{ route('transaction', ['id' => $student->id]) }}">
                                                                    <span class="fas fa-eye"></span> Transaction
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endif
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
