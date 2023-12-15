<?php
/**
 * Comment actions.
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'aesthetix_pre_get_comments' ) ) {

	/**
	 * Function for 'pre_get_comments' action-hook.
	 * 
	 * @param WP_Comment_Query $query Current instance of WP_Comment_Query (passed by reference).
	 *
	 * @return void
	 */
	function aesthetix_pre_get_comments( $query ) {

		if ( isset( $_COOKIE['comment_author_email_' . COOKIEHASH] ) ) {
			$query->query_vars['include_unapproved'] = array( $_COOKIE['comment_author_email_' . COOKIEHASH] );
		} elseif ( ! is_user_logged_in() && ! current_user_can( 'moderate_comments' ) ) {

			// Exclude non-confirmed comments.
			$meta_query_args = array(
				'relation' => 'OR',
				array(
					'key'     => 'confirm',
					'value'   => '0',
					'compare' => '!=',
				),
				array(
					'key'     => 'confirm',
					'compare' => 'NOT EXISTS',
				),
			);

			$query->query_vars['meta_query'] = $meta_query_args;
		}

		// vardump( $query );
	}
}
add_action( 'pre_get_comments', 'aesthetix_pre_get_comments' );
