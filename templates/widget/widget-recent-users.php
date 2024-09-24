<?php
/**
 * Template part for displaying widget recent users.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$defaults = array(
	'number'          => 4,
	'orderby'         => 'post_count',
	'order'           => 'DESC',
	'container_class' => '',
);

$args  = array_merge( apply_filters( 'get_aesthetix_widget_recent_users_default_args', $defaults, $args ), $args );
$users = get_users( $args );

$classes[] = 'user';
$classes[] = 'user-item';

if ( ! empty( $args['container_class'] ) ) {
	$classes = array_merge( $classes, explode( ' ', $args['container_class'] ) );
	$classes = array_unique( $classes );
	sort( $classes );
}

if ( is_array( $users ) && ! empty( $users ) ) {
	foreach ( $users as $key => $user ) {

		$user_data       = get_userdata( $user->ID );
		$user_avatar     = get_avatar( $user_data->ID, 48 );
		$user_name       = $user_data->display_name;
		$user_posts_url  = get_author_posts_url( $user_data->ID );
		$user_post_count = count_user_posts( $user_data->ID ); ?>

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

				<ul class="user-meta">
					<li class="user-meta-item">
						<?php esc_html_e( 'Posts', 'aesthetix' ); ?>: <?php echo esc_html( $user_post_count ); ?>
					</li>
				</ul>

			</div>

		</div>

	<?php }
}
