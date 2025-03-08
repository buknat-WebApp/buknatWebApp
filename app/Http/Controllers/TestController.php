<?php

namespace App\Http\Controllers;

use App\Models\BookSection;
use App\Models\Book;

use Illuminate\Http\Request;

class TestController extends Controller
{
   public function test(){
   }

   public function testing(Request $request){

for ($i=0; $i < count($request->input('books')); $i++) {

    echo $request->input('books')[$i].'<br>';
    echo $request->input('remarks')[$i].'<br>';
    echo $request->input('returned_book_conditions')[$i].'<br>';
    echo $request->input('returned_dates')[$i].'<br>';



    echo'<hr>';
}

}


}
