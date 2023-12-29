<?php
/**
 * Template part for displaying single entry post likes.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$defaults = array(
	'button_size'  => 'xs',
	'button_type'  => 'empty',
	'button_color' => 'gray',
);

$args = array_merge( $defaults, $args );

?>

<div class="likes" data-object-type="comment" data-object-id="<?php echo esc_attr( $args['comment']->comment_ID ); ?>">
	<ul class="likes-list likes-list-inline">
		<li class="likes-list-item">
			<button <?php button_classes( 'button-like icon icon-thumbs-up', $args ); ?> type="button" data-key="like">
				<?php echo get_comment_meta( $args['comment']->comment_ID, '_like', true ); ?>
			</button>
		</li>
		<li class="likes-list-item">
			<button <?php button_classes( 'button-like icon icon-thumbs-down', $args ); ?> type="button" data-key="dislike">
				<?php echo get_comment_meta( $args['comment']->comment_ID, '_dislike', true ); ?>
			</button>
		</li>
	</ul>
</div>
