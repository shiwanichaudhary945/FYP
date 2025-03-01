<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Finder Website</title>

    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">


    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>


</head>

</head>
<body>

    <header>
        <nav>
            <div class="logo">
                <img src="./images/logo2.png" alt=""/>
            </div>
            <ul>
                <div class="btn">
                    <i class="fas fa-times close-btn"></i>
                </div>
                <li><a href="#">Home</a></li>
                <li><a href="#about">About us</a></li>
                <li><a href="#listing">Room Listing</a></li>
            </ul>
            <ul class="auth-links">
                {{-- <li><a href="#">Login</a></li>
                <li><a href="#">Register</a></li> --}}

                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
            </ul>
            <div class="btn">
                <i class="fas fa-bars menu-btn"></i>
            </div>
        </nav>

    </header>

    <main>
        <div class="slide-container swiper">
            <div class="slide-content swiper-wrapper">
                <div class="overlay swiper-slide">
                    <img src="./images/pic2.jpg" alt=""/>
                    <div class="img-overlay">
                        <p>Find your dream room with us</p>
                        <h2><span>Explore</span> Your Options</h2>
                        <h2>with Room Finder</h2>
                    </div>
                </div>
                <div class="overlay swiper-slide">
                    <img src="./images/pic6.jpg" alt=""/>
                    <div class="img-overlay">
                        <p>Find the best rooms in great locations</p>
                        <h2><span>Choose</span> Your Space</h2>
                        <h2>with Room Finder</h2>
                    </div>
                </div>
                <div class="overlay swiper-slide">
                    <img src="./images/pic12.jpg" alt=""/>
                    <div class="img-overlay">
                        <p>Stay in a stylish room that feels like home</p>
                        <h2><span>Comfort</span> Awaits You</h2>
                        <h2>with Room Finder</h2>
                    </div>
                </div>
                <div class="overlay swiper-slide">
                    <img src="./images/pic9.jpg" alt=""/>
                    <div class="img-overlay">
                        <p>Find a cozy room that fits your budget</p>
                        <h2><span>Discover</span> Your Room</h2>
                        <h2>with Room Finder</h2>
                    </div>
                </div>
                <div class="overlay swiper-slide">
                    <img src="./images/pic3.jpg" alt=""/>
                    <div class="img-overlay">
                        <p>Join our happy renters and find your place</p>
                        <h2><span>Welcome</span> Home</h2>
                        <h2>with Room Finder</h2>
                    </div>
                </div>
            </div>
        </div>
    </main>

    {{-- Filter Search --}}
    <section id="location-search">
        <div class="container">
            <div class="form-wrapper">
                <form action="{{ route('rooms.search') }}" method="GET">

                    <!-- Search Location Dropdown -->
                    <select class="form-control" name="location">
                        <option value="">Select Location</option>
                        <option value="Kathmandu">Kathmandu</option>
                        <option value="Lalitpur">Lalitpur</option>
                        <option value="Bhaktapur">Bhaktapur</option>
                        <option value="Pokhara">Pokhara</option>
                        <option value="Chitwan">Chitwan</option>
                        <option value="Biratnagar">Biratnagar</option>
                        <option value="Itahari">Itahari</option>
                    </select>

                    <!-- Room Type Dropdown -->
                    <select class="form-control" name="room_type">
                        <option value="">Room Type</option>
                        <option value="Single Room">Single Room</option>
                        <option value="Double Room">Double Room</option>
                        <option value="Shared Room">Shared Room</option>
                        <option value="Furnished Room">Furnished Room</option>
                        <option value="Duplex Room">Duplex Room</option>
                        <option value="Luxury Room">Luxury Room</option>
                    </select>

                    <!-- Price Range Dropdown -->
                    <select class="form-control" name="price_range">
                        <option value="">Price Range</option>
                        <option value="Under 5000">Under 5000</option>
                        <option value="5000 - 10000">5000 - 10000</option>
                        <option value="10000 - 20000">10000 - 20000</option>
                        <option value="20000 - 30000">20000 - 30000</option>
                        <option value="Above 30000">Above 30000</option>
                    </select>

                    <button type="submit" class="primary-btn">Search Now</button>

                </form>
            </div>
        </div>
    </section>

    <section id="about">
        <div class="container">
            <div class="about-content-wrapper">
                <div class="room-left-side">
                    <p class="heading-normal-txt">THE BEST RENT ROOM FINDER </p>
                    <h2 class="headings">
                        FIND YOUR <span>DREAM ROOM</span> WITH US
                    </h2>
                    <p class="lead">
                        We are dedicated to helping you find the perfect room for rent, tailored to your preferences and budget.
                        Our service is reliable, fast, and easy to use.
                    </p>
                    <br/>
                    <p class="lead">
                        Whether you are a student, a professional, or simply looking for a new place to stay, we offer rooms in
                        various locations to suit your lifestyle. Experience a hassle-free process with our trusted platform.
                    </p>
                    <ul>
                        <li>
                            <div class="icons">
                                <i class="fa fa-shield-alt"></i>
                                <p>Safe and Secure Locations</p>
                            </div>
                        </li>
                        <li>
                            <div class="icons">
                                <i class="fa-solid fa-calendar-check"></i>
                                <p>Easy Booking Process</p>
                            </div>
                        </li>
                        <li>
                            <div class="icons">
                                <i class="fa fa-lock"></i>
                                <p>Secure Payment Methods</p>
                            </div>
                        </li>
                        <li>
                            <div class="icons">
                                <i class="fa fa-phone-volume"></i>
                                <p>+9779814309192</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="room-right-side">
                    <div class="img">
                        <img src="./images/pic1.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="live-chat">
        <div class="chat-banner">
            <div class="left-content">
                <p class="text-large">Not sure what to do.....</p>
                <img src="./images/nachristos-8nrmtFncB0Q-unsplash-removebg-preview.png" alt="Woman" class="person-image">
            </div>
            <div class="center-image">
                <img src="./images/Untitled design.png" alt="Chatbot" class="chat-image">
            </div>
            <div class="right-content">
                <img src="./images/young-girl-checked-shirt-pink-t-shirt-pointing-left-with-index-fingers-looking-happy-front-view-removebg-preview.png" alt="Man" class="person-image">
                <p class="text-large">WeChat is here to help !!</p>
            </div>
        </div>
        <p class="footer-text">
             "Instant help for your queries anytime, anywhere"
        </p>
    </div>


    {{-- Rooms list --}}

    <section class="sec" id="listing">
        <div class="head_1">
            <div class="left_head">
                <h1 class="heading1">Room Listing</h1>
                <p class="para">Looking for a new room?<br>We offer a range of room listings for rent.</p>
            </div>
            <div class="right_head">
                <ul>
                    <li class="btn btn1">Featured</li>
                    <li class="btn btn2">For rent</li>
                </ul>
            </div>
        </div>
        <div class="list_boxes">  <!-- Add this container for grid layout -->
            @foreach ($rooms as $room)
                <div class="list_box">
                    <img src="{{ asset($room->image) }}" alt="Room Image">
                    <div class="list_text">
                        <h2>NPR. {{ number_format($room->price) }}<span class="price-unit">/Month</span></h2>
                        <h1>{{ $room->room_type }}</h1>
                        <p><i class="ri-map-pin-2-fill"></i> {{ $room->location }}</p>
                    </div>
                    <div class="card-footer">
                        <button class="wishlist-btn" aria-label="Add to Wishlist">
                            <i class="fas fa-heart"></i> Wishlist
                        </button>
                        <a href="{{ route('room.details', $room->id) }}" class="view-details-btn">View Details</a>
                    </div>
                </div>
            @endforeach
        </div>


{{--
        <div class="boxes list_boxes">
            <div class="list_box">
                <img src="./images/pic4.jpg" alt="">
                <div class="list_text">
                    <h2>Rs.4,500<span class="price-unit">/Month</span></h2>
                    <h1>Modern house</h1>
                    <p class="para"><i class="ri-map-pin-2-fill"></i>Itahari</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('room.details') }}" class="view-details-btn">View Details</a>
                </div>
            </div>

            <div class="list_box">
                <img src="./images/pic5.jpg" alt="">
                <div class="list_text">
                    <h2>Rs.4,500<span class="price-unit">/Month</span></h2>
                    <h1>Modern house</h1>
                    <p class="para"><i class="ri-map-pin-2-fill"></i>Itahari 5, Sunsari</p>
                </div>
                <div class="card-footer">
                    <button class="view-details-btn">View Details</button>
                </div>
            </div>

            <div class="list_box">
                <img src="./images/pic10.jpg" alt="">
                <div class="list_text">
                    <h2>Rs.4,500<span class="price-unit">/Month</span></h2>
                    <h1>Modern house</h1>
                    <p class="para"><i class="ri-map-pin-2-fill"></i>Itahari 5, Sunsari</p>
                </div>
                <div class="card-footer">
                    <button class="view-details-btn">View Details</button>
                </div>
            </div>

            <div class="list_box">
                <img src="./images/pic8.jpg" alt="">
                <div class="list_text">
                    <h2>Rs.4,500<span class="price-unit">/Month</span></h2>
                    <h1>Modern house</h1>
                    <p class="para"><i class="ri-map-pin-2-fill"></i>Itahari 5, Sunsari</p>
                </div>
                <div class="card-footer">
                    <button class="view-details-btn">View Details</button>
                </div>
            </div>

            <div class="list_box">
                <img src="./images/pic7.jpg" alt="">
                <div class="list_text">
                    <h2>Rs.4,500<span class="price-unit">/Month</span></h2>
                    <h1>Modern house</h1>
                    <p class="para"><i class="ri-map-pin-2-fill"></i>Itahari 5, Sunsari</p>
                </div>
                <div class="card-footer">
                    <button class="view-details-btn">View Details</button>
                </div>
            </div>

            <div class="list_box">
                <img src="./images/pic9.jpg" alt="">
                <div class="list_text">
                    <h2>Rs.4,500<span class="price-unit">/Month</span></h2>
                    <h1>Modern house</h1>
                    <p class="para"><i class="ri-map-pin-2-fill"></i>Itahari 5, Sunsari</p>
                </div>
                <div class="card-footer">
                    <button class="view-details-btn">View Details</button>
                </div>
            </div>

            <div class="list_box">
                <img src="./images/pic10.jpg" alt="">
                <div class="list_text">
                    <h2>Rs.4,500<span class="price-unit">/Month</span></h2>
                    <h1>Modern house</h1>
                    <p class="para"><i class="ri-map-pin-2-fill"></i>Itahari 5, Sunsari</p>
                </div>
                <div class="card-footer">
                    <button class="view-details-btn">View Details</button>
                </div>
            </div>

            <div class="list_box">
                <img src="./images/pic11.jpg" alt="">
                <div class="list_text">
                    <h2>Rs.4,500<span class="price-unit">/Month</span></h2>
                    <h1>Modern house</h1>
                    <p class="para"><i class="ri-map-pin-2-fill"></i>Itahari 5, Sunsari</p>
                </div>
                <div class="card-footer">
                    <button class="view-details-btn">View Details</button>
                </div>
            </div>

            <div class="list_box">
                <img src="./images/pic13.jpg" alt="">
                <div class="list_text">
                    <h2>Rs.4,500<span class="price-unit">/Month</span></h2>
                    <h1>Modern house</h1>
                    <p class="para"><i class="ri-map-pin-2-fill"></i>Itahari 5, Sunsari</p>
                </div>
                <div class="card-footer">
                    <button class="view-details-btn">View Details</button>
                </div>
            </div>

        </div>
        <button class="property-btn">More Listing</button>
    </section> --}}


    <!-- footer section -->

      <!--
    - #FOOTER
  -->

  <div class="footer">
    <div class="footer-container">
        <!-- Get in Touch -->
        <div class="footer-section get-in-touch">
            <h3>Get In Touch</h3>
            <p><i class="fas fa-map-marker-alt"></i> Itahari, Sunsari, Nepal</p>
            <p><i class="fas fa-phone"></i> +012 345 67890</p>
            <p><i class="fas fa-envelope"></i> kothadeal@gmail.com</p>
        </div>

        <!-- Quick Links -->
        <div class="footer-section quick-links">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#about">About us</a></li>
                <li><a href="#listing">Room Listing</a></li>
            </ul>
        </div>

        <!-- Follow Us -->
        <div class="footer-section follow-us">
            <h3>Follow us</h3>
            <div class="follow-icons">
                <div class="social-item">
                    <a href="#" class="social-link">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <span>Facebook</span>
                </div>
                <div class="social-item">
                    <a href="#" class="social-link">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <span>Twitter</span>
                </div>
                <div class="social-item">
                    <a href="#" class="social-link">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <span>Instagram</span>
                </div>
            </div>
        </div>
    </div>
</div>


	<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
	<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>



    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/index.js') }}"></script>
    <script src="{{ asset('js/swiper.js') }}"></script>
</body>
</html>
