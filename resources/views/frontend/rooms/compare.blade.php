{{-- <table class="table table-bordered">
    <thead>
        <tr>
            <th>Attribute</th>
            @foreach ($rooms as $room)
                <th>{{ $room->title }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Price</td>
            @foreach ($rooms as $room)
                <td>${{ $room->price }}</td>
            @endforeach
        </tr>
        <tr>
            <td>Size</td>
            @foreach ($rooms as $room)
                <td>{{ $room->size }} sq ft</td>
            @endforeach
        </tr>
        <tr>
            <td>Amenities</td>
            @foreach ($rooms as $room)
                <td>{{ implode(', ', json_decode($room->amenities)) }}</td>
            @endforeach
        </tr>
    </tbody>
</table> --}}
