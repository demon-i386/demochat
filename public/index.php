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
    <title>Demochat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="manifest.json">
    <link rel="PwnChat" type="image/jpg" href="assets/icon.jpg"/>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="https://unpkg.com/nes.css@latest/css/nes.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
	<style type="text/css"></style>
</head>

<body style="background-color: #1A1A1A; cursor: default;">
<style type="text/css">
	.nes-pointer{
		pointer: default;
	}
</style>

<div class="main-container">
	<div class="banner">
		<img class="ghost" src="/assets/ghost2.png"/>
		<h5 class="main-text" style="font-family: 'Press Start 2P', cursive; padding-top: 15px;">Welcome to Demochat<div class='console-container'><span id='text'></span><div class='console-underscore' id='console'>&#95;</div></div></h5></br>
	</div>
	<a href="_blank" class="main-action-btn">About</button>
	<a href="_blank" class="main-action-btn">Register</button>
</div>


<div class="login-panel">
	<img src="/assets/ghostcoffe.gif" style="float:right;" class="ghostcoffe" />
	<a href="_blank" class="login-btn">login</button>
</div>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
	consoleText(['A chat for hackers', 'A chat for lammers', 'A chat for aliens','A chat for everyone'], 'text',['lightgreen','tomato','white']);

	function consoleText(words, id, colors) {
	  if (colors === undefined) 
	  	colors = ['#fff'];
	  var visible = true;
	  var con = document.getElementById('console');
	  var letterCount = 1;
	  var x = 1;
	  var waiting = false;
	  var target = document.getElementById(id)
	  target.setAttribute('style', 'color:' + colors[0])
	  window.setInterval(function() {

	    if (letterCount === 0 && waiting === false) {
	      waiting = true;
	      target.innerHTML = words[0].substring(0, letterCount)
	      window.setTimeout(function() {
	        var usedColor = colors.shift();
	        colors.push(usedColor);
	        var usedWord = words.shift();
	        words.push(usedWord);
	        x = 1;
	        target.setAttribute('style', 'color:' + colors[0])
	        letterCount += x;
	        waiting = false;
	      }, 1000)
	    } else if (letterCount === words[0].length + 1 && waiting === false) {
	      waiting = true;
	      window.setTimeout(function() {
	        x = -1;
	        letterCount += x;
	        waiting = false;
	      }, 1000)
	    } else if (waiting === false) {
	      target.innerHTML = words[0].substring(0, letterCount)
	      letterCount += x;
	    }
	  }, 120)
	  window.setInterval(function() {
	    if (visible === true) {
	      con.className = 'console-underscore hidden'
	      visible = false;

	    } else {
	      con.className = 'console-underscore'

	      visible = true;
	    }
	  }, 400)
	}
</script>

<footer class="credits" style="color:#555555; font-size: 0.5vw"> @demon-i386 | <a href="https://github.com/demon-i386" target="_blank" class="links" style="color:#555555; font-size: 0.5vw">whoami</a> </footer>
</body>
</html>
