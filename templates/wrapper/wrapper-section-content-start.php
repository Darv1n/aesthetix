<?php
/**
 * Template part for displaying section content wrapper start.
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

get_template_part( 'templates/wrapper/wrapper-section-start', '', $args );
get_template_part( 'templates/wrapper/wrapper-container-start', '', $args );
get_template_part( 'templates/wrapper/wrapper-row-start', '', $args );
