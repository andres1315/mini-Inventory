<?php
// websocket/server.php
require dirname(__DIR__) . '/vendor/autoload.php';

class Chat implements Ratchet\MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new SplObjectStorage;
    }

    public function onOpen(Ratchet\ConnectionInterface $conn) {
        $conn->chanel=null;
        $this->clients->attach($conn);
        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(Ratchet\ConnectionInterface $from, $msg) {
      $data = json_decode($msg);
      // Check if the message is to subscribe to a channel
      if (isset($data->subscribe)) {
          $from->channel = $data->subscribe;
          echo "Connection {$from->resourceId} subscribed to channel {$from->channel}\n";
          return;
      }

      foreach ($this->clients as $client) {
          // Only send messages to clients subscribed to the same channel
          if ($client !== $from && $client->channel === $from->channel) {
              $client->send($msg);
          }
      }
    }

    public function onClose(Ratchet\ConnectionInterface $conn) {
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(Ratchet\ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }
}

$server = Ratchet\Server\IoServer::factory(
    new Ratchet\Http\HttpServer(
        new Ratchet\WebSocket\WsServer(
            new Chat()
        )
    ),
    8080
);

$server->run();
