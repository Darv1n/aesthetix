<?php
/**
 * Template list for displaying posts.
 *
 * @since 1.0.0
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

if ( get_aesthetix_options( 'archive_' . get_post_type() . '_layout' ) === 'list-chess' && isset( $args['counter'] ) && (int) $args['counter'] % 2 === 0 ) {
	$order_left  = 'order-md-2';
	$order_right = 'order-md-1';
} else {
	$order_left  = 'order-md-1';
	$order_right = 'order-md-2';
} ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div <?php aesthetix_archive_page_columns_wrapper_classes( 'align-items-center' ); ?>>
		<div class="col-12 col-xs-12 col-md-5 <?php echo esc_attr( $order_left ); ?>">

			<?php if ( has_post_thumbnail() ) { ?>
				<div class="post-thumbnail-wrap">
					<?php get_template_part( 'templates/archive/archive-entry-post-thumbnail' ); ?>
				</div>
			<?php } ?>

		</div>
		<div class="col-12 col-xs-12 col-md-7 <?php echo esc_attr( $order_right ); ?>">

			<?php $structure = get_aesthetix_options( 'archive_' . get_post_type() . '_structure' );

			if ( is_string( $structure ) && ! empty( $structure ) ) { ?>

				<div class="post-content-wrap">

					<?php $structure = array_map( 'trim', explode( ',', $structure ) );

					foreach ( $structure as $key => $value ) {
						switch ( $value ) {
							case has_action( 'aesthetix_archive_entry_post_loop_' . $value ):
								do_action( 'aesthetix_archive_entry_post_loop_' . $value, $post );
								break;
							case 'title':
								get_template_part( 'templates/archive/archive-entry-post-title' );
								break;
							case 'meta':
								get_template_part( 'templates/archive/archive-entry-post-meta' );
								break;
							case 'excerpt':
								get_template_part( 'templates/archive/archive-entry-post-content' );
								break;
							case 'author':
								get_template_part( 'templates/archive/archive-entry-post-author' );
								break;
							case 'more':
								get_template_part( 'templates/archive/archive-entry-post-detail-button' );
								break;
							default:
								break;
						}
					} ?>

				</div>

			<?php } ?>

		</div>
	</div>
</article>
