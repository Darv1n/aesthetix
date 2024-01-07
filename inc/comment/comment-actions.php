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

		// Exit if is admin.
		if ( is_admin() ) {
			return;
		}

		// Exclude non-confirmed comments.
		$meta_query_args = array(
			'relation' => 'OR',
			array(
				'key'     => 'confirm',
				'value'   => '1',
				'compare' => '=',
			),
			array(
				'key'     => 'confirm',
				'compare' => 'NOT EXISTS',
			),
		);

		if ( isset( $_COOKIE['author_comments_' . COOKIEHASH ] ) ) {
			$comments_ids = json_decode( stripslashes( $_COOKIE['author_comments_' . COOKIEHASH ] ) );
			$comments_ids = array_map( 'intval', $comments_ids );

			if ( $comments_ids && is_array( $comments_ids ) && ! empty( $comments_ids ) ) {

				$nonconfirmed_comments = get_option( 'nonconfirmed_comments', array() );

				if ( is_array( $nonconfirmed_comments ) ) {
					$query->query_vars['comment__not_in'] = array_unique( array_diff( $nonconfirmed_comments, $comments_ids ) );
				}
			}
		} elseif ( ! is_user_logged_in() || ! current_user_can( 'moderate_comments' ) ) {
			$query->query_vars['meta_query'] = $meta_query_args;
		}
	}
}
add_action( 'pre_get_comments', 'aesthetix_pre_get_comments' );

if ( ! function_exists( 'aesthetix_set_comment_cookies' ) ) {

	/**
	 * Sets comments cookie.
	 *
	 * @param WP_Comment $comment         Comment object.
	 * @param WP_User    $user            Comment author's user object. The user may not exist.
	 * @param bool       $cookies_consent Optional. Comment author's consent to store cookies. Default true.
	 */
	function aesthetix_set_comment_cookies( $comment, $user, $cookies_consent = true ) {

		// If the user already exists, or the user opted out of cookies, don't set cookies.
		if ( $user->exists() ) {
			return;
		}

		if ( false === $cookies_consent ) {
			// Remove any existing cookies.
			$past = time() - YEAR_IN_SECONDS;
			setcookie( 'author_comments_' . COOKIEHASH, ' ', $past, COOKIEPATH, COOKIE_DOMAIN );

			return;
		}

		$comment_cookie_lifetime = time() + apply_filters( 'comment_cookie_lifetime', 30000000 );

		$secure = ( 'https' === parse_url( home_url(), PHP_URL_SCHEME ) );

		if ( isset( $_COOKIE[ 'author_comments_' . COOKIEHASH ] ) ) {
			$comments_ids = json_decode( stripslashes( $_COOKIE['author_comments_' . COOKIEHASH ] ) );
			$comments_ids = array_map( 'intval', $comments_ids );
		}

		if ( ! isset( $comments_ids ) || is_null( $comments_ids ) || empty( $comments_ids ) ) {
			$comments_ids = array();
		}

		$comments_ids[] = $comment->comment_ID;

		setcookie( 'author_comments_' . COOKIEHASH, json_encode( array_unique( $comments_ids ) ), $comment_cookie_lifetime, COOKIEPATH, COOKIE_DOMAIN, $secure );
	}
}
add_action( 'set_comment_cookies', 'aesthetix_set_comment_cookies', 10, 3 );
