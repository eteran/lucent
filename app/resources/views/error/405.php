<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset='utf-8'>
	<title>ERROR 405 - Method Not Allowed</title>
	<meta name="robots" content="noindex">
	<style>
		body {
			color: #444444;
			background-color: #EEEEEE;
			font-family: 'Arial', sans-serif;
			font-size: 80%;
		}

		#page{
			background-color: white;
			width: 60%;
			margin: 24px auto;
			padding: 12px;
			border-radius: 10px;
			-moz-border-radius: 10px;
			-webkit-border-radius: 10px;
		}
		header {
			padding: 6px ;
			text-align: center;
		}
		
		.status3xx { background-color: #475076; color: white; }
		.status4xx { background-color: #C55042; color: white; }
		.status5xx { background-color: #F2E81A; color: black; }
		
		main {
			padding: 4px 0 24px 0;
		}
		
		footer {
			color: #666666;
			background: #f9f9f9;
			padding: 10px 20px;
			border-top: 5px #efefef solid;
			font-size: 0.8em;
			text-align: center;
		}
		
		footer a {
			color: #999999;
		}
	</style>
</head>
<body>
	<div id="page">
		<header class="status4xx">
			<h1>ERROR 405 - Method Not Allowed</h1>
		</header>
		<main>
			<h2>The following error occurred:</h2>
			<p>The method <?php echo $METHOD ?> specified in the Request-Line is not allowed for the specified resource.</p>
		</main>
		<footer>
			<?php echo $_SERVER['SERVER_SIGNATURE'] ?>
		</footer>
	</div>
</body>
</html>
