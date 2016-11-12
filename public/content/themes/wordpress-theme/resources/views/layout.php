<?php

/**
 * @var \League\Plates\Template\Template $this
 */

?>
<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="<?= asset('/assets/styles/base.css') ?>" rel="stylesheet">
        <?php wp_head() ?>
    </head>
    <body>
        <div class="container">
            <nav class="navbar navbar-light bg-faded">
                <a class="navbar-brand" href="#">Navbar</a>
                <ul class="nav navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                </ul>
            </nav>
        </div>

        <main class="container">
            <?= $this->section('content') ?>
        </main>

        <script>
            window.ga=function(){ga.q.push(arguments)};ga.q=[];ga.l=+new Date;
            ga('create','<?= get_option('wordpress-theme/general-settings/google-analytics-id') ?>','auto');ga('send','pageview')
        </script>
        <script src="https://www.google-analytics.com/analytics.js" async defer></script>

        <?php wp_footer() ?>
    </body>
</html>
