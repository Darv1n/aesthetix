<?php
/**
 * Widget Subscribe Form.
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WPA_Widget_Subscribe_Form extends WPA_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'widget-subscribe-form';
		$this->widget_description = __( 'The global settings for this form can be found in the Customizer', 'aesthetix' );
		$this->widget_id          = 'aesthetix-widget-subscribe-form';
		$this->widget_name        = get_widget_name( 'WPA_Widget_Subscribe_Form' );
		$this->settings           = array(
			'title'           => array(
				'type'  => 'text',
				'std'   => __( 'Subscribe to our newsletter for all the latest updates', 'aesthetix' ),
				'label' => __( 'Title', 'aesthetix' ),
			),
			'subtitle'        => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Subtitle', 'aesthetix' ) . ' (' . mb_strtolower( __( 'Before title', 'aesthetix' ) ) . ')',
			),
			'description'     => array(
				'type'  => 'textarea',
				'std'   => '',
				'label' => __( 'Description', 'aesthetix' ) . ' (' . mb_strtolower( __( 'After title', 'aesthetix' ) ) . ')',
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
			'form_shortcode'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Subscribe form shortcode. Use this field if you are using a subscription plugin, e.g. Mailchimp, MailPoet, Newsletter', 'aesthetix' ),
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
		$template_args['background_color'] = isset( $instance['background_color'] ) ? $instance['background_color'] : $this->settings['background_color']['std'];
		$template_args['background_image'] = isset( $instance['background_image'] ) ? $instance['background_image'] : $this->settings['background_image']['std'];
		$template_args['form_shortcode']   = isset( $instance['form_shortcode'] ) ? $instance['form_shortcode'] : $this->settings['form_shortcode']['std'];

		get_template_part( 'templates/widget/widget-subscribe-form', '', $template_args );

		$this->widget_end( $args, $instance );
	}
}
