<?php
/**
 * Template part for displaying comment entry footer.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */
 ?>

<ul class="comment-footer">

	<li class="comment-footer-item">
		<?php get_template_part( 'templates/comment/comment-entry-likes', '', $args ); ?>
	</li>

	<?php
		$args['before'] = '<li class="comment-footer-item comment-reply reply">';
		$args['after']  = '</li>';
	?>

	<?php comment_reply_link( $args, $args['comment']->comment_ID, $args['comment']->comment_post_ID ); ?>

	<?php if ( current_user_can( 'edit_comment', $args['comment']->comment_ID ) ) { ?>
		<li class="comment-footer-item">
			<a <?php link_classes(); ?> href="<?php echo esc_url( get_edit_comment_link( $args['comment']->comment_ID ) ); ?>"><?php esc_html_e( 'Edit', 'aesthetix' ); ?></a>
		</li>
	<?php } ?>

	<?php if ( isset( $_COOKIE['comment_author_email_' . COOKIEHASH] ) && $_COOKIE['comment_author_email_' . COOKIEHASH] === $args['comment']->comment_author_email ) { ?>
		<li class="comment-footer-item">
			<a <?php link_classes( 'comment-edit-link' ); ?> href="<?php echo esc_url( get_comment_link( $args['comment'] ) ); ?>" data-commentid="<?php echo esc_attr( $args['comment']->comment_ID ); ?>" data-on-text="<?php esc_html_e( 'Cancel', 'aesthetix' ); ?>" data-off-text="<?php esc_html_e( 'Edit', 'aesthetix' ); ?>"><?php esc_html_e( 'Edit', 'aesthetix' ); ?></a>
		</li>
		<li class="comment-footer-item">
			<a <?php link_classes( 'comment-delete-link' ); ?> href="<?php echo esc_url( get_comment_link( $args['comment'] ) ); ?>" data-commentid="<?php echo esc_attr( $args['comment']->comment_ID ); ?>"><?php esc_html_e( 'Delete', 'aesthetix' ); ?></a>
		</li>
	<?php } ?>

</ul>
