<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Welcome to MinInventory</title>

	
</head>
<body>
	<h2>HomePage to MinInventory</h2>
	<div id="container">
        <h1>Welcome to CodeIgniter!</h1>
        <div id="body">
            <div id="messages"></div>
            <input type="text" id="text" placeholder="Message ..">
            <input type="text" id="recipient_id" placeholder="Recipient id ..">
            <button id="submit" value="POST">Send</button>
        </div>
        <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
    </div>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    var conn = new WebSocket('ws://localhost:8282');
    var client = {
        user_id: <?php echo $user_id; ?>,
        recipient_id: null,
        message: null
    };

    conn.onopen = function(e) {
        conn.send(JSON.stringify(client));
        $('#messages').append('<font color="green">Successfully connected as user '+ client.user_id +'</font><br>');
    };

    conn.onmessage = function(e) {
        var data = JSON.parse(e.data);
        if (data.message) {
            $('#messages').append(data.user_id + ' : ' + data.message + '<br>');
        }
    };

    $('#submit').click(function() {
        client.message = $('#text').val();
        if ($('#recipient_id').val()) {
            client.recipient_id = $('#recipient_id').val();
        }
        conn.send(JSON.stringify(client));
    });
    </script>