<?php

require './vendor/autoload.php';

use \Chat\ChatServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\Http\HttpServer;
use Ratchet\Http\OriginCheck;

$checkedApp = new OriginCheck(new ChatServer(), array('localhost'));
$checkedApp->allowedOrigins[] = 'demonet.chat';

echo "Server Ready!\n";
$app = IoServer::factory(
    new HttpServer(new WsServer(
    	new ChatServer())),
    9990
);

//$app = new Ratchet\App('localhost', 9990);
//$app->route('/chat', new ChatServer, ['*']);

$app->run();

?>
