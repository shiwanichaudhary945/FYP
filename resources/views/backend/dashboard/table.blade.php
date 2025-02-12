@extends('backend.dashboard.app')

@section('content')
<div class="container mt-4">
    <!-- Success Message -->
    @if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
    @endif


    {{-- <form method="post" action="{{ route("room.index") }}" enctype="multipart/form-data"> --}}

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('frontend.rooms.create') }}" class="btn btn-success">Create New Room</a>
    </div>

    <!-- Room Table -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">SN</th>
                <th scope="col">Room Type</th>
                <th scope="col">Location</th>
                <th scope="col">Price</th>
                <th scope="col">Description</th>
                <th scope="col">Room Image</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 0;
            @endphp

            @foreach ($rooms as $room)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $room->room_type }}</td>
                <td>{{ $room->location }}</td>
                <td>{{ $room->price }}</td>
                <td>{{ $room->description }}</td>
                <td>
                    <img src="{{ asset($room->image) }}" width="80">
                </td>
                <td>

                    <a href="{{ route('frontend.rooms.edit', $room->id) }}" class="btn btn-primary btn-sm">Edit</a>

                    <form action="{{ route('frontend.rooms.destroy', $room->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
