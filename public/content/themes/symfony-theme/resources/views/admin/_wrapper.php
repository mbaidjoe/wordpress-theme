<?php

/**
 * The admin page slug.
 */
$page = filter_input(INPUT_GET, 'page');

?>
<div class="wrap">
    <h1><?= __('Settings', 'symfony-theme') ?></h1>

    <!-- tabs -->
    <h2 class="nav-tab-wrapper">
        <a class="nav-tab<?= $page === 'general-settings' ? ' nav-tab-active' : '' ?>" href="?page=general-settings">
            <?= __('General settings', 'symfony-theme') ?>
        </a>
    </h2>

    <!-- form -->
    <form action="?page=<?= $page ?>" method="post">
        <?php wp_nonce_field($page, 'symfony-theme-nonce') ?>
        <?= $content ?>

        <p class="submit">
            <button class="button button-primary" type="submit"><?= __('Save', 'symfony-theme') ?></button>
        </p>
    </form>
</div>
