<?php echo Lucent\View::make('partials.header') ?>

    <main class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>Ajax &amp; Forms Test</h1>
				<form class="form" action="/test" method="POST">
				<input type="input" name="test">
				<input type="submit">
				</form>
				
				<hr>
				
				<button id="ajax-button">Ajax</button>
				
            </div>
        </div>
    </main>

<?php echo Lucent\View::make('partials.javascript') ?>

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
<?php echo Lucent\View::make('partials.footer') ?>
