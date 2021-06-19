<?php
	
	// $nonce =  hash("sha256",md5(uniqid(mt_srand((double)microtime()*1000000 + ""))));
	header("Access-Control-Allow-Origin: demonet.chat");
	header("Content-Security-Policy: script-src 'sha256-3f9c1ca06f36bc73527761cf7d8bd324947c001281edb1c0c5f36bbbd91386ff' 'sha256-80f04717f32ea0320c5e8618fbacedd1fee3a8775ad8292140a6113551d4b5b0'
		 child-src 'none'
		 img-src 'none'
		 ")
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>DemoNet - Chat</title>
	<link rel="manifest" href="manifest.json">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/chatStyle.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</head>
<body>

<div class="main-container">
	<div class="onlineUsers" id="onlineUsers">Users Online: </div>
	<div style="margin-left:9vw" class="user-container">
		<div class="userInformation">
			<p>
				<label for="nome">Username </label>
				<input id="nome" type="text"/>
			</p>
		<div class="messageFooter">
			<footer style="background-color: black; clear: both;
    						position: absolute;
    					height: 200px;
    margin-top: -200px;">
				<p>
					<button id="messageSend-btn" type="button" class="message-input">+</button>
					<input id="messageInput" class="message-input" type="text" autocomplete="false"/>   
				</p>
			</footer>
		</div>
		</div>
		<div id="chat" style="font-size: 0.8vw;"></div>
	</div>
</div>



<script type="module" src="js/socketHandler.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>


</body>
</html>
