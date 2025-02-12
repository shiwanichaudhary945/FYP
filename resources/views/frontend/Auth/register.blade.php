<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Register</title>
</head>

<body>

    <div class="container">

        <form action="{{ route('registerUser') }}" method="POST" class="register active" id="register-form">
            @csrf
            <h2 class="title">Register your account</h2>

            <div id="form-errors" class="error-messages" style="display: none;"></div>

            <div class="form-group">
                <label for="name">Name</label>
                <div class="input-group">
                    <input type="text" id="name" name="name" placeholder="Full Name" value="{{ old('name') }}">
                    <i class='bx bx-user'></i>
                </div>
                @error('name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="register-email">Email</label>
                <div class="input-group">
                    <input type="email" id="register-email" name="email" placeholder="Email address" value="{{ old('email') }}">
                    <i class='bx bx-envelope'></i>
                </div>
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="register-password">Password</label>
                <div class="input-group">
                    <input type="password" id="register-password" name="password" placeholder="Your password">
                    <i class='bx bx-lock-alt'></i>
                </div>
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="confirm-pass">Confirm password</label>
                <div class="input-group">
                    <input type="password" id="confirm-pass" name="password_confirmation" placeholder="Enter password again">
                    <i class='bx bx-lock-alt'></i>
                </div>
            </div>

            <button type="submit" class="btn-submit">Register</button>
            <p>I already have an account. <a href="{{ route('login') }}">Login</a></p>
        </form>
    </div>

    <script src="{{ asset('js/script.js') }}"></script>

    <script>
        document.getElementById('register-form').addEventListener('submit', function (e) {
            const formErrors = document.getElementById('form-errors');
            formErrors.innerHTML = '';  // Clear previous errors
            formErrors.style.display = 'none';  // Hide error container initially

            let hasError = false;

            // Get field values
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('register-email').value.trim();
            const password = document.getElementById('register-password').value.trim();
            const confirmPassword = document.getElementById('confirm-pass').value.trim();

            // Check for empty fields
            if (!name || !email || !password || !confirmPassword) {
                formErrors.innerHTML += '<p>Please fill in all required fields.</p>';
                hasError = true;
            }

            // Check email format
            const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (email && !emailPattern.test(email)) {
                formErrors.innerHTML += '<p>Please enter a valid email address.</p>';
                hasError = true;
            }

            // Check password length
            if (password && password.length < 8) {
                formErrors.innerHTML += '<p>Password must be at least 8 characters long.</p>';
                hasError = true;
            }

            // Check if passwords match
            if (password !== confirmPassword) {
                formErrors.innerHTML += '<p>Password and confirmation password do not match.</p>';
                hasError = true;
            }

            // If there are errors, prevent form submission and show the error messages
            if (hasError) {
                formErrors.style.display = 'block';  // Show error container
                e.preventDefault();
            }
        });

        // Handle real-time error message removal as user types
        document.querySelectorAll('#name, #register-email, #register-password, #confirm-pass').forEach(function (input) {
            input.addEventListener('input', function () {
                const formErrors = document.getElementById('form-errors');
                formErrors.innerHTML = '';  // Clear errors
                formErrors.style.display = 'none';  // Hide the error container
                input.classList.remove('error');  // Remove error styling
            });
        });
    </script>
</body>

</html>
