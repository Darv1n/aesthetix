<?php
/**
 * Template part for displaying subscribe form.
 * 
 * Form js handler  - /assets/js/source/subscribe-from-handler.js
 * Setup js scripts - /inc/setup.php
 * Form php handler - /inc/handlers.php
 * Form html        - /templates/subscribe-form.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 * @since 1.1.2
 */

$section_wrapper = isset( $args['section'] ) ?? false;
$form_title      = $args['title'] ?? false;
$classes[]       = 'section_subscribe-form';

if ( get_aesthetix_options( 'general_subscribe_form_bg' ) ) {
	$background_image = get_aesthetix_options( 'general_subscribe_form_bg' );
	$classes[] = 'has_background';
} ?>

<?php if ( $section_wrapper ) { ?>
	<section id="section-subscribe-from" <?php aesthetix_section_classes( $classes ); ?><?php echo isset( $background_image ) ? ' style="background: url( ' . esc_url( $background_image ) . ' ) center bottom/cover no-repeat"' : ''; ?> aria-label="<?php esc_attr_e( 'subscribe Form', 'aesthetix' ); ?>">
		<div <?php aesthetix_container_classes(); ?>>
<?php } ?>

	<?php if ( get_aesthetix_options( 'general_subscribe_form_type' ) !== 'theme' && ! empty( get_aesthetix_options( 'general_subscribe_form_shortcode' ) ) ) { ?>
		<?php echo do_shortcode( esc_html( get_aesthetix_options( 'general_subscribe_form_shortcode' ) ) ); ?>
	<?php } else { ?>
		<form id="subscribe-from" class="form subscribe-from">
			<?php if ( $form_title ) { ?>
				<h2 class="form-title h3"><?php echo esc_html( $form_title ); ?></h2>
			<?php } ?>
			<label class="form-label" for="form-email">
				<input id="form-email" class="form-input required" type="email" name="form-email" placeholder="<?php esc_attr_e( 'E-mail? (required)', 'aesthetix' ) ?>" value="" required>
			</label>
			<input id="form-anticheck" class="form-anticheck" type="checkbox" name="form-anticheck" style="display: none !important;" value="true" checked="checked">
			<input id="form-submitted" type="text" name="form-submitted" value="" style="display: none !important;">
			<p class="form-confirm-text"><?php echo sprintf( wp_kses( __( 'By submitting this form, you confirm that you agree to the storage and processing of your personal data described in our <a class="%s" href="%s" target="_blank">Privacy Policy</a>', 'aesthetix' ), kses_available_tags() ), esc_attr( implode( ' ', get_link_classes() ) ), esc_url( get_privacy_policy_url() ) ) ?></p>
			<button id="form-submit" <?php button_classes( 'form-submit icon icon_envelope' ); ?> type="submit" data-process-text="<?php esc_attr_e( 'Sending...', 'aesthetix' ); ?>" data-default-text="<?php esc_attr_e( 'Subscribe', 'aesthetix' ); ?>"><?php esc_html_e( 'Subscribe', 'aesthetix' ); ?></button>
		</form>
	<?php } ?>

<?php if ( $section_wrapper ) { ?>
		</div>
	</section>
<?php }