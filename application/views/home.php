<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<div id="container d-flex">
	<h1>Home to MinInventory 222222222222222222222</h1>
	<div id="chat">
        <div id="messages"></div>
        <input type="text" id="message" />
        <button id="send">Send</button>
    </div>
</div>
<script>
        var conn = new WebSocket('ws://localhost:8080');
        conn.onopen = function(e) {
            console.log("Connection established!");
            conn.send(JSON.stringify({subscribe: '111111/zoneGames3'}));
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