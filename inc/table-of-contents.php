<?php
/**
 * Table of contents.
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'get_table_of_contents' ) ) {

	/**
	 * Return array with table of contents
	 * 
	 * @param int $post_id Post ID.
	 *
	 * @return void
	 */
	function get_table_of_contents( $post_id ) {

		$post = get_post( $post_id );

		if ( is_null( $post ) ) {
			return false;
		}

		$table_of_contents = array();

		// Define a regular expression pattern to match HTML heading tags.
		$pattern = '/<h([1-6])([^>]*)>(.*)<\/h\\1>/iu';

		// Perform a regular expression match on the post content.
		preg_match_all( $pattern, $post->post_content, $matches );

		// vardump( $matches );

		if ( count( $matches ) > 0 ) {

			$levels = array_flip( array_unique( $matches[1] ) );

			foreach ( $matches[0] as $key => $match ) {
				if ( ! empty( $matches[1][ $key ] ) ) {
					$pattern = '/id="([^"]+)"/';
					preg_match( $pattern, $matches[2][ $key ], $match_id );

					if ( isset( $match_id[1] ) && ! empty( $match_id[1] ) ) {
						$table_of_contents[ $key ][ 'id' ] = $match_id[1];
					}
				}

				$table_of_contents[ $key ][ 'level' ] = $levels[ (int) $matches[1][ $key ] ];
				$table_of_contents[ $key ][ 'title' ] = $matches[3][ $key ];
			}
		}
		
		// vardump( $table_of_contents );
		
		return $table_of_contents;
	}
}
