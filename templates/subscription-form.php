<?php
/**
 * Template part for displaying subscription form.
 * 
 * Form js handler  - /assets/js/source/subscription-from-handler.js
 * Setup js scripts - /inc/setup.php
 * Form php handler - /inc/handlers.php
 * Form html        - /templates/subscription-form.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 * @since 1.1.2
 */

if ( get_aesthetix_options( 'general_subscription_form_type' ) !== 'none' ) {

	$classes[] = 'section_subscription-form';

	if ( get_aesthetix_options( 'general_subscription_form_bg' ) ) {
		$background_image = get_aesthetix_options( 'general_subscription_form_bg' );
		$classes[] = 'has_background';
	}

	$available_tags   = array(
		'b' => array(),
		'a' => array(
			'href'   => array(),
			'target' => array(),
			'class'  => array(),
		),
	); ?>

	<section id="section-subscription-from" <?php aesthetix_section_classes( $classes ); ?><?php echo isset( $background_image ) ? ' style="background: url( ' . esc_url( $background_image ) . ' ) center bottom/cover no-repeat"' : ''; ?> aria-label="<?php esc_attr_e( 'Subscription Form', 'aesthetix' ); ?>">
		<div <?php aesthetix_container_classes(); ?>>

			<div class="title-wrapper">
				<h2 class="form-title"><?php echo apply_filters( 'get_aesthetix_general_subscription_form_title', esc_html__( 'Stay in the loop', 'aesthetix' ) ); ?></h2>
				<p class="form-subtitle"><?php echo apply_filters( 'get_aesthetix_general_subscription_form_subtitle', esc_html__( 'Subscribe to our newsletter for all the latest updates:', 'aesthetix' ) ); ?></p>
			</div>

			<?php if ( get_aesthetix_options( 'general_subscription_form_type' ) === 'mailchimp' && ! empty( get_aesthetix_options( 'general_subscription_form_shortcode' ) ) ) { ?>
				<?php echo do_shortcode( get_aesthetix_options( 'general_subscription_form_shortcode' ) ); ?>
			<?php } else { ?>
				<form id="subscription-from" class="form subscription-from">
					<label class="form-label" for="form-email">
						<input id="form-email" class="form-input required" type="email" name="form-email" placeholder="<?php esc_attr_e( 'E-mail? (required)', 'aesthetix' ) ?>" value="" required>
					</label>
					<input id="form-anticheck" class="form-anticheck" type="checkbox" name="form-anticheck" style="display: none !important;" value="true" checked="checked">
					<input id="form-submitted" type="text" name="form-submitted" value="" style="display: none !important;">
					<p class="form-confirm-text"><?php echo sprintf( wp_kses( __( 'By submitting this form, you confirm that you agree to the storage and processing of your personal data described in our <a class="%s" href="%s" target="_blank">Privacy Policy</a>', 'aesthetix' ), $available_tags ), esc_attr( implode( ' ', get_link_classes() ) ), esc_url( get_privacy_policy_url() ) ) ?></p>
					<button id="form-submit" <?php button_classes( 'form-submit icon icon_envelope' ); ?> type="submit" data-process-text="<?php esc_attr_e( 'Sending...', 'aesthetix' ); ?>" data-default-text="<?php esc_attr_e( 'Subscribe', 'aesthetix' ); ?>"><?php esc_html_e( 'Subscribe', 'aesthetix' ); ?></button>
				</form>
			<?php } ?>
		</div>
	</section>
<?php }
