<?php
/**
 * Customizer main setup.
 *
 * @since 1.0.0
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'aesthetix_customize_register' ) ) {

	/**
	 * Add postMessage support for site title and description for the Theme Customizer.
	 * 
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	function aesthetix_customize_register( $wp_customize ) {

		// Control Note.
		class Title_Customize_Control extends WP_Customize_Control {

			public function render_content() {
				echo '<span>' . get_escape_title( $this->label ) . '</span>';
			}
		}

		class Sortable_Custom_Control extends WP_Customize_Control {
			public $type = 'sortable';

			public function render_content() {

				$input_id          = '_customize-input-' . $this->id;
				$description_id    = '_customize-description-' . $this->id;
				$describedby_attr  = ( ! empty( $this->description ) ) ? ' aria-describedby="' . esc_attr( $description_id ) . '" ' : '';
				$reordered_choices = array();
				$saved_choices     = explode( ',', esc_attr( $this->value() ) );

				foreach ( $saved_choices as $key => $value ) {
					if( isset( $this->choices[ $value ] ) ) {
						$reordered_choices[ $value ] = $this->choices[ $value ];
					}
				}

				$reordered_choices = array_merge( $reordered_choices, array_diff_assoc( $this->choices, $reordered_choices ) );

				?>

				<?php if ( ! empty( $this->label ) ) : ?>
					<label for="<?php echo esc_attr( $input_id ); ?>" class="customize-control-title"><?php echo esc_html( $this->label ); ?></label>
				<?php endif; ?>
				<?php if ( ! empty( $this->description ) ) : ?>
					<span id="<?php echo esc_attr( $description_id ); ?>" class="description customize-control-description"><?php echo $this->description; ?></span>
				<?php endif; ?>

				<ul class="sortable-list">
					<?php foreach ( $reordered_choices as $key => $item ) {

						if ( in_array( $key, $saved_choices, true ) ) {
							$visible = 'visible';
						} else {
							$visible = 'invisible';
						}

						?>

						<li class="sortable-list__item <?php echo $visible; ?>" data-key="<?php echo esc_attr( trim( $key ) ); ?>"><?php echo esc_html( $item ); ?>
							<i class="dashicons dashicons-visibility <?php echo $visible; ?>"></i>
						</li>
					<?php } ?>
				</ul>

				<input id="<?php echo esc_attr( $input_id ); ?>"<?php echo $describedby_attr; ?> type="hidden" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?>>

				<?php
			}
		}

		// Sanitize textfield.
		function aesthetix_sanitize_textfield( $input ) {
			return sanitize_text_field( $input );
		}

		// Sanitize checkbox.
		function aesthetix_sanitize_checkbox( $input ) {
			return $input ? true : false;
		}

		// Sanitize select.
		function aesthetix_sanitize_select( $input, $setting ) {
			// Get all select options.
			$controls = $setting->manager->get_control( $setting->id )->choices;
			// Return default if not valid.
			return ( array_key_exists( $input, $controls ) ? $input : $setting->default );
		}

		// Sanitize number absint.
		function aesthetix_sanitize_number_control( $number, $setting ) {

			// Ensure $number is an absolute integer.
			$number = absint( $number );

			// Return default if not integer.
			return ( $number ? $number : $setting->default );

		}

		function aesthetix_sanitize_sortable( $input ) {
			$sanitized_input = array();
			foreach ( $input as $key => $value ) {
				$sanitized_input[ $key ] = sanitize_text_field( $value );
			}
			return $sanitized_input;
		}

		// Sanitize textarea.
		function aesthetix_sanitize_textarea( $input ) {

			$allowedtags = array(
				'a'      => array(
					'href'   => array(),
					'title'  => array(),
					'_blank' => array(),
				),
				'img'    => array(
					'src'    => array(),
					'alt'    => array(),
					'width'  => array(),
					'height' => array(),
					'style'  => array(),
					'class'  => array(),
					'id'     => array(),
				),
				'br'     => array(),
				'em'     => array(),
				'strong' => array(),
				'script' => array(),
			);

			// Return filtered html.
			return esc_html( $input );
		}

		// Common functions for reusable options.
		// Title tab.
		function aesthetix_tab_title( $section, $id, $name, $description, $priority ) {
			global $wp_customize;

			$wp_customize->add_setting( 'aesthetix_options[' . $section . '_' . $id . ']', array(
				'type'      => 'theme_mod',
				'transport' => 'postMessage',
			) );
			$wp_customize->add_control( 'aesthetix_options[' . $section . '_' . $id . ']', array(
				'label'       => $name,
				'section'     => apply_filters( 'aesthetix_customizer_section_control', 'aesthetix_' . $section, $id ),
				'type'        => 'hidden',
				'description' => $description,
				'priority'    => $priority,
			) );
		}

		// Number control.
		function aesthetix_number_control( $section, $id, $name, $atts, $priority ) {
			global $wp_customize;

			$wp_customize->add_setting( 'aesthetix_options[' . $section . '_' . $id . ']', array(
				'default'           => get_aesthetix_options( $section . '_' . $id ),
				'type'              => 'option',
				'transport'         => 'postMessage',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'aesthetix_sanitize_number_control',
			) );
			$wp_customize->add_control( 'aesthetix_options[' . $section . '_' . $id . ']', array(
				'label'       => $name,
				'section'     => apply_filters( 'aesthetix_customizer_section_control', 'aesthetix_' . $section, $id ),
				'type'        => 'number',
				'input_attrs' => $atts,
				'priority'    => $priority,
			) );
		}

		// Text control.
		function aesthetix_text_control( $section, $id, $name, $description, $priority ) {
			global $wp_customize;

			$wp_customize->add_setting( 'aesthetix_options[' . $section . '_' . $id . ']', array(
				'default'           => get_aesthetix_options( $section . '_' . $id ),
				'type'              => 'option',
				'transport'         => 'refresh',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
			) );
			$wp_customize->add_control( 'aesthetix_options[' . $section . '_' . $id . ']', array(
				'label'       => $name,
				'description' => wp_kses_post( $description ),
				'section'     => apply_filters( 'aesthetix_customizer_section_control', 'aesthetix_' . $section, $id ),
				'type'        => 'text',
				'priority'    => $priority,
			) );
		}

		// Textarea control.
		function aesthetix_textarea_control( $section, $id, $name, $description, $priority ) {
			global $wp_customize;

			$wp_customize->add_setting( 'aesthetix_options[' . $section . '_' . $id . ']', array(
				'default'           => get_aesthetix_options( $section . '_' . $id ),
				'type'              => 'option',
				'transport'         => 'refresh',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'esc_html',
			) );
			$wp_customize->add_control( 'aesthetix_options[' . $section . '_' . $id . ']', array(
				'label'       => $name,
				'description' => wp_kses_post( $description ),
				'section'     => apply_filters( 'aesthetix_customizer_section_control', 'aesthetix_' . $section, $id ),
				'type'        => 'textarea',
				'priority'    => $priority,
			) );
		}

		// Url control.
		function aesthetix_url_control( $section, $id, $name, $description, $priority ) {
			global $wp_customize;

			$wp_customize->add_setting( 'aesthetix_options[' . $section . '_' . $id . ']', array(
				'default'           => get_aesthetix_options( $section . '_' . $id ),
				'type'              => 'option',
				'transport'         => 'refresh',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'esc_url_raw',
			) );
			$wp_customize->add_control( 'aesthetix_options[' . $section . '_' . $id . ']', array(
				'label'       => $name,
				'description' => wp_kses_post( $description ),
				'section'     => apply_filters( 'aesthetix_customizer_section_control', 'aesthetix_' . $section, $id ),
				'type'        => 'text',
				'priority'    => $priority,
			) );
		}

		// Checkbox control.
		function aesthetix_checkbox_control( $section, $id, $name, $description, $priority ) {
			global $wp_customize;

			$wp_customize->add_setting( 'aesthetix_options[' . $section . '_' . $id . ']', array(
				'default'           => get_aesthetix_options( $section . '_' . $id ),
				'type'              => 'option',
				'transport'         => 'refresh',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'aesthetix_sanitize_checkbox',
			) );
			$wp_customize->add_control( 'aesthetix_options[' . $section . '_' . $id . ']', array(
				'label'       => $name,
				'description' => wp_kses_post( $description ),
				'section'     => apply_filters( 'aesthetix_customizer_section_control', 'aesthetix_' . $section, $id ),
				'type'        => 'checkbox',
				'priority'    => $priority,
			) );
		}

		// Select control.
		function aesthetix_select_control( $section, $id, $name, $description, $atts, $priority ) {
			global $wp_customize;

			$wp_customize->add_setting( 'aesthetix_options[' . $section . '_' . $id . ']', array(
				'default'           => get_aesthetix_options( $section . '_' . $id ),
				'type'              => 'option',
				'transport'         => 'refresh',
				'capability'        => 'edit_theme_options',
				'sanitize_callback'	=> 'aesthetix_sanitize_select',
			) );
			$wp_customize->add_control( 'aesthetix_options[' . $section . '_' . $id . ']', array(
				'label'       => $name,
				'description' => wp_kses_post( $description ),
				'section'     => apply_filters( 'aesthetix_customizer_section_control', 'aesthetix_' . $section, $id ),
				'type'        => 'select',
				'choices'     => $atts,
				'priority'    => $priority,
			) );
		}

		// Radio control.
		function aesthetix_radio_control( $section, $id, $name, $description, $atts, $priority ) {
			global $wp_customize;

			$wp_customize->add_setting( 'aesthetix_options[' . $section . '_' . $id . ']', array(
				'default'           => get_aesthetix_options( $section . '_' . $id ),
				'type'              => 'option',
				'transport'         => 'refresh',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'aesthetix_sanitize_select',
			) );
			$wp_customize->add_control( 'aesthetix_options[' . $section . '_' . $id . ']', array(
				'label'       => $name,
				'description' => wp_kses_post( $description ),
				'section'     => apply_filters( 'aesthetix_customizer_section_control', 'aesthetix_' . $section, $id ),
				'type'        => 'radio',
				'choices'     => $atts,
				'priority'    => $priority,
			) );
		}

		// Sortable control.
		function aesthetix_sortable_control( $section, $id, $name, $description, $atts, $priority ) {
			global $wp_customize;

			$wp_customize->add_setting( 'aesthetix_options[' . $section . '_' . $id . ']', array(
				'default'           => get_aesthetix_options( $section . '_' . $id ),
				'type'              => 'option',
				'transport'         => 'refresh',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'aesthetix_sanitize_textfield',
			) );
			$wp_customize->add_control( new Sortable_Custom_Control( $wp_customize, 'aesthetix_options[' . $section . '_' . $id . ']', array(
				'label'       => $name,
				'description' => wp_kses_post( $description ),
				'section'     => apply_filters( 'aesthetix_customizer_section_control', 'aesthetix_' . $section, $id ),
				'type'        => 'sortable',
				'choices'     => $atts,
				'priority'    => $priority,
			) ) );
		}

		// Image control.
		function aesthetix_image_control( $section, $id, $name, $description, $priority ) {
			global $wp_customize;

			$wp_customize->add_setting( 'aesthetix_options[' . $section . '_' . $id . ']', array(
				'default'           => get_aesthetix_options( $section . '_' . $id ),
				'type'              => 'option',
				'transport'         => 'refresh',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'aesthetix_sanitize_textfield',
			) );
			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'aesthetix_options[' . $section . '_' . $id . ']', array(
				'label'       => $name,
				'description' => wp_kses_post( $description ),
				'section'     => apply_filters( 'aesthetix_customizer_section_control', 'aesthetix_' . $section, $id ),
				'type'        => 'image',
				'priority'    => $priority,
			) ) );
		}

		// Add sections.
		$priority = 1;
		foreach ( get_aesthetix_customizer_sections() as $section_name => $section ) {

			$default_section = array(
				'title'      => $section_name,
				'priority'   => $priority,
				'capability' => 'edit_theme_options',
			);

			$wp_customize->add_section( 'aesthetix_' . $section_name, wp_parse_args( $section, $default_section ) );

			$priority++;
		}

		// Set theme options.
		foreach ( get_aesthetix_customizer_controls() as $section_name => $control ) {
			$priority = 0;
			foreach ( $control as $control_name => $value ) {

				$priority++;

				switch ( $value[0] ) {
					case 'tab_title':
						aesthetix_tab_title( $section_name, $control_name, $value[1], $value[2]/*description*/, $priority );
						break;
					case 'number_control':
						aesthetix_number_control( $section_name, $control_name, $value[1], $value[2]/*atts*/, $priority );
						break;
					case 'text_control':
						aesthetix_text_control( $section_name, $control_name, $value[1], $value[2]/*description*/, $priority );
						break;
					case 'textarea_control':
						aesthetix_textarea_control( $section_name, $control_name, $value[1], $value[2]/*description*/, $priority );
						break;
					case 'url_control':
						aesthetix_url_control( $section_name, $control_name, $value[1], $value[2]/*description*/, $priority );
						break;
					case 'checkbox_control':
						aesthetix_checkbox_control( $section_name, $control_name, $value[1], $value[2]/*description*/, $priority );
						break;
					case 'select_control':
						aesthetix_select_control( $section_name, $control_name, $value[1], $value[2]/*description*/, $value[3]/*atts*/, $priority );
						break;
					case 'radio_control':
						aesthetix_radio_control( $section_name, $control_name, $value[1], $value[2]/*description*/, $value[3]/*atts*/, $priority );
						break;
					case 'sortable_control':
						aesthetix_sortable_control( $section_name, $control_name, $value[1], $value[2]/*description*/, $value[3]/*atts*/, $priority );
						break;
					case 'image_control':
						aesthetix_image_control( $section_name, $control_name, $value[1], $value[2]/*description*/, $priority );
						break;
					default:
						break;
				}
			}
		}
	}
}
add_action( 'customize_register', 'aesthetix_customize_register' );

if ( ! function_exists( 'aesthetix_customize_preview_js' ) ) {

	/**
	 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
	 * 
	 * @since 1.0.0
	 */
	function aesthetix_customize_preview_js() {
		// wp_enqueue_style( 'aesthetix-customizer-ui', get_theme_file_uri( '/assets/css/customizer-ui.min.css' ), array(), filemtime( get_theme_file_path( '/assets/css/customizer-ui.min.css' ) ) );
		// wp_enqueue_script( 'aesthetix-customizer-ui', get_theme_file_uri( '/assets/js/customizer-ui.min.js' ), array( 'customize-preview' ), filemtime( get_theme_file_path( '/assets/js/customizer-ui.min.js' ) ), true );
	}
}
add_action( 'customize_preview_init', 'aesthetix_customize_preview_js' );

if ( ! function_exists( 'aesthetix_customize_panels_js' ) ) {

	/**
	 * Load dynamic logic for the customizer controls area.
	 * 
	 * @since 1.0.0
	 */
	function aesthetix_customize_panels_js() {

		wp_enqueue_script( 'jquery-ui-sortable' );

		wp_enqueue_style( 'aesthetix-customizer', get_theme_file_uri( '/assets/css/customizer.min.css' ), array(), filemtime( get_theme_file_path( '/assets/css/customizer.min.css' ) ) );
		wp_enqueue_script( 'aesthetix-customizer', get_theme_file_uri( '/assets/js/customizer.min.js' ), array(), filemtime( get_theme_file_path( '/assets/js/customizer.min.js' ) ), true );

		$root_string = '';
		foreach ( get_aesthetix_customizer_roots() as $key => $root_value ) {
			$root_string .= '--' . $key . ': ' . $root_value . ';';
		}

		wp_add_inline_style( 'aesthetix-customizer', ':root {' . esc_attr( $root_string ) . '}' );
	}
}
add_action( 'customize_controls_enqueue_scripts', 'aesthetix_customize_panels_js' );
