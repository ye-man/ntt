<?php
// comments_template()

if ( post_password_required() ) {
	return;
}

// title_reply
$title_reply_mu = '<div class="compose-comment-ename ename obj" data-name="Compose Comment Element Name">';
    $title_reply_mu .= '<span class="compose---text">';
        $title_reply_mu .= esc_html_x( 'Compose', 'Component: Comment Creation | Usage: >Compose< Comment', 'ntt' );
    $title_reply_mu .= '</span>';
    $title_reply_mu .= ' '. '<span class="comment---text">';
        $title_reply_mu .= esc_html_x( 'Comment', 'Component: Comment Creation | Usage: Compose >Comment<', 'ntt' );
    $title_reply_mu .= '</span>';
$title_reply_mu .= '</div>';

// title_reply_to
$title_reply_to_mu = '<div class="comment-reply-ename ename obj" data-name="Comment Reply Element Name">';
    $title_reply_to_mu .= '<span class="reply-to---text">'. esc_html__( 'Reply to', 'ntt' ). '</span>';
    $title_reply_to_mu .= ' '. '%s';
$title_reply_to_mu .= '</div>';

// logged_in_as
$log_out_title_attr = esc_attr__( 'Log Out', 'ntt' );
$log_out_l = esc_html__( 'Log Out', 'ntt' );

$logged_in_as_mu = '<div class="admin-account-log-status cp" data-name="Admin Account Log Status">';
    $logged_in_as_mu .= '<div class="admin-account-log-status---cr">';
        $logged_in_as_mu .= '<div class="logged-in-admin-account cp" data-name="Logged In Admin Account">';
            $logged_in_as_mu .= '<div class="logged-in-admin-account---cr">';
                $logged_in_as_mu .= '<span class="logged-in-admin-account---glabel glabel obj" data-name="Logged In Admin Account Generic Label">';
                    $logged_in_as_mu .= '<span class="logged-in-admin-account---txt">'. esc_html_x( 'Logged in as', 'Component: Comment Admin Account | Usage: The admin name who is logged in.', 'ntt' ). '</span>';
                $logged_in_as_mu .= '</span>';
                $logged_in_as_mu .= ' '. '<span class="logged-in-admin-account-name name obj" data-name="Logged In Admin Account Name">';
                    $logged_in_as_mu .= '<a href="'. admin_url( 'profile.php' ).'" title="'. $user_identity.'" class="logged-in-admin-account-name---a">';
                        $logged_in_as_mu .= '<span class="logged-in-admin-account-name---txt">'. $user_identity.'</span>';
                    $logged_in_as_mu .= '</a>';
                $logged_in_as_mu .= '</span>';
            $logged_in_as_mu .= '</div>';
        $logged_in_as_mu .= '</div>';
        $logged_in_as_mu .= '<div class="log-out-admin-account-axn log-out-axn axn obj" data-name="Log Out Admin Account Action"><a href="'. esc_url( wp_logout_url( get_permalink() ) ).'" title="'. $log_out_title_attr.'" class="log-out-admin-account-axn---a"><span class="log-out-admin-account-axn---l"><span class="log-out-admin-account-axn---txt">'. $log_out_l.'</span></span></a></div>';
    $logged_in_as_mu .= '</div>';
$logged_in_as_mu .= '</div>';

// must_log_in
$must_log_in_mu = '<div class="log-in-required-note note cp" data-name="Log In Required Note">';
    $must_log_in_mu .= '<div class="log-in-required-note---cr note---cr">';
        $must_log_in_mu .= '<p><a href="'. esc_url( wp_login_url( get_permalink() ) ). '" title="'. esc_attr__( 'Log In', 'ntt' ).'" class="log-in-link">'. esc_html_x( 'Log In', 'Object: Log In Required Note | Usage: >Log In< to comment.', 'ntt' ). '</a> '. ' '. '<span class="to-comment-text">'. esc_html_x( 'to comment.', 'Object: Log In Required Note | Usage: Log In >to comment<.', 'ntt' ). '</span>'. '</p>';
    $must_log_in_mu .= '</div>';
$must_log_in_mu .= '</div>';

// comment_field
$comment_field_mu = '<div class="comment-message-field field cp" data-name="Comment Message Field">';
    $comment_field_mu .= '<div class="comment-message-field---cr field---cr ">';
    $comment_field_mu .= '<label for="comment" class="comment-message-field-label label obj" data-name="Comment Message Field Label">';
        $comment_field_mu .= '<span class="comment-message-field-label---l">';
            $comment_field_mu .= '<span class="comment-message-field-label---txt">'. esc_attr__( 'Comment', 'ntt' ). '</span>';
        $comment_field_mu .= '</span>';
    $comment_field_mu .= '</label>';
        $comment_field_mu .= '<div class="comment-message-field-textbox textbox felem obj" data-name="Comment Message Field Textbox">';
            $comment_field_mu .= '<textarea name="comment" placeholder="'. esc_html__( 'Comment', 'ntt' ).'" title="'. esc_html__( 'Comment', 'ntt' ).'" maxlength="65525" required id="comment" class="comment-message-field-input text-input textarea"></textarea>';
        $comment_field_mu .= '</div>';
    $comment_field_mu .= '</div>';
$comment_field_mu .= '</div>';

// cancel_reply_link
$cancel_reply_link_mu = '<span class="cancel-comment-reply-axn---l" title="'. esc_attr_x( 'Cancel Reply to Comment', 'Usage: Cancel Reply to Comment | Component: Comment Respond', 'ntt' ). '">';
$cancel_reply_link_mu .= '<span class="cancel-comment-reply-axn---txt">'. esc_html_x( 'Cancel', 'Usage: >Cancel< Reply to Comment | Component: Comment Respond', 'ntt' ). '</span>';
$cancel_reply_link_mu .= ' '. '<span class="reply-to-comment---text">'. esc_html_x( 'Reply to Comment', 'Usage: Cancel >Reply to Comment< | Component: Comment Respond', 'ntt' ). '</span>';
$cancel_reply_link_mu .= '</span>'; ?>

<section class="comment-md cm md" data-name="Comment Module">
    <div class="comment-md---cr cm---cr">

        <div id="comments" class="comments<?php ntt_comments_css_wp_hook(); ?> cm-plural cp" data-name="Comments">
            <div class="comments---cr cm-plural---cr">
                
                <div class="comments-header cm-plural-header header cn" data-name="Comments Header">
                    <div class="comments-header---cr cm-plural-header---cr">
                        <h2 class="comments-name name obj h" data-name="Comments Name">
                            <span class="comments-name---txt"><?php esc_html_e( 'Comments', 'ntt' ); ?></span>
                        </h2>
                        
                        <?php
                        ntt_comments_actions_snippet();
                        
                        if ( have_comments() ) {
                            ntt_comments_nav();
                        }
                        ?>
                    </div>
                </div>
                <div class="comments-main cm-plural-main main cn" data-name="Comments Main">
                    <div class="comments-main---cr cm-plural-main---cr">
                
                        <?php
                        if ( have_comments() ) {
                            ?>
                            <ul class="comments---group group list">
                                <?php
                                wp_list_comments( array(
                                    'style'         => 'ul',
                                    'avatar_size'   => 48,
                                    'callback'      => 'ntt_comment',
                                    'echo'          => true,
                                ) );
                                ?>
                            </ul>
                            <?php
                        } else {

                            if ( comments_open() ) {
                                $comments_content_esc = esc_html_x( 'Be the first to comment.', 'Component: Comments | Usage: User note if there are no comments.', 'ntt' );
                            } else {
                                $comments_content_esc = esc_html__( 'There are no comments.', 'ntt' );
                            }
                            ?>
                            <div class="empty-comments-note note cp" data-name="Empty Comments Note">
                                <div class="empty-comments-note---cr note---cr">
                                    <p><?php echo $comments_content_esc ?></p>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                
            </div>
        </div>
        
        <?php
        // comment-form.php
        comment_form( array(
            'id_form'                   => 'commentform',
            'class_form'                => 'comment-form form cp',
        
            'title_reply_before'        => '',
            'title_reply_after'         => '',
        
            // Comment Creation Name and Compose Comment Generic Label
            'title_reply'               => $title_reply_mu,
            
            // Reply to <Comment Author Name> | Appears only if JS is not supported or if comment-reply.js is not loaded; it replaces title_reply
            'title_reply_to'            =>  $title_reply_to_mu,
        
            // Cancel Reply Action
            'cancel_reply_before'       => '',
            'cancel_reply_after'        => '',
            'cancel_reply_link'         => $cancel_reply_link_mu,
        
            // Signed in as <Admin Account Name>
            'logged_in_as'              => $logged_in_as_mu, 
        
            // Settings > Discussion > [Check] Users must be registered and logged in to comment
            'must_log_in'               => $must_log_in_mu,
        
            // Comment Textarea
            'comment_field'             => $comment_field_mu,
        
            // Submit Comment Action
            'id_submit'                 => 'submit-comment-axn---a',
            'class_submit'              => 'submit-comment-axn---a',
            'label_submit'              => esc_attr_x( 'Submit', 'Component: Comment Respond | Usage: >Submit< Comment', 'ntt' ),
        
            // Notes
            'comment_notes_before'      => '',
            'comment_notes_after'       => '',
        ) );
        ?>
    </div>
</section>