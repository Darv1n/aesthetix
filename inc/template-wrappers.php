<?php
/**
 * Template wrappers.
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'aesthetix_body_classes' ) ) {

	/**
	 * Add custom classes to the array of body classes.
	 *
	 * @param string $classes Body classes.
	 *
	 * @return array
	 */
	function aesthetix_body_classes( $classes ) {

		// Adds a class of no-sidebar when there is no sidebar present.
		$sidebar = apply_filters( 'get_aesthetix_sidebar', 'sidebar' );
		if ( is_active_sidebar( $sidebar ) ) {
			$classes[] = 'has-sidebar';
		}

		// Check if the site is being viewed from a mobile device.
		if ( wp_is_mobile() ) {
			$classes[] = 'wp-mobile';
		} else {
			$classes[] = 'wp-desktop';
		}

		// Adds class with themename.
		$classes[] = 'theme-' . get_aesthetix_options( 'root_color_scheme' );
		$classes[] = 'theme-' . get_aesthetix_options( 'general_container_width' );
		$classes   = array_unique( (array) $classes );
		sort( $classes );

		return $classes;
	}
}
add_filter( 'body_class', 'aesthetix_body_classes', 10 );

if ( ! function_exists( 'get_aesthetix_post_classes' ) ) {

	/**
	 * Get classes for post wrapper.
	 *
	 * @param string $class Additional section classes. Default ''.
	 * @param array  $args  Additional arguments for construct classes. Default array().
	 *
	 * @return array
	 */
	function get_aesthetix_post_classes( $class = '', $args = array() ) {

		// Check the function has accepted any classes.
		if ( isset( $class ) && ! empty( $class ) ) {
			if ( is_array( $class ) ) {
				$classes = $class;
			} elseif ( is_string( $class ) ) {
				$classes = explode( ' ', $class );
			} else {
				$classes = array();
			}
		} else {
			$classes = array();
		}

		if ( isset( $args['post_classes'] ) ) {
			if ( is_string( $args['post_classes'] ) ) {
				$args['post_classes'] = explode( ' ', $args['post_classes'] );
			}
			$classes = array_merge( $classes, $args['post_classes'] );
		}

		// Merge default args.
		$defaults = array(
			'post_layout'       => get_aesthetix_options( 'archive_' . get_post_type() . '_layout' ),
			'post_background'   => get_aesthetix_options( 'archive_' . get_post_type() . '_background' ),
			'post_border_color' => get_aesthetix_options( 'archive_' . get_post_type() . '_border_color' ),
		);

		if ( has_post_format() ) {
			$defaults['post_format'] = get_post_format();
		} else {
			$defaults['post_format'] = 'standard';
		}

		$args = wp_parse_args( $args, $defaults );

		$classes[] = 'post';
		$classes[] = 'post-type-' . get_post_type();

		if ( has_post_thumbnail() ) {
			$classes[] = 'has-thumbnail';
		}

		if ( in_array( $args['post_layout'], array( 'list', 'list-chess' ), true ) ) {
			$classes[] = 'post-list';
		} else {
			$classes[] = 'post-grid';
		}

		$classes[] = 'post-' . $args['post_layout'];

		if ( $args['post_layout'] === 'grid-image' ) {
			$classes[] = 'post-format-image';
		} elseif ( $args['post_format'] ) {
			$classes[] = 'post-format-' . $args['post_format'];
		} else {
			$classes[] = 'post-format-standard';
		}

		if ( isset( $args['post_background'] ) ) {
			$classes[] = 'post-background';
		}

		if ( $args['post_border_color'] === true ) {
			$classes[] = 'post-border-color';
		}

		if ( is_sticky() ) {
			$classes[] = 'post-sticky';
		}

		// Crutch to distinguish single post template from archive template
		if ( ! in_array( 'post-single', $classes, true ) ) {
			$classes[] = 'post-archive';
		}

		// Add filter to array.
		$classes = apply_filters( 'get_aesthetix_post_classes', $classes );
		$classes = array_unique( (array) $classes );
		sort( $classes );

		return $classes;
	}
}

if ( ! function_exists( 'aesthetix_post_classes' ) ) {

	/**
	 * Display classes for post wrapper.
	 *
	 * @param string $class Additional section classes. Default ''.
	 * @param array  $args Additional arguments for construct classes. Default array().
	 * @param bool   $echo  Echo or return section classes. Default true.
	 *
	 * @return string|void
	 */
	function aesthetix_post_classes( $class = '', $args = array(), $echo = true ) {

		$classes = get_aesthetix_post_classes( $class, $args );

		if ( $echo ) {
			echo 'class="' . esc_attr( implode( ' ', $classes ) ) . '"';
		} else {
			return 'class="' . esc_attr( implode( ' ', $classes ) ) . '"';
		}
	}
}

if ( ! function_exists( 'get_aesthetix_section_classes' ) ) {

	/**
	 * Get classes for section wrapper.
	 *
	 * @param string $class      Additional section classes. Default ''.
	 * @param string $background Background type. Default 'theme'.
	 *
	 * @return array
	 */
	function get_aesthetix_section_classes( $class = '', $background = 'theme', $type = null ) {

		// Check the function has accepted any classes.
		if ( isset( $class ) && ! empty( $class ) ) {
			if ( is_array( $class ) ) {
				$classes = $class;
			} elseif ( is_string( $class ) ) {
				$classes = explode( ' ', $class );
			} else {
				$classes = array();
			}
		} else {
			$classes = array();
		}

		if ( is_null( $type ) ) {
			$type = get_aesthetix_options( 'root_bg_section_type' );
		}

		// Add elements to array.
		$classes[] = 'section';

		if ( in_array( 'header', $classes, true ) && has_custom_header() ) {
			$classes[] = 'header_background-image';
		}

		if ( $background !== 'theme' ) {

			$classes[] = 'section-background';

			if ( $type === 'narrow' ) {
				$classes[] = 'section-inner-' . $background;
			} else {
				$classes[] = 'section-' . $background;
			}
		}

		if ( in_array( 'header-section', $classes, true ) ) {
			if ( in_array( 'header-top-bar', $classes, true ) && get_aesthetix_options( 'root_bg_header_middle_bar' ) !== 'theme' ) {
				$classes[] = 'has-section-below';
			}

			if ( in_array( 'header-middle-bar', $classes, true ) ) {
				if ( get_aesthetix_options( 'general_header_top_bar_display' && get_aesthetix_options( 'root_bg_header_top_bar' ) !== 'theme' ) ) {
					$classes[] = 'has-section-above';
				}
				if ( in_array( get_aesthetix_options( 'general_header_type' ), array( 'mid-2-bot-2', 'mid-2-bot-3', 'mid-3-bot-2', 'mid-3-bot-3' ), true ) && get_aesthetix_options( 'root_bg_header_bottom_bar' ) !== 'theme' ) {
					$classes[] = 'has-section-below';
				}
			}

			if ( in_array( 'header-bottom-bar', $classes, true ) && get_aesthetix_options( 'root_bg_header_middle_bar' ) !== 'theme' ) {
				$classes[] = 'has-section-above';
			}
		}

		if ( in_array( 'footer-section', $classes, true ) ) {
			if ( in_array( 'footer-top-bar', $classes, true ) && get_aesthetix_options( 'root_bg_footer_middle_bar' ) !== 'theme' ) {
				$classes[] = 'has-section-below';
			}

			if ( in_array( 'footer-middle-bar', $classes, true ) ) {
				if ( get_aesthetix_options( 'general_footer_top_bar_display' ) && get_aesthetix_options( 'root_bg_footer_top_bar' ) !== 'theme' ) {
					$classes[] = 'has-section-above';
				}
				if ( get_aesthetix_options( 'general_footer_bottom_bar_display' ) && get_aesthetix_options( 'root_bg_footer_bottom_bar' ) !== 'theme' ) {
					$classes[] = 'has-section-below';
				}
			}

			if ( in_array( 'footer-bottom-bar', $classes, true ) && get_aesthetix_options( 'root_bg_footer_middle_bar' ) !== 'theme' ) {
				$classes[] = 'has-section-above';
			}
		}

		// Add filter to array.
		$classes = apply_filters( 'get_aesthetix_section_classes', $classes, $background );
		$classes = array_unique( (array) $classes );
		sort( $classes );

		return $classes;
	}
}

if ( ! function_exists( 'aesthetix_section_classes' ) ) {

	/**
	 * Display classes for section wrapper.
	 *
	 * @param string $class      Additional section classes. Default ''.
	 * @param string $background Background type. Default 'theme'.
	 * @param bool   $echo       Echo or return section classes. Default true.
	 *
	 * @return string|void
	 */
	function aesthetix_section_classes( $class = '', $background = 'theme', $echo = true ) {

		$classes = get_aesthetix_section_classes( $class, $background );

		if ( $echo ) {
			echo 'class="' . esc_attr( implode( ' ', $classes ) ) . '"';
		} else {
			return 'class="' . esc_attr( implode( ' ', $classes ) ) . '"';
		}
	}
}

if ( ! function_exists( 'get_aesthetix_container_classes' ) ) {

	/**
	 * Get classes for container wrapper.
	 *
	 * @param string $class Additional container classes. Default ''.
	 *
	 * @return array
	 */
	function get_aesthetix_container_classes( $class = '' ) {

		// Check the function has accepted any classes.
		if ( isset( $class ) && ! empty( $class ) ) {
			if ( is_array( $class ) ) {
				$classes = $class;
			} elseif ( is_string( $class ) ) {
				$classes = explode( ' ', $class );
			} else {
				$classes = array();
			}
		} else {
			$classes = array();
		}

		// Add elements to array.
		$classes[] = 'container';

		if ( in_array( 'container-outer', $classes, true ) ) {

			if ( get_aesthetix_options( 'general_container_width' ) === 'xs' ) {
				$classes[] = 'container-sm';
			}

			if ( get_aesthetix_options( 'general_container_width' ) === 'sm' ) {
				$classes[] = 'container-md';
			}

			if ( get_aesthetix_options( 'general_container_width' ) === 'md' ) {
				$classes[] = 'container-lg';
			}

			if ( get_aesthetix_options( 'general_container_width' ) === 'lg' ) {
				$classes[] = 'container-xl';
			}

			if ( get_aesthetix_options( 'general_container_width' ) === 'xl' ) {
				$classes[] = 'container-xl';
			}

			$classes[] = 'container-rounded';
		} else {
			$classes[] = 'container-' . get_aesthetix_options( 'general_container_width' );
		}

		// Add filter to array.
		$classes = apply_filters( 'get_aesthetix_container_classes', $classes );
		$classes = array_unique( (array) $classes );
		sort( $classes );

		return $classes;
	}
}

if ( ! function_exists( 'aesthetix_container_classes' ) ) {

	/**
	 * Display classes for container wrapper.
	 *
	 * @param string $class Additional container classes. Default ''.
	 * @param bool   $echo  Echo or return container classes. Default true.
	 *
	 * @return string|void
	 */
	function aesthetix_container_classes( $class = '', $echo = true ) {

		$classes = get_aesthetix_container_classes( $class );

		if ( $echo ) {
			echo 'class="' . esc_attr( implode( ' ', $classes ) ) . '"';
		} else {
			return 'class="' . esc_attr( implode( ' ', $classes ) ) . '"';
		}
	}
}

if ( ! function_exists( 'get_aesthetix_content_area_classes' ) ) {

	/**
	 * Get classes for main content area wrapper.
	 *
	 * @param string $class Additional content area classes. Default ''.
	 *
	 * @return array
	 */
	function get_aesthetix_content_area_classes( $class = '' ) {

		// Check the function has accepted any classes.
		if ( isset( $class ) && ! empty( $class ) ) {
			if ( is_array( $class ) ) {
				$classes = $class;
			} elseif ( is_string( $class ) ) {
				$classes = explode( ' ', $class );
			} else {
				$classes = array();
			}
		} else {
			$classes = array();
		}

		// Add elements to array.
		$classes[] = 'col-12';
		$classes[] = 'order-2';

		$sidebar = apply_filters( 'get_aesthetix_sidebar', 'main' );

		if ( is_active_sidebar( $sidebar ) ) {
			$classes[] = 'col-lg-8';
			$classes[] = 'col-xl-9';
			$classes[] = 'col-lg-state-change';
		}

		$classes[] = 'content-area';

		// Add filter to array.
		$classes = apply_filters( 'get_aesthetix_content_area_classes', $classes );
		$classes = array_unique( (array) $classes );
		sort( $classes );

		return $classes;
	}
}

if ( ! function_exists( 'aesthetix_content_area_classes' ) ) {

	/**
	 * Display classes for main content area wrapper.
	 *
	 * @param string $class Additional content area classes. Default ''.
	 * @param bool   $echo  Echo or return content area classes. Default true.
	 *
	 * @return string|void
	 */
	function aesthetix_content_area_classes( $class = '', $echo = true ) {

		$classes = get_aesthetix_content_area_classes( $class );

		if ( $echo ) {
			echo 'class="' . esc_attr( implode( ' ', $classes ) ) . '"';
		} else {
			return 'class="' . esc_attr( implode( ' ', $classes ) ) . '"';
		}
	}
}

if ( ! function_exists( 'get_aesthetix_widget_area_classes' ) ) {

	/**
	 * Get classes for sidebar widget area wrapper.
	 *
	 * @param string $class Additional widget area classes. Default ''.
	 *
	 * @return array
	 */
	function get_aesthetix_widget_area_classes( $class = '' ) {

		// Check the function has accepted any classes.
		if ( isset( $class ) && ! empty( $class ) ) {
			if ( is_array( $class ) ) {
				$classes = $class;
			} elseif ( is_string( $class ) ) {
				$classes = explode( ' ', $class );
			} else {
				$classes = array();
			}
		} else {
			$classes = array();
		}

		// Add elements to array.
		$classes[] = 'widget-area';

		$classes[] = 'col-12';
		$classes[] = 'col-lg-4';
		$classes[] = 'col-xl-3';

		if ( get_aesthetix_options( 'general_sidebar_align' ) === 'left' ) {
			$classes[] = 'order-3';
			$classes[] = 'order-lg-1';
		} else {
			$classes[] = 'order-3';
		}

		// Add filter to array.
		$classes = apply_filters( 'get_aesthetix_widget_area_classes', $classes );
		$classes = array_unique( (array) $classes );
		sort( $classes );

		return $classes;
	}
}

if ( ! function_exists( 'aesthetix_widget_area_classes' ) ) {

	/**
	 * Display classes for sidebar widget area wrapper.
	 *
	 * @param string $class Additional widget area classes. Default ''.
	 * @param bool   $echo  Echo or return widget area classes. Default true.
	 *
	 * @return string|void
	 */
	function aesthetix_widget_area_classes( $class = '', $echo = true ) {

		$classes = get_aesthetix_widget_area_classes( $class );

		if ( $echo ) {
			echo 'class="' . esc_attr( implode( ' ', $classes ) ) . '"';
		} else {
			return 'class="' . esc_attr( implode( ' ', $classes ) ) . '"';
		}
	}
}

if ( ! function_exists( 'get_aesthetix_menu_wrapper_classes' ) ) {

	/**
	 * Get classes for main menu.
	 *
	 * @param string $class Additional main menu classes. Default ''.
	 *
	 * @return array
	 */
	function get_aesthetix_menu_wrapper_classes( $class = '' ) {

		// Check the function has accepted any classes.
		if ( isset( $class ) && ! empty( $class ) ) {
			if ( is_array( $class ) ) {
				$classes = $class;
			} elseif ( is_string( $class ) ) {
				$classes = explode( ' ', $class );
			} else {
				$classes = array();
			}
		} else {
			$classes = array();
		}

		// Add elements to array.
		$classes[] = 'menu-wrap';

		if ( in_array( 'menu-primary', $classes, true ) ) {
			$classes[] = 'menu-wrap-' . get_aesthetix_options( 'general_menu_align' );
		}

		// Add filter to array.
		$classes = apply_filters( 'get_aesthetix_menu_wrapper_classes', $classes );
		$classes = array_unique( (array) $classes );
		sort( $classes );

		return $classes;
	}
}

if ( ! function_exists( 'aesthetix_menu_wrapper_classes' ) ) {

	/**
	 * Display classes for main menu.
	 *
	 * @param string $class Additional main menu classes. Default ''.
	 * @param bool   $echo  Echo or return main menu classes. Default true.
	 *
	 * @return string|void
	 */
	function aesthetix_menu_wrapper_classes( $class = '', $echo = true ) {

		$classes = get_aesthetix_menu_wrapper_classes( $class );

		if ( $echo ) {
			echo 'class="' . esc_attr( implode( ' ', $classes ) ) . '"';
		} else {
			return 'class="' . esc_attr( implode( ' ', $classes ) ) . '"';
		}
	}
}

if ( ! function_exists( 'get_aesthetix_meta_display_classes' ) ) {

	/**
	 * Get classes for meta display single template TWO.
	 *
	 * @param string $class Additional meta display classes. Default ''.
	 *
	 * @return array
	 */
	function get_aesthetix_meta_display_classes( $class = '' ) {

		// Check the function has accepted any classes.
		if ( isset( $class ) && ! empty( $class ) ) {
			if ( is_array( $class ) ) {
				$classes = $class;
			} elseif ( is_string( $class ) ) {
				$classes = explode( ' ', $class );
			} else {
				$classes = array();
			}
		} else {
			$classes = array();
		}

		// Add elements to array.
		$classes[] = 'post-meta';
		$classes[] = 'post-part';

		if ( get_aesthetix_options( 'single_' . get_post_type() . '_template_type' ) === 'two' ) {
			$classes[] = 'post-meta-block';
		} else {
			$classes[] = 'post-meta-inline';
		}

		// Add filter to array.
		$classes = apply_filters( 'get_aesthetix_meta_display_classes', $classes );
		$classes = array_unique( (array) $classes );
		sort( $classes );

		return $classes;
	}
}

if ( ! function_exists( 'aesthetix_meta_display_classes' ) ) {

	/**
	 * Display classes for meta display single template TWO.
	 *
	 * @param string $class  Additional meta display classes. Default ''.
	 * @param bool   $echo   Echo or return meta display classes. Default true.
	 *
	 * @return string|void
	 */
	function aesthetix_meta_display_classes( $class = '', $echo = true ) {

		$classes = get_aesthetix_meta_display_classes( $class );

		if ( $echo ) {
			echo 'class="' . esc_attr( implode( ' ', $classes ) ) . '"';
		} else {
			return 'class="' . esc_attr( implode( ' ', $classes ) ) . '"';
		}
	}
}

if ( ! function_exists( 'get_aesthetix_archive_page_columns_wrapper_classes' ) ) {

	/**
	 * Get classes for archive page wrapper columns.
	 *
	 * @param string $class Additional archive page columns wrapper classes. Default ''.
	 *
	 * @return array
	 */
	function get_aesthetix_archive_page_columns_wrapper_classes( $class = '' ) {

		// Check the function has accepted any classes.
		if ( isset( $class ) && ! empty( $class ) ) {
			if ( is_array( $class ) ) {
				$classes = $class;
			} elseif ( is_string( $class ) ) {
				$classes = explode( ' ', $class );
			} else {
				$classes = array();
			}
		} else {
			$classes = array();
		}

		if ( get_post_type() ) {
			$post_type = get_post_type();
		} else {
			$post_type = 'post';
		}

		// Add elements to array.
		$classes[] = 'row';

		if ( in_array( 'loop', $classes, true ) && get_aesthetix_options( 'archive_' . get_post_type() . '_masonry' ) ) {

			$classes[] = 'row-' . get_aesthetix_options( 'archive_' . $post_type . '_columns' ) . '-col';

			if ( get_aesthetix_options( 'archive_' . get_post_type() . '_masonry' ) ) {
				$classes[] = 'masonry-gallery';
			}
		}

		// Add filter to array.
		$classes = apply_filters( 'get_aesthetix_archive_page_columns_wrapper_classes', $classes );
		$classes = array_unique( (array) $classes );
		sort( $classes );

		return $classes;
	}
}

if ( ! function_exists( 'aesthetix_archive_page_columns_wrapper_classes' ) ) {

	/**
	 * Display classes for archive page wrapper columns.
	 *
	 * @param string $class Additional archive page columns wrapper classes. Default ''.
	 * @param bool   $echo  Echo or return archive page columns wrapper classes. Default true.
	 *
	 * @return string|void
	 */
	function aesthetix_archive_page_columns_wrapper_classes( $class = '', $echo = true ) {

		$classes = get_aesthetix_archive_page_columns_wrapper_classes( $class );

		if ( $echo ) {
			echo 'class="' . esc_attr( implode( ' ', $classes ) ) . '"';
		} else {
			return 'class="' . esc_attr( implode( ' ', $classes ) ) . '"';
		}
	}
}

if ( ! function_exists( 'get_aesthetix_archive_page_columns_classes' ) ) {

	/**
	 * Get classes for archive page columns.
	 *
	 * @param int    $counter       Сolumn counter in loop. Default null.
	 * @param string $class         Additional archive page columns classes. Default ''.
	 * @param string $columns_count Return classes with specified columns. Default null.
	 *
	 * @return array
	 */
	function get_aesthetix_archive_page_columns_classes( $counter = null, $class = '', $columns_count = null ) {

		// Check the function has accepted any classes.
		if ( isset( $class ) && ! empty( $class ) ) {
			if ( is_array( $class ) ) {
				$classes = $class;
			} elseif ( is_string( $class ) ) {
				$classes = explode( ' ', $class );
			} else {
				$classes = array();
			}
		} else {
			$classes = array();
		}

		// Add elements to array.
		$classes[] = 'col-12';
		$classes[] = 'post-col';

		if ( ! isset( $columns_count ) || is_null( $columns_count ) || empty( $columns_count ) ) {
			if ( get_post_type() ) {
				$post_type = get_post_type();
			} else {
				$post_type = 'post';
			}
			$columns_count = get_aesthetix_options( 'archive_' . $post_type . '_columns' );
		}

		// Default else is three columns.
		if ( (int) $columns_count === 6 ) {
			$classes[] = 'col-sm-6';
			$classes[] = 'col-lg-3';
			$classes[] = 'col-xl-2';
		} elseif ( (int) $columns_count === 5 ) {
			$classes[] = 'col-sm-6';
			$classes[] = 'col-lg-3';
			$classes[] = 'col-xl-5th';
		} elseif ( (int) $columns_count === 4 ) {
			$classes[] = 'col-sm-6';
			$classes[] = 'col-lg-4';
			$classes[] = 'col-xl-3';
		} elseif ( (int) $columns_count === 2 ) {
			$classes[] = 'col-sm-6';
		} elseif ( (int) $columns_count === 1 ) {
			$classes[] = 'col-sm-12';
		} else {
			$classes[] = 'col-sm-6';
			$classes[] = 'col-lg-4';
		}

		if ( get_aesthetix_options( 'archive_' . get_post_type() . '_masonry' ) ) {
			$classes[] = 'masonry-item';
		}

		// Add filter to array.
		$classes = apply_filters( 'get_aesthetix_archive_page_columns_classes', $classes, $counter );
		$classes = array_unique( (array) $classes );
		sort( $classes );

		return $classes;
	}
}

if ( ! function_exists( 'aesthetix_archive_page_columns_classes' ) ) {

	/**
	 * Display classes for archive page columns.
	 *
	 * @param int    $counter       Сolumn counter in loop. Default null.
	 * @param string $class         Additional archive page columns classes. Default ''.
	 * @param string $columns_count Return classes with specified columns. Default null.
	 * @param bool   $echo          Echo or return archive page columns classes. Default true.
	 *
	 * @return string|void
	 */
	function aesthetix_archive_page_columns_classes( $counter = null, $class = '', $columns_count = null, $echo = true ) {

		$classes = get_aesthetix_archive_page_columns_classes( $counter, $class, $columns_count );

		if ( $echo ) {
			echo 'class="' . esc_attr( implode( ' ', $classes ) ) . '"';
		} else {
			return 'class="' . esc_attr( implode( ' ', $classes ) ) . '"';
		}
	}
}

if ( ! function_exists( 'get_button_classes' ) ) {

	/**
	 * Get classes for buttons.
	 *
	 * @param string       $class Additional button classes. Default ''.
	 * @param array|string $args {
	 *     Optional. Array or string of arguments to button classes.
	 *
	 *     @type string $button_size    Button type (xs, sm, md, lg, xl). Default 'root_button_size'.
	 *     @type string $button_color   Button color (primary, secondary, gray, default). Default 'primary'.
	 *     @type string $button_type    Button type (common, empty, gradient, slide). Default 'root_button_type'.
	 *     @type string $button_content Button content (common, empty, gradient, slide). Default null.
	 *     @type string $icon_position  Icon position (before, after). Default 'root_button_icon_position'.
	 * }
	 * 
	 * @return array
	 */
	function get_button_classes( $class = '', $args = array() ) {

		// Check the function has accepted any classes.
		if ( isset( $class ) && ! empty( $class ) ) {
			if ( is_array( $class ) ) {
				$classes = $class;
			} elseif ( is_string( $class ) ) {
				$classes = explode( ' ', $class );
			} else {
				$classes = array();
			}
		} else {
			$classes = array();
		}

		// Merge default args.
		$defaults = array(
			'button_size'          => get_aesthetix_options( 'root_button_size' ),
			'button_color'         => 'primary',
			'button_type'          => get_aesthetix_options( 'root_button_type' ),
			'button_content'       => 'button-icon-text',
			'button_border_width'  => get_aesthetix_options( 'root_button_border_width' ),
			'button_border_radius' => get_aesthetix_options( 'root_button_border_radius' ),
			'icon_position'        => get_aesthetix_options( 'root_button_icon_position' ),
		);

		$args = wp_parse_args( $args, $defaults );

		$classes[] = 'button';

		if ( ! in_array( 'button-reset', $classes, true ) && ! in_array( 'button-none', $classes, true ) ) {
			if ( $args['button_type'] === 'common' ) {
				$classes[] = 'button-' . $args['button_color'];
			} elseif ( $args['button_type'] === 'empty' ) {
				$classes[] = 'button-' . $args['button_type'];
			} else {
				$classes[] = 'button-' . $args['button_type'];
				$classes[] = 'button-' . $args['button_type'] . '-' . $args['button_color'];
			}
		}

		if ( in_array( $args['button_content'], array( 'button-icon' ), true ) ) {
			$classes[] = 'button-icon';

			if ( in_array( 'search-submit', $classes, true ) ) {
				$classes[] = 'button-icon_long';
			}
		}

		if ( in_array( 'icon', $classes, true ) || in_array( $args['button_content'], array( 'button-icon-text', 'button-icon', 'link-icon-text', 'text-icon', 'icon' ) ) ) {
			$classes = get_icon_classes( $classes, $args );
		}

		if ( in_array( 'link', $classes, true ) || in_array( $args['button_content'], array( 'link-icon-text', 'link-text' ) ) ) {
			$classes = get_link_classes( $classes, $args );
		}

		// Add buton resets classes.
		if ( in_array( $args['button_content'], array( 'link-icon-text', 'link-text', 'text-icon', 'text', 'icon' ) ) ) {
			foreach ( $classes as $key => $class ) {
				if ( stripos( $class, 'button' ) !== false && ! in_array( $class, array( 'notification-button', 'cookie-button', 'popup-button', 'dropdown-button' ), true ) ) {
					unset( $classes[ $key ] );
				}
			}
		}

		$size_exists = false;
		foreach ( get_aesthetix_customizer_button_sizes() as $key => $size ) {
			if ( in_array( 'button-' . $key, $classes, true ) ) {
				$size_exists = true;
			}
		}

		if ( $size_exists === false ) {
			$classes[] = 'button-' . $args['button_size'];
		}

		if ( in_array( $args['button_content'], array( 'link-icon-text', 'link-text' ) ) ) {
			$classes[] = 'button-reset';
			$classes[] = 'button-link-reset';
		}

		if ( in_array( $args['button_content'], array( 'text-icon', 'text' ) ) ) {
			$classes[] = 'button-reset';
			$classes[] = 'button-text-reset';
		}

		if ( in_array( $args['button_content'], array( 'icon' ) ) ) {
			$classes[] = 'button-reset';
			$classes[] = 'button-icon-reset';
		}

		// Add filter to array.
		$classes = apply_filters( 'get_button_classes', $classes, $args );
		$classes = array_unique( (array) $classes );
		sort( $classes );

		return $classes;
	}
}

if ( ! function_exists( 'button_classes' ) ) {

	/**
	 * Display classes for buttons.
	 *
	 * @param string       $class Additional button classes. Default ''.
	 * @param array|string $args {
	 *     Optional. Array or string of arguments to button classes.
	 *
	 *     @type string $button_size    Button type (xs, sm, md, lg, xl). Default 'root_button_size'.
	 *     @type string $button_color   Button color (primary, secondary, gray, default). Default 'primary'.
	 *     @type string $button_type    Button type (common, empty, gradient, slide). Default 'root_button_type'.
	 *     @type string $button_content Button content (common, empty, gradient, slide). Default null.
	 *     @type string $icon_position  Icon position (before, after). Default 'root_button_icon_position'.
	 * }
	 * @param bool         $echo Echo or return button classes. Default true.
	 *
	 * @return string|void
	 */
	function button_classes( $class = '', $args = array(), $echo = true ) {

		$classes = get_button_classes( $class, $args );

		if ( $echo ) {
			echo 'class="' . esc_attr( implode( ' ', $classes ) ) . '"';
		} else {
			return 'class="' . esc_attr( implode( ' ', $classes ) ) . '"';
		}
	}
}

if ( ! function_exists( 'get_icon_classes' ) ) {

	/**
	 * Get classes for icons.
	 *
	 * @param string       $class Additional icon classes. Default ''.
	 * @param array|string $args {
	 *     Optional. Array or string of arguments to icon classes.
	 *
	 *     @type string $button_size    Button type (xs, sm, md, lg, xl). Default 'root_button_size'.
	 *     @type string $button_color   Button color (primary, secondary, gray, default). Default 'primary'.
	 *     @type string $button_type    Button type (common, empty, gradient, slide). Default 'root_button_type'.
	 *     @type string $button_content Button content (common, empty, gradient, slide). Default null.
	 *     @type string $icon_position  Icon position (before, after). Default 'root_button_icon_position'.
	 * }
	 * 
	 * @return array
	 */
	function get_icon_classes( $class = '', $args = array() ) {

		// Check the function has accepted any classes.
		if ( isset( $class ) && ! empty( $class ) ) {
			if ( is_array( $class ) ) {
				$classes = $class;
			} elseif ( is_string( $class ) ) {
				$classes = explode( ' ', $class );
			} else {
				$classes = array();
			}
		} else {
			$classes = array();
		}

		// Merge default args.
		$defaults = array(
			'icon_size'      => 'md',
			'button_content' => 'icon',
			'icon_position'  => get_aesthetix_options( 'root_button_icon_position' ),
		);

		$args = wp_parse_args( $args, $defaults );

		$classes[] = 'icon';

		if ( in_array( $args['button_content'], array( 'icon' ), true ) ) {
			$classes[] = 'icon-' . $args['icon_size'];
			$classes[] = 'icon-reset';
		}

		// Add globalicon position.
		if ( in_array( $args['button_content'], array( 'button-icon-text', 'link-icon-text', 'text-icon' ), true ) && ! in_array( 'icon-before', $classes, true ) && ! in_array( 'icon-after', $classes, true ) ) {
			$classes[] = 'icon-' . $args['icon_position'];
		}

		if ( in_array( $args['button_content'], array( 'button-icon', 'icon' ), true ) ) {
			if ( array_search ( 'icon-before', $classes ) ) {
				unset( $classes[ array_search ( 'icon-before', $classes ) ] );
			}
			if ( array_search ( 'icon-after', $classes ) ) {
				unset( $classes[ array_search ( 'icon-after', $classes ) ] );
			}
		}

		// Remove all icon classes if the content does not imply the presence of an icon
		if ( in_array( $args['button_content'], array( 'button-text', 'link-text', 'text' ), true ) ) {
			foreach ( $classes as $key => $class ) {
				if ( stripos( $class, 'icon' ) !== false ) {
					unset( $classes[ $key ] );
				}
			}
		}

		// Add filter to array.
		$classes = apply_filters( 'get_icon_classes', $classes, $args );
		$classes = array_unique( (array) $classes );
		sort( $classes );

		return $classes;
	}
}

if ( ! function_exists( 'icon_classes' ) ) {

	/**
	 * Display classes for icons.
	 *
	 * @param string       $class Additional icon classes. Default ''.
	 * @param array|string $args {
	 *     Optional. Array or string of arguments to icon classes.
	 *
	 *     @type string $button_size    Button type (xs, sm, md, lg, xl). Default 'root_button_size'.
	 *     @type string $button_color   Button color (primary, secondary, gray, default). Default 'primary'.
	 *     @type string $button_type    Button type (common, empty, gradient, slide). Default 'root_button_type'.
	 *     @type string $button_content Button content (common, empty, gradient, slide). Default null.
	 *     @type string $icon_position  Icon position (before, after). Default 'root_button_icon_position'.
	 * }
	 * @param bool         $echo Echo or return icon classes. Default true.
	 *
	 * @return string|void
	 */
	function icon_classes( $class = '', $args = array(), $echo = true ) {

		$classes = get_icon_classes( $class, $args );

		if ( $echo ) {
			echo 'class="' . esc_attr( implode( ' ', $classes ) ) . '"';
		} else {
			return 'class="' . esc_attr( implode( ' ', $classes ) ) . '"';
		}
	}
}

if ( ! function_exists( 'get_link_classes' ) ) {

	/**
	 * Get classes for links.
	 *
	 * @param string       $class Link classes. Default ''.
	 * @param array|string $args {
	 *     Optional. Array or string of arguments to link classes.
	 *
	 *     @type string $button_size    Button type (xs, sm, md, lg, xl). Default 'root_button_size'.
	 *     @type string $button_content Button content (common, empty, gradient, slide). Default null.
	 *     @type string $icon_position  Icon position (before, after). Default 'root_button_icon_position'.
	 * }
	 *
	 * @return array
	 */
	function get_link_classes( $class = '', $args = array() ) {

		// Check the function has accepted any classes.
		if ( isset( $class ) && ! empty( $class ) ) {
			if ( is_array( $class ) ) {
				$classes = $class;
			} elseif ( is_string( $class ) ) {
				$classes = explode( ' ', $class );
			} else {
				$classes = array();
			}
		} else {
			$classes = array();
		}

		// Merge default args.
		$defaults = array(
			'button_size'    => 'md',
			'button_content' => null,
			'icon_position'  => get_aesthetix_options( 'root_button_icon_position' ),
		);

		$args = wp_parse_args( $args, $defaults );

		// Add elements to array.
		$classes[] = 'link';

		$size_exists = false;
		foreach ( get_aesthetix_customizer_sizes() as $key => $size ) {
			if ( in_array( 'link-' . $key, $classes, true ) ) {
				$size_exists = true;
			}
		}

		if ( ! $size_exists ) {
			$classes[] = 'link-' . $args['button_size'];
		}

		if ( in_array( 'link-phone', $classes, true ) ) {
			$classes[] = 'link-color-border';
		}

		if ( ! in_array( 'link-color-border', $classes, true ) ) {
			$classes[] = 'link-color-unborder';
		}

		// Add filter to array.
		$classes = apply_filters( 'get_link_classes', $classes );
		$classes = array_unique( (array) $classes );
		sort( $classes );

		return $classes;
	}
}

if ( ! function_exists( 'link_classes' ) ) {

	/**
	 * Display classes for links.
	 *
	 * @param string       $class Additional link classes. Default ''.
	 * @param array|string $args {
	 *     Optional. Array or string of arguments to link classes.
	 *
	 *     @type string $button_size    Button type (xs, sm, md, lg, xl). Default 'root_button_size'.
	 *     @type string $button_content Button content (common, empty, gradient, slide). Default null.
	 *     @type string $icon_position  Icon position (before, after). Default 'root_button_icon_position'.
	 * }
	 * @param bool   $echo  Echo or return link classes. Default true.
	 *
	 * @return string|void
	 */
	function link_classes( $class = '', $args = array(), $echo = true ) {

		$classes = get_link_classes( $class, $args );

		if ( $echo ) {
			echo 'class="' . esc_attr( implode( ' ', $classes ) ) . '"';
		} else {
			return 'class="' . esc_attr( implode( ' ', $classes ) ) . '"';
		}
	}
}

if ( ! function_exists( 'get_input_classes' ) ) {

	/**
	 * Get classes for inputs.
	 *
	 * @param string $class       Input classes. Default ''.
	 * @param string $button_size Input size (xs, sm, md, lg, xl). Default null.
	 *
	 * @return array
	 */
	function get_input_classes( $class = '', $button_size = null ) {

		// Check the function has accepted any classes.
		if ( isset( $class ) && ! empty( $class ) ) {
			if ( is_array( $class ) ) {
				$classes = $class;
			} elseif ( is_string( $class ) ) {
				$classes = explode( ' ', $class );
			} else {
				$classes = array();
			}
		} else {
			$classes = array();
		}

		// Add elements to array.
		$classes[] = 'input';

		if ( is_null( $button_size ) ) {
			$size_exists = false;
			foreach ( get_aesthetix_customizer_button_sizes() as $key => $size ) {
				if ( in_array( 'button-' . $key, $classes, true ) ) {
					$size_exists = true;
				}
			}

			if ( ! $size_exists ) {
				$classes[]  = 'input-' . get_aesthetix_options( 'root_input_size' );
			}
		} else {
			$classes[]  = 'input-' . $button_size;
		}

		// Add filter to array.
		$classes = apply_filters( 'get_input_classes', $classes );
		$classes = array_unique( (array) $classes );
		sort( $classes );

		return $classes;
	}
}

if ( ! function_exists( 'input_classes' ) ) {

	/**
	 * Display classes for inputs.
	 *
	 * @param string $class Additional input classes. Default ''.
	 * @param bool   $echo  Echo or return input classes. Default true.
	 *
	 * @return string|void
	 */
	function input_classes( $class = '', $echo = true ) {

		$classes = get_input_classes( $class );

		if ( $echo ) {
			echo 'class="' . esc_attr( implode( ' ', $classes ) ) . '"';
		} else {
			return 'class="' . esc_attr( implode( ' ', $classes ) ) . '"';
		}
	}
}

if ( ! function_exists( 'get_widgets_classes' ) ) {

	/**
	 * Get classes for widgets.
	 *
	 * @param string $class      Widgets classes. Default ''.
	 * @param string $sidebar_id Sidebar ID. Default null.
	 *
	 * @return array
	 */
	function get_widgets_classes( $class = '', $sidebar_id = null ) {

		// Check the function has accepted any classes.
		if ( isset( $class ) && ! empty( $class ) ) {
			if ( is_array( $class ) ) {
				$classes = $class;
			} elseif ( is_string( $class ) ) {
				$classes = explode( ' ', $class );
			} else {
				$classes = array();
			}
		} else {
			$classes = array();
		}

		// Add elements to array.
		$classes[] = 'widgets';

		if ( ! is_null( $sidebar_id ) ) {

			$classes[] = 'widgets-' . $sidebar_id;

			if ( in_array( $sidebar_id, array( 'after-header', 'before-footer' ), true ) ) {
				$classes[] = 'section-widgets';
			}

			if ( in_array( $sidebar_id, array( 'header-mobile-left', 'header-mobile-center', 'header-mobile-right', 'header-main-left', 'header-top-left', 'header-top-right', 'header-main-left', 'header-main-center', 'header-main-right', 'header-bottom-left', 'header-bottom-center', 'header-bottom-right', 'footer-top-left', 'footer-top-right', 'footer-bottom-left', 'footer-bottom-right' ), true ) ) {
				
				$classes[] = 'd-flex';

				if ( in_array( $sidebar_id, array( 'header-top-left', 'header-top-right', 'footer-bottom-left', 'footer-bottom-right' ), true ) ) {

					$classes[] = 'widgets-md-inline';
					$classes[] = 'align-items-md-center';

					if ( str_contains( $sidebar_id, 'left' ) ) {
						$classes[] = 'justify-content-md-start';
					} elseif ( str_contains( $sidebar_id, 'right' ) ) {
						$classes[] = 'justify-content-md-end';
					} elseif ( str_contains( $sidebar_id, 'center' ) ) {
						$classes[] = 'justify-content-md-center';
					}
				} elseif ( in_array( $sidebar_id, array( 'footer-top-left', 'footer-top-right' ), true ) ) {

					$classes[] = 'widgets-sm-inline';
					$classes[] = 'align-items-sm-center';

					if ( str_contains( $sidebar_id, 'left' ) ) {
						$classes[] = 'justify-content-sm-start';
					} elseif ( str_contains( $sidebar_id, 'right' ) ) {
						// $classes[] = 'justify-content-sm-end';
					} elseif ( str_contains( $sidebar_id, 'center' ) ) {
						$classes[] = 'justify-content-sm-center';
					}

				} else {

					$classes[] = 'widgets-inline';
					$classes[] = 'align-items-center';

					if ( str_contains( $sidebar_id, 'left' ) ) {
						$classes[] = 'justify-content-start';
					} elseif ( str_contains( $sidebar_id, 'right' ) ) {
						$classes[] = 'justify-content-end';
					} elseif ( str_contains( $sidebar_id, 'center' ) ) {
						$classes[] = 'justify-content-center';
					}

				}
			}

			if ( ! in_array( 'widgets-inline', $classes, true ) ) {
				$classes[] = 'widgets-block';
			}

			if ( $sidebar_id === 'main' && get_aesthetix_options( 'general_sidebar_stuck' ) ) {
				$classes[] = 'sidebar-main';
				$classes[] = 'sidebar-stuck';
			}
		}

		// Add filter to array.
		$classes = apply_filters( 'get_widgets_classes', $classes );
		$classes = array_unique( (array) $classes );
		sort( $classes );

		return $classes;
	}
}

if ( ! function_exists( 'widgets_classes' ) ) {

	/**
	 * Display classes for widgets.
	 *
	 * @param string $class Additional widgets classes. Default ''.
	 * @param string $sidebar_id Sidebar ID. Default null.
	 * @param bool   $echo  Echo or return widgets classes.
	 *
	 * @return string|void
	 */
	function widgets_classes( $class = '', $sidebar_id = null, $echo = true ) {

		$classes = get_widgets_classes( $class, $sidebar_id );

		if ( $echo ) {
			echo 'class="' . esc_attr( implode( ' ', $classes ) ) . '"';
		} else {
			return 'class="' . esc_attr( implode( ' ', $classes ) ) . '"';
		}
	}
}

if ( ! function_exists( 'get_widget_classes' ) ) {

	/**
	 * Get classes for widgets.
	 *
	 * @param string $class      Widget classes. Default ''.
	 * @param string $sidebar_id Sidebar ID. Default null.
	 * @param string $background Background type. Default null.
	 *
	 * @return array
	 */
	function get_widget_classes( $class = '', $sidebar_id = null, $background = null ) {

		// Check the function has accepted any classes.
		if ( isset( $class ) && ! empty( $class ) ) {
			if ( is_array( $class ) ) {
				$classes = $class;
			} elseif ( is_string( $class ) ) {
				$classes = explode( ' ', $class );
			} else {
				$classes = array();
			}
		} else {
			$classes = array();
		}

		if ( is_null( $background ) ) {
			$background = get_aesthetix_options( 'root_bg_aside_widgets' );
		}

		// Add elements to array.
		$classes[] = 'widget';

		if ( ! is_null( $sidebar_id ) ) {
			$classes[] = 'widget-' . $sidebar_id;

			if ( in_array( $sidebar_id, array( 'header-mobile-left', 'header-mobile-center', 'header-mobile-right', 'header-main-left', 'header-top-left', 'header-top-right', 'header-main-left', 'header-main-center', 'header-main-right', 'header-bottom-left', 'header-bottom-center', 'header-bottom-right', 'footer-top-left', 'footer-top-right', 'footer-bottom-left', 'footer-bottom-right' ), true ) ) {
				$classes[] = 'd-flex';
			}

			if ( in_array( $sidebar_id, array( 'main', 'background', 'before-post-content', 'after-post-content' ), true ) && $background !== 'theme' ) {
				$classes[] = 'widget-background';
				$classes[] = 'widget-' . $background;
			}
		}

		// Add filter to array.
		$classes = apply_filters( 'get_widget_classes', $classes, $sidebar_id );
		$classes = array_unique( (array) $classes );
		sort( $classes );

		return $classes;
	}
}

if ( ! function_exists( 'widget_classes' ) ) {

	/**
	 * Display classes for widgets.
	 *
	 * @param string $class      Additional widget classes. Default ''.
	 * @param string $sidebar_id Sidebar ID. Default null.
	 * @param string $background Background type. Default null.
	 * @param bool   $echo       Echo or return widget classes.
	 *
	 * @return string|void
	 */
	function widget_classes( $class = '', $sidebar_id = null, $background = null, $echo = true ) {

		$classes = get_widget_classes( $class, $sidebar_id, $background );

		if ( $echo ) {
			echo 'class="' . esc_attr( implode( ' ', $classes ) ) . '"';
		} else {
			return 'class="' . esc_attr( implode( ' ', $classes ) ) . '"';
		}
	}
}
