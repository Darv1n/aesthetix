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

		if ( is_null( $post_type ) ) {
			if ( get_post_type() ) {
				$post_type = get_post_type();
			} else {
				$post_type = 'post';
			}
		}

		$converter = array(
			'title'      => __( 'Post title', 'aesthetix' ),
			'meta'       => __( 'Post meta data', 'aesthetix' ),
			'excerpt'    => __( 'Post excerpt', 'aesthetix' ),
			'author'     => __( 'Post author', 'aesthetix' ),
			'more'       => __( 'Post read more', 'aesthetix' ),
		);

		$object_taxonomies = get_object_taxonomies( $post_type );

		foreach ( $object_taxonomies as $key => $object_taxonomy ) {
			if ( ! in_array( $object_taxonomy, array( 'language', 'post_translations' ), true ) ) {
				$taxonomy                     = get_taxonomy( $object_taxonomy );
				$converter[ $taxonomy->name ] = $taxonomy->label;
			}
		}

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

		if ( is_null( $post_type ) ) {
			if ( get_post_type() ) {
				$post_type = get_post_type();
			} else {
				$post_type = 'post';
			}
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

		if ( is_null( $post_type ) ) {
			if ( get_post_type() ) {
				$post_type = get_post_type();
			} else {
				$post_type = 'post';
			}
		}

		$converter = array(
			'likes' => __( 'Post likes', 'aesthetix' ),
			'share' => __( 'Post share', 'aesthetix' ),
			'edit'  => __( 'Edit', 'aesthetix' ),
		);

		$object_taxonomies = get_object_taxonomies( $post_type );

		foreach ( $object_taxonomies as $key => $object_taxonomy ) {
			if ( ! in_array( $object_taxonomy, array( 'language', 'post_translations' ), true ) ) {
				$taxonomy = get_taxonomy( $object_taxonomy );
				$converter[ $taxonomy->name ] = $taxonomy->label;
			}
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
			'views'    => __( 'Views', 'aesthetix' ),
			'likes'    => __( 'Likes', 'aesthetix' ),
			'dislikes' => __( 'Dislikes', 'aesthetix' ),
			'comments' => __( 'Comments', 'aesthetix' ),
			'edit'     => __( 'Edit', 'aesthetix' ),
		);

		$object_taxonomies = get_object_taxonomies( $post_type );

		foreach ( $object_taxonomies as $key => $object_taxonomy ) {
			if ( ! in_array( $object_taxonomy, array( 'language', 'post_translations' ), true ) ) {
				$taxonomy = get_taxonomy( $object_taxonomy );
				$converter[ $taxonomy->name ] = $taxonomy->label;
			}
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

if ( ! function_exists( 'get_aesthetix_customizer_post_thumbnail_structure' ) ) {

	/**
	 * Return array with the customizer post thumbnail structure.
	 *
	 * @param string $control   Array key to get one value.
	 * @param string $post_type Current post type.
	 *
	 * @return string|array|false
	 */
	function get_aesthetix_customizer_post_thumbnail_structure( $control = null, $post_type = null ) {

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
			if ( ! in_array( $object_taxonomy, array( 'language', 'post_translations' ), true ) ) {
				$taxonomy = get_taxonomy( $object_taxonomy );
				$converter[ $taxonomy->name ] = $taxonomy->label;
			}
		}

		// Merge child and parent default options.
		$converter = apply_filters( 'get_aesthetix_customizer_post_thumbnail_structure', $converter, $post_type );

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

if ( ! function_exists( 'get_aesthetix_customizer_comments_structure' ) ) {

	/**
	 * Return array with the customizer comments structure.
	 *
	 * @param string $control Array key to get one value.
	 *
	 * @return string|array|false
	 */
	function get_aesthetix_customizer_comments_structure( $control = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		$converter = array(
			'header'        => __( 'Header', 'aesthetix' ),
			'content'       => __( 'Content', 'aesthetix' ),
			'notifications' => __( 'Notifications', 'aesthetix' ),
			'footer'        => __( 'Footer', 'aesthetix' ),
		);

		// Merge child and parent default options.
		$converter = apply_filters( 'get_aesthetix_customizer_comments_structure', $converter );

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
