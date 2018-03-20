<?php

/**
 * @package     The Compass
 * @author      Sonny T. <hi@sonnyt.com>
 */

if ( post_password_required() ) return;

function compass_comment($comment, $args, $depth)
{
    ?>
        <!-- Comment -->
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
            <div class="comment-title clearfix">
                <!-- Avatar -->
                <?php echo get_avatar( $comment, $size = '45' ); ?>
                <!-- End Avatar -->
                
                <!-- Author -->
                <?php printf( __( '<cite class="fn">%s</cite>', 'compass' ), get_comment_author_link() ); ?> <br />
                <!-- End Author -->

                <!-- Date -->
                <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>"><?php printf( __( '%1$s', 'compass' ), get_comment_date() ); ?></a>
                <!-- End Date -->

                <!-- Reply -->
                <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                <!-- End Reply -->
            </div>
            <!-- Body -->
            <div class="comment-body format">
                <?php comment_text(); ?>
            </div>
            <!-- End Body -->
        </li>
        <!-- End Comment -->
    <?php
}

?>

<?php if ( have_comments() ) : ?>
    <!-- Title -->
    <h3 class="comments-title title">
        <?php
            printf( __( 'One thought on "%2$s"', '%1$s thoughts on "%2$s"',  get_comments_number(), 'compass' ), number_format_i18n( get_comments_number() ), get_the_title() );
        ?>
    </h3>
    <!-- End Title -->

    <ol class="comment-list">
        <?php
            wp_list_comments( array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 34,
                'callback'    => 'compass_comment'
            ) );
        ?>
    </ol>
    <!-- Comment Pagination -->
    <div class="pagination clearfix">
        <div class="nav-previous alignleft"><?php next_comments_link( '<i class="fa fa-angle-left"></i> ' . __( 'Older', 'compass' ) ); ?></div>
        <div class="nav-next alignright"><?php previous_comments_link( __( 'Newer', 'compass' ) . ' <i class="fa fa-angle-right"></i>' ); ?></div>
    </div>
    <!-- Comment Pagination -->
<?php endif; ?>

<!-- Comment Form -->
<?php if ( comments_open() ): ?>
    <div class="commentsform">
        <!-- Title -->
        <h3 class="title"><?php _e( 'Leave a Reply', 'compass' ); ?></h3>
        <!-- End Title -->
        <p><?php _e( 'Your email address will not be published. Required fields are marked', 'compass' ); ?> <span class="required">*</span></p>
        <?php

        $comments_args = array( 
            'fields' => apply_filters( 'comment_form_default_fields', 
                array(
                    'author' => '<p>
                                    <label for="author">'. __( 'Name', 'compass' ) .( $req ? '<span class="required"> *</span>' : '' ) . '</label>
                                    <input type="text" name="author"  id="author" value="'.$comment_author.'" size="22" tabindex="1" '. ( $req ? 'aria-required="true" required' : '' ).'/>
                                </p>',
                    'email'  => '<p>
                                    <label for="email">'. __( 'Email', 'compass' ) .( $req ? '<span class="required"> *</span>' : '' ) . '</label>
                                    <input type="email" name="email"  id="email" value="'.$comment_author_email.'" size="22" tabindex="2" '. ( $req ? 'aria-required="true" required' : '' ).'/>
                                </p>',
                    'url'    => '<p>
                                    <label for="url">'. __( 'Website', 'compass' ) .'</label>
                                    <input type="text" name="url" id="url" value="'. $comment_author_url .'" size="44" tabindex="3" />
                                </p>',
                )
            ), 
            'comment_field' => '<p>
                                    <label for="comment">'. __( 'Comment', 'compass' ) .'<span class="required"> *</span></label>'.
                                    '<textarea name="comment" id="comment" cols="58" rows="8" tabindex="4" '. ( $req ? 'aria-required="true" required' : '' ) .'></textarea>
                                </p>',
            'must_log_in' => '',
            'logged_in_as' => '<p>'. __( 'Logged in as', 'compass' ) . ' <a href="'. get_option( 'siteurl' ) .'/wp-admin/profile.php">'. $user_identity .'</a>. <a href="'. get_option( 'siteurl' ) .'/wp-login.php?action=logout" title="' . __( 'Log out of this account', 'compass' ) . ' ">' . __( 'Logout.', 'compass' ) . ' &raquo;</a></p>',
            'id_form' => 'commentsubmit',
            'comment_notes_before' => '',
            'comment_notes_after' => '',
            'id_submit' => 'submit',
            'title_reply'          => '',
            'title_reply_to'       => '',
            'cancel_reply_link'    => __( 'Cancel reply', 'compass' ),
            'label_submit'         => __( 'Post Comment', 'compass' )
        );

        comment_form($comments_args);

        ?>
    </div>
<?php endif; ?>