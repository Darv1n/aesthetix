<?php
/**
 * Template part for displaying entry header.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package aesthetix
 */
 ?>

<header class="post-header" aria-label="<?php _e( 'Post header', 'aesthetix' ); ?>">
	<?php do_action( 'aesthetix_before_single_inner_entry_header' ); ?>

	<?php the_title( '<h1 class="post-title">', '</h1>' ); ?>

	<?php do_action( 'aesthetix_after_single_inner_entry_header' ); ?>
</header>
