<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\LibrarianController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//ALL ABOUT ACCOUNTS
Route::get('/',[AccountController::class, 'index']);
Route::get('/login',[AccountController::class, 'loginForm'])->name('loginForm');
Route::post('/login',[AccountController::class, 'loginUser'])->name('login');

Route::get('/user',[AccountController::class, 'roleUsers'])->name('roleUsers');

Route::get('/user/student/signup',[AccountController::class, 'signupForm'])->name('signupForm');
Route::post('/user/student/signup',[AccountController::class, 'registerUser'])->name('signup');

Route::get('/user/teacher/signup',[AccountController::class, 'signupForms'])->name('signupForms');
Route::post('/user/teacher/signup',[AccountController::class, 'registerUsers'])->name('signup_teacher');

Route::get('/account/profile',[AccountController::class, 'profile'])->name('userProfile');
Route::post('/account/profile',[AccountController::class, 'profile'])->name('profile');
Route::put('/account/updateProfile',[AccountController::class, 'updateProfile'])->name('updateProfile');
Route::put('/account/updatePassword',[AccountController::class, 'updatePassword'])->name('updatePassword');
Route::post('/logout',[AccountController::class, 'logout'])->name('logout');

Route::get('/test',[TestController::class, 'test']);
Route::post('/test',[TestController::class, 'testing'])->name('testing');

Route::get('/inquire/books',[AccountController::class, 'inquireBooks'])->name('inquireBooks');

Route::get('/guest-login', [AccountController::class, 'guestRecord'])->name('guestRecord'); // Route to display the guest form page
Route::post('/record-guest', [AccountController::class, 'formGuest'])->name('formGuest'); // Route to handle the guest form submission


//STUDENT
Route::prefix('Student')->middleware(['auth', 'isStudent'])->group(function(){

Route::get('/dashboard', [StudentController::class, 'studentDashboard'])->name('studentDashboard');
Route::get('/book/all', [StudentController::class, 'StudentbookLists'])->name('StudentbookLists');
Route::get('/transactions/all', [StudentController::class, 'studentBorrowed'])->name('studentBorrowed');
Route::get('/book/info/{book}', [StudentController::class, 'bookInfo'])->name('bookInfoStudent');//getting the info of the book


});

//TEACHER
Route::prefix('Teacher')->middleware(['auth', 'isTeacher'])->group(function(){

    Route::get('/dashboard', [TeacherController::class, 'teacherDashboard'])->name('teacherDashboard');
    Route::get('/book/all', [TeacherController::class, 'teacherbookLists'])->name('teacherbookLists');
    Route::get('/transactions/all', [TeacherController::class, 'teacherBorrowed'])->name('teacherBorrowed');
    Route::get('/book/info/{book}', [TeacherController::class, 'teacherbookInfo'])->name('bookInfoteacher');//getting the info of the book


});

//LIBRARIAN
Route::prefix('Librarian')->middleware(['auth', 'isLibrarian'])->group(function(){
    Route::post('/mark-as-delete', [LibrarianController::class,'markAsDelete'])->name('mark-as-delete');
    Route::get('/dashboard',[LibrarianController::class, 'dashboard'])->name('librarianDashboard');

    Route::get('/borrow/form/student',[LibrarianController::class, 'borrowingForm'])->name('borrowingForm');
    Route::post('/borrow/form/student',[LibrarianController::class, 'registerBorrower'])->name('registerBorrower');

    Route::get('/borrow/form/teacher',[LibrarianController::class, 'borrowingFormTeacher'])->name('borrowingFormTeacher');
    Route::post('/borrow/form/teacher',[LibrarianController::class, 'registerBorrowerTeacher'])->name('registerBorrowerTeacher');

    Route::get('/borrow/lists',[LibrarianController::class, 'borrowerLists'])->name('borrowerLists');
    Route::get('/borrow/return', [LibrarianController::class, 'returnedBook'])->name('returnedBook');//getting the info of the book
    Route::get('/borrow/update/{transaction}', [LibrarianController::class, 'updateBorrow'])->name('updateBorrow');//getting the info of the book
    Route::put('/borrow/update/', [LibrarianController::class, 'returnBook'])->name('returnBook');//getting the info of the book
    
    Route::get('/book/add',[LibrarianController::class, 'addForm'])->name('addBook');
    Route::post('/book/add',[LibrarianController::class, 'registerBook'])->name('registerBook');
    Route::post('/book/add/registerAuthor', [LibrarianController::class, 'registerAuthor'])->name('registerAuthor');
    // Route::post('/book/add/updateAuthor', [LibrarianController::class, 'updateAuthor'])->name('updateAuthor');
    Route::post('/book/add/registerLocation', [LibrarianController::class, 'registerLocation'])->name('registerLocation');

    Route::get('/book/list',[LibrarianController::class, 'bookLists'])->name('bookLists');
    Route::delete('/book/delete/{book}', [LibrarianController::class, 'deleteBook'])->name('deleteBook');
    Route::get('/book/info/{book}', [LibrarianController::class, 'bookInfo'])->name('bookInfo');//getting the info of the book
    Route::put('/book/update', [LibrarianController::class, 'updateBook'])->name('updateBook');//updateBook
    Route::get('/pending/students', [LibrarianController::class, 'accountPending'])->name('accountPending');//showing pending users
    Route::put('/pending/students', [LibrarianController::class, 'confirmAccount'])->name('confirmAccount');//confirming the account
    Route::delete('/pending/students', [LibrarianController::class, 'deleteAccount'])->name('deleteAccount');//deleting the student the account
    Route::get('/all/students', [LibrarianController::class, 'accountLists'])->name('accountLists');//getting the info of the book
    Route::get('/generate/report', [LibrarianController::class, 'generateReport'])->name('generateReport');//getting the info of the book
    Route::get('/generate/report/data', [LibrarianController::class, 'fetchLocationsAndAuthors'])->name('fetchLocationsAndAuthors');

    Route::get('/all/students/info/{student}', [LibrarianController::class, 'showStudentInfo'])->name('studentDetails');
    Route::put('/all/students/info/{student}', [LibrarianController::class, 'studentUpdate'])->name('studentUpdate');
    Route::get('/all/students/info/regenerate/{student}', [LibrarianController::class, 'regenerateQrCode'])->name('regenerateQrCode');
    // Route::get('/all/students/info/{student}/print', [LibrarianController::class, 'printQrCode'])->name('printQrCode');
    Route::get('/all/teachers/info/{teacher}', [LibrarianController::class, 'showTeacherInfo'])->name('teacherDetails');
    Route::put('/all/teachers/info/{teacher}', [LibrarianController::class, 'teacherUpdate'])->name('teacherUpdate');

    Route::get('/pending/teachers', [LibrarianController::class, 'accountPendingTeacher'])->name('accountPendingTeacher');//showing pending users
    Route::put('/pending/teachers', [LibrarianController::class, 'confirmAccountTeacher'])->name('confirmAccountTeacher');//confirming the account
    Route::delete('/pending/teachers', [LibrarianController::class, 'deleteAccountTeacher'])->name('deleteAccountTeacher');//deleting the student the account
    Route::get('/all/teachers', [LibrarianController::class, 'accountListsTeacher'])->name('accountListsTeacher');//getting the info of the book


    Route::get('/records/update', [LibrarianController::class, 'updateStudents'])->name('updateStudents');//getting the info of the book
    Route::post('/records/update', [LibrarianController::class, 'updateStudentsRecord'])->name('updateStudentsRecord');
    Route::delete('/records/update', [LibrarianController::class, 'deleteGrade12Students'])->name('deleteGrade12Students');

    
    Route::post('generate/report', [LibrarianController::class, 'printGeneratedReport'])->name('printGeneratedReport');
    Route::get('/transactions', [LibrarianController::class, 'studentTransactions'])->name('studentTransactions');
    Route::get('/Librarian/transaction/{id}', [LibrarianController::class, 'studentTransaction'])->name('transaction');

    Route::get('/transaction/logs', [LibrarianController::class, 'studentLogbook'])->name('studentLogbooks');
    Route::post('records/recordLogins', [LibrarianController::class, 'recordLogins'])->name('recordLogins');
    Route::delete('/transaction/logs/delete/{id}', [LibrarianController::class, 'deleteStudentLogbook'])->name('delete.student.logbook');
    
    Route::get('/guest', [LibrarianController::class, 'guestForm'])->name('guestForm'); // Route to display the guest form page
    Route::post('/record-guests', [LibrarianController::class, 'recordGuests'])->name('recordGuests'); // Route to handle the guest form submission
    Route::delete('/record-guests/{guest}', [LibrarianController::class, 'deleteGuest'])->name('deleteGuest');
    
    Route::put('/students/{student}/update-password', [LibrarianController::class, 'updatePassword'])->name('librarian.updatePassword');
    Route::put('/students/{teacher}/update-password', [LibrarianController::class, 'updatePasswordTeacher'])->name('librarian.updatePasswordTeacher');

});

Route::prefix('SuperAdmin')->middleware(['auth', 'isSuperAdmin'])->group(function(){

    Route::get('/dashboard',[SuperAdminController::class, 'dashboard'])->name('superadminDashboard');
});
