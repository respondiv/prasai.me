<?php

/**
 * @package     The Compass
 * @author      Sonny T. <hi@sonnyt.com>
 */

class Compass_Resume {

    public function __construct()
    {
    	add_action( 'admin_menu', array( &$this, 'admin_menu' ) );
        add_action( 'admin_init', array( &$this, 'register_settings' ) );
        add_action( 'admin_enqueue_scripts', array( &$this, 'scripts') );
    }

    public function admin_menu()
    {
        add_menu_page( 'Resume', 'Resume', 'edit_posts', 'resume', array( &$this, 'admin_settings_page' ), '', 30 );
    }

    public function register_settings()
    {
        register_setting( 'compass_resume', 'compass_resume', array( &$this, 'save' ) );
    }

    public function scripts( $hook )
    {
        if ( $hook === 'toplevel_page_resume' ) {
            wp_enqueue_media();
            wp_enqueue_script( 'jquery-ui-core' );

            wp_enqueue_style( 'compass_resume_style', THECOMPASS_ADMIN_URI . '/resume/css/compass_resume.css', false, '1.0', 'all' );
            wp_enqueue_script( 'compass_resume_scripts', THECOMPASS_ADMIN_URI . '/resume/js/compass_resume.js' , array( 'jquery' ) );
        }
    }

    public function save( $customize )
    {
        return $customize;
    }

    public function admin_settings_page()
    {
        ?>
            <div class="wrap">
                <div id="icon-options-general" class="icon32"><br></div>
                <h2><?php _e( 'The Compass Resume', 'compass' ); ?></h2>
                <p class="desciption">Create a page and use <code>[resume]</code> shortcode to embed this resume.</p>
                <form method="post" action="options.php">
                    <?php
                        settings_fields( 'compass_resume' );
                        $options = get_option( 'compass_resume' );
                    ?>

                    <div class="metabox-holder">
                        <?php if ( ! empty( $options ) ): foreach( $options as $key => $option ): ?>
                            <div class="postbox" data-id="<?php echo esc_attr( $key ); ?>">
                                <div class="inside">
                                    <div class="section_details">
                                        <a href="#" class="button remove_section" href="#">&times;</a>
                                        <a href="#" class="button drag_section" href="#">&#9776;</a>
                                    </div>
                                    <table class="form-table">
                                        <tr>
                                            <th><label for="title"><?php _e( 'Section Title', 'compass' ); ?></label></th>
                                            <td><input type="text" id="title" name="compass_resume[<?php echo esc_attr( $key ); ?>][title]" value="<?php echo isset( $option['title'] ) ? esc_attr( $option['title'] ) : ''; ?>" class="regular-text" /></td>
                                        </tr>
                                        <tr>
                                            <th><label for="icon"><?php _e( 'Section Title Icon', 'compass' ); ?></label></th>
                                            <td><input type="text" id="icon" name="compass_resume[<?php echo esc_attr( $key ); ?>][icon]" value="<?php echo isset( $option['icon'] ) ? esc_attr( $option['icon'] ) : ''; ?>" class="medium-text" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <ul class="compass_resume_items">
                                                    <?php if ( ! empty( $option['experience'] ) ): foreach( $option['experience'] as $i => $experience ): ?>
                                                        <li data-id="<?php echo esc_attr( $i ); ?>">
                                                        <?php if ( $experience['type'] == 'experience' ): ?>
                                                            <input type="hidden" name="compass_resume[<?php echo esc_attr( $key ); ?>][experience][<?php echo esc_attr( $i ); ?>][type]" value="experience" />
                                                            <div class="experience_details">
                                                                <a href="#" class="button remove_experience" href="#">&times;</a>
                                                                <a href="#" class="button drag_experience" href="#">&#9776;</a>
                                                            </div>
                                                            <table class="form-table">
                                                                <tr>
                                                                    <th><label for="title"><?php _e( 'Title', 'compass' ); ?></label></th>
                                                                    <td>
                                                                        <input type="text" id="title" class="regular-text" name="compass_resume[<?php echo esc_attr( $key ); ?>][experience][<?php echo esc_attr( $i ); ?>][title]" value="<?php echo isset( $experience['title'] ) ? esc_attr( $experience['title'] ) : ''; ?>" />
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th></th>
                                                                    <td>
                                                                        <label for="from"><?php _e( 'From: ', 'compass' ); ?></label>
                                                                        <input type="text" id="from" name="compass_resume[<?php echo esc_attr( $key ); ?>][experience][<?php echo esc_attr( $i ); ?>][from]" value="<?php echo isset( $experience['from'] ) ? esc_attr( $experience['from'] ) : ''; ?>" />

                                                                        <label for="to"><?php _e( 'To: ', 'compass' ); ?></label>
                                                                        <input type="text" id="to" name="compass_resume[<?php echo esc_attr( $key ); ?>][experience][<?php echo esc_attr( $i ); ?>][to]" value="<?php echo isset( $experience['to'] ) ? esc_attr( $experience['to'] ) : ''; ?>" />
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th><label for="main_content"><?php _e( 'Main Content', 'compass' ); ?></label></th>
                                                                    <td>
                                                                        <?php
                                                                            $settings = array(
                                                                                'teeny' => true,
                                                                                'textarea_rows' => 5,
                                                                                'tabindex' => 1
                                                                            );

                                                                            wp_editor( $experience['content'], 'compass_resume[' . $key . '][experience][' . $i . '][content]', $settings );
                                                                        ?>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        <?php elseif ( $experience['type'] == 'scale' ): ?>
                                                            <input type="hidden" name="compass_resume[<?php echo esc_attr( $key ); ?>][experience][<?php echo esc_attr( $i ); ?>][type]" value="scale" />
                                                            <div class="experience_details">
                                                                <a href="#" class="button remove_experience" href="#">&times;</a>
                                                                <a href="#" class="button drag_experience" href="#">&#9776;</a>
                                                            </div>
                                                            <table class="form-table">
                                                                <tr>
                                                                    <th><label for="title"><?php _e( 'Title', 'compass' ); ?></label></th>
                                                                    <td>
                                                                        <input type="text" class="regular-text" id="title" name="compass_resume[<?php echo esc_attr( $key ); ?>][experience][<?php echo esc_attr( $i ); ?>][title]" value="<?php echo isset( $experience['title'] ) ? esc_attr( $experience['title'] ) : ''; ?>" />
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th><label for="percentage"><?php _e( 'Percentage', 'compass' ); ?></label></th>
                                                                    <td>
                                                                        <input type="number" min="0" max="100" id="percentage" class="small-text" name="compass_resume[<?php echo esc_attr( $key ); ?>][experience][<?php echo esc_attr( $i ); ?>][percentage]" value="<?php echo isset( $experience['percentage'] ) ? esc_attr( $experience['percentage'] ) : ''; ?>" />
                                                                    </td>
                                                                </tr>
                                                            </table>   
                                                        <?php endif; ?>
                                                        </li>
                                                    <?php endforeach; endif; ?>
                                                </ul>
                                                <a href="#" class="add_experience button"><?php _e( '+ Add Experience', 'compass' ); ?></a>
                                                <a href="#" class="add_scale button"><?php _e( '+ Add Scale', 'compass' ); ?></a>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        <?php endforeach; endif; ?>
                    </div>

                    <a href="#" class="add_section button"><?php _e( '+ Add Section', 'compass' ); ?></a>

                    <?php submit_button(); ?>
                </form>
            </div>

            <script type="text/html" id="tmpl-section">
                <div class="postbox" data-id="{{key}}">
                    <div class="inside">
                        <div class="section_details">
                            <a href="#" class="button remove_section" href="#">&times;</a>
                            <a href="#" class="button drag_section" href="#">&#9776;</a>
                        </div>
                        <table class="form-table">
                            <tr>
                                <th><label for="title"><?php _e( 'Section Title', 'compass' ); ?></label></th>
                                <td><input type="text" id="title" name="compass_resume[{{key}}][title]" value="" class="regular-text" /></td>
                            </tr>
                            <tr>
                                <th><label for="icon"><?php _e( 'Section Title Icon', 'compass' ); ?></label></th>
                                <td><input type="text" id="icon" name="compass_resume[{{key}}][icon]" value="" class="medium-text" /></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <ul class="compass_resume_items"></ul>
                                    <a href="#" class="add_experience button"><?php _e( '+ Add Experience', 'compass' ); ?></a>
                                    <a href="#" class="add_scale button"><?php _e( '+ Add Scale', 'compass' ); ?></a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </script>

            <script type="text/html" id="tmpl-experience">
                <li data-id="{{i}}">
                    <input type="hidden" name="compass_resume[{{key}}][experience][{{i}}][type]" value="experience" />
                    <div class="experience_details">
                        <a href="#" class="button remove_experience" href="#">&times;</a>
                        <a href="#" class="button drag_experience" href="#">&#9776;</a>
                    </div>
                    <table class="form-table">
                        <tr>
                            <th><label for="title"><?php _e( 'Title', 'compass' ); ?></label></th>
                            <td>
                                <input type="text" class="regular-text" id="title" name="compass_resume[{{key}}][experience][{{i}}][title]" value="" />
                            </td>
                        </tr>
                        <tr>
                            <th></th>
                            <td>
                                <label for="from"><?php _e( 'From: ', 'compass' ); ?></label>
                                <input type="text" id="from" name="compass_resume[{{key}}][experience][{{i}}][from]" value="" />

                                <label for="to"><?php _e( 'To: ', 'compass' ); ?></label>
                                <input type="text" id="to" name="compass_resume[{{key}}][experience][{{i}}][to]" value="" />
                            </td>
                        </tr>
                        <tr>
                            <th><label for="main_content"><?php _e( 'Main Content', 'compass' ); ?></label></th>
                            <td>
                                <?php
                                    $settings = array(
                                        'teeny' => true,
                                        'textarea_rows' => 5,
                                        'tabindex' => 1
                                    );

                                    wp_editor( $options['content'], 'compass_resume[{{key}}][experience][{{i}}][content]', $settings );
                                ?>
                            </td>
                        </tr>
                    </table>   
                </li>
            </script>

            <script type="text/html" id="tmpl-scale">
                <li data-id="{{i}}">
                    <input type="hidden" name="compass_resume[{{key}}][experience][{{i}}][type]" value="scale" />
                    <div class="experience_details">
                        <a href="#" class="button remove_experience" href="#">&times;</a>
                        <a href="#" class="button drag_experience" href="#">&#9776;</a>
                    </div>
                    <table class="form-table">
                        <tr>
                            <th><label for="title"><?php _e( 'Title', 'compass' ); ?></label></th>
                            <td>
                                <input type="text" class="regular-text" id="title" name="compass_resume[{{key}}][experience][{{i}}][title]" value="" />
                            </td>
                        </tr>
                        <tr>
                            <th><label for="percentage"><?php _e( 'Percentage', 'compass' ); ?></label></th>
                            <td>
                                <input type="number" id="percentage" class="small-text" min="0" max="100" name="compass_resume[{{key}}][experience][{{i}}][percentage]" value="" />
                            </td>
                        </tr>
                    </table>   
                </li>
            </script>
        <?php
    }
}

new Compass_Resume();