<?php

/**
 * @package     The Compass
 * @author      Sonny T. <hi@sonnyt.com>
 */

$options = apply_filters( 'compass_settings', null ); ?>
<!doctype html>
<html <?php language_attributes(); ?> >
<head>
	<title><?php bloginfo( 'name' ); ?> | <?php is_front_page() ? bloginfo( 'description' ) : wp_title( '' ); ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<?php wp_head(); ?>
</head>
<body <?php body_class( array( esc_attr( $options['color']['type'] ), esc_attr( $options['animation'] ) ) ); ?> data-title="<?php echo esc_attr( get_bloginfo( 'name' ) . ' | ' . get_bloginfo( 'description' ) ); ?>">