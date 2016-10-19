<?php

/**
 * This is the template for a single post.
 *
 * @var \League\Plates\Template\Template $this
 */

$this->layout('layout');

the_post();

?>
<h1><?php the_title() ?></h1>
<?php the_content() ?>
