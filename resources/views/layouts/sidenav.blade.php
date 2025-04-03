<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
       id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
           aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="">
            <img src="{{ url('assets/assets/img/logo.png') }}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">BukNat - LMS</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    @if (Auth::user()->role == 0)
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('studentDashboard') ? 'active bg-primary bg-gradient ' : '' }}" href="{{ route('studentDashboard') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('studentBorrowed') ? 'active bg-primary bg-gradient ' : '' }}" href="{{ route('studentBorrowed') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-books text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Borrowed Books</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['StudentbookLists', 'bookInfoStudent']) ? 'active bg-primary bg-gradient ' : '' }}" href="{{ route('StudentbookLists') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">All Books</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('profile') ? 'active bg-primary bg-gradient ' : '' }}" href="{{ route('profile') }}"
                       onclick="event.preventDefault(); document.getElementById('profileUser').submit();">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-02 text-danger text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Profile</span>
                    </a>
                </li>

                <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('logout') ? 'active bg-primary bg-gradient ' : '' }}" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-sign-out-alt text-danger text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Log Out</span>
                </a>
            </li>

            </ul>
        </div>

    @elseif (Auth::user()->role == 1)
        {{--Checks if its admin or not --}}
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('librarianDashboard') ? 'active bg-primary bg-gradient ' : '' }}" href="{{ route('librarianDashboard') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['addBook','bookLists', 'bookInfo']) ? 'active bg-primary bg-gradient ' : '' }}" href="{{ route('addBook') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-books text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Book Options</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['borrowingForm', 'borrowingFormTeacher', 'borrowerLists', 'returnedBook', 'updateBorrow']) ? 'active bg-primary bg-gradient ' : '' }}" href="{{ route('borrowingForm') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Book/s Processing (Checkout)</span>
                    </a>
                </li>
                <hr>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['accountPending', 'accountPendingTeacher', 'accountLists', 'accountListsTeacher', 'studentDetails', 'teacherDetails']) ? 'active bg-primary bg-gradient ' : '' }}" href="{{ route('accountPending') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-app text-info text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1"> Account's User List</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('profile') ? 'active bg-primary bg-gradient ' : '' }}" href="{{ route('profile') }}"
                       onclick="event.preventDefault(); document.getElementById('profileUser').submit();">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-02 text-danger text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Profile</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['studentTransactions', 'transaction', 'studentLogbooks', 'guestForm']) ? 'active bg-primary bg-gradient ' : '' }}" href="{{ route('studentTransactions') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-copy-04 text-info text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1"> Student Transactions</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('updateStudents') ? 'active bg-primary bg-gradient ' : '' }}" href="{{ route('updateStudents') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-copy-04 text-info text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1"> Update Student Records</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('generateReport') ? 'active bg-primary bg-gradient ' : '' }}" href="{{ route('generateReport') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-copy-04 text-info text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1"> Generate Report</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('logout') ? 'active bg-primary bg-gradient ' : '' }}" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-sign-out-alt text-danger text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Log Out</span>
                    </a>
                </li>

            </ul>
        </div>
        <div class="sidenav-footer mx-3 ">
            <div class="card card-background shadow-none card-background-mask-warning border-light" id="sidenavCard">
                <div class="card-body text-start p-3 w-100">
                    <div class="icon icon-shape icon-sm bg-white shadow text-center mb-3 d-flex align-items-center justify-content-center border-radius-md">
                        <img class="w-80 mx-auto"
                             src="{{asset("assets/assets/img/qr.png")}}"
                             alt="sidebar_illustration">
                    </div>
                    <div class="docs-info">
                        <p class="text-xs font-weight-bold">Use the Scanner for Record Keeping of the Library Visitors.</p>
                        <a class="text-white btn bg-dark bg-gradient w-90" href="{{ route('studentLogbooks') }}" target=""
                           data-toggle="tooltip" data-placement="top"
                           title="Use the Scanner for Record Keeping of the Library Visitors." class="btn btn-white btn-sm bg-white w-100 mb-0">Scan User QR</a>
                    </div>
                </div>
            </div>
        </div>

    @elseif (Auth::user()->role == 2)
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('teacherDashboard') ? 'active bg-primary bg-gradient ' : '' }}" href="{{ route('teacherDashboard') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('teacherBorrowed') ? 'active bg-primary bg-gradient ' : '' }}" href="{{ route('teacherBorrowed') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-books text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Borrowed Books</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['teacherbookLists', 'bookInfoteacher']) ? 'active bg-primary bg-gradient ' : '' }}" href="{{ route('teacherbookLists') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">All Books</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('profile') ? 'active bg-primary bg-gradient ' : '' }}" href="{{ route('profile') }}"
                       onclick="event.preventDefault(); document.getElementById('profileUser').submit();">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-02 text-danger text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Profile</span>
                    </a>
                </li>

                <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('logout') ? 'active bg-primary bg-gradient ' : '' }}" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-sign-out-alt text-danger text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Logout</span>
                </a>
            </li>

            </ul>
        </div>

    @endif
</aside>
