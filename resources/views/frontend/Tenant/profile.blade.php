<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings</title>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
</head>
<body>
    <div class="container">
        <!-- Profile Image Section -->
        {{-- <div class="profile-image-container">
            <div class="image-upload">
                <!-- Profile Image Preview -->
                <img
                    src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : 'https://via.placeholder.com/150' }}"
                    alt="Profile Image"
                    class="profile-image"
                    id="profileImagePreview"
                    style="border-radius: 50%; width: 150px; height: 150px;">

                <!-- File Input -->
                <input
                    type="file"
                    name="profile_image"
                    id="profile_image"
                    accept="image/*"
                    onchange="previewImage(event)">

                <!-- Validation Error -->
                @error('profile_image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div> --}}

        <!-- Separator Line -->
        {{-- <div class="separator"></div> --}}


        @if(session('success'))
        <div class="alert alert-success" style="text-align: center; margin: 20px auto; width: 50%; border-radius: 5px; padding: 10px;">
            {{ session('success') }}
        </div>
    @endif

        <!-- Profile Form Section -->
        <div class="profile-form">
            <!-- Header -->
            <div class="profile-header">
                <h2>Profile Settings</h2>
            </div>

            <!-- Form -->
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- @method('POST') --}}

                <!-- Name Field -->
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name ?? '') }}">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email Field -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email ?? '') }}">
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password Fields -->
                <!-- Password Field -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password">
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>


                <!-- Submit Button -->
                <button type="submit" class="btn">Update Profile</button>
            </form>
        </div>
    </div>

    {{-- <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function() {
                document.getElementById('profileImagePreview').src = reader.result;
            };
            reader.readAsDataURL(file);
        }
    </script> --}}
</body>
</html>
