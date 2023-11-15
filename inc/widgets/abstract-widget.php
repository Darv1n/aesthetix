<?php
/**
 * Abstract widget class.
 * 
 * @link https://github.com/woocommerce/woocommerce/blob/trunk/plugins/woocommerce/includes/abstracts/abstract-wc-widget.php
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

abstract class WPA_Widget extends WP_Widget {

	/**
	 * CSS class.
	 *
	 * @var string
	 */
	public $widget_cssclass;

	/**
	 * Widget description.
	 *
	 * @var string
	 */
	public $widget_description;

	/**
	 * Widget ID.
	 *
	 * @var string
	 */
	public $widget_id;

	/**
	 * Widget name.
	 *
	 * @var string
	 */
	public $widget_name;

	/**
	 * Settings.
	 *
	 * @var array
	 */
	public $settings;

	/**
	 * Constructor.
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'                   => $this->widget_cssclass,
			'description'                 => $this->widget_description,
			'customize_selective_refresh' => true,
			'show_instance_in_rest'       => true,
		);

		parent::__construct( $this->widget_id, $this->widget_name, $widget_ops );

		add_action( 'save_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );
	}

	/**
	 * Get this widgets title.
	 *
	 * @param array $instance Array of instance options.
	 * 
	 * @return string
	 */
	protected function get_instance_title( $instance ) {
		if ( isset( $instance['title'] ) ) {
			return $instance['title'];
		}

		if ( isset( $this->settings, $this->settings['title'], $this->settings['title']['std'] ) ) {
			return $this->settings['title']['std'];
		}

		return '';
	}

	/**
	 * Get this widgets subtitle.
	 *
	 * @param array $instance Array of instance options.
	 * 
	 * @return string
	 */
	protected function get_instance_subtitle( $instance ) {
		if ( isset( $instance['subtitle'] ) ) {
			return $instance['subtitle'];
		}

		if ( isset( $this->settings, $this->settings['subtitle'], $this->settings['subtitle']['std'] ) ) {
			return $this->settings['subtitle']['std'];
		}

		return '';
	}

	/**
	 * Get this widgets description.
	 *
	 * @param array $instance Array of instance options.
	 * 
	 * @return string
	 */
	protected function get_instance_description( $instance ) {
		if ( isset( $instance['description'] ) ) {
			return $instance['description'];
		}

		if ( isset( $this->settings, $this->settings['description'], $this->settings['description']['std'] ) ) {
			return $this->settings['description']['std'];
		}

		return '';
	}

	/**
	 * Output the html at the start of a widget.
	 *
	 * @param array $args     Arguments.
	 * @param array $instance Instance.
	 */
	public function widget_start( $args, $instance ) {

		if ( isset( $args['before_widget'] ) ) {
			echo $args['before_widget']; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
		}

		$title       = apply_filters( 'widget_title', $this->get_instance_title( $instance ), $instance, $this->id_base );
		$subtitle    = apply_filters( 'widget_subtitle', $this->get_instance_subtitle( $instance ), $instance, $this->id_base );
		$description = apply_filters( 'widget_description', $this->get_instance_description( $instance ), $instance, $this->id_base );

		if ( $title ) { ?>
			<div class="widget-title-wrap">

				<?php if ( $subtitle ) {
					echo '<span class="widget-subtitle">' . $subtitle . '</span>'; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
				} ?>

				<?php echo $args['before_title'] . $title . $args['after_title']; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped ?>

				<?php if ( $description ) {
					echo '<div class="widget-description">' . $description . '</div>'; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
				} ?>

			</div>
		<?php }
	}

	/**
	 * Output the html at the end of a widget.
	 *
	 * @param  array $args Arguments.
	 */
	public function widget_end( $args ) {
		if ( isset( $args['after_widget'] ) ) {
			echo $args['after_widget']; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
		}
	}

	/**
	 * Updates a particular instance of a widget.
	 *
	 * @see WP_Widget->update
	 * 
	 * @param array $new_instance New instance.
	 * @param array $old_instance Old instance.
	 * 
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		if ( empty( $this->settings ) ) {
			return $instance;
		}

		// Loop settings and get values to save.
		foreach ( $this->settings as $key => $setting ) {
			if ( ! isset( $setting['type'] ) ) {
				continue;
			}

			// Format the value based on settings type.
			switch ( $setting['type'] ) {
				case 'number':
					$instance[ $key ] = absint( $new_instance[ $key ] );

					if ( isset( $setting['min'] ) && '' !== $setting['min'] ) {
						$instance[ $key ] = max( $instance[ $key ], $setting['min'] );
					}

					if ( isset( $setting['max'] ) && '' !== $setting['max'] ) {
						$instance[ $key ] = min( $instance[ $key ], $setting['max'] );
					}
					break;
				case 'textarea':
					$instance[ $key ] = isset( $new_instance[ $key ] ) ? wp_kses( trim( wp_unslash( $new_instance[ $key ] ) ), wp_kses_allowed_html( 'post' ) ) : $setting['std'];
					break;
				case 'checkbox':
					$instance[ $key ] = empty( $new_instance[ $key ] ) ? 0 : 1;
					break;
				case 'url':
					$instance[ $key ] = isset( $new_instance[ $key ] ) && wp_http_validate_url( $new_instance[ $key ] ) ? sanitize_url( $new_instance[ $key ] ) : $setting['std'];
					break;
				case 'email':
					$instance[ $key ] = isset( $new_instance[ $key ] ) && is_email( $new_instance[ $key ] ) ? sanitize_email( $new_instance[ $key ] ) : $setting['std'];
					break;
				case 'image':
					$instance[ $key ] = isset( $new_instance[ $key ] ) ? sanitize_url( $new_instance[ $key ] ) : $setting['std'];
					break;
				default:
					$instance[ $key ] = isset( $new_instance[ $key ] ) ? sanitize_text_field( $new_instance[ $key ] ) : $setting['std'];
					break;
			}

			/**
			 * Sanitize the value of a setting.
			 */
			$instance[ $key ] = apply_filters( 'WPA_Widget_settings_sanitize_option', $instance[ $key ], $new_instance, $key, $setting );
		}

		$this->flush_widget_cache();

		return $instance;
	}

	/**
	 * Outputs the settings update form.
	 *
	 * @see WP_Widget->form
	 *
	 * @param array
	 */
	public function form( $instance ) {

		if ( empty( $this->settings ) ) {
			return;
		}

		foreach ( $this->settings as $key => $setting ) {

			$class = isset( $setting['class'] ) ? $setting['class'] : '';
			$value = isset( $instance[ $key ] ) ? $instance[ $key ] : $setting['std'];

			switch ( $setting['type'] ) {

				case 'text':
					?>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"><?php echo wp_kses_post( $setting['label'] ); ?></label><?php // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped ?>
						<input class="widefat <?php echo esc_attr( $class ); ?>" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>" type="text" value="<?php echo esc_attr( $value ); ?>" />
						<?php if ( isset( $setting['desc'] ) ) : ?>
							<small><?php echo esc_html( $setting['desc'] ); ?></small>
						<?php endif; ?>
					</p>
					<?php
					break;

				case 'textarea':
					?>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"><?php echo wp_kses_post( $setting['label'] ); /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */ ?></label>
						<textarea class="widefat <?php echo esc_attr( $class ); ?>" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>" cols="20" rows="3"><?php echo esc_textarea( $value ); ?></textarea>
						<?php if ( isset( $setting['desc'] ) ) : ?>
							<small><?php echo esc_html( $setting['desc'] ); ?></small>
						<?php endif; ?>
					</p>
					<?php
					break;

				case 'url':
					?>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"><?php echo wp_kses_post( $setting['label'] ); ?></label><?php // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped ?>
						<input class="widefat <?php echo esc_attr( $class ); ?>" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>" type="url" value="<?php echo esc_attr( $value ); ?>" />
						<?php if ( isset( $setting['desc'] ) ) : ?>
							<small><?php echo esc_html( $setting['desc'] ); ?></small>
						<?php endif; ?>
					</p>
					<?php
					break;

				case 'email':
					?>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"><?php echo wp_kses_post( $setting['label'] ); ?></label><?php // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped ?>
						<input class="widefat <?php echo esc_attr( $class ); ?>" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>" type="email" value="<?php echo esc_attr( $value ); ?>" />
						<?php if ( isset( $setting['desc'] ) ) : ?>
							<small><?php echo esc_html( $setting['desc'] ); ?></small>
						<?php endif; ?>
					</p>
					<?php
					break;

				case 'checkbox':
					?>
					<p>
						<input class="checkbox <?php echo esc_attr( $class ); ?>" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>" type="checkbox" value="1" <?php checked( $value, 1 ); ?> />
						<label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"><?php echo wp_kses_post( $setting['label'] ); /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */ ?></label>
						<?php if ( isset( $setting['desc'] ) ) : ?>
							<small><?php echo esc_html( $setting['desc'] ); ?></small>
						<?php endif; ?>
					</p>
					<?php
					break;

				case 'number':
					?>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"><?php echo wp_kses_post( $setting['label'] ); /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */ ?></label>
						<input class="widefat <?php echo esc_attr( $class ); ?>" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>" type="number" step="<?php echo esc_attr( $setting['step'] ); ?>" min="<?php echo esc_attr( $setting['min'] ); ?>" max="<?php echo esc_attr( $setting['max'] ); ?>" value="<?php echo esc_attr( $value ); ?>" />
						<?php if ( isset( $setting['desc'] ) ) : ?>
							<small><?php echo esc_html( $setting['desc'] ); ?></small>
						<?php endif; ?>
					</p>
					<?php
					break;

				case 'select':
					?>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"><?php echo wp_kses_post( $setting['label'] ); /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */ ?></label>
						<select class="widefat <?php echo esc_attr( $class ); ?>" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>">
							<?php foreach ( $setting['options'] as $option_key => $option_value ) : ?>
								<option value="<?php echo esc_attr( $option_key ); ?>" <?php selected( $option_key, $value ); ?>><?php echo esc_html( $option_value ); ?></option>
							<?php endforeach; ?>
						</select>
						<?php if ( isset( $setting['desc'] ) ) : ?>
							<small><?php echo esc_html( $setting['desc'] ); ?></small>
						<?php endif; ?>
					</p>
					<?php
					break;

				case 'sortable':
					?>
					<p>

						<label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"><?php echo wp_kses_post( $setting['label'] ); /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */ ?></label>

						<?php

							$reordered_choices = array();
							$saved_choices     = explode( ',', esc_attr( $value ) );

							foreach ( $saved_choices as $saved_key => $saved_value ) {
								if ( isset( $setting['options'][ $saved_value ] ) ) {
									$reordered_choices[ $saved_value ] = $setting['options'][ $saved_value ];
								}
							}

							$reordered_choices = array_merge( $reordered_choices, array_diff_assoc( $setting['options'], $reordered_choices ) );

						?>

						<ul class="sortable-list">
							<?php foreach ( $setting['options'] as $option_key => $option_value ) {

								if ( in_array( $option_key, $saved_choices, true ) ) {
									$visible = 'visible';
								} else {
									$visible = 'invisible';
								} ?>

								<li class="sortable-list__item <?php echo esc_attr( $visible ); ?>" data-key="<?php echo esc_attr( trim( $option_key ) ); ?>"><?php echo esc_html( $option_value ); ?>
									<i class="dashicons dashicons-visibility <?php echo esc_attr( $visible ); ?>"></i>
								</li>
							<?php } ?>
						</ul>

						<input class="widefat sortable-input <?php echo esc_attr( $class ); ?>" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>" type="hidden" value="<?php echo esc_attr( $value ); ?>" />

						<?php if ( isset( $setting['desc'] ) ) : ?>
							<small><?php echo esc_html( $setting['desc'] ); ?></small>
						<?php endif; ?>
					</p>
					<?php
					break;

				case 'image':
					?>
					<div class="media-widget-control">
						<p>
							<label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"><?php echo wp_kses_post( $setting['label'] ); ?></label><?php // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped ?>
							<input class="widefat image-upload <?php echo esc_attr( $class ); ?>" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>" type="hidden" value="<?php echo esc_attr( $value ); ?>" />
						</p>

						<div class="media-widget-preview">
							<div class="media-image-container">
								<?php if ( ! empty( $value ) ) : ?>
									<img src="<?php echo esc_url( $value ) ; ?>" alt="Image Preview" style="max-width:100%;margin-bottom:10px" />
								<?php endif; ?>
							</div>

							<div class="attachment-media-view">
								<button type="button" class="select-media button-add-media button-add-adv-media not-selected"><?php esc_html_e( 'Add Image' ); ?></button>
							</div>
						</div>

						<?php if ( isset( $setting['desc'] ) ) : ?>
							<small><?php echo esc_html( $setting['desc'] ); ?></small>
						<?php endif; ?>

					</div>
					<?php
					break;

				// Default: run an action.
				default:
					do_action( 'WPA_Widget_field_' . $setting['type'], $key, $value, $setting, $instance );
					break;
			}
		}
	}

	/**
	 * Get cached widget.
	 *
	 * @param array $args Arguments.
	 * 
	 * @return bool
	 */
	public function get_cached_widget( $args ) {
		// Don't get cache if widget_id doesn't exists.
		if ( empty( $args['widget_id'] ) ) {
			return false;
		}

		$cache = wp_cache_get( $this->get_widget_id_for_cache( $this->widget_id ), 'widget' );

		if ( ! is_array( $cache ) ) {
			$cache = array();
		}

		if ( isset( $cache[ $this->get_widget_id_for_cache( $args['widget_id'] ) ] ) ) {
			echo $cache[ $this->get_widget_id_for_cache( $args['widget_id'] ) ]; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
			return true;
		}

		return false;
	}

	/**
	 * Cache the widget.
	 *
	 * @param array  $args    Arguments.
	 * @param string $content Content.
	 * 
	 * @return string
	 */
	public function cache_widget( $args, $content ) {
		// Don't set any cache if widget_id doesn't exist.
		if ( empty( $args['widget_id'] ) ) {
			return $content;
		}

		$cache = wp_cache_get( $this->get_widget_id_for_cache( $this->widget_id ), 'widget' );

		if ( ! is_array( $cache ) ) {
			$cache = array();
		}

		$cache[ $this->get_widget_id_for_cache( $args['widget_id'] ) ] = $content;

		wp_cache_set( $this->get_widget_id_for_cache( $this->widget_id ), $cache, 'widget' );

		return $content;
	}

	/**
	 * Flush the cache.
	 */
	public function flush_widget_cache() {
		foreach ( array( 'https', 'http' ) as $scheme ) {
			wp_cache_delete( $this->get_widget_id_for_cache( $this->widget_id, $scheme ), 'widget' );
		}
	}

	/**
	 * Get widget id plus scheme/protocol to prevent serving mixed content from (persistently) cached widgets.
	 * 
	 * @param string $widget_id Id of the cached widget.
	 * @param string $scheme    Scheme for the widget id.
	 * 
	 * @return string
	 */
	protected function get_widget_id_for_cache( $widget_id, $scheme = '' ) {
		if ( $scheme ) {
			$widget_id_for_cache = $widget_id . '-' . $scheme;
		} else {
			$widget_id_for_cache = $widget_id . '-' . ( is_ssl() ? 'https' : 'http' );
		}

		return apply_filters( 'aesthetix_cached_widget_id', $widget_id_for_cache );
	}
}
