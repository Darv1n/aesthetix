<?php
/**
 * Gutenberg.
 *
 * @link https://wordpress.org/gutenberg/
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_filter( 'render_block', function( $block_content, $block ) {

	// Replacement of search form layout.
	if ( $block['blockName'] === 'core/search' ) {
		$block_content = get_search_form( array( 'echo' => false ) );
	}

	// Add IDs to h1-h6 tags for ToC's work.
	if ( is_single() && $block['blockName'] === 'core/heading' ) {

		// Define a regular expression pattern to match HTML heading tags.
		$pattern = '/<h([1-6])([^>]*)>([^<]+)<\/h\\1>/iu';

		// Perform a regular expression match on the post content.
		preg_match_all( $pattern, $block_content, $matches );

		// Filter html id.
		if ( isset( $matches[2], $matches[2][0] ) ) {

			$pattern = '/id="([^"]+)"/';
			preg_match( $pattern, $matches[2][0], $match_id );

			if ( isset( $match_id[1] ) && ! empty( $match_id[1] ) ) {
				$block_content = str_replace( 'id="' . $match_id[1] . '"', 'id="' . get_title_slug( $match_id[1] ) . '"', $block_content );
			} elseif ( isset( $matches[1], $matches[1][0] ) && ! empty( $matches[1][0] ) && isset( $matches[3], $matches[3][0] ) && ! empty( $matches[3][0] ) ) {
				$block_content = str_replace( '<h' . $matches[1][0], '<h' . $matches[1][0] . ' id="' . get_title_slug( $matches[3][0] ) . '"', $block_content );
			}
		}

	}

	return $block_content;

}, 5, 2 );

