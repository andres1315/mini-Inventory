<!-- application/views/chat_view.php -->
<!DOCTYPE html>
<html>
<head>
    <title>WebSocket Chat</title>
</head>
<body>
    <div id="chat">
        <div id="messages"></div>
        <input type="text" id="message" />
        <button id="send">Send</button>
    </div>
    <script>
        var conn = new WebSocket('ws://localhost:8080');
        conn.onopen = function(e) {
            console.log("Connection established!");
            conn.send(JSON.stringify({subscribe: '111111/zoneGames'}));
        };

        conn.onmessage = function(e) {
          console.log(e.data)
            var messages = document.getElementById('messages');
            var message = document.createElement('div');
            message.textContent = e.data;
            messages.appendChild(message);
        };

        document.getElementById('send').onclick = function() {
            var messageInput = document.getElementById('message');
            var message = messageInput.value;
            conn.send(message);
            messageInput.value = '';
        };
    </script>
</body>
</html>
