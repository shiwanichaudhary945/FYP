@extends('layouts.app')

@section('content')
<div id="chat-container">
    <h2>Chat with {{ $receiver->name }}</h2>
    <div id="messages"></div>
    <input type="text" id="message" placeholder="Type a message...">
    <button onclick="sendMessage()">Send</button>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
    let receiverId = "{{ $receiver_id }}";
    let userId = "{{ auth()->id() }}";

    function loadMessages() {
    axios.get(`/messages/${receiverId}`).then(response => {
        document.getElementById('messages').innerHTML = response.data.map(msg =>
            `<p><strong>${msg.sender_id == userId ? 'You' : 'Landlord'}</strong>: ${msg.message}</p>`
        ).join('');

        setTimeout(() => {
            document.getElementById('messages').scrollTop = document.getElementById('messages').scrollHeight;
        }, 100);
    });
}


    function sendMessage() {
        let message = document.getElementById('message').value;
        axios.post('/messages', { receiver_id: receiverId, message }).then(() => {
            document.getElementById('message').value = '';
            loadMessages();
            // Scroll to bottom after sending a message
        setTimeout(() => {
            document.getElementById('messages').scrollTop = document.getElementById('messages').scrollHeight;
        }, 100);
        });
    }

    window.Echo.private(`chat.${userId}`)
    .listen('.message-sent', (event) => {
        loadMessages(); // Reload messages when a new one is received
    });


    loadMessages();
</script>
@endsection
