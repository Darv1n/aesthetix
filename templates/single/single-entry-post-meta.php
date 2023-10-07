<?php
/**
 * Template part for displaying single entry post meta.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 * @since 1.0.0
 */
 ?>

<ul class="post-meta" aria-label="<?php _e( 'Post meta information', 'aesthetix' ); ?>">

	<?php do_action( 'aesthetix_before_single_entry_post_meta' ); ?>

	<?php 

		$structure = get_aesthetix_options( 'single_' . get_post_type() . '_meta_structure' );

		if ( is_string( $structure ) && ! empty( $structure ) ) {

			$structure = array_map( 'trim', explode( ',', $structure ) );

			foreach ( $structure as $key => $value ) {
				switch ( $value ) {
					case has_action( 'aesthetix_single_entry_post_meta_loop_' . $value ):
						do_action( 'aesthetix_single_entry_post_meta_loop_' . $value, $post );
						break;
					case 'author': ?>
						<li class="post-meta__item icon icon_before icon_user">
							<a <?php link_classes( 'post-meta__link' ); ?> href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>" rel="author"><?php the_author(); ?></a>
						</li>
						<?php break;
					case 'date': ?>
						<li class="post-meta__item icon icon_before icon_calendar">
							<time class="post-date published data-title" datetime="<?php echo get_the_date( 'Y-m-d\TH:i:sP' ); ?>" data-title="<?php esc_attr_e( 'Publication date', 'aesthetix' ); ?>"><?php echo get_the_date( 'j F, Y' ); ?></time>
						</li>
						<?php break;
					case 'category': ?>
						<?php if ( has_category() ) { ?>
							<li class="post-meta__item icon icon_before icon_folder">
								<?php foreach ( get_the_category() as $key => $category ) { ?>
									<a <?php link_classes( 'post-meta__link' ); ?> href="<?php echo esc_url( get_term_link( $category->term_id, $category->taxonomy ) ); ?>"><?php echo esc_html( $category->name ); ?></a>
								<?php } ?>
							</li>
						<?php } ?>
						<?php break;
					case 'post_tag': ?>
						<?php if ( has_tag() ) { ?>
							<li class="post-meta__item icon icon_before icon_tag">
								<?php foreach ( get_the_tags() as $key => $tag ) { ?>
									<a <?php link_classes( 'post-meta__link' ); ?> href="<?php echo esc_url( get_term_link( $tag->term_id, $tag->taxonomy ) ); ?>"><?php echo esc_html( $tag->name ); ?></a>
								<?php } ?>
							</li>
						<?php } ?>
						<?php break;
					case 'time': ?>
						<li class="post-meta__item icon icon_before icon_clock data-title" data-title="<?php esc_attr_e( 'Reading time', 'aesthetix' ); ?>">
							<?php echo read_time_estimate( get_the_content() ) . ' ' . esc_html__( 'min.', 'aesthetix' ); ?>
						</li>
						<?php break;
					case 'comments': ?>
						<li class="post-meta__item icon icon_before icon_comment">
							<a <?php link_classes( 'post-meta__link' ); ?> href="<?php echo esc_url( get_comments_link() ); ?>" rel="bookmark"><?php esc_html_e( 'Comments', 'aesthetix' ) ?>: <?php echo get_comments_number(); ?></a>
						</li>
						<?php break;
					case 'edit': ?>
						<?php if ( is_user_logged_in() && current_user_can( 'edit_posts' ) ) { ?>
							<li class="post-meta__item icon icon_before icon_pen-to-square">
								<a <?php link_classes( 'post-meta__link' ); ?> href="<?php echo esc_url( get_edit_post_link() ); ?>"><?php esc_html_e( 'Edit', 'aesthetix' ) ?></a>
							</li>
						<?php } ?>
						<?php break;
					default:
						break;
				}
			}
		}

	?>

	<?php do_action( 'aesthetix_after_single_entry_post_meta' ); ?>

</ul>
