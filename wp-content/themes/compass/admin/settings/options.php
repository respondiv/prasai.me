<?php

/**
 * @package     The Compass
 * @author      Sonny T. <hi@sonnyt.com>
 */

class Compass_Settings {
    public function __construct()
    {
    	add_action( 'admin_menu', array( &$this, 'admin_menu' ) );
        add_action( 'admin_init', array( &$this, 'register_settings' ) );
        add_action( 'admin_enqueue_scripts', array( &$this, 'scripts') );
    }

    public function admin_menu()
    {
        add_theme_page( 'The Compass Settings', 'The Compass', 'edit_posts', 'compass', array( &$this, 'admin_settings_page' ) );
    }

    public function register_settings()
    {
        register_setting( 'compass_settings', 'compass_settings' );
    }

    public function scripts( $hook )
    {
        if ( $hook === 'appearance_page_compass' ) {
            wp_enqueue_media();
            wp_enqueue_script( 'jquery-ui-core' );
            wp_enqueue_script( 'wp-color-picker' );
            wp_enqueue_style( 'wp-color-picker' );

            wp_enqueue_script( 'compass_settings_scripts', THECOMPASS_ADMIN_URI . '/settings/js/compass_settings.js' , array( 'jquery' ) );
        }
    }

    public function admin_settings_page()
    {
        ?>
            <div class="wrap">
                <div id="icon-options-general" class="icon32"><br></div>
                <h2><?php _e( 'The Compass Settings', 'compass' ); ?></h2>
                <form method="post" action="options.php">
                    <?php
                        settings_fields( 'compass_settings' );
                        $options = get_option( 'compass_settings' );
                    ?>

                    <h3><?php _e( 'General Settings', 'compass' ); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th><label for="color"><?php _e( 'Animation', 'compass' ); ?></label></th>
                            <td>
                                <select name="compass_settings[animation]">
                                    <option value="no-animation" <?php selected( $options['animation'], 'no-animation' ); ?>>None</option>
                                    <option value="circular-animation" <?php selected( $options['animation'], 'circular-animation' ); ?>>Circular</option>
                                    <option value="scaling-animation" <?php selected( $options['animation'], 'scaling-animation' ); ?>>Scaling</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th><label for="image"><?php _e( 'Main Image', 'compass' ); ?></label></th>
                            <td>
                                <input class="upload_image regular-text" type="text" id="image" name="compass_settings[image]" value="<?php echo isset( $options['image'] ) ? esc_attr( $options['image'] ) : ''; ?>" /> 
                                <input class="upload_image_button button" type="button" value="Upload Image" />
                                <p class="description"><?php _e( 'Please make sure that your image is at least 200px width and 200px height. Your avatar doesn\'t need to be circular, The Compass masks your image for you.' ); ?></p>                         
                            </td>
                        </tr>
                    </table>

                    <h3><?php _e( 'Schema Color Settings', 'compass' ); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th><label for="color"><?php _e( 'Colors Scheme', 'compass' ); ?></label></th>
                            <td>
                                <table style="text-align: center; line-height: 0;">
                                    <tr>
                                        <td><img src="<?php echo THECOMPASS_ADMIN_URI; ?>/settings/images/cool.jpg" /></td>
                                        <td><img src="<?php echo THECOMPASS_ADMIN_URI; ?>/settings/images/dark.jpg" /></td>
                                        <td><img src="<?php echo THECOMPASS_ADMIN_URI; ?>/settings/images/flat.jpg" /></td>
                                        <td><img src="<?php echo THECOMPASS_ADMIN_URI; ?>/settings/images/custom.jpg" /></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="description"><?php _e( 'Cool', 'compass'); ?></p>
                                            <p><input type="radio" name="compass_settings[color][type]" class="schemaPicker" <?php checked( $options['color']['type'], 'cool-color' ); ?> value="cool-color" /></p>
                                        </td>
                                        <td>
                                            <p class="description"><?php _e( 'Dark', 'compass'); ?></p>
                                            <p><input type="radio" name="compass_settings[color][type]" class="schemaPicker" <?php checked( $options['color']['type'], 'dark-color' ); ?> value="dark-color" /></p>
                                        </td>
                                        <td>
                                            <p class="description"><?php _e( 'Flat', 'compass'); ?></p>
                                            <p><input type="radio" name="compass_settings[color][type]" class="schemaPicker" <?php checked( $options['color']['type'], 'flat-color' ); ?> value="flat-color" /></p>
                                        </td>
                                        <td>
                                            <p class="description"><?php _e( 'Custom', 'compass'); ?></p>
                                            <p><input type="radio" name="compass_settings[color][type]" class="schemaPicker" <?php checked( $options['color']['type'], 'custom-color' ); ?> value="custom-color" /></p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>

                    <table class="form-table" <?php if ( $options['color']['type'] != 'custom-color' ): ?>style="display: none;"<?php endif; ?> id="custom_color">
                        <tr>
                            <th><?php _e( 'Primary Color', 'compass' ); ?></th>
                            <td><input name="compass_settings[color][custom][primary]" type="text" class="colorPicker" value="<?php echo isset( $options['color']['custom']['primary'] ) ? esc_attr( $options['color']['custom']['primary'] ) : ''; ?>" /></td>
                        </tr>
                        <tr>
                            <th><?php _e( 'Secondary Color', 'compass' ); ?></th>
                            <td><input name="compass_settings[color][custom][secondary]" type="text" class="colorPicker" value="<?php echo isset( $options['color']['custom']['secondary'] ) ? esc_attr( $options['color']['custom']['secondary'] ) : ''; ?>" /></td>
                        </tr>
                        <tr>
                            <th><?php _e( 'Trigger Font Color', 'compass' ); ?></th>
                            <td><input name="compass_settings[color][custom][triggerColor]" type="text" class="colorPicker" value="<?php echo isset( $options['color']['custom']['triggerColor'] ) ? esc_attr( $options['color']['custom']['triggerColor'] ) : ''; ?>" /></td>
                        </tr>
                        <tr>
                            <th><?php _e( 'Accent Color', 'compass' ); ?></th>
                            <td><input name="compass_settings[color][custom][accent]" type="text" class="colorPicker" value="<?php echo isset( $options['color']['custom']['accent'] ) ? esc_attr( $options['color']['custom']['accent'] ) : ''; ?>" /></td>
                        </tr>
                        <tr>
                            <th><?php _e( 'Shadow Color', 'compass' ); ?></th>
                            <td><input name="compass_settings[color][custom][shadow]" type="text" class="colorPicker" value="<?php echo isset( $options['color']['custom']['shadow'] ) ? esc_attr( $options['color']['custom']['shadow'] ) : ''; ?>" /></td>
                        </tr>
                        <tr>
                            <th><?php _e( 'Input Color', 'compass' ); ?></th>
                            <td><input name="compass_settings[color][custom][input]" type="text" class="colorPicker" value="<?php echo isset( $options['color']['custom']['input'] ) ? esc_attr( $options['color']['custom']['input'] ) : ''; ?>" /></td>
                        </tr>
                        <tr>
                            <th><?php _e( 'Loader Image', 'compass' ); ?></th>
                            <td>
                                <input class="upload_image regular-text" type="text" id="image" name="compass_settings[color][custom][loader]" value="<?php echo isset( $options['color']['custom']['loader'] ) ? esc_attr( $options['color']['custom']['loader'] ) : ''; ?>" /> 
                                <input class="upload_image_button button" type="button" value="Upload Image" />
                                <p class="description"><?php __( 'You can get one from <a href="http://www.ajaxload.info/" target="_blank">ajaxload.info</a>' ); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th><strong><?php _e( 'Body', 'compass' ); ?></strong></th>
                        </tr>
                        <tr>
                            <th><?php _e( 'Background Color', 'compass' ); ?></th>
                            <td><input name="compass_settings[color][custom][backgroundColor]" type="text" class="colorPicker" value="<?php echo isset( $options['color']['custom']['backgroundColor'] ) ? esc_attr( $options['color']['custom']['backgroundColor'] ) : ''; ?>" /></td>
                        </tr>
                        <tr>
                            <th><?php _e( 'Font Color', 'compass' ); ?></th>
                            <td><input name="compass_settings[color][custom][bodyFontColor]" type="text" class="colorPicker" value="<?php echo isset( $options['color']['custom']['bodyFontColor'] ) ? esc_attr( $options['color']['custom']['bodyFontColor'] ) : ''; ?>" /></td>
                        </tr>
                        <tr>
                            <th><strong><?php _e( 'Page', 'compass' ); ?></strong></th>
                        </tr>
                        <tr>
                            <th><?php _e( 'Background Color', 'compass' ); ?></th>
                            <td><input name="compass_settings[color][custom][pageBackgroundColor]" type="text" class="colorPicker" value="<?php echo isset( $options['color']['custom']['pageBackgroundColor'] ) ? esc_attr( $options['color']['custom']['pageBackgroundColor'] ) : ''; ?>" /></td>
                        </tr>
                        <tr>
                            <th><?php _e( 'Font Color', 'compass' ); ?></th>
                            <td><input name="compass_settings[color][custom][pageFontColor]" type="text" class="colorPicker" value="<?php echo isset( $options['color']['custom']['pageFontColor'] ) ? esc_attr( $options['color']['custom']['pageFontColor'] ) : ''; ?>" /></td>
                        </tr>
                    </table>

                    <table class="form-table">
                        <tr>
                            <th><label for="background_image"><?php _e( 'Background Image', 'compass' ); ?></label></th>
                            <td>
                                <input class="upload_image regular-text" type="text" id="background_image" name="compass_settings[background][image]" value="<?php echo isset( $options['background']['image'] ) ? esc_attr( $options['background']['image'] ) : ''; ?>" /> 
                                <input class="upload_image_button button" type="button" value="Upload Image" />
                            </td>
                        </tr>
                        <tr>
                            <th><label for="background_repeat"><?php _e( 'Background Image Repeat', 'compass' ); ?></label></th>
                            <td>
                                <select id="background_repeat" name="compass_settings[background][repeat]">
                                    <option value="repeat" <?php selected( $options['background']['repeat'], 'repeat' ); ?>>repeat</option>
                                    <option value="repeat-x" <?php selected( $options['background']['repeat'], 'repeat-x' ); ?>>repeat-x</option>
                                    <option value="repeat-y" <?php selected( $options['background']['repeat'], 'repeat-y' ); ?>>repeat-y</option>
                                    <option value="no-repeat" <?php selected( $options['background']['repeat'], 'no-repeat' ); ?>>no-repeat</option>
                                    <option value="inherit" <?php selected( $options['background']['repeat'], 'inherit' ); ?>>inherit</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th><label for="background_position"><?php _e( 'Background Image Position', 'compass' ); ?></label></th>
                            <td>
                                <input type="text" id="background_position" name="compass_settings[background][position]" value="<?php echo isset( $options['background']['position'] ) ? esc_attr( $options['background']['position'] ) : ''; ?>">
                                <p class="description">It can either be; "left top", "x% y%" or "xpos ypos".</p>
                            </td>
                        </tr>
                    </table>

                    <?php submit_button(); ?>
                </form>
            </div>
        <?php
    }
}

new Compass_Settings();