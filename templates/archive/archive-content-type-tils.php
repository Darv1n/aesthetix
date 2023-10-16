<?php
/**
 * Template tils for displaying posts.
 *
 * @since 1.0.0
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */
 ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php do_action( 'aesthetix_before_archive_entry_post' ); ?>

	<?php

		$structure = get_aesthetix_options( 'archive_' . get_post_type() . '_structure' );

		if ( is_string( $structure ) && ! empty( $structure ) ) {

			$structure = array_map( 'trim', explode( ',', $structure ) );

			foreach ( $structure as $key => $value ) {
				switch ( $value ) {
					case has_action( 'aesthetix_archive_entry_post_loop_' . $value ):
						do_action( 'aesthetix_archive_entry_post_loop_' . $value, $post );
						break;
					case 'title':
						get_template_part( 'templates/archive/archive-entry', 'post-title' );
						break;
					case 'thumbnail':
						get_template_part( 'templates/archive/archive-entry', 'post-thumbnail' );
						break;
					case 'meta':
						get_template_part( 'templates/archive/archive-entry', 'post-meta' );
						break;
					case 'excerpt':
						get_template_part( 'templates/archive/archive-entry', 'post-content' );
						break;
					case 'author':
						get_template_part( 'templates/archive/archive-entry', 'post-author' );
						break;
					case 'more':
						get_template_part( 'templates/archive/archive-entry', 'post-detail-button' );
						break;
					default:
						break;
				}
			}
		}

	?>

	<?php do_action( 'aesthetix_after_archive_entry_post' ); ?>

</article>
