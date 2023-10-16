<?php
/**
 * Template wrappers.
 *
 * @since 1.0.0
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
	 * @since 1.0.0
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

		if ( is_404() ) {
			$classes[] = 'error-404';
		}

		if ( is_front_page() ) {
			$classes[] = 'front-page';
		}

		// Adds class with themename.
		$classes[] = 'theme_' . get_aesthetix_options( 'root_color_scheme' );
		$classes[] = 'theme_' . get_aesthetix_options( 'general_container_width' );
		$classes   = array_unique( (array) $classes );
		sort( $classes );

		return $classes;
	}
}
add_filter( 'body_class', 'aesthetix_body_classes', 10 );

if ( ! function_exists( 'aesthetix_post_classes' ) ) {

	/**
	 * Add custom classes to the array of post classes.
	 * 
	 * @since 1.0.0
	 *
	 * @param string $classes post classes.
	 *
	 * @return array
	 */
	function aesthetix_post_classes( $classes ) {

		$format = get_post_format();
		if ( ! $format ) {
			$format = 'standard';
		}

		if ( in_array( 'hentry', $classes, true ) ) {
			unset( $classes[ array_search( 'hentry', $classes ) ] );
		}
		if ( in_array( 'post-' . get_the_ID(), $classes, true ) ) {
			unset( $classes[ array_search( 'post-' . get_the_ID(), $classes ) ] );
		}
		if ( in_array( 'type-' . get_post_type(), $classes, true ) ) {
			unset( $classes[ array_search( 'type-' . get_post_type(), $classes ) ] );
		}
		if ( in_array( get_post_type(), $classes, true ) ) {
			unset( $classes[ array_search( get_post_type(), $classes ) ] );
		}
		if ( in_array( 'status-' . get_post_status(), $classes, true ) ) {
			unset( $classes[ array_search( 'status-' . get_post_status(), $classes ) ] );
		}
		if ( in_array( 'format-' . $format, $classes, true ) ) {
			unset( $classes[ array_search( 'format-' . $format, $classes ) ] );
		}

		$taxonomy_names = get_object_taxonomies( get_post_type() );

		foreach ( $taxonomy_names as $key => $taxonomy ) {
			$terms = get_the_terms( get_the_ID(), $taxonomy );
			if ( $terms ) {
				foreach ( get_the_terms( get_the_ID(), $taxonomy ) as $key => $term ) {

					if ( $taxonomy === 'post_tag' ) {
						$taxonomy = 'tag';
					}

					if ( in_array( $taxonomy . '-' . $term->slug, $classes, true ) ) {
						unset( $classes[ array_search( $taxonomy . '-' . $term->slug, $classes ) ] );
					}
				}
			}
		}

		$classes[] = 'post';
		$classes[] = 'post_' . get_post_type();
		$classes[] = get_post_type();

		// Crutch to distinguish single post template from archive template
		if ( ! in_array( 'post_single', $classes, true ) ) {
			$classes[] = 'post_archive';
			$classes[] = 'post_' . get_aesthetix_options( 'archive_' . get_post_type() . '_template_type' );
		}

		$classes = apply_filters( 'aesthetix_post_classes', $classes );
		$classes = array_unique( (array) $classes );
		sort( $classes );

		return $classes;
	}
}
add_filter( 'post_class', 'aesthetix_post_classes', 10 );

if ( ! function_exists( 'get_aesthetix_section_classes' ) ) {

	/**
	 * Get classes for section wrapper.
	 * 
	 * @since 1.1.2
	 *
	 * @param string $class Additional section classes.
	 *
	 * @return array
	 */
	function get_aesthetix_section_classes( $class = '' ) {

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
		$classes[] = 'section';

		if ( in_array( 'section_fisrt-screen', $classes, true ) || in_array( 'section_subscribe-form', $classes, true ) ) {

			$classes[] = 'container';

			if ( in_array( 'container-general', get_aesthetix_container_classes(), true ) ) {
				$classes[] = 'container-average';
			}

			if ( in_array( 'container-average', get_aesthetix_container_classes(), true ) ) {
				$classes[] = 'container-wide';
			}

			if ( in_array( 'container-wide', get_aesthetix_container_classes(), true ) ) {
				$classes[] = 'container-fluid';
			}

			$classes[] = 'section-rounded';
		}

		if ( in_array( 'section_subscribe-form', $classes, true ) ) {

			$classes[] = 'section-lg';

			if ( ! in_array( 'has_background', $classes, true ) ) {
				$classes[] = 'section-secondary';
			}
		}

		// Add filter to array.
		$classes = apply_filters( 'get_aesthetix_section_classes', $classes );
		$classes = array_unique( (array) $classes );
		sort( $classes );

		return $classes;
	}
}

if ( ! function_exists( 'aesthetix_section_classes' ) ) {

	/**
	 * Display classes for section wrapper.
	 * 
	 * @since 1.1.2
	 *
	 * @param string $class Additional section classes.
	 * @param bool   $echo  Echo or return section classes.
	 *
	 * @return string|void
	 */
	function aesthetix_section_classes( $class = '', $echo = true ) {

		$classes = get_aesthetix_section_classes( $class );

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
	 * @since 1.0.0
	 *
	 * @param string $class Additional container classes.
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
		$classes[] = 'container-' . get_aesthetix_options( 'general_container_width' );

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
	 * @since 1.0.0
	 *
	 * @param string $class Additional container classes.
	 * @param bool   $echo  Echo or return container classes.
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
	 * @since 1.0.0
	 *
	 * @param string $class Additional content area classes.
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
		$classes[] = 'order-1';
		$classes[] = 'col-sm-12';

		$sidebar = apply_filters( 'get_aesthetix_sidebar', 'sidebar' );

		if ( is_active_sidebar( $sidebar ) ) {
			$classes[] = 'col-lg-8';
			$classes[] = 'order-lg-2';
			$classes[] = 'col-xl-9';
		} else {
			if ( get_aesthetix_options( 'general_content_width' ) === 'narrow' ) {
				$classes[] = 'col-md-10';
				$classes[] = 'offset-md-1';
				$classes[] = 'col-lg-8';
				$classes[] = 'offset-lg-2';
			} else {
				$classes[] = 'col-md-12';
			}
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
	 * @since 1.0.0
	 *
	 * @param string $class Additional content area classes.
	 * @param bool   $echo  Echo or return content area classes.
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
	 * @since 1.0.0
	 *
	 * @param string $class Additional widget area classes.
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
		$classes[] = 'col-12';
		$classes[] = 'col-sm-12';
		$classes[] = 'col-lg-4';
		$classes[] = 'col-xl-3';

		$classes[] = 'widget-area';

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
	 * @since 1.0.0
	 *
	 * @param string $class Additional widget area classes.
	 * @param bool   $echo  Echo or return widget area classes.
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

if ( ! function_exists( 'get_aesthetix_header_classes' ) ) {

	/**
	 * Get classes for header container.
	 * 
	 * @since 1.0.0
	 *
	 * @param string $class Additional header classes.
	 *
	 * @return array
	 */
	function get_aesthetix_header_classes( $class = '' ) {

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
		$classes[] = 'header';

		if ( has_custom_header() ) {
			$classes[] = 'header_background-image';
		}

		if ( get_aesthetix_options( 'general_header_top_bar_display' ) ) {
			$classes[] = 'header_top-bar-active';
		}

		if ( get_aesthetix_options( 'general_header_type' ) === 'header-content' ) {
			$classes[] = 'header_content';
		} elseif ( get_aesthetix_options( 'general_header_type' ) === 'header-logo-center' ) {
			$classes[] = 'header_logo-center';
		} elseif ( get_aesthetix_options( 'general_header_type' ) === 'header-simple' ) {
			$classes[] = 'header_simple';
		}

		if ( is_admin_bar_showing() ) {
			$classes[] = 'is_wpadminbar';
		}

		$classes[] = 'header_menu_' . get_aesthetix_options( 'general_menu_position' );

		// Add filter to array.
		$classes = apply_filters( 'get_aesthetix_header_classes', $classes );
		$classes = array_unique( (array) $classes );
		sort( $classes );

		return $classes;
	}
}

if ( ! function_exists( 'aesthetix_header_classes' ) ) {

	/**
	 * Display classes for header container.
	 * 
	 * @since 1.0.0
	 *
	 * @param string $class Additional header classes.
	 * @param bool   $echo  Echo or return header classes.
	 *
	 * @return string|void
	 */
	function aesthetix_header_classes( $class = '', $echo = true ) {

		$classes = get_aesthetix_header_classes( $class );

		if ( $echo ) {
			echo 'class="' . esc_attr( implode( ' ', $classes ) ) . '"';
		} else {
			return 'class="' . esc_attr( implode( ' ', $classes ) ) . '"';
		}
	}
}

if ( ! function_exists( 'get_aesthetix_footer_classes' ) ) {

	/**
	 * Get classes for footer container.
	 * 
	 * @since 1.0.0
	 *
	 * @param string $class Additional footer classes.
	 *
	 * @return array
	 */
	function get_aesthetix_footer_classes( $class = '' ) {

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
		$classes[] = 'footer';

		if ( get_aesthetix_options( 'general_footer_bottom_bar_display' ) ) {
			$classes[] = 'footer_bottom-bar-active';
		}

		if ( get_aesthetix_options( 'general_footer_type' ) === 'footer-simple' ) {
			$classes[] = 'footer_simple';
		} elseif ( get_aesthetix_options( 'general_footer_type' ) === 'footer-three-columns' ) {
			$classes[] = 'footer_three-columns';
		} elseif ( get_aesthetix_options( 'general_footer_type' ) === 'footer-four-columns' ) {
			$classes[] = 'footer_four-columns';
		}

		// Add filter to array.
		$classes = apply_filters( 'get_aesthetix_footer_classes', $classes );
		$classes = array_unique( (array) $classes );
		sort( $classes );

		return $classes;
	}
}

if ( ! function_exists( 'aesthetix_footer_classes' ) ) {

	/**
	 * Display classes for footer container.
	 * 
	 * @since 1.0.0
	 *
	 * @param string $class Additional footer classes.
	 * @param bool   $echo  Echo or return footer classes.
	 *
	 * @return string|void
	 */
	function aesthetix_footer_classes( $class = '', $echo = true ) {

		$classes = get_aesthetix_footer_classes( $class );

		if ( $echo ) {
			echo 'class="' . esc_attr( implode( ' ', $classes ) ) . '"';
		} else {
			return 'class="' . esc_attr( implode( ' ', $classes ) ) . '"';
		}
	}
}

if ( ! function_exists( 'get_aesthetix_main_menu_classes' ) ) {

	/**
	 * Get classes for main menu.
	 * 
	 * @since 1.0.0
	 *
	 * @param string $class Additional main menu classes.
	 *
	 * @return array
	 */
	function get_aesthetix_main_menu_classes( $class = '' ) {

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
		$classes[] = 'main-menu';

		if ( get_aesthetix_options( 'general_menu_type' ) === 'menu-open' ) {
			$classes[] = 'main-menu_type-open';
		} elseif ( get_aesthetix_options( 'general_menu_type' ) === 'menu-close' ) {
			$classes[] = 'main-menu_type-close';
		}

		if ( get_aesthetix_options( 'general_header_type' ) === 'header-simple' ) {
			$classes[] = 'main-menu_right';
		} else {
			$classes[] = 'main-menu_' . get_aesthetix_options( 'general_menu_align' );
		}

		$classes[] = 'main-menu_' . get_aesthetix_options( 'general_menu_position' );

		// Add filter to array.
		$classes = apply_filters( 'get_aesthetix_main_menu_classes', $classes );
		$classes = array_unique( (array) $classes );
		sort( $classes );

		return $classes;
	}
}

if ( ! function_exists( 'aesthetix_main_menu_classes' ) ) {

	/**
	 * Display classes for main menu.
	 * 
	 * @since 1.0.0
	 *
	 * @param string $class Additional main menu classes.
	 * @param bool   $echo  Echo or return main menu classes.
	 *
	 * @return string|void
	 */
	function aesthetix_main_menu_classes( $class = '', $echo = true ) {

		$classes = get_aesthetix_main_menu_classes( $class );

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
	 * @since 1.0.0
	 *
	 * @param string $class Additional meta display classes.
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
		$classes[] = 'post__part';
		$classes[] = 'post__meta';
		$classes[] = 'post-meta';

		if ( get_aesthetix_options( 'single_' . get_post_type() . '_template_type' ) === 'two' ) {
			$classes[] = 'post-meta_block';
		} else {
			$classes[] = 'post-meta_inline';
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
	 * @since 1.0.0
	 *
	 * @param array  $args   Array with params for function:
	 * @param string $class Additional meta display classes.
	 * @param bool   $echo  Echo or return meta display classes.
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
	 * @since 1.0.0
	 *
	 * @param string $class Additional archive page columns wrapper classes.
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

		// Add elements to array.
		$classes[] = 'row';
		$classes[] = 'row-' . get_aesthetix_count_columns( get_aesthetix_options( 'archive_post_columns' ) ) . '-col';

		if ( in_array( 'loop', $classes, true ) && get_aesthetix_options( 'archive_' . get_post_type() . '_masonry' ) ) {
			$classes[] = 'masonry-gallery';
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
	 * @since 1.0.0
	 *
	 * @param string $class Additional archive page columns wrapper classes.
	 * @param bool   $echo  Echo or return archive page columns wrapper classes.
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

if ( ! function_exists( 'get_aesthetix_count_columns' ) ) {

	/**
	 * Get int count archive page columns.
	 * 
	 * @since 1.0.0
	 *
	 * @param string $control Text count columns.
	 * @param bool   $int     Need return int or not.
	 *
	 * @return array
	 */
	function get_aesthetix_count_columns( $control = null, $int = true ) {

		if ( is_null( $control ) || empty( $control ) ) {
			$control = get_aesthetix_options( 'archive_' . get_post_type() . '_columns' );
		}

		$converter = array(
			'one'   => 1,
			'two'   => 2,
			'three' => 3,
			'four'  => 4,
			'five'  => 5,
			'six'   => 6,
			'seven' => 7,
			'eight' => 8,
			'nine'  => 9,
			'ten'   => 10,
		);

		if ( $int || ( $control && array_key_exists( $control, $converter ) ) ) {
			return strtr( $control, $converter );
		} else {
			return strtr( intval( $control ), array_flip( $converter ) );
		}
	}
}

if ( ! function_exists( 'get_aesthetix_archive_page_columns_classes' ) ) {

	/**
	 * Get classes for archive page columns.
	 * 
	 * @since 1.0.0
	 *
	 * @param int    $counter       Сolumn counter in loop.
	 * @param string $class         Additional archive page columns classes.
	 * @param string $columns_count Return classes with specified columns.
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

		if ( is_int( intval( $columns_count ) ) && intval( $columns_count ) > 0 && intval( $columns_count ) <= 6 ) {
			$columns_count = get_aesthetix_count_columns( $columns_count, false );
		}

		// Default else is three columns.
		if ( $columns_count === 'six' ) {
			$classes[] = 'col-sm-6';
			$classes[] = 'col-lg-3';
			$classes[] = 'col-xl-2';
		} elseif ( $columns_count === 'five' ) {
			$classes[] = 'col-sm-6';
			$classes[] = 'col-lg-3';
			$classes[] = 'col-xl-5th';
		} elseif ( $columns_count === 'four' ) {
			$classes[] = 'col-sm-6';
			$classes[] = 'col-lg-4';
			$classes[] = 'col-xl-3';
		} elseif ( $columns_count === 'two' ) {
			$classes[] = 'col-sm-6';
		} elseif ( $columns_count === 'one' ) {
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
	 * @since 1.0.0
	 *
	 * @param int    $counter       Сolumn counter in loop.
	 * @param string $class         Additional archive page columns classes.
	 * @param string $columns_count Return classes with specified columns.
	 * @param bool   $echo          Echo or return archive page columns classes.
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
	 * @since 1.0.0
	 *
	 * @param string       $class Additional button classes.
	 * @param array|string $args {
	 *     Optional. Array or string of arguments to button classes.
	 *
	 *     @type string $button_size    Button type (xs, sm, md, lg, xl). Default 'root_button_size'.
	 *     @type string $button_color   Button color (primary, secondary, gray, default). Default 'primary'.
	 *     @type string $button_type    Button type (common, empty, gradient, slide). Default 'root_button_type'.
	 *     @type string $button_content Button content (common, empty, gradient, slide). Default null.
	 *     @type bool   $button_rounded Button rounded. Default false.
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
			'button_size'    => get_aesthetix_options( 'root_button_size' ),
			'button_color'   => 'primary',
			'button_type'    => get_aesthetix_options( 'root_button_type' ),
			'button_content' => null,
			'button_rounded' => false,
			'icon_position'  => get_aesthetix_options( 'root_button_icon_position' ),
		);

		$args = wp_parse_args( $args, $defaults );

		$classes[] = 'button';

		$size_exists = false;
		foreach ( get_aesthetix_customizer_sizes() as $key => $size ) {
			if ( in_array( 'button-' . $key, $classes, true ) ) {
				$size_exists = true;
			}
		}

		if ( ! $size_exists ) {
			$classes[]  = 'button-' . $args['button_size'];
		}

		if ( $args['button_rounded'] ) {
			$classes[] = 'button-rounded';
		}

		if ( ! is_null( $args['button_content'] ) ) {

			if ( in_array( $args['button_content'], array( 'button-icon', 'icon' ), true ) ) {
				$classes[] = 'button-icon';

				if ( in_array( 'search-submit', $classes, true ) ) {
					$classes[] = 'button-icon_long';
				}
			}

			if ( in_array( $args['button_content'], array( 'icon-text', 'text' ), true ) ) {
				$classes[] = 'button-text';
			}

			// If it's not a button.
			if ( ! in_array( $args['button_content'], array( 'button-icon-text', 'button-icon', 'button-text' ), true ) ) {
				$classes[] = 'button-none';
			}

			// If there is an icon.
			if ( in_array( 'icon', $classes, true ) ) {
				if ( in_array( $args['button_content'], array( 'button-icon', 'icon' ), true ) ) {
					$classes[] = 'icon_center';
				} elseif ( in_array( $args['button_type'], array( 'button-icon-text', 'icon-text' ), true ) ) {
					$classes[] = 'icon_' . $args['icon_position'];
				}
			}


		}

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

		// Add globalicon position.
		if ( in_array( 'icon', $classes, true ) ) {
			if ( ! in_array( 'icon_center', $classes, true ) && ! in_array( 'icon_before', $classes, true ) && ! in_array( 'icon_after', $classes, true ) ) {
				$classes[] = 'icon_' . $args['icon_position'];
			}
		}

		// Remove all icon classes if the option is disabled.
		// Remove all icon classes if the content does not imply the presence of an icon
		if ( ! get_aesthetix_options( 'root_button_icon' ) || ( ! is_null( $args['button_content'] ) && ! in_array( $args['button_content'], array( 'button-icon-text', 'button-icon', 'icon-text', 'icon' ), true ) ) ) {
			foreach ( $classes as $key => $class ) {
				if ( stripos( $class, 'icon' ) !== false ) {
					unset( $classes[ $key ] );
				}
			}
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
	 * @since 1.0.0
	 *
	 * @param string       $class Additional button classes.
	 * @param array|string $args {
	 *     Optional. Array or string of arguments to button classes.
	 *
	 *     @type string $button_size    Button type (xs, sm, md, lg, xl). Default 'root_button_size'.
	 *     @type string $button_color   Button color (primary, secondary, gray, default). Default 'primary'.
	 *     @type string $button_type    Button type (common, empty, gradient, slide). Default 'root_button_type'.
	 *     @type string $button_content Button content (common, empty, gradient, slide). Default null.
	 *     @type bool   $button_rounded Button rounded. Default false.
	 *     @type string $icon_position  Icon position (before, after). Default 'root_button_icon_position'.
	 * }
	 * @param bool         $echo Echo or return button classes.
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

if ( ! function_exists( 'get_link_classes' ) ) {

	/**
	 * Get classes for links.
	 * 
	 * @since 1.0.0
	 *
	 * @param string $class Link classes.
	 *
	 * @return array
	 */
	function get_link_classes( $class = '' ) {

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
		$classes[] = 'link';
		$classes[] = 'link-color-unborder';

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
	 * @since 1.0.0
	 *
	 * @param string $class Additional link classes.
	 * @param bool   $echo  Echo or return link classes.
	 *
	 * @return string|void
	 */
	function link_classes( $class = '', $echo = true ) {

		$classes = get_link_classes( $class );

		if ( $echo ) {
			echo 'class="' . esc_attr( implode( ' ', $classes ) ) . '"';
		} else {
			return 'class="' . esc_attr( implode( ' ', $classes ) ) . '"';
		}
	}
}

if ( ! function_exists( 'get_aesthetix_link_more_classes' ) ) {

	/**
	 * Get link more classes.
	 * 
	 * @since 1.0.0
	 *
	 * @param string $class Link more classes.
	 * @param string $color Link more color (primary, secondary, gray, default). Default 'primary'.
	 *
	 * @return array
	 */
	function get_aesthetix_link_more_classes( $class = '', $color = 'primary' ) {

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

		if ( get_aesthetix_options( 'archive_' . $post_type . '_detail_button' ) === 'button' ) {
			$classes[] = 'icon';
			$classes[] = 'icon_arrow-right';
			$classes   = get_button_classes( $classes, $color );
		} else {
			$classes[] = 'link_more';
			$classes   = get_link_classes( $classes );
		}

		// Add filter to array.
		$classes = apply_filters( 'get_aesthetix_link_more_classes', $classes );
		$classes = array_unique( (array) $classes );
		sort( $classes );

		return $classes;
	}
}

if ( ! function_exists( 'aesthetix_link_more_classes' ) ) {

	/**
	 * Display link more classes.
	 * 
	 * @since 1.0.0
	 *
	 * @param string $class Additional link more classes.
	 * @param string $color Link more color (primary, secondary, gray, default). Default 'primary'.
	 * @param bool   $echo  Echo or return link more classes.
	 *
	 * @return string|void
	 */
	function aesthetix_link_more_classes( $class = '', $color = 'primary', $echo = true ) {

		$classes = get_aesthetix_link_more_classes( $class, $color );

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
	 * @since 1.2.2
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
			foreach ( get_aesthetix_customizer_sizes() as $key => $size ) {
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
	 * @since 1.2.2
	 *
	 * @param string $class Additional input classes.
	 * @param bool   $echo  Echo or return input classes.
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
