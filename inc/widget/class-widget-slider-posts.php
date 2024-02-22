<?php
/**
 * Widget Post Slider.
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WPA_Widget_Slider_Posts extends WPA_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'widget-slider-posts';
		$this->widget_description = __( 'This widget displays recent posts with aesthetix style', 'aesthetix' );
		$this->widget_id          = 'aesthetix-widget-slider-posts';
		$this->widget_name        = get_widget_name( 'WPA_Widget_Slider_Posts' );
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
			'display'             => array(
				'type'    => 'select',
				'std'     => 'all',
				'label'   => __( 'Choose how to display the widget', 'aesthetix' ),
				'options' => get_aesthetix_customizer_display(),
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
			'posts_to_show'       => array(
				'type'  => 'number',
				'min'   => 1,
				'max'   => 12,
				'step'  => 1,
				'std'   => 4,
				'label' => __( 'Select posts to show', 'aesthetix' ),
			),
			'posts_per_page'      => array(
				'type'  => 'number',
				'min'   => 2,
				'max'   => 12,
				'step'  => 1,
				'std'   => 8,
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
				'std'     => 'h4',
				'label'   => __( 'Select title size', 'aesthetix' ),
				'options' => get_aesthetix_customizer_title_size(),
			),
			'post_layout'         => array(
				'type'    => 'select',
				'std'     => 'grid',
				'label'   => __( 'Select posts layout', 'aesthetix' ),
				'options' => get_aesthetix_customizer_archive_post_layout(),
			),
			'post_structure'      => array(
				'type'    => 'sortable',
				'std'     => 'meta,title,author,more',
				'label'   => __( 'Post structure', 'aesthetix' ),
				'options' => get_aesthetix_customizer_archive_post_structure(),
			),
			'post_meta_structure' => array(
				'type'    => 'sortable',
				'std'     => 'date,category,post_tag,time,views,edit',
				'label'   => __( 'Post meta structure', 'aesthetix' ),
				'options' => get_aesthetix_customizer_post_meta_structure(),
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

		$post_args                        = array();
		$post_args['background_color']    = isset( $instance['background_color'] ) ? $instance['background_color'] : $this->settings['background_color']['std'];
		$post_args['background_image']    = isset( $instance['background_image'] ) ? $instance['background_image'] : $this->settings['background_image']['std'];
		$post_args['posts_to_show']       = isset( $instance['posts_to_show'] ) ? $instance['posts_to_show'] : $this->settings['posts_to_show']['std'];
		$post_args['posts_per_page']      = isset( $instance['posts_per_page'] ) ? $instance['posts_per_page'] : $this->settings['posts_per_page']['std'];
		$post_args['order']               = isset( $instance['posts_order'] ) ? $instance['posts_order'] : $this->settings['posts_order']['std'];
		$post_args['orderby']             = isset( $instance['posts_orderby'] ) ? $instance['posts_orderby'] : $this->settings['posts_orderby']['std'];
		$post_args['post_title_size']     = isset( $instance['post_title_size'] ) ? $instance['post_title_size'] : $this->settings['post_title_size']['std'];
		$post_args['post_layout']         = isset( $instance['post_layout'] ) ? $instance['post_layout'] : $this->settings['post_layout']['std'];
		$post_args['post_structure']      = isset( $instance['post_structure'] ) ? $instance['post_structure'] : $this->settings['post_structure']['std'];
		$post_args['post_meta_structure'] = isset( $instance['post_meta_structure'] ) ? $instance['post_meta_structure'] : $this->settings['post_meta_structure']['std'];
		$post_args['button_size']         = 'xxs';

		get_template_part( 'templates/widget/widget-slider-posts', '', $post_args );

		$this->widget_end( $args, $instance );
	}
}
