<?php
/**
 * Template part for displaying entry content.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 * @since 1.0.0
 */
 ?>

<div class="post-content" aria-label="<?php esc_attr_e( 'Post content', 'aesthetix' ); ?>">
	<?php the_content( sprintf( wp_kses( __( 'Continue reading <span class="screen-reader-text">"%s"</span>', 'aesthetix' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) ); ?>
</div>
