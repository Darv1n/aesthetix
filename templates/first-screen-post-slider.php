<?php
/**
 * Template part for displaying first screen.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

if ( ( is_front_page() || is_home() ) && get_aesthetix_options( 'front_page_slider_display' ) ) {

	$template_args['post_type']   = get_aesthetix_options( 'front_page_slider_post_type' );
	$template_args['post_format'] = 'standard';
	$template_args['post_layout'] = get_aesthetix_options( 'front_page_slider_slides_layout' );

	$args = array(
		'posts_per_page' => (int) get_aesthetix_options( 'front_page_slider_slides_count' ),
		'post_type'      => $template_args['post_type'],
	);

	$query = new WP_Query( $args );
	$i     = 0;

	if ( $query->have_posts() ) { ?>

		<section id="section-first-screen" <?php aesthetix_section_classes( 'section-fisrt-screen' ); ?> aria-label="<?php esc_attr_e( 'First screen slider', 'aesthetix' ); ?>">
			<div <?php aesthetix_container_classes( 'container-outer' ); ?>>
				<div <?php aesthetix_container_classes( 'container-inner' ); ?>>
					<div class="first-screen-slider">

					<?php while ( $query->have_posts() ) :
						$query->the_post(); ?>

						<div class="slick-item">

							<?php

								$template_args['counter'] = $i;

								if ( in_array( $template_args['post_layout'], array( 'list', 'list-chess' ), true ) ) {
									get_template_part( 'templates/archive/archive-post-list', $template_args['post_type'], $template_args );
								} else {
									if ( get_theme_file_path( 'templates/archive/archive-post-' . $template_args['post_type'] . '-' . $template_args['post_format'] . '.php' ) ) {
										get_template_part( 'templates/archive/archive-post', $template_args['post_type'] . '-' . $template_args['post_format'], $template_args );
									} elseif ( get_theme_file_path( 'templates/archive/archive-post-' . $template_args['post_format'] . '.php' ) ) {
										get_template_part( 'templates/archive/archive-post', $template_args['post_format'], $template_args );
									} else {
										get_template_part( 'templates/archive/archive-post', $template_args['post_type'], $template_args );
									}
								}

								$i++;
							?>

						</div>

					<?php endwhile; ?>

					</div>
				</div>
			</div>
		</section>

		<?php
	}
}
