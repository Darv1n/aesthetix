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

		if ( isset( $_COOKIE['comment_author_email_' . COOKIEHASH] ) ) {
			
			// Update comment confirm by hash link.
			if ( isset( $_GET['comment_confirm'], $_GET['comment_id'] ) && $_GET['comment_confirm'] === wp_hash( $_COOKIE['comment_author_email_' . COOKIEHASH] ) ) {
				
				$comment = get_comment( (int) $_GET['comment_id'] );

				if ( ! is_null( $comment ) ) {
					$update = update_comment_meta( $comment->comment_ID, 'confirm', 1 );

					// Sending letter to author of parent comment.
					if ( $update !== false && (int) $comment->comment_parent !== 0 ) {
						$parent_comment = get_comment( $comment->comment_parent );

						$message = '<p>' . sprintf( __( 'Someone replied to your comment on the post %s', 'aesthetix' ), '<a href="' . esc_url( get_comment_link( $parent_comment->comment_ID ) ) . '" target="_blank">' . esc_html( $parent_comment->comment_ID ). '</a>' ) . ':</p>';
						$result  = aesthetix_wp_mail( $message, $parent_comment->comment_author_email );

						// If an error occurs, send a message to the admin with the text of the error.
						if ( $result !== true ) {
							aesthetix_wp_mail( __( 'There was an error sending an email to the parent comment author.', 'aesthetix' ) . ': ' . $parent_comment->comment_author_email );
						}
					}

					remove_action( 'pre_get_comments', 'aesthetix_pre_get_comments' );

					// Just in case, record all unconfirmed comments in the option.
					$args = array(
						'fields'     => 'ids',
						'meta_query' => array(
							'relation' => 'AND',
							array(
								'key'     => 'confirm',
								'value'   => '0',
								'compare' => '=',
							),
						),
					);

					$comments_ids = get_comments( $args );

					add_action( 'pre_get_comments', 'aesthetix_pre_get_comments' );

					update_option( 'nonconfirmed_comments', $comments_ids );
				}
			}

			// Delete comment by hash link.
			if ( isset( $_GET['comment_delete'], $_GET['comment_id'] ) && $_GET['comment_delete'] === wp_hash( $_COOKIE['comment_author_email_' . COOKIEHASH] ) ) {
				$update = wp_trash_comment( (int) $_GET['comment_id'] );

				if ( $update === false ) {
					$message = '<p>' . sprintf( __( 'There was an error while deleting a comment %s', 'aesthetix' ), '<a href="' . esc_url( get_comment_link( (int) $_GET['comment_id'] ) ) . '" target="_blank">' . esc_html( (int) $_GET['comment_id'] ). '</a>' ) . ':</p>';
					aesthetix_wp_mail( $message );
				}
			}
		}
	}
}
add_action( 'after_setup_theme', 'aesthetix_comment_setup_theme' );
