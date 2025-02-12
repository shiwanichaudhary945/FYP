@extends("layouts.app")

@section("content")
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: #6c757d; color: #fff;">
                    <h3 class="mb-0">Edit Landlord</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('frontend.landlord.update', $landlord->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter full name" required value="{{ $landlord->name }}">
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required value="{{ $landlord->email }}">
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required value="{{ $landlord->password }}">
                            @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-secondary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
