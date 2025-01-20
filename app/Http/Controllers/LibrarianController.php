<?php

namespace App\Http\Controllers;

use Mpdf\Mpdf;
use Carbon\Carbon;
use App\Models\Book;
use App\Models\User;
use App\Models\Guest;
use SimpleXMLElement;
use App\Models\Author;
use App\Models\BookSection;
use App\Models\RecordLogin;
use App\Models\Transaction;
use App\Models\BookLocation;
use Illuminate\Http\Request;
use App\Models\BookTransaction;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class LibrarianController extends Controller
{
    private function pixelateImage($imagePath, $blockSize = 10)
    {
        // Add error checking
        if (!File::exists($imagePath)) {
            \Log::error("Image file not found: " . $imagePath);
            return false;
        }

        // Get image info
        $imageInfo = @getimagesize($imagePath);
        if (!$imageInfo) {
            \Log::error("Failed to get image info: " . $imagePath);
            return false;
        }

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
        
        if ($request->hasFile('book_cover')) {
            $path = $request->file('book_cover')->store('public/book_covers');
            $fullPath = storage_path('app/' . $path);
            $directory = dirname($fullPath);
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0755, true);
            }
            if ($request->file('book_cover')->move(dirname($fullPath), basename($fullPath))) {
                $this->pixelateImage($fullPath);
                $validated['book_cover'] = basename($path);
            }
        }

        $validated['added_by'] = Auth::user()->name;
        $book = Book::create($validated);

        $file_ID = $book->getKey();
        $path = public_path('storage/BookQRCodes/');
        $filename = $file_ID . '.png';

        if (!File::exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }

        // Generate QR code image
        $qrImage = QrCode::style('square')
            ->eye('circle')
            ->size(400)
            ->margin(1) // Removed margin around QR code
            ->color(0, 0, 0)
            ->backgroundColor(255, 255, 255)
            ->format('png')
            ->merge(public_path('logo.png'), 0.12, true)
            ->generate($file_ID);

        // Create a new image with space for text
        $image = imagecreatefromstring($qrImage);
        $imageWidth = imagesx($image);
        $imageHeight = imagesy($image);
        $newHeight = $imageHeight + 52 ; // Reduced extra space for text

        $newImage = imagecreatetruecolor($imageWidth, $newHeight);
        $white = imagecolorallocate($newImage, 255, 255, 255);
        imagefill($newImage, 0, 0, $white);

        // Copy QR code to new image
        imagecopy($newImage, $image, 0, 0, 0, 0, $imageWidth, $imageHeight);

        // Add text
        $black = imagecolorallocate($newImage, 0, 0, 0);
        $font = public_path('fonts/arial.ttf'); // Ensure this font exists

        // Get author name
        $author = Author::find($book->author_id);
        $authorName = $author ? $author->author : '';
        $title = $book->book_title;

        // Calculate text dimensions for centering
        $fontSize = 12;

        $bboxTitle = imagettfbbox($fontSize, 0, $font, $title);
        $titleWidth = abs($bboxTitle[4] - $bboxTitle[0]);
        $titleX = ($imageWidth - $titleWidth) / 2;
        $titleY = $imageHeight + 15; // Place title just below the QR code

        // Calculate author text position with tighter spacing
        $bboxAuthor = imagettfbbox($fontSize, 0, $font, $authorName);
        $authorWidth = abs($bboxAuthor[4] - $bboxAuthor[0]);
        $authorX = ($imageWidth - $authorWidth) / 2;
        $authorY = $titleY + $fontSize + 10; // Reduce gap to simulate a 3-pixel margin

        // Add centered text
        imagettftext($newImage, $fontSize, 0, $titleX, $titleY, $black, $font, $title);
        imagettftext($newImage, $fontSize, 0, $authorX, $authorY, $black, $font, $authorName);

        // Save the final image
        imagepng($newImage, $path . $filename);
        imagedestroy($image);
        imagedestroy($newImage);

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
            'accession' => $request->accession,
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

        $pendingStudents = User::where('role', '=', -1)
        // ->where('status', 'inactive')
        ->get();
    
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
        $students = User::where('role', 0) 
        ->orWhere('role', 3)
        ->get();

        return view('pagesLibrarian.accountLists', compact('students'));
    }

    public function showStudentInfo($student)
{
    $student = User::findOrFail($student);
    return view('pagesLibrarian.studentinfo', compact('student'));
}

    public function accountListsTeacher()
    {
        $teachers = User::where('role', '=', 2)->get();

        return view('pagesLibrarian.accountListsTeacher', [
            'teachers' => $teachers
        ]);
    }

    public function showTeacherInfo($teacher)
{
    $teacher = User::findOrFail($teacher);
    return view('pagesLibrarian.teacherinfo', compact('teacher'));
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

        // //Save QR code as image in a specific folder
        $path = public_path('storage/StudentQrCodes/'); // path to folder where image will be saved

        if (!File::exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }
        $filename = $user->name . '.png'; // name of the image file

        QrCode::style('square')
            ->eye('circle')// Use PNG format for the merged image
            ->size(400)
            ->margin(1)
            ->color(0, 0, 0)
            ->backgroundColor(255, 255, 255)
            ->format('png')
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
        $filename = $user->name . '.png'; // name of the image file


        QrCode::style('square')
            ->eye('circle')// Use PNG format for the merged image
            ->size(400)
            ->margin(1)
            ->color(0, 0, 0)
            ->backgroundColor(255, 255, 255)
            ->format('png')
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
        $users = User::where('role', 0) //GET ONLY THE ROLE "0" (students)
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

    //START Borrowing Options
    public function borrowingFormTeacher()
    {
        $users = User::where('role', 2) //GET ONLY THE ROLE 2 TEACHER
            ->orderBy('name', 'ASC')
            ->get();

        $books = Book::where('is_available', '!=', 0) //get only the available && copies available && FUNCTIONAL
        ->where('available_copies', '>', 0)
            ->where('book_condition', '=', 'functional')
            ->orderBy('book_title', 'ASC')
            ->get();

        return view('pagesLibrarian.borrowBookTeacher', [
            'users' => $users,
            'books' => $books,
        ]);
    }

    public function registerBorrowerTeacher(Request $request)
    {
        $request->validate([
            'user_id'              => 'required|exists:users,id',
            'expected_return_date' => 'required|date',
            'books'                => 'required|array|max:3',
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

        return redirect()->back()->with('success', 'Book Borrowed Recorded Successfully!');
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
            

        $penalty = 0;
        $currentdate = date("Y-m-d");
        $expectedReturnDate = $user->expected_return_date;

        // Calculate the number of days overdue
        $daysOverdue = (strtotime($currentdate) - strtotime($expectedReturnDate)) / (60 * 60 * 24);

        if ($daysOverdue > 0) {
            $penalty = $daysOverdue; // Assuming penalty is 1 per day overdue
        }

        foreach ($bookTransactions as $bookTransaction) {
            $bookTransaction->fines = $penalty;
        }
        
        return view('pagesLibrarian.borrowUpdate', [
            'user' => $user,
            'bookTransactions' => $bookTransactions,

        ]);

        $penalty = 0;
        $currentdate = date("Y-m-d");
        // echo $currentdate;
        // echo $user->expected_return_date;
        if ($currentdate > $user->expected_return_date){
            $penalty = 1;
            // echo "penalty";
        }

        
        $bookTransactions->fines = $penalty;
        // echo ($bookTransactions);
        
        return view('pagesLibrarian.borrowUpdate', [
            'user' => $user,
            'bookTransactions' => $bookTransactions,

        ]);



        // $user = DB::table('transactions')
        //     ->select('users.*', 'transactions.*') //gettinG all the User Details    
        //     ->join('users', 'users.id', '=', 'transactions.user_id')
        //     ->where('transactions.id', $transaction)
        //     ->first();

        // $bookTransactions = DB::table('book_transactions')
        //     ->select('book_transactions.*', 'books.*', 'book_transactions.id')
        //     ->join('books', 'books.id', '=', 'book_transactions.book_id')
        //     ->where('transaction_id', $transaction)
        //     ->get();

        // $penalty = 0;
        // $currentdate = date("Y-m-d");
        // if ($currentdate > $user->expected_return_date) {
        //     $penalty = 1;
        // }
        // $bookTransactions[0]->fines = $penalty;
        // echo $bookTransactions[0]->fines;
    }

    public function returnBook(Request $request)
    {
        if (!empty($request->transactionIDs)) {
            for ($i = 0; $i < count($request->transactionIDs); $i++) {

                $Book = BookTransaction::where('id', $request->transactionIDs[$i]);
                $Book->update([
                    'returned_at' => $request->returned_dates[$i],
                    'return_book_condition' => $request->returned_book_conditions[$i],
                    'fines' => isset($request->fines[$i]) ? $request->fines[$i] : null,
                    'remarks' => $request->remarks[$i],
                ]);

                if ($request->returned_book_conditions[$i] == 'functional') {
                    $bookToUpdate = BookTransaction::where('id', $request->transactionIDs[$i])->first();
                    Book::where('id', $bookToUpdate->book_id)->increment('available_copies', 1); // returned book will be added to copies
                }
            }
            return redirect()->route('borrowerLists')->with('success', 'Return Books Successfully.');
        } else {
            return redirect()->back()->with('error', 'Check at least one book to return');
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

        $sections = BookSection::all();
        $authors = Author::all();
        $locations = BookLocation::all();
        $guests = Guest::all();


        return view('pagesLibrarian.generateReport', [
            'sections' => $sections, //section is addded to the page
            'locations' => $locations,
            'authors' => $authors,
            'guests' => $guests,
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
    // Get all transactions for the user
    $transactions = Transaction::where('user_id', $id)
        ->with(['bookTransactions', 'user'])
        ->orderBy('borrowed_at', 'desc')
        ->get();

    if ($transactions->isNotEmpty()) {
        $books = [];
        foreach ($transactions as $transaction) {
            foreach ($transaction->bookTransactions as $bookTransaction) {
                $book = Book::with('author')->where('id', $bookTransaction->book_id)->first();
                if ($book) {
                    $books[$transaction->id][] = $book;
                }
            }
        }

        return view('pagesLibrarian.transaction', [
            'transactions' => $transactions,
            'booksMap' => $books,
        ]);
    }

    return back()->with('error', 'No transactions found for this user.');
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

    public function guestForm()
    {
        $guests = Guest::all(); //GET ALL GUESTS

        return view('pagesLibrarian.guest', compact('guests'));
  
    }
    
    public function recordGuests(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'school' => 'nullable|string|max:255',
            'purpose' => 'required|string|max:255',
        ]);

        Guest::create($validated);

        return redirect()->back()->with('success', 'Guest information recorded successfully.');
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
    }

    public function updateStudentsRecord(Request $request)
    {
        $users = User::where('grade_and_section', $request->grade_levelA)->get();

        if ($users->isNotEmpty()) {
            foreach ($users as $user) {
                $user->update([
                    'grade_and_section' => $request->grade_levelB
                ]);
            }
            return redirect()->back()->with('success', 'Records were successfully updated');
        }

        return redirect()->back()->with('error', 'No students found in that grade level');
    }

    public function deleteGrade12Students()
    {
        $grade12Students = User::where('grade_and_section', 'Grade-12')
            ->where('role', 0) // Ensure we're only getting students
            ->get();
        
        if ($grade12Students->isEmpty()) {
            return redirect()->back()->with('error', 'No Grade 12 students found');
        }

        foreach ($grade12Students as $student) {
            // Delete QR code if exists
            $qrPath = public_path('storage/StudentQrCodes/' . $student->id . '.png');
            if (File::exists($qrPath)) {
                File::delete($qrPath);
            }
            
            // Delete ID picture if exists
            if ($student->id_pic) {
                $idPath = storage_path('app/public/IDPic/' . $student->id_pic);
                if (File::exists($idPath)) {
                    File::delete($idPath);
                }

                $idPublicPath = public_path('storage/IDPic/' . $student->id_pic);
                if (File::exists($idPublicPath)) {
                    File::delete($idPublicPath);
                }
            }

            // Delete avatar if exists
            if ($student->avatar) {
                $avatarPath = storage_path('app/public/avatar/' . $student->avatar);
                if (File::exists($avatarPath)) {
                    File::delete($avatarPath);
                }

                $avatarPublicPath = public_path('storage/avatar/' . $student->avatar);
                if (File::exists($avatarPublicPath)) {
                    File::delete($avatarPublicPath);
                }
            }
            
            // Update student record instead of deleting
            $student->update([
                'grade_and_section' => null,
                'birthdate' => null,
                'contact_number' => null,
                'email' => null,
                'avatar' => null,
                'role' => 3, // Role for graduated students
                'id_pic' => null,
                'status' => 'graduated',
                'last_grade_level' => 'Grade-12 Graduate'
            ]);
        }

        return redirect()->back()->with('success', 'All Grade 12 students have been marked as Graduated and their files have been deleted');
    }

    public function printGeneratedReport(Request $request)
    {
        $userType = $request->input('usersType');
        $reportType = $request->input('reportType');
        $logType = $request->input('logType');
        $itemType = $request->input('itemType');
        $sectionType = $request->input('sectionType');
        $locationType = $request->input('locationType');
        $authorType = $request->input('authorType');
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $totalCounter = 0;

        if ($itemType == 'sequence') {
            $statistical = 'Monthly Statistics of Books Borrowed';
   
            }else if($itemType == 'overAll') {
            $statistical = 'Summary of Books Borrowed';
            $totalText1 = 'Total Number of  Book/s Borrowed';
            }else {
                $statistical = 'Statistical Record of Library Users';
                $totalText = 'Total Number of Library Users';
            }
            
            $reportData = '';

            $reportData = '<h3 style="text-align: center;">Bukidnon National High School Library Management System</h3>' . '<h3 style="text-align: center;">Malaybalay City</h3>'
            .  '<h2 style="text-align: center;">'. $statistical .'</h2>';
        $reportData .= '<p style="text-align: center; font-style: italic;">'. date('F d', strtotime($fromDate)) . ' - ' . date('d, Y', strtotime($toDate)).'</p>';
    
        
    
        if ($reportType == 'attendanceLogs') {
            if ($logType == 'monthly_record') {
                $reportData .= '<table border="1" style="width: 100%; text-align: center;">
                                <thead>
                                    <tr>
                                        <th>Grade Level</th>
                                        <th>Number of Library Users</th>
                                    </tr>
                                </thead>
                                <tbody>';
                    // Handle students if userType is 'students'
                if ($userType == 'students') {
                    $students = DB::table('users')->where('role', 0)->pluck('grade_and_section');
                    $students = ['Grade 7', 'Grade 8', 'Grade 9', 'Grade 10', 'Grade 11', 'Grade 12'];
                    $studentCount = 1;
                    $totalCounter = 0;
    
                    foreach ($students as $student) {
                        $loginCounts = DB::table('record_logins')
                            ->join('users', 'record_logins.id_number', '=', 'users.id_number')
                            ->whereBetween('record_logins.created_at', [$fromDate, $toDate])
                            ->where('users.grade_and_section', $student)
                            ->select('users.grade_and_section', DB::raw('COUNT(record_logins.id) as login_count'))
                            ->groupBy('users.grade_and_section')    
                            ->orderByDesc('login_count')
                            ->first();
    
                            $reportData .= '<tr>';
                            $reportData .= '<td>' . $student . '</td>';
                            $reportData .= '<td>' . ($loginCounts ? $loginCounts->login_count : 0) . '</td>';
                            $reportData .= '</tr>';
                            $totalCounter += $loginCounts ? $loginCounts->login_count : 0;
                    }
                }

                    // Handle Teachers if userType is 'teachers'
                if ($userType == 'teachers') {
                    $teachers = DB::table('users')->where('role', 2)->pluck('office_or_department');
                    $teachers = ['Grade 7 Teacher', 'Grade 8 Teacher', 'Grade 9 Teacher', 'Grade 10 Teacher', 'Grade 11 Teacher', 'Grade 12 Teacher'];

                    $totalCounter = 0;
    
                    foreach ($teachers as $teacher) {
                        $loginCounts = DB::table('record_logins')
                            ->join('users', 'record_logins.id_number', '=', 'users.id_number')
                            ->whereBetween('record_logins.created_at', [$fromDate, $toDate])
                            ->where('users.office_or_department', $teacher)
                            ->select('users.office_or_department', DB::raw('COUNT(record_logins.id) as login_count'))
                            ->groupBy('users.office_or_department')
                            ->orderByDesc('login_count')
                            ->first();
    
                            $reportData .= '<tr>';
                            $reportData .= '<td>' . $teacher . '</td>';
                            $reportData .= '<td>' . ($loginCounts ? $loginCounts->login_count : 0) . '</td>';
                            $reportData .= '</tr>';
                            $totalCounter += $loginCounts ? $loginCounts->login_count : 0;
                    }
                }

                    // Handle both Students and Teachers if userType is 'all'
                if ($userType == 'all') {
                    $students = DB::table('users')->where('role', 0)->pluck('grade_and_section');
                    $students = ['Grade 7', 'Grade 8', 'Grade 9', 'Grade 10', 'Grade 11', 'Grade 12'];

                    $teachers = DB::table('users')->where('role', 2)->pluck('office_or_department');
                    $teachers = ['Grade 7 Teacher', 'Grade 8 Teacher', 'Grade 9 Teacher', 'Grade 10 Teacher', 'Grade 11 Teacher', 'Grade 12 Teacher'];
                    
                    $totalCounter = 0;

                    foreach ($students as $student) {
                        $loginCounts = DB::table('record_logins')
                            ->join('users', 'record_logins.id_number', '=', 'users.id_number')
                            ->whereBetween('record_logins.created_at', [$fromDate, $toDate])
                            ->where('users.grade_and_section', $student)
                            ->select('users.grade_and_section', DB::raw('COUNT(record_logins.id) as login_count'))
                            ->groupBy('users.grade_and_section')    
                            ->orderByDesc('login_count')
                            ->first();
    
                            $reportData .= '<tr>';
                            $reportData .= '<td>' . $student . '</td>';
                            $reportData .= '<td>' . ($loginCounts ? $loginCounts->login_count : 0) . '</td>';
                            $reportData .= '</tr>';
                            $totalCounter += $loginCounts ? $loginCounts->login_count : 0;
                    }
    
                    foreach ($teachers as $teacher) {
                        $loginCounts = DB::table('record_logins')
                            ->join('users', 'record_logins.id_number', '=', 'users.id_number')
                            ->whereBetween('record_logins.created_at', [$fromDate, $toDate])
                            ->where('users.office_or_department', $teacher)
                            ->select('users.office_or_department', DB::raw('COUNT(record_logins.id) as login_count'))
                            ->groupBy('users.office_or_department')
                            ->orderByDesc('login_count')
                            ->first();
    
                            $reportData .= '<tr>';
                            $reportData .= '<td>' . $teacher . '</td>';
                            $reportData .= '<td>' . ($loginCounts ? $loginCounts->login_count : 0) . '</td>';
                            $reportData .= '</tr>';
                            $totalCounter += $loginCounts ? $loginCounts->login_count : 0;
                    }
                }
    
                if ($userType == 'guests') {
                    $guestCount = 1;
                    $guestCounts = DB::table('guests')
                        ->whereBetween('created_at', [$fromDate, $toDate])
                        ->select('name', 'school', 'purpose', 'created_at')
                        ->orderByDesc('created_at')
                        ->get();
    
                    foreach ($guestCounts as $guest) {
                        $reportData .= '<tr>';
                        $reportData .= '<td>' . $guestCount++ . '</td>';
                        $reportData .= '<td>' . $guest->name . '</td>';
                        $reportData .= '<td>' . $guest->school . '</td>';
                        $reportData .= '<td>' . $guest->purpose . '</td>';
                        $reportData .= '<td>' . Carbon::parse($guest->created_at)->format('M d, Y h:i A') . '</td>';
                        $reportData .= '</tr>';
                    }
                }
    
                
            } elseif ($logType == 'top3') {
                $reportData .= '<table border="1" style="width: 100%; text-align: center;">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>ID Number</th>
                                        <th>Grade Level</th>
                                        <th>Section</th>
                                        <th>Number of Logins</th>
                                    </tr>
                                </thead>
                                <tbody>';
    
                if ($userType == 'students') {
                    $students = DB::table('users')->where('role', 0)->pluck('grade_and_section');
                    $studentCount = 1;
    
                    foreach ($students as $student) {
                        $loginCounts = DB::table('record_logins')
                            ->join('users', 'record_logins.id_number', '=', 'users.id_number')
                            ->whereBetween('record_logins.created_at', [$fromDate, $toDate])
                            ->where('users.grade_and_section', $student)
                            ->select('users.grade_and_section', 'users.name', 'users.id_number', 'users.section', DB::raw('COUNT(record_logins.id) as login_count'))
                            ->groupBy('users.grade_and_section', 'users.name', 'users.id_number', 'users.section')
                            ->orderByDesc('login_count')
                            ->get();
    
                        foreach ($loginCounts->take(3) as $loginCount) {
                            $reportData .= '<tr>';
                            $reportData .= '<td>' . $studentCount++ . '</td>';
                            $reportData .= '<td>' . $loginCount->name . '</td>';
                            $reportData .= '<td>' . $loginCount->id_number . '</td>';
                            $reportData .= '<td>' . $loginCount->grade_and_section . '</td>';
                            $reportData .= '<td>' . $loginCount->section . '</td>';
                            $reportData .= '<td>' . $loginCount->login_count . '</td>';
                            $reportData .= '</tr>';
                        }
                    }
                }
    
                
            }
        } elseif ($reportType == 'borrowed') {
            if ($itemType == 'sequence') {
                $reportData .= '<table border="1" style="width: 100%; text-align: center;">
                                <thead>
                                    <tr>
                                        <th>Date Borrowed</th>
                                        <th>Borrowers Name</th>
                                        <th>Grade Level</th>
                                        <th>Title of Books</th>
                                        <th>Author</th>
                                        <th>Accession Number</th>
                                        <th>Pub.Yr/Copyright</th>
                                        <th>Due Date</th>
                                        <th>Fines</th>
                                    </tr>
                                </thead>
                                <tbody>';
    
                if($userType == 'students') {
                    $students = DB::table('users')->where('role', 0)->pluck('grade_and_section');
                   

                    foreach($students as $student) {
                        $query = DB::table('transactions')
                            ->join('users', 'transactions.user_id', '=', 'users.id')
                            ->join('book_transactions', 'transactions.id', '=', 'book_transactions.transaction_id')
                            ->join('books', 'book_transactions.book_id', '=', 'books.id')
                            ->join('authors', 'books.author_id', '=', 'authors.id')
                            ->select('transactions.borrowed_at', 'users.name as borrower_name', 'users.grade_and_section', 'books.book_title', 'authors.author', 'books.accession', 'publication_year', 'transactions.expected_return_date', 'book_transactions.fines')
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
                    
                        foreach ($bookTransactions as $bookTransaction) {
                            $reportData .= '<tr>';
                            $reportData .= '<td>' . Carbon::parse($bookTransaction->borrowed_at)->format('M d, Y') . '</td>';
                            $reportData .= '<td>' . $bookTransaction->borrower_name . '</td>';
                            $reportData .= '<td>' . $bookTransaction->grade_and_section . '</td>';
                            $reportData .= '<td>' . $bookTransaction->book_title . '</td>';
                            $reportData .= '<td>' . $bookTransaction->author . '</td>';
                            $reportData .= '<td>' . $bookTransaction->accession . '</td>';
                            $reportData .= '<td>' . $bookTransaction->publication_year . '</td>';
                            $reportData .= '<td>' . Carbon::parse($bookTransaction->expected_return_date)->format('M d, Y') . '</td>';
                            $reportData .= '<td>' . $bookTransaction->fines . '</td>';
                            $reportData .= '</tr>';
                        }

                    }
                }
                if($userType == 'teachers'){
                    $teachers = DB::table('users')->where('role', 2)->pluck('office_or_department');
                    $teachers = ['Grade 7 Teacher', 'Grade 8 Teacher', 'Grade 9 Teacher', 'Grade 10 Teacher', 'Grade 11 Teacher', 'Grade 12 Teacher'];  

                        foreach($teachers as $teacher){
                            $query = DB::table('transactions')
                            ->join('users', 'transactions.user_id', '=', 'users.id')
                            ->join('book_transactions', 'transactions.id', '=', 'book_transactions.transaction_id')
                            ->join('books', 'book_transactions.book_id', '=', 'books.id')
                            ->join('authors', 'books.author_id', '=', 'authors.id')
                            ->select('transactions.borrowed_at', 'users.name as borrower_name', 'users.office_or_department', 'books.book_title', 'authors.author', 'books.accession', 'publication_year', 'transactions.expected_return_date', 'book_transactions.fines')
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
                        foreach ($bookTransactions as $bookTransaction) {
                            $reportData .= '<tr>';
                            $reportData .= '<td>' . $bookTransaction->borrowed_at . '</td>';
                            $reportData .= '<td>' . $bookTransaction->borrower_name . '</td>';
                            $reportData .= '<td>' . $bookTransaction->office_or_department . '</td>';
                            $reportData .= '<td>' . $bookTransaction->book_title . '</td>';
                            $reportData .= '<td>' . $bookTransaction->author . '</td>';
                            $reportData .= '<td>' . $bookTransaction->accession . '</td>';
                            $reportData .= '<td>' . $bookTransaction->publication_year . '</td>';
                            $reportData .= '<td>' . $bookTransaction->expected_return_date . '</td>';
                            $reportData .= '<td>' . $bookTransaction->fines . '</td>';
                            $reportData .= '</tr>';
                        }
                     }
                }
                    if($userType == 'all'){

                        $students = DB::table('users')->where('role', 0)->pluck('grade_and_section');
                        $students = ['Grade 7', 'Grade 8', 'Grade 9', 'Grade 10', 'Grade 11', 'Grade 12'];

                        $teachers = DB::table('users')->where('role', 2)->pluck('office_or_department');
                        $teachers = ['Grade 7 Teacher', 'Grade 8 Teacher', 'Grade 9 Teacher', 'Grade 10 Teacher', 'Grade 11 Teacher', 'Grade 12 Teacher'];  
    
                        foreach($students as $student) {
                            $query = DB::table('transactions')
                                ->join('users', 'transactions.user_id', '=', 'users.id')
                                ->join('book_transactions', 'transactions.id', '=', 'book_transactions.transaction_id')
                                ->join('books', 'book_transactions.book_id', '=', 'books.id')
                                ->join('authors', 'books.author_id', '=', 'authors.id')
                                ->select('transactions.borrowed_at', 'users.name as borrower_name', 'users.grade_and_section', 'books.book_title', 'authors.author', 'books.accession', 'publication_year', 'transactions.expected_return_date', 'book_transactions.fines')
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
                        
                            foreach ($bookTransactions as $bookTransaction) {
                                $reportData .= '<tr>';
                                $reportData .= '<td>' . Carbon::parse($bookTransaction->borrowed_at)->format('M d, Y h:i A') . '</td>';
                                $reportData .= '<td>' . $bookTransaction->borrower_name . '</td>';
                                $reportData .= '<td>' . $bookTransaction->grade_and_section . '</td>';
                                $reportData .= '<td>' . $bookTransaction->book_title . '</td>';
                                $reportData .= '<td>' . $bookTransaction->author . '</td>';
                                $reportData .= '<td>' . $bookTransaction->accession . '</td>';
                                $reportData .= '<td>' . $bookTransaction->publication_year . '</td>';
                                $reportData .= '<td>' . Carbon::parse($bookTransaction->expected_return_date)->format('M d, Y h:i A') . '</td>';
                                $reportData .= '<td>' . $bookTransaction->fines . '</td>';
                                $reportData .= '</tr>';
                            }
    
                        }
                        foreach($teachers as $teacher){
                            $query = DB::table('transactions')
                            ->join('users', 'transactions.user_id', '=', 'users.id')
                            ->join('book_transactions', 'transactions.id', '=', 'book_transactions.transaction_id')
                            ->join('books', 'book_transactions.book_id', '=', 'books.id')
                            ->join('authors', 'books.author_id', '=', 'authors.id')
                            ->select('transactions.borrowed_at', 'users.name as borrower_name', 'users.office_or_department', 'books.book_title', 'authors.author', 'books.accession', 'publication_year', 'transactions.expected_return_date', 'book_transactions.fines')
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
                        foreach ($bookTransactions as $bookTransaction) {
                            $reportData .= '<tr>';
                            $reportData .= '<td>' . Carbon::parse($bookTransaction->borrowed_at)->format('M d, Y h:i A') . '</td>';
                            $reportData .= '<td>' . $bookTransaction->borrower_name . '</td>';
                            $reportData .= '<td>' . $bookTransaction->office_or_department . '</td>';
                            $reportData .= '<td>' . $bookTransaction->book_title . '</td>';
                            $reportData .= '<td>' . $bookTransaction->author . '</td>';
                            $reportData .= '<td>' . $bookTransaction->accession . '</td>';
                            $reportData .= '<td>' . $bookTransaction->publication_year . '</td>';
                            $reportData .= '<td>' . Carbon::parse($bookTransaction->expected_return_date)->format('M d, Y h:i A') . '</td>';
                            $reportData .= '<td>' . $bookTransaction->fines . '</td>';
                            $reportData .= '</tr>';
                        }
                     }
                    }
                    
                

    
                
            } elseif ($itemType == 'overAll') {
                $reportData .= '<table border="1" style="width: 100%; text-align: center;">
                                <thead>
                                    <tr>
                                        <th>Grade Level</th>
                                        <th>Number of borrowed books</th>
                                    </tr>
                                </thead>
                                <tbody>';
                if($userType == 'students'){
                $students = DB::table('users')->where('role', 0)->pluck('grade_and_section');
                $students = ['Grade 7', 'Grade 8', 'Grade 9', 'Grade 10', 'Grade 11', 'Grade 12']; 
                $totalCounter = 0;

    
                foreach ($students as $student) {
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
                }
    
                
             }
             if($userType == 'teachers'){
                $teachers = DB::table('users')->where('role', 2)->pluck('office_or_department');
                $teachers = ['Grade 7 Teacher', 'Grade 8 Teacher', 'Grade 9 Teacher', 'Grade 10 Teacher', 'Grade 11 Teacher', 'Grade 12 Teacher'];
                $totalCounter = 0;

                foreach($teachers as $teacher){
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
                }
                

             }
             if($userType == 'all'){
                $students = DB::table('users')->where('role', 0)->pluck('grade_and_section');
                $students = ['Grade 7', 'Grade 8', 'Grade 9', 'Grade 10', 'Grade 11', 'Grade 12'];

                $teachers = DB::table('users')->where('role', 2)->pluck('office_or_department');
                $teachers = ['Grade 7 Teacher', 'Grade 8 Teacher', 'Grade 9 Teacher', 'Grade 10 Teacher', 'Grade 11 Teacher', 'Grade 12 Teacher'];  
                $totalCounter = 0;

                foreach ($students as $student) {
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
                }
                foreach($teachers as $teacher){
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
                }
                
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
        <p style="font-size: 16px;text-align: right;  padding-right: 240px; font-weight: bold;margin: 0px;"><u>' . Auth::user()->name . '</u></p>
        <p style="font-style: italic;text-align: right;  padding-right: 280px; margin-left: 10px; margin-top:0px;">Librarian</p>
      </footer>';
        $reportData .= '<br>';
        $reportData .= '<p style="text-align: right; font-style: italic;">Generated on: ' . date('Y-m-d H:i:s') . '</p><br>';
    
        // Generate the PDF
        $mpdf = new Mpdf(['orientation' => 'L']);
        $mpdf->WriteHTML($reportData);
        $mpdf->Output('report.pdf', 'I');
    }


    public function markAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }

    public function studentUpdate(Request $request, $student)
    {
        // Validate the request input
        $validated = $request->validate([
            'id_number' => 'required|string|max:255',
            'grade_and_section' => 'nullable|string|max:255',
            'status' => 'required|string|in:active,graduated',
        ]);

        // Find the student record (assuming $student is the student ID)
        $student = User::findOrFail($student);

        // Update student fields
        $student->id_number = $validated['id_number'];

        if (isset($validated['grade_and_section'])) {
            $student->grade_and_section = $validated['grade_and_section'];
            $student->last_grade_level = null;
        } else {
            $student->grade_and_section = $student->grade_and_section;
        }

        // Update role based on status
        if ($validated['status'] === 'active') {
            $student->role = 0;
        } elseif ($validated['status'] === 'graduated') {
            $student->role = 3;
        }

        // Save the updated student record
        $student->save();

        return redirect()->back()->with('success', 'Student information updated successfully.', compact('student'));
    }

    public function teacherUpdate(Request $request, $teacher)
    {
        // Validate the request input
        $validated = $request->validate([
            'id_number' => 'required|string|max:255',
            'office_or_department' => 'nullable|string|max:255',
            'status' => 'required|string|in:active,Inactive',
        ]);

        // Find the teacher record (assuming $teacher is the teacher ID)
        $teacher = User::findOrFail($teacher);

        // Update teacher fields
        $teacher->id_number = $validated['id_number'];

        if (isset($validated['office_or_department'])) {
            $teacher->office_or_department = $validated['office_or_department'];
            $teacher->last_grade_level = null;
        } else {
            $teacher->office_or_department = $teacher->office_or_department;
        }

        // Update role based on status
        // if ($validated['status'] === 'active') {
        //     $teacher->role = 2;
        // } elseif ($validated['status'] === 'InActive') {
        //     $teacher->role = 2;
        // }

        // Save the updated teacher record
        $teacher->save();

        return redirect()->back()->with('success', 'Student information updated successfully.', compact('teacher'));
    }

}
