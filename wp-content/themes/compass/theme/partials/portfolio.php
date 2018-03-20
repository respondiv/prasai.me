<?php

/**
 * @package     The Compass
 * @author      Sonny T. <hi@sonnyt.com>
 */
?>

<?php if ( ! empty( $items ) ): ?>
	<div class="portfolio">
		<ul class="portfolio-items">
			<?php foreach ( $items as $item ): $full = ( $item['type'] == 'image' || empty( $item['type'] ) ) ? $item['full'] : $item['video']; ?>
		    <li>
		        <p>
		            <a href="<?php echo esc_url( $full ); ?>" class="swipebox-item" rel="<?php echo esc_attr( $id ); ?>" title="<?php echo esc_attr( $item['title'] ); ?>">
		                <img src="<?php echo esc_url( $item['thumbnail'] ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>" />
		            </a>

		            <h3><?php echo $item['title']; ?></h3>
		        </p>
		    </li>
		    <?php endforeach; ?>
		</ul>
	</div>
<?php endif; ?>