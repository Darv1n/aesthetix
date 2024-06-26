<?php
/**
 * Comment ajax handlers.
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'ajax_comments_confirmation_resend_callback' ) ) {

	/**
	 * Subscribe form handler.
	 * 
	 * Form js handler  - /assets/js/source/ajax-comments.js
	 * Setup js scripts - /inc/setup.php
	 * Form php handler - /inc/handlers.php
	 * 
	 * @return json
	 */
	function ajax_comments_confirmation_resend_callback() {

		$comment_id = sanitize_text_field( $_POST['comment-id'] );

		if ( is_null( $comment_id ) || empty( $comment_id ) ) {
			wp_send_json_error( __( 'For some reason an empty comment id was sent', 'aesthetix' ) );
		}

		$comment = get_comment( $comment_id );

		if ( ! is_object( $comment ) || is_null( $comment ) ) {
			wp_send_json_error( __( 'For some reason we couldn\'t get you comment', 'aesthetix' ) );
		}

		$url_host     = wp_parse_url( get_home_url(), PHP_URL_HOST );
		$confirm_link = add_query_arg( array( 'comment_id' => $comment->comment_ID, 'comment_confirm' => wp_hash( $comment->comment_author_email ) ), get_permalink( $comment->comment_post_ID ) );
		$delete_link  = add_query_arg( array( 'comment_id' => $comment->comment_ID, 'comment_delete' => wp_hash( $comment->comment_author_email ) ), get_permalink( $comment->comment_post_ID ) );

		$message = '<p>' . sprintf( __( 'A comment was left on the site %s from your email', 'aesthetix' ), '<a href="' . esc_url( get_permalink( $comment->comment_post_ID ) ) . '">' . esc_html( $url_host ) . '</a>' ) . ':</p>';
		$message .= '<p style="font-style: italic">' . $comment->comment_content  . '</p>';
		$message .= '<p>' . __( 'To confirm your comment, follow the link', 'aesthetix' ) . ': <a href="' . esc_url( $confirm_link ) . '" target="_blank">' . esc_html( $confirm_link ) . '</a></p>';
		$message .= '<p>' . __( 'To delete your comment, follow the link', 'aesthetix' ) . ': <a href="' . esc_url( $delete_link ) . '" target="_blank">' . esc_html( $delete_link ) . '</a></p>';

		// Send an email to the user to confirm the comment.
		$result = aesthetix_wp_mail( $message, $comment->comment_author_email );

		// If an error occurs, send a message to the admin with the text of the error.
		if ( $result !== true ) {
			aesthetix_wp_mail( __( 'An error occurred when sending an email to confirm a comment to the user', 'aesthetix' ) . ': ' . $comment->comment_author_email );
		} else {
			wp_send_json_success( __( 'The letter was sent successfully', 'aesthetix' ) );
		}

		// Kill ajax process.
		wp_die();
	}
}
add_action( 'wp_ajax_comments_confirmation_resend_action', 'ajax_comments_confirmation_resend_callback' );
add_action( 'wp_ajax_nopriv_comments_confirmation_resend_action', 'ajax_comments_confirmation_resend_callback' );

if ( ! function_exists( 'ajax_comments_callback' ) ) {

	/**
	 * Subscribe form handler.
	 * 
	 * Form js handler  - /assets/js/source/ajax-comments.js
	 * Setup js scripts - /inc/setup.php
	 * Form php handler - /inc/handlers.php
	 * Form html        - /comments.php
	 * 
	 * @return json
	 */
	function ajax_comments_callback() {

		wp_parse_str( wp_unslash( $_POST['query'] ), $query );

		if ( isset( $query['comment_user_id'] ) ) {
			$user = get_userdata( $query['comment_user_id'] );
			if ( $user ) {
				$query['email']  = $user->user_email;
				$query['author'] = $user->display_name;
			}
			$confirm = 1;
		} else {
			$user = new WP_User();
		}

		$errors = array();

		if ( empty( $query['email'] ) ) {
			$errors['email'] = __( 'Please enter your email address', 'aesthetix' );
		} elseif ( ! is_email( $query['email'] ) ) {
			$errors['email'] = __( 'Email address is incorrect', 'aesthetix' );
		}

		if ( empty( $query['author'] ) ) {
			$errors['author'] = __( 'Please enter your name', 'aesthetix' );
		}

		if ( empty( $query['comment'] ) ) {
			$errors['comment'] = __( 'Please enter your comment', 'aesthetix' );
		}

		if ( ! empty( $errors ) ) {
			wp_send_json_error( $errors );
		}

		// If edit of delete action.
		if ( isset( $query['email'], $query['comment_id'], $query['comment_hash'], $query['comment_action'] ) && wp_hash( $query['email'] ) === $query['comment_hash'] && in_array( $query['comment_action'], array( 'edit', 'delete', 'restore' ), true ) ) {

			if ( $query['comment_action'] === 'edit' ) {
				$args = array(
					'comment_ID'      => $query['comment_id'],
					'comment_content' => $query['comment'],
				);
				$success_content = $query['comment'];
			} elseif ( $query['comment_action'] === 'delete' ) {

				$args = array(
					'parent' => $query['comment_id'],
					'status' => 'approve', // You can adjust the status if needed (e.g., 'approve', 'hold', 'spam', 'trash')
					'fields' => 'ids',
				);

				$children_comments = get_comments( $args );

				if ( count( $children_comments ) > 0 ) {
					$args = array(
						'comment_ID'   => $query['comment_id'],
						'comment_type' => 'deleted',
					);
				} else {

					$comment = get_comment( $query['comment_id'] );

					if ( ! is_null( $comment ) && isset( $comment->comment_ID, $comment->comment_approved ) ) {
						update_comment_meta( $comment->comment_ID, 'prev_status', $comment->comment_approved );
					}

					$update = wp_trash_comment( $query['comment_id'] );
				}

				$success_content = __( 'Comment deleted by user', 'aesthetix' );
			} elseif ( $query['comment_action'] === 'restore' ) {
				$args = array(
					'comment_ID'   => $query['comment_id'],
					'comment_type' => 'comment',
				);

				$comment = get_comment( $query['comment_id'] );

				if ( ! is_null( $comment ) && isset( $comment->comment_ID, $comment->comment_content ) ) {
					$success_content = $comment->comment_content;
					$prev_status     = get_comment_meta( $comment->comment_ID, 'prev_status', true );
					if ( $prev_status ) {
						$args['comment_approved'] = $prev_status;
						delete_comment_meta( $comment->comment_ID, 'prev_status' );
					} else {
						if ( isset( $comment->comment_karma ) && (int) $comment->comment_karma > 10 ) {
							$args['comment_approved'] = 'approve';
						} else {
							$args['comment_approved'] = 'hold';
						}
					}
				}
			}

			if ( isset( $args ) && ! isset( $update ) ) {
				$update = wp_update_comment( $args );

				// Error adding a comment.
				if ( is_wp_error( $update ) ) {
					$data = (int) $update->get_error_data();
					if ( ! empty( $update ) ) {
						$errors['submit'] = $update->get_error_message();
					} else {
						$errors['submit'] = __( 'An unknown error 1 has occurred', 'aesthetix' );
					}
				}

				if ( $update === false ) {
					// $errors['submit'] = __( 'An unknown error 2 has occurred', 'aesthetix' );
				}
			}

			if ( ! empty( $errors ) ) {
				wp_send_json_error( $errors );
			}

			wp_send_json_success( $success_content );
		}

		// Пробуем записать коммент в БД.
		$comment = wp_handle_comment_submission( $query );

		// Ошибка при добавлении комментария.
		if ( is_wp_error( $comment ) ) {
			$data = (int) $comment->get_error_data();
			if ( ! empty( $data ) ) {
				$errors['submit'] = $comment->get_error_message();
			} else {
				$errors['submit'] = __( 'An unknown error has occurred', 'aesthetix' );
			}
			wp_send_json_error( $errors );
		} else {
			update_comment_meta( $comment->comment_ID, 'confirm', 0 );
		}

		// Send an email to the user to confirm or delete the comment.
		$url_host     = wp_parse_url( get_home_url(), PHP_URL_HOST );
		$confirm_link = add_query_arg( array( 'comment_id' => $comment->comment_ID, 'comment_confirm' => wp_hash( $comment->comment_author_email ) ), get_permalink( $comment->comment_post_ID ) );
		$delete_link  = add_query_arg( array( 'comment_id' => $comment->comment_ID, 'comment_delete' => wp_hash( $comment->comment_author_email ) ), get_permalink( $comment->comment_post_ID ) );

		$message = '<p>' . sprintf( __( 'A comment was left on the site %s from your email', 'aesthetix' ), '<a href="' . esc_url( get_permalink( $comment->comment_post_ID ) ) . '">' . esc_html( $url_host ) . '</a>' ) . ':</p>';
		$message .= '<p style="font-style: italic">' . $comment->comment_content  . '</p>';
		$message .= '<p>' . __( 'To confirm your comment, follow the link', 'aesthetix' ) . ': <a href="' . esc_url( $confirm_link ) . '" target="_blank">' . esc_html( $confirm_link ) . '</a></p>';
		$message .= '<p>' . __( 'To delete your comment, follow the link', 'aesthetix' ) . ': <a href="' . esc_url( $delete_link ) . '" target="_blank">' . esc_html( $delete_link ) . '</a></p>';

		// Send an email to the user to confirm the comment.
		$result = aesthetix_wp_mail( $message, $comment->comment_author_email );

		// If an error occurs, send a message to the admin with the text of the error.
		if ( $result !== true ) {
			aesthetix_wp_mail( __( 'An error occurred when sending an email to confirm a comment to the user', 'aesthetix' ) . ': ' . $comment->comment_author_email );
		}

		// wp_send_json_success( $my_key );
		if ( isset( $query['wp-comment-cookies-consent'] ) ) {
			$cookies_consent = (bool) $query['wp-comment-cookies-consent'];
		} else {
			$cookies_consent = false;
		}

		/**
		 * Fires after comment cookies are set.
		 *
		 * @since 3.4.0
		 * @since 4.9.6 The `$cookies_consent` parameter was added.
		 *
		 * @param WP_Comment $comment         Comment object.
		 * @param WP_User    $user            Comment author's user object. The user may not exist.
		 * @param bool       $cookies_consent Comment author's consent to store cookies.
		 */
		do_action( 'set_comment_cookies', $comment, $user, $cookies_consent );

		remove_action( 'pre_get_comments', 'aesthetix_pre_get_comments' );

		// Just in case, record all unconfirmed comments in the option.
		$args = array(
			'fields'     => 'ids',
			'meta_query' => array(
				'relation' => 'OR',
				array(
					'key'     => 'confirm',
					'value'   => '0',
					'compare' => '=',
				),
			),
		);

		$comments_ids = get_comments( $args );

		add_action( 'pre_get_comments', 'aesthetix_pre_get_comments' );

		update_option( 'nonconfirmed_comments', $comments_ids );

		// TODO: Clear page cache.

		$args['comment'] = $comment;

		$output = return_template_part( 'templates/comment/comment', '', $args );

		wp_send_json_success( $output );

		// Kill ajax process.
		wp_die();
	}
}
add_action( 'wp_ajax_comments_action', 'ajax_comments_callback' );
add_action( 'wp_ajax_nopriv_comments_action', 'ajax_comments_callback' );
