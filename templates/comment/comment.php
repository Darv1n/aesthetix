<?php
/**
 * Template part for displaying comment.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$defaults = array(
	'comment_post_ID'    => '',
	'comment_parent'     => '',
	'comment'            => '',
	'avatar_size'        => '48',
	'depth'              => 4,
	'max_depth'          => 5,
	'comments_structure' => get_aesthetix_options( 'comments_structure' ),
);

$args = array_merge( $defaults, $args );

if ( ! $args['comment'] && ! is_object( $args['comment'] && isset( $args['comment']->comment_ID ) ) ) {
	return;
}

// vardump( $args['comment'] );

if ( is_string( $args['comments_structure'] ) && ! empty( $args['comments_structure'] ) ) {
	$args['comments_structure'] = array_map( 'trim', explode( ',', $args['comments_structure'] ) );
}

?>

<li class="comment-list-item">
	<div id="comment-<?php comment_ID(); ?>" class="comment" data-id="<?php comment_ID(); ?>">




		<?php if ( is_array( $args['comments_structure'] ) && ! empty( $args['comments_structure'] ) ) {
			foreach ( $args['comments_structure'] as $key => $value ) {
				switch ( $value ) {
					case has_action( 'aesthetix_comments_structure_loop_' . $value ):
						do_action( 'aesthetix_comments_structure_loop_' . $value, $post, $args );
						break;
					case 'header':
						get_template_part( 'templates/comment/comment-entry-header', '', $args );
						break;
					case 'content':
						get_template_part( 'templates/comment/comment-entry-content', '', $args );
						break;
					case 'notifications':
						get_template_part( 'templates/comment/comment-entry-notifications', '', $args );
						break;
					case 'footer':
						get_template_part( 'templates/comment/comment-entry-footer', '', $args );
						break;
					default:
						break;
				}
			}
		} ?>




	</div>

<?php 
// There is no closed tag </li> here, because this is the specificity of Walker_Comment() and child comments are added here.
