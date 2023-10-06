<?php
/**
 * Theme shortcodes
 *
 * @package Aesthetix
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// add_shortcode( 'aesthetix-logo', 'get_aesthetix_site_branding' ); // [aesthetix-logo].
add_shortcode( 'aesthetix-copyright', 'aesthetix_shortcode_copyright' ); // [aesthetix-copyright year="2016" display="rights" text="Zolin Digital" link="https://zolin.digital/" font-size="small"].
add_shortcode( 'current-year', 'aesthetix_current_year' ); // [current-year year="2019"].
add_shortcode( 'current-date', 'aesthetix_current_date' ); // [current-date format="j F Y" date="28.01.2020" add_days="1"].
add_shortcode( 'privacy-link', 'aesthetix_privacy_link' ); // [privacy-link font-size="small"].
add_shortcode( 'aesthetix-social-list', 'aesthetix_shortcode_social_list' ); // [aesthetix-social-list type="links" class="list-inline"].
add_shortcode( 'aesthetix-telegram', 'aesthetix_shortcode_telegram' ); // [aesthetix-telegram link="t.me//artzolin"].
add_shortcode( 'aesthetix-whatsapp', 'aesthetix_shortcode_whatsapp' ); // [aesthetix-whatsapp number="+79500463854"].
add_shortcode( 'aesthetix-contacts-list', 'aesthetix_shortcode_contact_list' ); // [aesthetix-contacts-list].
add_shortcode( 'aesthetix-address', 'aesthetix_shortcode_address' ); // [aesthetix-address].
add_shortcode( 'aesthetix-phone', 'aesthetix_shortcode_phone' ); // [aesthetix-phone].
add_shortcode( 'aesthetix-email', 'aesthetix_shortcode_email' ); // [aesthetix-email].

if ( ! function_exists( 'aesthetix_shortcode_copyright' ) ) {

	/**
	 * Add shortcode [aesthetix-copyright year="2016" display="rights" font-size="small"]
	 *
	 * @param array $atts shortcode attributes..
	 *
	 * @return string
	 * 
	 * @since 1.0.0
	 */
	function aesthetix_shortcode_copyright( $atts ) {

		$output         = '';
		$home_url_parts = wp_parse_url( get_home_url() );

		// Define a white list of attributes.
		$atts = shortcode_atts( array(
			'class'      => '',
			'year'       => '',
			'text'       => 'Zolin Digital',
			'link'       => '',
			'link-class' => '',
			'display'    => '',
			'font-size'  => 'normal', // small, large.
		), $atts );

		if ( empty( $atts['link'] ) ) {
			if ( determine_locale() === 'ru_RU' ) {
				$atts['link'] = 'https://artzolin.ru/';
			} else {
				$atts['link'] = 'https://zolin.digital/';
			}
		}

		// Собираем utm.
		if ( is_multisite() ) {
			$network_url_parts = wp_parse_url( network_home_url() );
			$utm               = add_query_arg( array( 'utm_source' => $home_url_parts['host'], 'utm_medium' => $network_url_parts['host'] ), $atts['link'] );
		} else {
			$utm = add_query_arg( array( 'utm_source' => $home_url_parts['host'] ), $atts['link'] );
		}

		// Собираем год.
		$current_year = gmdate( 'Y' );
		if ( $atts['year'] ) {
			$year = $atts['year'] . '-' . $current_year;
		} else {
			$year = $current_year;
		}

		// Собираем классы для тега <p>.
		$classes[] = 'copyright__item';
		if ( $atts['font-size'] !== 'normal' ) {
			$classes[] = $atts['font-size'];
		}

		// Собираем классы для тега <a>.
		$links_classes[] = 'copyright__link';
		$links_classes[] = 'initialism';
		if ( $atts['link-class'] ) {
			$links_classes[] = $atts['link-class'];
		}

		// Собираем HTML.
		$output .= '<div class="copyright">';
		if ( empty( $atts['display'] ) || $atts['display'] === 'created' ) {
			$output .= '<p class="' . esc_attr( implode( ' ', $classes ) ) . '">' . __( 'Created by', 'aesthetix' ) . ' <strong><a class="' . esc_attr( implode( ' ', get_link_classes( $links_classes ) ) ) . '" href="' . esc_url( $utm ) . '" rel="external">' . mb_convert_case( esc_html( $atts['text'] ), MB_CASE_TITLE, 'UTF-8' ) . '</a></strong></p>';
		}
		if ( empty( $atts['display'] ) || $atts['display'] === 'rights' ) {
			$output .= '<p class="' . esc_attr( implode( ' ', $classes ) ) . '">&#9400; ' . esc_html( $year ) . ' ' . __( 'All rights reserved', 'aesthetix' ) . ' ' . esc_html( $home_url_parts['host'] ) . '</p>';
		}
		$output .= '</div>';

		return apply_filters( 'aesthetix_shortcode_copyright', $output );
	}
}

if ( ! function_exists( 'aesthetix_current_year' ) ) {

	/**
	 * Add shortcode with current year [current-year year="2019"]
	 *
	 * @param array $atts shortcode attributes.
	 *
	 * @return string
	 * 
	 * @since 1.0.0
	 */
	function aesthetix_current_year( $atts ) {

		// Define a white list of attributes.
		$atts = shortcode_atts( array(
			'year' => gmdate( 'Y' ),
		), $atts );

		$output = '<span class="current-year">' . esc_html( $atts['year'] ) . '</span>';

		return apply_filters( 'aesthetix_current_year', $output );
	}
}

if ( ! function_exists( 'aesthetix_current_date' ) ) {

	/**
	 * Add shortcode with current date [current-date format="j F Y" date="28.01.2020" add_days="1"]
	 *
	 * @param array $atts shortcode attributes.
	 *
	 * @return string
	 * 
	 * @since 1.0.0
	 */
	function aesthetix_current_date( $atts ) {

		// Define a white list of attributes.
		$atts = shortcode_atts( array(
			'format'   => 'j F Y',
			'date'     => gmdate( 'd-m-Y' ),
			'add_days' => '0',
		), $atts );

		$output = mysql2date( $atts['format'], gmdate( 'Y-m-d', strtotime( $atts['date'] . ' + ' . $atts['add_days'] . ' days' ) ) );

		return apply_filters( 'current_date', $output );
	}
}

if ( ! function_exists( 'aesthetix_privacy_link' ) ) {

	/**
	 * Add shortcode with privacy link [privacy-link font-size="small"]
	 *
	 * @param array $atts shortcode attributes.
	 *
	 * @return string
	 * 
	 * @since 1.0.0
	 */
	function aesthetix_privacy_link( $atts ) {

		// Define a white list of attributes.
		$atts = shortcode_atts( array(
			'class'     => '',
			'text'      => __( 'Privacy policy', 'aesthetix' ),
			'font-size'	=> 'normal', // small, large.
		), $atts );

		$output = '';

		// Собираем классы ссылки.
		$classes[] = 'privacy_link';
		if ( $atts['class'] ) {
			$classes[] = $atts['class'];
		}

		$output .= '<p class="' . esc_attr( $atts['font-size'] ) . '"><a ' . link_classes( $classes, false ) . ' href="' . esc_url( get_privacy_policy_url() ) . '">' . get_escape_title( $atts['text'] ) . '</a></p>';

		return apply_filters( 'aesthetix_current_year', $output );
	}
}

if ( ! function_exists( 'aesthetix_shortcode_social_list' ) ) {

	/**
	 * Add shortcode with social list [aesthetix-social-list type="links" class="list-inline"]
	 *
	 * @param array $atts shortcode attributes.
	 *
	 * @return string
	 * 
	 * @since 1.0.0
	 */
	function aesthetix_shortcode_social_list( $atts ) {

		// Define a white list of attributes.
		$atts = shortcode_atts( array(
			'class'	=> '',
			'type'  => 'icons-rounded',
		), $atts );

		// Собираем классы списка.
		$classes[] = 'social-list';
		$classes[] = 'social-list_' . $atts['type'];
		if ( $atts['type'] === 'links' ) {
			$classes[] = 'social-list_block';
		} else {
			$classes[] = 'social-list_inline';
		}
		if ( $atts['class'] ) {
			$classes[] = $atts['class'];
		}

		$socials = array( 'vkontakte', 'facebook', 'instagram', 'youtube', 'twitter', 'telegram', 'linkedin' );

		// Собираем HTML.
		$output = '<ul class="' . esc_attr( implode( ' ', $classes ) ) . '">';
			foreach ( $socials as $key => $social ) {
				if ( get_aesthetix_options( 'other_' . $social ) ) {

					if ( $atts['type'] === 'icons' ) {
						$link_classes = 'social-list__link icon icon_' . $social;
					} elseif ( $atts['type'] === 'icons-rounded' ) {
						$link_classes = 'social-list__link icon icon_rounded icon_' . $social;
					} elseif ( $atts['type'] === 'icons-squared' ) {
						$link_classes = 'social-list__link icon icon_squared icon_' . $social;
					} else {
						$link_classes = implode( ' ', get_link_classes( 'social-list__link' ) );
					}

					$output .= '<li class="social-list__item">';
						$output .= '<a class="' . esc_attr( $link_classes ) . '" href="' . esc_url( get_aesthetix_options( 'other_' . $social ) ) . '" target="_blank" rel="noopener noreferrer external">';
							if ( $atts['type'] === 'links' ) {
								$output .= mb_ucfirst( $social );
							}
						$output .= '</a>';
					$output .= '</li>';
				}
			}
		$output .= '</ul>';

		return apply_filters( 'aesthetix_shortcode_social_list', $output );
	}
}

if ( ! function_exists( 'aesthetix_shortcode_telegram' ) ) {

	/**
	 * Add shortcode with telegram link [aesthetix-telegram link="t.me//artzolin"]
	 *
	 * @param array $atts shortcode attributes.
	 *
	 * @return string
	 * 
	 * @since 1.0.0
	 */
	function aesthetix_shortcode_telegram( $atts ) {

		// Define a white list of attributes.
		$atts = shortcode_atts( array(
			'class' => 'button button-telegram icon icon_telegram',
			'link'  => get_aesthetix_options( 'other_telegram_chat_link' ),
		), $atts );

		$output = '<a class="' . esc_attr( $atts['class'] ) . '" href="' . esc_url( 'https://t.me/' . $atts['nick'] ) . '">' . __( 'Write to Telegram', 'aesthetix' ) . '</a>';

		return apply_filters( 'aesthetix_shortcode_telegram', $output );
	}
}

if ( ! function_exists( 'aesthetix_shortcode_whatsapp' ) ) {

	/**
	 * Add shortcode with whatsapp link [aesthetix-whatsapp number="+79500463854"]
	 *
	 * @param array $atts shortcode attributes.
	 *
	 * @return string
	 * 
	 * @since 1.0.0
	 */
	function aesthetix_shortcode_whatsapp( $atts ) {

		// Define a white list of attributes.
		$atts = shortcode_atts( array(
			'class'  => 'button button-whatsapp icon icon_whatsapp',
			'number' => get_aesthetix_options( 'other_whatsapp_phone' ),
		), $atts );

		$output = '<a class="' . esc_attr( $atts['class'] ) . '" href="' . esc_url( 'https://api.whatsapp.com/send?phone=' . preg_replace( '/(\D)/', '', $atts['number'] ) ) . '">' . __( 'Write to WhatsApp', 'aesthetix' ) . '</a>';

		return apply_filters( 'aesthetix_shortcode_whatsapp', $output );
	}
}

if ( ! function_exists( 'aesthetix_shortcode_contact_list' ) ) {

	/**
	 * Add shortcode with contact list [aesthetix-contacts-list]
	 *
	 * @param array $atts shortcode attributes.
	 *
	 * @return string
	 * 
	 * @since 1.0.0
	 */
	function aesthetix_shortcode_contact_list( $atts ) {

		// Define a white list of attributes.
		$atts = shortcode_atts( array(
			'class' => 'contacts-list',
		), $atts );

		$output = '';

		if ( get_aesthetix_options( 'other_address' ) || get_aesthetix_options( 'other_phone' ) || get_aesthetix_options( 'other_email' ) ) {

			$output = '<ul class="' . esc_attr( $atts['class'] ) . '">';
			if ( get_aesthetix_options( 'other_address' ) ) {
				$output .= '<li class="contacts-list__item contacts-list__item_address">' . get_escape_title( get_aesthetix_options( 'other_address' ) ) . '</li>';
			}
			if ( get_aesthetix_options( 'other_phone' ) ) {
				$output .= '<li class="contacts-list__item contacts-list__item_phone"><a class="' . esc_attr( implode( ' ', get_link_classes( 'contacts-list__link' ) ) ) . '" href="tel:' . esc_attr( preg_replace( '/[^0-9]/', '', get_aesthetix_options( 'other_phone' ) ) ) . '">' . esc_html( get_aesthetix_options( 'other_phone' ) ) . '</a></li>';
			}
			if ( get_aesthetix_options( 'other_email' ) ) {
				$output .= '<li class="contacts-list__item contacts-list__item_email"><a class="' . esc_attr( implode( ' ', get_link_classes( 'contacts-list__link' ) ) ) . '" href="mailto:' . esc_attr( get_aesthetix_options( 'other_email' ) ) . '">' . esc_html( get_aesthetix_options( 'other_email' ) ) . '</a></li>';
			}
			$output .= '</ul>';
		}

		return apply_filters( 'aesthetix_shortcode_contact_list', $output );
	}
}

if ( ! function_exists( 'aesthetix_shortcode_address' ) ) {

	/**
	 * Add shortcode with address [aesthetix-address]
	 *
	 * @param array $atts shortcode attributes.
	 *
	 * @return string
	 * 
	 * @since 1.0.0
	 */
	function aesthetix_shortcode_address() {

		// Define a white list of attributes.
		$atts = shortcode_atts( array(
			'class' => 'contacts-list__item contacts-list__item_address',
			'text'  => get_aesthetix_options( 'other_address' ),
		), $atts );

		$output = '<p class="' . esc_attr( $atts['class'] ) . '">' . esc_html( $atts['text'] ) . '</p>';

		return apply_filters( 'aesthetix_shortcode_address', $output );
	}
}

if ( ! function_exists( 'aesthetix_shortcode_phone' ) ) {

	/**
	 * Add shortcode with phone number [aesthetix-phone]
	 *
	 * @param array $atts shortcode attributes.
	 *
	 * @return string
	 * 
	 * @since 1.0.0
	 */
	function aesthetix_shortcode_phone() {

		// Define a white list of attributes.
		$atts = shortcode_atts( array(
			'class' => 'contacts-list__item contacts-list__item_phone',
			'phone' => get_aesthetix_options( 'other_phone' ),
		), $atts );

		$output = '<p class="' . esc_attr( $atts['class'] ) . '"><a class="' . esc_attr( implode( ' ', get_link_classes( 'contacts-list__link' ) ) ) . '" href="tel:' . esc_attr( preg_replace( '/[^0-9]/', '', $atts['phone'] ) ) . '">' . esc_html( $atts['phone'] ) . '</a></p>';

		return apply_filters( 'aesthetix_shortcode_phone', $output );
	}
}

if ( ! function_exists( 'aesthetix_shortcode_email' ) ) {

	/**
	 * Add shortcode with email [aesthetix-email]
	 *
	 * @param array $atts shortcode attributes.
	 *
	 * @return string
	 * 
	 * @since 1.0.0
	 */
	function aesthetix_shortcode_email() {

		// Define a white list of attributes.
		$atts = shortcode_atts( array(
			'class' => 'contacts-list__item contacts-list__item_email',
			'email' => get_aesthetix_options( 'other_email' ),
		), $atts );

		$output = '<p class="' . esc_attr( $atts['class'] ) . '"><a class="' . esc_attr( implode( ' ', get_link_classes( 'contacts-list__link' ) ) ) . '" href="mailto:' . esc_attr( $atts['email'] ) . '">' . esc_html( $atts['email'] ) . '</a></p>';

		return apply_filters( 'aesthetix_shortcode_email', $output );
	}
}
