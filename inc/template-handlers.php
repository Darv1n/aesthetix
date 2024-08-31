<?php
/**
 * Template ajax handlers.
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'ajax_likers_handler_callback' ) ) {

	/**
	 * Loadmore handler.
	 * 
	 * Form js handler  - /assets/js/source/ajax-postviews.js
	 * Setup js scripts - /inc/template-setup.php
	 * Form php handler - /inc/template-handlers.php
	 * 
	 * @return json
	 */
	function ajax_likers_handler_callback() {

		$query = array_map( 'sanitize_text_field', $_POST['query'] );

		// wp_send_json_success( $query );

		if ( ! isset( $query['object_id'] ) || ! is_numeric( $query['object_id'] ) || ! isset( $query['object_type'] ) ) {
			wp_send_json_error();
		}

		global $wpdb;

		foreach ( array( 'like', 'dislike' ) as $key => $value ) {
			if ( isset( $query[ $value ] ) && $query['object_type'] === 'post' ) {

				if ( $query[ $value ] === 'set' ) {
					$in = $wpdb->query(
						$wpdb->prepare(
							"UPDATE {$wpdb->postmeta} SET meta_value = ( meta_value + 1 ) WHERE post_id = %d AND meta_key = %s",
							intval( $query['object_id'] ),
							'_' . $value
						)
					);
				}

				if ( $query[ $value ] === 'unset' ) {
					$in = $wpdb->query(
						$wpdb->prepare(
							"UPDATE {$wpdb->postmeta} SET meta_value = ( meta_value - 1 ) WHERE post_id = %d AND meta_key = %s",
							intval( $query['object_id'] ),
							'_' . $value
						)
					);
				}

				// Insert the post meta field, if it's not exist.
				if ( (bool) $in === false ) {
					$in = $wpdb->insert(
						$wpdb->postmeta,
						array(
							'post_id'    => intval( $query['object_id'] ),
							'meta_key'   => '_' . $value,
							'meta_value' => 1,
						),
						array( '%d', '%s', '%d' ),
					);
				}
			}

			if ( isset( $query[ $value ] ) && $query['object_type'] === 'comment' ) {

				if ( $query[ $value ] === 'set' ) {
					$in = $wpdb->query(
						$wpdb->prepare(
							"UPDATE {$wpdb->commentmeta} SET meta_value = ( meta_value + 1 ) WHERE comment_id = %d AND meta_key = %s",
							intval( $query['object_id'] ),
							'_' . $value
						)
					);
				}

				if ( $query[ $value ] === 'unset' ) {
					$in = $wpdb->query(
						$wpdb->prepare(
							"UPDATE {$wpdb->commentmeta} SET meta_value = ( meta_value - 1 ) WHERE comment_id = %d AND meta_key = %s",
							intval( $query['object_id'] ),
							'_' . $value
						)
					);
				}

				// Insert the post meta field, if it's not exist.
				if ( (bool) $in === false ) {
					$in = $wpdb->insert(
						$wpdb->commentmeta,
						array(
							'comment_id' => intval( $query['object_id'] ),
							'meta_key'   => '_' . $value,
							'meta_value' => 1,
						),
						array( '%d', '%s', '%d' ),
					);
				}
			}
		}

		if ( ! isset( $in ) || (bool) $in === false ) {
			wp_send_json_error( $in );
		} else {
			wp_send_json_success( $in );
		}

		wp_die();
	}
}
add_action( 'wp_ajax_likers_handler', 'ajax_likers_handler_callback' );
add_action( 'wp_ajax_nopriv_likers_handler', 'ajax_likers_handler_callback' );

if ( ! function_exists( 'ajax_postviews_handler_callback' ) ) {

	/**
	 * Loadmore handler.
	 * 
	 * Form js handler  - /assets/js/source/ajax-postviews.js
	 * Setup js scripts - /inc/template-setup.php
	 * Form php handler - /inc/template-handlers.php
	 * 
	 * @return json
	 */
	function ajax_postviews_handler_callback() {

		global $wpdb;

		$post_id  = intval( $_POST['post_id'] ); // Replace with your actual post ID
		$meta_key = 'views'; // Replace with your actual meta key

		// Update the post meta field with the new value.
		$in = $wpdb->query(
			$wpdb->prepare(
				"UPDATE {$wpdb->postmeta} SET meta_value = ( meta_value + 1 ) WHERE post_id = %d AND meta_key = %s",
				$post_id,
				$meta_key
			)
		);

		// Insert the post meta field, if it's not exist.
		if ( (bool) $in === false ) {
			$in = $wpdb->insert(
				$wpdb->postmeta,
				array(
					'post_id'    => $post_id,
					'meta_key'   => $meta_key,
					'meta_value' => 1,
				),
				array( '%d', '%s', '%s' ),
			);
		}

		if ( (bool) $in === false ) {
			wp_send_json_error();
		} else {
			wp_send_json_success();
		}

		wp_die();
	}
}
add_action( 'wp_ajax_postviews_handler', 'ajax_postviews_handler_callback' );
add_action( 'wp_ajax_nopriv_postviews_handler', 'ajax_postviews_handler_callback' );

if ( ! function_exists( 'ajax_loadmore_handler_callback' ) ) {

	/**
	 * Loadmore handler.
	 * 
	 * Form js handler  - /assets/js/source/ajax-loadmore.js
	 * Setup js scripts - /inc/template-setup.php
	 * Form php handler - /inc/template-handlers.php
	 * Html             - /templates/archive/archive-pagination.php
	 * 
	 * @return json
	 */
	function ajax_loadmore_handler_callback() {

		$args          = array_map( 'sanitize_text_field', $_POST['query'] );
		$args['paged'] = (int) sanitize_text_field( $_POST['page'] ) + 1;
		$args          = array_filter( $args );

		$wp_query = new WP_Query( $args );

		if ( $wp_query->have_posts() ) {

			$i = 0;

			// Params for search query (Load on search.php )
			if ( isset( $args['s'] ) && ! empty( $args['s'] ) ) {
				set_query_var( 's', $args['s'] );
				set_query_var( 'search_terms', explode( ' ', $args['s'] ) );
			}

			ob_start();

			while ( $wp_query->have_posts() ):
				$wp_query->the_post(); ?>

				<div <?php aesthetix_archive_page_columns_classes( $i ); ?>>

					<?php
						if ( in_array( get_aesthetix_options( 'archive_' . get_post_type() . '_layout' ), array( 'list', 'list-chess' ), true ) ) {
							get_template_part( 'templates/archive/archive-post-list', get_post_type(), array( 'counter' => $i ) );
						} else {
							if ( has_post_format() ) {
								if ( get_theme_file_path( 'templates/archive/archive-post-' . get_post_type() . '-' . get_post_format() . '.php' ) ) {
									get_template_part( 'templates/archive/archive-post', get_post_type() . '-' . get_post_format(), array( 'counter' => $i ) );
								} else {
									get_template_part( 'templates/archive/archive-post', get_post_format(), array( 'counter' => $i ) );
								}
							} else {
								get_template_part( 'templates/archive/archive-post', get_post_type(), array( 'counter' => $i ) );
							}
						}

						$i++;
					?>

				</div>

			<?php endwhile;

			$output = ob_get_contents();
			ob_end_clean();

		} else {
			wp_send_json_error( __( 'No posts found', 'aesthetix' ) );
		}

		wp_reset_postdata();

		wp_send_json_success( $output );

		wp_die();
	}
}
add_action( 'wp_ajax_loadmore_handler', 'ajax_loadmore_handler_callback' );
add_action( 'wp_ajax_nopriv_loadmore_handler', 'ajax_loadmore_handler_callback' );

if ( ! function_exists( 'ajax_subscribe_form_callback' ) ) {

	/**
	 * Subscribe form handler.
	 * 
	 * Form js handler  - /assets/js/source/ajax-subscribe-from.js
	 * Setup js scripts - /inc/template-setup.php
	 * Form php handler - /inc/template-handlers.php
	 * Form html        - /templates/subscribe-form.php
	 * 
	 * @return json
	 */
	function ajax_subscribe_form_callback() {

		parse_str( $_POST['query'], $data );

		$errors   = array(); // Error array.
		$message  = array(); // Letter array.
		$email    = sanitize_email( $data['form-email'] );
		$url_host = wp_parse_url( get_home_url(), PHP_URL_HOST );

		// Check nonce & spam. If hidden field is full or the check is cleared, block sending.
		// ! wp_verify_nonce( sanitize_text_field( $_POST['nonce'] ), 'ajax-nonce' )
		if ( ! (bool) sanitize_text_field( $data['form-anticheck'] ) || ! empty( sanitize_text_field( $data['form-submitted'] ) ) ) {
			$errors['form-submit'] = sprintf( __( 'Your message does not pass the spam filter. If an error occurs, please write to <a href="mailto:%s">%s</a>', 'aesthetix' ), get_option( 'admin_email' ), get_option( 'admin_email' ) );
			wp_send_json_error( $errors );
			wp_die( __( 'There was an error submitting the form', 'aesthetix' ) );
		}

		if ( isset( $email ) && ! empty( $email ) ) {
			if ( is_email( $email ) ) {
				$message['form-email'] = $email;
			} else {
				$errors['form-email'] = __( 'Email address is incorrect', 'aesthetix' );
			}
		} else {
			$errors['form-email'] = __( 'Please enter your email address', 'aesthetix' );
		}

		// Сheck error array, if it's not empty, return json error. Otherwise send email.
		if ( $errors ) {
			wp_send_json_error( $errors );
		} else {

			// Specify mail params.
			$email_to[]   = get_option( 'admin_email' );
			$email_from   = 'noreply@' . $url_host;
			$form_subject = __( 'New subscriber to', 'aesthetix' ) . ' ' . $url_host;
			$headers      = 'From: ' . $url_host . ' <' . $email_from . '>' . "\r\n" . 'Reply-To: ' . $email_from;
			$body         = '';

			foreach ( $message as $key => $value ) {
				$body .= $key . ': ' . $value . "\r\n";
			}
			
			// Send email.
			$wp_mail = wp_mail( $email_to, $form_subject, $body, $headers );

			// Error sending email.
			if ( is_wp_error( $wp_mail ) ) {
				$data = (int) $wp_mail->get_error_data();
				if ( ! empty( $wp_mail ) ) {
					$errors['submit'] = $wp_mail->get_error_message();
				} else {
					$errors['submit'] = __( 'An unknown error has occurred', 'aesthetix' );
				}
			} else {
				wp_send_json_success( __( 'Subscribe completed successfully', 'aesthetix' ) );
			}

			if ( ! empty( $errors ) ) {
				wp_send_json_error( $errors );
			}
		}

		// Kill ajax process, just in case.
		wp_die();
	}
}
add_action( 'wp_ajax_subscribe_form_action', 'ajax_subscribe_form_callback' );
add_action( 'wp_ajax_nopriv_subscribe_form_action', 'ajax_subscribe_form_callback' );
