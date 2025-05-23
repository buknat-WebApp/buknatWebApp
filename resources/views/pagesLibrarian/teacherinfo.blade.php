@extends('layouts.app')

@section('content')
    <div class="mx-5 mt-4">
        <div class="card-body ">
            <div class="row gx-4">

            <td class="align-middle text-center">

            <div class="col-auto my-auto">
                 <a target="_blank" class="avatar avatar-xxl position-relative"
                    href="{{ asset('storage/avatar/' . $teacher->avatar) }}">
                    @if($teacher->avatar)
                          <img src="{{ asset('storage/avatar/' . $teacher->avatar) }}"
                               alt="Image" class="w-75 h-75 border-radius-lg shadow-sm object-fit-cover border rounded">
                       @else
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQGhmTe4FGFtGAgbIwVBxoD3FmED3E5EE99UGPItI0xnQ&s"
                              alt="Image" class="w-75 h-75 border-radius-lg shadow-sm object-fit-cover border rounded">
                      @endif
                 </a>
                        <input type="text" id="avatar" name="avatar"
                         value="{{ $teacher->avatar }}" hidden>
            </div>
                                                            
                <div class="col-auto my-auto text-white">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ $teacher->name }}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            <strong> Id Number: </strong> : {{ $teacher->id_number }}.
                        </p>
                    </div>
                </div>

                <div class="container-fluid py-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header pb-0">
                                    <div class="d-flex align-items-center">
                                        <p class="mb-0">Edit Teacher Info</p>
                                    </div>
                                </div>
                                <div class="card-body">
                                    @if (session('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <p class="text-center text-white">{{ session('success') }}</p>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">x</button>
                                        </div>
                                    @endif

                                    @if ($errors->any())
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">x</button>
                                        </div>
                                    @endif

                                    <form method="POST" action="{{ route('teacherUpdate', ['teacher' => $teacher->id]) }}">
                                        @csrf
                                        @method('PUT')

                                        <div class="row">
                                            <div class="col col-md-5">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">Name</label>
                                                    <input class="form-control @error('name') is-invalid @enderror" name="name" type="text" value="{{ old('name', $teacher->name) }}">
                                                    @error('name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">ID Number</label>
                                                    <input class="form-control @error('id_number') is-invalid @enderror" name="id_number" type="number" value="{{ old('id_number', $teacher->id_number) }}">
                                                    @error('id_number')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">Office/Department</label>
                                                    <select class="form-control @error('office_or_department') is-invalid @enderror" name="office_or_department">
                                                        <option value="{{ old('office_or_department', $teacher->office_or_department) }}" selected>{{ $teacher->office_or_department }}</option>
                                                    </select>
                                                    @error('office_or_department')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                    <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Email</label>
                                                        <input class="form-control" name="email" type="email" value="{{ $teacher->email }}" disabled>
                                                    </div>
                                                </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">Contact Number</label>
                                                    <input class="form-control" name="contact_number" type="text" value="{{ $teacher->contact_number }}" disabled>
                                                </div>
                                            </div>
                                            
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">Birthdate</label>
                                                    <input class="form-control" name="birthdate" type="date" value="{{ $teacher->birthdate }}" disabled>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">Status:</label>
                                                    <select class="form-select form-control @error('status') is-invalid @enderror" id="status" name="status">
                                                        <option value="active" {{ old('status', $teacher->status) == 'active' ? 'selected' : '' }}>Active</option>
                                                        <option value="inactive" {{ old('status', $teacher->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                                    </select>
                                                    @error('status')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <a href="{{ route('accountListsTeacher') }}" class="btn btn-sm form-control mt-4 btn-secondary">Cancel</a>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-sm form-control mt-4 btn-success">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    <form method="POST" action="{{ route('librarian.updatePasswordTeacher', ['teacher' => $teacher->id]) }}">
                                        @csrf
                                        @method('PUT')
                                        
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="new-password" class="form-control-label">New Password</label>
                                                    <input class="form-control" name="password" type="password" id="new-password" placeholder="Enter new password">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="confirm-password" class="form-control-label">Confirm Password</label>
                                                    <input class="form-control" name="password_confirmation" type="password" id="confirm-password" placeholder="Confirm new password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-sm form-control mt-4 btn-success">Update Password</button>
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
        </div>
    @endsection
