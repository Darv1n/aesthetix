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

if ( ! empty( $args['widget_id'] ) && is_active_sidebar( $args['widget_id'] ) ) { ?>
	<section id="section-widgets-<?php echo esc_attr( $args['widget_id'] ); ?>" <?php widgets_classes( '', $args['widget_id'] ); ?>>
		<?php dynamic_sidebar( $args['widget_id'] ); ?>
	</section>
<?php }
