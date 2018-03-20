<?php

/**
 * @package     The Compass
 * @author      Sonny T. <hi@sonnyt.com>
 */

$options = apply_filters( 'compass_settings', null );

/**
 * Load JavaScript and Stylesheets
 */
function compass_layout_scripts () {
    // stylesheet
    wp_enqueue_style( 'compass', get_stylesheet_directory_uri() . '/style.css', false, '1.0.0', 'all' );

    // javascript
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'jquery.address', get_template_directory_uri() . '/assets/js/lib/jquery.address-1.6.min.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'jquery.swipebox', get_template_directory_uri() . '/assets/js/lib/jquery.swipebox.min.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'jquery.prettySocial', get_template_directory_uri() . '/assets/js/lib/jquery.prettySocial.min.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'compass', get_template_directory_uri() . '/assets/js/lib/scripts.js', array( 'jquery', 'jquery.address', 'jquery.swipebox', 'jquery.prettySocial' ), false, true );
    wp_enqueue_script( 'main', get_stylesheet_directory_uri() . '/assets/js/main.js', array( 'jquery', 'jquery.address', 'jquery.swipebox', 'jquery.prettySocial', 'compass' ), false, true );

    if ( is_singular() ) {
        wp_enqueue_script( 'comment-reply' );
    }
}

add_action( 'wp_enqueue_scripts', 'compass_layout_scripts' );

/**
 * Compass IE Styles
 */
function compass_layout_ie ()
{
    ?>
    <!--[if IE 8]>
      <style type="text/css">
        .resume .progress {
          background: none !important;
        }
        .page .content .error_message {
          display: block;
          visibility: hidden;
        }
        .main .circle .triggers li.trigger-item a {
          border-radius: 100%;
        }
        .page_window .close-page {
          z-index: auto;
          position: static;
        }
        
        .main .circle,
        .main .circle .description,
        .main .circle .triggers li.trigger-item a,
        .main .circle .triggers li.trigger-item a:hover,
        .page_window .content .error_message,
        .page_window .content .posts li .thumbnail img,
        .page_window .content .comment-list .comment .comment-title .avatar,
        .page_window .content .tags a,
        .resume .progress,
        .resume .progress span,
        .portfolio img,
        .format code,
        .format pre,
        .page_window .content input,
        .page_window .content textarea,
        .page_window .content .tags a {
          behavior: url('<?php echo trailingslashit( get_stylesheet_directory_uri() ); ?>assets/css/lib/css3pie/PIE.php');
          position: relative;
        }

        .main .circle {
          position: static;
        }
      </style>
    <![endif]-->
    <?php
}

add_action( 'wp_head', 'compass_layout_ie', 8 );

/**
 * Compass Background Image
 */
if ( ! function_exists( 'compass_layout_background' ) ) {
  function compass_layout_background ()
  {
    $options = apply_filters( 'compass_settings', 'background' );

    if ( ! empty( $options['image'] ) ) {
      ?>
        <style type="text/css">
          /**
           * Background Image
           */
          body,
          body #swipebox-slider .slide {
            background-image: url("<?php echo esc_url( $options['image'] ); ?>") !important;
            background-position: <?php echo esc_html( $options['position'] ); ?> !important;
            background-repeat: <?php echo esc_html( $options['repeat'] ); ?> !important;
          }
        </style>
      <?php
    }
  }
}

add_action( 'wp_head', 'compass_layout_background' );

/**
 * Compass Custom Template
 */
if ( ! function_exists( 'compass_custom_template' ) ) {
  function compass_custom_template ()
  {
      $options = apply_filters( 'compass_settings', 'color' );

      if ( $options['type'] == 'custom-color' ):
      ?>
        <style type="text/css">
          /**
           * Custom Color Set
           */
          body.custom-color {
            background-color: <?php echo $options['custom']['backgroundColor']; ?>;
            color: <?php echo $options['custom']['bodyFontColor']; ?>;
          }
          body.custom-color .page_window .content .title a {
            color: <?php echo $options['custom']['pageFontColor']; ?>;
          }
          body.custom-color #swipebox-slider .slide,
          body.custom-color .loader {
            background-image: url("<?php echo esc_url( $options['custom']['loader'] ); ?>");
            background-color: <?php echo $options['custom']['backgroundColor']; ?>;
          }
          body.custom-color .description {
            color: <?php echo $options['custom']['triggerColor']; ?>;
            background: <?php echo $options['custom']['secondary']; ?>;
            background: rgba(<?php echo apply_filters( 'compass_colorConvert', $options['custom']['secondary'] ); ?>, 0.7);
          }
          body.custom-color .trigger-item a {
            color: <?php echo $options['custom']['triggerColor']; ?>;
            background: <?php echo $options['custom']['primary']; ?>;
            border: 6px solid <?php echo $options['custom']['primary']; ?>;
          }
          body.custom-color .trigger-item a:hover {
            background: <?php echo $options['custom']['secondary']; ?>;
            border-color: <?php echo $options['custom']['secondary']; ?>;
          }
          body.custom-color #swipebox-close,
          body.custom-color #swipebox-prev,
          body.custom-color #swipebox-next,
          body.custom-color .close-page,
          body.custom-color .page_window .content a:hover {
            color: <?php echo $options['custom']['secondary']; ?>;
          }
          body.custom-color #swipebox-close:hover,
          body.custom-color #swipebox-prev:hover,
          body.custom-color #swipebox-next:hover,
          body.custom-color .close-page:hover,
          body.custom-color .page_window .content a {
            color: <?php echo $options['custom']['primary']; ?>;
          }
          body.custom-color .page_window {
            color: <?php echo $options['custom']['pageFontColor']; ?>;
            background: <?php echo $options['custom']['pageBackgroundColor']; ?>;
          }
          body.custom-color .format table tbody td,
          body.custom-color .format table tbody th,
          body.custom-color .format code,
          body.custom-color .format pre {
            border-color: <?php echo $options['custom']['pageFontColor']; ?>; 
          }
          body.custom-color .page_window .content h1.title:before,
          body.custom-color .page_window .content blockquote,
          body.custom-color .format table thead th,
          body.custom-color .format abbr,
          body.custom-color .format acronym {
            border-color: <?php echo $options['custom']['primary']; ?>;
          }
          body.custom-color .page_window .content input,
          body.custom-color .page_window .content textarea {
            background: <?php echo $options['custom']['input']; ?>;
            border: 1px solid <?php echo $options['custom']['shadow']; ?>;
          }
          body.custom-color .page_window .content input:focus,
          body.custom-color .page_window .content textarea:focus {
            border: 1px solid <?php echo $options['custom']['primary']; ?>;
          }
          body.custom-color .page_window .content input.wpcf7-not-valid,
          body.custom-color .page_window .content textarea.wpcf7-not-valid {
            border: 1px solid #ee6557;
          }
          body.custom-color .page_window .content .error_message {
            background: #ee6557;
            background: rgba(238, 101, 87, 0.6);
            border: 1px solid #ee6557;
          }
          body.custom-color .page_window .content .btn,
          body.custom-color .page_window .content button,
          body.custom-color .page_window .content input[type="submit"] {
            background: <?php echo $options['custom']['secondary']; ?>;
            color: white;
            cursor: pointer;
            border: 0;
          }
          body.custom-color .page_window .content .btn:hover,
          body.custom-color .page_window .content button:hover,
          body.custom-color .page_window .content input[type="submit"]:hover {
            background: <?php echo $options['custom']['primary']; ?>;
          }
          body.custom-color #swipebox-overlay {
            background: <?php echo $options['custom']['backgroundColor']; ?>;
          }
          body.custom-color #swipebox-action,
          body.custom-color #swipebox-caption {
            background: <?php echo $options['custom']['pageBackgroundColor']; ?>;
          }
          body.custom-color .resume h2,
          body.custom-color .page_window .content .required {
            color: <?php echo $options['custom']['primary']; ?>;
          }
          body.custom-color .resume .progress {
            background: <?php echo $options['custom']['shadow']; ?>;
          }
          body.custom-color .page_window .content .tags a {
            color: <?php echo $options['custom']['pageFontColor']; ?>;
            background: <?php echo $options['custom']['accent']; ?>;
          }
          body.custom-color .resume .progress span {
            background: <?php echo $options['custom']['secondary']; ?>;
          }
          body.custom-color .resume .detail span,
          body.custom-color .page_window .content .details,
          body.custom-color .page_window .content .details a {
            color: <?php echo $options['custom']['accent']; ?>;
          }
        </style>
      <?php
      endif;
  }
}

add_action( 'wp_head', 'compass_custom_template' );

$url = ( is_home() ) ? '/' : str_replace( get_site_url(), '', get_permalink() );
$url = ( is_404() ) ? str_replace( get_site_url() , '', "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ) : $url;

?>

<?php get_header(); ?>
	<div class="loader show"></div>
  <div class="main">
     <!-- Cricle -->
    <div class="circle" style="background-image: url('<?php echo esc_url( $options['image'] ); ?>');">
      <!-- Description Block -->
      <div class="description" style="display:none;"></div>
      <!-- End Description Block -->

      <!-- List of Triggers -->
      <ul class="triggers">
        <?php compass_main_menu(); ?>
      </ul>
      <!-- End List of Triggers -->
    </div>
    <!-- End Circle -->

    <!-- Main Info -->
    <div class="main_info">
      <h1><?php bloginfo( 'name' ); ?></h1>
      <p><?php bloginfo( 'description' ); ?><p>
    </div>
    <!-- End Main Info -->
  </div>

  <!-- Page Container -->
  <div class="page_window">
    <!-- Close Button -->
    <a href="<?php echo ( 'page' == get_option( 'show_on_front' ) ) ? '/' : '/#menu'; ?>" class="close-page">&times;</a>
    <!-- End Close Button -->

    <div class="content">
      <?php if ( has_action( 'compass_content' ) ): ?>
        <div class="pages" id="<?php echo esc_attr( $url ); ?>" data-title="<?php echo esc_attr( get_bloginfo( 'name' ) . ' | ' . wp_title( '', false, 'right' ) ); ?>" style="display: none;">
          <div <?php post_class(); ?>>
            <?php do_action( 'compass_content' ); ?>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
  <!-- End Page Container -->
<?php get_footer(); ?>