<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <style>
        /* General styles */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .page-title {
            text-align: center;
            font-size: 2rem;
            color: #333;
            margin-bottom: 20px;
        }

        /* Table styles */
        .table-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .bookings-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border-radius: 8px;
            overflow: hidden;
        }

        .bookings-table th,
        .bookings-table td {
            padding: 12px;
            text-align: left;
            font-size: 1rem;
        }

        .bookings-table thead {
            background-color: #2095ae;
            color: #fff;
        }

        .bookings-table tbody tr {
            background-color: #fff;
            transition: background-color 0.3s ease;
        }

        .bookings-table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .bookings-table td {
            border-bottom: 1px solid #e2e2e2;
        }

        /* Status labels */
        .status-pending {
            background-color: #f39c12;
            color: #fff;
            padding: 5px 10px;
            border-radius: 4px;
            text-transform: capitalize;
            font-weight: bold;
        }

        .status-canceled {
            background-color: #e74c3c;
            color: #fff;
            padding: 5px 10px;
            border-radius: 4px;
            text-transform: capitalize;
            font-weight: bold;
        }

        .status-confirmed {
            background-color: #28a745;
            color: #fff;
            padding: 5px 10px;
            border-radius: 4px;
            text-transform: capitalize;
            font-weight: bold;
        }

        /* Buttons */
        .cancel-btn {
            background-color: #dc3545;
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-weight: bold;
        }

        .cancel-btn:hover {
            background-color: #c82333;
        }

        .cancel-btn.disabled {
            background-color: #e2e2e2;
            cursor: not-allowed;
        }

        /* Action column styling */
        .action-btns {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .action-btns button {
            margin: 0 5px;
        }

        /* Responsive design */
        @media (max-width: 1024px) {
            .bookings-table th,
            .bookings-table td {
                font-size: 1rem;
                padding: 10px;
            }

            .page-title {
                font-size: 1.8rem;
            }

            .cancel-btn {
                padding: 6px 12px;
            }

            .action-btns {
                flex-direction: column;
                align-items: flex-start;
            }

            .action-btns button {
                width: 100%;
                margin: 5px 0;
            }
        }

        @media (max-width: 768px) {
            .bookings-table th,
            .bookings-table td {
                font-size: 0.9rem;
                padding: 8px;
            }

            .page-title {
                font-size: 1.5rem;
            }

            .cancel-btn {
                padding: 6px 12px;
            }

            .bookings-table {
                font-size: 0.85rem;
            }

            .table-container {
                padding: 15px;
            }

            .action-btns {
                flex-direction: column;
                align-items: center;
            }

            .action-btns button {
                width: 100%;
                margin: 5px 0;
            }
        }

        @media (max-width: 480px) {
            .bookings-table th,
            .bookings-table td {
                font-size: 0.8rem;
                padding: 6px;
            }

            .page-title {
                font-size: 1.2rem;
            }

            .cancel-btn {
                padding: 5px 10px;
                font-size: 0.8rem;
            }

            .table-container {
                padding: 10px;
            }

            .bookings-table th,
            .bookings-table td {
                text-align: center;
            }
        }

    </style>

    <div class="container">
        <h2 class="page-title">My Bookings</h2>

        <div class="table-container">
            <table class="bookings-table">
                <thead>
                    <tr>
                        <th>Room Type</th>
                        {{-- <th>Email</th>
                        <th>Phone</th> --}}
                        <th>Check-in</th>
                        <th>Occupants</th>
                        <th>Payment Method</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                        <tr>
                            <td>{{ $booking->room->room_type}}</td>
                            {{-- <td>{{ $booking->email }}</td>
                            <td>{{ $booking->phone }}</td> --}}
                            <td>{{ $booking->checkin_date }}</td>
                            <td>{{ $booking->occupants }}</td>
                            <td>{{ ucfirst(str_replace('_', ' ', $booking->payment_method)) }}</td>
                            <td>
                                @if ($booking->status === 'pending')
                                    <span class="status-pending">Pending</span>
                                @elseif ($booking->status === 'canceled')
                                    <span class="status-canceled">Canceled</span>
                                @else
                                    <span class="status-confirmed">Confirmed</span>
                                @endif
                            </td>
                            <td class="action-btns">
                                @if ($booking->status === 'pending')
                                    <form action="{{ route('bookings.cancel', $booking->id) }}" method="POST">
                                        @csrf
                                        <button class="cancel-btn" type="submit">Cancel</button>
                                    </form>
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
