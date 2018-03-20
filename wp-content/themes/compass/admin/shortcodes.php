<?php

/**
 * @package     The Compass
 * @author      Sonny T. <hi@sonnyt.com>
 */

class Compass_ShortCodes {

	public function __construct ()
	{
		add_shortcode( 'swipebox', array( &$this, 'swipebox' ) );
		add_shortcode( 'portfolio', array( &$this, 'portfolio' ) );
		add_shortcode( 'resume', array( &$this, 'resume' ) );
	}

	public function swipebox ( $atts, $content )
	{
		$title = $atts['title'];
		$url = $atts['url'];
	?>
        <a href="<?php echo esc_url( $url ); ?>" class="swipebox-item" title="<?php echo esc_attr( $title ); ?>"><?php echo $content; ?></a>
	<?php
	}

	public function portfolio ( $atts )
	{
		$id = $atts['id'];
		$items = get_post_meta( $id, 'portfolio_items', true );

		include( locate_template( 'theme/partials/portfolio.php' ) );
	}

	public function resume ( $atts )
	{
		$options = get_option( 'compass_resume' );

		include( locate_template( 'theme/partials/resume.php' ) );
	}
}

new Compass_ShortCodes();
