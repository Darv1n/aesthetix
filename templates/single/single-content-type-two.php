<?php
/**
 * Template part for displaying post content in single.php
 *
 * @since 1.0.0
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */
 ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post_single' ); ?>>

	<?php
		// Post header part.
		get_template_part( 'templates/single/single-entry-post-header' ); 
	?>

	<div class="row">

		<div class="col-12 col-sm-12 col-lg-4 col-xl-3 d-flex align-content-between flex-wrap">

			<?php
				// Post meta part.
				if ( get_aesthetix_options( 'single_' . get_post_type() . '_meta_display' ) ) {
					get_template_part( 'templates/single/single-entry-post-meta' );
				}
			?>

		</div>

		<div class="col-12 col-sm-12 col-lg-8 col-xl-9">

			<?php
				// Post thumbnail part.
				if ( has_post_thumbnail() && get_aesthetix_options( 'single_' . get_post_type() . '_thumbnail_display' ) ) {
					get_template_part( 'templates/single/single-entry', 'post-thumbnail' );
				}

				// Post content part.
				get_template_part( 'templates/single/single-entry-post-content' );

				// Post footer part.
				if ( get_aesthetix_options( 'single_' . get_post_type() . '_entry_footer_display' ) ) {
					get_template_part( 'templates/single/single-entry-post-footer' );
				}
			?>

		</div>

	</div>

</article>
