<?php

namespace Chat;

use Exception;
use SplObjectStorage;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use Ratchet\Http\HttpServerInterface;


final class ChatServer implements MessageComponentInterface
{
	private $clients;
	private $uid;
	private int $clientCount = 0;

	protected function uid() {
		mt_srand((double)microtime()*1000000);
		$token = mt_rand(1, mt_getrandmax());

		$uid = uniqid(md5($token), true);
		if($uid != false && $uid != '' && $uid != NULL) {
			$out = sha1($uid);
			return $out;
		} 
		else {
			return false;
		}
	}

	// aqui é só msc criminosa

	public function __construct()
	{
		$this->clients = new SplObjectStorage();
		$this->uid = $this->uid();
	}


	public function onOpen(ConnectionInterface $conn): void
	{
		// echo json_encode($conn->httpRequest->getHeaders()) . "\n";
		echo $this->uid . "\n";
		$this->clients->attach($conn);
		$count = $this->clients->count();
		$serverInfo = array('onlineUsers' => $count);
		foreach ($this->clients as $client) {
			$client->send(json_encode($serverInfo));
		}
		$conn->send(json_encode($serverInfo));
		echo "Connection with ({$conn->resourceId}) estabilished\n";
	}

	public function onMessage(ConnectionInterface $from, $msg): void
	{
		$raw_message = json_decode($msg, true);
		$keys = array_keys($raw_message);
		if(count($raw_message, COUNT_RECURSIVE) >= 2){
			if(!array_key_exists("name", $raw_message) || !array_key_exists("message", $raw_message)){
				echo "invalid json :: " . var_dump($raw_message) . "\n";
				$raw_message = NULL;
			}
		}
		if($raw_message != NULL){
			$raw_message = str_replace("&", "&amp", $raw_message);
			$raw_message = str_replace("<", "&lt", $raw_message);
			$raw_message = str_replace(">", "&gt", $raw_message);
			$raw_message = str_replace("\"", "&quot", $raw_message);
			$raw_message = str_replace("\'", "&#x27", $raw_message);
			// $raw_message = htmlspecialchars($raw_message, ENT_QUOTES);
			$header = array('header' => 1);
			$msg = array_merge($raw_message, $header);
			$msg = json_encode($msg);

			echo $msg;
			foreach ($this->clients as $client) {
				$client->send($msg);
			}
		}
	}

	public function onClose(ConnectionInterface $conn): void
	{
		$this->clients->detach($conn);
		$count = $this->clients->count();
		$serverInfo = array('onlineUsers' => $count);
		foreach ($this->clients as $client) {
			$client->send(json_encode($serverInfo));
		}

		echo "Connection ({$conn->resourceId}) has disconnected\n";
	}

	public function onError(ConnectionInterface $conn, Exception $exception): void
	{
		$conn->close();
	}
}
?>

