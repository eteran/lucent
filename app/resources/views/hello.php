<?php echo Lucent\View::make('partials.header') ?>

    <main class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>Hello <?php echo $name ?></h1>
            </div>
        </div>
    </main>

<?php echo Lucent\View::make('partials.javascript') ?>
<?php echo Lucent\View::make('partials.footer') ?>
