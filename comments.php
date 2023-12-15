<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
} ?>

<?php if ( comments_open() || get_comments_number() ) { ?>
	<section id="comments" <?php aesthetix_section_classes( 'section-comments comments-area' ); ?>>

		<?php get_template_part( 'templates/comment/comment-list' ); ?>
		<?php get_template_part( 'templates/comment/comment-form' ); ?>

	</section>
<?php }
