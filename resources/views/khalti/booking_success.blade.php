<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Successful</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
        }
        .success-message {
            color: green;
            font-size: 24px;
            font-weight: bold;
        }
        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #2095ae;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h2 class="success-message">🎉 Your Booking is Successful! 🎉</h2>
    <p>Thank you for booking with us. We have received your payment.</p>
    <a href="{{ route('home') }}" class="btn">Go to Homepage</a>
</body>
</html>
