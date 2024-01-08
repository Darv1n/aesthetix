<?php
/**
 * Template part for displaying section widget.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$args['widget_id'] = $args['widget_id'] ?? '';
$args['container'] = $args['container'] ?? false;

if ( ! empty( $args['widget_id'] ) && ( is_active_sidebar( $args['widget_id'] ) || get_aesthetix_widget_default( $args['widget_id'] ) ) ) { ?>
	<section id="section-widget-<?php echo esc_attr( $args['widget_id'] ); ?>" <?php aesthetix_section_classes( 'section-widget section-widget-' . $args['widget_id'] ); ?>>

		<?php if ( $args['container'] ) { ?>
			<div <?php aesthetix_container_classes( 'container-outer' ); ?>>
				<div <?php aesthetix_container_classes( 'container-inner' ); ?>>
		<?php } ?>

			<?php if ( is_active_sidebar( $args['widget_id'] ) ) { ?>
				<div <?php widgets_classes( '', $args['widget_id'] ); ?>>
					<?php dynamic_sidebar( $args['widget_id'] ); ?>
				</div>
			<?php } ?>

		<?php if ( $args['container'] ) { ?>
				</div>
			</div>
		<?php } ?>

	</section>
<?php }
