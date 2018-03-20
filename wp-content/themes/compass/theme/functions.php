<?php

/**
 * @package     The Compass
 * @author      Sonny T. <hi@sonnyt.com>
 */

/**
 * Post Thumbnail support
 */
add_theme_support( 'post-thumbnails' );
add_theme_support( 'automatic-feed-links' );

set_post_thumbnail_size( 100, 100, true );
add_image_size( 'featured', 510, 287, true );

/**
 * Content Width
 */
if ( ! function_exists( 'compass_embed_width' ) ) {
  function compass_embed_width ( $defaults ) {
    $defaults['width'] = 510;

    return $defaults;
  }
}

add_filter( 'embed_defaults', 'compass_embed_width' );

/**
 * The Compass Settings
 */
if ( ! function_exists( 'compass_settings' ) ) {
  function compass_settings ( $option )
  {
    static $options;

    $options = ( isset( $options ) ) ? $options : get_option( 'compass_settings' );

    if ( isset( $option ) && isset( $options[$option] ) ) {
      return $options[$option];
    }

    return $options;
  }
}

add_filter( 'compass_settings', 'compass_settings' );

/**
 * Load Language
 */

if ( ! function_exists( 'compass_language' ) ) {
  function compass_language ()
  {
    load_theme_textdomain( 'compass', get_template_directory() . '/languages' );
  }
}

add_action( 'after_setup_theme', 'compass_language' );

/**
 * The Compass Hex to RGB Color Converter
 */
if ( ! function_exists( 'compass_colorConvert' ) ) {
  function compass_colorConvert ( $hex )
  {
     $hex = str_replace( '#', '', $hex );

     if( strlen( $hex ) == 3 ) {
        $r = hexdec( substr( $hex, 0, 1 ).substr( $hex, 0, 1 ) );
        $g = hexdec( substr( $hex, 1, 1 ).substr( $hex, 1, 1 ) );
        $b = hexdec( substr( $hex, 2, 1 ).substr( $hex, 2, 1 ) );
     } else {
        $r = hexdec( substr( $hex, 0, 2 ) );
        $g = hexdec( substr( $hex, 2, 2 ) );
        $b = hexdec( substr( $hex, 4, 2 ) );
     }

     $rgb = array( $r, $g, $b );

     return implode( ',', $rgb );
  }
}

add_filter( 'compass_colorConvert', 'compass_colorConvert' );

/**
 * The Compass template based on query variable passed throught get method
 * @return String HTML
 */
if ( ! function_exists( 'compass_template' ) ) {
  function compass_template ()
  {
      $template = ( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) == 'xmlhttprequest' ) ? 'page' : 'master';

      get_template_part( 'theme/layouts/' . $template );
  }
}

add_action( 'compass_template', 'compass_template' );

/**
 * Main menu
 */
register_nav_menus( array(
    'compass_triggers' => 'Main Navigation Menu',
) );

/**
 * Make Base URL visible
 */
if ( ! function_exists( 'compass_url' ) ) {
  function compass_url ()
  {
    ?>
      <script type="text/javascript">
        var compass_base_url = "<?php echo esc_js( site_url() ); ?>";
      </script>
    <?php
  }
}

add_action( 'wp_head', 'compass_url' );

/**
 * Is Front Page Set
 */
if ( ! function_exists( 'compass_front_page' ) ) {
  function compass_front_page ()
  {
    ?>
      <script type="text/javascript">
        var compass_frontpage = <?php echo ( 'page' == get_option( 'show_on_front' ) ) ? esc_js( 'true' ) : esc_js( 'false' ); ?>;
      </script>
    <?php
  }
}

add_action( 'wp_head', 'compass_front_page' );

/**
 * Excerpt Length
 */
if ( ! function_exists( 'compass_excerpt' ) ) {
  function compass_excerpt ( $length )
  {
    return 20;
  }
}

add_filter( 'excerpt_length', 'compass_excerpt', 999 );

/**
 * Excerpt
 */
if ( ! function_exists( 'compass_excerpt_link' ) ) {
  function compass_excerpt_link ( $more ) {
    return '... <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' . __( 'Read More', 'compass' ) .  '</a>';
  }
}

add_filter( 'excerpt_more', 'compass_excerpt_link' );
