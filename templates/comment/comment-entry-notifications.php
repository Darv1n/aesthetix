<?php
/**
 * Template part for displaying comment entry notifications.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */
 ?>

<div class="comment-notifications">

	<?php if ( isset( $_COOKIE['comment_author_email_' . COOKIEHASH] ) && $_COOKIE['comment_author_email_' . COOKIEHASH] === $args['comment']->comment_author_email ) { ?>
		<?php if ( $args['comment']->comment_approved === '0' ) { ?>
			<div class="notification notification_warning">
				<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation', 'aesthetix' ); ?></p>
			</div>
		<?php } ?>
		<?php if ( get_comment_meta( $args['comment']->comment_ID, 'confirm', true ) === '0' ) { ?>
			<div class="notification notification_warning">
				<p class="comment-awaiting-confirmation">
					<?php echo sprintf( __( 'You need to confirm your comment, an email has been sent to your email %s. If the email did not arrive, check your Spam folder or <a class="%s" href="%s" data-comment-id="%s">resend</a>', 'aesthetix' ), $args['comment']->comment_author_email, esc_attr( implode( ' ', get_link_classes( 'comment-confirmation-resend' ) ) ), esc_url( get_comment_link( $args['comment'] ) ), $args['comment']->comment_ID ); ?>
				</p>
			</div>
		<?php } ?>
	<?php } elseif ( is_user_logged_in() && current_user_can( 'moderate_comments' ) ) { 

		$userdata = get_userdata( get_current_user_id() ); ?>

		<?php if ( $args['comment']->comment_approved === '0' ) { ?>
			<div class="notification notification_warning">
				<p class="comment-awaiting-moderation"><?php esc_html_e( 'This comment is awaiting moderation', 'aesthetix' ); ?></p>
			</div>
		<?php } ?>
		<?php if ( get_comment_meta( $args['comment']->comment_ID, 'confirm', true ) === '0' && $userdata->user_email !== $args['comment']->comment_author_email ) { ?>
			<div class="notification notification_warning">
				<p class="comment-awaiting-confirmation"><?php esc_html_e( 'This comment is not approved by the user', 'aesthetix' ); ?></p>
			</div>
		<?php } ?>
	<?php } ?>

</div>
