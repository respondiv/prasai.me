<?php

/**
 * @package     The Compass
 * @author      Sonny T. <hi@sonnyt.com>
 */

class Compass_Portfolio {
	
	public function __construct ()
	{
		add_action( 'init', array( &$this, 'register' ) );
		add_action( 'add_meta_boxes', array( $this, 'meta_boxes' ) );
		add_action( 'admin_enqueue_scripts', array( &$this, 'scripts') );
		add_action( 'admin_footer', array( $this, 'item_template' ) );

        add_action( 'save_post', array( $this, 'save_meta' ) );
        add_action( 'publish_feed_page', array( $this, 'save_meta' ) );
	}

	public function register ()
	{
	    $labels = array( 
	        'name' => _x( 'Portfolio', 'portfolio', 'compass' ),
	        'singular_name' => _x( 'Portfolio', 'portfolio', 'compass' ),
	        'add_new' => _x( 'Add New', 'portfolio', 'compass' ),
	        'add_new_item' => _x( 'Add New Portfolio', 'portfolio', 'compass' ),
	        'edit_item' => _x( 'Edit Portfolio', 'portfolio', 'compass' ),
	        'new_item' => _x( 'New Portfolio', 'portfolio', 'compass' ),
	        'view_item' => _x( 'View Portfolio', 'portfolio', 'compass' ),
	        'search_items' => _x( 'Search Portfolios', 'portfolio', 'compass' ),
	        'not_found' => _x( 'No portfolios found', 'portfolio', 'compass' ),
	        'not_found_in_trash' => _x( 'No portfolios found in Trash', 'portfolio', 'compass' ),
	        'parent_item_colon' => _x( 'Parent Portfolio:', 'portfolio', 'compass' ),
	        'menu_name' => _x( 'Portfolio', 'portfolio', 'compass' ),
	    );

	    $args = array( 
	        'labels' => $labels,
	        'hierarchical' => false,
	        
	        'supports' => array( 'title' ),
	        
	        'public' => true,
	        'show_ui' => true,
	        'show_in_menu' => true,
	        
	        
	        'show_in_nav_menus' => true,
	        'publicly_queryable' => true,
	        'exclude_from_search' => true,
	        'has_archive' => false,
	        'query_var' => true,
	        'can_export' => true,
	        'rewrite' => true,
	        'capability_type' => 'post'
	    );

	    register_post_type( 'portfolio', $args );
	}

	public function meta_boxes()
	{
		add_meta_box( 'portfolio-items', 'Portfolio Items', array( $this, 'page_items' ), 'portfolio', 'advanced', 'high' );
	}

    public function scripts( $hook )
    {
        if ( $hook == 'post.php' || $hook == 'post-new.php' ) {
            wp_enqueue_media();
            wp_enqueue_script( 'jquery-ui-core' );
            wp_enqueue_script('jquery-ui-sortable');
            
            wp_enqueue_style( 'compass_portfolio_style', THECOMPASS_ADMIN_URI . '/portfolio/css/compass_portfolio.css', false, '1.0', 'all' );
            wp_enqueue_script( 'compass_portfolio_scripts', THECOMPASS_ADMIN_URI . '/portfolio/js/compass_portfolio.js' , array( 'jquery', 'jquery-ui-core' ) );
        }
    }

    public function save_meta( $post_id )
    {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

        if ( ! current_user_can( 'edit_posts' ) || ! isset( $_POST['items'] ) ) return;

        update_post_meta( $post_id, 'portfolio_items', array_filter( $_POST['items'] ) );
    }

	public function page_items()
	{
		global $post;

		$portfolio_items = get_post_meta( $post->ID, 'portfolio_items', true );
		?>
		<style type="text/css"> #normal-sortables { display: none; } </style>
		<ul class="compass_portfolio_items">
			<?php if ( ! empty( $portfolio_items ) ): foreach( $portfolio_items as $key => $item ): ?>
				<li data-id="<?php echo esc_attr( $key ); ?>">
                    <div class="details">
                        <a href="#" class="button remove" href="#">&times;</a>
                        <a href="#" class="button drag" href="#">&#9776;</a>
                    </div>
					<table class="form-table">
						<tr>
							<th><?php _e( 'Title', 'compass' ); ?></th>
							<td><input type="text" name="items[<?php echo $key ?>][title]" value="<?php echo isset( $item['title'] ) ? esc_attr( $item['title'] ) : ''; ?>" /></td>
						</tr>
						<tr>
							<th><?php _e( 'Type', 'compass' ); ?></th>
							<td>
								<select name="items[<?php echo $key ?>][type]" class="portfolio_type">
									<option value="image" <?php selected( $item['type'], 'image' ); ?>>Image</option>
									<option value="youtube" <?php selected( $item['type'], 'youtube' ); ?>>YouTube</option>
									<option value="vimeo" <?php selected( $item['type'], 'vimeo' ); ?>>Vimeo</option>
								</select>
							</td>
						</tr>
						<tr>
							<th><?php _e( 'Thumbnail Image', 'compass' ); ?></th>
							<td>
	                            <input class="upload_image regular-text" type="text" name="items[<?php echo $key ?>][thumbnail]" value="<?php echo isset( $item['thumbnail'] ) ? esc_attr( $item['thumbnail'] ) : ''; ?>" /> 
	                            <input class="upload_image_button button" type="button" value="Upload Image" />
							</td>
						</tr>
						<tr class="portfolio_image" <?php if ( $item['type'] == 'image' || empty( $item['type'] ) ): ?>style="display: table-row;"<?php endif; ?> >
							<th><?php _e( 'Image', 'compass' ); ?></th>
							<td>
	                            <input class="upload_image regular-text" type="text" name="items[<?php echo $key ?>][full]" value="<?php echo isset( $item['full'] ) ? esc_attr( $item['full'] ) : ''; ?>" /> 
	                            <input class="upload_image_button button" type="button" value="Upload Image" />
							</td>
						</tr>
						<tr class="portfolio_video" <?php if ( $item['type'] == 'youtube' || $item['type'] == 'vimeo' ): ?>style="display: table-row;"<?php endif; ?>>
							<th><?php _e( 'Video', 'compass' ); ?></th>
							<td>
	                            <input type="text" class="regular-text" name="items[<?php echo $key ?>][video]" value="<?php echo isset( $item['video'] ) ? esc_url( $item['video'] ) : ''; ?>" />
	                            <p class="description"><?php _e('Example: https://www.youtube.com/watch?v=IAISUDbjXj0 or http://vimeo.com/2619976'); ?></p>
							</td>
						</tr>
					</table>
				</li>
			<?php endforeach; endif;?>
		</ul>
		<a href="#" class="button" id="add_item"><?php _e( '+ Add Item', 'compass' ); ?></a>
		
		<?php if ( isset( $post->ID ) ): ?>
		<p class="description"><br /> <?php printf( __( 'You can either use this page directly or load it via shortcode on any desired external page as so, <code>[portfolio id="%s"]</code></p>', 'compass'), $post->ID ); ?>
		<?php endif; ?>

		<?php
	}

	public function item_template()
	{
		?>
			<script type="text/html" id="tmpl-portfolio-item-template">
				<li data-id="{{key}}">
                    <div class="details">
                        <a href="#" class="button remove" href="#">&times;</a>
                        <a href="#" class="button drag" href="#">&#9776;</a>
                    </div>
					<table class="form-table">
						<tr>
							<th><?php _e( 'Title', 'compass' ); ?></th>
							<td><input type="text" name="items[{{key}}][title]" /></td>
						</tr>
						<tr>
							<th><?php _e( 'Type', 'compass' ); ?></th>
							<td>
								<select name="items[{{key}}][type]" class="portfolio_type">
									<option value="image">Image</option>
									<option value="youtube">YouTube</option>
									<option value="vimeo">Vimeo</option>
								</select>
							</td>
						</tr>
						<tr>
							<th><?php _e( 'Thumbnail Image', 'compass' ); ?></th>
							<td>
	                            <input class="upload_image regular-text" type="text" name="items[{{key}}][thumbnail]" value="" /> 
	                            <input class="upload_image_button button" type="button" value="Upload Image" />
							</td>
						</tr>
						<tr class="portfolio_image" style="display: table-row;">
							<th><?php _e( 'Image', 'compass' ); ?></th>
							<td>
	                            <input class="upload_image regular-text" type="text" name="items[{{key}}][full]" value="" /> 
	                            <input class="upload_image_button button" type="button" value="Upload Image" />
							</td>
						</tr>
						<tr class="portfolio_video">
							<th><?php _e( 'Video', 'compass' ); ?></th>
							<td>
	                            <input type="text" class="regular-text" name="items[{{key}}][video]" /> 
							</td>
						</tr>
					</table>
				</li>
			</script>
		<?php
	}
}

new Compass_Portfolio();