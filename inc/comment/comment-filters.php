<?php
/**
 * Comment filters.
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'aesthetix_comment_id_fields' ) ) {

	/**
	 * Function for 'comment_id_fields' filter-hook.
	 * 
	 * @param string $comment_id_fields The HTML-formatted hidden ID field comment elements.
	 * @param int    $post_id           The post ID.
	 * @param int    $reply_to_id       The ID of the comment being replied to.
	 *
	 * @return string
	 */
	function aesthetix_comment_id_fields( $comment_id_fields, $post_id, $reply_to_id ) {

		$comment = get_comment( $reply_to_id );

		if ( is_user_logged_in() ) {
			$comment_id_fields .= "<input type='hidden' name='comment_user_id' id='comment_user_id' value='" . get_current_user_id() . "' />\n";
		}

		if ( isset( $_COOKIE['comment_author_email_' . COOKIEHASH] ) && $_COOKIE['comment_author_email_' . COOKIEHASH] === $comment->comment_author_email ) {
			if ( get_comment_meta( $comment->comment_ID, 'confirm', true ) === '0' ) {
				$comment_id_fields .= "<input type='hidden' name='comment_id' id='comment_id' value='' />\n";
				$comment_id_fields .= "<input type='hidden' name='comment_hash' id='comment_hash' value='" . wp_hash( $comment->comment_author_email ) . "' />\n";
			}
		}

		$comment_id_fields .= "<input type='hidden' name='comment_action' id='comment_action' value='' />\n";

		return $comment_id_fields;
	}
}
add_filter( 'comment_id_fields', 'aesthetix_comment_id_fields', 10, 3 );

if ( ! function_exists( 'aesthetix_get_avatar_comment_types' ) ) {

	/**
	 * Function for 'get_avatar_comment_types' filter-hook.
	 * 
	 * @param array $types An array of content types.
	 *
	 * @return array
	 */
	function aesthetix_get_avatar_comment_types( $types ) {

		$types[] = 'deleted';

		return $types;
	}
}
add_filter( 'get_avatar_comment_types', 'aesthetix_get_avatar_comment_types' );

if ( ! function_exists( 'aesthetix_comment_reply_link' ) ) {

	/**
	 * Function for 'comment_reply_link' filter-hook.
	 * 
	 * @param string     $comment_reply_link The HTML markup for the comment reply link.
	 * @param array      $args               An array of arguments overriding the defaults.
	 * @param WP_Comment $comment            The object of the comment being replied.
	 * @param WP_Post    $post               The WP_Post object.
	 *
	 * @return string
	 */
	function aesthetix_comment_reply_link( $comment_reply_link, $args, $comment, $post ) {

		$comment_reply_link = str_replace( 'comment-reply-link', esc_attr( implode( ' ', get_link_classes( 'comment-reply-link' ) ) ), $comment_reply_link );

		return $comment_reply_link;
	}
}
add_filter( 'comment_reply_link', 'aesthetix_comment_reply_link', 10, 4 );

if ( ! function_exists( 'aesthetix_cancel_comment_reply_link' ) ) {

	/**
	 * Function for 'cancel_comment_reply_link' filter-hook.
	 * 
	 * @param string $cancel_comment_reply_link The HTML-formatted cancel comment reply link.
	 * @param string $link_url                  Cancel comment reply link URL.
	 * @param string $link_text                 Cancel comment reply link text.
	 *
	 * @return string
	 */
	function aesthetix_cancel_comment_reply_link( $cancel_comment_reply_link, $link_url, $link_text ){

		$cancel_comment_reply_link = str_replace( 'id="cancel-comment-reply-link"', 'id="cancel-comment-reply-link" class="' . esc_attr( implode( ' ', get_link_classes( 'cancel-comment-reply-link' ) ) ) . '"', $cancel_comment_reply_link );

		return $cancel_comment_reply_link;
	}
}
add_filter( 'cancel_comment_reply_link', 'aesthetix_cancel_comment_reply_link', 10, 3 );

