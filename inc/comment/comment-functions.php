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
		$args['depth']   = $depth;

		get_template_part( 'templates/comment/comment', '', $args );
	}
}
