<?php
/**
 * Template tils for displaying widget posts.
 *
 * @since 1.3.1
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$args['post_layout']                  = $args['post_layout'] ?? get_aesthetix_options( 'archive_' . get_post_type() . '_layout' );
$args['post_structure']               = $args['post_structure'] ?? get_aesthetix_options( 'archive_' . get_post_type() . '_structure' );
$args['post_meta_structure']          = $args['post_meta_structure'] ?? get_aesthetix_options( 'archive_' . get_post_type() . '_meta_structure' );
$args['post_taxonomies_structure']    = $args['post_taxonomies_structure'] ?? get_aesthetix_options( 'archive_' . get_post_type() . '_taxonomies_structure' );
$args['post_taxonomies_in_thumbnail'] = $args['post_taxonomies_in_thumbnail'] ?? get_aesthetix_options( 'archive_' . get_post_type() . '_taxonomies_in_thumbnail' );

if ( is_string( $args['post_structure'] ) && ! empty( $args['post_structure'] ) ) {
	$args['post_structure'] = array_map( 'trim', explode( ',', $args['post_structure'] ) );
}

?>

<article id="post-<?php the_ID(); ?>" <?php aesthetix_post_classes( 'post-aside', $args ); ?>>

	<?php if ( has_post_thumbnail() ) { ?>
		<div class="post-thumbnail-wrap">

			<?php get_template_part( 'templates/archive/archive-entry-post-thumbnail', '', $args ); ?>

			<?php if ( $args['post_taxonomies_in_thumbnail'] ) { ?>
				<?php get_template_part( 'templates/archive/archive-entry-post-taxonomies', '', $args ); ?>
			<?php } ?>

		</div>
	<?php } ?>

	<div class="post-content-wrap">

		<?php if ( is_array( $args['post_structure'] ) && ! empty( $args['post_structure'] ) ) {
			foreach ( $args['post_structure'] as $key => $value ) {
				switch ( $value ) {
					case has_action( 'aesthetix_archive_entry_post_loop_' . $value ):
						do_action( 'aesthetix_archive_entry_post_loop_' . $value, $post, $args );
						break;
					case 'title':
						get_template_part( 'templates/archive/archive-entry-post-title', '', $args );
						break;
					case 'taxonomies':
						if ( ! has_post_thumbnail() || ! $args['post_taxonomies_in_thumbnail'] ) {
							get_template_part( 'templates/archive/archive-entry-post-taxonomies', '', $args );
						}
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
						get_template_part( 'templates/archive/archive-entry-post-detail-button', '', $args );
						break;
					default:
						break;
				}
			}
		} ?>

	</div>

</article>
