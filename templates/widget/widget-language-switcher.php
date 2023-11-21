<?php
/**
 * Template part for displaying language switcher.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$args['style']                = $args['style'] ?? 'inline'; // dropdown, inline, block.
$args['button_title']         = $args['button_title'] ?? 'slug'; // name, slug.
$args['button_size']          = $args['button_size'] ?? get_aesthetix_options( 'root_button_size' );
$args['button_color']         = $args['button_color'] ?? 'primary';
$args['button_type']          = $args['button_type'] ?? get_aesthetix_options( 'root_button_type' );
$args['button_content']       = $args['button_content'] ?? 'button-icon-text';
$args['button_border_radius'] = $args['button_border_radius'] ?? get_aesthetix_options( 'root_button_border_radius' );

if ( is_language_switcher_active() ) {

	$pll_args = array(
		'show_flags' => 1,
		'show_names' => 1,
		'echo'       => 0,
		'raw'        => 1,
	);

	$languages = pll_the_languages( $pll_args );
	$locale    = get_first_value_from_string( get_locale(), '_' );
	$css_style = '';

	if ( $args['button_content'] === 'icon' ) {
		$css_style = ' style="display:block;line-height:0;font-size:0"';
	}

	if ( $args['style'] === 'dropdown' ) { ?>
		<div class="dropdown-container"<?php echo $css_style; ?>>
			<button <?php button_classes( 'dropdown-button icon icon-globe', $args ); ?> aria-label="<?php esc_attr_e( 'Language switcher', 'aesthetix' ) ?>" type="button">
				<?php if ( ! in_array( $args['button_content'], array( 'icon', 'button-icon' ), true ) ) {
					echo esc_html( ucfirst( apply_filters( 'aesthetix_polylang_button_title', $languages[ $locale ][ $args['button_title'] ], $args['button_title'] ) ) );
				} ?>
			</button>
			<ul class="dropdown-content dropdown-content-absolute language-switcher">
				<?php foreach ( $languages as $key => $language ) { ?>
					<li class="language-switcher-item menu-item <?php echo esc_attr( implode( ' ', $language['classes'] ) ); ?>">
						<?php echo $language['flag']; ?>
						<a <?php link_classes(); ?> href="<?php echo esc_url( $language['url'] ); ?>">
							<span class="menu-title"><?php echo esc_html( $language['name'] ); ?></span>
						</a>
					</li>
				<?php } ?>
			</ul>
		</div>
	<?php } else {

		$classes[] = 'language-switcher';
		$classes[] = 'language-list';
		if ( $args['style'] === 'block' ) {
			$classes[] = 'language-list-block';
		} else {
			$classes[] = 'language-list-inline';
		} ?>

		<ul class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">

			<?php foreach ( $languages as $key => $language ) { ?>
				<li class="language-switcher-item <?php echo esc_attr( implode( ' ', $language['classes'] ) ); ?>">
					<?php echo $language['flag']; ?>
					<a <?php link_classes(); ?> href="<?php echo esc_url( $language['url'] ); ?>">
						<?php echo esc_html( $language['name'] ); ?>
					</a>
				</li>
			<?php } ?>

		</ul>

	<?php }
}
