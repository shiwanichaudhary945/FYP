<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="{{ asset('css/userDash.css') }}">

    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>User Dashboard</title>
</head>
<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="{{ asset('images/Black Grey Classic Minimalist Elegant Personal Monogram Logo.png') }}" alt="KOTHA DEAL Logo">
            </div>
            <span class="logo_name">KOTHA DEAL</span>
        </div>
        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="#">
                    <i class="uil uil-estate"></i>
                    <span class="link-name">Dashboard</span>
                </a></li>

                <li><a href="{{ route('profile') }}">
                    <i class="uil uil-user-circle"></i>
                    <span class="link-name">Profile</span>
                </a></li>

                {{-- <li><a href="#">
                    <i class="uil uil-home"></i>
                    <span class="link-name">Room Listings</span>
                </a></li> --}}

                <li><a href="{{ route('bookings.index') }}">
                    <i class="uil uil-calendar-alt"></i>
                    <span class="link-name">My Bookings</span>
                </a></li>

                <li><a href="#">
                    <i class="uil uil-heart"></i>
                    <span class="link-name">Favorites</span>
                </a></li>

                <li><a href="#">
                    <i class="uil uil-history"></i>
                    <span class="link-name">Booking History</span>
                </a></li>

                <li><a href="{{ route('chat.show', auth()->id()) }}">
                    <i class="uil uil-comments"></i>
                    <span class="link-name">Messages</span>
                </a></li>





                {{-- <li><a href="#">
                    <i class="uil uil-bell"></i>
                    <span class="link-name">Notifications</span>
                </a></li> --}}

                <li><a href="#">
                    <i class="uil uil-credit-card"></i>
                    <span class="link-name">Payments</span>
                </a></li>

                <li><a href="{{ route('user.reviews') }}">
                    <i class="uil uil-star"></i>
                    <span class="link-name">Reviews</span>
                </a></li>

                {{-- <li><a href="#">
                    <i class="uil uil-question-circle"></i>
                    <span class="link-name">Support</span>
                </a></li> --}}

                {{-- <li><a href="#">
                    <i class="uil uil-setting"></i>
                    <span class="link-name">Settings</span>
                </a></li> --}}
            </ul>

            <ul class="logout-mode">
                {{-- <li><a href="#">
                    <i class="uil uil-signout"></i>
                    <span class="link-name">Logout</span>
                </a></li> --}}

                <li>
                    <form id="logout-form" action="{{ route('logout.home') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="uil uil-signout"></i>
                        <span class="link-name">Logout</span>
                    </a>
                </li>


                <li class="mode">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                        <span class="link-name">Dark Mode</span>
                    </a>
                    <div class="mode-toggle">
                        <span class="switch"></span>
                    </div>
                </li>
            </ul>

        </div>
    </nav>
    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Search here...">
            </div>

            <!--<img src="images/profile.jpg" alt="">-->
        </div>
        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Dashboard</span>
                </div>
                {{-- <div class="boxes">
                    <div class="box box1">
                        <i class="uil uil-thumbs-up"></i>
                        <span class="text">Total Likes</span>
                        <span class="number">50,120</span>
                    </div>
                    <div class="box box2">
                        <i class="uil uil-comments"></i>
                        <span class="text">Comments</span>
                        <span class="number">20,120</span>
                    </div>
                    <div class="box box3">
                        <i class="uil uil-share"></i>
                        <span class="text">Total Share</span>
                        <span class="number">10,120</span>
                    </div>
                </div> --}}



            </div>
        </div>
    </section>
    <script src="{{ asset('js/userDash.js') }}"></script>
</body>
</html>
