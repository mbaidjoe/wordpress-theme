<?php

/**
 * @var string $type
 * @var string $notice
 */

?>
<div class="<?= $type ?> notice is-dismissible">
    <p><?= $notice ?></p>
    <button class="notice-dismiss" type="button">
        <span class="screen-reader-text"><?= __('Hide this message', 'wordpress-theme') ?></span>
    </button>
</div>
