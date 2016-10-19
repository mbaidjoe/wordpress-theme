<?php

/**
 * This is the single template for a custom post type.
 *
 * @var \League\Plates\Template\Template $this
 */

$this->layout('layout');

the_post();

?>
<h1><?php the_title() ?></h1>
<?php the_content() ?>
