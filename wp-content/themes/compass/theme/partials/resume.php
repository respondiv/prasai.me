<?php

/**
 * @package     The Compass
 * @author      Sonny T. <hi@sonnyt.com>
 */
?>

<?php if ( ! empty( $options ) ): ?>
	<div class="resume">
		<?php foreach( $options as $key => $option ): ?>
			<h2><p><i class="fa <?php echo isset( $option['icon'] ) ? esc_attr( $option['icon'] ) : ''; ?>"></i> <?php echo isset( $option['title'] ) ? $option['title'] : ''; ?></p></h2>
		    
		    <?php if ( ! empty( $option['experience'] ) ): ?>
		    <ul>
		    
		    	<?php foreach( $option['experience'] as $i => $experience ): ?>
			        <li>
			            <div class="detail">
			            	<?php echo empty ( $experience['title'] ) ? '' : '<strong>' . esc_attr( $experience['title'] ) . '</strong> <br/>'; ?>
			            	<?php if ( $experience['type'] == 'experience' ): ?>
				                <span>
				                	<?php echo isset( $experience['from'] ) ? esc_attr( $experience['from'] ) : ''; ?>
				                	
				                	<?php echo ( $experience['from'] && $experience['to'] ) ? ' - ' : ''; ?>

				                	<?php echo isset( $experience['to'] ) ? esc_attr( $experience['to'] ) : ''; ?>
				                </span>
				            <?php endif; ?>
			            </div>
			            <div class="info">
			            	<?php if ( $experience['type'] == 'experience' ): ?>
				            	<?php echo isset( $experience['content'] ) ? apply_filters('the_content', $experience['content'] ) : ''; ?>
				            <?php elseif ( $experience['type'] == 'scale' ): ?>
				            	<div class="progress"><span style="width: <?php echo isset( $experience['percentage'] ) ? esc_attr( $experience['percentage'] ) . '%' : ''; ?>;"></span></div>
				            <?php endif; ?>
			            </div>
			        </li>
			    <?php endforeach; ?>

		    </ul>
		    <?php endif; ?>

		<?php endforeach; ?>
	</div>
<?php endif; ?>