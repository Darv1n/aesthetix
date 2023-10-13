<?php
/**
 * Template part for displaying subscribe popup.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 * @since 1.1.1
 */
 ?>

<aside id="subscribe-popup" class="subscribe-popup popup has-inside mfp-hide" aria-label="<?php esc_attr_e( 'Subscribe Popup', 'aesthetix' ); ?>">
	<div class="popup-inside">
		<?php get_template_part( 'templates/subscribe-form', '', array( 'title' => get_aesthetix_options( 'general_subscribe_form_title' ) ) ); ?>
	</div>
</aside>