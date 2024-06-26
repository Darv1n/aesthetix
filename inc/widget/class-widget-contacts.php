<?php
/**
 * Widget Contacts.
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WPA_Widget_Contacts extends WPA_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'widget-contacts';
		$this->widget_description = __( 'The global settings for this form can be found in the Customizer', 'aesthetix' );
		$this->widget_id          = 'aesthetix-widget-contacts';
		$this->widget_name        = get_widget_name( 'WPA_Widget_Contacts' );
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
			'style'            => array(
				'type'    => 'select',
				'std'     => 'inline',
				'label'   => __( 'Select style block', 'aesthetix' ),
				'options' => array( 'inline' => __( 'Inline', 'aesthetix' ), 'block' => __( 'Block', 'aesthetix' ) ),
			),
			'address'          => array(
				'type'  => 'text',
				'std'   => get_aesthetix_options( 'other_address' ),
				'label' => __( 'Address', 'aesthetix' ),
			),
			'phone'            => array(
				'type'  => 'text',
				'std'   => get_aesthetix_options( 'other_phone' ),
				'label' => __( 'Phone', 'aesthetix' ),
			),
			'email'            => array(
				'type'  => 'email',
				'std'   => get_aesthetix_options( 'other_email' ),
				'label' => __( 'Email', 'aesthetix' ),
			),
			'whatsapp'         => array(
				'type'  => 'text',
				'std'   => get_aesthetix_options( 'other_whatsapp' ),
				'label' => __( 'WhatsApp', 'aesthetix' ),
			),
			'telegram'         => array(
				'type'  => 'url',
				'std'   => get_aesthetix_options( 'other_telegram_chat' ),
				'label' => __( 'Telegram', 'aesthetix' ),
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
		$template_args['address']          = isset( $instance['address'] ) ? $instance['address'] : $this->settings['address']['std'];
		$template_args['phone']            = isset( $instance['phone'] ) ? $instance['phone'] : $this->settings['phone']['std'];
		$template_args['email']            = isset( $instance['email'] ) ? $instance['email'] : $this->settings['email']['std'];
		$template_args['whatsapp']         = isset( $instance['whatsapp'] ) ? $instance['whatsapp'] : $this->settings['whatsapp']['std'];
		$template_args['telegram']         = isset( $instance['telegram'] ) ? $instance['telegram'] : $this->settings['telegram']['std'];
		$template_args['background_color'] = isset( $instance['background_color'] ) ? $instance['background_color'] : $this->settings['background_color']['std'];
		$template_args['background_image'] = isset( $instance['background_image'] ) ? $instance['background_image'] : $this->settings['background_image']['std'];
		$template_args['display']          = isset( $instance['display'] ) ? $instance['display'] : $this->settings['display']['std'];

		get_template_part( 'templates/widget/widget-contacts', '', $template_args );

		$this->widget_end( $args, $instance );
	}
}
