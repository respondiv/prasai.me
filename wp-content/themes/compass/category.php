<?php

/**
 * @package     The Compass
 * @author      Sonny T. <hi@sonnyt.com>
 */

function compass_category_page ()
{
	?>
	<!-- Page Title -->
	<h1 class="title"><?php single_cat_title() ?></h1>
	<!-- End Page Title -->

	<?php get_template_part( 'theme/partials/posts' ); ?>
	
	<?php
}

add_action( 'compass_content', 'compass_category_page' );

do_action( 'compass_template' );