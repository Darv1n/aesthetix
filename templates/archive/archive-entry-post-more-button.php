<?php
/**
 * Template part for displaying archive entry post detail button.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$args['button_size']          = $args['button_size'] ?? get_aesthetix_options( 'root_button_size' );
$args['button_color']         = $args['button_color'] ?? get_aesthetix_options( 'root_menu_button_color' );
$args['button_type']          = $args['button_type'] ?? get_aesthetix_options( 'root_menu_button_type' );
$args['button_content']       = $args['button_content'] ?? get_aesthetix_options( 'archive_' . get_post_type(). '_more_button_content' );
$args['button_border_radius'] = $args['button_border_radius'] ?? get_aesthetix_options( 'root_button_border_radius' ); ?>

<div class="post-link-more" aria-label="<?php esc_attr_e( 'Post continue reading', 'aesthetix' ); ?>">
	<a <?php icon_classes( 'icon icon-after icon-arrow-right', $args ); ?> href="<?php the_permalink(); ?>">
		<?php if ( ! in_array( $args['button_content'], array( 'icon', 'button-icon' ), true ) ) {
			esc_html_e( 'Continue reading', 'aesthetix' );
		} ?>
	</a>
</div>
