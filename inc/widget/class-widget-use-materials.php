<?php
/**
 * Widget Use Materials.
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WPA_Widget_Use_Materials extends WPA_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->widget_cssclass    = 'widget-use-materials';
		$this->widget_description = __( 'The global settings for this form can be found in the Customizer', 'aesthetix' );
		$this->widget_id          = 'aesthetix-widget-use-materials';
		$this->widget_name        = get_widget_name( 'WPA_Widget_Use_Materials' );
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
			'text'             => array(
				'type'  => 'textarea',
				'std'   => sprintf( __( 'Use of site materials is permitted only with reference to the source %s', 'aesthetix' ), wp_parse_url( get_home_url(), PHP_URL_HOST ) ),
				'label' => __( 'Text', 'aesthetix' ),
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
		$template_args['text']             = isset( $instance['text'] ) ? $instance['text'] : $this->settings['text']['std'];
		$template_args['background_color'] = isset( $instance['background_color'] ) ? $instance['background_color'] : $this->settings['background_color']['std'];
		$template_args['background_image'] = isset( $instance['background_image'] ) ? $instance['background_image'] : $this->settings['background_image']['std'];
		$template_args['display']          = isset( $instance['display'] ) ? $instance['display'] : $this->settings['display']['std'];

		get_template_part( 'templates/widget/widget-use-materials', '', $template_args );

		$this->widget_end( $args, $instance );
	}
}
