<?php
/**
 * Template functions.
 *
 * @since 1.0.0
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'vardump' ) ) {

	/**
	 * Dump code var.
	 * 
	 * @since 1.0.0
	 *
	 * @param string $var parameter for dumping.
	 */
	function vardump( $var = '' ) {
		if ( current_user_can( 'manage_options' ) ) {
			echo '<pre>';
				var_dump( $var );
			echo '</pre>';
		}
	}
}

if ( ! function_exists( 'is_subscribe_form_theme_active' ) ) {

	/**
	 * Adds conditions for subscribe form theme script activation.
	 * 
	 * @since 1.2.1
	 * 
	 * @return bool
	 */
	function is_subscribe_form_theme_active() {

		$active = false;

		$widgets = array( 'aesthetix_subscribe_form_widget', 'aesthetix_subscribe_popup_form_widget' );
		foreach ( $widgets as $key => $widget ) {
			if ( is_active_widget( 0, 0, $widget ) ) {
				$active = true;
			}
		}

		if ( get_aesthetix_options( 'general_subscribe_form_display' ) ) {
			$active = true;
		}

		$mobile_menu_structure = get_aesthetix_options( 'general_mobile_menu_structure' );

		if ( is_string( $mobile_menu_structure ) && ! empty( $mobile_menu_structure ) ) {
			$mobile_menu_structure = array_map( 'trim', explode( ',', $mobile_menu_structure ) );
		}

		if ( in_array( 'subscribe', $mobile_menu_structure, true ) ) {
			$active = true;
		}

		if ( get_aesthetix_options( 'general_subscribe_form_type' ) !== 'theme' ) {
			$active = false;
		}
		
		$active = apply_filters( 'is_subscribe_form_theme_active', $active );

		return $active;
	}
}

if ( ! function_exists( 'is_magnific_popup_active' ) ) {

	/**
	 * Adds conditions for magnific popup script activation.
	 * 
	 * @since 1.2.1
	 * 
	 * @return bool
	 */
	function is_magnific_popup_active() {

		$active = false;

		$widgets = array( 'aesthetix_search_popup_form_widget', 'aesthetix_subscribe_popup_form_widget' );
		foreach ( $widgets as $key => $widget ) {
			if ( is_active_widget( 0, 0, $widget ) ) {
				$active = true;
			}
		}

		$mobile_menu_structure = get_aesthetix_options( 'general_mobile_menu_structure' );

		if ( is_string( $mobile_menu_structure ) && ! empty( $mobile_menu_structure ) ) {
			$mobile_menu_structure = array_map( 'trim', explode( ',', $mobile_menu_structure ) );
		}

		if ( in_array( 'search', $mobile_menu_structure, true ) || in_array( 'subscribe', $mobile_menu_structure, true ) ) {
			$active = true;
		}
		
		$active = apply_filters( 'is_magnific_popup_active', $active );

		return $active;
	}
}

if ( ! function_exists( 'array_key_first' ) ) {

	/**
	 * Callback function array_key_first(), if none exists.
	 * 
	 * @since 1.0.0
	 *
	 * @param array $array Array to search for the first key.
	 *
	 * @return int
	 */
	function array_key_first( $array = array() ) {

		if ( ! is_array( $array ) || empty( $array ) ) {
			return null;
		}

		foreach ( $array as $key => $unused ) {
			return $key;
		}

		return null;
	}
}

if ( ! function_exists( 'array_key_last' ) ) {

	/**
	 * Callback function array_key_last(), if none exists.
	 * 
	 * @since 1.0.0
	 *
	 * @param array $array Array to search for the last key.
	 *
	 * @return int
	 */
	function array_key_last( $array = array() ) {

		if ( ! is_array( $array ) || empty( $array ) ) {
			return null;
		}

		return array_keys( $array )[ count( $array ) - 1 ];
	}
}

if ( ! function_exists( 'sanitize_form_field' ) ) {

	/**
	 * Form field sanitize function.
	 * 
	 * @since 1.0.0
	 *
	 * @param string $string Sanitize and unslash string.
	 *
	 * @return string
	 */
	function sanitize_form_field( $string = '' ) {
		return sanitize_text_field( wp_unslash( $string ) );
	}
}

if ( ! function_exists( 'is_int_even' ) ) {

	/**
	 * Whether the number transmitted is an even number.
	 * 
	 * @since 1.0.0
	 *
	 * @param int $var Source int.
	 *
	 * @return int
	 */
	function is_int_even( $var = 0 ) {
		return ! ( (int) $var & 1 );
	}
}

if ( ! function_exists( 'shuffle_assoc' ) ) {

	/**
	 * Shuffle the array with the keys intact.
	 * 
	 * @since 1.0.0
	 *
	 * @param array $array Source array.
	 *
	 * @return array
	 */
	function shuffle_assoc( $array = array() ) {

		$new  = array();
		$keys = array_keys( $array );

		shuffle( $keys );

		foreach ( $keys as $key ) {
			$new[ $key ] = $array[ $key ];
		}

		$array = $new;

		return $array;
	}
}

if ( ! function_exists( 'kses_available_tags' ) ) {

	/**
	 * Available tags for wp_kses() function.
	 * 
	 * @since 1.0.0
	 *
	 * @return array
	 */
	function kses_available_tags() {

		$available_tags = array(
			'p'      => array(
				'class' => true,
			),
			'span'   => array(
				'class' => true,
			),
			'b'      => array(),
			'i'      => array(),
			'strong' => array(),
			'a'      => array(
				'href'   => true,
				'class'  => true,
				'target' => true,
			),
			'ul'     => array(),
			'ol'     => array(),
			'li'     => array(),
			'dl'     => array(),
			'dt'     => array(),
			'dd'     => array(),
			'code'   => array(),
			'pre'    => array(),
		);

		return apply_filters( 'kses_available_tags', $available_tags );
	}
}

if ( ! function_exists( 'array_insert_after' ) ) {

	/**
	 * Insert a value or key/value pair after a specific key in an array. If key doesn't exist, value is appended to the end of the array.
	 * 
	 * @since 1.1.3
	 * 
	 * @link https://gist.github.com/wpscholar/0deadce1bbfa4adb4e4c
	 *
	 * @param array  $array
	 * @param string $key
	 * @param array  $new
	 *
	 * @return array
	 */
	function array_insert_after( array $array, $key, array $new ) {
		$keys = array_keys( $array );
		$index = array_search( $key, $keys );
		$pos = false === $index ? count( $array ) : $index + 1;

		return array_merge( array_slice( $array, 0, $pos ), $new, array_slice( $array, $pos ) );
	}
}

if ( ! function_exists( 'get_curl_content' ) ) {

	/**
	 * Retrieves content via curl and writes an acknowledgement/error in the log file.
	 * 
	 * @since 1.0.0
	 *
	 * @param string $url   Source url for parsing.
	 * @param string $proxy Proxy server.
	 *
	 * @return string
	 */
	function get_curl_content( $url, $proxy = '' ) {

		$ch = curl_init();

		curl_setopt( $ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36' );
		curl_setopt( $ch, CURLOPT_URL, $url );

		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false ); // Остановка проверки сертификата.
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true ); // Возвращаем результат в строке вместо вывода в браузер.
		curl_setopt( $ch, CURLOPT_HEADER, false );
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true ); // Переходим по редиректу.
		curl_setopt( $ch, CURLOPT_COOKIESESSION, true ); // Устанавливаем новую «сессию» cookies.
		curl_setopt( $ch, CURLOPT_COOKIE, session_name() . '=' . session_id() );
		curl_setopt( $ch, CURLOPT_COOKIEFILE, dirname( __FILE__ ) . '/temp/cookie.txt' );
		curl_setopt( $ch, CURLOPT_COOKIEJAR, dirname( __FILE__ ) . '/temp/cookie.txt' );

		// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		// curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
		// curl_setopt($ch, CURLOPT_PROXY, '$proxy');

		$html = curl_exec( $ch );

		curl_close( $ch );

		return $html;
	}
}

if ( ! function_exists( 'save_remote_file' ) ) {

	/**
	 * Retrieves content via curl and writes an acknowledgement/error in the log file.
	 * 
	 * @since 1.0.0
	 *
	 * @param string $file_link External file link.
	 * @param string $file_name File name.
	 * @param string $file_path Path on the server to save the file.
	 * @param string $sleep     Delay after receiving a file. Default: 0.1 sec
	 *
	 * @return string
	 */
	function save_remote_file( $file_link = null, $file_name = null, $file_path = null, $sleep = 100000 ) {

		if ( is_null( $file_link ) ) {
			return;
		}

		if ( is_null( $file_name ) ) {
			$file_name = get_last_value_from_string( untrailingslashit( $file_link ), '/' );
		}

		$file_name = get_title_slug( $file_name );

		if ( is_null( $file_path ) ) {
			$html_dir   = get_stylesheet_directory() . '/data/html/';

			if ( ! is_dir( $html_dir ) ) {
				mkdir( $html_dir, 0755, true );
			}

			$file_path = trailingslashit( $html_dir ) . $file_name . '.html';
		}

		$ext = pathinfo( $file_path, PATHINFO_EXTENSION );

		// vardump( $file_link );
		// vardump( $file_name );
		// vardump( $file_path );

		// Если файла не существует, пытаемся его получить.
		if ( ! file_exists( $file_path ) ) {
			$external_html = get_curl_content( $file_link, $file_name );
			if ( $external_html !== false ) {
				$external_html     = apply_filters( 'save_remote_file', $external_html, $file_link );
				$file_put_contents = file_put_contents( $file_path, $external_html, LOCK_EX );
				if ( $file_put_contents === false ) {
					vardump( 'Возникла ошибка при парсинге файла ' . $file_name . '.' . $ext . ' (ссылка ' . $file_link . ')' );
				} else {
					vardump( 'Файл ' . $file_name . '.' . $ext . ' успешно скачан' );
				}
				usleep( (int) $sleep );
			} else {
				vardump( 'Хуевый ответ от функции get_curl_content() (ссылка ' . $file_link . ')' );
			}
		}

		return $file_path;
	}
}

if ( ! function_exists( 'get_escape_title' ) ) {

	/**
	 * Escapes and beautifies title.
	 * 
	 * @since 1.0.0
	 *
	 * @param string $string Source title.
	 *
	 * @return string
	 */
	function get_escape_title( $string = null ) {

		if ( is_null( $string ) ) {
			return false;
		}

		$string = wptexturize( $string );
		$string = convert_chars( $string );
		$string = esc_html( $string );
		$string = capital_P_dangit( $string );
		$string = preg_replace( '/\s+/', ' ', $string );
		$string = trim( $string );

		return $string;
	}
}

if ( ! function_exists( 'get_title_slug' ) ) {

	/**
	 * Convert title string to slug.
	 * 
	 * @since 1.0.0
	 *
	 * @param string $string Source title.
	 *
	 * @return string
	 */
	function get_title_slug( $string = null ) {

		if ( is_null( $string ) ) {
			return false;
		}

		if ( is_plugin_active( 'cyr2lat/cyr-to-lat.php' ) && isset( $GLOBALS['cyr_to_lat_plugin'] ) ) {
			$string = $GLOBALS['cyr_to_lat_plugin']->transliterate( $string );
		}

		$string = sanitize_title( $string );
		$string = urldecode( $string );
		$string = preg_replace( '/([^a-z\d\-\_])/', '', $string );

		return $string;
	}
}

if ( ! function_exists( 'get_random_date' ) ) {

	/**
	 * Gets a random date between two specified dates.
	 * 
	 * @since 1.0.0
	 *
	 * @param string $start_date Starting date.
	 * @param string $end_date   Final date.
	 * @param string $format     Format date for output.
	 *
	 * @return string
	 */
	function get_random_date( $start_date, $end_date, $format = 'Y-m-d H:i:s' ) {

		$random_date = wp_rand( strtotime( $start_date ), strtotime( $end_date ) );
		$random_date = gmdate( $format, $random_date );

		return $random_date;
	}
}

if ( ! function_exists( 'get_explode_part' ) ) {

	/**
	 * Gets the specified value from a string divided by the specified separator.
	 * 
	 * @since 1.0.0
	 *
	 * @param string $string    Source input string.
	 * @param int    $num       Array key.
	 * @param string $separator Separator for explode string.
	 *
	 * @return string
	 */
	function get_explode_part( $string = null, $num = 0, $separator = ',' ) {

		if ( is_null( $string ) ) {
			return false;
		}

		$num = intval( $num );

		if ( ! is_int( $num ) ) {
			return false;
		}

		$array = array_map( 'trim', explode( $separator, $string ) );

		if ( isset( $array[ $num ] ) ) {
			return $array[ $num ];
		} else {
			return false;
		}
	}
}

if ( ! function_exists( 'get_first_value_from_string' ) ) {

	/**
	 * Gets the first value from the string divided by the specified separator.
	 * 
	 * @since 1.0.0
	 *
	 * @param string $string    Source input string.
	 * @param string $separator Separator for explode string.
	 *
	 * @return string
	 */
	function get_first_value_from_string( $string = null, $separator = ',' ) {

		if ( is_null( $string ) ) {
			return false;
		}

		$array = array_map( 'trim', explode( $separator, $string ) );

		return $array[0];
	}
}

if ( ! function_exists( 'get_last_value_from_string' ) ) {

	/**
	 * Gets the last value from the string divided by the specified separator.
	 * 
	 * @since 1.0.0
	 *
	 * @param string $string    Source input string.
	 * @param string $separator Separator for explode string.
	 *
	 * @return string
	 */
	function get_last_value_from_string( $string = null, $separator = ',' ) {

		if ( is_null( $string ) ) {
			return false;
		}

		$array = array_map( 'trim', explode( $separator, $string ) );
		$array = array_reverse( $array );

		return $array[0];
	}
}

if ( ! function_exists( 'get_first_post_img' ) ) {

	/**
	 * Gets the first image in the content.
	 * 
	 * @since 1.0.0
	 *
	 * @param object $post Object for search image.
	 *
	 * @return string
	 */
	function get_first_post_img( $post = null ) {

		if ( is_null( $post ) ) {
			$output = preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', get_the_content(), $matches );
		} else {
			$output = preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches );
		}

		$first_image = $matches[1][0];

		if ( empty( $first_image ) ) {
			$first_image = get_stylesheet_directory_uri() . '/assets/img/default-banner.jpg';
		}

		return $first_image;
	}
}

if ( ! function_exists( 'format_bytes' ) ) {

	/**
	 * Formats bytes into a human-readable representation.
	 * 
	 * @since 1.0.0
	 *
	 * @param int $bytes     Number of bytes.
	 * @param int $precision Number of characters for rounding.
	 *
	 * @return string
	 */
	function format_bytes( $bytes, $precision = 2 ) {

		$units = array( 'B', 'KB', 'MB', 'GB', 'TB' );

		$bytes = max( $bytes, 0 );
		$pow   = floor( ( $bytes ? log( $bytes ) : 0 ) / log( 1024 ) );
		$pow   = min( $pow, count( $units ) - 1 );

		// Uncomment one of the following strings.
		$bytes /= pow( 1024, $pow );
		// $bytes /= (1 << (10 * $pow));

		return round( $bytes, $precision ) . ' ' . $units[ $pow ];
	}
}

if ( ! function_exists( 'str_word_count_utf8' ) ) {

	/**
	 * Counts the number of words in the utf string.
	 * 
	 * @since 1.0.0
	 *
	 * @param string $string Source string.
	 *
	 * @return int
	 */
	function str_word_count_utf8( $string ) {
		$array = preg_split( '/\W+/u', $string, -1, PREG_SPLIT_NO_EMPTY );
		return count( $array );
	}
}

if ( ! function_exists( 'read_time_estimate' ) ) {

	/**
	 * Returns the approximate reading time of the article to the line.
	 * 
	 * @since 1.0.0
	 *
	 * @param string $content Source content.
	 *
	 * @return string
	 */
	function read_time_estimate( $content = null ) {

		if ( is_null( $content ) ) {
			return false;
		}

		// Clear the content from the tags, count the number of words.
		$word_count = str_word_count_utf8( wp_strip_all_tags( $content ) );

		// 150 - average word reading speed per minute.
		$words_per_minute = 150;

		// Article reading time in minutes.
		$minutes = floor( $word_count / $words_per_minute );

		if ( (int) $minutes === 0 ) {
			$str = '< 1';
		} elseif ( ( (int) $minutes > 0 ) && ( (int) $minutes <= 10 ) ) {
			$p   = $minutes + 1;
			$str = (string) $minutes . '-' . (string) $p;
		} else {
			$p   = $minutes + 5;
			$str = (string) $minutes . '-' . (string) $p;
		}

		return $str;
	}
}

if ( ! function_exists( 'mb_ucfirst' ) && extension_loaded( 'mbstring' ) ) {

	/**
	 * Returns the string with the first capital letter.
	 * 
	 * @since 1.0.0
	 *
	 * @param string $str      Source string.
	 * @param string $encoding The default encoding is UTF-8.
	 *
	 * @return string
	 */
	function mb_ucfirst( $str, $encoding = 'UTF-8' ) {
		$str = mb_ereg_replace( '^[\ ]+', '', $str );
		$str = mb_strtoupper( mb_substr( $str, 0, 1, $encoding ), $encoding ) . mb_substr( $str, 1, mb_strlen( $str ), $encoding );
		return $str;
	}
}

if ( ! function_exists( 'RGBtoHEX' ) ) {

	/**
	 * RGB to HEX color conversion function.
	 * 
	 * @since 1.0.0
	 *
	 * @param string $string Source string for converting.
	 *
	 * @return string
	 */
	function RGBtoHEX( $string = null ) {

		if ( is_null( $string ) ) {
			return false;
		}

		$rgb = explode( ', ', $string );

		if ( count( $rgb ) !== 3 ) {
			return $string;
		}

		$r = dechex( preg_replace( '/\D+/', '', $rgb[0] ) );
		if ( strlen( $r ) < 2 ) {
			$r = '0' . $r;
		}

		$g = dechex( preg_replace( '/\D+/', '', $rgb[1] ) );
		if ( strlen( $g ) < 2 ) {
			$g = '0' . $g;
		}

		$b = dechex( preg_replace( '/\D+/', '', $rgb[2] ) );
		if ( strlen( $b ) < 2 ) {
			$b = '0' . $b;
		}

		return '#' . $r . $g . $b;
	}
}

if ( ! function_exists( 'remove_emoji' ) ) {

	/**
	 * Returns string with remove emojies.
	 * 
	 * @since 1.0.0
	 *
	 * @param string $string Source string.
	 *
	 * @return string
	 */
	function remove_emoji( $string = null ) {

		if ( is_null( $string ) ) {
			return false;
		}

		// Match Emoticons.
		$clear_string = preg_replace( '/[\x{1F600}-\x{1F64F}]/u', '', $string );

		// Match Miscellaneous Symbols and Pictographs.
		$clear_string = preg_replace( '/[\x{1F300}-\x{1F5FF}]/u', '', $clear_string );

		// Match Transport And Map Symbols.
		$clear_string = preg_replace( '/[\x{1F680}-\x{1F6FF}]/u', '', $clear_string );

		// Match Miscellaneous Symbols.
		$clear_string = preg_replace( '/[\x{2600}-\x{26FF}]/u', '', $clear_string );

		// Match Dingbats.
		$clear_string = preg_replace( '/[\x{2700}-\x{27BF}]/u', '', $clear_string );

		return $clear_string;
	}
}
