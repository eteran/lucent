<?php echo Lucent\View::make('partials.header') ?>

    <main class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
				<h1>403 - Forbidden</h1>
				<p>You don't have permission to access <code><?php echo $request->url ?></code> on this server.</p>
		
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
