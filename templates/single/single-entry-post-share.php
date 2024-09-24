<?php
/**
 * Template part for displaying single entry post share.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$defaults = array(
	'title'                => __( 'Share this post', 'aesthetix' ),
	'button_size'          => get_aesthetix_options( 'root_button_size' ),
	'button_color'         => 'gray',
	'button_type'          => get_aesthetix_options( 'root_button_type' ),
	'button_content'       => 'button-icon',
	'button_border_width'  => get_aesthetix_options( 'root_button_border_width' ),
	'button_border_radius' => get_aesthetix_options( 'root_button_border_radius' ),
	'icon_size'            => get_aesthetix_options( 'root_button_size' ),
	'style'                => 'inline', // inline, block.
);

$args      = array_merge( apply_filters( 'get_aesthetix_single_entry_post_share_default_args', $defaults, $args ), $args );
$classes[] = 'social-list';

if ( $args['style'] === 'block' ) {
	$classes[] = 'social-list-block';
} else {
	$classes[] = 'social-list-inline';
}

if ( $args['button_content'] === 'icon' ) {
	$classes[] = 'social-list-icons';
}

$title          = get_the_title();
$excerpt        = get_the_excerpt();
$permalink      = get_the_permalink();
$attachment_url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );

$socials = array(
	'facebook'  => 'https://www.facebook.com/sharer/sharer.php?u=' . $permalink,
	'twitter'   => 'https://twitter.com/intent/tweet?url=' . $permalink,
	'pinterest' => 'https://pinterest.com/pin/create/button/?url=' . $permalink . '&amp;media=' . $attachment_url . '&amp;description=' . $title,
	'whatsapp'  => 'https://api.whatsapp.com/send?text=*' . $title . '*\n' . $excerpt . '\n' . $permalink,
	'linkedin'  => 'http://www.linkedin.com/shareArticle?url=' . $permalink . '&amp;title=' . $title,
	'tumblr'    => 'http://www.tumblr.com/share/link?url=' . urlencode( $permalink ) . '&amp;name=' . urlencode( $title ) . '&amp;description=' . urlencode( wp_trim_words( $excerpt, 50 ) ),
	'reddit'    => 'http://reddit.com/submit?url=' . $permalink . '&amp;title=' . $title,
); ?>

<div class="shares">
	<h3 class="shares-title"><?php echo esc_html( $args['title'] ); ?></h3>
	<ul class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">

		<?php foreach ( $socials as $key => $social ) { ?>
			<li class="social-list-item">
				<a <?php button_classes( 'icon icon-brand icon-' . $key, $args ); ?> href="<?php echo esc_url( $social ); ?>" rel="noopener noreferrer external">
					<?php if ( ! in_array( $args['button_content'], array( 'icon', 'button-icon' ), true ) ) {
						echo esc_html( mb_ucfirst( get_aesthetix_customizer_share()[ $key ] ) );
					} ?>
				</a>
			</li>
		<?php } ?>

	</ul>
</div>