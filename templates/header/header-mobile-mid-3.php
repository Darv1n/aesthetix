<?php
/**
 * Template header mobile three columns.
 *
 * @since 1.2.4
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */
 ?>

<div class="header-mobile">
	<div <?php aesthetix_container_classes( 'container-header' ); ?>>
		<div <?php aesthetix_archive_page_columns_wrapper_classes( 'align-items-center' ); ?>>
			<div class="col-3">
				<section <?php widgets_classes( '', 'header-mobile-left' ); ?>>

					<?php if ( is_active_sidebar( 'header-mobile-left' ) ) { ?>
						<?php dynamic_sidebar( 'header-mobile-left' ); ?>
					<?php } else { ?>
						<?php default_sidebar( 'header-mobile-left' ); ?>
					<?php } ?>

				</section>
			</div>
			<div class="col-6">
				<section <?php widgets_classes( '', 'header-mobile-center' ); ?>>

					<?php if ( is_active_sidebar( 'header-mobile-center' ) ) { ?>
						<?php dynamic_sidebar( 'header-mobile-center' ); ?>
					<?php } else { ?>
						<?php default_sidebar( 'header-mobile-center' ); ?>
					<?php } ?>

				</section>
			</div>
			<div class="col-3">
				<section <?php widgets_classes( '', 'header-mobile-right' ); ?>>

					<?php if ( is_active_sidebar( 'header-mobile-right' ) ) { ?>
						<?php dynamic_sidebar( 'header-mobile-right' ); ?>
					<?php } else { ?>
						<?php default_sidebar( 'header-mobile-right' ); ?>
					<?php } ?>

					<?php
						$button_size = get_aesthetix_options( 'root_button_size' );
						if ( in_array( $button_size, array( 'lg', 'xl' ), true ) ) {
							$button_size = 'md';
						}

						$button_content = get_aesthetix_options( 'root_menu_button_content' );
						if ( in_array( $button_content, array( 'button-icon-text', 'button-text' ), true ) ) {
							$button_content = 'button-icon';
						} else {
							$button_content = 'icon';
						}
					?>

					<div <?php widget_classes( '', 'header-mobile-right' ) ?>>
						<?php get_template_part( 'templates/aside', 'menu-toggle', array( 'button_content' => $button_content, 'button_size' => $button_size ) ); ?>
					</div>

				</section>
			</div>
		</div>
	</div>
</div>