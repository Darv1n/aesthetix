<?php
/**
 * Template part for displaying comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

if ( comments_open() ) {

	$post_id       = get_the_ID();
	$commenter     = wp_get_current_commenter();
	$user          = wp_get_current_user();
	$user_identity = $user->exists() ? $user->display_name : '';
	$req           = get_option( 'require_name_email' );
	$html5         = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';

	// Define attributes in HTML5 or XHTML syntax.
	$required_attribute = ( $html5 ? ' required' : ' required="required"' );
	$checked_attribute  = ( $html5 ? ' checked' : ' checked="checked"' );

	// Identify required fields visually and create a message about the indicator.
	$required_indicator = ' ' . wp_required_field_indicator();
	$required_text      = ' ' . wp_required_field_message();

	$args = array(
		'class_form'           => 'row comment-form',
		'comment_notes_before' => sprintf(
			'<div class="col-12 order-1"><p class="comment-notes">%s%s</p></div>',
			sprintf(
				'<span id="email-notes">%s</span>',
				__( 'Your email address will not be published.' )
			),
			$required_text
		),
		'comment_notes_after'   => '',
		'fields'                => array(
			'author' => sprintf(
				'<div class="col-12 col-lg-4 order-4"><div class="comment-form-author">%s %s</div>',
				sprintf( '<label for="author">%s%s</label>', __( 'Name' ), ( $req ? $required_indicator : '' ) ),
				sprintf( '<input id="author" name="author" type="text" value="%s" size="30" maxlength="245" autocomplete="name"%s data-notification="' . __( 'Please enter your name', 'aesthetix' ) . '" />', esc_attr( $commenter['comment_author'] ), ( $req ? $required_attribute : '' ) )
			),
			'email'  => sprintf(
				'<div class="comment-form-email">%s %s</div>',
				sprintf( '<label for="email">%s%s</label>', __( 'Email' ) . ' <span class="label-description">(' . __( 'Will not be published', 'aesthetix' ) .  ')</span>', ( $req ? $required_indicator : '' ) ),
				sprintf( '<input id="email" name="email" %s value="%s" size="30" maxlength="100" aria-describedby="email-notes" autocomplete="email"%s data-notification="' . __( 'Please enter your email address', 'aesthetix' ) . '" />', ( $html5 ? 'type="email"' : 'type="text"' ), esc_attr( $commenter['comment_author_email'] ), ( $req ? $required_attribute : '' ) )
			),
			'url'    => sprintf( 
				'<div class="comment-form-url">%s %s</div></div>',
				sprintf( '<label for="url">%s</label>', __( 'Website' ) ),
				sprintf( '<input id="url" name="url" %s value="%s" size="30" maxlength="200" autocomplete="url" />', ( $html5 ? 'type="url"' : 'type="text"' ), esc_attr( $commenter['comment_author_url'] ) )
			),
		),
		'comment_field'         => sprintf(
			'<div class="col-12 col-lg-8 order-5"><div class="comment-form-comment">%s %s</div>',
			sprintf( '<label for="comment">%s%s</label>', _x( 'Comment', 'noun' ), $required_indicator ),
			'<textarea id="comment" name="comment" cols="45" rows="9" maxlength="65525"' . $required_attribute . ' data-notification="' . __( 'Please enter your comment', 'aesthetix' ) . '"></textarea></div>'
		),

		'must_log_in'          => sprintf(
			'<div class="col-12 order-3"><p class="must-log-in">%s</p></div>',
			sprintf(
				/* translators: %s: Login URL. */
				__( 'You must be <a href="%s" class="' . esc_attr( implode( ' ', get_link_classes() ) ) . '">logged in</a> to post a comment.' ),
				/** This filter is documented in wp-includes/link-template.php */
				wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ), $post_id ) )
			)
		),
		'logged_in_as'         => sprintf(
			'<div class="col-12 order-2"><p class="logged-in-as">%s%s</p></div>',
			sprintf(
				/* translators: 1: User name, 2: Edit user link, 3: Logout URL. */
				__( 'Logged in as %1$s. <a href="%2$s" class="' . esc_attr( implode( ' ', get_link_classes() ) ) . '">Edit your profile</a>. <a href="%3$s" class="' . esc_attr( implode( ' ', get_link_classes() ) ) . '">Log out?</a>' ),
				$user_identity,
				get_edit_user_link(),
				/** This filter is documented in wp-includes/link-template.php */
				wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ), $post_id ) )
			),
			$required_text
		),
		'comment_notes_before' => sprintf(
			'<div class="col-12 order-1"><p class="comment-notes">%s%s</p></div>',
			sprintf(
				'<span id="email-notes">%s</span>',
				__( 'Your email address will not be published.' )
			),
			$required_text
		),

		'class_submit'         => esc_attr( implode( ' ', get_button_classes( 'submit icon icon-envelope' ) ) ),
		'submit_button'        => '<button name="%1$s" type="submit" id="%2$s" class="%3$s" data-process-text="' . __( 'Sending...', 'aesthetix' ) . '" data-default-text="%4$s">%4$s</button>',
		'submit_field'         => '<div class="col-12 order-8"><div class="button-list button-list-inline">%1$s %2$s</div></div>',
	);

	if ( get_option( 'thread_comments' ) ) {
		$args['cancel_reply_before'] = '</h3><div class="cancel-comment-wrapper">';
		$args['cancel_reply_after']  = '</div>';
		$args['title_reply_after']   = '';
	}

	if ( has_action( 'set_comment_cookies', 'wp_set_comment_cookies' ) && get_option( 'show_comments_cookies_opt_in' ) ) {
		$consent = empty( $commenter['comment_author_email'] ) ? '' : $checked_attribute;

		$args['fields']['cookies'] = sprintf(
			'<div class="col-12 order-6"><div class="comment-form-cookies-consent">%s %s</div></div>',
			sprintf( '<input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes" checked%s />', $consent ),
			sprintf( '<label for="wp-comment-cookies-consent">%s</label>', __( 'Save my name, email, and website in this browser for the next time I comment.' ) )
		);
	}

	$args = apply_filters( 'aesthetix_comment_form_args', $args );

	comment_form( $args );

} else { ?>
	<div class="no-comments">
		<p><?php esc_html_e( 'Comments are closed', 'aesthetix' ); ?></p>
	</div>
<?php }