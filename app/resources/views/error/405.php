<?php echo Lucent\View::make('partials.header') ?>

    <main class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
				<h1>405 - Method Not Allowed</h1>
				<p>The method <code><?php echo $request->method ?></code> specified in the Request-Line is not allowed for the specified resource.</p>
		
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
