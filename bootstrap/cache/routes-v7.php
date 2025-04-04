<?php

/*
|--------------------------------------------------------------------------
| Load The Cached Routes
|--------------------------------------------------------------------------
|
| Here we will decode and unserialize the RouteCollection instance that
| holds all of the route information for an application. This allows
| us to instantaneously load the entire route map into the router.
|
*/

app('router')->setCompiledRoutes(
    array (
  'compiled' => 
  array (
    0 => false,
    1 => 
    array (
      '/biscolab-recaptcha/validate' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ihHho8KRQG36E8MF',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/sanctum/csrf-cookie' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'sanctum.csrf-cookie',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/_ignition/health-check' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ignition.healthCheck',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/_ignition/execute-solution' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ignition.executeSolution',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/_ignition/update-config' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ignition.updateConfig',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::xatEsQj9OsZtfwD0',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::sBv1sbkv1RXANAuk',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'loginForm',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'login',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/user' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'roleUsers',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/user/student/signup' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'signupForm',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'signup',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/user/teacher/signup' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'signupForms',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'signup_teacher',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/account/profile' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'userProfile',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'profile',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/account/updateProfile' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'updateProfile',
          ),
          1 => NULL,
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/account/updatePassword' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'updatePassword',
          ),
          1 => NULL,
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'logout',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/test' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::2bdL8lHcckoCBWP7',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'testing',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inquire/books' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'inquireBooks',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/guest-login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'guestRecord',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/record-guest' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'formGuest',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/Student/dashboard' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'studentDashboard',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/Student/book/all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'StudentbookLists',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/Student/transactions/all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'studentBorrowed',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/Teacher/dashboard' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'teacherDashboard',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/Teacher/book/all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'teacherbookLists',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/Teacher/transactions/all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'teacherBorrowed',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/Librarian/mark-as-delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'mark-as-delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/Librarian/dashboard' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'librarianDashboard',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/Librarian/borrow/form/student' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'borrowingForm',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'registerBorrower',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/Librarian/borrow/form/teacher' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'borrowingFormTeacher',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'registerBorrowerTeacher',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/Librarian/borrow/lists' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'borrowerLists',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/Librarian/borrow/return' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'returnedBook',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/Librarian/borrow/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'returnBook',
          ),
          1 => NULL,
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/Librarian/book/add' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'addBook',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'registerBook',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/Librarian/book/add/registerAuthor' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'registerAuthor',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/Librarian/book/add/registerLocation' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'registerLocation',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/Librarian/book/list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'bookLists',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/Librarian/book/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'updateBook',
          ),
          1 => NULL,
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/Librarian/pending/students' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'accountPending',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'confirmAccount',
          ),
          1 => NULL,
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        2 => 
        array (
          0 => 
          array (
            '_route' => 'deleteAccount',
          ),
          1 => NULL,
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/Librarian/all/students' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'accountLists',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/Librarian/generate/report' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generateReport',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'printGeneratedReport',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/Librarian/generate/report/data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'fetchLocationsAndAuthors',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/Librarian/pending/teachers' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'accountPendingTeacher',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'confirmAccountTeacher',
          ),
          1 => NULL,
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        2 => 
        array (
          0 => 
          array (
            '_route' => 'deleteAccountTeacher',
          ),
          1 => NULL,
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/Librarian/all/teachers' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'accountListsTeacher',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/Librarian/records/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'updateStudents',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'updateStudentsRecord',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        2 => 
        array (
          0 => 
          array (
            '_route' => 'deleteGrade12Students',
          ),
          1 => NULL,
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/Librarian/transactions' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'studentTransactions',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/Librarian/transaction/logs' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'studentLogbooks',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/Librarian/records/recordLogins' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'recordLogins',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/Librarian/guest' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'guestForm',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/Librarian/record-guests' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'recordGuests',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/SuperAdmin/dashboard' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'superadminDashboard',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
    ),
    2 => 
    array (
      0 => '{^(?|/Student/book/info/([^/]++)(*:34)|/Teacher/book/info/([^/]++)(*:68)|/Librarian/(?|bo(?|rrow/update/([^/]++)(*:114)|ok/(?|delete/([^/]++)(*:143)|info/([^/]++)(*:164)))|all/(?|students/info/(?|([^/]++)(?|(*:209))|regenerate/([^/]++)(*:237))|teachers/info/([^/]++)(?|(*:271)))|Librarian/transaction/([^/]++)(*:311)|transaction/logs/delete/([^/]++)(*:351)|record\\-guests/([^/]++)(*:382)|students/([^/]++)/update\\-password(?|(*:427)|(*:435))))/?$}sDu',
    ),
    3 => 
    array (
      34 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'bookInfoStudent',
          ),
          1 => 
          array (
            0 => 'book',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      68 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'bookInfoteacher',
          ),
          1 => 
          array (
            0 => 'book',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      114 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'updateBorrow',
          ),
          1 => 
          array (
            0 => 'transaction',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      143 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'deleteBook',
          ),
          1 => 
          array (
            0 => 'book',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      164 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'bookInfo',
          ),
          1 => 
          array (
            0 => 'book',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      209 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'studentDetails',
          ),
          1 => 
          array (
            0 => 'student',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'studentUpdate',
          ),
          1 => 
          array (
            0 => 'student',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      237 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'regenerateQrCode',
          ),
          1 => 
          array (
            0 => 'student',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      271 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'teacherDetails',
          ),
          1 => 
          array (
            0 => 'teacher',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'teacherUpdate',
          ),
          1 => 
          array (
            0 => 'teacher',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      311 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'transaction',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      351 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'delete.student.logbook',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      382 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'deleteGuest',
          ),
          1 => 
          array (
            0 => 'guest',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      427 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'librarian.updatePassword',
          ),
          1 => 
          array (
            0 => 'student',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      435 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'librarian.updatePasswordTeacher',
          ),
          1 => 
          array (
            0 => 'teacher',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => NULL,
          1 => NULL,
          2 => NULL,
          3 => NULL,
          4 => false,
          5 => false,
          6 => 0,
        ),
      ),
    ),
    4 => NULL,
  ),
  'attributes' => 
  array (
    'generated::ihHho8KRQG36E8MF' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'biscolab-recaptcha/validate',
      'action' => 
      array (
        'uses' => 'Biscolab\\ReCaptcha\\Controllers\\ReCaptchaController@validateV3',
        'controller' => 'Biscolab\\ReCaptcha\\Controllers\\ReCaptchaController@validateV3',
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'generated::ihHho8KRQG36E8MF',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'sanctum.csrf-cookie' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'sanctum/csrf-cookie',
      'action' => 
      array (
        'uses' => 'Laravel\\Sanctum\\Http\\Controllers\\CsrfCookieController@show',
        'controller' => 'Laravel\\Sanctum\\Http\\Controllers\\CsrfCookieController@show',
        'namespace' => NULL,
        'prefix' => 'sanctum',
        'where' => 
        array (
        ),
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'sanctum.csrf-cookie',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ignition.healthCheck' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '_ignition/health-check',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'Spatie\\LaravelIgnition\\Http\\Middleware\\RunnableSolutionsEnabled',
        ),
        'uses' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\HealthCheckController@__invoke',
        'controller' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\HealthCheckController',
        'as' => 'ignition.healthCheck',
        'namespace' => NULL,
        'prefix' => '_ignition',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ignition.executeSolution' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '_ignition/execute-solution',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'Spatie\\LaravelIgnition\\Http\\Middleware\\RunnableSolutionsEnabled',
        ),
        'uses' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\ExecuteSolutionController@__invoke',
        'controller' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\ExecuteSolutionController',
        'as' => 'ignition.executeSolution',
        'namespace' => NULL,
        'prefix' => '_ignition',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ignition.updateConfig' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '_ignition/update-config',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'Spatie\\LaravelIgnition\\Http\\Middleware\\RunnableSolutionsEnabled',
        ),
        'uses' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\UpdateConfigController@__invoke',
        'controller' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\UpdateConfigController',
        'as' => 'ignition.updateConfig',
        'namespace' => NULL,
        'prefix' => '_ignition',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::xatEsQj9OsZtfwD0' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/user',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:77:"function (\\Illuminate\\Http\\Request $request) {
    return $request->user();
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"00000000000005480000000000000000";}}',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::xatEsQj9OsZtfwD0',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::sBv1sbkv1RXANAuk' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '/',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AccountController@index',
        'controller' => 'App\\Http\\Controllers\\AccountController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::sBv1sbkv1RXANAuk',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'loginForm' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AccountController@loginForm',
        'controller' => 'App\\Http\\Controllers\\AccountController@loginForm',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'loginForm',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'login' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AccountController@loginUser',
        'controller' => 'App\\Http\\Controllers\\AccountController@loginUser',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'login',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'roleUsers' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'user',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AccountController@roleUsers',
        'controller' => 'App\\Http\\Controllers\\AccountController@roleUsers',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'roleUsers',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'signupForm' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'user/student/signup',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AccountController@signupForm',
        'controller' => 'App\\Http\\Controllers\\AccountController@signupForm',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'signupForm',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'signup' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'user/student/signup',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AccountController@registerUser',
        'controller' => 'App\\Http\\Controllers\\AccountController@registerUser',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'signup',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'signupForms' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'user/teacher/signup',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AccountController@signupForms',
        'controller' => 'App\\Http\\Controllers\\AccountController@signupForms',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'signupForms',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'signup_teacher' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'user/teacher/signup',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AccountController@registerUsers',
        'controller' => 'App\\Http\\Controllers\\AccountController@registerUsers',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'signup_teacher',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'userProfile' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'account/profile',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AccountController@profile',
        'controller' => 'App\\Http\\Controllers\\AccountController@profile',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'userProfile',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'profile' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'account/profile',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AccountController@profile',
        'controller' => 'App\\Http\\Controllers\\AccountController@profile',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'profile',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'updateProfile' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'account/updateProfile',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AccountController@updateProfile',
        'controller' => 'App\\Http\\Controllers\\AccountController@updateProfile',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'updateProfile',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'updatePassword' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'account/updatePassword',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AccountController@updatePassword',
        'controller' => 'App\\Http\\Controllers\\AccountController@updatePassword',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'updatePassword',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'logout' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'logout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AccountController@logout',
        'controller' => 'App\\Http\\Controllers\\AccountController@logout',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'logout',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::2bdL8lHcckoCBWP7' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'test',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\TestController@test',
        'controller' => 'App\\Http\\Controllers\\TestController@test',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::2bdL8lHcckoCBWP7',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'testing' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'test',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\TestController@testing',
        'controller' => 'App\\Http\\Controllers\\TestController@testing',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'testing',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'inquireBooks' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inquire/books',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AccountController@inquireBooks',
        'controller' => 'App\\Http\\Controllers\\AccountController@inquireBooks',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'inquireBooks',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'guestRecord' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'guest-login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AccountController@guestRecord',
        'controller' => 'App\\Http\\Controllers\\AccountController@guestRecord',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'guestRecord',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'formGuest' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'record-guest',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AccountController@formGuest',
        'controller' => 'App\\Http\\Controllers\\AccountController@formGuest',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'formGuest',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'studentDashboard' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'Student/dashboard',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isStudent',
        ),
        'uses' => 'App\\Http\\Controllers\\StudentController@studentDashboard',
        'controller' => 'App\\Http\\Controllers\\StudentController@studentDashboard',
        'namespace' => NULL,
        'prefix' => '/Student',
        'where' => 
        array (
        ),
        'as' => 'studentDashboard',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'StudentbookLists' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'Student/book/all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isStudent',
        ),
        'uses' => 'App\\Http\\Controllers\\StudentController@StudentbookLists',
        'controller' => 'App\\Http\\Controllers\\StudentController@StudentbookLists',
        'namespace' => NULL,
        'prefix' => '/Student',
        'where' => 
        array (
        ),
        'as' => 'StudentbookLists',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'studentBorrowed' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'Student/transactions/all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isStudent',
        ),
        'uses' => 'App\\Http\\Controllers\\StudentController@studentBorrowed',
        'controller' => 'App\\Http\\Controllers\\StudentController@studentBorrowed',
        'namespace' => NULL,
        'prefix' => '/Student',
        'where' => 
        array (
        ),
        'as' => 'studentBorrowed',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'bookInfoStudent' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'Student/book/info/{book}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isStudent',
        ),
        'uses' => 'App\\Http\\Controllers\\StudentController@bookInfo',
        'controller' => 'App\\Http\\Controllers\\StudentController@bookInfo',
        'namespace' => NULL,
        'prefix' => '/Student',
        'where' => 
        array (
        ),
        'as' => 'bookInfoStudent',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'teacherDashboard' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'Teacher/dashboard',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isTeacher',
        ),
        'uses' => 'App\\Http\\Controllers\\TeacherController@teacherDashboard',
        'controller' => 'App\\Http\\Controllers\\TeacherController@teacherDashboard',
        'namespace' => NULL,
        'prefix' => '/Teacher',
        'where' => 
        array (
        ),
        'as' => 'teacherDashboard',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'teacherbookLists' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'Teacher/book/all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isTeacher',
        ),
        'uses' => 'App\\Http\\Controllers\\TeacherController@teacherbookLists',
        'controller' => 'App\\Http\\Controllers\\TeacherController@teacherbookLists',
        'namespace' => NULL,
        'prefix' => '/Teacher',
        'where' => 
        array (
        ),
        'as' => 'teacherbookLists',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'teacherBorrowed' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'Teacher/transactions/all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isTeacher',
        ),
        'uses' => 'App\\Http\\Controllers\\TeacherController@teacherBorrowed',
        'controller' => 'App\\Http\\Controllers\\TeacherController@teacherBorrowed',
        'namespace' => NULL,
        'prefix' => '/Teacher',
        'where' => 
        array (
        ),
        'as' => 'teacherBorrowed',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'bookInfoteacher' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'Teacher/book/info/{book}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isTeacher',
        ),
        'uses' => 'App\\Http\\Controllers\\TeacherController@teacherbookInfo',
        'controller' => 'App\\Http\\Controllers\\TeacherController@teacherbookInfo',
        'namespace' => NULL,
        'prefix' => '/Teacher',
        'where' => 
        array (
        ),
        'as' => 'bookInfoteacher',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'mark-as-delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'Librarian/mark-as-delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isLibrarian',
        ),
        'uses' => 'App\\Http\\Controllers\\LibrarianController@markAsDelete',
        'controller' => 'App\\Http\\Controllers\\LibrarianController@markAsDelete',
        'namespace' => NULL,
        'prefix' => '/Librarian',
        'where' => 
        array (
        ),
        'as' => 'mark-as-delete',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'librarianDashboard' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'Librarian/dashboard',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isLibrarian',
        ),
        'uses' => 'App\\Http\\Controllers\\LibrarianController@dashboard',
        'controller' => 'App\\Http\\Controllers\\LibrarianController@dashboard',
        'namespace' => NULL,
        'prefix' => '/Librarian',
        'where' => 
        array (
        ),
        'as' => 'librarianDashboard',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'borrowingForm' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'Librarian/borrow/form/student',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isLibrarian',
        ),
        'uses' => 'App\\Http\\Controllers\\LibrarianController@borrowingForm',
        'controller' => 'App\\Http\\Controllers\\LibrarianController@borrowingForm',
        'namespace' => NULL,
        'prefix' => '/Librarian',
        'where' => 
        array (
        ),
        'as' => 'borrowingForm',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'registerBorrower' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'Librarian/borrow/form/student',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isLibrarian',
        ),
        'uses' => 'App\\Http\\Controllers\\LibrarianController@registerBorrower',
        'controller' => 'App\\Http\\Controllers\\LibrarianController@registerBorrower',
        'namespace' => NULL,
        'prefix' => '/Librarian',
        'where' => 
        array (
        ),
        'as' => 'registerBorrower',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'borrowingFormTeacher' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'Librarian/borrow/form/teacher',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isLibrarian',
        ),
        'uses' => 'App\\Http\\Controllers\\LibrarianController@borrowingFormTeacher',
        'controller' => 'App\\Http\\Controllers\\LibrarianController@borrowingFormTeacher',
        'namespace' => NULL,
        'prefix' => '/Librarian',
        'where' => 
        array (
        ),
        'as' => 'borrowingFormTeacher',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'registerBorrowerTeacher' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'Librarian/borrow/form/teacher',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isLibrarian',
        ),
        'uses' => 'App\\Http\\Controllers\\LibrarianController@registerBorrowerTeacher',
        'controller' => 'App\\Http\\Controllers\\LibrarianController@registerBorrowerTeacher',
        'namespace' => NULL,
        'prefix' => '/Librarian',
        'where' => 
        array (
        ),
        'as' => 'registerBorrowerTeacher',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'borrowerLists' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'Librarian/borrow/lists',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isLibrarian',
        ),
        'uses' => 'App\\Http\\Controllers\\LibrarianController@borrowerLists',
        'controller' => 'App\\Http\\Controllers\\LibrarianController@borrowerLists',
        'namespace' => NULL,
        'prefix' => '/Librarian',
        'where' => 
        array (
        ),
        'as' => 'borrowerLists',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'returnedBook' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'Librarian/borrow/return',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isLibrarian',
        ),
        'uses' => 'App\\Http\\Controllers\\LibrarianController@returnedBook',
        'controller' => 'App\\Http\\Controllers\\LibrarianController@returnedBook',
        'namespace' => NULL,
        'prefix' => '/Librarian',
        'where' => 
        array (
        ),
        'as' => 'returnedBook',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'updateBorrow' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'Librarian/borrow/update/{transaction}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isLibrarian',
        ),
        'uses' => 'App\\Http\\Controllers\\LibrarianController@updateBorrow',
        'controller' => 'App\\Http\\Controllers\\LibrarianController@updateBorrow',
        'namespace' => NULL,
        'prefix' => '/Librarian',
        'where' => 
        array (
        ),
        'as' => 'updateBorrow',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'returnBook' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'Librarian/borrow/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isLibrarian',
        ),
        'uses' => 'App\\Http\\Controllers\\LibrarianController@returnBook',
        'controller' => 'App\\Http\\Controllers\\LibrarianController@returnBook',
        'namespace' => NULL,
        'prefix' => '/Librarian',
        'where' => 
        array (
        ),
        'as' => 'returnBook',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'addBook' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'Librarian/book/add',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isLibrarian',
        ),
        'uses' => 'App\\Http\\Controllers\\LibrarianController@addForm',
        'controller' => 'App\\Http\\Controllers\\LibrarianController@addForm',
        'namespace' => NULL,
        'prefix' => '/Librarian',
        'where' => 
        array (
        ),
        'as' => 'addBook',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'registerBook' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'Librarian/book/add',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isLibrarian',
        ),
        'uses' => 'App\\Http\\Controllers\\LibrarianController@registerBook',
        'controller' => 'App\\Http\\Controllers\\LibrarianController@registerBook',
        'namespace' => NULL,
        'prefix' => '/Librarian',
        'where' => 
        array (
        ),
        'as' => 'registerBook',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'registerAuthor' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'Librarian/book/add/registerAuthor',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isLibrarian',
        ),
        'uses' => 'App\\Http\\Controllers\\LibrarianController@registerAuthor',
        'controller' => 'App\\Http\\Controllers\\LibrarianController@registerAuthor',
        'namespace' => NULL,
        'prefix' => '/Librarian',
        'where' => 
        array (
        ),
        'as' => 'registerAuthor',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'registerLocation' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'Librarian/book/add/registerLocation',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isLibrarian',
        ),
        'uses' => 'App\\Http\\Controllers\\LibrarianController@registerLocation',
        'controller' => 'App\\Http\\Controllers\\LibrarianController@registerLocation',
        'namespace' => NULL,
        'prefix' => '/Librarian',
        'where' => 
        array (
        ),
        'as' => 'registerLocation',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'bookLists' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'Librarian/book/list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isLibrarian',
        ),
        'uses' => 'App\\Http\\Controllers\\LibrarianController@bookLists',
        'controller' => 'App\\Http\\Controllers\\LibrarianController@bookLists',
        'namespace' => NULL,
        'prefix' => '/Librarian',
        'where' => 
        array (
        ),
        'as' => 'bookLists',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'deleteBook' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'Librarian/book/delete/{book}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isLibrarian',
        ),
        'uses' => 'App\\Http\\Controllers\\LibrarianController@deleteBook',
        'controller' => 'App\\Http\\Controllers\\LibrarianController@deleteBook',
        'namespace' => NULL,
        'prefix' => '/Librarian',
        'where' => 
        array (
        ),
        'as' => 'deleteBook',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'bookInfo' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'Librarian/book/info/{book}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isLibrarian',
        ),
        'uses' => 'App\\Http\\Controllers\\LibrarianController@bookInfo',
        'controller' => 'App\\Http\\Controllers\\LibrarianController@bookInfo',
        'namespace' => NULL,
        'prefix' => '/Librarian',
        'where' => 
        array (
        ),
        'as' => 'bookInfo',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'updateBook' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'Librarian/book/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isLibrarian',
        ),
        'uses' => 'App\\Http\\Controllers\\LibrarianController@updateBook',
        'controller' => 'App\\Http\\Controllers\\LibrarianController@updateBook',
        'namespace' => NULL,
        'prefix' => '/Librarian',
        'where' => 
        array (
        ),
        'as' => 'updateBook',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'accountPending' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'Librarian/pending/students',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isLibrarian',
        ),
        'uses' => 'App\\Http\\Controllers\\LibrarianController@accountPending',
        'controller' => 'App\\Http\\Controllers\\LibrarianController@accountPending',
        'namespace' => NULL,
        'prefix' => '/Librarian',
        'where' => 
        array (
        ),
        'as' => 'accountPending',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'confirmAccount' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'Librarian/pending/students',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isLibrarian',
        ),
        'uses' => 'App\\Http\\Controllers\\LibrarianController@confirmAccount',
        'controller' => 'App\\Http\\Controllers\\LibrarianController@confirmAccount',
        'namespace' => NULL,
        'prefix' => '/Librarian',
        'where' => 
        array (
        ),
        'as' => 'confirmAccount',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'deleteAccount' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'Librarian/pending/students',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isLibrarian',
        ),
        'uses' => 'App\\Http\\Controllers\\LibrarianController@deleteAccount',
        'controller' => 'App\\Http\\Controllers\\LibrarianController@deleteAccount',
        'namespace' => NULL,
        'prefix' => '/Librarian',
        'where' => 
        array (
        ),
        'as' => 'deleteAccount',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'accountLists' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'Librarian/all/students',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isLibrarian',
        ),
        'uses' => 'App\\Http\\Controllers\\LibrarianController@accountLists',
        'controller' => 'App\\Http\\Controllers\\LibrarianController@accountLists',
        'namespace' => NULL,
        'prefix' => '/Librarian',
        'where' => 
        array (
        ),
        'as' => 'accountLists',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generateReport' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'Librarian/generate/report',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isLibrarian',
        ),
        'uses' => 'App\\Http\\Controllers\\LibrarianController@generateReport',
        'controller' => 'App\\Http\\Controllers\\LibrarianController@generateReport',
        'namespace' => NULL,
        'prefix' => '/Librarian',
        'where' => 
        array (
        ),
        'as' => 'generateReport',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'fetchLocationsAndAuthors' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'Librarian/generate/report/data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isLibrarian',
        ),
        'uses' => 'App\\Http\\Controllers\\LibrarianController@fetchLocationsAndAuthors',
        'controller' => 'App\\Http\\Controllers\\LibrarianController@fetchLocationsAndAuthors',
        'namespace' => NULL,
        'prefix' => '/Librarian',
        'where' => 
        array (
        ),
        'as' => 'fetchLocationsAndAuthors',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'studentDetails' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'Librarian/all/students/info/{student}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isLibrarian',
        ),
        'uses' => 'App\\Http\\Controllers\\LibrarianController@showStudentInfo',
        'controller' => 'App\\Http\\Controllers\\LibrarianController@showStudentInfo',
        'namespace' => NULL,
        'prefix' => '/Librarian',
        'where' => 
        array (
        ),
        'as' => 'studentDetails',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'studentUpdate' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'Librarian/all/students/info/{student}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isLibrarian',
        ),
        'uses' => 'App\\Http\\Controllers\\LibrarianController@studentUpdate',
        'controller' => 'App\\Http\\Controllers\\LibrarianController@studentUpdate',
        'namespace' => NULL,
        'prefix' => '/Librarian',
        'where' => 
        array (
        ),
        'as' => 'studentUpdate',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'regenerateQrCode' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'Librarian/all/students/info/regenerate/{student}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isLibrarian',
        ),
        'uses' => 'App\\Http\\Controllers\\LibrarianController@regenerateQrCode',
        'controller' => 'App\\Http\\Controllers\\LibrarianController@regenerateQrCode',
        'namespace' => NULL,
        'prefix' => '/Librarian',
        'where' => 
        array (
        ),
        'as' => 'regenerateQrCode',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'teacherDetails' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'Librarian/all/teachers/info/{teacher}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isLibrarian',
        ),
        'uses' => 'App\\Http\\Controllers\\LibrarianController@showTeacherInfo',
        'controller' => 'App\\Http\\Controllers\\LibrarianController@showTeacherInfo',
        'namespace' => NULL,
        'prefix' => '/Librarian',
        'where' => 
        array (
        ),
        'as' => 'teacherDetails',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'teacherUpdate' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'Librarian/all/teachers/info/{teacher}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isLibrarian',
        ),
        'uses' => 'App\\Http\\Controllers\\LibrarianController@teacherUpdate',
        'controller' => 'App\\Http\\Controllers\\LibrarianController@teacherUpdate',
        'namespace' => NULL,
        'prefix' => '/Librarian',
        'where' => 
        array (
        ),
        'as' => 'teacherUpdate',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'accountPendingTeacher' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'Librarian/pending/teachers',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isLibrarian',
        ),
        'uses' => 'App\\Http\\Controllers\\LibrarianController@accountPendingTeacher',
        'controller' => 'App\\Http\\Controllers\\LibrarianController@accountPendingTeacher',
        'namespace' => NULL,
        'prefix' => '/Librarian',
        'where' => 
        array (
        ),
        'as' => 'accountPendingTeacher',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'confirmAccountTeacher' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'Librarian/pending/teachers',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isLibrarian',
        ),
        'uses' => 'App\\Http\\Controllers\\LibrarianController@confirmAccountTeacher',
        'controller' => 'App\\Http\\Controllers\\LibrarianController@confirmAccountTeacher',
        'namespace' => NULL,
        'prefix' => '/Librarian',
        'where' => 
        array (
        ),
        'as' => 'confirmAccountTeacher',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'deleteAccountTeacher' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'Librarian/pending/teachers',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isLibrarian',
        ),
        'uses' => 'App\\Http\\Controllers\\LibrarianController@deleteAccountTeacher',
        'controller' => 'App\\Http\\Controllers\\LibrarianController@deleteAccountTeacher',
        'namespace' => NULL,
        'prefix' => '/Librarian',
        'where' => 
        array (
        ),
        'as' => 'deleteAccountTeacher',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'accountListsTeacher' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'Librarian/all/teachers',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isLibrarian',
        ),
        'uses' => 'App\\Http\\Controllers\\LibrarianController@accountListsTeacher',
        'controller' => 'App\\Http\\Controllers\\LibrarianController@accountListsTeacher',
        'namespace' => NULL,
        'prefix' => '/Librarian',
        'where' => 
        array (
        ),
        'as' => 'accountListsTeacher',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'updateStudents' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'Librarian/records/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isLibrarian',
        ),
        'uses' => 'App\\Http\\Controllers\\LibrarianController@updateStudents',
        'controller' => 'App\\Http\\Controllers\\LibrarianController@updateStudents',
        'namespace' => NULL,
        'prefix' => '/Librarian',
        'where' => 
        array (
        ),
        'as' => 'updateStudents',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'updateStudentsRecord' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'Librarian/records/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isLibrarian',
        ),
        'uses' => 'App\\Http\\Controllers\\LibrarianController@updateStudentsRecord',
        'controller' => 'App\\Http\\Controllers\\LibrarianController@updateStudentsRecord',
        'namespace' => NULL,
        'prefix' => '/Librarian',
        'where' => 
        array (
        ),
        'as' => 'updateStudentsRecord',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'deleteGrade12Students' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'Librarian/records/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isLibrarian',
        ),
        'uses' => 'App\\Http\\Controllers\\LibrarianController@deleteGrade12Students',
        'controller' => 'App\\Http\\Controllers\\LibrarianController@deleteGrade12Students',
        'namespace' => NULL,
        'prefix' => '/Librarian',
        'where' => 
        array (
        ),
        'as' => 'deleteGrade12Students',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'printGeneratedReport' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'Librarian/generate/report',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isLibrarian',
        ),
        'uses' => 'App\\Http\\Controllers\\LibrarianController@printGeneratedReport',
        'controller' => 'App\\Http\\Controllers\\LibrarianController@printGeneratedReport',
        'namespace' => NULL,
        'prefix' => '/Librarian',
        'where' => 
        array (
        ),
        'as' => 'printGeneratedReport',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'studentTransactions' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'Librarian/transactions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isLibrarian',
        ),
        'uses' => 'App\\Http\\Controllers\\LibrarianController@studentTransactions',
        'controller' => 'App\\Http\\Controllers\\LibrarianController@studentTransactions',
        'namespace' => NULL,
        'prefix' => '/Librarian',
        'where' => 
        array (
        ),
        'as' => 'studentTransactions',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'transaction' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'Librarian/Librarian/transaction/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isLibrarian',
        ),
        'uses' => 'App\\Http\\Controllers\\LibrarianController@studentTransaction',
        'controller' => 'App\\Http\\Controllers\\LibrarianController@studentTransaction',
        'namespace' => NULL,
        'prefix' => '/Librarian',
        'where' => 
        array (
        ),
        'as' => 'transaction',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'studentLogbooks' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'Librarian/transaction/logs',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isLibrarian',
        ),
        'uses' => 'App\\Http\\Controllers\\LibrarianController@studentLogbook',
        'controller' => 'App\\Http\\Controllers\\LibrarianController@studentLogbook',
        'namespace' => NULL,
        'prefix' => '/Librarian',
        'where' => 
        array (
        ),
        'as' => 'studentLogbooks',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'recordLogins' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'Librarian/records/recordLogins',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isLibrarian',
        ),
        'uses' => 'App\\Http\\Controllers\\LibrarianController@recordLogins',
        'controller' => 'App\\Http\\Controllers\\LibrarianController@recordLogins',
        'namespace' => NULL,
        'prefix' => '/Librarian',
        'where' => 
        array (
        ),
        'as' => 'recordLogins',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'delete.student.logbook' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'Librarian/transaction/logs/delete/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isLibrarian',
        ),
        'uses' => 'App\\Http\\Controllers\\LibrarianController@deleteStudentLogbook',
        'controller' => 'App\\Http\\Controllers\\LibrarianController@deleteStudentLogbook',
        'namespace' => NULL,
        'prefix' => '/Librarian',
        'where' => 
        array (
        ),
        'as' => 'delete.student.logbook',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'guestForm' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'Librarian/guest',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isLibrarian',
        ),
        'uses' => 'App\\Http\\Controllers\\LibrarianController@guestForm',
        'controller' => 'App\\Http\\Controllers\\LibrarianController@guestForm',
        'namespace' => NULL,
        'prefix' => '/Librarian',
        'where' => 
        array (
        ),
        'as' => 'guestForm',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'recordGuests' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'Librarian/record-guests',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isLibrarian',
        ),
        'uses' => 'App\\Http\\Controllers\\LibrarianController@recordGuests',
        'controller' => 'App\\Http\\Controllers\\LibrarianController@recordGuests',
        'namespace' => NULL,
        'prefix' => '/Librarian',
        'where' => 
        array (
        ),
        'as' => 'recordGuests',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'deleteGuest' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'Librarian/record-guests/{guest}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isLibrarian',
        ),
        'uses' => 'App\\Http\\Controllers\\LibrarianController@deleteGuest',
        'controller' => 'App\\Http\\Controllers\\LibrarianController@deleteGuest',
        'namespace' => NULL,
        'prefix' => '/Librarian',
        'where' => 
        array (
        ),
        'as' => 'deleteGuest',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'librarian.updatePassword' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'Librarian/students/{student}/update-password',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isLibrarian',
        ),
        'uses' => 'App\\Http\\Controllers\\LibrarianController@updatePassword',
        'controller' => 'App\\Http\\Controllers\\LibrarianController@updatePassword',
        'namespace' => NULL,
        'prefix' => '/Librarian',
        'where' => 
        array (
        ),
        'as' => 'librarian.updatePassword',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'librarian.updatePasswordTeacher' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'Librarian/students/{teacher}/update-password',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isLibrarian',
        ),
        'uses' => 'App\\Http\\Controllers\\LibrarianController@updatePasswordTeacher',
        'controller' => 'App\\Http\\Controllers\\LibrarianController@updatePasswordTeacher',
        'namespace' => NULL,
        'prefix' => '/Librarian',
        'where' => 
        array (
        ),
        'as' => 'librarian.updatePasswordTeacher',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'superadminDashboard' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'SuperAdmin/dashboard',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'isSuperAdmin',
        ),
        'uses' => 'App\\Http\\Controllers\\SuperAdminController@dashboard',
        'controller' => 'App\\Http\\Controllers\\SuperAdminController@dashboard',
        'namespace' => NULL,
        'prefix' => '/SuperAdmin',
        'where' => 
        array (
        ),
        'as' => 'superadminDashboard',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
  ),
)
);
