<?php
/**
 * Notice.
 *
 * @package Aesthetix
 */

if ( ! function_exists( 'aesthetix_classic_widgets_notice' ) ) {

	/*
	** Notice for Classic Widgets Editor.
	*/
	function aesthetix_classic_widgets_notice() {
		$screen = get_current_screen();

		if ( ! $screen || 'widgets' !== $screen->base || file_exists( ABSPATH . 'wp-content/plugins/classic-widgets/classic-widgets.php' ) ) {
			return;
		}

		?>

		<div class="notice is-dismissible widgets-notice-wrap">
			<div>
				<p><?php esc_html_e( 'Want to switch back to the Classic Widgets?', 'aesthetix' ); ?></p>

				<a class="button-primary" href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=classic-widgets' ), 'install-plugin_classic-widgets' ) ); ?>" >
					<?php esc_html_e( 'Install Now', 'aesthetix' ); ?>
				</a>
			</div>
		</div>

		<style>.widgets-php .widgets-notice-wrap{display:-webkit-box!important;display:-ms-flexbox!important;display:flex!important;max-width:360px;margin:0 auto;z-index:999;background:0 0;border:none;-webkit-box-shadow:none;box-shadow:none;-webkit-box-align:center;-ms-flex-align:center;align-items:center;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;margin-top:10px}.widgets-php .widgets-notice-wrap>div{display:-webkit-box;display:-ms-flexbox;display:flex}.widgets-php .widgets-notice-wrap .button-primary{height:20px;line-height:26px;font-size:12px;letter-spacing:.5px;margin-left:10px;margin-top:5px}.widgets-php .widgets-notice-wrap .notice-dismiss{display:none}.widgets-php .widgets-notice-wrap{text-align:center} </style>

		<?php
	}
}
