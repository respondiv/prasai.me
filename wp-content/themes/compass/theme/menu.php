<?php

/**
 * @package     The Compass
 * @author      Sonny T. <hi@sonnyt.com>
 */

function compass_main_menu()
{
    $menu_name = 'compass_triggers';
    $locations = get_nav_menu_locations();

    if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[$menu_name] ) ) {
    	$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
        $menu_items = wp_get_nav_menu_items( $menu->term_id );

        if ( 'page' != get_option( 'show_on_front' ) ) {
            ?>
                <li class="trigger-item">
                    <a href="/" data-type="page" data-title="<?php _e( 'Home', 'compass' ) ?>"><i class="fa fa-home"></i></a>
                </li>
            <?php
        }

        foreach ( $menu_items as $menu ): if ( $menu->menu_item_parent != 0 ) continue;
        	$type = ( $menu->type === 'custom' ) ? 'link' : 'page';
            $thumb_id = get_post_thumbnail_id( $menu->ID );

            $icon = ( empty( $thumb_id ) ) ? null : wp_get_attachment_image_src( $thumb_id );
        ?>
	        <li class="trigger-item">
	            <a href="<?php echo esc_url( $menu->url ); ?>" data-type="<?php echo esc_attr( $type ); ?>" <?php echo ($type === 'link') ? 'target="_blank"' : '' ?> data-title="<?php echo esc_attr( $menu->title ); ?>">
                    <?php if ( ! empty( $icon ) ): ?>
                        <img src="<?php echo esc_url( $icon[0] ); ?>" />
                    <?php else: ?>
                        <i class="fa <?php echo esc_attr( join( ' ', $menu->classes ) ); ?>"></i>
                    <?php endif; ?>
                </a>
	        </li>
        <?php
        endforeach;
    }
}
?>