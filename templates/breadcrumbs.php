<?php
/**
 * Template part for displaying breadcrumbs.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

if ( ! is_front_page() && ! is_home() && get_aesthetix_options( 'breadcrumbs_display' ) ) { ?>

	<section id="section-breadcrumbs" <?php aesthetix_section_classes( 'section-breadcrumbs', get_aesthetix_options( 'root_bg_breadcrumbs' ) ); ?> aria-label="<?php esc_attr_e( 'Section breadcrumbs', 'aesthetix' ); ?>">
		<div <?php aesthetix_container_classes( 'container-outer' ); ?>>
			<div <?php aesthetix_container_classes( 'container-inner' ); ?>>

				<?php

					if ( get_aesthetix_options( 'breadcrumbs_type' ) === 'woocommerce' && is_plugin_active( 'woocommerce/woocommerce.php' ) && function_exists( 'woocommerce_breadcrumb' ) ) {
						woocommerce_breadcrumb();
					} elseif ( get_aesthetix_options( 'breadcrumbs_type' ) === 'yoast' && is_plugin_active( 'wordpress-seo/wp-seo.php' ) && function_exists( 'yoast_breadcrumb' ) ) {
						yoast_breadcrumb( '<nav id="breadcrumbs" class="breadcrumbs breadcrumbs-yoast" aria-label="' . esc_attr_x( 'Breadcrumbs', 'breadcrumbs aria label', 'aesthetix' ) . '">', '</nav>' );
					} elseif ( get_aesthetix_options( 'breadcrumbs_type' ) === 'rankmath' && is_plugin_active( 'seo-by-rank-math/rank-math.php' ) && function_exists( 'rank_math_the_breadcrumbs' ) ) {
						rank_math_the_breadcrumbs();
					} elseif ( get_aesthetix_options( 'breadcrumbs_type' ) === 'aioseo' && is_plugin_active( 'all-in-one-seo-pack/all_in_one_seo_pack.php' ) && function_exists( 'aioseo_breadcrumbs' ) ) {
						aioseo_breadcrumbs();
					} elseif ( get_aesthetix_options( 'breadcrumbs_type' ) === 'navxt' && is_plugin_active( 'breadcrumb-navxt/breadcrumb-navxt.php' ) && function_exists( 'bcn_display_list' ) ) { ?>
						<nav id="breadcrumbs" class="breadcrumbs breadcrumbs-navxt" typeof="BreadcrumbList" vocab="https://schema.org/" aria-label="<?php echo esc_attr_x( 'Breadcrumbs', 'breadcrumbs aria label', 'aesthetix' ); ?>">
							<ol class="breadcrumbs-list breadcrumbs-list-inline">
								<?php bcn_display_list(); ?>
							</ol>
						</nav>
					<?php } else {
						$breadcrumb = new Aesthetix_Breadcrumbs();
						$breadcrumb->the_output();
					} ?>

			</div>
		</div>
	</section>

<?php }
