<?php
/**
 * Template part for displaying archive entry post taxonomies.
 *
 * @since 1.0.0
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$args['button_size']               = $args['button_size'] ?? 'xs';
$args['post_taxonomies_structure'] = $args['post_taxonomies_structure'] ?? get_aesthetix_options( 'archive_' . get_post_type() . '_taxonomies_structure' );

if ( is_string( $args['post_taxonomies_structure'] ) && ! empty( $args['post_taxonomies_structure'] ) ) {
	$args['post_taxonomies_structure'] = array_map( 'trim', explode( ',', $args['post_taxonomies_structure'] ) );
}

if ( is_array( $args['post_taxonomies_structure'] ) && ! empty( $args['post_taxonomies_structure'] ) ) { ?>

	<ul class="post-taxonomies" aria-label="<?php esc_attr_e( 'Post taxonomies', 'aesthetix' ); ?>">

	<?php foreach ( $args['post_taxonomies_structure'] as $key => $value ) {
		switch ( $value ) {
			case has_action( 'aesthetix_archive_entry_post_taxonomies_loop_' . $value ):
				do_action( 'aesthetix_archive_entry_post_taxonomies_loop_' . $value, $post, $args );
				break;
			case 'sticky':
				if ( is_sticky() ) { ?>
					<li class="post-taxonomies-item">
						<button <?php button_classes( 'post-taxonomies-button button-disabled icon icon-thumbtack', array( 'button_size' => $args['button_size'], 'button_rounded' => true ) ); ?> type="button" disabled>
							<?php esc_html_e( 'Sticky', 'aesthetix' ); ?>
						</button>
					</li>
				<?php }
				break;
			case 'post_format':
				if ( has_post_format() ) { ?>
					<li class="post-taxonomies-item">
						<button <?php button_classes( 'post-taxonomies-button button-disabled icon icon-' . get_post_format(), array( 'button_size' => $args['button_size'], 'button_rounded' => true ) ); ?> type="button" disabled>
							<?php echo ucfirst( get_post_format() ); ?>
						</button>
					</li>
				<?php }
				break;
			default:
				if ( has_term( '', $value ) ) {
					foreach ( get_the_terms( get_the_ID(), $value ) as $key => $taxonomy ) { ?>
						<li class="post-taxonomies-item">
							<a <?php button_classes( 'post-taxonomies-button', array( 'button_size' => $args['button_size'], 'button_color' => 'secondary', 'button_rounded' => true ) ); ?> href="<?php echo esc_url( get_term_link( $taxonomy->term_id, $taxonomy->taxonomy ) ); ?>"><?php echo esc_html( $taxonomy->name ); ?></a>
						</li>
					<?php }
				}
				break;
		}
	} ?>

	</ul>

<?php }