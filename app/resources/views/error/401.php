<!DOCTYPE html>
<html lang="en">
<head>
	<title>ERROR 401 - Authorization Required</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="robots" content="noindex" />
	<style type="text/css">
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
		#header {
			padding: 6px ;
			text-align: center;
		}
		
		.status3xx { background-color: #475076; color: white; }
		.status4xx { background-color: #C55042; color: white; }
		.status5xx { background-color: #F2E81A; color: black; }
		
		#content {
			padding: 4px 0 24px 0;
		}
		
		#footer {
			color: #666666;
			background: #f9f9f9;
			padding: 10px 20px;
			border-top: 5px #efefef solid;
			font-size: 0.8em;
			text-align: center;
		}
		
		#footer a {
			color: #999999;
		}
	</style>
</head>
<body>
	<div id="page">
		<div id="header" class="status4xx">
			<h1>ERROR 401 - Authorization Required</h1>
		</div>
		<div id="content">
			<h2>The following error occurred:</h2>
			<p>This server could not verify that you are authorized to access the document requested. Either you supplied the wrong credentials (e.g., bad password), or your browser doesn't understand how to supply the credentials required.</p>
		</div>
		<div id="footer">
			<?php echo $_SERVER['SERVER_SIGNATURE'] ?>
		</div>
	</div>
</body>
</html>
