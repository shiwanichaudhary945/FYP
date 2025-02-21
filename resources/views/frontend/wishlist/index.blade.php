<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Wishlist</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }

        h2 {
            text-align: center;
            font-size: 28px;
            color: #333;
            margin-bottom: 20px;
        }

        .wishlist-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }

        .wishlist-item {
            display: flex;
            align-items: center;
            width: 95%;
            background: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
            gap: 15px;
        }

        .wishlist-item a {
            text-decoration: none;
        }

        .wishlist-item img {
            width: 140px;
            height: 90px;
            border-radius: 6px;
            object-fit: cover;
            transition: 0.3s;
        }

        .wishlist-item img:hover {
            transform: scale(1.05);
        }

        .wishlist-details {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .wishlist-details h1 {
            font-size: 18px;
            color: #333;
            margin-bottom: 5px;
        }

        .wishlist-details p {
            font-size: 14px;
            color: #777;
            margin: 0;
        }

        .price {
            font-size: 20px;
            font-weight: bold;
            color: #ff4757;
        }

        .price-unit {
            font-size: 14px;
            font-weight: normal;
            color: #555;
        }

        .remove-btn {
            background: #dc3545;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            font-size: 14px;
            border-radius: 5px;
            transition: 0.3s;
        }

        .remove-btn:hover {
            background: #c82333;
        }

        .wishlist-icon {
            font-size: 22px;
            color: #ff4757;
            margin-right: 10px;
        }

        .empty-wishlist {
            text-align: center;
            font-size: 20px;
            color: #777;
            margin-top: 5px; 
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .empty-wishlist i {
            font-size: 50px;
            color: #ccc;
            margin-bottom: 10px;
        }

        /* Center the text inside the alert box */
        .alert {
            text-align: center;
            width: 100%;
            max-width: 800px;  /* Set the maximum width to control the width */
            margin: 5px auto;  /* This centers the alert box horizontally */
            padding: 15px;
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
            font-size: 16px;
            margin-top: 5px;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* Back to Homepage Button */
        .back-to-home-btn {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: #26a9c7;
            color: white;
            padding: 10px 15px;
            font-size: 16px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        /* .back-to-home-btn:hover {
            background-color: #35b7d4;
        } */

        .back-to-home-btn i {
            font-size: 18px;
        }
    </style>
</head>
<body>
    <!-- Back to Homepage Button -->
    <a href="{{ url('/home') }}" class="back-to-home-btn">
        <i class="fas fa-arrow-left"></i> Back
    </a>
    
    @if (session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <h2><i class="fa-solid fa-heart wishlist-icon"></i> My Wishlist ({{ $wishlistCount }})</h2>

    @if ($wishlistRooms->isEmpty())
        <div class="empty-wishlist">
            <i class="fas fa-box-open"></i>
            <p>Your wishlist is empty!</p>
        </div>
    @else
        <div class="wishlist-section">
            @foreach ($wishlistRooms as $item)
                <div class="wishlist-item">
                    <a href="{{ route('room.details', $item->room->id) }}">
                        <img src="{{ asset($item->room->image) }}" alt="Room Image">
                    </a>
                    <div class="wishlist-details">
                        <h1>{{ $item->room->room_type }}</h1>
                        <p><i class="fas fa-map-marker-alt"></i> {{ $item->room->location }}</p>
                        <span class="price">Rs. {{ number_format($item->room->price) }}<span class="price-unit"> / Month</span></span>
                    </div>
                    <form action="{{ route('wishlist.remove', $item->room_id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="remove-btn">
                            <i class="fas fa-trash"></i> Remove
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    @endif
</body>
</html>
