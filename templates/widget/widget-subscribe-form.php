<?php
/**
 * Template part for displaying widget subscribe form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$defaults = array(
	'form_shortcode'  => '',
);

$args = array_merge( $defaults, $args ); ?>

<?php if ( ! empty( $args['form_shortcode'] ) ) { ?>
	<?php echo do_shortcode( esc_html( $args['form_shortcode'] ) ); ?>
<?php } else { ?>
	<form class="form subscribe-from">
		<label class="form-label" for="form-email">
			<input id="form-email" <?php input_classes( 'form-input required' ); ?> type="email" name="form-email" placeholder="<?php esc_attr_e( 'E-mail? (required)', 'aesthetix' ); ?>" value="" required>
		</label>
		<input id="form-anticheck" class="form-anticheck" type="checkbox" name="form-anticheck" style="display: none !important;" value="true" checked="checked">
		<input id="form-submitted" type="text" name="form-submitted" value="" style="display: none !important;">
		<p class="form-confirm-text"><?php echo sprintf( wp_kses( __( 'By submitting this form, you confirm that you agree to the storage and processing of your personal data described in our <a class="%s" href="%s" target="_blank">Privacy Policy</a>', 'aesthetix' ), kses_available_tags() ), esc_attr( implode( ' ', get_link_classes() ) ), esc_url( get_privacy_policy_url() ) ); ?></p>
		<button id="form-submit" <?php button_classes( 'form-submit icon icon-envelope', array( 'button_content' => 'button-icon-text' ) ); ?> type="submit" data-process-text="<?php esc_attr_e( 'Sending...', 'aesthetix' ); ?>" data-default-text="<?php esc_attr_e( 'Subscribe', 'aesthetix' ); ?>"><?php esc_html_e( 'Subscribe', 'aesthetix' ); ?></button>
	</form>
<?php }
