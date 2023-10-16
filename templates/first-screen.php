<?php
/**
 * Template part for displaying first screen.
 * 
 * @since 1.1.1
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

if ( ( is_front_page() || is_home() ) && get_aesthetix_options( 'front_page_slider_display' ) ) {

	$i         = 0;
	$post_type = get_aesthetix_options( 'front_page_slider_post_type' );

	$args = array(
		'posts_per_page' => (int) get_aesthetix_count_columns( get_aesthetix_options( 'front_page_slider_slides_count' ) ),
		'post_type'      => $post_type,
	);

	$query = new WP_Query( $args );

	if ( $query->have_posts() ) { ?>

		<section id="section-first-screen" <?php aesthetix_section_classes( 'section_fisrt-screen' ); ?> aria-label="<?php esc_attr_e( 'First Screen Slider', 'aesthetix' ); ?>">
			<div <?php aesthetix_container_classes(); ?>>
				<div class="slick-slider">

				<?php while ( $query->have_posts() ) {
					$query->the_post(); ?>

					<div class="slick-item">

						<?php
							// Get a template with a post type, if there is one in the theme.
							if ( file_exists( get_theme_file_path( 'templates/archive/archive-content-type-' . $post_type . '.php' ) ) ) {
								get_template_part( 'templates/archive/archive-content-type', $post_type, array( 'counter' => $i ) );
							} elseif ( get_aesthetix_options( 'front_page_slider_slides_template_type' ) ) {
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
}
