@extends('backend.dashboard.app')

@section('content')
<div class="container mt-4">
    <!-- Success Message -->
    @if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
    @endif

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('frontend.landlord.create') }}" class="btn btn-success">Create New Landlord</a>
    </div>

    <!-- Landlord Table -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">SN</th>
                <th scope="col">Full Name</th>
                <th scope="col">Email</th>
                <th scope="col">Password</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 0;
            @endphp

            @foreach ($landlords as $landlord)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $landlord->name }}</td>
                <td>{{ $landlord->email }}</td>
                <td>{{ $landlord->password }}</td>

                <td>
                    <a href="{{ route('frontend.landlord.edit', $landlord->id) }}" class="btn btn-primary btn-sm">Edit</a>

                    <form action="{{ route('frontend.landlord.destroy', $landlord->id) }}" method="POST" style="display:inline;">
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
