{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body>
    <h2>Reset Password</h2>
    @if($errors->any())
        <p style="color: red;">{{ $errors->first() }}</p>
    @endif
    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <label for="password">New Password:</label>
        <input type="password" name="password" required>
        <label for="password_confirmation">Confirm Password:</label>
        <input type="password" name="password_confirmation" required>
        <button type="submit">Reset Password</button>
    </form>
</body>
</html> --}}


@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <h2>Reset your password</h2>
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
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            </div>
            <div class="form-group">
                <label for="password">New Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm New Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>
            <button type="submit">Reset Password</button>
        </form>
    </div>
@endsection
