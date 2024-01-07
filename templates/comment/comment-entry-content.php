<?php
/**
 * Template part for displaying comment entry content.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */
 ?>

<div class="comment-content">
	<?php if ( $args['comment']->comment_type === 'deleted' ) {
		esc_html_e( 'Comment deleted by user', 'aesthetix' );
	} else {
		echo esc_html( comment_text( $args['comment']->comment_ID ) );
	} ?>
</div>
