<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Login</title>
</head>

<body>

    <div class="container">

        <form action="{{ route('loginUser') }}" method="POST" class="login active" autocomplete="off">
            @csrf
            <h2 class="title">Login with your account</h2>

            @if(session('success'))
                <div id="success-message" class="success-messages">
                    {{ session('success') }}
                </div>
            @endif

            <div id="form-errors" class="error-messages"></div> <!-- Error message section -->

            <div class="form-group">
                <label for="email">Email</label>
                <div class="input-group">
                    <input type="email" id="email" name="email" placeholder="Email address" value="" autocomplete="off">
                    <i class='bx bx-envelope'></i>
                </div>
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-group">
                    <input type="password" id="password" name="password" placeholder="Your password" value="" autocomplete="new-password">
                    <i class='bx bx-lock-alt'></i>
                </div>
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-submit">Login</button>
            <a href="{{ route('password.request') }}">Forgot password?</a>

            <p>I don't have an account. <a href="{{ route('register') }}">Register</a></p>
        </form>

    </div>

    <script src="{{ asset('js/script.js') }}"></script>

    <script>
        // Check if the success message exists
        const successMessage = document.getElementById('success-message');
        if (successMessage) {
            // Set a timer to fade out the success message after 5 seconds
            setTimeout(() => {
                successMessage.style.transition = 'opacity 0.5s ease'; // Smooth transition
                successMessage.style.opacity = '0'; // Fade out effect
                setTimeout(() => {
                    successMessage.style.display = 'none'; // Remove from DOM after fade
                }, 500); // Match the duration of the fade
            }, 5000); // 5 seconds delay before fading out
        }

        document.querySelector('.login').addEventListener('submit', function (e) {
            const formErrors = document.getElementById('form-errors');
            formErrors.innerHTML = '';  // Clear previous errors
            let hasError = false;

            // Get field values
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value.trim();

            // Check for empty fields
            if (!email || !password) {
                formErrors.innerHTML += '<p>Please fill in all required fields.</p>';
                hasError = true;
            }

            // Check email format
            const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (email && !emailPattern.test(email)) {
                formErrors.innerHTML += '<p>Please enter a valid email address.</p>';
                hasError = true;
            }

            // If there are errors, prevent form submission
            if (hasError) {
                formErrors.style.display = 'block';  // Show the error box
                e.preventDefault();  // Prevent form submission
            } else {
                formErrors.style.display = 'none';  // Hide the error box if no errors
            }
        });

        // Clear the error message and hide the error box when the user starts typing
        document.getElementById('email').addEventListener('input', function() {
            const formErrors = document.getElementById('form-errors');
            formErrors.innerHTML = ''; // Clear the error messages
            formErrors.style.display = 'none'; // Hide the error box
        });

        document.getElementById('password').addEventListener('input', function() {
            const formErrors = document.getElementById('form-errors');
            formErrors.innerHTML = ''; // Clear the error messages
            formErrors.style.display = 'none'; // Hide the error box
        });
    </script>

</body>

</html>
