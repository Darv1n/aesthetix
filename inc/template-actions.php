<?php
/**
 * Template actions
 *
 * @package Aesthetix
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'aesthetix_pre_get_posts' ) ) {

	/**
	 * Function for 'pre_get_posts' action hook.
	 *
	 * @param WP_Query $query The WP_Query instance (passed by reference).
	 *
	 * @link https://developer.wordpress.org/reference/hooks/pre_get_posts/
	 *
	 * @return void
	 * 
	 * @since 1.0.0
	 */
	function aesthetix_pre_get_posts( $query ) {

		// Exit if is admin or not main query request.
		if ( is_admin() || ! $query->is_main_query() ) {
			return;
		}

		// Sort search results by post_type.
		if ( $query->is_search ) {
			$query->set( 'orderby', 'type' );
			$query->set( 'posts_per_page', 36 );
		}

		// Sort post by aesthetix option.
		if ( $query->is_archive ) {

			$post_type = $query->get( 'post_type' ) ?? 'post';

			if ( get_aesthetix_options( 'archive_' . $post_type . '_posts_per_page' ) ) {
				$query->set( 'posts_per_page', get_aesthetix_options( 'archive_' . $post_type . '_posts_per_page' ) );
			}

			if ( get_aesthetix_options( 'archive_' . $post_type . '_posts_order' ) ) {
				$query->set( 'order', get_aesthetix_options( 'archive_' . $post_type . '_posts_order' ) );
			}

			if ( get_aesthetix_options( 'archive_' . $post_type . '_posts_orderby' ) ) {
				$query->set( 'orderby', get_aesthetix_options( 'archive_' . $post_type . '_posts_orderby' ) );
			}
		}
	}
}
add_action( 'pre_get_posts', 'aesthetix_pre_get_posts', 1 );

if ( ! function_exists( 'aesthetix_first_screen' ) ) {

	/**
	 * Display first screen on action hook before_site_content.
	 * 
	 * @since 1.1.0
	 */
	function aesthetix_first_screen( $before = '', $after  = '' ) {

		if ( is_front_page() || is_home() && get_aesthetix_options( 'front_page_slider_display' ) ) {

			$output    = '';
			$i         = 0;
			$post_type = get_aesthetix_options( 'front_page_slider_post_type' );

			$args = array(
				'posts_per_page' => (int) get_aesthetix_count_columns( get_aesthetix_options( 'front_page_slider_slides_count' ) ),
				'post_type'      => $post_type,
			);

			$query = new WP_Query( $args );

			if ( $query->have_posts() ) { ?>

				<section id="first-screen" class="section section_fisrt-screen">
					<div <?php aesthetix_container_classes(); ?>>
						<div class="slick-slider">

						<?php while ( $query->have_posts() ) {
							$query->the_post(); ?>

							<div class="slick-item">

								<?php
									// Get a template with a post type, if there is one in the theme.
									if ( file_exists( get_theme_file_path( 'templates/archive/archive-content-type-' . $post_type . '.php' ) ) ) {
										get_template_part( 'templates/archive/archive-content-type', $post_type, array( 'counter' => $i ) );
									} else if ( get_aesthetix_options( 'front_page_slider_slides_template_type' ) ) {
										get_template_part( 'templates/archive/archive-content-type', get_aesthetix_options( 'front_page_slider_slides_template_type' ), array( 'counter' => $i ) );
									} else {
										get_template_part( 'templates/archive/archive-content-type', 'tils', array( 'counter' => $i ) );
									}
								?>

							</div>

							<?php $i++;
						} ?>

						</div>
					</div>
				</section>

				<?php
			}

			wp_enqueue_style( 'slick-styles' );
			wp_enqueue_script( 'slick-scripts' );

			$breakpoints = array( 1200, 992, 768, 576 );
			$slick_args  = array(
				'arrows'         => true,
				'dots'           => false,
				'infinite'       => true,
				'speed'          => 300,
				'slidesToShow'   => 4,
				'slidesToScroll' => 1,
				'adaptiveHeight' => true,
			);

			$slides_to_show = (int) get_aesthetix_count_columns( get_aesthetix_options( 'front_page_slider_slides_to_show' ) ); 

			foreach ( $breakpoints as $key => $breakpoint ) {

				if ( $breakpoint === 1200 && $slides_to_show > 3 ) {
					$slick_args['responsive'][ $key ] = array(
						'breakpoint' => (int) $breakpoint,
						'settings'   => array(
							'slidesToShow'   => 4,
							'slidesToScroll' => 1,
						),
					);
				} else if ( $breakpoint === 992 && $slides_to_show > 2 ) {
					$slick_args['responsive'][ $key ] = array(
						'breakpoint' => (int) $breakpoint,
						'settings'   => array(
							'arrows' => false,
						),
					);
					if ( $slides_to_show > 2 ) {
						$slick_args['responsive'][ $key ]['settings']['slidesToShow']   = 3;
						$slick_args['responsive'][ $key ]['settings']['slidesToScroll'] = 1;
					}
				} else if ( $breakpoint === 768 && $slides_to_show > 1 ) {
					$slick_args['responsive'][ $key ] = array(
						'breakpoint' => (int) $breakpoint,
						'settings'   => array(
							'slidesToShow'   => 2,
							'slidesToScroll' => 1,
						),
					);
				} else {
					$slick_args['responsive'][ $key ] = array(
						'breakpoint' => (int) $breakpoint,
						'settings'   => array(
							'slidesToShow'   => 1,
							'slidesToScroll' => 1,
						),
					);
				}
			}

			$slick_init = 'jQuery(function($) {
				$(\'.slick-slider\').slick(' . json_encode( $slick_args, JSON_PRETTY_PRINT ) . ');
			});';

			wp_add_inline_script( 'slick-scripts', minify_js( $slick_init ) );
		}
	}
}
add_action( 'before_site_content', 'aesthetix_first_screen', 10 );

if ( ! function_exists( 'aesthetix_breadcrumbs' ) ) {

	/**
	 * Display breadcrumbs on action hook before_site_content.
	 * 
	 * @since 1.0.0
	 */
	function aesthetix_breadcrumbs( $before = '', $after  = '' ) {

		if ( ! is_front_page() && ! is_home() && get_aesthetix_options( 'general_breadcrumbs_display' ) ) {

			$before .= '<section id="section-breadcrumbs" class="section section_breadcrumbs">';
				$before .= '<div class="' . esc_attr( implode( ' ', get_aesthetix_container_classes() ) ) . '">';
					$before .= '<div class="row">';
						$before .= '<div class="col-12 align-items-center">';

						$after .= '</div>';
					$after .= '</div>';
				$after .= '</div>';
			$after .= '</section>';

			if ( get_aesthetix_options( 'general_breadcrumbs_type' ) === 'navxt' && is_plugin_active( 'breadcrumb-navxt/breadcrumb-navxt.php' ) ) {

				$before .= '<nav id="breadcrumbs" class="breadcrumbs breadcrumbs_' . esc_attr( get_aesthetix_options( 'general_breadcrumbs_type' ) ) . '" typeof="BreadcrumbList" vocab="https://schema.org/" aria-label="breadcrumb">';
					$before .= '<ol class="list-inline list-unstyled">';
					$after  .= '</ol>';
				$after  .= '</nav>';
			} else {
				$before .= '<div id="breadcrumbs" class="breadcrumbs breadcrumbs_' . esc_attr( get_aesthetix_options( 'general_breadcrumbs_type' ) ) . '">';
				$after  .= '</div>';
			}

			if ( get_aesthetix_options( 'general_breadcrumbs_type' ) === 'navxt' && is_plugin_active( 'breadcrumb-navxt/breadcrumb-navxt.php' ) ) {
				echo $before;
					bcn_display_list();
				echo $after;
			} elseif ( get_aesthetix_options( 'general_breadcrumbs_type' ) === 'kama' && class_exists( 'Kama_Breadcrumbs' ) ) {
				echo $before;
					kama_breadcrumbs();
				echo $after;
			} elseif ( get_aesthetix_options( 'general_breadcrumbs_type' ) === 'yoast' && is_plugin_active( 'wordpress-seo/wp-seo.php' ) ) {
				echo $before;
					yoast_breadcrumb( '<nav class="breadcrumbs__navigation">', '</nav>' );
				echo $after;
			} elseif ( get_aesthetix_options( 'general_breadcrumbs_type' ) === 'rankmath' && is_plugin_active( 'seo-by-rank-math/rank-math.php' ) ) {
				echo $before;
					rank_math_the_breadcrumbs();
				echo $after;
			} elseif ( get_aesthetix_options( 'general_breadcrumbs_type' ) === 'seopress' && is_plugin_active( 'wp-seopress/seopress.php' ) ) {
				echo $before;
					seopress_display_breadcrumbs();
				echo $after;
			} elseif ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
				echo $before;
					woocommerce_breadcrumb();
				echo $after;
			}
		}
	}
}
add_action( 'before_site_content', 'aesthetix_breadcrumbs', 15 );

if ( ! function_exists( 'aesthetix_section_content_wrapper_start' ) ) {

	/**
	 * Display section content wrapper start in header.php.
	 * 
	 * @since 1.0.0
	 */
	function aesthetix_section_content_wrapper_start() {

		$output = '<section id="section-content" class="section section_content" aria-label="' . _x( 'Content section', 'aesthetix' ) . '">';
			$output .= '<div class="' . esc_attr( implode( ' ', get_aesthetix_container_classes() ) ) . '">';
				$output .= '<div class="row">';

		// Filter html output.
		$output = apply_filters( 'aesthetix_section_content_wrapper_start', $output );

		echo $output;
	}
}
add_action( 'before_site_content', 'aesthetix_section_content_wrapper_start', 50 );

if ( ! function_exists( 'aesthetix_section_content_wrapper_end' ) ) {

	/**
	 * Display section content wrapper end in footer.php.
	 * 
	 * @since 1.0.0
	 */
	function aesthetix_section_content_wrapper_end() {

				$output = '</div>';
			$output .= '</div>';
		$output .= '</section>';

		// Filter html output.
		$output = apply_filters( 'aesthetix_section_content_wrapper_end', $output );

		echo $output;
	}
}
add_action( 'after_site_content', 'aesthetix_section_content_wrapper_end', 50 );

