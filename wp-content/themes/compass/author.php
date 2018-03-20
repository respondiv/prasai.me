<?php

/**
 * @package     The Compass
 * @author      Sonny T. <hi@sonnyt.com>
 */

function compass_author_page () {
	?>
	<!-- Page Title -->
	<h1 class="title"><?php the_author(); ?></h1>
	<!-- End Page Title -->

	<?php get_template_part( 'theme/partials/posts' ); ?>
	
	<?php
}

add_action( 'compass_content', 'compass_author_page' );

do_action( 'compass_template' );