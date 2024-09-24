<?php
/**
 * TTemplate part for displaying post list.
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

$args      = array_merge( apply_filters( 'get_aesthetix_archive_post_list_default_args', $defaults, $args ), $args );
$classes[] = 'post-content-wrap';

if ( is_string( $args['post_structure'] ) && ! empty( $args['post_structure'] ) ) {
	$args['post_structure'] = array_map( 'trim', explode( ',', $args['post_structure'] ) );
}

if ( $args['post_layout'] === 'grid-image' || $args['post_format'] === 'image' && get_aesthetix_options( 'archive_' . get_post_type() . '_thumbnail_before' ) ) {
	array_unshift( $args['post_structure'], implode( ',', array( get_aesthetix_options( 'archive_' . get_post_type() . '_thumbnail_before' ), get_aesthetix_options( 'archive_' . get_post_type() . '_thumbnail_after' ) ) ) );
}

if ( $args['post_layout'] === 'list-chess' && isset( $args['counter'] ) && (int) $args['counter'] % 2 === 0 ) {
	$order_left  = 'order-md-2';
	$order_right = 'order-md-1';
} else {
	$order_left  = 'order-md-1';
	$order_right = 'order-md-2';
}

?>

<article id="post-<?php the_ID(); ?>" <?php aesthetix_post_classes( '', $args ); ?> ata-object-id="<?php the_ID(); ?>">
	<div <?php aesthetix_archive_page_columns_wrapper_classes( 'align-items-center' ); ?>>

		<?php if ( has_post_thumbnail( $post ) || get_aesthetix_options( 'archive_' . get_post_type() . '_thumbnail_default' ) ) { ?>

			<div class="col-12 col-xs-12 col-md-5 align-self-stretch <?php echo esc_attr( $order_left ); ?>">

				<?php $classes[] = 'has-post-thumbnail'; ?>

				<div class="post-thumbnail-wrap">

					<?php get_template_part( 'templates/archive/archive-entry-post-thumbnail', '', $args ); ?>

					<?php if ( $args['post_layout'] !== 'grid-image' && $args['post_format'] !== 'image' ) {
						get_template_part( 'templates/archive/archive-entry-post-taxonomies', '', array_merge( $args, array( 'structure' => get_aesthetix_options( 'archive_' . get_post_type() . '_thumbnail_before' ) ) ) );
						get_template_part( 'templates/archive/archive-entry-post-taxonomies', '', array_merge( $args, array( 'structure' => get_aesthetix_options( 'archive_' . get_post_type() . '_thumbnail_after' ) ) ) );
					} ?>

				</div>

			</div>
			<div class="col-12 col-xs-12 col-md-7 <?php echo esc_attr( $order_right ); ?>">
		<?php } else { ?>
			<div class="col-12 col-xs-12">
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
							case 'taxonomies':
								get_template_part( 'templates/archive/archive-entry-post-taxonomies', '', $args );
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
								if ( locate_template( '/templates/archive/archive-entry-post-' . $value . '.php' ) !== '' ) {
									get_template_part( 'templates/archive/archive-entry-post-' . $value );
								} else {
									get_template_part( 'templates/archive/archive-entry-post-taxonomies', '', array_merge( $args, array( 'structure' => $value ) ) );
								}
								break;
						}
					}
				} ?>

			</div>

		</div>
	</div>
</article>
