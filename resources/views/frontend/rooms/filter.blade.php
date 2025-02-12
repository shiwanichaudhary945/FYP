<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Filter Rooms</title>

    <link rel="stylesheet" href="{{ asset('css/filter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>

    <section class="sec" id="listing">
        <div class="head_1">
            <div class="left_head">
                <h1 class="heading1">Filtered Rooms</h1>
            </div>
        </div>

        <!-- Description section without underline -->
        <div class="filter-description">
            <p>Find your ideal room with your preferences</p>
        </div>

        <div class="content-wrapper">
            @if($rooms->isEmpty())
                <div class="error-msg">
                    <p>No rooms found based on your criteria. Please try again with different filters.</p>
                </div>
            @else
                <div class="list_boxes">
                    @foreach ($rooms as $room)
                        <div class="list_box">
                            <img src="{{ asset($room->image) }}" alt="Room Image">
                            <div class="list_text">
                                <h2>Rs. {{ number_format($room->price) }}<span class="price-unit">/Month</span></h2>
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
            @endif
        </div>
    </section>


</body>
</html>
