<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="" >
            <img src="{{ url('assets/assets/img/logo.png') }}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">BukNat - LMS</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    @if (Auth::user()->role == 0)
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('studentDashboard') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('studentBorrowed') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-books text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Borrowed Books</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link " href="{{ route('StudentbookLists') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">All Books</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('profile') }}"
                    onclick="event.preventDefault(); document.getElementById('profileUser').submit();">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 text-danger text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
        </ul>
    </div>

    @elseif (Auth::user()->role == 1)  {{--Checks if its admin or not --}}
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('librarianDashboard') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('addBook') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-books text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Book Options</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('borrowingForm') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Book Forms</span>
                    </a>
                </li>
                <hr>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('accountPending') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-app text-info text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1"> Accounts</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('profile') }}"
                        onclick="event.preventDefault(); document.getElementById('profileUser').submit();">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-02 text-danger text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Profile</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link " href="{{ route('studentTransactions') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-copy-04 text-info text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1"> Student Transactions</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('updateStudents') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-copy-04 text-info text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1"> Update Student Records</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('generateReport') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-copy-04 text-info text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1"> Generate Report</span>
                    </a>
                </li>

            </ul>
        </div>

        <div class="sidenav-footer mx-3 ">
        <div class="card card-plain shadow-none" id="sidenavCard">
            <img class="w-50 mx-auto" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAeFBMVEX///8AAAD7+/vo6OjMzMxqampWVlYoKCj29vYdHR3b29uOjo5gYGDIyMi0tLSpqakLCwuLi4uioqJ9fX1KSko2NjYRERG6urrV1dWFhYUWFhZvb28iIiLs7OxRUVFlZWVBQUGWlpY9PT12dnacnJwvLy/h4eFGRkaZ+m4uAAAGy0lEQVR4nO2d62KiMBBGQa2ioihaL7W6Uq2+/xuu1rWM5htCECFx5/wMOM0pkEwCBM/T0ejN95P2tjPzMYk2QhmM7/7qrLNtT+JBr/Fo4N5+yojVbPjLZt8rHrW57+j06jc80UkOhWIOtEfPFsMTX3PjiPPvfH6WGPr+59AoXuszr581hr4/yn8c12F+P4sMT61OM1+woYmfVYa+H+eJtTITtMvQD7UdZPPDUNAyQ9/XdI8LUz/7DP1BVpyBuaB9hn5GvzEvIGihob/nohQ5glYa+hEO0iskaKWhDzv/dTFBOw1hi5o7EXXC0A+UEMuCgn7fTsPNfQRtK/O9nUK2uRKlh4na4Q3TrS41uW9tsvZ977eCh2cLyidoJZlX1vpm74xztJ8zYa+FQ5+v+PRmR3a32MKDd0MjZutO07c2s89KbZHsI3hjat9J9+H6evPJj3rgRrRpgsr8E2y+AG9pag4i3j5aZ8W0jPUIOlyvRNyQunMEz+Ccs/1vK9y4qLXC5uC25HIewnSGHWJZC+w1LonNH7DlWHN1i7ABHtufLci92I2AeoFpy/k0bYHyXd21LQRqMc9degLK3WpHr6D2dHIqP6rFYd11LQiYzP4+Za7MoXURdMEF8NDWXdPCAJce8m7rQ1kKSLDnKC+vZl7iGUCZRC3MnPi3GnDbZYkmsdzsK84EqszEm6iFLgzsMaBj2Hk7tdD2qZkM1GFiiJofhw27isxGDB1DDMXQfsQwl6G6fxat9Id0xoukvmjIw/NRgaEapErDjlohMRRDMRRDMRRDMRTDxwyjdRMRkAd5iGFvN7myI9N5xHCG463J/6ZiQ272/x0aMlBDZhcySSiGYiiGYiiGYvgUQ/A0jcOG6qPRG2+8ad/jsGF477KZaCugYLVhKRQ2pG9V4czbdUM6tiCvCoihJ4alI4aeGIqhihiWjBh6r2RoNpuYw/Dh2cSyDXNgZJgDMRRDMRRDMRRDMRTDcjCqUOmGmif36oUxfCHE0H3E0H3E0H3E0H3E0BqS/i90ub20dIyL+7sovhL9wUGY2AmO/SzIa5p0BpccoC4upsMCshT6CMf2cZAqMm8yevrEtaAqpM7fpJgY0v8HWWSbqnzg2M9CDMXwBzEUw6cihv+xIS0m91BzGM5wkGdhZkiKaZ1vDIMrjS4tTiHiVRg2CPriIKXxNfu44mNWaZh1nDL3YGz70K+nvUp3pgty/qmvzma8s2Yaw7f66myGGIqh/YihGNrP6xvqv8RHVGo07BlBf9lfXhmTtG00/i1ekmlUahgefuNVsPwvWu80A2b9PpLAMfODzDLrFaw8Wo4hOWHNDCsYW4ihGF4QQzF8JmIohhde31Cf0zAfuuNeqykRasgsGk0rRwxbX7+fMtuQiWJquE9TVLq+8XQ+vFLBgvjUkPnWDl1zmhgyn3ajhsyHsqsdWzzVEH1mRAxLRww9MRRDMXw67hmqqyiNMvcv3ZDOLT1qCFLKN7ROVAWGuzQPG6avN6+32DD3h29yGlZxDCO890oNZoRFhjHeWwzFUAzFUAzFUAz/B8NHv39aumE8hESFDd+XcMnvmKwEXq1hDswMfbxLSIpf05CuIiuGYiiGYiiGYvg6hvu0mLnZW6PhUVnhPIMjMWxGKeSZxcZwDiFPIVab01iNGIqh/YihGNoPMFy91rfVQX408SZqIfMsmgMAw7G3VAuZKTQHAA80Jl5fLdR/OcVWwI302BuqhVYvAJRJrMrMkfajM8/10VZlFnDwUndFCwNcAjgAdfVCnKsq584dPOHx6O2DughVlc2pGDSmjvaI6OH382QCelRpXHdlC7ECJguPmXhxsdPvIZGfLaCJ9cOaa1sE9MjY5Yk40AL5/rDm6pqTII3LTUg8P1jBC7elsoAW/zaiK9S19vQAHSaZW2cutTZYIT0RUVtzopcV0yrwKUraS27hd1cGGWBI8cMi3eXI7BK6cDGumVPw5tFi5jQ+sbd90iZAWeeFm+4AzNZc6TPv4FnBYcxX/PYrspn3zL6Slo1na9BKMldLuTv7uFcFrnS30xDSrqY5itq3f3a65dZ8uzK4D5FxnmbTr8Qw42zEgDHup/5XkCpWZzY3RG9Ec3eb3TSECRmTGDhpyMw0wWGUk4bsG99c9uOaYcYr7ZH+1w4YZr6zr+sWXTBUOsJb+AzVEcORNslscJm6G4btPCMFw4vRKsOcKeSaeVnVesNp/omXgUEKZ41hV9PE3DHM7WiJYdd8jDNnXju20vCr2Lo1hyTP1xzrN/xIHpi+PkTgnpxVhptkof+1hsMgWq7ax29mUF2P4cf75m0SDw767u8vfymx3iHB6SwAAAAASUVORK5CYII="
                alt="sidebar_illustration">
            <div class="card-body text-center p-3 w-100 pt-0">
                <div class="docs-info">

                    <p class="text-xs font-weight-bold mb-0">Use the Scanner below for Record Keeping of the Library Visitors.</p>
                </div>
            </div>
        </div>
        <a href="/Librarian/transaction/logs" target="" class="btn btn-warning btn-sm w-100 mb-3">Scan Students' QR</a>
        {{-- <a href="" target="" class="btn btn-primary btn-sm mb-0 w-100" href="" type="button">Go to
            User Dashboard</a> --}}
    </div>


        @elseif (Auth::user()->role == 2)
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('teacherDashboard') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('teacherBorrowed') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-books text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Borrowed Books</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link " href="{{ route('teacherbookLists') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">All Books</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('profile') }}"
                    onclick="event.preventDefault(); document.getElementById('profileUser').submit();">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 text-danger text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
        </ul>
    </div>

    @endif
</aside>
