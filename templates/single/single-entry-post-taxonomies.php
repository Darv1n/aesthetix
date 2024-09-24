<?php
/**
 * Template part for displaying single entry post taxonomies.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$defaults = array(
	'button_size'          => 'xs',
	'button_color'         => 'secondary',
	'button_type'          => get_aesthetix_options( 'root_button_type' ),
	'button_content'       => 'button-text',
	'button_border_width'  => get_aesthetix_options( 'root_button_border_width' ),
	'button_border_radius' => 'full',
	'structure'            => '',
	'max_tax'              => -1,
);

$args = array_merge( apply_filters( 'get_aesthetix_single_entry_post_taxonomies_default_args', $defaults, $args ), $args );
$i    = 0;

if ( is_string( $args['structure'] ) && ! empty( $args['structure'] ) ) {
	$args['structure'] = array_map( 'trim', explode( ',', $args['structure'] ) );
}

if ( is_array( $args['structure'] ) && ! empty( $args['structure'] ) ) { ?>

	<ul class="post-entry-taxonomies" aria-label="<?php esc_attr_e( 'Post taxonomies', 'aesthetix' ); ?>">

	<?php foreach ( $args['structure'] as $key => $value ) {

		$args = apply_filters( 'get_aesthetix_archive_entry_post_taxonomies_args', $args, $value );

		switch ( $value ) {
			case has_action( 'aesthetix_archive_entry_post_taxonomies_loop_' . $value ):
				do_action( 'aesthetix_archive_entry_post_taxonomies_loop_' . $value, $post, $args );
				break;
			case 'sticky':
				if ( is_sticky() ) { ?>
					<li class="post-entry-taxonomies-item">
						<span <?php button_classes( 'post-taxonomies-button button-disabled icon icon-thumbtack', $args ); ?>>
							<?php if ( ! in_array( $args['button_content'], array( 'icon', 'button-icon' ), true ) ) {
								esc_html_e( 'Sticky', 'aesthetix' );
							} ?>
						</span>
					</li>
				<?php }
				$i++;
				break;
			case 'post_format':
				if ( has_post_format() ) { ?>
					<li class="post-entry-taxonomies-item">
						<span <?php button_classes( 'post-taxonomies-button button-disabled icon icon-' . get_post_format(), $args ); ?>>
							<?php if ( ! in_array( $args['button_content'], array( 'icon', 'button-icon' ), true ) ) {
								echo ucfirst( get_post_format() );
							} ?>
						</span>
					</li>
				<?php }
				$i++;
				break;
			default:
				if ( in_array( $value, get_object_taxonomies( get_post_type() ), true ) && has_term( '', $value ) ) {
					foreach ( get_the_terms( get_the_ID(), $value ) as $key => $taxonomy ) { ?>
						<li class="post-entry-taxonomies-item">
							<a <?php button_classes( 'post-taxonomies-button', $args ); ?> href="<?php echo esc_url( get_term_link( $taxonomy->term_id, $taxonomy->taxonomy ) ); ?>">
								<?php if ( ! in_array( $args['button_content'], array( 'icon', 'button-icon' ), true ) ) {
									echo esc_html( $taxonomy->name );
								} ?>
							</a>
						</li>
						<?php $i++;
							if ( $i === $args['max_tax'] ) {
								break;
							}
					}
				}
				break;
		}
	} ?>

	</ul>

<?php }
