<?php
/**
 * Template tils for displaying posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

if ( ! $post ) {
	return;
}

$defaults = array(
	'post_format'         => get_post_format(),
	'post_layout'         => get_aesthetix_options( 'archive_' . get_post_type() . '_layout' ),
	'post_structure'      => get_aesthetix_options( 'archive_' . get_post_type() . '_structure' ),
	'post_meta_structure' => get_aesthetix_options( 'archive_' . get_post_type() . '_meta_structure' ),
	'post_equal_height'   => get_aesthetix_options( 'archive_' . get_post_type() . '_equal_height' ),
	'post_title_size'     => get_aesthetix_options( 'archive_' . get_post_type() . '_title_size' ),
	'max_tax'             => -1,
);

$args      = array_merge( $defaults, $args );
$classes[] = 'post-content-wrap';

if ( is_string( $args['post_structure'] ) && ! empty( $args['post_structure'] ) ) {
	$args['post_structure'] = array_map( 'trim', explode( ',', $args['post_structure'] ) );
}

if ( $args['post_layout'] === 'grid-image' || $args['post_format'] === 'image' && get_aesthetix_options( 'archive_' . get_post_type() . '_thumbnail_before' ) ) {
	array_unshift( $args['post_structure'], implode( ',', array( get_aesthetix_options( 'archive_' . get_post_type() . '_thumbnail_before' ), get_aesthetix_options( 'archive_' . get_post_type() . '_thumbnail_after' ) ) ) );
} ?>

<article id="post-<?php the_ID(); ?>" <?php aesthetix_post_classes( '', $args ); ?>>

	<?php if ( has_post_thumbnail( $post ) || get_aesthetix_options( 'archive_' . get_post_type() . '_thumbnail_default' ) ) {

		$classes[] = 'has-post-thumbnail'; ?>

		<div class="post-thumbnail-wrap">

			<?php get_template_part( 'templates/archive/archive-entry-post-thumbnail', '', $args ); ?>

			<?php if ( $args['post_layout'] !== 'grid-image' && $args['post_format'] !== 'image' ) {
				get_template_part( 'templates/archive/archive-entry-post-taxonomies', '', array_merge( $args, array( 'structure' => get_aesthetix_options( 'archive_' . get_post_type() . '_thumbnail_before' ) ) ) );
				get_template_part( 'templates/archive/archive-entry-post-taxonomies', '', array_merge( $args, array( 'structure' => get_aesthetix_options( 'archive_' . get_post_type() . '_thumbnail_after' ) ) ) );
			} ?>

		</div>
	<?php } ?>

	<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">

		<?php if ( is_array( $args['post_structure'] ) && ! empty( $args['post_structure'] ) ) {
			foreach ( $args['post_structure'] as $key => $value ) {
				switch ( $value ) {
					case has_action( 'aesthetix_archive_entry_post_loop_' . $value ):
						do_action( 'aesthetix_archive_entry_post_loop_' . $value, $post, $args );
						break;
					case 'title':
						get_template_part( 'templates/archive/archive-entry-post-title', '', $args );
						break;
					case 'meta':
						get_template_part( 'templates/archive/archive-entry-post-meta', '', $args );
						break;
					case 'excerpt':
						get_template_part( 'templates/archive/archive-entry-post-content', '', $args );
						break;
					case 'author':
						get_template_part( 'templates/archive/archive-entry-post-author', '', $args );
						break;
					case 'more':
						get_template_part( 'templates/archive/archive-entry-post-more-button', '', $args );
						break;
					default:
						get_template_part( 'templates/archive/archive-entry-post-taxonomies', '', array_merge( $args, array( 'structure' => $value ) ) );
						break;
				}
			}
		} ?>

	</div>

</article>
