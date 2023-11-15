<?php
/**
 * Template part for displaying widget title (for default widgets).
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$args['widget_title']    = $args['widget_title'] ?? '';
$args['widget_subtitle'] = $args['widget_subtitle'] ?? '';

if ( $args['widget_title'] ) { ?>
	<div class="widget-title-wrap">
		<?php if ( $args['widget_subtitle'] ) { ?>
			<span class="widget-subtitle"><?php echo esc_html( $args['widget_subtitle'] ); ?></span>
		<?php } ?>
		<h2 class="widget-title"><?php echo esc_html( $args['widget_title'] ); ?></h2>
	</div>
<?php }
