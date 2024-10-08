<?php
/**
 * Widget Recent Posts.
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WPA_Widget_Recent_Posts extends WPA_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'widget-recent-posts';
		$this->widget_description = __( 'This widget displays recent posts with aesthetix style', 'aesthetix' );
		$this->widget_id          = 'aesthetix-widget-recent-posts';
		$this->widget_name        = get_widget_name( 'WPA_Widget_Recent_Posts' );
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
			'posts_per_page'      => array(
				'type'  => 'number',
				'min'   => 1,
				'max'   => 12,
				'step'  => 1,
				'std'   => 4,
				'label' => __( 'Select posts count', 'aesthetix' ),
			),
			'posts_order'         => array(
				'type'    => 'select',
				'std'     => get_aesthetix_options( 'archive_post_posts_order' ),
				'label'   => __( 'Select posts order', 'aesthetix' ),
				'options' => get_aesthetix_customizer_archive_post_order(),
			),
			'posts_orderby'       => array(
				'type'    => 'select',
				'std'     => get_aesthetix_options( 'archive_post_posts_orderby' ),
				'label'   => __( 'Select posts orderby', 'aesthetix' ),
				'options' => get_aesthetix_customizer_archive_post_orderby(),
			),
			'post_title_size'      => array(
				'type'    => 'select',
				'std'     => 'h6',
				'label'   => __( 'Select title size', 'aesthetix' ),
				'options' => get_aesthetix_customizer_title_size(),
			),
			'post_layout'         => array(
				'type'    => 'select',
				'std'     => 'list',
				'label'   => __( 'Select posts layout', 'aesthetix' ),
				'options' => get_aesthetix_customizer_archive_post_layout(),
			),
			'post_structure'      => array(
				'type'    => 'sortable',
				'std'     => 'title,meta',
				'label'   => __( 'Post structure', 'aesthetix' ),
				'options' => get_aesthetix_customizer_archive_post_structure(),
			),
			'post_meta_structure' => array(
				'type'    => 'sortable',
				'std'     => 'author,date',
				'label'   => __( 'Post meta structure', 'aesthetix' ),
				'options' => get_aesthetix_customizer_post_meta_structure(),
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
			'display'             => array(
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

		$template_args                        = array();
		$template_args['posts_per_page']      = isset( $instance['posts_per_page'] ) ? $instance['posts_per_page'] : $this->settings['posts_per_page']['std'];
		$template_args['order']               = isset( $instance['posts_order'] ) ? $instance['posts_order'] : $this->settings['posts_order']['std'];
		$template_args['orderby']             = isset( $instance['posts_orderby'] ) ? $instance['posts_orderby'] : $this->settings['posts_orderby']['std'];
		$template_args['post_title_size']     = isset( $instance['post_title_size'] ) ? $instance['post_title_size'] : $this->settings['post_title_size']['std'];
		$template_args['post_layout']         = isset( $instance['post_layout'] ) ? $instance['post_layout'] : $this->settings['post_layout']['std'];
		$template_args['post_structure']      = isset( $instance['post_structure'] ) ? $instance['post_structure'] : $this->settings['post_structure']['std'];
		$template_args['post_meta_structure'] = isset( $instance['post_meta_structure'] ) ? $instance['post_meta_structure'] : $this->settings['post_meta_structure']['std'];
		$template_args['button_size']         = 'xxs';
		$template_args['background_color']    = isset( $instance['background_color'] ) ? $instance['background_color'] : $this->settings['background_color']['std'];
		$template_args['background_image']    = isset( $instance['background_image'] ) ? $instance['background_image'] : $this->settings['background_image']['std'];
		$template_args['display']             = isset( $instance['display'] ) ? $instance['display'] : $this->settings['display']['std'];

		get_template_part( 'templates/widget/widget-recent-posts', '', $template_args );

		$this->widget_end( $args, $instance );
	}
}
