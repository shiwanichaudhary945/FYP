@extends('layouts.app')

@section('content')
<div id="chat-container">
    <div id="messages"></div>
    <input type="text" id="message" placeholder="Type a message...">
    <button onclick="sendMessage()">Send</button>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
    let receiverId = 2; // Set dynamically based on selected user
    let userId = "{{ auth()->id() }}";

    function loadMessages() {
        axios.get(`/messages/${receiverId}`).then(response => {
            document.getElementById('messages').innerHTML = response.data.map(msg =>
                `<p>${msg.sender_id == userId ? 'You' : 'User'}: ${msg.message}</p>`
            ).join('');
        });
    }

    function sendMessage() {
        let message = document.getElementById('message').value;
        axios.post('/messages', { receiver_id: receiverId, message }).then(() => {
            document.getElementById('message').value = '';
        });
    }

    window.Echo.private(`chat.${receiverId}`)
        .listen('.message-sent', (event) => {
            loadMessages();
        });

    loadMessages();
</script>
@endsection

