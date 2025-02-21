{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
</head>
<body>
    <h2>Forgot Password</h2>
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    @if($errors->any())
        <p style="color: red;">{{ $errors->first() }}</p>
    @endif
    <form action="{{ route('password.email') }}" method="POST">
        @csrf
        <label for="email">Enter your email:</label>
        <input type="email" name="email" required>
        <button type="submit">Send Password Reset Link</button>
    </form>
</body>
</html> --}}

@extends('layouts.app')

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

