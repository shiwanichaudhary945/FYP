{{-- @extends('layouts.app')

@section('content')
    <h1>My Wishlist</h1>
    <div class="list_boxes">
        @foreach ($wishlistRooms as $room)
            <div class="list_box">
                <img src="{{ asset($room->image) }}" alt="Room Image">
                <div class="list_text">
                    <h2>Rs. {{ number_format($room->price) }}<span class="price-unit">/Month</span></h2>
                    <h1>{{ $room->room_type }}</h1>
                    <p><i class="ri-map-pin-2-fill"></i> {{ $room->location }}</p>
                </div>
                <div class="card-footer">
                    <button class="wishlist-btn active" data-room-id="{{ $room->id }}">
                        <i class="fas fa-heart"></i> Wishlisted
                    </button>
                    <a href="{{ route('room.details', $room->id) }}" class="view-details-btn">View Details</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection --}}


@extends('layouts.app')

@section('content')
<div class="container">
    <h2>My Wishlist</h2>
    <ul>
        @foreach($wishlist as $item)
            <li>
                {{ $item->room->name }}
                <button onclick="removeFromWishlist({{ $item->room_id }})">Remove</button>
            </li>
        @endforeach
    </ul>
</div>
{{--
<script>
function removeFromWishlist(roomId) {
    fetch(`/wishlist/remove/${roomId}`, {
        method: "DELETE",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
        }
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        location.reload();
    })
    .catch(error => console.error("Error:", error));
}
</script> --}}
@endsection
