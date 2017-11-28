<?php

/**
 * @var \WordpressTheme\Hooks\Admin\AbstractPage $this
 * @var \WordpressTheme\Hooks\Admin\AbstractTab  $tab
 */

if ($hasTabs = $this->tabs->isNotEmpty()) {
    $currentTab = filter_input(INPUT_GET, 'tab');
    $currentTab = $currentTab ?? $this->tabs->first()->slug;
}

?>
<div class="wrap">
    <h1><?= $this->title ?></h1>

    <!-- tabs -->
    <?php if ($hasTabs) : ?>
        <h2 class="nav-tab-wrapper">
            <?php foreach ($this->tabs as $tab) : ?>
                <a class="nav-tab<?= $tab->slug === $currentTab ? ' nav-tab-active' : '' ?>" href="?page=<?= $this->slug ?>&tab=<?= $tab->slug ?>">
                    <?= $tab->title ?>
                </a>
            <?php endforeach; ?>
        </h2>
    <?php endif; ?>

    <!-- form -->
    <form id="form-<?= $this->slug ?>" method="post" novalidate>
        <?php wp_nonce_field($this->slug . '_nonce') ?>

        <!-- content -->
        <?php require path('/resources/views/admin/' . $this->view); ?>

        <!-- submit -->
        <p class="submit">
            <button class="button button-primary" type="submit"><?= __('Save', 'wordpress-theme') ?></button>
        </p>
    </form>
</div>
