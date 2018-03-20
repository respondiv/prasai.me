<?php

/**
 * @package     The Compass
 * @author      Sonny T. <hi@sonnyt.com>
 */

/**
 * Define PATH and URI
 */
define( 'THECOMPASS_PATH', get_template_directory() . '/theme' );
define( 'THECOMPASS_URI', get_template_directory_uri() . '/theme' );

/**
 * Load helpers
 */
require_once( THECOMPASS_PATH . '/menu.php' );
require_once( THECOMPASS_PATH . '/functions.php' );