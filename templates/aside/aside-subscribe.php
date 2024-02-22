<?php
/**
 * Template part for displaying subscribe popup.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */
 ?>

<aside id="aside-subscribe" class="subscribe-popup popup has-inside mfp-hide" aria-label="<?php esc_attr_e( 'Subscribe popup', 'aesthetix' ); ?>">
	<div class="popup-inside">
		<?php get_template_part( 'templates/widget/widget-subscribe-form' ); ?>
	</div>
</aside>
