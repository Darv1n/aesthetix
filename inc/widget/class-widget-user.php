<?php
/**
 * Widget User.
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WPA_Widget_User extends WPA_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'widget-user';
		$this->widget_description = __( 'The global settings for this form can be found in the Customizer', 'aesthetix' );
		$this->widget_id          = 'aesthetix-widget-user';
		$this->widget_name        = get_widget_name( 'widget-user' );
		$this->settings           = array(
			'title'        => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Title', 'aesthetix' ),
			),
			'subtitle'     => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Subtitle', 'aesthetix' ) . ' (' . mb_strtolower( __( 'Before title', 'aesthetix' ) ) . ')',
			),
			'description'  => array(
				'type'  => 'textarea',
				'std'   => '',
				'label' => __( 'Description', 'aesthetix' ) . ' (' . mb_strtolower( __( 'After title', 'aesthetix' ) ) . ')',
			),
			'display_user' => array(
				'type'    => 'select',
				'std'     => 'post_author_default_admin',
				'label'   => __( 'Select which user to display', 'aesthetix' ),
				'options' => array( 
					'admin_only'                => __( 'Only admin', 'aesthetix' ),
					'post_author_only'          => __( 'Only post author', 'aesthetix' ),
					'post_author_default_admin' => __( 'Post author, default admin', 'aesthetix' ),
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

		$template_args                 = array();
		$template_args['display_user'] = isset( $instance['display_user'] ) ? $instance['display_user'] : $this->settings['display_user']['std'];

		if ( ! in_array( $args['id'], array( 'before-post-content', 'after-post-content' ), true ) ) {
			$template_args['container_class'] = 'user-aside';
		}

		get_template_part( 'templates/widget/widget-user', '', $template_args );

		$this->widget_end( $args, $instance );
	}
}
