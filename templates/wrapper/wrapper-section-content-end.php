<?php
/**
 * Template part for displaying section content wrapper end.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$defaults = array(
	'section_class' => 'section-content',
	'aria_label'    => esc_attr__( 'Site content', 'aesthetix' ),
);

$args = array_merge( $defaults, $args );

get_template_part( 'templates/wrapper/wrapper-section-end', '', $args );
get_template_part( 'templates/wrapper/wrapper-container-end', '', $args );
get_template_part( 'templates/wrapper/wrapper-row-end', '', $args );
