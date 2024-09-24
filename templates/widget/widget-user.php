<?php
/**
 * Template part for displaying widget user.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$defaults = array(
	'display_user'    => 'post_author_default_admin', // admin_only, post_author_only, post_author_default_admin,
	'container_class' => '',
);

$args = array_merge( apply_filters( 'get_aesthetix_widget_user_default_args', $defaults, $args ), $args );

if ( $args['display_user'] === 'admin_only' ) {
	$args['user_id'] = 1;
} elseif ( in_array( $args['display_user'], array( 'post_author_only', 'post_author_default_admin' ), true ) ) {
	if ( is_single() ) {
		global $post;
		$args['user_id'] = $post->post_author;
	} elseif ( $args['display_user'] === 'post_author_default_admin' ) {
		$args['user_id'] = 1;
	}
}

if ( ! isset( $args['user_id'] ) ) {
	return;
}

$classes[] = 'user';
$classes[] = 'user-author';

if ( ! empty( $args['container_class'] ) ) {
	$classes = array_merge( $classes, explode( ' ', $args['container_class'] ) );
	$classes = array_unique( $classes );
	sort( $classes );
}

$user = get_user_by( 'ID', $args['user_id'] );

$user_data      = get_userdata( $user->ID );
$user_avatar    = get_avatar( $user_data->ID, 48 );
$user_name      = $user_data->display_name;
$user_url       = $user_data->user_url;
$user_posts_url = get_author_posts_url( $user_data->ID ); ?>

<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="user-header">
		<?php if ( $user_avatar ) { ?>
			<div class="user-avatar">
				<?php echo $user_avatar; ?>
			</div>
		<?php } ?>

		<?php if ( $user_posts_url && $user_name ) { ?>
			<h4 class="user-title"><a <?php link_classes(); ?> href="<?php echo esc_url( $user_posts_url ); ?>"><?php echo esc_html( $user_name ); ?></a></h4>
		<?php } elseif( $user_name ) { ?>
			<h4 class="user-title"><?php echo esc_html( $user_name ); ?></h4>
		<?php } ?>

		<?php if ( wp_http_validate_url( $user_url ) ) { ?>
			<ul class="user-meta">
				<li class="user-meta-item">
					<a <?php link_classes( 'data-title' ); ?> href="<?php echo esc_url( $user_url ); ?>" data-title="<?php esc_html_e( 'User site', 'aesthetix' ); ?>" target="_blank"><?php echo esc_html( wp_parse_url( $user_url, PHP_URL_HOST ) ); ?></a>
				</li>
			</ul>
		<?php } ?>

	</div>

	<?php if ( ! empty( $user_data->description ) ) { ?>
		<div class="user-content">
			<?php echo esc_html( $user_data->description ); ?>
		</div>
	<?php } ?>

</div>
