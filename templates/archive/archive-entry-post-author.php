<?php
/**
 * Template part for displaying archive entry post author widget.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$defaults = array(
	'avatar_size' => 44,
	'avatar_url'  => get_avatar_url( get_the_author_meta( 'ID' ), array( 'size' => 44 ) ),
);

$args      = array_merge( apply_filters( 'get_aesthetix_archive_entry_post_author_default_args', $defaults, $args ), $args );
$classes[] = 'post-entry-author';

if ( isset( $args['post_equal_height'] ) && $args['post_equal_height'] === 'author' ) {
	$classes[] = 'equal-height';
} ?>

<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" aria-label="<?php esc_attr_e( 'Post author', 'aesthetix' ); ?>">
	<div class="post-entry-author-avatar">
		<img class="avatar avatar-<?php echo esc_attr( $args['avatar_size'] ); ?>" src="<?php echo esc_url( $args['avatar_url'] ); ?>" alt="<?php the_author(); ?>" width="<?php echo esc_attr( $args['avatar_size'] ); ?>" height="<?php echo esc_attr( $args['avatar_size'] ); ?>">
	</div>
	<div class="post-entry-author-name">
		<span class="screen-reader-text"><?php esc_html_e( 'Posted by', 'aesthetix' ); ?></span>
		<a <?php link_classes(); ?> href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
			<?php the_author(); ?>
		</a>
	</div>
	<time class="post-entry-author-date" datetime="<?php echo get_the_date( 'Y-m-d\TH:i:sP' ); ?>" data-title="<?php esc_attr_e( 'Publication date', 'aesthetix' ); ?>">
		<?php echo get_the_date( 'j M, Y' ); ?>
	</time>
</div>
