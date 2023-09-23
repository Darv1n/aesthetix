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

if ( ! function_exists( 'aesthetix_page_speed_start' ) ) {

	/**
	 * Get start page generation time in a global variable.
	 */
	function aesthetix_page_speed_start() {
		$start_time             = microtime();
		$start_array            = explode( ' ', $start_time );
		$GLOBALS['start_times'] = $start_array[1] + $start_array[0]; // Пишем время в глобальную переменную.
	}
}
add_action( 'wp_head', 'aesthetix_page_speed_start', 1 );

if ( ! function_exists( 'aesthetix_page_speed_end' ) ) {

	/**
	 * Print page generation time in a comment at the bottom of the source code.
	 */
	function aesthetix_page_speed_end() {
		global $start_times; // получаем время из глобальной переменной.

		$end_time  = microtime();
		$end_array = explode( ' ', $end_time );
		$end_times = $end_array[1] + $end_array[0];
		$time      = $end_times - $start_times;

		sprintf( __( 'Page generated in %s seconds', 'aesthetix' ), esc_html( $time ) ); // Печатаем комментарий.
	}
}
add_action( 'wp_footer', 'aesthetix_page_speed_end', 90 );

if ( ! function_exists( 'aesthetix_seo_verification' ) ) {

	/**
	 * Add verification codes on wp_head hook.
	 */
	function aesthetix_seo_verification() {

		if ( get_aesthetix_options( 'other_yandex_verification' ) ) {
			echo '<meta name="yandex-verification" content="' . esc_html( get_aesthetix_options( 'other_yandex_verification' ) ) . '" />' . "\n";
		}
		if ( get_aesthetix_options( 'other_google_verification' ) ) {
			echo '<meta name="google-site-verification" content="' . esc_html( get_aesthetix_options( 'other_google_verification' ) ) . '" />' . "\n";
		}
		if ( get_aesthetix_options( 'other_mailru_verification' ) ) {
			echo '<meta name="pmail-verification" content="' . esc_html( get_aesthetix_options( 'other_mailru_verification' ) ) . '">' . "\n";
		}
	}
}
add_action( 'wp_head', 'aesthetix_seo_verification', 1 );

if ( ! function_exists( 'aesthetix_print_counters' ) ) {

	/**
	 * Print counters.
	 */
	function aesthetix_print_counters() {

		if ( get_aesthetix_options( 'other_google_counter' ) ) {
			echo '<!-- Global site tag (gtag.js) - Google Analytics -->
					<script async src="https://www.googletagmanager.com/gtag/js?id=' . esc_html( get_aesthetix_options( 'other_google_counter' ) ) . '"></script>
					<script>
						window.dataLayer = window.dataLayer || [];
						function gtag(){dataLayer.push(arguments);}
						gtag("js", new Date());

						gtag("config", "' . esc_html( get_aesthetix_options( 'other_google_counter' ) ) . '");
					</script>' . "\n";

		}

		if ( get_aesthetix_options( 'other_yandex_counter' ) ) {
			echo '<!-- Yandex.Metrika counter -->
				<script type="text/javascript" >
					(function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
					m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
					(window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

					ym(' . esc_html( get_aesthetix_options( 'other_yandex_counter' ) ) . ', "init", {
						clickmap:true,
						trackLinks:true,
						accurateTrackBounce:true
					});
				</script>
				<!-- /Yandex.Metrika counter -->' . "\n";
		}
	}
}
add_action( 'wp_footer', 'aesthetix_print_counters', 25 );

if ( ! function_exists( 'aesthetix_breadcrumbs' ) ) {

	/**
	 * Display breadcrumbs on action hook wp_footer_close.
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

