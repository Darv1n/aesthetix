<?php
/**
 * Template part for displaying single entry post likes.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$defaults = array(
	'title'        => __( 'Rate this post', 'aesthetix' ),
	'button_size'  => 'sm',
	'button_type'  => 'empty',
	'button_color' => 'gray',
);

$args = array_merge( $defaults, $args );

?>

<div class="likes" data-object-type="post" data-object-id="<?php the_ID(); ?>">
	<h3 class="likes-title"><?php echo esc_html( $args['title'] ); ?></h3>
	<ul class="likes-list likes-list-inline">
		<li class="likes-list-item">
			<button <?php button_classes( 'button-like icon icon-thumbs-up', $args ); ?> type="button" data-key="like">
				<?php echo get_post_meta( get_the_ID(), '_like', true ); ?>
			</button>
		</li>
		<li class="likes-list-item">
			<button <?php button_classes( 'button-like icon icon-thumbs-down', $args ); ?> type="button" data-key="dislike">
				<?php echo get_post_meta( get_the_ID(), '_dislike', true ); ?>
			</button>
		</li>
	</ul>
</div>
