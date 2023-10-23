<?php
/**
 * Subscribe Form Widget.
 * 
 * @since 1.2.0
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Subscribe form widget class.
 *
 * @extends WC_Widget
 * 
 * @since 1.2.0
 */
class WP_Widget_Subscribe_Form extends WPA_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'widget_subscribe_form';
		$this->widget_description = __( 'The global settings for this form can be found in the Customizer', 'aesthetix' );
		$this->widget_id          = 'aesthetix_subscribe_form_widget';
		$this->widget_name        = __( 'Subscribe form', 'aesthetix' );
		$this->settings           = array(
			'title'       => array(
				'type'  => 'text',
				'std'   => get_aesthetix_options( 'general_subscribe_form_title' ),
				'label' => __( 'Title', 'aesthetix' ),
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

		get_template_part( 'templates/subscribe-form' );

		$this->widget_end( $args, $instance );
	}
}
