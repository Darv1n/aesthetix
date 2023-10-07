<?php
/**
 * Template part for displaying archive post pagination.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 * @since 1.0.0
 */
 ?>

<?php

global $paged;
global $wp_query;

$pages     = $wp_query->max_num_pages;
$range     = 2;
$showitems = ( $range * 2 ) + 1;

if ( ! $pages || empty( $paged ) ) {
	$paged = 1;
}

if ( (int) $pages === 1 ) {
	return;
} ?>

<nav class="navigation posts-navigation posts-navigation_<?php echo esc_attr( get_aesthetix_options( 'archive_' . get_post_type() . '_pagination' ) ); ?>" data-max-pages="<?php echo esc_attr( $pages ); ?>" role="navigation" aria-label="<?php esc_attr_e( 'Site post navigation', 'aesthetix' ); ?>">

	<?php if ( get_aesthetix_options( 'archive_' . get_post_type() . '_pagination' ) === 'numeric' ) {

		// First page.
		if ( $paged > 3 ) { ?>
			<a class="<?php button_classes( 'posts-navigation__item posts-navigation__item_first button-small icon icon_center icon_chevron-left' ); ?>" href="<?php echo esc_url( get_pagenum_link( 1 ) ); ?>" role="button">-1</a>
		<?php }

		// The main link output loop.
		for ( $i = 1; $i <= $pages; $i++ ) {
			if ( 1 !== $pages && ( ! ( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ) ) {

				if ( $paged === $i ) { ?>
					<span <?php button_classes( 'button-small button-disabled posts-navigation__item posts-navigation__item_current' ); ?>><?php echo $i; ?></span>
				<?php } else {

					if ( $paged === $i ) {
						$rel     = '';
						$classes = 'button-small button-disabled posts-navigation__item posts-navigation__item_current';
					} elseif ( $paged + 1 === $i ) {
						$rel     = ' rel="next"';
						$classes = 'button-small posts-navigation__item posts-navigation__item_next';
					} elseif ( $paged > 1 && $paged - 1 === $i ) {
						$rel     = ' rel="prev"';
						$classes = 'button-small posts-navigation__item posts-navigation__item_prev';
					} else {
						$rel     = '';
						$classes = 'button-small posts-navigation__item';
					} ?>

					<a <?php button_classes( $classes ); ?> href="<?php echo esc_url( get_pagenum_link( $i ) ); ?>" role="button"<?php echo $rel; ?>><?php echo $i; ?></a>

				<?php }
			}
		}

		// Last Page.
		if ( $pages > 5 && $paged < $pages - 2 ) { ?>
			<a <?php button_classes( 'posts-navigation__item posts-navigation__item_last button-small icon icon_center icon_chevron-right' ); ?> href="<?php echo esc_url( get_pagenum_link( $pages ) ); ?>" role="button">+1</a>
		<?php }
	} elseif ( get_aesthetix_options( 'archive_' . get_post_type() . '_pagination' ) === 'loadmore' ) { ?>
		<button <?php button_classes( 'loadmore icon icon_download' ); ?> type="button" data-default-icon="icon_download" data-loading-icon="icon_spinner" data-default-text="<?php esc_attr_e( 'Load More', 'aesthetix' ); ?>" data-loading-text="<?php esc_attr_e( 'Loading...', 'aesthetix' ); ?>" data-disabled-text="<?php esc_attr_e( 'All posts have been uploaded', 'aesthetix' ); ?>" data-current-page="1" data-max-pages="<?php echo $wp_query->max_num_pages; ?>"><?php esc_html_e( 'Load More', 'aesthetix' ); ?></button>
	<?php } else { ?>

		<div class="row">

			<?php if ( get_next_posts_link() ) { ?>
				<div class="col-12 col-md-6">
					<div class="posts-navigation__item_prev">
						<?php next_posts_link( esc_html__( 'Older Posts', 'aesthetix' ) ); ?>
					</div>
				</div>
			<?php } ?>

			<?php if ( get_previous_posts_link() ) { ?>
				<div class="col-12 col-md-6">
					<div class="posts-navigation__item_next">
						<?php previous_posts_link( esc_html__( 'Newer Posts', 'aesthetix' ) ); ?>
					</div>
				</div>
			<?php } ?>

		</div>
	<?php } ?>

</nav>
