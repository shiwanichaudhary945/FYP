<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <!-- Add your necessary CSS here, or move to external stylesheet -->
    <style>
        /* Chat container */
        .chat-container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f7f7f7;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        /* Chat header */
        .chat-header {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border-radius: 8px;
            text-align: center;
        }

        /* Chat messages area */
        .chat-messages {
            max-height: 400px;
            overflow-y: auto;
            padding: 15px;
            margin: 20px 0;
            background-color: white;
            border-radius: 8px;
            box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Chat message styles */
        .message {
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 8px;
            background-color: #f1f1f1;
            word-wrap: break-word;
        }

        .message.sent {
            background-color: #007bff;
            color: white;
            text-align: right;
        }

        .message.received {
            background-color: #f1f1f1;
            color: #333;
            text-align: left;
        }

        .message small {
            font-size: 12px;
            color: #999;
        }

        /* Input field and send button */
        .chat-input-container {
            display: flex;
            align-items: center;
        }

        .chat-input {
            flex: 1;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-right: 10px;
        }

        .chat-send-button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .chat-send-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div id="chat-container" class="chat-container">
        <div class="chat-header">
            <h2>Chat with {{ $receiver->name }}</h2>
        </div>
        <div id="messages" class="chat-messages"></div>
        <div class="chat-input-container">
            <input type="text" id="message" class="chat-input" placeholder="Type a message...">
            <button onclick="sendMessage()" class="chat-send-button">Send</button>
        </div>
    </div>

    <!-- Include JavaScript libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

    <script>
        let receiverId = "{{ $receiver_id }}";
        let userId = "{{ auth()->id() }}";

        function loadMessages() {
            axios.get(`/messages/${receiverId}`).then(response => {
                document.getElementById('messages').innerHTML = response.data.map(msg =>
                    `<div class="message ${msg.sender_id == userId ? 'sent' : 'received'}">
                        <p><strong>${msg.sender_id == userId ? 'You' : 'Landlord'}</strong>: ${msg.message}</p>
                        <small>${new Date(msg.created_at).toLocaleTimeString()}</small>
                    </div>`
                ).join('');
                scrollToBottom();
            });
        }

        function sendMessage() {
            let message = document.getElementById('message').value;
            if (message.trim() !== '') {
                axios.post('/messages', { receiver_id: receiverId, message }).then(() => {
                    document.getElementById('message').value = '';
                    loadMessages();
                });
            }
        }

        window.Echo.private(`chat.${userId}`)
            .listen('.message-sent', (event) => {
                loadMessages(); // Reload messages when a new one is received
            });

        function scrollToBottom() {
            let messagesContainer = document.getElementById('messages');
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        loadMessages();
    </script>
</body>
</html>
