@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Chat with User {{ $receiver->name }}</h3>

    <div class="chat-box" style="border: 1px solid #ccc; padding: 10px; height: 300px; overflow-y: scroll;">
        @foreach ($messages as $message)
            <p>
                <strong>{{ $message->sender_id == Auth::id() ? 'You' : 'User' }}:</strong>
                {{ $message->message }}
            </p>
        @endforeach
    </div>

    <form action="{{ route('chat.send') }}" method="POST">
        @csrf
        <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">

        <textarea name="message" class="form-control" placeholder="Type a message..." required></textarea>
        <button type="submit" class="btn btn-primary mt-2">Send</button>
    </form>
</div>
@endsection
