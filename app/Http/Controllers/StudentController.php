<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Author;
use App\Models\BookSection;
use App\Models\Transaction;
use App\Models\BookLocation;
use Illuminate\Http\Request;
use App\Models\BookTransaction;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class StudentController extends Controller
{
    public function studentDashboard(){
        $user_id = Auth::user()->id;

        $transactions = Transaction::with(['user', 'bookTransactions'])
        ->where('user_id', $user_id)
        ->whereHas('bookTransactions', function($query) {
            $query->whereNull('returned_at');
        })
        ->orderBy('expected_return_date', 'desc')
        ->get();

        $books = Book::all();
        return view('pagesStudent.dashboard' ,compact('transactions', 'books'));
    }

    public function StudentbookLists(){
        $booksWSections = BookSection::with(['books' => function($books) {
            $books->with(['author:id,author_id,author'])->get();
        }])->get();
        //  dd( $booksWSections[0]);
        // return view('admin.index', ['bookSections' => $booksWSections]);
        return view('pagesStudent.bookLists',compact('booksWSections'));
    }

    public function studentBorrowed(){
        $user_id = Auth::user()->id;
        $transactions = Transaction::with(['user', 'bookTransactions'])
        ->where('user_id', $user_id)
        ->whereHas('bookTransactions')
        ->orderBy('borrowed_at', 'desc')
        ->get();
        $books = Book::all();

        return view('pagesStudent.borrowedLists', compact('transactions', 'books'));
    }

    public function bookInfo($id){

        $book = Book::where('id', '=', $id)->first();
        $sections = BookSection::all();
        $location = BookLocation::all();
        return view ('pagesStudent.bookInfo', [
        'book' =>  $book ,
        'sections' => $sections,
        'location' => $location,
       ]);
    }

}
