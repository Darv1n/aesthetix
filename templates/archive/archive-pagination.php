<?php
/**
 * Template part for displaying archive post pagination.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

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
}

?>

<nav class="navigation posts-navigation posts-navigation_<?php echo esc_attr( get_aesthetix_options( 'archive_' . get_post_type() . '_pagination' ) ); ?>" data-max-pages="<?php echo esc_attr( $pages ); ?>" role="navigation" aria-label="<?php esc_attr_e( 'Site post pagination', 'aesthetix' ); ?>">

	<?php if ( get_aesthetix_options( 'archive_' . get_post_type() . '_pagination' ) === 'numeric' ) {

		// First page.
		if ( $paged > 3 ) { ?>
			<a <?php icon_classes( 'posts-navigation-item icon icon-before icon-chevron-left', array( 'button_content' => 'button-icon-text' ) ); ?> href="<?php echo esc_url( get_pagenum_link( 1 ) ); ?>" role="button"><?php esc_html_e( 'First', 'aesthetix' ); ?></a>
		<?php }

		// The main link output loop.
		for ( $i = 1; $i <= $pages; $i++ ) {
			if ( 1 !== $pages && ( ! ( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ) ) {

				if ( $paged === $i ) { ?>
					<span <?php icon_classes( 'posts-navigation-item posts-navigation-item-first posts-navigation-item-current button-num button-disabled', array( 'button_content' => 'button-icon-text' ) ); ?>><?php esc_html_e( $i ); ?></span>
				<?php } else {

					if ( $paged === $i ) {
						$rel     = '';
						$classes = 'posts-navigation-item posts-navigation-item-current button-num button-disabled';
					} elseif ( $paged + 1 === $i ) {
						$rel     = ' rel="next"';
						$classes = 'posts-navigation-item posts-navigation-item-next button-num';
					} elseif ( $paged > 1 && $paged - 1 === $i ) {
						$rel     = ' rel="prev"';
						$classes = 'posts-navigation-item posts-navigation-item-prev button-num';
					} else {
						$rel     = '';
						$classes = 'posts-navigation-item button-num';
					} ?>

					<a <?php icon_classes( $classes, array( 'button_content' => 'button-icon-text' ) ); ?> href="<?php echo esc_url( get_pagenum_link( $i ) ); ?>" role="button"<?php echo esc_attr( $rel ); ?>><?php esc_html_e( $i ); ?></a>

				<?php }
			}
		}

		// Last Page.
		if ( $pages > 5 && $paged < $pages - 2 ) { ?>
			<a <?php icon_classes( 'posts-navigation-item posts-navigation-item-last icon icon-after icon-chevron-right', array( 'button_content' => 'button-icon-text' ) ); ?> href="<?php echo esc_url( get_pagenum_link( $pages ) ); ?>" role="button"><?php esc_html_e( 'Last', 'aesthetix' ); ?></a>
		<?php }

	} elseif ( get_aesthetix_options( 'archive_' . get_post_type() . '_pagination' ) === 'loadmore' ) { ?>
		<button <?php icon_classes( 'loadmore icon icon-download' ); ?> type="button" data-default-icon="icon-download" data-loading-icon="icon-spinner" data-default-text="<?php esc_attr_e( 'Load more', 'aesthetix' ); ?>" data-loading-text="<?php esc_attr_e( 'Loading...', 'aesthetix' ); ?>" data-disabled-text="<?php esc_attr_e( 'All posts have been uploaded', 'aesthetix' ); ?>" data-current-page="1" data-max-pages="<?php echo esc_attr( $wp_query->max_num_pages ); ?>"><?php esc_html_e( 'Load more', 'aesthetix' ); ?></button>
	<?php } else { ?>

		<div class="row">

			<?php if ( get_next_posts_link() ) { ?>
				<div class="col-12 col-md-6">
					<div class="posts-navigation__item_prev">
						<?php next_posts_link( esc_html__( 'Next posts', 'aesthetix' ) ); ?>
					</div>
				</div>
			<?php } ?>

			<?php if ( get_previous_posts_link() ) { ?>
				<div class="col-12 col-md-6">
					<div class="posts-navigation__item_next">
						<?php previous_posts_link( esc_html__( 'Previous posts', 'aesthetix' ) ); ?>
					</div>
				</div>
			<?php } ?>

		</div>
	<?php } ?>

</nav>
