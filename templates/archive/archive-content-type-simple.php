<?php
/**
 * Template simple for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 * @since 1.0.0
 */
 ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php

		// Post title part.
		get_template_part( 'templates/archive/archive-entry', 'post-title' ); 

		// Post meta part.
		if ( get_aesthetix_options( 'archive_' . get_post_type() . '_meta_display' ) ) {
			get_template_part( 'templates/archive/archive-entry', 'post-meta' );
		}

		// Post content part.
		if ( get_aesthetix_options( 'archive_' . get_post_type() . '_detail_description' ) !== 'nothing' ) {
			get_template_part( 'templates/archive/archive-entry', 'post-content' );
		}

		// Post footer part.
		if ( get_aesthetix_options( 'archive_' . get_post_type() . '_detail_button' ) !== 'nothing' ) {
			get_template_part( 'templates/archive/archive-entry', 'post-detail-button' );
		}

	?>

</article>
