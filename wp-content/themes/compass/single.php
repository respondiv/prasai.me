<?php

/**
 * @package     The Compass
 * @author      Sonny T. <hi@sonnyt.com>
 */

function compass_single_page ()
{
	while ( have_posts() ) : the_post();
	?>
		<!-- Page Title -->
		<h1 class="title"><?php the_title(); ?></h1>
		<!-- End Page Title -->

		<p class="details">
			<!-- Author -->
			<span><i class="fa fa-user"></i> <?php the_author_posts_link(); ?></span>
			<!-- End Author -->

			<!-- Date -->
			<span><i class="fa fa-clock-o"></i> <?php the_date(); ?></span>
			<!-- End Date -->

			<!-- Category -->
			<?php if ( get_the_category() ): ?>
				<span><i class="fa fa-folder"></i> <?php the_category( ', ' ); ?></span>
			<?php endif; ?>
			<!-- End Category -->
		</p>

		<div class="format">
			<!-- Featured Image -->
			<?php if ( has_post_thumbnail() ): ?>
				<div class="featured-image"><?php the_post_thumbnail( 'featured' ); ?></div>
			<?php endif; ?>
			<!-- End Featured Image -->

			<?php the_content(); ?>

			<?php wp_link_pages(); ?>
		</div>
		
		<div class="clearfix post-detail">
			<!-- Tags -->
			<?php if ( get_the_tags() ): ?>
			<p class="tags">
				<strong><?php _e( 'TAGS', 'compass' ); ?></strong><br />
				<?php the_tags( ' ', ' ', ' ' ); ?>
			</p>
			<?php endif; ?>
			<!-- End Tags -->

			<!-- Social Shares -->
			<p class="shares" <?php if ( get_the_tags() ): ?> style="width: 30%;" <?php endif; ?>>
				<strong><?php _e( 'SHARE', 'compass' ); ?></strong><br />
				<span class="prettySocial fa fa-facebook" data-type="facebook" data-url="<?php echo esc_url( get_permalink() ); ?>"></span>
				<span class="prettySocial fa fa-twitter" data-type="twitter" data-description="<?php echo esc_attr( get_the_title() ); ?>" data-url="<?php echo esc_url( get_permalink() ); ?>"></span>
				<span class="prettySocial fa fa-pinterest" data-type="pinterest" data-description="<?php echo esc_attr( get_the_title() ); ?>" <?php if ( has_post_thumbnail() ): $domsxe = simplexml_load_string( get_the_post_thumbnail() ); ?> data-media="<?php echo esc_attr( $domsxe->attributes()->src ); ?>" <?php endif; ?> data-url="<?php echo esc_url( get_permalink() ); ?>"></span>
				<span class="prettySocial fa fa-google-plus" data-type="googleplus" data-url="<?php echo esc_url( get_permalink() ); ?>"></span>
			</p>
			<!-- End Social Share -->
		</div>

		<!-- Comments -->
		<div class="comments">
			<?php comments_template( '', true ); ?>
		</div>
		<!-- End Comments -->
	<?php
	endwhile;
}

add_action( 'compass_content', 'compass_single_page' );

do_action( 'compass_template' );