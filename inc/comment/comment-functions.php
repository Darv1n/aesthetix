<?php
/**
 * Comment functions.
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'aesthetix_comments_list' ) ) {

	/**
	 * Callback function for print comment list.
	 *
	 * @param object $comment is common WordPress comment object
	 * @param array $args is custom additional parameters
	 * @param string $depth is arg for comment_reply_link().
	 *
	 */
	function aesthetix_comments_list( $comment, $args, $depth ) {

		$args['comment'] = $comment;
		$args['depth']  = $depth;

		get_template_part( 'templates/comment/comment', '', $args );
	}
}

if ( ! function_exists( 'aesthetix_has_confirmed_comments' ) ) {

	/**
	 * Checks that the user has verified comments.
	 *
	 * @param string $comment_author_email User email.
	 */
	function aesthetix_has_confirmed_comments( $comment_author_email ) {

		if ( ! is_email( $comment_author_email ) ) {
			return false;
		}

		$args = array(
			'author_email' => $comment_author_email,
			'fields'       => 'ids',
			'meta_query'   => array(
				array(
					'key'     => 'confirm',
					'value'   => '1',
					'compare' => '=',
				),
			)
		);

		$comments = get_comments( $args );

		if ( count( $comments ) > 0 ) {
			return true;
		}

		return false;
	}
}
