<?php

/**
 * @package     The Compass
 * @author      Sonny T. <hi@sonnyt.com>
 */

define( 'THECOMPASS_ADMIN_PATH', get_template_directory() . '/admin' );
define( 'THECOMPASS_ADMIN_URI', get_template_directory_uri() . '/admin' );

require_once( THECOMPASS_ADMIN_PATH . '/settings/options.php' );
require_once( THECOMPASS_ADMIN_PATH . '/resume/options.php' );
require_once( THECOMPASS_ADMIN_PATH . '/shortcodes.php' );
require_once( THECOMPASS_ADMIN_PATH . '/portfolio/portfolio.php' );
require_once( THECOMPASS_ADMIN_PATH . '/plugin/required.php' );

if ( ! function_exists( 'compass_theme_activation' ) ) {
	function compass_theme_activation ()
	{
		if ( ! get_option( 'compass_settings' ) ) {
			$settings = array(
				'animation' => 'circular-animation',
				'image' => get_stylesheet_directory_uri() . '/assets/img/avatar.png',
				'color' => array(
					'type' => 'dark-color'
				)
			);

			add_option( 'compass_settings', $settings, '', 'no' );
		}
	}
}

add_action( 'after_switch_theme', 'compass_theme_activation' );