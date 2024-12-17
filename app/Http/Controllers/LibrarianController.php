<?php

namespace App\Http\Controllers;

use App\Models\BookLocation;
use Illuminate\Support\Facades\Hash;
use Mpdf\Mpdf;
use Carbon\Carbon;
use App\Models\Book;
use App\Models\User;
use SimpleXMLElement;
use App\Models\Author;
use App\Models\BookSection;
use App\Models\RecordLogin;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\BookTransaction;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class LibrarianController extends Controller
{
    public function dashboard()
    {
        $booksCounter = count(Book::all());
        $noOfStudents = count(User::where('role', '=', 0)->get());
        $noOfTeachers = count(User::where('role', '=',2)->get());
        $noOfPending = count(User::where('role', '=', -1)->get());
        $noOfPendingTeacher = count(User::where('role', '=', -2)->get());
        $pendingStudents = User::where('role', '=', -1)->get();
        $pendingTeachers = User::where('role', '=', -2)->get();
        $books = Book::all();

        // $bookTransactions = DB::table('transactions')
        // ->join('authors', 'books.author_id', '=', 'authors.id')
        // ->select('authors.author')
        // ->get();

        $unreturnedBooks = BookTransaction::whereNull('returned_at')->count();

        $transactions = Transaction::with(['user'])
            ->whereHas('bookTransactions', function ($query) {
                $query->whereNull('returned_at');
            })
            ->orderBy('expected_return_date', 'asc')
            ->get();

        // Fetch overdue transactions with associated users and filter by overdue books
        $overdueTransactions = Transaction::with(['user'])
            ->whereHas('bookTransactions', function ($query) {
                $query->whereNull('returned_at')
                    ->where('expected_return_date', '<', now()); // Assuming 'expected_return_date' is a date field
            })
            ->orderBy('expected_return_date', 'asc')
            ->get();

        $transact = [];
        if ($transactions) {
            foreach ($transactions as $transaction) {
                $trxns = BookTransaction::where('transaction_id', $transaction->id)->get();
                $bookNames = [];
                foreach ($trxns as $trxn) {
                    $book = Book::where('id', $trxn->book_id)->first();
                    if ($book) {
                        $bookNames[] = $book;
                    }
                }
                $transact[$transaction->id] = $bookNames;
            }
        }


        // Get all items that are currently borrowed
        //  = BookTransaction::where('returned_date', false)->get();

        return view('pagesLibrarian.dashboard', [
            'noOfBooks' => $booksCounter,
            'noOfStudents' => $noOfStudents,
            'noOfTeachers' => $noOfTeachers,
            'noOfPending' => $noOfPending,
            'noOfPendingTeacher' => $noOfPendingTeacher,
            'pendingStudents' => $pendingStudents,
            'pendingTeachers' => $pendingTeachers,
            'transactions' => $transactions,
            'overdueTransactions' => $overdueTransactions,
            'booksTransacted' => $transact,
            'books' => $books,
            'unreturnedBooks' => $unreturnedBooks
        ]);

        // return response()->json($transact);
    }

    // START book options
    public function addForm() //adding A Book FORM
    {
        $sections = BookSection::all();
        $authors = Author::all();
        $locations = BookLocation::all();
        return view('pagesLibrarian.bookAdd', [
            'sections' => $sections, //section is addded to the page
            'locations' => $locations,
            'authors' => $authors,
        ]);
    }

    public function createAuthor(Request $request)
    {

    }
    public function registerAuthor(Request $request)
    {
        $validated = $request->validate([
            'author' => 'required|string|max:255',
            'author_id' => 'nullable',
        ]);

//        $book->book_title = $request->input('book_title');
//        $book->class_no = $request->input('class_no');

        $book = Author::create(
            $validated
        );

        return redirect()->back()->with('success', 'Author created successfully!');
    }
    

    public function registerLocation(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location_id' => 'nullable',
        ]);

//        $book->book_title = $request->input('book_title');
//        $book->class_no = $request->input('class_no');

        $book = BookLocation::create(
            $validated
        );

        return redirect()->back()->with('success', 'Subject created successfully!');
    }

    public function registerBook(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'book_title' => 'required|string|max:255',
            'author_id' => 'nullable|exists:authors,id',
            'author_no' => 'nullable|string|max:255',
            'class_no' => 'nullable|string|max:255',
            'edition' => 'nullable|string|max:255',
            'accession' => 'nullable|string|max:255',
            'publication_year' => 'nullable|string|max:255',
            'date_acquired' => 'nullable|date',
            'no_of_copies' => 'required|integer|min:0',
            'book_status' => 'required|string',
            'book_condition' => 'nullable|string|max:255',
            'isbn' => 'nullable|string|max:20',
            'publisher' => 'nullable|string|max:255',
            'number_of_pages' => 'nullable|integer|min:0',
            'location_id' => 'nullable',
            'section_id' => 'nullable|exists:book_sections,id',
            'summary' => 'nullable|string',
            'added_by' => 'nullable',
            'available_copies' => 'nullable|integer|min:0|',
            'book_cover' => '|image|mimes:jpeg,png,jpg,gif|max:12200',
        ]);

        // $book = new Book(); // Create a new instance of the Book model

        // $book->book_cover = $request->input('book_cover');

       

        //     if ($request->hasFile('book_cover')) {
        //         $file = $request->file('book_cover');
        //         $fileName = $file->getClientOriginalName();
        //         $file->move(public_path('storage/BookCover'), $fileName);
        //         $book->book_cover =  $fileName; // Assign the file name to book_cover property
        //     }   

        $validated['added_by'] = Auth::user()->name;
        $book = Book::create(
            $validated
         );

        $file_ID = $book->id;

        // // Generate QR code with given data
        $file_ID = $book->getKey();
        // $qrCode = QrCode::size(250)->generate($file_ID);

        //Save QR code as image in a specific folder
        $path = public_path('storage/BookQRCodes/'); // path to folder where image will be saved
        $filename = $file_ID . '.png'; // name of the image file

        if (!File::exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }

        QrCode::style('square')
            ->eye('circle')// Use PNG format for the merged image
            ->size(400)
            ->margin(10)
            ->color(0, 0, 0)
            ->backgroundColor(255, 255, 255)
            ->format('png')
//            ->merge('https://www.freepnglogos.com/uploads/google-logo-png/google-logo-png-google-icon-logo-png-transparent-svg-vector-bie-supply-14.png', .3, true)
            ->merge(public_path('logo.png'), 0.12, true) // Merge the cat image with QR code
            ->generate($file_ID, ($path . $filename));

        return redirect()->back()->with('success', 'Book created successfully!');
    }

    public function bookLists() //Lists all books
    {
        $booksWSections = BookSection::with(['books' => function ($books) {
            $books->with(['author:id,author_id,author'])->get();
        }])->get();
        //  dd( $booksWSections[0]);
        // return view('admin.index', ['bookSections' => $booksWSections]);
        return view('pagesLibrarian.bookLists', compact('booksWSections'));
    }

    public function bookInfo($book)
    { //indiv book info

        $book = Book::where('id', '=', $book)->first();
        $sections = BookSection::all();
        $locations = BookLocation::all();
        return view('pagesLibrarian.bookInfo', [
            'book' => $book,
            'sections' => $sections,
            'locations' => $locations,
        ]);
    }

    public function updateBook(Request $request)
    { // Update book
        $Book = Book::where('id', $request->book_id);
        $Book->update([
            'book_title' => $request->book_title,
            'section_id' => $request->section,
            'class_no' => $request->class_no,
            'edition' => $request->edition,
            'publisher' => $request->publisher,
            'number_of_pages' => $request->number_of_pages,
            'isbn' => $request->isbn,
            'location_id' => $request->location,
            'publication_year' => $request->publication_year,
            'book_condition' => $request->book_condition,
            'summary' => $request->summary,
            'no_of_copies' => $request->no_of_copies,
        ]);

        $Author = Author::where('id', $request->authorID);
        $Author->update([
            'author' => $request->author_name,
            'author_id' => $request->author_id,
        ]);
        return redirect()->back()->with('success', 'Book Updated Successfully.');
    }


    //START Account Options
    public function accountPending()
    {

        $pendingStudents = User::where('role', '=', -1)->get();

        return view('pagesLibrarian.accountsPending', [
            'pendingStudents' => $pendingStudents,
        ]);
    }

    public function accountPendingTeacher()
    {

        $pendingTeachers = User::where('role', '=', -2)->get();

        return view('pagesLibrarian.pendingTeacher', [
            'pendingTeachers' => $pendingTeachers,
        ]);
    }

    public function accountLists()
    {
        $students = User::where('role', '=', 0)->get();

        return view('pagesLibrarian.accountLists', [ 
            'students' => $students
        ]);
    }

    public function accountListsTeacher()
    {
        $teachers = User::where('role', '=', 2)->get();

        return view('pagesLibrarian.accountListsTeacher', [
            'teachers' => $teachers
        ]);
    }

    public function confirmAccount(Request $request)
    {

        // Update the user's fields in the database
        $user = User::findOrFail($request->id_account);
        $user->update([
            'id_number' => $request->id_number,
            'name' => $request->name,
            'grade_and_section' => $request->grade_and_section,
            'role' => $request->role = 0,
        ]);


        // // Generate QR code with given data
        $file_ID = $user->id_number;
        // $qrCode = QrCode::size(250)->generate($file_ID);

        // //Save QR code as image in a specific folder
        $path = public_path('storage/StudentQrCodes/'); // path to folder where image will be saved

        if (!File::exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }
        $filename = $user->id . '.png'; // name of the image file
        // QrCode::format('svg')->size(250)->generate($file_ID, public_path($path . $filename));
        // QrCode::format('svg')->size(400)->margin(10)->color(0, 0, 0)->backgroundColor(255, 255, 255)
        //     ->generate($file_ID, public_path($path . $filename));


        QrCode::style('square')
            ->eye('circle')// Use PNG format for the merged image
            ->size(400)
            ->margin(10)
            ->color(0, 0, 0)
            ->backgroundColor(255, 255, 255)
            ->format('png')
//            ->merge('https://www.freepnglogos.com/uploads/google-logo-png/google-logo-png-google-icon-logo-png-transparent-svg-vector-bie-supply-14.png', .3, true)
            ->merge(public_path('logo.png'), 0.12, true) // Merge the cat image with QR code
            ->generate($file_ID, ($path . $filename));

        return redirect()->back()->with('successApprove', 'Student Approved successfully.');
    }

    public function confirmAccountTeacher(Request $request)
    {

        // Update the user's fields in the database
        $user = User::findOrFail($request->id_account);
        $user->update([
            'id_number' => $request->id_number,
            'name' => $request->name,
            'office_or_department' => $request->office_or_department,
            'role' => $request->role = 2,
        ]);


        // // Generate QR code with given data
        $file_ID = $user->id_number;
        // $qrCode = QrCode::size(250)->generate($file_ID);

        // //Save QR code as image in a specific folder
        $path = public_path('storage/TeacherQrCodes/'); // path to folder where image will be saved

        if (!File::exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }
        $filename = $user->id . '.png'; // name of the image file
        // QrCode::format('svg')->size(250)->generate($file_ID, public_path($path . $filename));
        // QrCode::format('svg')->size(400)->margin(10)->color(0, 0, 0)->backgroundColor(255, 255, 255)
        //     ->generate($file_ID, public_path($path . $filename));


        QrCode::style('square')
            ->eye('circle')// Use PNG format for the merged image
            ->size(400)
            ->margin(10)
            ->color(0, 0, 0)
            ->backgroundColor(255, 255, 255)
            ->format('png')
//            ->merge('https://www.freepnglogos.com/uploads/google-logo-png/google-logo-png-google-icon-logo-png-transparent-svg-vector-bie-supply-14.png', .3, true)
            ->merge(public_path('logo.png'), 0.12, true) // Merge the cat image with QR code
            ->generate($file_ID, ($path . $filename));

        return redirect()->back()->with('successApprove', 'Teacher Approved successfully.');
    }

    public function deleteAccount(Request $request)
    {
        $filename = $request->idFile;
        // Get the full path of the file
        $path = storage_path('app/public/IDPic/' . $filename);
        File::delete($path);  // Delete the file
        $user = User::findOrFail($request->id_account);
        $user->delete();

        return redirect()->back()->with('successDelete', 'Student Deleted successfully.');
    }

    public function deleteAccountTeacher(Request $request)
    {
        $filename = $request->idFile;
        // Get the full path of the file
        $path = storage_path('app/public/IDPic/' . $filename);
        File::delete($path);  // Delete the file
        $user = User::findOrFail($request->id_account);
        $user->delete();

        return redirect()->back()->with('successDelete', 'Teacher Deleted successfully.');
    }
    //END ACCOUNT OPTIONS

    //START Borrowing Options
    public function borrowingForm()
    {
        $users = User::whereIn('role', [0, 2]) //GET ONLY THE ROLE "0" or "2" (students or another role)
            ->orderBy('name', 'ASC')
            ->get();

        $books = Book::where('is_available', '!=', 0) //get only the available && copies available && FUNCTIONAL
        ->where('available_copies', '>', 0)
            ->where('book_condition', '=', 'functional')
            ->orderBy('book_title', 'ASC')
            ->get();

        return view('pagesLibrarian.borrowBook', [
            'users' => $users,
            'books' => $books,
        ]);
    }

    public function registerBorrower(Request $request)
    {
        $request->validate([
            'user_id'              => 'required|exists:users,id',
            'expected_return_date' => 'required|date',
            'books'                => 'required|array|min:1',
            'books.*'              => 'exists:books,id',
        ]);

        $user = User::find($request->input('user_id'));
        // $books = Book::find($id);


        $hasUnreturnedBooks = $user->books->where('returned_at', null)->isNotEmpty();


        if ($hasUnreturnedBooks) {
            return redirect()->back()->with('error', 'Error. ' . $user->name . ' has an unreturned book!');
        }

        $transaction = Transaction::create([
            'user_id'              => $request->input('user_id'),
            'borrowed_at'          => now(),
            'remarks'              => $request->input('remarks'),
            'expected_return_date' => $request->input('expected_return_date'),
            // 'fines'                => $request->input('fines', 0),
        ]);

        foreach ($request->input('books') as $bookId) {
            $bookTransaction = new BookTransaction();
            $bookTransaction->fill([
                'transaction_id'          => $transaction->id,
                'book_id'                 => $bookId,
                'borrowed_book_condition' => Book::find($bookId)->book_condition,
                'returned_at'             => null,
                'return_book_condition'   => null,
                'fines'                   => null,
                'remarks'                 => null,
            ]);

            $bookTransaction->save();

            Book::where('id', $bookId)->decrement('available_copies', 1);
        }

        return redirect()->back()->with('success', 'Book  Borrowed Recorded Successfully!');
    }


    public function borrowerLists()
    {
        $transactions = Transaction::with(['user', 'bookTransactions'])
            ->whereHas('bookTransactions', function ($query) {
                $query->whereNull('returned_at');
            })
            ->orderBy('expected_return_date', 'asc')
            ->get();
        $books = Book::all();
        return view('pagesLibrarian.borrowLists', compact('transactions', 'books'));
    }

    public function updateBorrow($transaction)
    { //view the borrowed and its books
        $user = DB::table('transactions')
            ->select('users.*', 'transactions.*') //gettinG all the User Details    
            ->join('users', 'users.id', '=', 'transactions.user_id')
            ->where('transactions.id', $transaction)
            ->first();

        $bookTransactions = DB::table('book_transactions')
            ->select('book_transactions.*', 'books.*', 'book_transactions.id')
            ->join('books', 'books.id', '=', 'book_transactions.book_id')
            ->where('transaction_id', $transaction)
            ->get();

        return view('pagesLibrarian.borrowUpdate', [
            'user' => $user,
            'bookTransactions' => $bookTransactions,
        ]);
    }

    public function returnBook(Request $request)
    {
        if (!empty($request->transactionIDs)) {
            for ($i = 0; $i < count($request->transactionIDs); $i++) {

                $Book = BookTransaction::where('id', $request->transactionIDs[$i]);
                $Book->update([
                    'returned_at' => $request->returned_dates[$i],
                    'return_book_condition' => $request->returned_book_conditions[$i],
                    'fines' => $request->fines[$i],
                    'remarks' => $request->remarks[$i],
                ]);

                if ($request->returned_book_conditions[$i] == 'functional') {
                    $bookToUpdate = BookTransaction::where('id', $request->transactionIDs[$i])->first();
                    Book::where('id', $bookToUpdate->book_id)->increment('available_copies', '1'); //returned book will be added to copies
                }
            }
            return redirect()->route('borrowerLists')->with('success', 'Return Books Successfully.');
        } else {
            return redirect()->back()->with('error', 'Check atleast one book to return');
        }
    }

    public function returnedBook()
    {
        $transactions = Transaction::with(['user', 'bookTransactions'])
            ->whereHas('bookTransactions', function ($query) {
                $query->whereNotNull('returned_at');
            })
            ->orderBy('borrowed_at', 'asc')
            ->get();

        $books = Book::all();
        return view('pagesLibrarian.borrowReturned', compact('transactions', 'books'));
    }

    public function generateReport()
    {
        // $pendingTeachers = User::where('role', '=', -2)->get();

        $sections = BookSection::all();
        $authors = Author::all();
        $locations = BookLocation::all();
        return view('pagesLibrarian.generateReport', [
            'sections' => $sections, //section is addded to the page
            'locations' => $locations,
            'authors' => $authors,
        ]);

    }
    public function fetchLocationsAndAuthors(Request $request)
{
    $sectionId = $request->input('section_id');

    if (!$sectionId) {
        return response()->json(['error' => 'Section ID is required'], 400);
    }

    // Fetch locations and authors associated with the books of the given section
    $locations = BookLocation::whereIn('id', function ($query) use ($sectionId) {
        $query->select('location_id')
              ->from('books')
              ->where('section_id', $sectionId);
    })->get();

    $authors = Author::whereIn('id', function ($query) use ($sectionId) {
        $query->select('author_id')
              ->from('books')
              ->where('section_id', $sectionId);
    })->get();

    return response()->json([
        'locations' => $locations,
        'authors' => $authors,
    ]);
}


    public function studentTransactions()
    {
        $students = User::where('role', 0)
            ->with('transactions')
            ->get();
        return view('pagesLibrarian.transactions', [
            'students' => $students,
        ]);

        // return response()->json($students);

    }

    public function studentTransaction($id)
    {
        $studentWTransactions = Transaction::where('id', $id)
            ->with('bookTransactions', 'user')
            ->first();

        if ($studentWTransactions) {

            foreach ($studentWTransactions->bookTransactions as $bookTransaction) {

                $book[] = Book::where('id', '=', $bookTransaction->book_id)->first();
            }
            return view('pagesLibrarian.transaction', [
                'transaction' => $studentWTransactions,
                'books' => $book,
            ]);
        }

        // return response()->json( $studentWTransactions);
    }

    public function updateStudents()
    {
        return view('pagesLibrarian.updateStudentRecords');
    }

    public function studentLogbook()
    {

        $records = RecordLogin::orderBy('created_at', 'desc')->get();

        return view('pagesLibrarian.transactionLogs', compact('records'));

    }


    public function recordLogins(Request $request)
    {
        $qrID = $request->input('qr_code');

        $user = User::where('id_number', $qrID)->first();

        if ($user) {
            RecordLogin::create([
                'id_number' => $request->input('qr_code'),
                'name' => $user->name
            ]);

        }


        $records = RecordLogin::orderBy('created_at', 'desc')->get();

        return view('pagesLibrarian.transactionLogs', compact('records'));

        //    return response()->json($records);
    }

    public function updateStudentsRecord(Request $request)
    {
        $users = User::where('grade_and_section', $request->grade_levelA)->get();

        if ($users) {
            foreach ($users as $user) {
                $user->update([
                    'grade_and_section' => $request->grade_levelB, // Replace 'new_year_value' with the actual value you want to set
                ]);
            }
        }

        echo '<script>
      alert("The Records were SuccessFully updated");
      </script>';

        return view('pagesLibrarian.updateStudentrecords');
    }


    public function printGeneratedReport(Request $request)
    {
        // return view('pagesLibrarian.generateReport');

        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $totalText = 'Total Number of Library Users';
        $totalCounter = 0;
        $students = ['Grade-7', 'Grade-8', 'Grade-9', 'Grade-10', 'Grade-11', 'Grade-12'];
       
       
        $teachers = DB::table('users')
        ->where('role', '=', 2)
        ->whereNotNull('office_or_department')
        ->distinct()
        ->pluck('office_or_department')
        ->toArray();
        $userType = $request->input('usersType');
        
        $sectionType = $request->input('sectionType');
        $locationType = $request->input('locationType');
        $authorType = $request->input('authorType');

        $reportType = $request->input('reportType');

        $itemType = $request->input('itemType');
            if ($itemType == 'sequence') {
            $statistical = 'Monthly Statistics of Books Borrowed';
   
            }else if($itemType == 'overAll') {
            $statistical = 'Summary of Books Borrowed';
            $totalText1 = 'Total Number of  Book/s Borrowed';
            }else {
                $statistical = 'Statistical Record of Library Users';
                $totalText = 'Total Number of Library Users';
            }
       
        //  Query the database to filter transactions for the specified month, join wsith the users table, and filter by grade level

        $reportData = '<h3 style="text-align: center;">Bukidnon National High School Library Management System</h3>' . '<h3 style="text-align: center;">Malaybalay</h3>'
            .  '<h3 style="text-align: center;">'. $statistical .'</h3>';
        $reportData .= '<p style="text-align: center; font-style: italic;">'. date('F d', strtotime($fromDate)) . ' - ' . date('d, Y', strtotime($toDate)).'</p>';
        
        if($itemType == 'sequence'){

                    $reportData .= '<table border="1" style="width: 100%; text-align: center;">

                                <thead>
                                    <tr>
                                        <th>Date Borrowed</th>
                                        <th>Borrowers Name</th>
                                        <th>Title of Books</th>
                                        <th>Author</th>
                                        <th>Accession Number</th>
                                        <th>Due Date</th>
                                        <th>Fines</th>
                                    </tr>
                                </thead>
                            <tbody>';

                }else if($itemType == 'overAll'){
                    $reportData .= '<table border="1" style="width: 100%; text-align: center;">
                        <thead>
                            <tr>
                                <th>Grade Level</th>
                                <th>Number of borrowed books</th>
                            </tr>
                        </thead>
                        <tbody>';

        }else{

            $reportData .= '<table border="1" style="width: 100%; text-align: center;">
                        <thead>
                            <tr>
                                <th>Grade Level</th>
                                <th>Number of Library Users</th>
                            </tr>
                        </thead>
                        <tbody>';
        }

       // Handle students if userType is 'students' or 'all'
    if ($userType == 'students' || $userType == 'all') {
        foreach ($students as $student) {
            if ($itemType == 'sequence') {
                $query = DB::table('transactions')
                    ->join('users', 'transactions.user_id', '=', 'users.id')
                    ->join('book_transactions', 'transactions.id', '=', 'book_transactions.transaction_id')
                    ->join('books', 'book_transactions.book_id', '=', 'books.id')
                    ->join('authors', 'books.author_id', '=', 'authors.id')
                    ->select('transactions.borrowed_at', 'users.name as borrower_name', 'books.book_title', 'authors.author', 'expected_return_date', 'accession', 'fines')
                    ->whereBetween('transactions.borrowed_at', [$fromDate, $toDate])
                    ->where('users.grade_and_section', $student);

                if ($sectionType) {
                    $query->where('books.section_id', $sectionType);
                }
                if ($locationType) {
                    $query->where('books.location_id', $locationType);
                }
                if ($authorType) {
                    $query->where('books.author_id', $authorType);
                }

                $bookTransactions = $query->get();

                foreach($bookTransactions as $bookTransaction) {   
                    $reportData .= '<tr>';
                    $reportData .= '<td>' . $bookTransaction->borrowed_at . '</td>';
                    $reportData .= '<td>' . $bookTransaction->borrower_name . '</td>';
                    $reportData .= '<td>' . $bookTransaction->book_title . '</td>';
                    $reportData .= '<td>' . $bookTransaction->author . '</td>';
                    $reportData .= '<td>' . $bookTransaction->accession . '</td>';
                    $reportData .= '<td>' . $bookTransaction->expected_return_date . '</td>';
                    $reportData .= '<td>' . $bookTransaction->fines . '</td>';
                    $reportData .= '</tr>';
                }
            } else if($itemType == 'overAll') {
                $query = DB::table('transactions')
                    ->join('users', 'transactions.user_id', '=', 'users.id')
                    ->join('book_transactions', 'transactions.id', '=', 'book_transactions.transaction_id')
                    ->join('books', 'book_transactions.book_id', '=', 'books.id');

                if ($sectionType) {
                    $query->where('books.section_id', $sectionType);
                }
                if ($locationType) {
                    $query->where('books.location_id', $locationType);
                }
                if ($authorType) {
                    $query->where('books.author_id', $authorType);
                }

                $bookCount = $query
                    ->whereBetween('transactions.borrowed_at', [$fromDate, $toDate])
                    ->where('users.grade_and_section', $student)
                    ->count('books.id');

                $reportData .= '<tr>';
                $reportData .= '<td>' . $student . '</td>';
                $reportData .= '<td>' . $bookCount . '</td>';
                $reportData .= '</tr>';
                $totalCounter = $totalCounter + $bookCount;
            } else {
                $loginCounts = DB::table('record_logins')
                    ->join('users', 'record_logins.id_number', '=', 'users.id_number')
                    ->whereBetween('record_logins.created_at', [$fromDate, $toDate])
                    ->where('users.grade_and_section', $student)
                    ->select('users.grade_and_section', DB::raw('COUNT(DISTINCT record_logins.id_number) as login_count'))
                    ->groupBy('users.grade_and_section')
                    ->first();

                $reportData .= '<tr>';
                $reportData .= '<td>' . $student . '</td>';
                $reportData .= '<td>' . ($loginCounts ? $loginCounts->login_count : 0) . '</td>';
                $reportData .= '</tr>';
                $totalCounter += $loginCounts ? $loginCounts->login_count : 0;
            }
        }
    }

    // Handle teachers if userType is 'teachers' or 'all'
    if ($userType == 'teachers' || $userType == 'all') {
        foreach ($teachers as $teacher) {
            if ($itemType == 'sequence') {
                $query = DB::table('transactions')
                    ->join('users', 'transactions.user_id', '=', 'users.id')
                    ->join('book_transactions', 'transactions.id', '=', 'book_transactions.transaction_id')
                    ->join('books', 'book_transactions.book_id', '=', 'books.id')
                    ->join('authors', 'books.author_id', '=', 'authors.id')
                    ->select('transactions.borrowed_at', 'users.name as borrower_name', 'books.book_title', 'authors.author', 'expected_return_date', 'accession', 'fines')
                    ->whereBetween('transactions.borrowed_at', [$fromDate, $toDate])
                    ->where('users.office_or_department', $teacher);

                if ($sectionType) {
                    $query->where('books.section_id', $sectionType);
                }
                if ($locationType) {
                    $query->where('books.location_id', $locationType);
                }
                if ($authorType) {
                    $query->where('books.author_id', $authorType);
                }

                $bookTransactions = $query->get();

                foreach($bookTransactions as $bookTransaction) {   
                    $reportData .= '<tr>';
                    $reportData .= '<td>' . $bookTransaction->borrowed_at . '</td>';
                    $reportData .= '<td>' . $bookTransaction->borrower_name . '</td>';
                    $reportData .= '<td>' . $bookTransaction->book_title . '</td>';
                    $reportData .= '<td>' . $bookTransaction->author . '</td>';
                    $reportData .= '<td>' . $bookTransaction->accession . '</td>';
                    $reportData .= '<td>' . $bookTransaction->expected_return_date . '</td>';
                    $reportData .= '<td>' . $bookTransaction->fines . '</td>';
                    $reportData .= '</tr>';
                }
            } else if($itemType == 'overAll') {
                $query = DB::table('transactions')
                    ->join('users', 'transactions.user_id', '=', 'users.id')
                    ->join('book_transactions', 'transactions.id', '=', 'book_transactions.transaction_id')
                    ->join('books', 'book_transactions.book_id', '=', 'books.id');

                if ($sectionType) {
                    $query->where('books.section_id', $sectionType);
                }
                if ($locationType) {
                    $query->where('books.location_id', $locationType);
                }
                if ($authorType) {
                    $query->where('books.author_id', $authorType);
                }

                $bookCount = $query
                    ->whereBetween('transactions.borrowed_at', [$fromDate, $toDate])
                    ->where('users.office_or_department', $teacher)
                    ->count('books.id');

                $reportData .= '<tr>';
                $reportData .= '<td>' . $teacher . '</td>';
                $reportData .= '<td>' . $bookCount . '</td>';
                $reportData .= '</tr>';
                $totalCounter = $totalCounter + $bookCount;
            } else {
                $loginCounts = DB::table('record_logins')
                    ->join('users', 'record_logins.id_number', '=', 'users.id_number')
                    ->whereBetween('record_logins.created_at', [$fromDate, $toDate])
                    ->where('users.role', '=', 2) // Add this line to specify teachers
                    ->where('users.office_or_department', 'LIKE', '%' . trim($teacher) . '%') // Modified this line
                    ->select('users.office_or_department', DB::raw('COUNT(DISTINCT record_logins.id_number) as login_count'))
                    ->groupBy('users.office_or_department')
                    ->orderByRaw("CASE 
                        WHEN office_or_department LIKE '%7%' THEN 1
                        WHEN office_or_department LIKE '%8%' THEN 2
                        WHEN office_or_department LIKE '%9%' THEN 3
                        WHEN office_or_department LIKE '%10%' THEN 4
                        WHEN office_or_department LIKE '%11%' THEN 5
                        WHEN office_or_department LIKE '%12%' THEN 6
                        ELSE 7 END")
                    ->first();
            
                $reportData .= '<tr>';
                $reportData .= '<td>' . $teacher . '</td>';
                $reportData .= '<td>' . ($loginCounts ? $loginCounts->login_count : 0) . '</td>';
                $reportData .= '</tr>';
                $totalCounter += $loginCounts ? $loginCounts->login_count : 0;
            }
        }
    }

        $reportData .= '<tr>';

        $reportData .= '</tr>';
        $reportData .= '</tbody>';
        $reportData .= '</table>';
        if($itemType == 'overAll'){
            $reportData .= '<p style="text-align: right; padding-right: 237px;"> '. $totalText1.': ' . $totalCounter . '</p>';
        }else if($reportType == 'attendanceLogs'){
            $reportData .= '<p style="text-align: right; padding-right: 237px;"> '. $totalText.': ' . $totalCounter . '</p>';
        }else{
            $reportData .= '<p style="text-align: right; padding-right: 50px;"></p>';
        }
        $reportData .= '<br><br><br><br><br>';
        $reportData .= '<p style="text-align: right;  padding-right: 260px;">PREPARED BY:</p><br>';
        $reportData .= '<footer>
        <p style="font-size: 16px;text-align: right;  padding-right: 290px; font-weight: bold;margin: 0px;"><u>' . Auth::user()->name . '</u></p>
        <p style="font-style: italic;text-align: right;  padding-right: 280px; margin-left: 10px; margin-top:0px;">Librarian</p>
      </footer>';
        $reportData .= '<br>';
        $reportData .= '<p style="text-align: right; font-style: italic;">Generated on: ' . date('Y-m-d H:i:s') . '</p><br>';
        $mpdf = new Mpdf(['orientation' => 'L']);
        // $mpdf->WriteHTML('<h1>Report</h1>');
        $mpdf->WriteHTML($reportData);
        $mpdf->Output('report.pdf', 'I');
    }

    public function markAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }
}
