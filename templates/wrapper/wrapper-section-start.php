<?php
/**
 * Template part for displaying section wrapper start.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$defaults = array(
	'section_class' => 'section',
	'aria_label'    => false,
);

$args = array_merge( $defaults, $args );

?>

<section<?php echo ! empty( $args['section_class'] ) ? ' id="' . esc_attr( $args['section_class'] ) . '"' : ''; ?> <?php aesthetix_section_classes( $args['section_class'] ); ?><?php echo ! empty( $args['aria_label'] ) ? ' aria-label="' . esc_attr( $args['aria_label'] ) . '"' : ''; ?>>
