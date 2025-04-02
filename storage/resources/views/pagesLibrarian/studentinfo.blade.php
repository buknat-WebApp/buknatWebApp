@extends('layouts.app')

@section('content')
    <div class="mx-5 mt-4">
        <div class="card-body ">
            <div class="row gx-4">

            <td class="align-middle text-center">

            <div class="col-auto my-auto">
                 <a target="_blank" class="avatar avatar-xxl position-relative"
                    href="{{ asset('storage/avatar/' . $student->id . '/' . $student->avatar) }}">
                     @if($student->avatar)
                          <img src="{{ asset('storage/avatar/' . $student->id . '/' . $student->avatar) }}"
                               alt="Image" class="w-75 h-75 border-radius-lg shadow-sm object-fit-cover border rounded">
                       @else
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQGhmTe4FGFtGAgbIwVBxoD3FmED3E5EE99UGPItI0xnQ&s"
                              alt="Image" class="w-75 h-75 border-radius-lg shadow-sm object-fit-cover border rounded">
                      @endif
                 </a>
                        <input type="text" id="avatar" name="avatar"
                         value="{{ $student->avatar }}" hidden>
            </div>
                                                            
                <div class="col-auto my-auto text-white">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ $student->name }}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            <strong> Id Number: </strong> : {{ $student->id_number }}.
                        </p>
                    </div>
                </div>

                <div class="container-fluid py-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header pb-0">
                                    <div class="d-flex align-items-center">
                                        <p class="mb-0">Edit Student Info</p>
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

                                    <form method="POST" action="{{ route('studentUpdate', ['student' => $student->id]) }}">
                                        @csrf
                                        @method('PUT')

                                        <div class="row">
                                            <div class="col col-md-5">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">Name</label>
                                                    <input class="form-control" name="name" type="text" value="{{ $student->name }}" disabled>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">LRN Number</label>
                                                    <input class="form-control" name="id_number" type="text" value="{{ $student->id_number }}" disabled>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">Grade Level</label>
                                                    <select class="form-control" name="grade_and_section" type="text">
                                                        <option value="{{ $student->grade_and_section }} {{ $student->last_grade_level }}">{{ $student->grade_and_section }} {{ $student->last_grade_level }}</option>
                                                        <!-- <option value=""></option> -->
                                                        <option value="Grade 7">Grade 7</option>
                                                        <option value="Grade 8">Grade 8</option>
                                                        <option value="Grade 9">Grade 9</option>
                                                        <option value="Grade 10">Grade 10</option>
                                                        <option value="Grade 11">Grade 11</option>
                                                        <option value="Grade 12">Grade 12</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">Section</label>
                                                    <input class="form-control" name="section" type="text" value="{{ $student->section }}" disabled>
                                                </div>
                                            </div>
                                            
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                    <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Email</label>
                                                        <input class="form-control" name="email" type="email" value="{{ $student->email }}" disabled>
                                                    </div>
                                                </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">Contact Number</label>
                                                    <input class="form-control" name="contact_number" type="text" value="{{ $student->contact_number }}" disabled>
                                                </div>
                                            </div>
                                            
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">Birthdate</label>
                                                    <input class="form-control" name="birthdate" type="date" value="{{ $student->birthdate }}" disabled>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">Status:</label>
                                                    <select class="form-select form-control" id="status" name="status">
                                                        <option value="active" {{ $student->status == 'active' ? 'selected' : '' }}>Active</option>
                                                        <option value="inactive" {{ $student->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                                        <option value="graduated" {{ $student->status == 'graduated' ? 'selected' : '' }}>Graduated</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <a href="{{ route('accountLists') }}" class="btn btn-sm form-control mt-4 btn-secondary">Cancel</a>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-sm form-control mt-4 btn-success">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <a href="{{ route('regenerateQrCode', ['student' => $student->id]) }}" class="btn btn-primary btn-sm mb-0"
                                                onclick="return confirm('Are you sure you want this student to regenerate QR Code? This may take a while.');">
                                                <i class="fas fa-sync"></i> Regenerate QR Code
                                            </a>
                                        </div>
                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
