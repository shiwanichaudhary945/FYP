<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compare Rooms</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        .compare-container {
            max-width: 1000px;
            margin: 30px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .compare-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .compare-table th, .compare-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
            vertical-align: middle;
            white-space: nowrap;
        }
        .compare-table th {
            background-color: #2095ae;
            color: white;
        }
        .compare-table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .compare-table tbody tr:hover {
            background-color: #f1f1f1;
        }
        .text-left {
            text-align: left;
            padding-left: 10px;
            line-height: 1.4; 
        }
        .amenities-list {
            list-style-type: disc;
            padding-left: 0;
            margin-top: 0;
            margin-bottom: 0;
            list-style-position: inside;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .amenities-list li {
            margin-right: 15px;
        }
        .col-room-type { width: 15%; }
        .col-location { width: 15%; }
        .col-price { width: 10%; }
        .col-features { width: 30%; }
        .col-amenities { width: 30%; }
    </style>
    
</head>
<body>

<div class="compare-container">
    <h2>Compare Rooms</h2>

    @if($rooms->isEmpty())
        <p>No rooms selected for comparison.</p>
    @else
        <table class="compare-table">
            <thead>
                <tr>
                    <th class="col-room-type">Room Type</th>
                    <th class="col-location">Location</th>
                    <th class="col-price">Price</th>
                    <th class="col-features">Features</th>
                    <th class="col-amenities">Amenities</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rooms as $room)
                <tr>
                    <td>{{ $room->room_type }}</td>
                    <td>{{ $room->location }}</td>
                    <td>Rs. {{ number_format($room->price) }}/Month</td>
                    <td class="text-left">
                        Area: {{ $room->area }} sqft <br>
                        Bedrooms: {{ $room->bedrooms }} <br>
                        Bathrooms: {{ $room->bathrooms }} <br>
                        Parking: {{ $room->parking }} <br>
                        Furnished: {{ $room->furnished ? 'Yes' : 'No' }}
                    </td>
                    <td class="text-left">
                        @php
                            $amenities = json_decode($room->amenities, true);
                        @endphp
                        @if (!empty($amenities))
                            <ul class="amenities-list">
                                @foreach ($amenities as $amenity)
                                    <li>{{ $amenity }}</li>
                                @endforeach
                            </ul>
                        @else
                            No amenities available
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

</body>
</html>
