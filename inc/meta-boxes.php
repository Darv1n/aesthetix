<?php
/**
 * Add meta boxes.
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'add_meta_boxes_callback' ) ) {

	/**
	 * Function for 'add_meta_boxes' action-hook.
	 * 
	 * @param string  $post_type Post type.
	 * @param WP_Post $post      Post object.
	 *
	 * @return void
	 */
	function add_meta_boxes_callback( $post_type, $post ) {
		add_meta_box( 'post-gallery', __( 'Post gallery', 'aesthetix' ), 'post_gallery_meta_box_callback', null, 'side', 'low' );
	}
}
add_action( 'add_meta_boxes', 'add_meta_boxes_callback', 10, 2 );

if ( ! function_exists( 'post_gallery_meta_box_callback' ) ) {

	/**
	 * Callabck for 'add_meta_boxes' action-hook add_meta_box() function.
	 * 
	 * @param string $post This object containing the data of the global array $_POST.
	 * @param string $meta This array with the following elements: metabox_id, title, callback.
	 * 
	 * @return void
	 */
	function post_gallery_meta_box_callback( $post, $meta ) {

		// Using nonce for verification.
		wp_nonce_field( 'post_image_gallery', 'post_image_gallery_nonce' );

		// Field value.
		$images = get_post_meta( $post->ID, 'post_image_gallery', true );

		echo '<div id="post_images_container">';
			echo '<ul class="post_images sortable-list">';
				if ( $images ) {

					$images = array_map( 'trim', explode( ',', $images ) );

					foreach ( $images as $key => $image_id ) {

						$image = wp_get_attachment_image_src( $image_id, 'thumbnail' );
						// vardump( $image );
						echo '<li class="image" data-attachment_id="' . esc_attr( $image_id ) . '">';
							echo '<img src="' . esc_url( $image[0] ) . '" class="media-image">';
							echo '<span class="media-remove dashicons dashicons-no-alt" data-attachment_id="' . esc_attr( $image_id ) . '"></span>';
						echo '</li>';
					}
				}

			echo '</ul>';

			echo '<input id="post_image_gallery" name="post_image_gallery" value="" type="hidden">';

		echo '</div>';

		echo '<p class="add_post_images hide-if-no-js">';
			echo '<button class="components-button is-secondary button button-add-post-images" data-action-text="' . esc_html__( 'Select image', 'aesthetix' ) . '" type="button">' . esc_html__( 'Add post gallery images', 'aesthetix' ) . '</button>';
		echo '</p>';
	}
}

if ( ! function_exists( 'save_post_meta_boxes_callback' ) ) {

	/**
	 * Function for 'save_post' action-hook.
	 * 
	 * @param int $post_id Post ID.
	 *
	 * @return void
	 */
	function save_post_meta_boxes_callback( $post_id ) {
		// Let's make sure the field is set.
		if ( ! isset( $_POST['post_image_gallery'] ) || empty( $_POST['post_image_gallery'] ) ) {
			return;
		}

		// Check the nonce of our page, because save_post may be called from a different location.
		if ( ! wp_verify_nonce( $_POST['post_image_gallery_nonce'], 'post_image_gallery' ) ) {
			return;
		}

		// If it's an autosave, we don't do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		// Checking user rights.
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		// Sanitize the value of the input field.
		$data = sanitize_text_field( $_POST['post_image_gallery'] );

		// Updating the data in the database.
		update_post_meta( $post_id, 'post_image_gallery', $data );
	}
}
add_action( 'save_post', 'save_post_meta_boxes_callback' );

if ( ! function_exists( 'admin_enqueue_scripts_mata_boxes_callback' ) ) {

	/**
	 * Load dynamic logic for the meta boxes area.
	 * 
	 * @return void
	 */
	function admin_enqueue_scripts_mata_boxes_callback( $hook_suffix ) {

		global $post;

		if ( in_array( $hook_suffix, array( 'post.php', 'post-new.php' ), true ) ) {
			wp_enqueue_style( 'dashicons' );
			wp_enqueue_script( 'jquery-ui-sortable' );

			wp_enqueue_style( 'aesthetix-meta-boxes', get_theme_file_uri( '/assets/css/admin-meta-boxes.min.css' ), array(), filemtime( get_theme_file_path( '/assets/css/admin-meta-boxes.min.css' ) ) );
			wp_enqueue_script( 'aesthetix-meta-boxes', get_theme_file_uri( '/assets/js/admin-meta-boxes.min.js' ), array( 'jquery', 'jquery-ui-sortable' ), filemtime( get_theme_file_path( '/assets/js/admin-meta-boxes.min.js' ) ), true );
		
			$root_string = '';
			foreach ( get_aesthetix_customizer_roots() as $key => $root_value ) {
				$root_string .= '--' . $key . ': ' . $root_value . ';';
			}

			wp_add_inline_style( 'aesthetix-meta-boxes', ':root {' . esc_attr( $root_string ) . '}' );
		}
	}
}
add_action( 'admin_enqueue_scripts', 'admin_enqueue_scripts_mata_boxes_callback' );
