<?php
/**
 * Template part for displaying archive entry post taxonomies.
 * 
 * @since 1.0.7
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */
 ?>

<?php $taxonomies_display = get_aesthetix_options( 'archive_' . get_post_type() . '_taxonomies_display' );

if ( $taxonomies_display !== 'none' && has_term( '', $taxonomies_display ) ) { ?>
	<ul class="post-taxonomies" aria-label="<?php esc_attr_e( 'Post Taxonomies', 'aesthetix' ); ?>">
		<?php foreach ( get_the_terms( get_the_ID(), $taxonomies_display ) as $key => $taxonomy ) { ?>
			<li class="post-taxonomies__item">
				<a <?php button_classes( 'button-small post-taxonomies__link', 'secondary' ); ?> href="<?php echo esc_url( get_term_link( $taxonomy->term_id, $taxonomy->taxonomy ) ); ?>"><?php echo esc_html( $taxonomy->name ); ?></a>
			</li>
		<?php } ?>
	</ul>
<?php }
