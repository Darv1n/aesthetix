<?php
/**
 * Template footer bottom bar.
 *
 * @since 1.0.0
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */
 ?>

<?php
	if ( get_aesthetix_options( 'general_footer_type' ) === 'footer-four-columns' ) {
		$first_col_classes = array( 'col-12', 'col-sm-6', 'col-md-3' );
		$last_col_classes  = array( 'col-12', 'col-sm-6', 'col-md-7' );
	} else {
		$first_col_classes = array( 'col-12', 'col-sm-6', 'col-md-4' );
		$last_col_classes  = array( 'col-12', 'col-sm-6', 'col-md-8' );
	}
?>

<div <?php aesthetix_archive_page_columns_wrapper_classes( 'align-items-center' ); ?>>
	<div class="<?php echo esc_attr( implode( ' ', $first_col_classes ) ); ?>">
		<?php
			if ( is_active_sidebar( 'sidebar-footer-top-left' ) ) {
				dynamic_sidebar( 'sidebar-footer-top-left' );
			} else { 
				get_template_part( 'templates/logo' );
			}
		?>
	</div>
	<div class="<?php echo esc_attr( implode( ' ', $last_col_classes ) ); ?>">
		<?php
			if ( is_active_sidebar( 'sidebar-footer-top-right' ) ) {
				dynamic_sidebar( 'sidebar-footer-top-right' );
			} else { ?>
				<div class="main-menu">
					<nav id="footer-navigation" class="footer-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Site main menu', 'aesthetix' ); ?>">
						<?php
							$args = array(
								'theme_location' => 'primary',
								'menu_id'        => 'primary-navigation',
								'container'      => '',
								'fallback_cb'    => 'primary_menu_fallback',
							);

							wp_nav_menu( $args );
						?>
					</nav>
				</div>
			<?php }
		?>
	</div>
</div>
