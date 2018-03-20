<?php

/**
 * @package     The Compass
 * @author      Sonny T. <hi@sonnyt.com>
 */

function compas_portfolio_page ()
{
	global $post;

	while ( have_posts() ) : the_post();
	$items = get_post_meta( get_the_ID(), 'portfolio_items', true );
	?>
		<!-- Page Title -->
		<h1 class="title"><?php the_title(); ?></h1>
		<!-- End Page Title -->

		<?php include( locate_template( 'theme/partials/portfolio.php' ) ); ?>
	<?php
	endwhile;
}

add_action( 'compass_content', 'compas_portfolio_page' );

do_action( 'compass_template' );