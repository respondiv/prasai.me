<?php

/**
 * @package     The Compass
 * @author      Sonny T. <hi@sonnyt.com>
 */
?>

<!-- Post List -->
<ul class="posts">
	<?php while ( have_posts() ) : the_post(); ?>
		<li id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>
			<div class="details">
				<!-- Date -->
				<div class="date">
					<span class="month"><?php echo get_the_date('M'); ?></span>
					<span class="day"><?php echo get_the_date('j'); ?></span>
				</div>
				<!-- End Date -->

				<?php if ( is_sticky() ): ?>
				<i class="fa fa-thumb-tack sticky"></i>
				<?php endif; ?>
			</div>

			<div class="exerpt <?php echo ( has_post_thumbnail() ) ? 'has_thumbnail' : ''; ?>">
				<!-- Title -->
				<h2 class="title"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
				<!-- End Title -->
				
				<!-- Excerpt -->
				<?php the_excerpt(); ?>
				<!-- End Excerpt -->
			</div>

			<!-- Thumbnail -->
			<?php if ( has_post_thumbnail() ): ?>
			<div class="thumbnail">
				<?php the_post_thumbnail(); ?>
			</div>
			<?php endif; ?>
			<!-- End Thumbnail -->
		</li>
	<?php endwhile; ?>
</ul>
<!-- End Post List -->

<!-- Pagination -->
<div class="pagination clearfix">
	<div class="nav-previous alignleft"><?php next_posts_link( '<i class="fa fa-angle-left"></i> ' . __( 'Older', 'compass' ) ); ?></div>
	<div class="nav-next alignright"><?php previous_posts_link( __( 'Newer', 'compass' ) . ' <i class="fa fa-angle-right"></i>' ); ?></div>
</div>
<!-- End Pagination -->