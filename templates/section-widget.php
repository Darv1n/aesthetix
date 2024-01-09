<?php
/**
 * Template part for displaying section widget.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$defaults = array(
	'widget_id' => '',
	'container' => false,
);

$args = array_merge( $defaults, $args );

$classes[] = 'section-widget';
$classes[] = 'section-widget-' . $args['widget_id'];
if ( $args['container'] === false ) {
	$classes[] = 'section-container';
}

if ( ! empty( $args['widget_id'] ) && is_active_sidebar( $args['widget_id'] ) ) { ?>
	<section <?php aesthetix_section_classes( implode( ' ', $classes ), get_aesthetix_options( 'root_bg_aside_widgets' ) ); ?>>

		<?php if ( $args['container'] ) { ?>
			<div <?php aesthetix_container_classes( 'container-outer' ); ?>>
				<div <?php aesthetix_container_classes( 'container-inner' ); ?>>
		<?php } ?>

			<div <?php widgets_classes( '', $args['widget_id'] ); ?>>
				<?php dynamic_sidebar( $args['widget_id'] ); ?>
			</div>

		<?php if ( $args['container'] ) { ?>
				</div>
			</div>
		<?php } ?>

	</section>
<?php }
