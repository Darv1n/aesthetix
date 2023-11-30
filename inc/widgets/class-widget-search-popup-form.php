<?php
/**
 * Widget Search Popup Form.
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WPA_Widget_Search_Popup_Form extends WPA_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'widget_search_toggle';
		$this->widget_description = __( 'The global settings for this button can be found in the сustomizer', 'aesthetix' );
		$this->widget_id          = 'aesthetix-widget-search-toggle';
		$this->widget_name        = get_widget_name( 'widget-search-toggle' );
		$this->settings           = array(
			'title'          => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Title', 'aesthetix' ),
			),
			'subtitle'       => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Subtitle', 'aesthetix' ) . ' (' . mb_strtolower( __( 'Before title', 'aesthetix' ) ) . ')',
			),
			'description'    => array(
				'type'  => 'textarea',
				'std'   => '',
				'label' => __( 'Description', 'aesthetix' ) . ' (' . mb_strtolower( __( 'After title', 'aesthetix' ) ) . ')',
			),
			'input_size'     => array(
				'type'    => 'select',
				'std'     => get_aesthetix_options( 'root_input_size' ),
				'label'   => __( 'Select input size', 'aesthetix' ),
				'options' => get_aesthetix_customizer_button_sizes(),
			),
			'button_color'   => array(
				'type'    => 'select',
				'std'     => get_aesthetix_options( 'root_searchform_popup_form_button_color' ),
				'label'   => __( 'Select button color', 'aesthetix' ),
				'options' => get_aesthetix_customizer_button_color(),
			),
			'button_type'    => array(
				'type'    => 'select',
				'std'     => get_aesthetix_options( 'root_searchform_popup_form_button_type' ),
				'label'   => __( 'Select button type', 'aesthetix' ),
				'options' => get_aesthetix_customizer_button_type(),
			),
			'button_content' => array(
				'type'    => 'select',
				'std'     => get_aesthetix_options( 'root_searchform_popup_form_button_content' ),
				'label'   => __( 'Select button content', 'aesthetix' ),
				'options' => get_aesthetix_customizer_button_content(),
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

		$template_args                   = array();
		$template_args['input_size']     = isset( $instance['input_size'] ) ? $instance['input_size'] : $this->settings['input_size']['std'];
		$template_args['button_size']    = isset( $instance['input_size'] ) ? $instance['input_size'] : $this->settings['input_size']['std'];
		$template_args['button_color']   = isset( $instance['button_color'] ) ? $instance['button_color'] : $this->settings['button_color']['std'];
		$template_args['button_type']    = isset( $instance['button_type'] ) ? $instance['button_type'] : $this->settings['button_type']['std'];
		$template_args['button_content'] = isset( $instance['button_content'] ) ? $instance['button_content'] : $this->settings['button_content']['std'];

		get_template_part( 'templates/widget/widget-search-toggle', '', $template_args );

		$this->widget_end( $args, $instance );
	}
}
