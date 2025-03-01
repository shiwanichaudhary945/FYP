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

