<?php
/**
 * Widget Creator
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WPA_Widget_Creator extends WPA_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'widget-creator';
		$this->widget_description = __( 'The global settings for this form can be found in the Customizer', 'aesthetix' );
		$this->widget_id          = 'aesthetix-widget-creator';
		$this->widget_name        = get_widget_name( 'widget-creator' );
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
			'creator_link'  => array(
				'type'  => 'url',
				'std'   => 'https://zolin.digital/',
				'label' => __( 'Creator link', 'aesthetix' ),
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

		$template_args                 = array();
		$template_args['creator_link'] = isset( $instance['creator_link'] ) ? $instance['creator_link'] : $this->settings['creator_link']['std'];

		get_template_part( 'templates/widget/widget-creator', '', $template_args );

		$this->widget_end( $args, $instance );
	}
}
