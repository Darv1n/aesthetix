<?php
/**
 * Template part for displaying archive entry post meta.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$defaults = array(
	'post_meta_structure' => get_aesthetix_options( 'archive_' . get_post_type() . '_meta_structure' ),
);

$args      = array_merge( $defaults, $args );
$classes[] = 'post-entry-meta';

if ( isset( $args['post_equal_height'] ) && $args['post_equal_height'] === 'meta' ) {
	$classes[] = 'equal-height-inline';
}

if ( is_string( $args['post_meta_structure'] ) && ! empty( $args['post_meta_structure'] ) ) {
	$args['post_meta_structure'] = array_map( 'trim', explode( ',', $args['post_meta_structure'] ) );
}

if ( is_array( $args['post_meta_structure'] ) && ! empty( $args['post_meta_structure'] ) ) { ?>

	<ul class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" aria-label="<?php esc_attr_e( 'Post meta information', 'aesthetix' ); ?>">

	<?php foreach ( $args['post_meta_structure'] as $key => $value ) {
		switch ( $value ) {
			case has_action( 'aesthetix_archive_entry_post_meta_loop_' . $value ):
				do_action( 'aesthetix_archive_entry_post_meta_loop_' . $value, $post, $args );
				break;
			case 'author': ?>
				<li class="post-entry-meta-item icon icon-before icon-user">
					<a <?php link_classes( 'post-meta-link' ); ?> href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php the_author(); ?></a>
				</li>
				<?php break;
			case 'date': ?>
				<li class="post-entry-meta-item icon icon-before icon-calendar">
					<time class="post-date published data-title" datetime="<?php echo get_the_date( 'Y-m-d\TH:i:sP' ); ?>" data-title="<?php esc_attr_e( 'Publication date', 'aesthetix' ); ?>">
						<?php echo get_the_date( 'j F, Y' ); ?>
					</time>
				</li>
				<?php break;
			case 'category': ?>
				<?php if ( has_category() ) { ?>
					<li class="post-entry-meta-item icon icon-before icon-folder">
						<?php foreach ( get_the_category() as $key => $category ) { ?>
							<a <?php link_classes( 'post-meta-link' ); ?> href="<?php echo esc_url( get_term_link( $category->term_id, $category->taxonomy ) ); ?>"><?php echo esc_html( $category->name ); ?></a>
						<?php } ?>
					</li>
				<?php } ?>
				<?php break;
			case 'post_tag': ?>
				<?php if ( has_tag() ) { ?>
					<li class="post-entry-meta-item icon icon-before icon-tag">
						<?php foreach ( get_the_tags() as $key => $tag ) { ?>
							<a <?php link_classes( 'post-meta-link' ); ?> href="<?php echo esc_url( get_term_link( $tag->term_id, $tag->taxonomy ) ); ?>"><?php echo esc_html( $tag->name ); ?></a>
						<?php } ?>
					</li>
				<?php } ?>
				<?php break;
			case 'time': ?>
				<li class="post-entry-meta-item icon icon-before icon-clock data-title" data-title="<?php esc_attr_e( 'Reading time', 'aesthetix' ); ?>">
					<?php echo read_time_estimate( get_the_content() ) . '&nbsp;' . esc_html__( 'min.', 'aesthetix' ); ?>
				</li>
				<?php break;
			case 'comments': ?>
				<li class="post-entry-meta-item icon icon-before icon-comment">
					<a <?php link_classes( 'post-meta-link' ); ?> href="<?php echo esc_url( get_comments_link() ); ?>" rel="bookmark"><?php esc_html_e( 'Comments', 'aesthetix' ); ?>: <?php echo get_comments_number(); ?></a>
				</li>
				<?php break;
			case 'views': ?>
				<li class="post-entry-meta-item icon icon-before icon-eye data-title" data-title="<?php esc_attr_e( 'Number of views', 'aesthetix' ); ?>">
					<?php echo get_post_meta( get_the_ID(), 'views', true ); ?>
				</li>
				<?php break;
			case 'likes': ?>
				<li class="post-entry-meta-item icon icon-before icon-thumbs-up data-title" data-title="<?php esc_attr_e( 'Number of likes', 'aesthetix' ); ?>">
					<?php echo get_post_meta( get_the_ID(), '_like', true ); ?>
				</li>
				<?php break;
			case 'dislikes': ?>
				<li class="post-entry-meta-item icon icon-before icon-thumbs-down data-title" data-title="<?php esc_attr_e( 'Number of dislikes', 'aesthetix' ); ?>">
					<?php echo get_post_meta( get_the_ID(), '_dislike', true ); ?>
				</li>
				<?php break;
			case 'edit': ?>
				<?php if ( is_user_logged_in() && current_user_can( 'edit_posts' ) ) { ?>
					<li class="post-entry-meta-item icon icon-before icon-pen-to-square">
						<a <?php link_classes( 'post-meta-link' ); ?> href="<?php echo esc_url( get_edit_post_link() ); ?>"><?php esc_html_e( 'Edit', 'aesthetix' ); ?></a>
					</li>
				<?php } ?>
				<?php break;
			default:
				break;
		}
	} ?>

	</ul>

<?php } ?>
