import './bootstrap';
import '../css/app.css';

// Import DataTables
import $ from 'jquery';
import 'datatables.net-bs4';

$(document).ready(function () {
  $('#mytable').DataTable();
});

// Generic function to filter table rows based on input
function filterTable(searchInputId, tableId, columnsToSearch) {
  const searchInput = document.getElementById(searchInputId);
  const table = document.getElementById(tableId);

  if (searchInput && table) {
    searchInput.addEventListener('input', function () {
      const searchTerm = searchInput.value.toLowerCase();

      Array.from(table.rows).forEach(row => {
        const matches = columnsToSearch.some(index =>
          row.cells[index].textContent.toLowerCase().includes(searchTerm)
        );
        row.style.display = matches ? '' : 'none';
      });
    });
  }
}

// Apply search functionality to the users table
filterTable('search-student-borrow', 'users-table', [0, 1]);

// Apply search functionality to the books table
filterTable('search-book-toborrow', 'table-book-toborrow', [0, 1, 2]);

// Set the minimum date for the input element
const recipientNameInput = document.getElementById('recipient-name');
if (recipientNameInput) {
  const currentDate = new Date().toISOString().split('T')[0];
  recipientNameInput.setAttribute('min', currentDate);
}


// import './bootstrap';
// import '../css/app.css';

// // Import DataTables
// import $ from 'jquery';
// import 'datatables.net-bs4';

// $(document).ready(function () {
//   $('#mytable').DataTable();
// });


// //table in searching the user in the borrrowing form
//    // Get the search input and users table elements
//    const searchInput = document.getElementById('search-student-borrow');
//    const usersTable = document.getElementById('users-table');
// if(searchInput){

//     // Add an event listener to the search input
//    searchInput.addEventListener('input', function () {
//     // Get the search term
//     const searchTerm = searchInput.value.toLowerCase();

//     // Loop through each row in the users table
//     for (let i = 0; i < usersTable.rows.length; i++) {
//         const row = usersTable.rows[i];
//         const name = row.cells[0].textContent.toLowerCase();
//         const email = row.cells[1].textContent.toLowerCase();

//         // Check if the row matches the search term
//         if (name.includes(searchTerm) || email.includes(searchTerm)) {
//             row.style.display = '';
//         } else {
//             row.style.display = 'none';
//         }
//     }
// });
// }
   


//    //table in searching the BOOK in the borrrowing form
//    // Get the search input and users table elements
//    const searchInputBook = document.getElementById('search-book-toborrow');
//    const BooksToBorrowTable = document.getElementById('table-book-toborrow');

//    if(searchInputBook)
//    {
//     // Add an event listener to the search input
//    searchInputBook.addEventListener('input', function () {
//     // Get the search term
//     const searchBook = searchInputBook.value.toLowerCase();

//     // Loop through each row in the users table
//     for (let i = 0; i < BooksToBorrowTable.rows.length; i++) {
//         const rowBook = BooksToBorrowTable.rows[i];
//         const bookTitle = rowBook.cells[0].textContent.toLowerCase();
//         const bookAuthor = rowBook.cells[1].textContent.toLowerCase();
//         const bookID = rowBook.cells[2].textContent.toLowerCase();


//         // Check if the row matches the search term
//         if (bookTitle.includes(searchBook) || bookAuthor.includes(searchBook) || bookID.includes(searchBook)) {
//          rowBook.style.display = '';
//         } else {
//          rowBook.style.display = 'none';
//         }
//     }
// });

//    }


//     // Get the current date
//     var currentDate = new Date().toISOString().split('T')[0];

//     // Set the min attribute of the input element
//     var rannie = document.getElementById('recipient-name');
//     if(rannie)
//     {
//         rannie.setAttribute('min', currentDate);
//     }
    
    


