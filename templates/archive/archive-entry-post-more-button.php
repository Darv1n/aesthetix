<?php
/**
 * Template part for displaying archive entry post detail button.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$defaults = array(
	'button_size'          => get_aesthetix_options( 'root_button_size' ),
	'button_color'         => get_aesthetix_options( 'root_menu_button_color' ),
	'button_type'          => get_aesthetix_options( 'root_menu_button_type' ),
	'button_content'       => get_aesthetix_options( 'archive_' . get_post_type(). '_more_button_content' ),
	'button_border_width'  => get_aesthetix_options( 'root_button_border_width' ),
	'button_border_radius' => get_aesthetix_options( 'root_button_border_radius' ),
);

$args      = array_merge( apply_filters( 'get_aesthetix_archive_entry_post_more_button_default_args', $defaults, $args ), $args );
$classes[] = 'post-entry-more-button';

if ( isset( $args['post_equal_height'] ) && $args['post_equal_height'] === 'more' ) {
	$classes[] = 'equal-height';
} ?>

<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" aria-label="<?php esc_attr_e( 'Post continue reading', 'aesthetix' ); ?>">
	<a <?php button_classes( 'icon icon-after icon-arrow-right', $args ); ?> href="<?php the_permalink(); ?>">
		<?php if ( ! in_array( $args['button_content'], array( 'icon', 'button-icon' ), true ) ) {
			 echo esc_html( apply_filters( 'get_aesthetix_archive_entry_post_more_button_text', __( 'Continue reading', 'aesthetix' ) ) );
		} ?>
	</a>
</div>
