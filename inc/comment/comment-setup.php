<?php
/**
 * Comment setup theme.
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'aesthetix_comment_setup_theme' ) ) {

	/**
	 * Default comment setup on after_setup_theme hook.
	 *
	 * @return void
	 */
	function aesthetix_comment_setup_theme() {

		// Remove wrappers for comment content.
		remove_filter( 'comment_text', 'wpautop', 30 );

		// Update comment confirm by hash link.
		if ( isset( $_COOKIE['comment_author_email_' . COOKIEHASH], $_GET['comment_confirm'] ) && $_GET['comment_confirm'] === wp_hash( $_COOKIE['comment_author_email_' . COOKIEHASH] ) ) {

			$args = array(
				'author_email' => $_COOKIE['comment_author_email_' . COOKIEHASH],
				'meta_query'   => array(
					'relation' => 'OR',
					array(
						'key'     => 'confirm',
						'value'   => '0',
						'compare' => '=',
					),
					array(
						'key'     => 'confirm',
						'compare' => 'NOT EXISTS',
					),
				),
			);

			$comments = get_comments( $args );

			if ( count( $comments ) > 0 ) {

				$post = get_post( $comment->comment_post_ID );

				foreach ( $comments as $key => $comment ) {
					update_comment_meta( $comment->comment_ID, 'confirm', 1 );

					// Sending letters to authors of parent comments.
					if ( (int) $comment->comment_parent !== 0 ) {
						$parent_comment = get_comment( $comment->comment_parent );

						if ( $post && $comment->comment_author_email !== $parent_comment->comment_author_email ) {
							$message = '<p>' . sprintf( __( 'Someone replied to your comment on the post %s', 'aesthetix' ), '<a href="' . esc_url( get_comment_link( $parent_comment->comment_ID ) ). '" target="_blank">' . esc_html( $post->post_title ). '</a>' ) . ':</p>';
							$result  = aesthetix_wp_mail( $message, $parent_comment->comment_author_email );

							// If an error occurs, send a message to the admin with the text of the error.
							if ( $result !== true ) {
								aesthetix_wp_mail( __( 'An error occurred when sending an email to confirm a comment to the user', 'aesthetix' ) . ': ' . $parent_comment->comment_author_email );
							}
						}
					}
				}
			}
		}
	}
}
add_action( 'after_setup_theme', 'aesthetix_comment_setup_theme' );
