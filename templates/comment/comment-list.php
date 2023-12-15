<?php
/**
 * Template part for displaying comment list.
 * 
 * The comments_number() function should be used in .commnets-title.
 * But it does not correctly count comments that change on the hook pre_get_comments.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

if ( have_comments() ) { ?>

	<h3 class="comments-title"><?php esc_html_e( 'Comments', 'aesthetix' ); ?><span class="count-comments"><?php echo esc_html( ':&nbsp;' . count( $wp_query->comments ) ); ?></span></h3>

	<ol class="comment-list">
		<?php
			$args = array(
				'style'       => 'ol',
				'avatar_size' => '48',
				'callback'    => 'aesthetix_comments_list',
			);

			wp_list_comments( $args );
		?>
	</ol>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
		<div class="row no-gutters justify-content-between comment-navigation">
			<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Previous comments', 'aesthetix' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( esc_html__( 'Next comments', 'aesthetix' ) ); ?></div>
		</div>
	<?php } ?>

<?php }
