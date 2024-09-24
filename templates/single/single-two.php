<?php
/**
 * Template part for displaying post content in single.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */
 ?>

<article id="post-<?php the_ID(); ?>" <?php aesthetix_post_classes( 'post-single post-two', $args ); ?> data-object-id="<?php the_ID(); ?>">

	<?php get_template_part( 'templates/single/single-entry-post-header' ); ?>

	<div class="row">

		<div class="col-12 col-sm-12 col-lg-4 col-xl-3 post-entry-container">

			<?php

				if ( has_post_thumbnail() ) { ?>
					<div class="post-thumbnail-wrap">
						<?php get_template_part( 'templates/single/single-entry-post-thumbnail' ); ?>
					</div>
				<?php }

				if ( get_aesthetix_options( 'single_' . get_post_type() . '_meta_display' ) ) {
					get_template_part( 'templates/single/single-entry-post-meta' );
				}
			?>

		</div>

		<div class="col-12 col-sm-12 col-lg-8 col-xl-9 post-entry-container">

			<?php

				get_template_part( 'templates/single/single-entry-post-content' );

				if ( get_aesthetix_options( 'single_' . get_post_type() . '_entry_footer_display' ) ) {
					get_template_part( 'templates/single/single-entry-post-footer' );
				}
			?>

		</div>

	</div>

</article>
