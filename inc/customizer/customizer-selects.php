<?php
/**
 * Customizer selects.
 *
 * @since 1.0.0
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
	 * @since 1.0.0
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
			'thumbnail'  => __( 'Post thumbnail', 'aesthetix' ),
			'meta'       => __( 'Post meta data', 'aesthetix' ),
			'excerpt'    => __( 'Post excerpt', 'aesthetix' ),
			'author'     => __( 'Post author widget', 'aesthetix' ),
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
	 * @since 1.0.0
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
	 * @since 1.0.0
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
	 * @since 1.0.0
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
	 * @since 1.0.0
	 *
	 * @param string $control Array key to get one value.
	 *
	 * @return string|array|false
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
	 * @since 1.0.0
	 *
	 * @param string $control Array key to get one value.
	 *
	 * @return string|array|false
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
	 * @since 1.0.0
	 *
	 * @param string $control Array key to get one value.
	 *
	 * @return string|array|false
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
	 * @since 1.0.0
	 *
	 * @param string $control Array key to get one value.
	 *
	 * @return string|array|false
	 */
	function get_aesthetix_customizer_link_colors( $control = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		$converter = array(
			'primary'   => __( 'Primary', 'aesthetix' ),
			'secondary' => __( 'Secondary', 'aesthetix' ),
			'blue'      => __( 'Blue', 'aesthetix' ),
			'gray'      => __( 'Gray', 'aesthetix' ),
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

if ( ! function_exists( 'get_aesthetix_customizer_button_type' ) ) {

	/**
	 * Return array with the customizer button types.
	 * 
	 * @since 1.0.0
	 *
	 * @param string $control Array key to get one value.
	 *
	 * @return string|array|false
	 */
	function get_aesthetix_customizer_button_type( $control = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		$converter = array(
			'common'   => __( 'Common', 'aesthetix' ),
			'empty'    => __( 'Empty', 'aesthetix' ),
			'gradient' => __( 'Gradient', 'aesthetix' ),
			'slide'    => __( 'Slide', 'aesthetix' ),
		);

		// Merge child and parent default options.
		$converter = apply_filters( 'get_aesthetix_customizer_button_type', $converter );

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

if ( ! function_exists( 'get_aesthetix_customizer_sizes' ) ) {

	/**
	 * Return array with the customizer button sizes.
	 * 
	 * @since 1.0.0
	 *
	 * @param string $control Array key to get one value.
	 *
	 * @return string|array|false
	 */
	function get_aesthetix_customizer_sizes( $control = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		$converter = array(
			'xs' => __( 'Extra small', 'aesthetix' ),
			'sm' => __( 'Small', 'aesthetix' ),
			'md' => __( 'Medium', 'aesthetix' ),
			'lg' => __( 'Large', 'aesthetix' ),
			'xl' => __( 'Extra large', 'aesthetix' ),
		);

		// Merge child and parent default options.
		$converter = apply_filters( 'get_aesthetix_customizer_sizes', $converter );

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
	 * @since 1.0.0
	 *
	 * @param string $control Array key to get one value.
	 *
	 * @return string|array|false
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
	 * @since 1.0.0
	 *
	 * @param string $control Array key to get one value.
	 *
	 * @return string|array|false
	 */
	function get_aesthetix_customizer_button_border_radiuses( $control = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		$converter = array(
			'rounded-none' => 'rounded-none',
			'rounded-xs'   => 'rounded-xs',
			'rounded-sm'   => 'rounded-sm',
			'rounded-md'   => 'rounded-md',
			'rounded-lg'   => 'rounded-lg',
			'rounded-xl'   => 'rounded-xl',
			'rounded-2xl'  => 'rounded-2xl',
			'rounded-3xl'  => 'rounded-3xl',
			'rounded-4xl'  => 'rounded-4xl',
			'rounded-full' => 'rounded-full',
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
	 * @since 1.0.0
	 *
	 * @param string $control Array key to get one value.
	 *
	 * @return string|array|false
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

if ( ! function_exists( 'get_aesthetix_customizer_subscribe_form_type' ) ) {

	/**
	 * Return array with the customizer subscribe form type.
	 * 
	 * @since 1.1.2
	 *
	 * @param string $control Array key to get one value.
	 *
	 * @return string|array|false
	 */
	function get_aesthetix_customizer_subscribe_form_type( $control = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		$converter = array(
			'theme' => __( 'Theme (Messages will be sent to email)', 'aesthetix' ),
		);

		// Merge child and parent default options.
		$converter = apply_filters( 'get_aesthetix_customizer_subscribe_form_type', $converter );

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
	 * @since 1.1.6
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

		$converter = array(
			'taxonomies' => __( 'Post taxonomies', 'aesthetix' ),
			'formats'     => __( 'Post sticky & formats', 'aesthetix' ),
		);

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

if ( ! function_exists( 'get_aesthetix_customizer_button_color' ) ) {

	/**
	 * Return array with the customizer button colors.
	 * 
	 * @since 1.1.9
	 *
	 * @param string $control Array key to get one value.
	 *
	 * @return string|array|false
	 */
	function get_aesthetix_customizer_button_color( $control = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		$converter = array(
			'primary'   => __( 'Primary', 'aesthetix' ),
			'secondary' => __( 'Secondary', 'aesthetix' ),
			'gray'      => __( 'Gray', 'aesthetix' ),
		);

		// Merge child and parent default options.
		$converter = apply_filters( 'get_aesthetix_customizer_button_color', $converter );

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

if ( ! function_exists( 'get_aesthetix_customizer_button_content' ) ) {

	/**
	 * Return array with the customizer button type.
	 * 
	 * @since 1.1.9
	 *
	 * @param string $control Array key to get one value.
	 *
	 * @return string|array|false
	 */
	function get_aesthetix_customizer_button_content( $control = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		$converter = array(
			'button-icon-text' => __( 'Button + icon + text', 'aesthetix' ),
			'button-icon'      => __( 'Button + icon', 'aesthetix' ),
			'button-text'      => __( 'Button + text', 'aesthetix' ),
			'icon'             => __( 'Icon', 'aesthetix' ),
			'icon-text'        => __( 'Icon + text', 'aesthetix' ),
			'text'             => __( 'Text', 'aesthetix' ),
		);

		// Merge child and parent default options.
		$converter = apply_filters( 'get_aesthetix_customizer_button_content', $converter );

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

if ( ! function_exists( 'get_aesthetix_customizer_demo_variant' ) ) {

	/**
	 * Return array with the customizer demo variant
	 * 
	 * @since 1.2.4
	 *
	 * @param string $control Array key to get one value.
	 *
	 * @return string|array|false
	 */
	function get_aesthetix_customizer_demo_variant( $control = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		$converter = array(
			'default' => __( 'Default', 'aesthetix' ),
			'demo-1'  => 'Demo 1',
			'demo-2'  => 'Demo 2',
			'demo-3'  => 'Demo 3',
		);

		// Merge child and parent default options.
		$converter = apply_filters( 'get_aesthetix_customizer_demo_variant', $converter );

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
