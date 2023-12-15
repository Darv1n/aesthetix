<?php
/**
 * Template part for displaying comment entry header.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$url    = get_comment_author_url( $args['comment'] );
$author = get_comment_author( $args['comment'] );

?>

<div class="comment-header">

	<div class="comment-avatar">
		<?php if ( $args['comment']->comment_type === 'deleted' ) {
			echo get_avatar( $args['comment'], $args['avatar_size'], 'mystery' );
		} else {
			echo get_avatar( $args['comment'], $args['avatar_size'] );
		} ?>
	</div>

	<?php if ( $url && $author ) { ?>
		<h4 class="comment-title"><a <?php link_classes(); ?> href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $author ); ?></a></h4>
	<?php } elseif( $author ) { ?>
		<h4 class="comment-title"><?php echo esc_html( $author ); ?></h4>
	<?php } ?>

	<ul class="comment-meta">
		<li class="comment-meta-item">
			<time class="comment-date data-title" data-title="<?php esc_attr_e( 'Published date', 'aesthetix' ); ?>" datetime="<?php echo get_comment_date( 'Y-m-d\TH:i:sP', $args['comment']->comment_ID ); ?>"><?php echo get_comment_date( 'j F Y', $args['comment']->comment_ID ); ?></time>
		</li>
		<?php if ( wp_http_validate_url( $url ) && $args['comment']->comment_type !== 'deleted' ) { ?>
			<li class="comment-meta-item">
				<a <?php link_classes( 'data-title' ); ?> href="<?php echo esc_url( $url ); ?>" data-title="<?php esc_html_e( 'User site', 'aesthetix' ); ?>" target="_blank"><?php echo esc_html( wp_parse_url( $url, PHP_URL_HOST ) ); ?></a>
			</li>
		<?php } ?>
		<?php if ( current_user_can( 'edit_comment', $args['comment']->comment_ID ) ) { ?>
			<li class="comment-meta-item">
				<p><?php echo $args['comment']->comment_author_email; ?></p>
			</li>
		<?php } ?>
	</ul>

</div>
