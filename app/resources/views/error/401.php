<?php echo Lucent\View::make('partials.header') ?>

    <main class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
				<h1>401 - Authorization Required</h1>
				<p>This server could not verify that you are authorized to access the document requested. Either you supplied the wrong credentials (e.g., bad password), or your browser doesn't understand how to supply the credentials required.</p>
		
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
