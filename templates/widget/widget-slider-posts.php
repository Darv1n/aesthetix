<?php
/**
 * Template part for displaying widget post slider.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$post_type = $args['post_type'] ?? 'post';
$defaults  = array(
	'display'             => 'not-all',
	'order'               => get_aesthetix_options( 'archive_' . $post_type . '_posts_order' ),
	'orderby'             => get_aesthetix_options( 'archive_' . $post_type . '_posts_orderby' ),
	'posts_to_show'       => 4,
	'posts_per_page'      => 8,
	'post_type'           => $post_type,
	'post_status'         => 'publish',
	'ignore_sticky_posts' => true,
	'post_layout'         => get_aesthetix_options( 'archive_' . $post_type . '_layout' ),
	'post_structure'      => get_aesthetix_options( 'archive_' . $post_type . '_structure' ),
	'post_meta_structure' => get_aesthetix_options( 'archive_' . $post_type . '_meta_structure' ),
	'post_equal_height'   => get_aesthetix_options( 'archive_' . $post_type . '_equal_height' ),
);

if ( is_single() ) {
	$defaults['post__not_in'] = array( get_the_ID() );
}

$args = array_merge( apply_filters( 'get_aesthetix_widget_post_slider_default_args', $defaults ), $args );

if ( get_aesthetix_customizer_converter_display( $args['display'] ) === false ) {
	// return;
}

$query = new WP_Query( $args );

if ( $query->have_posts() ) {

	$call_count = get_template_call_count( 'widget-slider-posts' );
	$i          = 1; ?>

	<div id="slick-slider-posts-<?php echo esc_attr( $call_count ); ?>" class="slick-slider">

		<?php while ( $query->have_posts() ) {
			$query->the_post();

			$args['counter'] = $i; ?>

			<div class="slick-item">

				<?php if ( in_array( $args['post_layout'], array( 'list', 'list-chess' ), true ) ) {
					get_template_part( 'templates/widget/widget-post-list', get_post_type(), $args );
				} else {
					if ( has_post_format() ) {
						if ( get_theme_file_path( 'templates/widget/widget-post-' . get_post_type() . '-' . get_post_format() . '.php' ) ) {
							get_template_part( 'templates/widget/widget-post', get_post_type() . '-' . get_post_format(), $args );
						} else {
							get_template_part( 'templates/widget/widget-post', get_post_format(), $args );
						}
					} else {
						get_template_part( 'templates/widget/widget-post', get_post_type(), $args );
					}
				} ?>

			</div>

			<?php $args['counter'] = $i++;
		} ?>

	</div>

	<?php

		$breakpoints = array( 1200, 992, 768, 576 );
		$slick_args  = array(
			'arrows'         => true,
			'dots'           => false,
			'infinite'       => true,
			'speed'          => 300,
			'slidesToShow'   => $args['posts_to_show'],
			'slidesToScroll' => 1,
			'adaptiveHeight' => false,
		);

		foreach ( $breakpoints as $key => $breakpoint ) {

			if ( $breakpoint === 1200 && $args['posts_to_show'] > 3 ) {
				$slick_args['responsive'][ $key ] = array(
					'breakpoint' => (int) $breakpoint,
					'settings'   => array(
						'slidesToShow'   => 4,
						'slidesToScroll' => 1,
					),
				);
			} elseif ( $breakpoint === 992 && $args['posts_to_show'] > 2 ) {
				$slick_args['responsive'][ $key ] = array(
					'breakpoint' => (int) $breakpoint,
					'settings'   => array(
						'arrows' => false,
					),
				);
				if ( $args['posts_to_show'] > 2 ) {
					$slick_args['responsive'][ $key ]['settings']['slidesToShow']   = 3;
					$slick_args['responsive'][ $key ]['settings']['slidesToScroll'] = 1;
				}
			} elseif ( $breakpoint === 768 && $args['posts_to_show'] > 1 ) {
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

		$slick_init = 'jQuery( function( $ ) {
			$( \'#slick-slider-posts-' . $call_count . '\' ).slick( ' . json_encode( $slick_args ) . ' );
		} );';

		wp_enqueue_style( 'slick-style' );
		wp_enqueue_script( 'slick-script' );
		wp_add_inline_script( 'slick-script', minify_js( $slick_init ) );
}

wp_reset_postdata();