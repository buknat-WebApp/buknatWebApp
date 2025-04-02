<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Notifications\RegisterUser;
use function Laravel\Prompts\alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;


class AccountController extends Controller
{
    private function pixelateImage($imagePath, $blockSize = 10)
{
    // Get image info
    $imageInfo = getimagesize($imagePath);
    if (!$imageInfo) return false;

    // Create image from file based on type
    switch ($imageInfo[2]) {
        case IMAGETYPE_JPEG:
            $source = imagecreatefromjpeg($imagePath);
            break;
        case IMAGETYPE_PNG:
            $source = imagecreatefrompng($imagePath);
            break;
        case IMAGETYPE_GIF:
            $source = imagecreatefromgif($imagePath);
            break;
        default:
            return false;
    }

    // Get dimensions
    $width = imagesx($source);
    $height = imagesy($source);

    // Create pixelated version
    $temp = imagecreatetruecolor($width, $height);
    
    // Scale down
    $smallWidth = ceil($width / $blockSize);
    $smallHeight = ceil($height / $blockSize);
    
    $small = imagecreatetruecolor($smallWidth, $smallHeight);
    imagecopyresampled($small, $source, 0, 0, 0, 0, $smallWidth, $smallHeight, $width, $height);
    
    // Scale back up (pixelated)
    imagecopyresampled($temp, $small, 0, 0, 0, 0, $width, $height, $smallWidth, $smallHeight);
    
    // Save pixelated image
    switch ($imageInfo[2]) {
        case IMAGETYPE_JPEG:
            imagejpeg($temp, $imagePath, 90);
            break;
        case IMAGETYPE_PNG:
            imagepng($temp, $imagePath, 9);
            break;
        case IMAGETYPE_GIF:
            imagegif($temp, $imagePath);
            break;
    }

    // Clean up
    imagedestroy($source);
    imagedestroy($small);
    imagedestroy($temp);

    return true;
}

    public function index()
    {
        return view('pagesAuth.login');
        
    }

    public function loginForm()
    {
        return view('pagesAuth.login');
    }

    public function loginUser(Request $request)
    {
        $credentials = $request->only('id_number', 'password');
        $user = User::where('id_number', $credentials['id_number'])->first();

        $request->validate([
            'g-recaptcha-response' => 'required|recaptcha',
            'password' => 'required',
            'id_number' => 'required',
        ]);

        if ($user) {
            // Check if the password is correct
            if (Hash::check($credentials['password'], $user->password)) {
                Auth::attempt($credentials);
                if ($user->role == 0) {
                    return redirect()->intended('Student/dashboard'); // Authentication for SuperAdmin
                } else if ($user->role == 1) {
                    return redirect()->intended('Librarian/dashboard'); // Authentication for Librarian
                } else if ($user->role == 2) {
                    return redirect()->intended('Teacher/dashboard'); // Authentication for Teacher
                } else {
                    return redirect()->route('loginForm')->withErrors(['id_number' => 'Your Account has not yet confirmed by the Librarian.']);
                }
            } else {
                // Password is incorrect
                return back()->withErrors([
                    'password' => 'Incorrect password'
                ]);
            }
        } else {
            // User with provided id_number not found
            return back()->withErrors([
                'id_number' => 'The provided ID number does not match our records.'
            ]);
        }
    }

    public function inquireBooks(){
        $bookWithSectionAuthor =  Book::with('author', 'section')->get();
       return view('pagesAuth.inquirebook', ['books' => $bookWithSectionAuthor ,]);
    // return response()->json($bookWithSectionAuthor);
}


    public function signupForm()
    {
        return view('pagesAuth.signup');
    }


    public function registerUser(Request $request)
    {
        $count = User::where('id_number', '=', $request->input('id_number'))->count();
        if ($count > 0) {
            return redirect()->route('signupForm')->withErrors(['id_number' => 'LRN Number can only have one account.']);
        } else {

            $request->validate([
                'g-recaptcha-response' => 'required|recaptcha',
                'name' => 'required',
                'id_number' => 'required|unique:users,id_number',
                'grade_and_section' => 'required',
                'section' => 'required',
                'birthdate' => 'required|date',
                'contact_number' => 'required',
                'address' => 'required',
                'email' => 'required|email',
                'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:10120',
                'terms' => 'required'
            ]);

            $user = new User();
            $user->name = $request->input('name');
            $user->id_number = $request->input('id_number');
            $user->grade_and_section = $request->input('grade_and_section'); 
            $user->section = $request->input('section');
            $user->birthdate = $request->input('birthdate');
            $user->contact_number = $request->input('contact_number');
            $user->address = $request->input('address');
            $user->email = $request->input('email');
            $user->password = Hash::make('password');
            $user->role = -1;

            $user->save(); // Save the user first to get the user ID

            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');
                $fileName = $file->getClientOriginalName();
                $avatarFolder = public_path('storage/avatar');
                
                if (!file_exists($avatarFolder)) {
                    mkdir($avatarFolder, 0777, true);
                }
                
                $file->move($avatarFolder, $fileName);
                $user->avatar = $fileName;
                $user->save(); // Save the user again with the updated avatar path

                $avatarPath = public_path('storage/avatar/' . $fileName);
                if (File::exists($avatarPath)) {
                    $this->pixelateImage($avatarPath);
                }
            }

            $librarians = $user->isLibrarian();

            foreach ($librarians as $admin) {
                $admin->notify(new RegisterUser($user));
            }
            return redirect()->back()->with('success', 'Account created successfully. The Librarian will have to confirm it first, before you can use it');
        }
    }

    public function signupForms()
    {
        return view('pagesAuth.signup_teacher');
    }


    public function registerUsers(Request $request){
        $count = User::where('id_number', '=', $request->input('id_number'))->count();
        if ($count > 0) {
        return redirect()->route('signupForms')->withErrors(['id_number' => 'Library ID can only have one account.']);
        } else {

            $request->validate([
                'g-recaptcha-response' => 'required|recaptcha',
                'name' => 'required',
                'id_number' => 'required|unique:users,id_number',
                'office_or_department' => 'required',  
                'birthdate' => 'required|date',
                'contact_number' => 'required',
                'address' => 'required',
                'email' => 'required|email',
                'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
                'terms' => 'required'
            ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->id_number = $request->input('id_number');
        $user->office_or_department = $request->input('office_or_department');
        $user->birthdate = $request->input('birthdate');
        $user->contact_number = $request->input('contact_number');
        $user->address = $request->input('address');
        $user->email = $request->input('email');
        $user->password = Hash::make('password');
        $user->role = -2;
            
            $user->save(); // Save the user first to get the user ID

            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');
                $fileName = $file->getClientOriginalName();
                $avatarFolder = public_path('storage/avatar');
                
                if (!file_exists($avatarFolder)) {
                    mkdir($avatarFolder, 0777, true);
                }
                
                $file->move($avatarFolder, $fileName);
                $user->avatar = $fileName;
                $user->save(); // Save the user again with the updated avatar path

                $avatarPath = public_path('storage/avatar/' . $fileName);
                if (File::exists($avatarPath)) {
                    $this->pixelateImage($avatarPath);
                }
            }


         return redirect()->back()->with('success', 'Account created successfully. The Librarian will have to confirm it first, before you can use it');
         }
    }

    public function profile(Request $request){
        $user = User::where('id', $request->userID)->first();
        return view('layouts.profile');
    }

    public function updateProfile(Request $request, User $user) {

//        dd($request);
        function LibrarianError(){
            return redirect()->route('profile')->with('error', 'Pass');
        }
        function StudentError(){
            return redirect()->route('profile')->with('error', 'Pass');
        }
        function TeacherError(){
            return redirect()->route('profile')->with('error', 'Pass');
        }
        $user = Auth::user();

        $input = $request->all();
        $profileImage = '';
        if ($avatar = $request->file('avatar')) {
            $avatarFolder = public_path('storage/avatar');
            
            if (!file_exists($avatarFolder)) {
                mkdir($avatarFolder, 0777, true);
            }
        
            // Delete the old avatar if it exists
            if ($user->avatar && file_exists($avatarFolder . '/' . $user->avatar)) {
                unlink($avatarFolder . '/' . $user->avatar);
            }
        
            // Use original filename instead of user ID
            $profileImage = $avatar->getClientOriginalName();
            $avatar->move($avatarFolder, $profileImage);
            $input['avatar'] = $profileImage;

            // Pixelate the uploaded avatar
            $avatarPath = $avatarFolder . '/' . $profileImage;
            if (File::exists($avatarPath)) {
                $this->pixelateImage($avatarPath);
            }
        }

        $user->update($input);



        if (Auth::user()->role == 0){
            return redirect()->route('userProfile')->with('success', 'Pass');

        }elseif (Auth::user()->role == 1){
            return redirect()->route('userProfile')->with('success', 'Pass');
        }elseif (Auth::user()->role == 2){
            return redirect()->route('userProfile')->with('success', 'Pass');
        }
    }

    public function updatePassword(Request $request) {

        function LibrarianError(){
        return redirect()->route('librarianDashboard')->with('error', 'Pass');
        }
        function StudentError(){
            return redirect()->route('studentDashboard')->with('error', 'Pass');
        }
        function TeacherError(){
            return redirect()->route('teacherDashboard')->with('error', 'Pass');
        }

        $user = Auth::user();

        if (!Hash::check($request->oldPass, $user->password)) {
            if (Auth::user()->role == 0){
                return redirect()->route('studentDashboard')->with('error', 'Pass');

            }elseif (Auth::user()->role == 1){
                return redirect()->route('librarianDashboard')->with('error', 'Pass');

            }
            elseif (Auth::user()->role == 2){
                return redirect()->route('teacherDashboard')->with('error', 'Pass');

            }

        }else{//password Matches and procceed with changing IT

            if($request->pass1 == $request->pass2){
                $user->update([
                    'password' => Hash::make($request->pass1)
                ]);
                if (Auth::user()->role == 0){
                    return redirect()->route('studentDashboard')->with('success', 'Pass');

                }elseif (Auth::user()->role == 1){
                    return redirect()->route('librarianDashboard')->with('success', 'Pass');
                }elseif (Auth::user()->role == 2){
                    return redirect()->route('teacherDashboard')->with('success', 'Pass');
                }

            }else{
                if (Auth::user()->role == 0){
                    return redirect()->route('studentDashboard')->with('error', 'Pass');

                }elseif (Auth::user()->role == 1){
                    return redirect()->route('librarianDashboard')->with('error', 'Pass');

                }elseif (Auth::user()->role == 2){
                    return redirect()->route('teacherDashboard')->with('success', 'Pass');
                }

            }
        }


    }

    public function guestRecord()
    {
        $guests = Guest::all(); //GET ALL GUESTS

        return view('pagesAuth.guestRecord', compact('guests'));
  
    }
    
    public function formGuest(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'school' => 'nullable|string|max:255',
            'purpose' => 'required|string|max:255',
        ]);

        Guest::create($validated);

        return redirect()->back()->with('success', 'Guest information recorded successfully.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }


}
