<?php
/**
 * Template part for displaying entry footer.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 * @since 1.0.0
 */
 ?>

<footer class="post-footer" aria-label="<?php _e( 'Post footer', 'aesthetix' ); ?>">

	<?php do_action( 'aesthetix_before_single_entry_post_footer' ); ?>

	<?php wp_link_pages( array(
			'before' => '<div class="post-footer__item post-footer__pages">' . __( 'Pages:', 'aesthetix' ),
			'after'  => '</div>',
			'echo'   => 0,
		) ); ?>

	<?php 

		$structure = get_aesthetix_options( 'single_' . $post->post_type . '_footer_structure' );

		if ( is_string( $structure ) && ! empty( $structure ) ) {

			$structure = array_map( 'trim', explode( ',', $structure ) );

			foreach ( $structure as $key => $value ) {
				switch ( $value ) {
					case has_action( 'aesthetix_single_entry_post_footer_loop_' . $value ):
						do_action( 'aesthetix_single_entry_post_footer_loop_' . $value, $post );
						break;
					case 'category': ?>
						<?php if ( has_category() ) { ?>
							<div class="post-footer__item post-footer__cats">
								<strong><?php _e( 'Post categories', 'aesthetix' ) ?>:</strong>
								<ul class="post-footer__list cat-list">
									<?php foreach ( get_the_category() as $key => $category ) { ?>
										<li class="cat-list__item">
											<a <?php link_classes(); ?> href="<?php echo esc_url( get_term_link( $category->term_id, $category->taxonomy ) ); ?>"><?php echo esc_html( $category->name ); ?></a>
										</li>
									<?php } ?>
								</ul>
							</div>
						<?php } ?>
						<?php break;
					case 'post_tag': ?>
						<?php if ( has_tag() ) { ?>
							<div class="post-footer__item post-footer__tags">
								<strong><?php _e( 'Post tags', 'aesthetix' ); ?>:</strong>
								<ul class="post-footer__list tag-list">
									<?php foreach ( get_the_tags() as $key => $tag ) { ?>
										<li class="tag-list__item">
											<a <?php link_classes(); ?> href="<?php echo esc_url( get_term_link( $tag->term_id, $tag->taxonomy ) ); ?>">#<?php echo esc_html( $tag->name ); ?></a>
										</li>
									<?php } ?>
								</ul>
							</div>
						<?php } ?>
						<?php break;
					case 'edit': ?>
						<?php if ( is_user_logged_in() && current_user_can( 'edit_posts' ) ) { ?>
							<div class="post-footer__item post-footer__edit">
								<a <?php link_classes( 'edit-link' ); ?> href="<?php echo esc_url( get_edit_post_link() ); ?>"><?php _e( 'Edit', 'aesthetix' ); ?></a>
							</div>
						<?php } ?>
						<?php break;
					default:
						break;
				}
			}
		}

	?>

	<?php do_action( 'aesthetix_after_single_entry_post_footer' ); ?>

</footer>
