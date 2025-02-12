{{-- <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://unicons.iconscout.com/release/v4.0.0/css/line.css"
    />
    <link rel="stylesheet" href="{{ asset('build/assets/css/auth.css') }}">
    <title>Login Form</title>
  </head>
  <body>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif


    <div class="container">
      <div class="form login">
        <span class="title">Login</span>

        <form action="{{ route('login') }}" method="POST">
          @csrf
          <div class="input-field">
            <input type="text" name="email" placeholder="Enter your email" required />
            <i class="uil uil-envelope icon"></i>
          </div>
          <div class="input-field">
            <input type="password" name="password" class="password" placeholder="Enter your password" required />
            <i class="uil uil-lock icon"></i>
            <i class="uil uil-eye-slash showHidePw"></i>
          </div>

          <div class="checkbox-text">
            <div class="checkbox-content">
              <input type="checkbox" id="logCheck" />
              <label for="logCheck" class="text">Remember me</label>
            </div>
            <a href="#" class="text">Forgot password?</a>
          </div>

          <div class="input-field button">
            <input type="submit" value="Login" />
          </div>
        </form>

        <div class="login-signup">
          <span class="text">No account yet?
            <a href="{{ route('register') }}" class="text signup-link">Signup Now</a>
          </span>
        </div>
      </div>
    </div>
    <script src="{{ asset('build/assets/js/auth.js') }}"></script>
  </body>
</html> --}}
