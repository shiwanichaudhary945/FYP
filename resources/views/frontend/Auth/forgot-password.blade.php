{{-- @extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <h2>Forgot your password?</h2>
            @if(session('success'))
                <div class="success-messages">
                    {{ session('success') }}
                </div>
            @endif
            @if($errors->any())
                <div class="error-messages">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <button type="submit">Send Reset Link</button>
        </form>
    </div>
@endsection
 --}}

 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>forgot password</title>
    <style>
        </style>
 </head>
 <body>
    <form method="POST" action="{{route('auth.Submitforgetpassword')}}">
        @csrf
        <input type="email" name="email" id="email" placeholder="Enter email">

        <button type="submit">Send reset password link</button>
    </form>

 </body>
 </html>
