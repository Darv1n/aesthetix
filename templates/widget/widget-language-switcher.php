<?php
/**
 * Template part for displaying language switcher.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$defaults = array(
	'button_size'          => get_aesthetix_options( 'root_button_size' ),
	'button_color'         => 'primary',
	'button_type'          => get_aesthetix_options( 'root_button_type' ),
	'button_content'       => 'button-icon-text',
	'button_border_width'  => get_aesthetix_options( 'root_button_border_width' ),
	'button_border_radius' => get_aesthetix_options( 'root_button_border_radius' ),
	'style'                => 'inline', // dropdown, inline, block.
);

$args = array_merge( $defaults, $args );

if ( ( is_plugin_active( 'polylang/polylang.php' ) && function_exists( 'pll_the_languages' ) ) || is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' ) ) {

	if ( is_plugin_active( 'polylang/polylang.php' ) ) {
		$pll_args = array(
			'show_flags' => 1,
			'show_names' => 1,
			'echo'       => 0,
			'raw'        => 1,
		);

		$languages = pll_the_languages( $pll_args );
	} else {
		$languages = apply_filters( 'wpml_active_languages', null, null );
	}

	if ( empty( $languages ) || count( $languages ) < 2 ) {
		return;
	}

	// vardump( get_locale() );
	// vardump( $languages );

	$locale       = get_first_value_from_string( get_locale(), '_' );
	$css_style    = '';
	$lang_classes = array( 'language-switcher-item' );

	if ( is_plugin_active( 'polylang/polylang.php' ) ) {
		$button_title = apply_filters( 'aesthetix_language_switcher_button_title', $languages[ $locale ]['name'] );
	} else {
		$button_title = apply_filters( 'aesthetix_language_switcher_button_title', $languages[ $locale ]['translated_name'] );
	}

	if ( $args['button_content'] === 'icon' ) {
		$css_style = ' style="display:block;line-height:0;font-size:0"';
	}

	if ( $args['style'] === 'dropdown' ) {

		$lang_classes[] = 'menu-item'; ?>

		<div class="dropdown-container"<?php echo $css_style; ?>>
			<button <?php button_classes( 'dropdown-button icon icon-globe', $args ); ?> aria-label="<?php esc_attr_e( 'Language switcher', 'aesthetix' ); ?>" type="button">
				<?php if ( ! in_array( $args['button_content'], array( 'icon', 'button-icon' ), true ) ) {
					echo esc_html( ucfirst( $button_title ) );
				} ?>
			</button>
			<ul class="dropdown-content dropdown-content-absolute language-switcher">
				<?php foreach ( $languages as $key => $language ) {

					if ( is_plugin_active( 'polylang/polylang.php' ) ) {
						$lang_item_classes = array_merge( $language['classes'], $lang_classes );
						$lang_item_flag    = $language['flag'];
					} else {
						$lang_item_classes = $lang_classes;
						$lang_item_flag    = '<img src="' . esc_url( $language['country_flag_url'] ) . '" alt="' . esc_attr( $language['translated_name'] ) . '" width="16" height="11" style="width: 16px; height: 11px;">';
					} ?>

					<li class="<?php echo esc_attr( implode( ' ', array_unique( $lang_item_classes ) ) ); ?>">
						<?php echo $lang_item_flag; ?>
						<a <?php link_classes(); ?> href="<?php echo esc_url( $language['url'] ); ?>">
							<?php if ( is_plugin_active( 'polylang/polylang.php' ) ) { ?>
								<span class="menu-title"><?php echo esc_html( $language['name'] ); ?></span>
							<?php } else { ?>
								<span class="menu-title"><?php echo esc_html( $language['translated_name'] ); ?></span>
							<?php } ?>
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
				<li class="<?php echo esc_attr( implode( ' ', array_unique( $lang_classes ) ) ); ?>">

					<?php if ( is_plugin_active( 'polylang/polylang.php' ) ) {
							$lang_item_flag = $language['flag'];
						} else {
							$lang_item_flag = '<img src="' . esc_url( $language['country_flag_url'] ) . '" alt="' . esc_attr( $language['translated_name'] ) . '" width="16" height="11" style="width: 16px; height: 11px;">';
						} ?>

					<?php echo $lang_item_flag; ?>
					<a <?php link_classes(); ?> href="<?php echo esc_url( $language['url'] ); ?>">
						<?php if ( is_plugin_active( 'polylang/polylang.php' ) ) { ?>
							<?php echo esc_html( $language['name'] ); ?>
						<?php } else { ?>
							<?php echo esc_html( $language['translated_name'] ); ?>
						<?php } ?>
					</a>
				</li>
			<?php } ?>

		</ul>

	<?php }
}
