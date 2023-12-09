<?php
/**
 * Widget Buttons.
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WPA_Widget_Buttons extends WPA_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'widget-buttons';
		$this->widget_description = __( 'The global settings for this form can be found in the Customizer', 'aesthetix' );
		$this->widget_id          = 'aesthetix-widget-buttons';
		$this->widget_name        = get_widget_name( 'widget-buttons' );
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
			'style'          => array(
				'type'    => 'select',
				'std'     => 'block',
				'label'   => __( 'Select style block', 'aesthetix' ),
				'options' => array( 'inline' => __( 'Inline', 'aesthetix' ), 'block' => __( 'Block', 'aesthetix' ) ),
			),
			'structure'      => array(
				'type'    => 'sortable',
				'std'     => 'telegram,whatsapp,subscribe,search',
				'label'   => __( 'Select buttons', 'aesthetix' ),
				'options' => array(
					'telegram'  => __( 'Telegram', 'aesthetix' ),
					'whatsapp'  => __( 'WhatsApp', 'aesthetix' ),
					'subscribe' => __( 'Subscribe', 'aesthetix' ),
					'search'    => __( 'Search', 'aesthetix' ),
				),
			),
			'button_type'    => array(
				'type'    => 'select',
				'std'     => get_aesthetix_options( 'root_button_type' ),
				'label'   => __( 'Select button type', 'aesthetix' ),
				'options' => get_aesthetix_customizer_button_type(),
			),
			'button_content' => array(
				'type'    => 'select',
				'std'     => 'button-icon-text',
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
		$template_args['style']          = isset( $instance['style'] ) ? $instance['style'] : $this->settings['style']['std'];
		$template_args['structure']      = isset( $instance['structure'] ) ? $instance['structure'] : $this->settings['structure']['std'];
		$template_args['button_type']    = isset( $instance['button_type'] ) ? $instance['button_type'] : $this->settings['button_type']['std'];
		$template_args['button_content'] = isset( $instance['button_content'] ) ? $instance['button_content'] : $this->settings['button_content']['std'];

		get_template_part( 'templates/widget/widget-buttons', '', $template_args );

		$this->widget_end( $args, $instance );
	}
}
