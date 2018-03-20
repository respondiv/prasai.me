<?php

/**
 * @package     The Compass
 * @author      Sonny T. <hi@sonnyt.com>
 */

$options = apply_filters( 'compass_settings', null ); ?>
<span class="meta_title" style="display: none !important;" data-title="<?php echo esc_attr( get_bloginfo( 'name' ) . ' | ' . wp_title( '', false, 'right' ) ); ?>"></span>
<div <?php post_class(); ?>>
	<?php do_action( 'compass_content' ); ?>
</div>