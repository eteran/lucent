<?php echo Lucent\View::make('partials.header') ?>

    <main class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
				<h1>500 - Internal Server Error</h1>
				
				<div class="text-left">
				<p>The server encountered an internal error or misconfiguration and was unable to complete your request.</p>
				<p>Please contact the server administrator, <?php $_SERVER['SERVER_ADMIN'] ?> and inform them of the time the error occurred, and anything you might have done that may have caused the error.</p>
				<p>More information about this error may be available in the server error log.</p>
				</div>
				
				<div class="panel panel-default" style="margin-top:40px;">
					<div class="panel-heading"><h3 class="panel-title">Details</h3></div>
					<div class="panel-body text-left"></div>
				</div>
			</div>
		</div>
	</main>

    <footer class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
				<?php echo $_SERVER['SERVER_SIGNATURE'] ?>
			</div>
		</div>
	</footer>

<?php echo Lucent\View::make('partials.javascript') ?>
<?php echo Lucent\View::make('partials.footer') ?>
