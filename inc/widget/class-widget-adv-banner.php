<?php
/**
 * Widget Adv Banner.
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WPA_Widget_Adv_Banner extends WPA_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'widget-adv-banner';
		$this->widget_description = __( 'This widget displays an advertising banner', 'aesthetix' );
		$this->widget_id          = 'aesthetix-widget-adv-banner';
		$this->widget_name        = get_widget_name( 'WPA_Widget_Adv_Banner' );
		$this->settings           = array(
			'title'           => array(
				'type'  => 'text',
				'std'   => '',
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
			'adv_desktop'     => array(
				'type'  => 'image',
				'std'   => get_theme_file_uri( '/assets/img/promo/promo-default-002.jpg' ),
				'label' => __( 'Desktop banner', 'aesthetix' ),
			),
			'adv_tablet'      => array(
				'type'  => 'image',
				'std'   => '',
				'label' => __( 'Tablet banner', 'aesthetix' ),
			),
			'adv_mobile'      => array(
				'type'  => 'image',
				'std'   => '',
				'label' => __( 'Mobile banner', 'aesthetix' ),
			),
			'adv_link'        => array(
				'type'  => 'url',
				'std'   => 'https://aesthetix-pro.zolin.digital/',
				'label' => __( 'Link', 'aesthetix' ),
			),
			'adv_alt'       => array(
				'type'  => 'text',
				'std'   => __( 'Banner', 'aesthetix' ),
				'label' => __( 'Banner alt', 'aesthetix' ),
			),
			'adv_title'       => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Banner title', 'aesthetix' ),
			),
			'adv_description' => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Banner description', 'aesthetix' ),
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
		$template_args['adv_tablet']      = isset( $instance['adv_tablet'] ) ? $instance['adv_tablet'] : $this->settings['adv_tablet']['std'];
		$template_args['adv_mobile']      = isset( $instance['adv_mobile'] ) ? $instance['adv_mobile'] : $this->settings['adv_mobile']['std'];
		$template_args['adv_link']        = isset( $instance['adv_link'] ) && wp_http_validate_url( $instance['adv_link'] ) ? $instance['adv_link'] : $this->settings['adv_link']['std'];
		$template_args['adv_alt']         = isset( $instance['adv_alt'] ) ? $instance['adv_alt'] : $this->settings['adv_alt']['std'];
		$template_args['adv_title']       = isset( $instance['adv_title'] ) ? $instance['adv_title'] : $this->settings['adv_title']['std'];
		$template_args['adv_description'] = isset( $instance['adv_description'] ) ? $instance['adv_description'] : $this->settings['adv_description']['std'];

		get_template_part( 'templates/widget/widget-adv-banner', '', $template_args );

		$this->widget_end( $args, $instance );
	}
}
