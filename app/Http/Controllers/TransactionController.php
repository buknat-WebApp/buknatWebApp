<?php

namespace App\Http\Controllers;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
   public function index($id)
   {
        $transaction = Transaction::findOrFail($id);
        //dd($transaction);
        foreach($transaction->books as $book)
        {
            echo $book->id . "--" . $book->author . "---" . $book->pivot->borrowed_book_condition . "--". $book->pivot->remarks . "<br>";
        }

      // $transaction->books()->attach([76,'Good' , '','', 'Active']);
       //
   }
}
