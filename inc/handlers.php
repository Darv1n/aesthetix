<?php
/**
 * Ajax handlers.
 *
 * @package Aesthetix
 * @since 1.1.7
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'ajax_subscription_form_callback' ) ) {

	/**
	 * Subscription form handler.
	 * 
	 * Form js handler  - /assets/js/source/subscription-from-handler.js
	 * Setup js scripts - /inc/setup.php
	 * Form php handler - /inc/handlers.php
	 * Form html        - /templates/subscription-form.php
	 * 
	 * @since 1.1.2
	 */
	function ajax_subscription_form_callback() {

		parse_str( $_POST['query'], $data );

		$errors   = array(); // Error array.
		$message  = array(); // Letter array.
		$email    = sanitize_email( $data['form-email'] );
		$home_url = preg_replace( '/^(http[s]?):\/\//', '', get_home_url() );

		// Check nonce & spam. If hidden field is full or the check is cleared, block sending.
		if ( ! wp_verify_nonce( sanitize_text_field( $_POST['nonce'] ), 'ajax-nonce' ) || ! (bool) sanitize_text_field( $data['form-anticheck'] ) || ! empty( sanitize_text_field( $data['form-submitted'] ) ) ) {
			$errors['form-submit'] = __( 'Your message does not pass the spam filter. If an error occurs, please write to <a href="mailto:team@zolin.digital">team@zolin.digital</a>', 'aesthetix' );
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
			$email_from   = 'noreply@' . $home_url;
			$form_subject = __( 'New subscriber to', 'aesthetix' ) . ' ' . $home_url;
			$headers      = 'From: ' . $home_url . ' <' . $email_from . '>' . "\r\n" . 'Reply-To: ' . $email_from;
			$body         = '';

			foreach ( $message as $key => $value ) {
				$body .= $key . ': ' . $value . "\r\n";
			}
			
			// Send email.
			$wp_mail = wp_mail( $email_to, $form_subject, $body, $headers );

			// Return json about successful sending.
			if ( $wp_mail ) {
				wp_send_json_success( __( 'Subscription completed successfully', 'aesthetix' ) );
			} else {
				$errors['submit'] = __( 'An unknown error occurred while submitting the form. Please write to <a href="mailto:team@zolin.digital">team@zolin.digital</a>', 'aesthetix' );
				wp_send_json_error( $errors );
			}
		}

		// Kill ajax process.
		wp_die();
	}
}
add_action( 'wp_ajax_subscription_form_action', 'ajax_subscription_form_callback' );
add_action( 'wp_ajax_nopriv_subscription_form_action', 'ajax_subscription_form_callback' );