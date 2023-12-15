<?php
/**
 * Template part for displaying comment entry content.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$content_classes[] = 'comment-content';

if ( $args['comment']->comment_type === 'deleted' ) {
	$content_classes[] = 'comment-deleted';
} ?>

<div class="<?php echo esc_attr( implode( ' ', $content_classes ) ); ?>">
	<?php if ( $args['comment']->comment_type === 'deleted' ) {
		esc_html_e( 'Comment deleted by user', 'aesthetix' );
	} else {
		echo esc_html( comment_text( $args['comment']->comment_ID ) );
	} ?>
</div>
