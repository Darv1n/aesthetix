<?php
/**
 * Template part for displaying widget table of contents.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$defaults = array(
	'style' => 'block', // inline, block.
);

$args      = array_merge( $defaults, $args );
$classes[] = 'toc-list';

if ( $args['style'] === 'block' ) {
	$classes[] = 'toc-list-block';
} else {
	$classes[] = 'toc-list-inline';
}

if ( is_single() ) {
	$post_id           = get_the_ID();
	$table_of_contents = get_table_of_contents( $post_id );
	$anchors           = array();

	if ( is_array( $table_of_contents ) && ! empty( $table_of_contents ) ) { ?>
		<ul class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
			<?php foreach ( $table_of_contents as $key => $table_of_content ) {

				if ( isset( $table_of_content['id'] ) ) {
					$anchor = get_title_slug( $table_of_content['id'] );
				} else {
					$anchor = get_title_slug( $table_of_content['title'] );
				} ?>

				<li class="toc-list-item level-<?php echo esc_attr( $table_of_content['level'] ); ?>">
					<a <?php link_classes(); ?> href="<?php echo esc_attr( '#' . $anchor ); ?>"><?php echo esc_html( wp_strip_all_tags( $table_of_content['title'] ) ); ?></a>
				</li>
			<?php } ?>
		</ul>
	<?php }
}
