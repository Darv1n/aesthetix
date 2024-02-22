<?php
/**
 * Widget Menus.
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WPA_Widget_Menus extends WPA_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {

		$menus = get_registered_nav_menus();
		unset( $menus['primary'] );
		unset( $menus['mobile'] );

		$this->widget_cssclass    = 'widget-menus';
		$this->widget_description = __( 'The global settings for this form can be found in the Customizer', 'aesthetix' );
		$this->widget_id          = 'aesthetix-widget-menus';
		$this->widget_name        = get_widget_name( 'WPA_Widget_Menus' );
		$this->settings           = array(
			'title'               => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Title', 'aesthetix' ),
			),
			'subtitle'            => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Subtitle', 'aesthetix' ) . ' (' . mb_strtolower( __( 'Before title', 'aesthetix' ) ) . ')',
			),
			'description'         => array(
				'type'  => 'textarea',
				'std'   => '',
				'label' => __( 'Description', 'aesthetix' ) . ' (' . mb_strtolower( __( 'After title', 'aesthetix' ) ) . ')',
			),
			'background_color'    => array(
				'type'    => 'select',
				'std'     => get_aesthetix_options( 'root_bg_aside_widgets' ),
				'label'   =>__( 'Background color', 'aesthetix' ),
				'options' => get_aesthetix_customizer_background_colors(),
			),
			'background_image'    => array(
				'type'  => 'image',
				'std'   => '',
				'label' => __( 'Background image (used instead of background color)', 'aesthetix' ),
			),
			'columns'             => array(
				'type'    => 'select',
				'std'     => 2,
				'label'   => __( 'Select count columns', 'aesthetix' ),
				'options' => array(
					1 => __( 'One', 'aesthetix' ),
					2 => __( 'Two', 'aesthetix' ),
					3 => __( 'Three', 'aesthetix' ),
					4 => __( 'Four', 'aesthetix' ),
				),
			),
			'menu_structure'      => array(
				'type'    => 'sortable',
				'std'     => implode( ',', array_keys( $menus ) ),
				'label'   => __( 'Menus structure', 'aesthetix' ),
				'options' => $menus,
			),
			'count_items_display' => array(
				'type'  => 'checkbox',
				'std'   => true,
				'label' => __( 'Count category items display', 'aesthetix' ),
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

		$template_args                        = array();
		$template_args['background_color']    = isset( $instance['background_color'] ) ? $instance['background_color'] : $this->settings['background_color']['std'];
		$template_args['background_image']    = isset( $instance['background_image'] ) ? $instance['background_image'] : $this->settings['background_image']['std'];
		$template_args['columns']             = isset( $instance['columns'] ) ? $instance['columns'] : $this->settings['columns']['std'];
		$template_args['menu_structure']      = isset( $instance['menu_structure'] ) ? $instance['menu_structure'] : $this->settings['menu_structure']['std'];
		$template_args['count_items_display'] = isset( $instance['count_items_display'] ) ? (bool) $instance['count_items_display'] : $this->settings['count_items_display']['std'];

		get_template_part( 'templates/widget/widget-menus', '', $template_args );

		$this->widget_end( $args, $instance );
	}
}
