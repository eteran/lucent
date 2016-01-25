<!DOCTYPE html>
<html lang="en">
<head>
<title>Test</title>
<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
</head>
<body>
	
	<form action="/test" method="POST">
	<input type="input" name="test">
	<input type="submit">
	</form>
	
	<hr>
	
	<button id="ajax-button">Ajax</button>
	
	<script>
	$(function() {
		$('#ajax-button').click(function() {
			$.ajax({
				type: "POST",
				url: '/test',
				data: JSON.stringify({"key":"value"}),
				contentType: 'application/json; charset=UTF-8'
			}).done(function(data) {
				alert(data);
			});
		});
	});
	</script>	
</body>
</html>
