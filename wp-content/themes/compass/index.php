<?php

/**
 * @package     The Compass
 * @author      Sonny T. <hi@sonnyt.com>
 */

function compass_index_page ()
{	
	get_template_part( 'theme/partials/posts' );
}

add_action( 'compass_content', 'compass_index_page' );

do_action( 'compass_template' );