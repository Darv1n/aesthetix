<?php
/**
 * Template part for displaying similar posts in single.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */
 ?>

<?php if ( get_aesthetix_options( 'single_' . get_post_type() . '_similar_posts_display' ) ) { ?>

	<?php
		$post_type_labels = get_post_type_labels( get_post_type_object( get_post_type() ) );
		$taxonomy_names   = get_object_taxonomies( get_post_type() );
		$title            = apply_filters( 'get_aesthetix_similar_posts_title', __( 'Similar', 'aesthetix' ) . ' ' . mb_strtolower( $post_type_labels->name ) );

		if ( isset( $taxonomy_names[0] ) ) {
			$terms = get_the_terms( get_the_ID(), $taxonomy_names[0] );

			if ( isset( $terms[0] ) ) {
				$title      = apply_filters( 'get_aesthetix_similar_posts_title', __( 'Similar', 'aesthetix' ) . ' ' . mb_strtolower( $terms[0]->name ) );
				$link       = apply_filters( 'get_aesthetix_similar_posts_link', get_term_link( $terms[0]->term_id, $terms[0]->taxonomy ) );
				$link_title = apply_filters( 'get_aesthetix_similar_posts_link_title', __( 'All', 'aesthetix' ) . ' ' . mb_strtolower( $terms[0]->name ) );
			}
		}

		if ( ! isset( $link ) && get_post_type_archive_link( get_post_type() ) ) {
			$link       = apply_filters( 'get_aesthetix_similar_posts_link', get_post_type_archive_link( get_post_type() ), get_the_ID() );
			$link_title = apply_filters( 'get_aesthetix_similar_posts_link_title', __( 'All', 'aesthetix' ) . ' ' . mb_strtolower( $post_type_labels->name ) );
		}
	?>

	<section id="similar-posts" <?php aesthetix_section_classes( 'section-similar-posts similar-posts' ); ?> aria-label="<?php echo esc_attr( $title ); ?>">

		<div class="section-title-wrapper">
			<h2 class="section-title"><?php echo esc_html( $title ); ?></h2>

			<?php if ( isset( $link ) ) { ?>
				<a <?php link_classes( 'section-title-link' ); ?> href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $link_title ); ?></a>
			<?php } ?>
		</div>

		<?php

			$args = array(
				'post__not_in'   => array( get_the_ID() ),
				'order'          => get_aesthetix_options( 'single_' . get_post_type() . '_similar_posts_order' ),
				'orderby'        => get_aesthetix_options( 'single_' . get_post_type() . '_similar_posts_orderby' ),
				'posts_per_page' => get_aesthetix_options( 'single_' . get_post_type() . '_similar_posts_count' ),
				'post_type'      => get_post_type(),
			);

			if ( $taxonomy_names ) {
				$args['tax_query']['relation'] = 'OR';
				$i = 0;
				foreach ( $taxonomy_names as $key => $taxonomy_name ) {

					if ( $taxonomy_name === 'post_format' ) {
						continue;
					}

					$args['tax_query'][ $i ]['taxonomy'] = $taxonomy_name;
					$args['tax_query'][ $i ]['field']    = 'id';
					foreach ( get_the_terms( get_the_ID(), $taxonomy_name ) as $key => $term ) {
						$args['tax_query'][ $i ]['terms'][] = $term->term_id;
					}
					$i++;
				}
			}

			// Merge child and parent default options.
			$args  = apply_filters( 'get_aesthetix_similar_posts_args', $args, get_the_ID() );

			get_template_part( 'templates/archive/archive-recent-posts', '', $args ); ?>

	</section>

<?php } ?>
