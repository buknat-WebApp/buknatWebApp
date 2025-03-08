@extends('layouts.app')

@section('content')
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        @if( Auth::user()->avatar)
                            <img src="{{ asset('storage/avatar/' . Auth::user()->id . '/' . Auth::user()->avatar) }}" alt="profile_image" class="w-100 h-100 border-radius-lg shadow-sm object-fit-cover border rounded">
                        @else
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQGhmTe4FGFtGAgbIwVBxoD3FmED3E5EE99UGPItI0xnQ&s" class="w-100 h-100 border-radius-lg shadow-sm object-fit-cover border rounded" />
                        @endif
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1 font-weight-bold">
                            {{ Auth::user()->name }}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            @if (Auth::user()->role == 1)
                                Librarian
                            @elseif (Auth::user()->role == 0)
                                Student
                            @elseif (Auth::user()->role == 2)
                                Teacher
                            @endif
                        </p>
                    </div>
                </div>
                @if(Auth::user()->role == 0)
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            <a class="" href="{{ asset('storage/StudentQrCodes/' . Auth::user()->id.'.png') }}"
                                onclick="downloadQR('{{ asset('storage/StudentQrCodes/' . Auth::user()->id.'.png') }}'); return false;">
                                <p class="text-muted fas fa-download"></p> Download QR
                            </a>
                        </h5>
                    </div>
                </div>

                @elseif(Auth::user()->role == 2)
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            <a href="{{ asset('storage/TeacherQrCodes/' . Auth::user()->id.'.png') }}"
                                onclick="downloadQR('{{ asset('storage/TeacherQrCodes/' . Auth::user()->id.'.png') }}'); return false;">
                                <p class="fas fa-download"></p> Download QR
                            </a>
                        </h5>
                    </div>
                </div>
                @else

                @endif

            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('updateProfile') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="container-fluid py-2">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8 d-flex ">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <p class="mb-0 text-uppercase">

                                </p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">

                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Name</label>
                                        <input class="form-control" type="text" name="name" id="name" value="{{ Auth::user()->name }}" >
                                    </div>
                                    
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="avatar">
                                            Photo
                                        </label>
                                        <input class="form-control" type="file" name="avatar" id="avatar">
                                    </div>
                                </div>

                                @if(Auth::user()->role == 1)

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="check1">
                                            ID Number
                                        </label>
                                        <input class="form-control" type="number" id="id_number" name="id_number" value="{{ Auth::user()->id_number }}">
                                    </div>
                                </div>
                                
                                @else
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="check1">
                                            ID Number
                                        </label>
                                        <input class="form-control" type="text" id="check1" value="{{ Auth::user()->id_number }}" disabled>
                                    </div>
                                </div>
                                @endif

                                @if(Auth::user()->role == 0)

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Grade</label>
                                        <input class="form-control" type="text" name="grade_and_section" id="grade_and_section" value="{{ Auth::user()->grade_and_section}}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Section</label>
                                        <input class="form-control" type="text" name="section" id="section" value="{{ Auth::user()->section }}">
                                    </div>
                                </div>

                                @elseif(Auth::user()->role == 2)

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Grade Level Teacher</label>
                                        <input class="form-control" type="text" name="office_or_department" id="office_or_department" value="{{ Auth::user()->office_or_department}}">
                                    </div>
                                </div>

                                @else

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label"></label>
                                        <input class="form-control" type="text" name="office_or_department" id="office_or_department" value="{{ Auth::user()->office_or_department}}">
                                    </div>
                                </div>
                                @endif

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label class="form-control-label" for="check1">
                                            Email
                                        </label>
                                        <input class="form-control" type="email" name="email" id="email" value="{{ Auth::user()->email }}">
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Contact Number</label>
                                        <input class="form-control" type="text" name="contact_number" id="contact_number" value="{{ Auth::user()->contact_number }}">
                                    </div>
                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label class="form-control-label" for="check1">
                                            Birthdate
                                        </label>
                                        <input class="form-control" type="date" name="birthdate" id="birthdate" value="{{ Auth::user()->birthdate }}" >
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Address</label>
                                        <input class="form-control" type="text" name="address" id="address" value="{{ Auth::user()->address }}" >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-2">
            <div class=" col-4">
                <a class="btn btn-sm form-control mt-4 btn-success" href="#changeProfile" data-bs-toggle="modal">Update Profile</a>
            </div>
        </div>
        <!-- Change Profile  -->
        <div class="modal fade" id="changeProfile" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update your profile?</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-center">
                            Do you want to proceed in updating your profile?
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Proceed</button>

                    </div>
                </div>
            </div>

        </div>

    </form>

    <form method="POST" action="{{ route('updatePassword') }}">
        @csrf
        @method('PUT')

            <div class="container-fluid py-2">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-8 flex mt-4 ">
                        <div class="card col-span-full">
                            <div class="card-header pb-0">
                                <div class="d-flex align-items-center">
                                    <p class="mb-0 text-uppercase">

                                    </p>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label text-danger">OLD PASSWORD</label>
                                            <input class="form-control" type="password" name="oldPass" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">New Password</label>
                                            <input class="form-control" name="pass1" id="pass1" required
                                                type="password">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Confirm New Password</label>
                                            <input class="form-control" name="pass2" id="pass2" required
                                                type="password">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center mt-2">
                <div class=" col-4">
                    <a class="btn btn-sm form-control mt-4 btn-success" href="#changePass" data-bs-toggle="modal">Update Password</a>
                </div>
            </div>

            <!-- Change Pass  -->
            <div class="modal fade" id="changePass" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                 <div class="modal-dialog modal-md" role="document">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h5 class="modal-title" id="exampleModalLabel">Change the Pass?</h5>
                             <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                 aria-label="Close"></button>
                         </div>
                         <div class="modal-body">
                             <p class="text-center">
                                 Do you want to proceed in Changing your passsword?
                             </p>
                         </div>
                         <div class="modal-footer">
                             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                             <button type="submit" class="btn btn-success">Proceed</button>

                         </div>
                     </div>
                 </div>
            </div>
    </form>

    @if (session('error'))
        <script>
            alert("An error has occurred.");
        </script>
    @endif
    @if (session('success'))
        <script>
            alert("Profile updated successfully.");
        </script>
    @endif

    <script>
        function downloadQR() {
            var url = "{{ asset('storage/TeacherQrCodes/' . Auth::user()->id.'.png') }}";
            var filename = "QR {{ Auth::user()->id_number }}";

        var anotherUrl = "{{ asset('storage/StudentQrCodes/' . Auth::user()->id.'.png') }}";
        var anotherFilename = "QR {{ Auth::user()->id_number }}";
        if({{Auth::user()->role}} == 2){
        var a = document.createElement('a');
        a.href = url;
        a.download = filename;
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        }else{
            
        // Create another link for the second URL
        var b = document.createElement('a');
        b.href = anotherUrl;
        b.download = anotherFilename;
        document.body.appendChild(b);
        b.click();
        document.body.removeChild(b)
        }
    }
</script>


@endsection
