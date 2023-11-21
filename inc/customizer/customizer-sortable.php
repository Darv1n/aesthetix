<?php
/**
 * Customizer sortable.
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'get_aesthetix_customizer_archive_post_structure' ) ) {

	/**
	 * Return array with the customizer archive post structure.
	 *
	 * @param string $control   Array key to get one value.
	 * @param string $post_type Current post type.
	 *
	 * @return string|array|false
	 */
	function get_aesthetix_customizer_archive_post_structure( $control = null, $post_type = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		$converter = array(
			'title'      => __( 'Post title', 'aesthetix' ),
			'meta'       => __( 'Post meta data', 'aesthetix' ),
			'excerpt'    => __( 'Post excerpt', 'aesthetix' ),
			'author'     => __( 'Post author', 'aesthetix' ),
			'more'       => __( 'Post read more', 'aesthetix' ),
		);

		// Merge child and parent default options.
		$converter = apply_filters( 'get_aesthetix_customizer_archive_post_structure', $converter, $post_type );

		// Return controls.
		if ( is_null( $control ) ) {
			return $converter;
		} elseif ( ! isset( $converter[ $control ] ) || empty( $converter[ $control ] ) ) {
			return false;
		} else {
			return $converter[ $control ];
		}
	}
}

if ( ! function_exists( 'get_aesthetix_customizer_single_post_structure' ) ) {

	/**
	 * Return array with the customizer single post structure.
	 *
	 * @param string $control   Array key to get one value.
	 * @param string $post_type Current post type.
	 *
	 * @return string|array|false
	 */
	function get_aesthetix_customizer_single_post_structure( $control = null, $post_type = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		$converter = array(
			'header'    => __( 'Post header', 'aesthetix' ),
			'thumbnail' => __( 'Post thumbnail', 'aesthetix' ),
			'meta'      => __( 'Post meta data', 'aesthetix' ),
			'content'   => __( 'Post content', 'aesthetix' ),
			'footer'    => __( 'Post footer', 'aesthetix' ),
		);

		// Merge child and parent default options.
		$converter = apply_filters( 'get_aesthetix_customizer_single_post_structure', $converter, $post_type );

		// Return controls.
		if ( is_null( $control ) ) {
			return $converter;
		} elseif ( ! isset( $converter[ $control ] ) || empty( $converter[ $control ] ) ) {
			return false;
		} else {
			return $converter[ $control ];
		}
	}
}

if ( ! function_exists( 'get_aesthetix_customizer_single_post_footer_structure' ) ) {

	/**
	 * Return array with the customizer single post footer structure.
	 *
	 * @param string $control   Array key to get one value.
	 * @param string $post_type Current post type.
	 *
	 * @return string|array|false
	 */
	function get_aesthetix_customizer_single_post_footer_structure( $control = null, $post_type = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		$converter = array(
			'edit' => __( 'Edit', 'aesthetix' ),
		);

		if ( $post_type === 'post' ) {
			$converter['cats'] = __( 'Categories', 'aesthetix' );
			$converter['tags'] = __( 'Tags', 'aesthetix' );
		}

		// Merge child and parent default options.
		$converter = apply_filters( 'get_aesthetix_customizer_single_post_footer_structure', $converter, $post_type );

		// Return controls.
		if ( is_null( $control ) ) {
			return $converter;
		} elseif ( ! isset( $converter[ $control ] ) || empty( $converter[ $control ] ) ) {
			return false;
		} else {
			return $converter[ $control ];
		}
	}
}

if ( ! function_exists( 'get_aesthetix_customizer_post_meta_structure' ) ) {

	/**
	 * Return array with the customizer post meta structure.
	 *
	 * @param string $control   Array key to get one value.
	 * @param string $post_type Current post type.
	 *
	 * @return string|array|false
	 */
	function get_aesthetix_customizer_post_meta_structure( $control = null, $post_type = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		if ( is_null( $post_type ) ) {
			if ( get_post_type() ) {
				$post_type = get_post_type();
			} else {
				$post_type = 'post';
			}
		}

		$converter = array(
			'author'   => __( 'Author', 'aesthetix' ),
			'date'     => __( 'Publication date', 'aesthetix' ),
			'time'     => __( 'Reading time', 'aesthetix' ),
			'comments' => __( 'Comments', 'aesthetix' ),
			'edit'     => __( 'Edit', 'aesthetix' ),
		);

		$object_taxonomies = get_object_taxonomies( $post_type );

		foreach ( $object_taxonomies as $key => $object_taxonomy ) {
			$taxonomy = get_taxonomy( $object_taxonomy );
			$converter[ $taxonomy->name ] = $taxonomy->label;
		}

		// Merge child and parent default options.
		$converter = apply_filters( 'get_aesthetix_customizer_post_meta_structure', $converter, $post_type );

		// Return controls.
		if ( is_null( $control ) ) {
			return $converter;
		} elseif ( ! isset( $converter[ $control ] ) || empty( $converter[ $control ] ) ) {
			return false;
		} else {
			return $converter[ $control ];
		}
	}
}

if ( ! function_exists( 'get_aesthetix_customizer_post_taxonomies_structure' ) ) {

	/**
	 * Return array with the customizer post thumbnail structure.
	 *
	 * @param string $control   Array key to get one value.
	 * @param string $post_type Current post type.
	 *
	 * @return string|array|false
	 */
	function get_aesthetix_customizer_post_taxonomies_structure( $control = null, $post_type = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		if ( is_null( $post_type ) ) {
			if ( get_post_type() ) {
				$post_type = get_post_type();
			} else {
				$post_type = 'post';
			}
		}

		$converter = array(
			'sticky' => __( 'Sticky', 'aesthetix' ),
		);

		$object_taxonomies = get_object_taxonomies( $post_type );

		foreach ( $object_taxonomies as $key => $object_taxonomy ) {
			$taxonomy = get_taxonomy( $object_taxonomy );
			$converter[ $taxonomy->name ] = $taxonomy->label;
		}

		// Merge child and parent default options.
		$converter = apply_filters( 'get_aesthetix_customizer_post_taxonomies_structure', $converter, $post_type );

		// Return controls.
		if ( is_null( $control ) ) {
			return $converter;
		} elseif ( ! isset( $converter[ $control ] ) || empty( $converter[ $control ] ) ) {
			return false;
		} else {
			return $converter[ $control ];
		}
	}
}

if ( ! function_exists( 'get_aesthetix_customizer_scroll_top_structure' ) ) {

	/**
	 * Return array with the customizer scroll top structure.
	 *
	 * @param string $control Array key to get one value.
	 *
	 * @return string|array|false
	 */
	function get_aesthetix_customizer_scroll_top_structure( $control = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		$converter = array(
			'telegram'   => __( 'Telegram button', 'aesthetix' ),
			'whatsapp'   => __( 'WhatsApp button', 'aesthetix' ),
			'scroll-top' => __( 'Scroll top button', 'aesthetix' ),
		);

		// Merge child and parent default options.
		$converter = apply_filters( 'get_aesthetix_customizer_scroll_top_structure', $converter );

		// Return controls.
		if ( is_null( $control ) ) {
			return $converter;
		} elseif ( ! isset( $converter[ $control ] ) || empty( $converter[ $control ] ) ) {
			return false;
		} else {
			return $converter[ $control ];
		}
	}
}
