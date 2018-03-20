<?php

/**
 * @package     The Compass
 * @author      Sonny T. <hi@sonnyt.com>
 */

function compass_static_page ()
{
	while ( have_posts() ) : the_post();
	?>
		<!-- Page Title -->
		<h1 class="title"><?php the_title(); ?></h1>
		<!-- End Page Title -->
		
		<div class="format">
			<?php the_content(); ?>
		</div>

	<?php
	endwhile;
}

add_action( 'compass_content', 'compass_static_page' );

do_action( 'compass_template' );