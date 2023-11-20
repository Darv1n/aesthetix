<?php
/**
 * Widget Socials.
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WPA_Widget_Socials extends WPA_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'widget_socials';
		$this->widget_description = __( 'The global settings for this form can be found in the Customizer', 'aesthetix' );
		$this->widget_id          = 'aesthetix-widget-socials';
		$this->widget_name        = get_widget_name( 'widget-socials' );
		$this->settings           = array(
			'title'            => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Title', 'aesthetix' ),
			),
			'subtitle'         => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Subtitle', 'aesthetix' ) . ' (' . mb_strtolower( __( 'Before title', 'aesthetix' ) ) . ')',
			),
			'description'      => array(
				'type'  => 'textarea',
				'std'   => '',
				'label' => __( 'Description', 'aesthetix' ) . ' (' . mb_strtolower( __( 'After title', 'aesthetix' ) ) . ')',
			),
			'style' => array(
				'type'    => 'select',
				'std'     => 'inline',
				'label'   => __( 'Select style block', 'aesthetix' ),
				'options' => array( 'inline' => __( 'Inline', 'aesthetix' ), 'block' => __( 'Block', 'aesthetix' ) ),
			),
			'icon_size' => array(
				'type'    => 'select',
				'std'     => get_aesthetix_options( 'root_button_size' ),
				'label'   => __( 'Select icon size', 'aesthetix' ),
				'options' => get_aesthetix_customizer_sizes(),
			),
			'button_size' => array(
				'type'    => 'select',
				'std'     => get_aesthetix_options( 'root_button_size' ),
				'label'   => __( 'Select button size', 'aesthetix' ),
				'options' => get_aesthetix_customizer_sizes(),
			),
			'button_color' => array(
				'type'    => 'select',
				'std'     => 'primary',
				'label'   => __( 'Select button color', 'aesthetix' ),
				'options' => get_aesthetix_customizer_button_color(),
			),
			'button_type' => array(
				'type'    => 'select',
				'std'     => get_aesthetix_options( 'root_button_type' ),
				'label'   => __( 'Select button type', 'aesthetix' ),
				'options' => get_aesthetix_customizer_button_type(),
			),
			'button_content' => array(
				'type'    => 'select',
				'std'     => get_aesthetix_options( 'root_subscribe_popup_form_button_content' ),
				'label'   => __( 'Select button content', 'aesthetix' ),
				'options' => get_aesthetix_customizer_button_content(),
			),
		);

		foreach ( get_aesthetix_customizer_socials() as $key => $value ) {
			$this->settings[ 'link-' . $key ] = array(
				'type'  => 'url',
				'std'   => get_aesthetix_options( 'other_' . $key ),
				'label' => $value,
			);
		}

		parent::__construct();
	}

	/**
	 * Output widget.
	 *
	 * @see WP_Widget
	 * 
	 * @param array $args     Widget arguments.
	 * @param array $instance Widget instance.
	 */
	public function widget( $args, $instance ) {
		$this->widget_start( $args, $instance );

		$template_args                   = array();
		$template_args['style']          = isset( $instance['style'] ) ? $instance['style'] : $this->settings['style']['std'];
		$template_args['icon_size']      = isset( $instance['icon_size'] ) ? $instance['icon_size'] : $this->settings['icon_size']['std'];
		$template_args['button_size']    = isset( $instance['button_size'] ) ? $instance['button_size'] : $this->settings['button_size']['std'];
		$template_args['button_color']   = isset( $instance['button_color'] ) ? $instance['button_color'] : $this->settings['button_color']['std'];
		$template_args['button_type']    = isset( $instance['button_type'] ) ? $instance['button_type'] : $this->settings['button_type']['std'];
		$template_args['button_content'] = isset( $instance['button_content'] ) ? $instance['button_content'] : $this->settings['button_content']['std'];

		foreach ( get_aesthetix_customizer_socials() as $key => $value ) {
			$template_args['structure'][ $key ] = isset( $instance[ 'link-' . $key ] ) ? $instance[ 'link-' . $key ] : $this->settings[ 'link-' . $key ]['std'];
		}

		get_template_part( 'templates/widget/widget-socials', '', $template_args );

		$this->widget_end( $args, $instance );
	}
}
