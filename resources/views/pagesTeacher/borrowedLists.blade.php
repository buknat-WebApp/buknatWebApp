@extends('layouts.app')

@section('content')
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="row gx-4">

                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            Borrowed Lists
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            In this page librarian see the borrowed books.
                        </p>
                    </div>
                </div>




                <div class="container-fluid py-4 mt-2">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="card mt-2"></div>
                            @if (session('success'))
                                <div class="alert-success alert-dismissible fade show" role="alert">
                                    <p class="text-center text-white">
                                        {{ session('success') }}
                                    </p>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close">x</button>
                                </div>
                            @endif
                            <div class="col-12">
                                <div class="card mb-4">
                                    <div class="card-header pb-0">
                                        <h6>Transactions</h6>
                                    </div>
                                    <div class="card-body px-0 pt-0 pb-2">
                                        <div class="table-responsive p-0">
                                            <table class="table align-items-center mb-0" id="mytable">
                                                <thead>
                                                    <tr>
                                                        <th
                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                            Date Borrowed</th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Return Date</th>
                                                        <th
                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Borrowed Book/s</th>
                                                        <th
                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Borrow Status</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {{-- @if ($transaction) --}}
                                                    @foreach ($transactions as $transaction)
                                                        <tr>



                                                            <td>
                                                                <p class="mb-1">
                                                                    {{ $transaction->borrowed_at }}</p>
                                                            </td>

                                                            <td class="align-middle text-center">
                                                                <p class=" mb-1">
                                                                    {{ $transaction->expected_return_date }}</p>
                                                            </td>

                                                            <td class="text-start">
                                                                <?php $count = 1; ?>
                                                                @foreach ($transaction->bookTransactions as $bookTransaction)
                                                                    @foreach ($books as $book)
                                                                        @if ($bookTransaction->book_id == $book->id)
                                                                            <p class="mb-1">
                                                                                {{ $count }} .
                                                                                {{ $book->book_title }} </p>

                                                                            <?php $count++; ?>
                                                                        @endif
                                                                    @endforeach
                                                                @endforeach

                                                            </td>

                                                            <td class="align-middle">
                                                                @foreach ($transaction->bookTransactions as $bookTransaction)
                                                                    @if (!is_null($bookTransaction->returned_at))
                                                                        <p
                                                                            class="text-center text-white font-weight-bold mb-1 bg-success bg-gradient">
                                                                            RETURNED
                                                                        </p>
                                                                    @else
                                                                        <p
                                                                            class="text-center text-white font-weight-bold mb-1 bg-danger bg-gradient">
                                                                            NOT YET RETURNED
                                                                        </p>
                                                                    @endif
                                                                @endforeach
                                                            </td>

                                                        </tr>
                                                        {{-- <hr> --}}
                                                        {{-- //END OF FOREACH's --}}
                                                    @endforeach
                                                    {{-- @endif --}}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- <div class="modal fade" id="returnBook" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Update Record</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="" >
                    <div class="row">
                        <div class="col">
                            <label for="user">Book</label>
                            <input type="text"  id="user" class="form-control" name="" id="">
                        </div>
                        <div class="col">
                            <label for="user"></label>

                            <input type="text"  id="user" name="return_book_condition[]" class="form-control" name="" id="">
                        </div>
                    </div>


                </form>

            </div>
            <div class="modal-footer">
              <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Open second modal</button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Modal 2</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              Hide this modal and show the first with the button below.
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary" data-bs-target="#returnBook" data-bs-toggle="modal">Back to first</button>
            </div>
          </div>
        </div>
      </div>
      <a class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Open first modal</a> --}}

    <!-- Modal -->
    {{-- <div class="modal fade" id="returnBook" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
     <div class="modal-dialog modal-md" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Validation</h5>
                 <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                     aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <p class="text-center">
                     Do you want to confirm this account?
                 </p>

                 <form method="POST" action="{{ route('confirmAccount') }}">
                     @csrf
                     @method('PUT')
                     <input type="text" id="ids" name="id_account">

                     <label for="named">Name:</label>
                     <input type="text" id="named" name="name" class="form-control" required>
                     <label for="name">ID Number:</label>
                     <input type="number" name="id_number" class="form-control" id="idNumber" required>
                     <div class="row">
                         <div class="col">
                             <label for="grades" class="text-warning">Grade Level Selected</label>
                             <input type="text" class="form-control" name="" id="grades">
                         </div>
                         <div class="col">
                             <label for="grade">Kindly Re- Select</label>
                             <select id="grade" name="grade_and_section" class="form-control" required>
                                 <option value="Grade-7"> Grade 7</option>
                                 <option value="Grade-8"> Grade 8</option>
                                 <option value="Grade-9"> Grade 9</option>
                                 <option value="Grade-10"> Grade 10</option>
                                 <option value="Grade-11"> Grade 11</option>
                                 <option value="Grade-12"> Grade 12</option>
                             </select>
                             <input type="number" value="1" hidden>
                         </div>
                     </div>


             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                 <button type="submit" class="btn btn-success ">Confirm</button>
             </div>
             </form>
         </div>
     </div>
 </div> --}}
@endsection
