<?php
/**
 * Customizer selects
 *
 * @package aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'get_aesthetix_customizer_archive_post_structure' ) ) {

	/**
	 * Return array with the customizer archive post structure.
	 *
	 * @param string $control   array key to get one value.
	 * @param string $post_type current post type
	 *
	 * @return string|string[]|false
	 */
	function get_aesthetix_customizer_archive_post_structure( $control = null, $post_type = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		$converter = array(
			'title'     => __( 'Post Title', 'aesthetix' ),
			'thumbnail' => __( 'Post Thumbnail', 'aesthetix' ),
			'meta'      => __( 'Post Meta Data', 'aesthetix' ),
			'excerpt'   => __( 'Post Excerpt', 'aesthetix' ),
			'more'      => __( 'Post Read More', 'aesthetix' ),
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
	 * @param string $control   array key to get one value.
	 * @param string $post_type current post type
	 *
	 * @return string|string[]|false
	 */
	function get_aesthetix_customizer_single_post_structure( $control = null, $post_type = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		$converter = array(
			'header'    => __( 'Post Header', 'aesthetix' ),
			'thumbnail' => __( 'Post Thumbnail', 'aesthetix' ),
			'meta'      => __( 'Post Meta Data', 'aesthetix' ),
			'content'   => __( 'Post Content', 'aesthetix' ),
			'footer'    => __( 'Post Footer', 'aesthetix' ),
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
	 * @param string $control   array key to get one value.
	 * @param string $post_type current post type
	 *
	 * @return string|string[]|false
	 */
	function get_aesthetix_customizer_single_post_footer_structure( $control = null, $post_type = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		$converter = array(
			'edit'    => __( 'Edit', 'aesthetix' ),
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
	 * @param string $control array key to get one value.
	 * @param string $post_type current post type
	 *
	 * @return string|string[]|false
	 */
	function get_aesthetix_customizer_post_meta_structure( $control = null, $post_type = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		$converter = array(
			'author'   => __( 'Author', 'aesthetix' ),
			'date'     => __( 'Publication date', 'aesthetix' ),
			'time'     => __( 'Reading time', 'aesthetix' ),
			'comments' => __( 'Comments', 'aesthetix' ),
			'edit'     => __( 'Edit', 'aesthetix' ),
		);

		if ( $post_type === 'post' ) {
			$converter['cats'] = __( 'Categories', 'aesthetix' );
			$converter['tags'] = __( 'Tags', 'aesthetix' );
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

if ( ! function_exists( 'get_aesthetix_customizer_fonts' ) ) {

	/**
	 * Return array with the customizer fonts.
	 *
	 * @param string $control array key to get one value.
	 *
	 * @return string|string[]|false
	 */
	function get_aesthetix_customizer_fonts( $control = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		$converter = array(
			'open-sans'        => 'Open Sans',
			'montserrat'       => 'Montserrat',
			'oswald'           => 'Oswald',
			'raleway'          => 'Raleway',
			'roboto-slab'      => 'Roboto Slab',
			'playfair-display' => 'Playfair Display',
			'lora'             => 'Lora',
			'bitter'           => 'Bitter',
			'comfortaa'        => 'Comfortaa',
			'jost'             => 'Jost',
			'vollkorn'         => 'Vollkorn',
			'alegreya'         => 'Alegreya',
			'literata'         => 'Literata',
			'podkova'          => 'Podkova',
			'brygada-1918'     => 'Brygada 1918',
			'piazzolla'        => 'Piazzolla',
			'merriweather'     => 'Merriweather',
			'pt-serif'         => 'PT Serif',
			'source-serif-pro' => 'Source Serif Pro',
			'cormorant'        => 'Cormorant',
			'anonymous-pro'    => 'Anonymous Pro',
			'bona-nova'        => 'Bona Nova',
			'cormorant'        => 'Cormorant',
		);

		// Merge child and parent default options.
		$converter = apply_filters( 'get_aesthetix_customizer_fonts', $converter );

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

if ( ! function_exists( 'get_aesthetix_customizer_colors' ) ) {

	/**
	 * Return array with the customizer colors.
	 *
	 * @param string $control array key to get one value.
	 *
	 * @return string|string[]|false
	 */
	function get_aesthetix_customizer_colors( $control = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		$converter = array(
			'red'     => 'Red',
			'orange'  => 'Orange',
			'amber'   => 'Amber',
			'yellow'  => 'Yellow',
			'lime'    => 'Lime',
			'green'   => 'Green',
			'emerald' => 'Emerald',
			'teal'    => 'Teal',
			'cyan'    => 'Cyan',
			'sky'     => 'Sky',
			'blue'    => 'Blue',
			'indigo'  => 'Indigo',
			'violet'  => 'Violet',
			'purple'  => 'Purple',
			'fuchsia' => 'Fuchsia',
			'pink'    => 'Pink',
			'rose'    => 'Rose',
		);

		// Merge child and parent default options.
		$converter = apply_filters( 'get_aesthetix_customizer_colors', $converter );

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

if ( ! function_exists( 'get_aesthetix_customizer_gray_colors' ) ) {

	/**
	 * Return array with the customizer gray colors.
	 *
	 * @param string $control array key to get one value.
	 *
	 * @return string|string[]|false
	 */
	function get_aesthetix_customizer_gray_colors( $control = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		$converter = array(
			'slate'   => 'Slate',
			'gray'    => 'Gray',
			'zinc'    => 'Zinc',
			'neutral' => 'Neutral',
			'stone'   => 'Stone',
		);

		// Merge child and parent default options.
		$converter = apply_filters( 'get_aesthetix_customizer_gray_colors', $converter );

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

if ( ! function_exists( 'get_aesthetix_customizer_link_colors' ) ) {

	/**
	 * Return array with the customizer link colors.
	 *
	 * @param string $control array key to get one value.
	 *
	 * @return string|string[]|false
	 */
	function get_aesthetix_customizer_link_colors( $control = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		$converter = array(
			'primary'   => 'Primary',
			'secondary' => 'Secondary',
			'blue'      => 'Blue',
			'gray'      => 'Gray',
		);

		// Merge child and parent default options.
		$converter = apply_filters( 'get_aesthetix_customizer_link_colors', $converter );

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

if ( ! function_exists( 'get_aesthetix_customizer_button_types' ) ) {

	/**
	 * Return array with the customizer button types.
	 *
	 * @param string $control array key to get one value.
	 *
	 * @return string|string[]|false
	 */
	function get_aesthetix_customizer_button_types( $control = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		$converter = array(
			'common'   => 'Common',
			'empty'    => 'Empty',
			'gradient' => 'Gradient',
			'slide'    => 'Slide',
		);

		// Merge child and parent default options.
		$converter = apply_filters( 'get_aesthetix_customizer_button_types', $converter );

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

if ( ! function_exists( 'get_aesthetix_customizer_button_sizes' ) ) {

	/**
	 * Return array with the customizer button sizes.
	 *
	 * @param string $control array key to get one value.
	 *
	 * @return string|string[]|false
	 */
	function get_aesthetix_customizer_button_sizes( $control = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		$converter = array(
			'btn-xs' => 'btn-xs',
			'btn-sm' => 'btn-sm',
			'btn'    => 'btn',
			'btn-md' => 'btn-md',
			'btn-lg' => 'btn-lg',
			'btn-xl' => 'btn-xl',
		);

		// Merge child and parent default options.
		$converter = apply_filters( 'get_aesthetix_customizer_button_sizes', $converter );

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

if ( ! function_exists( 'get_aesthetix_customizer_button_border_widths' ) ) {

	/**
	 * Return array with the customizer button widths.
	 *
	 * @param string $control array key to get one value.
	 *
	 * @return string|string[]|false
	 */
	function get_aesthetix_customizer_button_border_widths( $control = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		$converter = array(
			'border'   => 'border',
			'border-2' => 'border-2',
			'border-3' => 'border-3',
			'border-4' => 'border-4',
			'border-6' => 'border-6',
		);

		// Merge child and parent default options.
		$converter = apply_filters( 'get_aesthetix_customizer_button_border_widths', $converter );

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

if ( ! function_exists( 'get_aesthetix_customizer_button_border_radiuses' ) ) {

	/**
	 * Return array with the customizer button radius.
	 *
	 * @param string $control array key to get one value.
	 *
	 * @return string|string[]|false
	 */
	function get_aesthetix_customizer_button_border_radiuses( $control = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		$converter = array(
			'rounded-none' => 'rounded-none',
			'rounded-sm'   => 'rounded-sm',
			'rounded'      => 'rounded',
			'rounded-md'   => 'rounded-md',
			'rounded-lg'   => 'rounded-lg',
			'rounded-xl'   => 'rounded-xl',
			'rounded-2xl'  => 'rounded-2xl',
			'rounded-3xl'  => 'rounded-3xl',
			'rounded-4xl'  => 'rounded-4xl',
		);

		// Merge child and parent default options.
		$converter = apply_filters( 'get_aesthetix_customizer_button_border_radiuses', $converter );

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

if ( ! function_exists( 'get_aesthetix_customizer_box_shadows' ) ) {

	/**
	 * Return array with the customizer box shadows.
	 *
	 * @param string $control array key to get one value.
	 *
	 * @return string|string[]|false
	 */
	function get_aesthetix_customizer_box_shadows( $control = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		$converter = array(
			'shadow-none'  => 'shadow-none',
			'shadow-sm'    => 'shadow-sm',
			'shadow'       => 'shadow',
			'shadow-md'    => 'shadow-md',
			'shadow-lg'    => 'shadow-lg',
			'shadow-xl'    => 'shadow-xl',
			'shadow-2xl'   => 'shadow-2xl',
			'shadow-inner' => 'shadow-inner',
			'shadow-none'  => 'shadow-none',
		);

		// Merge child and parent default options.
		$converter = apply_filters( 'get_aesthetix_customizer_box_shadows', $converter );

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