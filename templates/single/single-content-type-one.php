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

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-single' ); ?>>

	<?php do_action( 'aesthetix_before_single_entry_post' ); ?>

	<?php

		$structure = get_aesthetix_options( 'single_' . get_post_type() . '_structure' );

		if ( is_string( $structure ) && ! empty( $structure ) ) {

			$structure = array_map( 'trim', explode( ',', $structure ) );

			foreach ( $structure as $key => $value ) {
				switch ( $value ) {
					case has_action( 'aesthetix_single_entry_post_loop_' . $value ):
						do_action( 'aesthetix_single_entry_post_loop_' . $value, $post );
						break;
					case 'header':
						get_template_part( 'templates/single/single-entry-post-header' );
						break;
					case 'thumbnail':
						get_template_part( 'templates/single/single-entry-post-thumbnail' );
						break;
					case 'meta':
						get_template_part( 'templates/single/single-entry-post-meta' );
						break;
					case 'content':
						get_template_part( 'templates/single/single-entry-post-content' );
						break;
					case 'footer':
						get_template_part( 'templates/single/single-entry-post-footer' );
						break;
					default:
						break;
				}
			}
		}
	?>

	<?php do_action( 'aesthetix_after_single_entry_post' ); ?>

</article>
