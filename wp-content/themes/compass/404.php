<?php

/**
 * @package     The Compass
 * @author      Sonny T. <hi@sonnyt.com>
 */

function compass_404_page () {
	?>
	<!-- Page Title -->
	<h1 class="title"><?php _e( 'Page Not Found', 'compass' ); ?></h1>
	<!-- End Page Title -->
	<br />
	<p style="text-align: center;"><?php _e( 'Sorry the page you were looking for cannot be found.', 'compass' ); ?></p>
	<?php
}

add_action( 'compass_content', 'compass_404_page' );

do_action( 'compass_template' );