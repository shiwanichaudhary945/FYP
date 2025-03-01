@extends("layouts.app")

@section("content")
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: #6c757d; color: #fff;">
                    <h3 class="mb-0">Add New Landlord</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('frontend.landlord.store') }}" enctype="multipart/form-data" autocomplete="off">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label">Full Name</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Full Name" required aria-label="Full Name" autocomplete="off">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label">Email</label>
                            <div class="col-md-8">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required aria-label="Email" autocomplete="off">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label">Password</label>
                            <div class="col-md-8">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required aria-label="Password" autocomplete="new-password">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-secondary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
