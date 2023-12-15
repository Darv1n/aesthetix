<?php
/**
 * Widget Logo.
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WPA_Widget_Logo extends WPA_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'widget-logo';
		$this->widget_description = __( 'The global settings for this form can be found in the Customizer', 'aesthetix' );
		$this->widget_id          = 'aesthetix-widget-logo';
		$this->widget_name        = get_widget_name( 'widget-logo' );
		$this->settings           = array(
			'title'       => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Title', 'aesthetix' ),
			),
			'subtitle'    => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Subtitle', 'aesthetix' ) . ' (' . mb_strtolower( __( 'Before title', 'aesthetix' ) ) . ')',
			),
			'description' => array(
				'type'  => 'textarea',
				'std'   => '',
				'label' => __( 'Description', 'aesthetix' ) . ' (' . mb_strtolower( __( 'After title', 'aesthetix' ) ) . ')',
			),
			'logo_size'   => array(
				'type'    => 'select',
				'std'     => get_aesthetix_options( 'title_tagline_logo_size' ),
				'label'   => __( 'Select logo size', 'aesthetix' ),
				'options' => get_aesthetix_customizer_sizes(),
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

		$template_args              = array();
		$template_args['logo_size'] = isset( $instance['logo_size'] ) ? $instance['logo_size'] : $this->settings['logo_size']['std'];

		get_template_part( 'templates/widget/widget-logo', '', $template_args );

		$this->widget_end( $args, $instance );
	}
}