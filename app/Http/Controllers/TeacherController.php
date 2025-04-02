<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookSection;
use App\Models\Transaction;
use PharIo\Manifest\Author;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TeacherController extends Controller
{
    public function teacherDashboard(){
        $user_id = Auth::user()->id;

        $transactions = Transaction::with(['user', 'bookTransactions'])
        ->where('user_id', $user_id)
        ->whereHas('bookTransactions', function($query) {
            $query->whereNull('returned_at');
        })
        ->orderBy('expected_return_date', 'desc')
        ->get();

        $books = Book::all();
        return view('pagesTeacher.dashboard' ,compact('transactions', 'books'));
    }

    public function teacherbookLists(){
        $booksWSections = BookSection::with(['books' => function($books) {
            $books->with(['author:id,author_id,author'])->get();
        }])->get();
        //  dd( $booksWSections[0]);
        // return view('admin.index', ['bookSections' => $booksWSections]);
        return view('pagesTeacher.bookLists',compact('booksWSections'));
    }

    public function teacherBorrowed(){
        $user_id = Auth::user()->id;
        $transactions = Transaction::with(['user', 'bookTransactions'])
        ->where('user_id', $user_id)
        ->whereHas('bookTransactions')
        ->orderBy('borrowed_at', 'desc')
        ->get();
        $books = Book::all();

        return view('pagesTeacher.borrowedLists', compact('transactions', 'books'));
    }

    public function teacherbookInfo($id){

        $book = Book::where('id', '=', $id)->first();
        $sections = BookSection::all();
        return view ('pagesTeacher.bookInfo', [
        'book' =>  $book ,
        'sections' => $sections,
       ]);
    }
}
