<?php
/**
 * Widget Use Materials
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

		$home_url = wp_parse_url( get_home_url() );

		if ( is_multisite() ) {
			$home_url = wp_parse_url( network_home_url() );
		}

		$this->widget_cssclass    = 'widget-use-materials';
		$this->widget_description = __( 'The global settings for this form can be found in the Customizer', 'aesthetix' );
		$this->widget_id          = 'aesthetix-widget-use-materials';
		$this->widget_name        = get_widget_name( 'widget-use-materials' );
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
			'text'        => array(
				'type'  => 'textarea',
				'std'   => sprintf( __( 'Use of site materials is permitted only with reference to the source %s', 'aesthetix' ), $home_url['host'] ),
				'label' => __( 'Text', 'aesthetix' ),
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

		$template_args         = array();
		$template_args['text'] = isset( $instance['text'] ) ? $instance['text'] : $this->settings['text']['std'];

		get_template_part( 'templates/widget/widget-use-materials', '', $template_args );

		$this->widget_end( $args, $instance );
	}
}
