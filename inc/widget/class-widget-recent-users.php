<?php
/**
 * Widget Recent Users.
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WPA_Widget_Recent_Users extends WPA_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'widget-recent-users';
		$this->widget_description = __( 'The global settings for this form can be found in the Customizer', 'aesthetix' );
		$this->widget_id          = 'aesthetix-widget-recent-users';
		$this->widget_name        = get_widget_name( 'widget-recent-users' );
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
			'number'      => array(
				'type'  => 'number',
				'min'   => 1,
				'max'   => 12,
				'step'  => 1,
				'std'   => 4,
				'label' => __( 'Select users count', 'aesthetix' ),
			),
			'orderby'     => array(
				'type'    => 'select',
				'std'     => 'post_count',
				'label'   => __( 'Select how to orderby users', 'aesthetix' ),
				'options' => array( 
					'post_count' => __( 'Post count', 'aesthetix' ),
				),
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

		$template_args            = array();
		$template_args['number']  = isset( $instance['number'] ) ? $instance['number'] : $this->settings['number']['std'];
		$template_args['orderby'] = isset( $instance['orderby'] ) ? $instance['orderby'] : $this->settings['orderby']['std'];

		if ( ! in_array( $args['id'], array( 'before-post-content', 'after-post-content' ), true ) ) {
			$template_args['container_class'] = 'user-aside';
		}

		get_template_part( 'templates/widget/widget-recent-users', '', $template_args );

		$this->widget_end( $args, $instance );
	}
}