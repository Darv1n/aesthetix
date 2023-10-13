<?php
/**
 * Template part for displaying archive entry post sticky.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 * @since 1.1.6
 */

if ( is_sticky() || has_post_format() ) { ?>
	<ul class="post-formats" aria-label="<?php esc_attr_e( 'Post Formats', 'aesthetix' ); ?>">
		<?php if ( is_sticky() ) { ?>
			<li <?php button_classes( 'button-small button-disabled post-sticky icon icon_thumbtack', 'gray' ) ?>>
				<?php esc_html_e( 'Sticky', 'aesthetix' ); ?>
			</li>
		<?php } ?>
		<?php if ( has_post_format() ) { ?>
			<li <?php button_classes( 'button-small button-disabled post-format format format-' . get_post_format() . ' icon icon_' . get_post_format(), 'gray' ) ?>>
				<?php echo ucfirst( get_post_format() ); ?>
			</li>
		<?php } ?>
	</ul>
<?php }
