<?php
/**
 * Widget Subscribe Popup Form.
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WPA_Widget_Subscribe_Popup_Form extends WPA_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'widget-subscribe-toggle';
		$this->widget_description = __( 'The global settings for this button can be found in the сustomizer', 'aesthetix' );
		$this->widget_id          = 'aesthetix-widget-subscribe-toggle';
		$this->widget_name        = get_widget_name( 'WPA_Widget_Subscribe_Popup_Form' );
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
			'button_color'     => array(
				'type'    => 'select',
				'std'     => get_aesthetix_options( 'root_subscribe_popup_form_button_color' ),
				'label'   => __( 'Select button color', 'aesthetix' ),
				'options' => get_aesthetix_customizer_button_color(),
			),
			'button_type'      => array(
				'type'    => 'select',
				'std'     => get_aesthetix_options( 'root_subscribe_popup_form_button_type' ),
				'label'   => __( 'Select button type', 'aesthetix' ),
				'options' => get_aesthetix_customizer_button_type(),
			),
			'button_content'   => array(
				'type'    => 'select',
				'std'     => get_aesthetix_options( 'root_subscribe_popup_form_button_content' ),
				'label'   => __( 'Select button content', 'aesthetix' ),
				'options' => get_aesthetix_customizer_button_content(),
			),
			'background_color' => array(
				'type'    => 'select',
				'std'     => get_aesthetix_options( 'root_bg_aside_widgets' ),
				'label'   =>__( 'Background color', 'aesthetix' ),
				'options' => get_aesthetix_customizer_background_colors(),
			),
			'background_image' => array(
				'type'  => 'image',
				'std'   => '',
				'label' => __( 'Background image (used instead of background color)', 'aesthetix' ),
			),
			'display'          => array(
				'type'    => 'select',
				'std'     => 'all',
				'label'   => __( 'Choose how to display the widget', 'aesthetix' ),
				'options' => get_aesthetix_customizer_display(),
			),
		);

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

		$template_args                     = array();
		$template_args['button_color']     = isset( $instance['button_color'] ) ? $instance['button_color'] : $this->settings['button_color']['std'];
		$template_args['button_type']      = isset( $instance['button_type'] ) ? $instance['button_type'] : $this->settings['button_type']['std'];
		$template_args['button_content']   = isset( $instance['button_content'] ) ? $instance['button_content'] : $this->settings['button_content']['std'];
		$template_args['background_color'] = isset( $instance['background_color'] ) ? $instance['background_color'] : $this->settings['background_color']['std'];
		$template_args['background_image'] = isset( $instance['background_image'] ) ? $instance['background_image'] : $this->settings['background_image']['std'];
		$template_args['display']          = isset( $instance['display'] ) ? $instance['display'] : $this->settings['display']['std'];

		get_template_part( 'templates/widget/widget-subscribe-toggle', '', $template_args );

		$this->widget_end( $args, $instance );
	}
}
