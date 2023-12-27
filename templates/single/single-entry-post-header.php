<?php
/**
 * Template part for displaying entry header.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */
 ?>

<header class="post-entry-header" aria-label="<?php esc_attr_e( 'Post header', 'aesthetix' ); ?>">

	<?php
		$structure = array( 'title' );
		$structure = apply_filters( 'aesthetix_single_entry_post_header_structure', $structure );
		foreach ( $structure as $key => $value ) {
			switch ( $value ) {
				case has_action( 'aesthetix_single_entry_post_header_loop_' . $value ):
					do_action( 'aesthetix_single_entry_post_header_loop_' . $value );
					break;
				case 'title':
					the_title( '<h1 class="post-title">', '</h1>' );
					break;
				case 'excerpt':
					the_excerpt();
					break;
				default:
					break;
			}
		} ?>

</header>
