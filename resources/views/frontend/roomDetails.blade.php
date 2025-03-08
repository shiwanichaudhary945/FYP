<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Details</title>
    <link rel="stylesheet" href="{{ asset('css/roomDetails.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    {{-- <script src="https://khalti.com/static/khalti-checkout.js"></script> --}}
    <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>
    <script>
        console.log("Public Key: ", "{{ config('app.khalti_public_key') }}");
    </script>
</head>
<body>
    <section class="room-details">
        <div class="container">
{{--
            @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif --}}


            <!-- Room Images -->
            <div class="room-images">
                @if($room->image)
                    <img src="{{ asset($room->image) }}" alt="Room Image" class="main-image" id="main-image">
                @endif

                <div class="thumbnail-images">
                    @foreach($room->images as $image)
                        <img src="{{ asset($image->image_path) }}" alt="Room Thumbnail" class="thumbnail" data-fullsize="{{ asset($image->image_path) }}">
                    @endforeach
                </div>
            </div>

            {{-- <div class="room-container">
                <div class="room-details-box">
                    <form id="compareForm" action="{{ route('rooms.compare') }}" method="POST">
                        @csrf
                    <h1>{{ $room->room_type }}</h1>
                    <p class="price">Price: Rs. {{ number_format($room->price) }}/Month</p>
                    <p class="location">Location: {{ $room->location }}</p>
                    <p class="description">Description: {{ $room->description }}</p> --}}

                        <div class="room-container">
                            <div class="room-details-box">
                                <h1 style="display: flex; justify-content: space-between; align-items: center;">
                                    {{ $room->room_type }}
                                    <label for="compare" class="compare-checkbox" style="margin-left: 10px;">
                                        <input type="checkbox" id="compare" name="compare" value="{{ $room->id }}">
                                        Add to Compare
                                    </label>
                                </h1>
                                <p class="price">Price: NPR. {{ number_format($room->price) }}/Month</p>
                                <p class="location">Location: {{ $room->location }}</p>
                                <p class="description">Description: {{ $room->description }}</p>


<div id="compareMessageBox" class="alert alert-warning" style="display: none;" role="alert">
    <span id="compareMessage"></span>
</div>

<!-- Compare Now Button -->
<form id="compareForm" action="{{ route('rooms.compare') }}" method="GET">
    <input type="hidden" name="rooms" id="compareRoomsInput">
    <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Compare Now</button>
</form>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let compareCheckboxes = document.querySelectorAll(".compare-checkbox"); // Ensure checkboxes have this class
        let compareForm = document.getElementById("compareForm");
        let compareRoomsInput = document.getElementById("compareRoomsInput");
        let compareMessageBox = document.getElementById("compareMessageBox");
        let compareMessage = document.getElementById("compareMessage");

        compareCheckboxes.forEach(checkbox => {
            checkbox.addEventListener("change", function () {
                let roomId = this.value;
                let selectedRooms = JSON.parse(sessionStorage.getItem("compareRooms")) || [];

                if (this.checked) {
                    if (!selectedRooms.includes(roomId)) {
                        selectedRooms.push(roomId);
                    }
                } else {
                    selectedRooms = selectedRooms.filter(id => id !== roomId);
                }

                sessionStorage.setItem("compareRooms", JSON.stringify(selectedRooms));

                // Show message box dynamically
                compareMessageBox.style.display = "block";

                if (selectedRooms.length < 2) {
                    compareMessage.textContent = "⚠️ Select at least 2 rooms to compare.";
                    compareMessageBox.className = "alert alert-warning";
                } else if (selectedRooms.length > 3) {
                    compareMessage.textContent = "⚠️ You can only compare up to 3 rooms.";
                    compareMessageBox.className = "alert alert-danger";
                } else {
                    compareMessage.textContent = `✅ Rooms Selected for Comparison: ${selectedRooms.length}`;
                    compareMessageBox.className = "alert alert-success";
                }
            });
        });

        compareForm.addEventListener("submit", function (event) {
            let selectedRooms = JSON.parse(sessionStorage.getItem("compareRooms")) || [];

            if (selectedRooms.length < 2 || selectedRooms.length > 3) {
                alert("Please select 2 or 3 rooms for comparison.");
                event.preventDefault();
            } else {
                compareRoomsInput.value = selectedRooms.join(',');
            }
        });
    });
</script>



                    <div class="details-section">
                        <div class="amenities">
                            <h3>Room Amenities</h3>
                            <ul>
                                @foreach(json_decode($room->amenities, true) ?? [] as $amenity)
                                    <li>
                                        @if($amenity == 'WiFi')
                                            <i class="fas fa-wifi"></i>
                                        @elseif($amenity == 'Parking')
                                            <i class="fas fa-parking"></i>
                                        @elseif($amenity == 'Air Conditioning')
                                            <i class="fas fa-snowflake"></i>
                                        @elseif($amenity == 'Swimming Pool')
                                            <i class="fas fa-swimmer"></i>
                                        @elseif($amenity == 'TV')
                                            <i class="fas fa-tv"></i>
                                        @elseif($amenity == 'Security')
                                            <i class="fas fa-shield-alt"></i>
                                        @elseif($amenity == 'Heating')
                                            <i class="fas fa-fire"></i>
                                        @elseif($amenity == 'Kitchen')
                                            <i class="fas fa-utensils"></i>
                                        @elseif($amenity == 'Gym')
                                            <i class="fas fa-dumbbell"></i>
                                        @elseif($amenity == 'Pet Friendly')
                                            <i class="fas fa-paw"></i>
                                        @elseif($amenity == '24/7 Water Supply')
                                            <i class="fas fa-tint"></i>
                                        @elseif($amenity == '24/7 Electricity')
                                            <i class="fas fa-bolt"></i>
                                        @else
                                            <i class="fas fa-check-circle"></i>
                                        @endif
                                        {{ $amenity }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="room-features">
                            <h3>Room Features</h3>
                            <ul>
                                <li><i class="fas fa-bed"></i> {{ $room->bedrooms }} Bedrooms</li>
                                <li><i class="fas fa-bath"></i> {{ $room->bathrooms }} Bathrooms</li>
                                <li>
                                    @if($room->parking == 'Yes')
                                        <i class="fas fa-parking"></i> Parking Available
                                    @else
                                        <i class="fas fa-times-circle"></i> No Parking
                                    @endif
                                </li>
                                <li>
                                    @if($room->furnished == 'Yes')
                                        <i class="fas fa-couch"></i> Furnished
                                    @else
                                        <i class="fas fa-times-circle"></i> Not Furnished
                                    @endif
                                </li>
                                <li><i class="fas fa-ruler-combined"></i> {{ $room->area }} sq. ft.</li>
                            </ul>
                        </div>
                    </div>



            <!-- OpenStreetMap Section -->
            <div class="map">
                <h2>Location</h2>
                <div id="map" style="width: 100%; height: 500px; border-radius: 10px;"></div>
            </div>

            <!-- Reviews and Ratings -->
            <div class="reviews">
                <h2>Reviews & Ratings</h2>
                <div class="rating">
                    @for ($i = 1; $i <= 5; $i++)
                        <span class="star" data-rating="{{ $i }}">&#9733;</span>
                    @endfor
                </div>


            <!-- Display Existing Reviews -->
            <div class="existing-reviews">
                <h3>What others are saying</h3>
                <div class="reviews-grid">
                    @foreach($room->reviews as $review)
                        <div class="review">
                            <p><strong>{{ $review->user->name }}</strong> rated
                                <span class="review-rating">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fa fa-star {{ $i <= $review->rating ? 'filled' : '' }}"></i>
                                    @endfor
                                </span>
                            </p>
                            <p>{{ $review->comment }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

                <!-- Submit a Review -->
                <div class="review-section">
                    <h3>Your Review</h3>
                    <form method="POST" action="{{ route('reviews.store', $room->id) }}">
                        @csrf
                        <input type="hidden" id="rating-value" name="rating" value="5">
                        <textarea name="comment" placeholder="Write your review here..." required></textarea>
                        <button type="submit" class="submit-review-btn">Submit Review</button>
                    </form>
                </div>
            </div>

            <div class="booking-form">
                <h2>Book This Room</h2>

                <form action="{{ route('bookings.store', $room->id) }}" method="POST" id="booking-form">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Full Name:</label>
                            <input type="text" id="name" name="name" placeholder="Enter your full name" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address:</label>
                            <input type="email" id="email" name="email" placeholder="Enter your email" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone">Phone Number:</label>
                            <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>
                        </div>

                        <div class="form-group">
                            <label for="checkin_date">Check-in Date:</label>
                            <input type="date" id="checkin_date" name="checkin_date" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="occupants">Number of Occupants:</label>
                            <input type="number" id="occupants" name="occupants" min="1" max="10" required>
                        </div>

                        <div class="form-group">
                            <label for="payment_method">Preferred Payment Method:</label>
                            <select id="payment_method" name="payment_method" required>
                                <option value="" selected>Select a payment method</option>
                                <option value="khalti">Khalti</option>
                                {{-- <option value="cash">Cash on Arrival</option> --}}
                            </select>
                        </div>
                    </div>

                    {{-- <!-- Khalti Payment Button (Only) -->
                    <button type="button" id="payment-button" class="book-btn">Pay with Khalti</button> --}}
                    <button type="button" id="payment-button" class="book-btn">Pay with Khalti</button>
                    {{-- <button id="payment-button">Pay with Khalti</button> --}}
                </form>
            </div>

            {{-- <script src="https://khalti.com/static/khalti-checkout.js"></script> --}}
              <!-- Include Khalti Script -->
              {{-- <script src="https://unpkg.com/khalti-checkout-web@latest"></script> --}}


              {{-- <script src="https://cdn.khalti.com/js/khalti-checkout.js"></script> --}}


              {{-- <script>
                document.addEventListener("DOMContentLoaded", function () {
                    var roomPrice = {{ $room->price }} * 100; // Convert to paisa
                    var roomType = "{{ $room->roomType }}"; // Get the room type dynamically

                    if (!roomPrice || isNaN(roomPrice)) {
                        console.error("Invalid room price:", roomPrice);
                        alert("Invalid room price. Please check.");
                        return;
                    }

                    var checkout = new KhaltiCheckout({
                        publicKey: "test_public_key_bc709dd66c9a4c129d43cbeef11ba2ef",
                        productIdentity: "{{ $room->id }}",
                        productName: roomType || "Room Booking", // ✅ Use room type or fallback to "Room Booking"
                        productUrl: "{{ route('room.details', ['id' => $room->id]) }}",
                        paymentPreference: ["KHALTI"],
                        eventHandler: {
                            onSuccess(payload) {
                                console.log("Payment Successful!", payload);
                                fetch("{{ route('khalti.verifyPayment') }}", {
                                    method: "POST",
                                    headers: {
                                        "Content-Type": "application/json",
                                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                    },
                                    body: JSON.stringify({
                                        token: payload.token,
                                        amount: roomPrice
                                    })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        alert("Payment successful!");
                                        document.getElementById("booking-form").submit();
                                    } else {
                                        alert("Payment verification failed!");
                                    }
                                })
                                .catch(error => console.error("Error:", error));
                            },
                            onError(error) {
                                console.error("Payment Error:", error);
                                alert("Payment failed! Please try again.");
                            },
                            onClose() {
                                console.log("User closed the payment popup.");
                            }
                        }
                    });

                    var paymentButton = document.getElementById("payment-button");
                    if (paymentButton) {
                        paymentButton.addEventListener("click", function () {
                            console.log("Opening Khalti checkout with amount:", roomPrice);
                            checkout.show({ amount: roomPrice });
                        });
                    } else {
                        console.error("Payment button not found!");
                    }
                });
            </script> --}}


            <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script>

            var config = {
                // replace the publicKey with yours
                "publicKey": "{{ config('app.khalti_public_key') }}",
                "productIdentity": "1234567890",
                "productName": "Luxury Room",
                "productUrl": "http://127.0.0.1:8000/rooms/1",
                "paymentPreference": [
                    "KHALTI",
                    "EBANKING",
                    "MOBILE_BANKING",
                    "CONNECT_IPS",
                    "SCT",
                    ],
                "eventHandler": {
                    onSuccess (payload) {
                        // hit merchant api for initiating verfication
                        $.ajax({
                            type : 'POST',
                            url : "{{ route('khalti.verifyPayment') }}",
                            data: {
                                token : payload.token,
                                amount : payload.amount,
                                "_token" : "{{ csrf_token() }}"
                            },
                            success : function(res){
                                $.ajax({
                                    type : "POST",
                                    url : "{{ route('khalti.storePayment') }}",
                                    data : {
                                        response : res,
                                        "_token" : "{{ csrf_token() }}"
                                    },
                                    success: function(res){
                                        console.log('transaction successfull');
                                    }
                                });
                                console.log(res);
                            }
                        });
                        console.log(payload);
                    },
                    onError (error) {
                        console.log(error);
                    },
                    onClose () {
                        console.log('widget is closing');
                    }
                }
            };

            var checkout = new KhaltiCheckout(config);
            var btn = document.getElementById("payment-button");
            btn.onclick = function () {
                // minimum transaction amount must be 10, i.e 1000 in paisa.
                checkout.show({amount: 1000});
            }
        </script>



        </div>
    </section>

    <!-- Lightbox for Images -->
    <div id="lightbox" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.8); justify-content:center; align-items:center;">
        <img id="lightbox-image" src="" style="max-width:80%; max-height:80%;">
        <span id="close-lightbox" style="position:absolute; top:10px; right:20px; font-size:30px; color:white; cursor:pointer;">&times;</span>
    </div>

    <script>
        document.querySelectorAll('.star').forEach(star => {
    star.addEventListener('click', function() {
        // Reset all stars
        document.querySelectorAll('.star').forEach(s => s.classList.remove('selected'));

        // Highlight the clicked star and all stars before it
        let rating = this.getAttribute('data-rating');
        document.querySelectorAll('.star').forEach((s, index) => {
            if (index < rating) {
                s.classList.add('selected');
            }
        });

        // Set the hidden input value to the clicked rating
        document.getElementById('rating-value').value = rating;
    });
});

        // JavaScript to open lightbox on thumbnail click
        const thumbnails = document.querySelectorAll('.thumbnail');
        const lightbox = document.getElementById('lightbox');
        const lightboxImage = document.getElementById('lightbox-image');
        const closeLightbox = document.getElementById('close-lightbox');

        thumbnails.forEach((thumbnail) => {
            thumbnail.addEventListener('click', (event) => {
                const fullsizeImage = event.target.getAttribute('data-fullsize');
                lightboxImage.src = fullsizeImage;
                lightbox.style.display = 'flex';
            });
        });

        closeLightbox.addEventListener('click', () => {
            lightbox.style.display = 'none';
        });




    var latitude = {{ $room->latitude ?? 27.6849 }};
    var longitude = {{ $room->longitude ?? 85.3188 }};

    var map = L.map('map').setView([latitude, longitude], 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    L.marker([latitude, longitude]).addTo(map)
        .bindPopup('<b>{{ $room->room_type }}</b><br>{{ $room->location }}')
        .openPopup();


    </script>
</body>
</html>
