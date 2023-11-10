<?php
/**
 * Template part for displaying cookie accepter.
 *
 * @since 1.0.0
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */
 ?>

<?php if ( ! is_user_logged_in() && get_aesthetix_options( 'general_cookie_display' ) ) { ?>

	<div id="cookie" class="cookie" style="display: none">
		<div <?php aesthetix_container_classes( 'container-outer' ); ?>>
			<div <?php aesthetix_container_classes( 'container-inner' ); ?>>
				<?php echo sprintf( wp_kses( '<p class="cookie-text">' . __( 'By continuing to use %s, you agree to the use of cookies. More information can be found in the <a class="%s" href="%s" target="_blank">Privacy Policy</a>' .  '</p>', 'aesthetix' ), kses_available_tags() ), wp_parse_url( get_home_url() )['host'], esc_attr( implode( ' ', get_link_classes() ) ), esc_url( get_privacy_policy_url() ) ); ?>
				<div class="cookie-button-wrap">
					<button <?php button_classes( 'cookie-button icon icon-xmark', array( 'button_content' => 'icon', 'button_size' => 'sm' ) ); ?> type="button"></button>
				</div>
			</div>
		</div>
	</div>

<?php }
