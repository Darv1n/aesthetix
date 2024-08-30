<?php
/**
 * Template part for displaying section content wrapper start.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$defaults = array(
	'section_class'     => 'section-content',
	'section_structure' => apply_filters( 'get_aesthetix_main_section_structure', 'section,container,row' ),
	'aria_label'        => esc_attr__( 'Site content', 'aesthetix' ),
);

$args = array_merge( $defaults, $args );

if ( is_string( $args['section_structure'] ) && ! empty( $args['section_structure'] ) ) {
	$args['section_structure'] = array_map( 'trim', explode( ',', $args['section_structure'] ) );
}

if ( is_array( $args['section_structure'] ) && ! empty( $args['section_structure'] ) ) {
	foreach ( $args['section_structure'] as $key => $value ) {
		switch ( $value ) {
			case has_action( 'aesthetix_single_entry_post_meta_loop_' . $value ):
				do_action( 'aesthetix_single_entry_post_meta_loop_' . $value, $post );
				break;
			case 'section': ?>
				<?php if ( ! empty( $args['section_class'] ) ) { ?>
					<section id="<?php echo esc_attr( $args['section_class'] ); ?>" <?php aesthetix_section_classes( $args['section_class'] ); ?> aria-label="<?php echo esc_attr( $args['aria_label'] ); ?>">
				<?php } else { ?>
					<section <?php aesthetix_section_classes( $args['section_class'] ); ?>>
				<?php } ?>
				<?php break;
			case 'container': ?>
				<div <?php aesthetix_container_classes( 'container-outer' ); ?>>
					<div <?php aesthetix_container_classes( 'container-inner' ); ?>>
				<?php break;
			case 'row': ?>
				<div class="row">
				<?php break;
			default:
				break;
		}
	}
}
