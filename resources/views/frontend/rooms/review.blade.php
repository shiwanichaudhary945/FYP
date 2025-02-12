<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - My Reviews</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* General Dashboard Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }

        .dashboard-container {
            max-width: 1000px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .dashboard-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .dashboard-header h1 {
            color: #333;
            font-size: 28px;
            margin-bottom: 5px;
        }

        .dashboard-header p {
            color: #777;
        }

        .reviews-list {
            margin-top: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .review-item {
            background: #fafafa;
            padding: 20px;
            margin-bottom: 15px;
            border-radius: 8px;
            width: calc(50% - 10px); /* Two comments per row */
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .review-header h3 {
            color: #151b20;
            margin: 0;
        }

        .stars {
            font-size: 20px;
        }

        .fa-star {
            color: #ddd;
            transition: color 0.3s;
        }

        .fa-star.filled {
            color: gold;
        }

        .review-item p {
            color: #555;
            font-size: 16px;
            margin: 10px 0 0;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .dashboard-container {
                padding: 15px;
            }

            .dashboard-header h1 {
                font-size: 24px;
            }

            .review-item {
                width: 100%; /* Full width for tablet-sized screens */
            }
        }

        @media (max-width: 480px) {
            .dashboard-container {
                padding: 10px;
            }

            .dashboard-header h1 {
                font-size: 20px;
            }

            .review-item {
                width: 100%; /* Full width for mobile screens */
            }
        }
    </style>
</head>
<body>

    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1>My Reviews</h1>
            <p>See what you've shared about different rooms</p>
        </div>

        @if($reviews->isEmpty())
            <p class="no-reviews" style="text-align: center; color: #777;">You have not written any reviews yet.</p>
        @else
            <div class="reviews-list">
                @foreach($reviews as $review)
                    <div class="review-item">
                        <div class="review-header">
                            <h3>Room Type: {{ $review->room->room_type ?? 'N/A' }}</h3>
                            <div class="stars">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fa fa-star {{ $i <= $review->rating ? 'filled' : '' }}"></i>
                                @endfor
                            </div>
                        </div>
                        <p>{{ $review->comment }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</body>
</html>
