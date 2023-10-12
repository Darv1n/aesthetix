<?php
/**
 * Template part for displaying button subscribe.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 * @since 1.1.8
 */
 ?>

<?php if ( get_aesthetix_options( 'general_subscription_form_type' ) !== 'none' ) { ?>
	<a <?php the_aesthetix_subscribe_button_classes(); ?> href="#section-subscription-from" aria-label="<?php esc_attr_e( 'Scroll Subscription Form', 'aesthetix' ) ?>" role="button">
		<?php if ( ! in_array( get_aesthetix_options( 'general_subscription_form_toggle_type' ), array( 'icon', 'button-icon' ), true ) ) {
			esc_html_e( 'Subscribe', 'aesthetix' );
		} ?>
	</a>
<?php }
