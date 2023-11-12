<?php
/**
 * Aesthetix Posts Widget.
 * 
 * @since 1.3.1
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Aesthetix Posts Widget class.
 *
 * @extends WPA_Widget
 * 
 * @since 1.3.1
 */
class WPA_Widget_Recent_Posts extends WPA_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'widget_posts';
		$this->widget_description = __( 'This widget displays recent posts with aesthetix style', 'aesthetix' );
		$this->widget_id          = 'aesthetix_widget_posts';
		$this->widget_name        = __( 'Aesthetix posts', 'aesthetix' );
		$this->settings           = array(
			'title'                        => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Title', 'aesthetix' ),
			),
			'posts_layout'                 => array(
				'type'    => 'select',
				'std'     => get_aesthetix_options( 'archive_post_layout' ),
				// 'std'     => 'list',
				'label'   => __( 'Select posts layout', 'aesthetix' ),
				'options' => get_aesthetix_customizer_archive_post_layout(),
			),
			'posts_order'                  => array(
				'type'    => 'select',
				'std'     => get_aesthetix_options( 'archive_post_posts_order' ),
				'label'   => __( 'Select posts order', 'aesthetix' ),
				'options' => get_aesthetix_customizer_archive_post_order(),
			),
			'posts_orderby'                => array(
				'type'    => 'select',
				'std'     => get_aesthetix_options( 'archive_post_posts_orderby' ),
				'label'   => __( 'Select posts orderby', 'aesthetix' ),
				'options' => get_aesthetix_customizer_archive_post_orderby(),
			),
			'posts_count'                  => array(
				'type'  => 'number',
				'min'   => 1,
				'max'   => 12,
				'step'  => 1,
				'std'   => 4,
				'label' => __( 'Select posts count', 'aesthetix' ),
			),
			'post_structure'               => array(
				'type'    => 'sortable',
				'std'     => 'taxonomies,title,meta',
				'label'   => __( 'Post structure', 'aesthetix' ),
				'options' => get_aesthetix_customizer_archive_post_structure(),
			),
			'post_meta_structure'          => array(
				'type'    => 'sortable',
				'std'     => 'author,date',
				'label'   => __( 'Post meta structure', 'aesthetix' ),
				'options' => get_aesthetix_customizer_post_meta_structure(),
			),
			'post_taxonomies_structure'    => array(
				'type'    => 'sortable',
				'std'     => 'category',
				'label'   => __( 'Post taxonomies structure', 'aesthetix' ),
				'options' => get_aesthetix_customizer_post_taxonomies_structure(),
			),
			'post_taxonomies_in_thumbnail' => array(
				'type'  => 'checkbox',
				'std'   => false,
				'label' => __( 'Display taxonomies in thumbnail', 'aesthetix' ),
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

		$post_args['order']                        = isset( $instance['posts_order'] ) ? $instance['posts_order'] : $this->settings['posts_order']['std'];
		$post_args['orderby']                      = isset( $instance['posts_orderby'] ) ? $instance['posts_orderby'] : $this->settings['posts_orderby']['std'];
		$post_args['posts_per_page']               = isset( $instance['posts_count'] ) ? $instance['posts_count'] : $this->settings['posts_count']['std'];
		$post_args['post_layout']                  = isset( $instance['posts_layout'] ) ? $instance['posts_layout'] : $this->settings['posts_layout']['std'];
		$post_args['post_structure']               = isset( $instance['post_structure'] ) ? $instance['post_structure'] : $this->settings['post_structure']['std'];
		$post_args['post_meta_structure']          = isset( $instance['post_meta_structure'] ) ? $instance['post_meta_structure'] : $this->settings['post_meta_structure']['std'];
		$post_args['post_taxonomies_structure']    = isset( $instance['post_taxonomies_structure'] ) ? $instance['post_taxonomies_structure'] : $this->settings['post_taxonomies_structure']['std'];
		$post_args['post_taxonomies_in_thumbnail'] = isset( $instance['post_taxonomies_in_thumbnail'] ) ? $instance['post_taxonomies_in_thumbnail'] : $this->settings['post_taxonomies_in_thumbnail']['std'];
		$post_args['button_size']                  = 'xxs';

		get_template_part( 'templates/widget/widget-recent-posts', '', $post_args );

		$this->widget_end( $args, $instance );
	}
}
