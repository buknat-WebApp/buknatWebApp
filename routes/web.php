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
Route::get('/signup',[AccountController::class, 'signupForm'])->name('signupForm');
Route::post('/signup',[AccountController::class, 'registerUser'])->name('signup');
Route::get('/account/profile',[AccountController::class, 'profile'])->name('userProfile');
Route::post('/account/profile',[AccountController::class, 'profile'])->name('profile');
Route::put('/account/updateProfile',[AccountController::class, 'updateProfile'])->name('updateProfile');
Route::put('/account/updatePassword',[AccountController::class, 'updatePassword'])->name('updatePassword');
Route::post('/logout',[AccountController::class, 'logout'])->name('logout');
Route::get('/test',[TestController::class, 'test']);
Route::post('/test',[TestController::class, 'testing'])->name('testing');

Route::get('/inquire/books',[AccountController::class, 'inquireBooks'])->name('inquireBooks');


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
    Route::get('/mark-as-read', [LibrarianController::class,'markAsRead'])->name('mark-as-read');
    Route::get('/dashboard',[LibrarianController::class, 'dashboard'])->name('librarianDashboard');
    Route::get('/borrow/form',[LibrarianController::class, 'borrowingForm'])->name('borrowingForm');
    Route::post('/borrow/form',[LibrarianController::class, 'registerBorrower'])->name('registerBorrower');
    Route::get('/borrow/lists',[LibrarianController::class, 'borrowerLists'])->name('borrowerLists');
    Route::get('/borrow/return', [LibrarianController::class, 'returnedBook'])->name('returnedBook');//getting the info of the book
    Route::get('/borrow/update/{transaction}', [LibrarianController::class, 'updateBorrow'])->name('updateBorrow');//getting the info of the book
    Route::put('/borrow/update/', [LibrarianController::class, 'returnBook'])->name('returnBook');//getting the info of the book
    Route::get('/book/add',[LibrarianController::class, 'addForm'])->name('addBook');
    Route::post('/book/add',[LibrarianController::class, 'registerBook'])->name('registerBook');
    Route::post('/book/add/registerAuthor', [LibrarianController::class, 'registerAuthor'])->name('registerAuthor');

    Route::get('/book/list',[LibrarianController::class, 'bookLists'])->name('bookLists');
    Route::get('/book/info/{book}', [LibrarianController::class, 'bookInfo'])->name('bookInfo');//getting the info of the book
    Route::put('/book/update', [LibrarianController::class, 'updateBook'])->name('updateBook');//updateBook
    Route::get('/students/pending', [LibrarianController::class, 'accountPending'])->name('accountPending');//getting the info of the book
    Route::put('/students/pending', [LibrarianController::class, 'confirmAccount'])->name('confirmAccount');//confirming the account
    Route::delete('/students/pending', [LibrarianController::class, 'deleteAccount'])->name('deleteAccount');//deleting the student the account
    Route::get('/students/all', [LibrarianController::class, 'accountLists'])->name('accountLists');//getting the info of the book
    Route::get('/generate/report', [LibrarianController::class, 'generateReport'])->name('generateReport');//getting the info of the book


    Route::get('/records/update', [LibrarianController::class, 'updateStudents'])->name('updateStudents');//getting the info of the book
    Route::post('/records/update', [LibrarianController::class, 'updateStudentsRecord'])->name('updateStudentsRecord');

    Route::get('/transaction/logs', [LibrarianController::class, 'studentLogbook']);

    Route::post('generate/report', [LibrarianController::class, 'printGeneratedReport'])->name('printGeneratedReport');
    Route::get('/transactions', [LibrarianController::class, 'studentTransactions'])->name('studentTransactions');
    Route::get('/transaction/{transaction}', [LibrarianController::class, 'studentTransaction'])->name('transaction');

    Route::post('records/recordLogins', [LibrarianController::class, 'recordLogins'])->name('recordLogins');

});

Route::prefix('SuperAdmin')->middleware(['auth', 'isSuperAdmin'])->group(function(){

    Route::get('/dashboard',[SuperAdminController::class, 'dashboard'])->name('superadminDashboard');
});
