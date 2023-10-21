<?php
/**
 * Template part for displaying archive entry post author widget.
 * 
 * @since 1.0.9
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */
 ?>

<?php

$avatar_size = 44;
$avatar_url  = get_avatar_url( get_the_author_meta( 'ID' ), array( 'size' => $avatar_size ) );
$avatar_url  = apply_filters( 'get_aesthetix_avatar_url', $avatar_url );

?>

<div class="post-author" aria-label="<?php esc_attr_e( 'Post author', 'aesthetix' ); ?>">
	<div class="post-author-avatar">
		<img class="avatar avatar-<?php echo esc_attr( $avatar_size ); ?> photo" src="<?php echo esc_url( $avatar_url ); ?>" alt="<?php the_author(); ?>" width="<?php echo esc_attr( $avatar_size ); ?>" height="<?php echo esc_attr( $avatar_size ); ?>">
	</div>
	<div class="post-author-name">
		<span class="screen-reader-text"><?php esc_html_e( 'Posted by', 'aesthetix' ); ?></span>
		<a <?php link_classes(); ?> href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>" rel="author">
			<?php the_author(); ?>
		</a>
	</div>
	<time class="post-author-date" datetime="<?php echo get_the_date( 'Y-m-d\TH:i:sP' ); ?>" data-title="<?php esc_attr_e( 'Publication date', 'aesthetix' ); ?>">
		<?php echo get_the_date( 'j F, Y' ); ?>
	</time>
</div>
