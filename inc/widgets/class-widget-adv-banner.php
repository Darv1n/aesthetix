<?php
/**
 * Adv banner Widget.
 * 
 * @since 1.2.6
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Adv banner widget class.
 *
 * @extends WPA_Widget
 * 
 * @since 1.2.6
 */
class WPA_Widget_Adv_Banner extends WPA_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'widget_adv_banner';
		$this->widget_description = __( 'This widget displays an advertising banner', 'aesthetix' );
		$this->widget_id          = 'aesthetix_widget_adv_banner';
		$this->widget_name        = __( 'Aesthetix adv banner', 'aesthetix' );
		$this->settings           = array(
			'title'    => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Title', 'aesthetix' ),
			),
			'adv_desktop' => array(
				'type'  => 'image',
				'std'   => '',
				'label' => __( 'Banner', 'aesthetix' ),
			),
			'adv_link' => array(
				'type'  => 'url',
				'std'   => '',
				'label' => __( 'Link', 'aesthetix' ),
			),
			'adv_description' => array(
				'type'  => 'description',
				'std'   => '',
				'label' => __( 'Description', 'aesthetix' ),
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

		$template_args                    = array();
		$template_args['adv_desktop']     = isset( $instance['adv_desktop'] ) ? $instance['adv_desktop'] : $this->settings['adv_desktop']['std'];
		$template_args['adv_link']        = isset( $instance['adv_link'] ) && wp_http_validate_url( $instance['adv_link'] ) ? $instance['adv_link'] : $this->settings['adv_link']['std'];
		$template_args['adv_description'] = isset( $instance['adv_description'] ) ? $instance['adv_description'] : $this->settings['adv_description']['std'];

		get_template_part( 'templates/adv-banner', '', $template_args );

		$this->widget_end( $args, $instance );
	}
}
