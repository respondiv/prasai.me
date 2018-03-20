<?php

/**
 * @package     The Compass
 * @author      Sonny T. <hi@sonnyt.com>
 */

function compass_archive_page () {
	?>
	<!-- Page Title -->
	<h1 class="title">
		<?php
			if ( is_day() ) :
				printf( __( 'Daily Archives: %s', 'compass' ), get_the_date() );

			elseif ( is_month() ) :
				printf( __( 'Monthly Archives: %s', 'compass' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'compass' ) ) );

			elseif ( is_year() ) :
				printf( __( 'Yearly Archives: %s', 'compass' ), get_the_date( _x( 'Y', 'yearly archives date format', 'compass' ) ) );

			else :
				_e( 'Archives', 'compass' );

			endif;
		?>
	</h1>
	<!-- End Page Title -->

	<?php get_template_part( 'theme/partials/posts' ); ?>
	
	<?php
}

add_action( 'compass_content', 'compass_archive_page' );

do_action( 'compass_template' );