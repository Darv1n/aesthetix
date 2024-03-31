<?php
/**
 * Customizer selects.
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'get_aesthetix_customizer_button_content' ) ) {

	/**
	 * Return array with the customizer button type.
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
			'link-icon-text'   => __( 'Link + icon + text', 'aesthetix' ),
			'link-text'        => __( 'Link + text', 'aesthetix' ),
			'text-icon'        => __( 'Text + icon', 'aesthetix' ),
			'text'             => __( 'Text', 'aesthetix' ),
			'icon'             => __( 'Icon', 'aesthetix' ),
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

if ( ! function_exists( 'get_aesthetix_customizer_button_type' ) ) {

	/**
	 * Return array with the customizer button types.
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

if ( ! function_exists( 'get_aesthetix_customizer_button_sizes' ) ) {

	/**
	 * Return array with the customizer button sizes.
	 *
	 * @param string $control Array key to get one value.
	 *
	 * @return string|array|false
	 */
	function get_aesthetix_customizer_button_sizes( $control = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		$converter = array(
			'xxs' => 'XXS',
			'xs'  => 'XS',
			'sm'  => 'SM',
			'md'  => 'MD',
			'lg'  => 'LG',
			'xl'  => 'XL',
			'xxl' => 'XXL',
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

if ( ! function_exists( 'get_aesthetix_customizer_padding_sizes' ) ) {

	/**
	 * Return array with the customizer padding sizes.
	 *
	 * @param string $control Array key to get one value.
	 *
	 * @return string|array|false
	 */
	function get_aesthetix_customizer_padding_sizes( $control = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		$converter = array(
			'none' => __( 'None', 'aesthetix' ),
			'xs'   => 'XS',
			'sm'   => 'SM',
			'md'   => 'MD',
			'lg'   => 'LG',
			'xl'   => 'XL',
		);

		// Merge child and parent default options.
		$converter = apply_filters( 'get_aesthetix_customizer_padding_sizes', $converter );

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
	 * Return array with the customizer common sizes.
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
			'xs'  => 'XS',
			'sm'  => 'SM',
			'md'  => 'MD',
			'lg'  => 'LG',
			'xl'  => 'XL',
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

if ( ! function_exists( 'get_aesthetix_customizer_title_size' ) ) {

	/**
	 * Return array with the customizer title size.
	 *
	 * @param string $control Array key to get one value.
	 *
	 * @return string|array|false
	 */
	function get_aesthetix_customizer_title_size( $control = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		$converter = array(
			'h1' => '2.25rem',
			'h2' => '2rem',
			'h3' => '1.75rem',
			'h4' => '1.5rem',
			'h5' => '1.25rem',
			'h6' => '1rem',
		);

		// Merge child and parent default options.
		$converter = apply_filters( 'get_aesthetix_customizer_title_size', $converter );

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

if ( ! function_exists( 'get_aesthetix_customizer_border_widths' ) ) {

	/**
	 * Return array with the customizer border widths.
	 *
	 * @param string $control Array key to get one value.
	 *
	 * @return string|array|false
	 */
	function get_aesthetix_customizer_border_widths( $control = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		$converter = array(
			'none' => __( 'None', 'aesthetix' ),
			'xs'   => 'XS',
			'sm'   => 'SM',
			'md'   => 'MD',
			'lg'   => 'LG',
			'xl'   => 'XL',
		);

		// Merge child and parent default options.
		$converter = apply_filters( 'get_aesthetix_customizer_border_widths', $converter );

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

if ( ! function_exists( 'get_aesthetix_customizer_border_radiuses' ) ) {

	/**
	 * Return array with the customizer button radius.
	 *
	 * @param string $control Array key to get one value.
	 *
	 * @return string|array|false
	 */
	function get_aesthetix_customizer_border_radiuses( $control = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		$converter = array(
			'none' => __( 'None', 'aesthetix' ),
			'xxs'  => 'XXS',
			'xs'   => 'XS',
			'sm'   => 'SM',
			'md'   => 'MD',
			'lg'   => 'LG',
			'xl'   => 'XL',
			'2xl'  => '2XL',
			'3xl'  => '3XL',
			'4xl'  => '4XL',
			'full' => __( 'Full', 'aesthetix' ),
		);

		// Merge child and parent default options.
		$converter = apply_filters( 'get_aesthetix_customizer_border_radiuses', $converter );

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
			'none'  => __( 'None', 'aesthetix' ),
			'xs'    => 'XS',
			'sm'    => 'SM',
			'md'    => 'MD',
			'lg'    => 'LG',
			'xl'    => 'XL',
			'xxl'   => 'XXL',
			'inner' => __( 'Inner', 'aesthetix' ),
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

if ( ! function_exists( 'get_aesthetix_customizer_aspect_ratio' ) ) {

	/**
	 * Return array with the customizer aspect ratio.
	 *
	 * @param string $control Array key to get one value.
	 *
	 * @return string|array|false
	 */
	function get_aesthetix_customizer_aspect_ratio( $control = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		$converter = array(
			'1-1'  => '1/1',
			'2-3'  => '2/3',
			'3-2'  => '3/2',
			'3-4'  => '3/4',
			'4-3'  => '4/3',
			'9-16' => '9/16',
			'16-9' => '16/9',
		);

		// Merge child and parent default options.
		$converter = apply_filters( 'get_aesthetix_customizer_aspect_ratio', $converter );

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

if ( ! function_exists( 'get_aesthetix_customizer_background_colors' ) ) {

	/**
	 * Return array with the customizer background colors.
	 *
	 * @param string $control Array key to get one value.
	 *
	 * @return string|array|false
	 */
	function get_aesthetix_customizer_background_colors( $control = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		$converter = array(
			'theme'     => __( 'Theme', 'aesthetix' ),
			'gray'      => __( 'Gray', 'aesthetix' ),
			'primary'   => __( 'Primary', 'aesthetix' ),
			'secondary' => __( 'Secondary', 'aesthetix' ),
		);

		// Merge child and parent default options.
		$converter = apply_filters( 'get_aesthetix_customizer_background_colors', $converter );

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

if ( ! function_exists( 'get_aesthetix_customizer_link_colors' ) ) {

	/**
	 * Return array with the customizer link colors.
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

if ( ! function_exists( 'get_aesthetix_customizer_fonts' ) ) {

	/**
	 * Return array with the customizer fonts.
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





if ( ! function_exists( 'get_aesthetix_customizer_subscribe_form_type' ) ) {

	/**
	 * Return array with the customizer subscribe form type.
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

if ( ! function_exists( 'get_aesthetix_customizer_archive_post_order' ) ) {

	/**
	 * Return array with the customizer archive post order.
	 *
	 * @param string $control   Array key to get one value.
	 * @param string $post_type Current post type.
	 *
	 * @return string|array|false
	 */
	function get_aesthetix_customizer_archive_post_order( $control = null, $post_type = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		$converter = array(
			'asc'  => 'ASC',
			'desc' => 'DESC',
		);

		// Merge child and parent default options.
		$converter = apply_filters( 'get_aesthetix_customizer_archive_post_order', $converter, $post_type );

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

if ( ! function_exists( 'get_aesthetix_customizer_archive_post_orderby' ) ) {

	/**
	 * Return array with the customizer archive post orderby.
	 *
	 * @param string $control   Array key to get one value.
	 * @param string $post_type Current post type.
	 *
	 * @return string|array|false
	 */
	function get_aesthetix_customizer_archive_post_orderby( $control = null, $post_type = null ) {

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
			'date'     => __( 'By date', 'aesthetix' ),
			'modified' => __( 'By modified date', 'aesthetix' ),
			'title'    => __( 'By title', 'aesthetix' ),
			'rand'     => __( 'By random', 'aesthetix' ),
		);

		if ( post_type_supports( $post_type, 'page-attributes' ) ) {
			$converter['menu_order'] = __( 'By menu order', 'aesthetix' );
		}

		// Merge child and parent default options.
		$converter = apply_filters( 'get_aesthetix_customizer_archive_post_orderby', $converter, $post_type );

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

if ( ! function_exists( 'get_aesthetix_customizer_archive_post_layout' ) ) {

	/**
	 * Return array with the customizer archive post layout.
	 *
	 * @param string $control   Array key to get one value.
	 * @param string $post_type Current post type.
	 *
	 * @return string|array|false
	 */
	function get_aesthetix_customizer_archive_post_layout( $control = null, $post_type = null ) {

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
			'grid'       => __( 'Grid', 'aesthetix' ),
			'grid-image' => __( 'Grid image', 'aesthetix' ),
			'list'       => __( 'List', 'aesthetix' ),
			'list-chess' => __( 'List chess', 'aesthetix' ),
		);

		// Merge child and parent default options.
		$converter = apply_filters( 'get_aesthetix_customizer_archive_post_layout', $converter, $post_type );

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

if ( ! function_exists( 'get_aesthetix_customizer_socials' ) ) {

	/**
	 * Return array with the social names.
	 *
	 * @param string $control Array key to get one value.
	 *
	 * @return string|array|false
	 */
	function get_aesthetix_customizer_socials( $control = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		$converter = array(
			'instagram' => __( 'Instagram', 'aesthetix' ),
			'facebook'  => __( 'Facebook', 'aesthetix' ),
			'youtube'   => __( 'YouTube', 'aesthetix' ),
			'twitter'   => __( 'Twitter', 'aesthetix' ),
			'linkedin'  => __( 'LinkedIn', 'aesthetix' ),
			'telegram'  => __( 'Telegram', 'aesthetix' ),
		);

		// Merge child and parent default options.
		$converter = apply_filters( 'get_aesthetix_customizer_socials', $converter );

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

if ( ! function_exists( 'get_aesthetix_customizer_share' ) ) {

	/**
	 * Return array with the share names.
	 *
	 * @param string $control Array key to get one value.
	 *
	 * @return string|array|false
	 */
	function get_aesthetix_customizer_share( $control = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		$converter = array(
			'facebook'  => __( 'Facebook', 'aesthetix' ),
			'twitter'   => __( 'Twitter', 'aesthetix' ),
			'pinterest' => __( 'Pinterest', 'aesthetix' ),
			'whatsapp'  => __( 'WhatsApp', 'aesthetix' ),
			'linkedin'  => __( 'LinkedIn', 'aesthetix' ),
			'tumblr'    => __( 'Tumblr', 'aesthetix' ),
			'reddit'    => __( 'Reddit', 'aesthetix' ),
		);

		// Merge child and parent default options.
		$converter = apply_filters( 'get_aesthetix_customizer_share', $converter );

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

if ( ! function_exists( 'get_aesthetix_customizer_breadcrumbs' ) ) {

	/**
	 * Return array with the customizer breadcrumbs.
	 *
	 * @param string $control Array key to get one value.
	 *
	 * @return string|array|false
	 */
	function get_aesthetix_customizer_breadcrumbs( $control = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		$converter = array(
			'default'     => __( 'Theme', 'aesthetix' ),
			'woocommerce' => __( 'WooCommerce (Plugin must be activated)', 'aesthetix' ),
			'yoast'       => __( 'Yoast (Plugin must be activated)', 'aesthetix' ),
			'aioseo'      => __( 'All in One SEO (Plugin must be activated)', 'aesthetix' ),
			'rankmath'    => __( 'RankMath (Plugin must be activated)', 'aesthetix' ),
			'navxt'       => __( 'Breadcrumb NavXT (Plugin must be activated)', 'aesthetix' ),
		);

		// Merge child and parent default options.
		$converter = apply_filters( 'get_aesthetix_customizer_breadcrumbs', $converter );

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

if ( ! function_exists( 'get_aesthetix_customizer_display' ) ) {

	/**
	 * Return array with the customizer display options.
	 *
	 * @param string $control Array key to get one value.
	 *
	 * @return string|array|false
	 */
	function get_aesthetix_customizer_display( $control = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		$converter = array(
			'all'            => __( 'All', 'aesthetix' ),
			'front-page'     => __( 'Only front page', 'aesthetix' ),
			'not-front-page' => __( 'Except front page', 'aesthetix' ),
			'pages'          => __( 'Only single pages', 'aesthetix' ),
			'not-pages'      => __( 'Except single pages', 'aesthetix' ),
			'posts'          => __( 'Only single posts', 'aesthetix' ),
			'not-posts'      => __( 'Except single posts', 'aesthetix' ),
		);

		// Merge child and parent default options.
		$converter = apply_filters( 'get_aesthetix_customizer_display', $converter );

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
