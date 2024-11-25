<?php
/**
 * Template functions.
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

if ( ! function_exists( 'return_template_part' ) ) {

	/**
	 * Return content from get_template_part() function.
	 *
	 * @param string      $slug The slug name for the generic template.
	 * @param string|null $name The name of the specialized template or null if
	 *                          there is none.
	 * @param array       $args Additional arguments passed to the template.
	 */
	function return_template_part( $slug, $name = null, $args = array() ) {
		ob_start();
		get_template_part( $slug, $name, $args );
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
}

if ( ! function_exists( 'get_post_type_archive_template_path' ) ) {

	/**
	 * Function to get archive template.
	 *
	 * @param string $post_type
	 *        string $post_layout
	 *        string $post_format
	 * 
	 * @return void
	 */
	function get_post_type_archive_template_path( $post_type, $post_layout = null, $post_format = false ) {

		if ( is_null( $post_layout ) ) {
			$post_layout = get_aesthetix_options( 'archive_' . $post_type . '_layout' );
		}

		if ( $post_format === false ) {
			$post_format = 'standard';
		}

		$templates = array(
			"templates/archive/archive-{$post_type}-{$post_layout}-{$post_format}",
			"templates/archive/archive-{$post_type}-{$post_format}",
			"templates/archive/archive-{$post_type}-{$post_layout}",
			"templates/archive/archive-{$post_type}",
			"templates/archive/archive-post-{$post_layout}-{$post_format}",
			"templates/archive/archive-post-{$post_format}",
			"templates/archive/archive-post-{$post_layout}",
			"templates/archive/archive-post",
		);

		foreach ( $templates as $template ) {
			if ( locate_template( $template . '.php', false, false ) ) {
				return $template;
				break;
			}
		}

		return $templates[ array_key_last( $templates ) ];
	}
}

if ( ! function_exists( 'get_post_type_widget_template_path' ) ) {

	/**
	 * Function to get widget template.
	 *
	 * @param string $post_type
	 *        string $post_layout
	 *        string $post_format
	 * 
	 * @return void
	 */
	function get_post_type_widget_template_path( $post_type, $post_layout = null, $post_format = false ) {

		if ( is_null( $post_layout ) ) {
			$post_layout = get_aesthetix_options( 'archive_' . $post_type . '_layout' );
		}

		if ( $post_format === false ) {
			$post_format = 'standard';
		}

		$templates = array(
			"templates/widget/widget-{$post_type}-{$post_layout}-{$post_format}",
			"templates/widget/widget-{$post_type}-{$post_format}",
			"templates/widget/widget-{$post_type}-{$post_layout}",
			"templates/widget/widget-{$post_type}",
			"templates/widget/widget-post-{$post_layout}-{$post_format}",
			"templates/widget/widget-post-{$post_format}",
			"templates/widget/widget-post-{$post_layout}",
			"templates/widget/widget-post",
		);

		foreach ( $templates as $template ) {
			if ( locate_template( $template . '.php', false, false ) ) {
				return $template;
				break;
			}
		}

		return $templates[ array_key_last( $templates ) ];
	}
}

if ( ! function_exists( 'get_template_call_count' ) ) {

	/**
	 * Function to get and increment the template call count.
	 *
	 * @param string $template Parameter for dumping. Default null (return false)
	 */
	function get_template_call_count( $template = null ) {

		if ( is_null( $template ) ) {
			return false;
		}

		global $template_call_count;

		if ( is_null( $template_call_count ) || ! isset( $template_call_count[ $template ] ) ) {
			$template_call_count[ $template ] = 1;
		} else {
			$template_call_count[ $template ]++;
		}

		return $template_call_count[ $template ];
	}
}

if ( ! function_exists( 'array_key_first' ) ) {

	/**
	 * Callback function array_key_first(), if none exists.
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

if ( ! function_exists( 'get_escape_title' ) ) {

	/**
	 * Escapes and beautifies title.
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

if ( ! function_exists( 'get_unique_anchor' ) ) {

	/**
	 * Unique anchor.
	 *
	 * @param string $anchor  Anchor for checking.
	 * @param array $anchors  Array for checking.
	 * @param int $key        Key that will be added to the anchor if it already exists.
	 */
	function get_unique_anchor( $anchor, $anchors = array(), $key = 0 ) {

		if ( $key > 0 ) {
			$anchor_check = $anchor . '-' . $key;
		} else {
			$anchor_check = $anchor;
		}

		if ( in_array( $anchor_check, $anchors, true ) ) {
			$key++;
			$anchors[]    = $anchor_check;
			$anchor_check = get_unique_anchor( $anchor, $anchors, $key );
		}

		return $anchor_check;
	}
}

if ( ! function_exists( 'get_first_value_from_string' ) ) {

	/**
	 * Gets the first value from the string divided by the specified separator.
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

		if ( isset( $matches[1], $matches[1][0] ) ) {
			$first_image = $matches[1][0];
		} else {
			$first_image = get_stylesheet_directory_uri() . '/assets/img/default-banner.jpg';
		}

		return $first_image;
	}
}

if ( ! function_exists( 'get_largest_image_from_srcset' ) ) {

	/**
	 * Gets the largest image from srcset.
	 *
	 * @param string $srcset
	 *
	 * @return string
	 */
	function get_largest_image_from_srcset( $srcset ) {

		// Разбиваем строку srcset на отдельные элементы.
		$images = explode( ',', $srcset );

		// Инициализация переменных для хранения самого большого изображения.
		$largest_image = '';
		$max_width     = 0;

		foreach ( $images as $image ) {
			// Очищаем пробелы и разбиваем на части: URL и ширину.
			list( $url, $width ) = array_map( 'trim', explode( ' ', trim( $image ) ) );

			// Убираем "w" из ширины и приводим к целому числу.
			$width = intval( $width );

			// Проверяем, если ширина больше текущей максимальной, обновляем данные.
			if ( $width > $max_width ) {
				$max_width     = $width;
				$largest_image = $url;
			}
		}

		// Возвращаем URL самого большого изображения.
		return $largest_image;
	}
}

if ( ! function_exists( 'format_bytes' ) ) {

	/**
	 * Formats bytes into a human-readable representation.
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

		return round( $bytes, $precision ) . '&nbsp;' . $units[ $pow ];
	}
}

if ( ! function_exists( 'str_word_count_utf8' ) ) {

	/**
	 * Counts the number of words in the utf string.
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

if ( ! function_exists( 'array_insert_after' ) ) {

	/**
	 * Insert a value or key/value pair after a specific key in an array. If key doesn't exist, value is appended to the end of the array.
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
		$keys  = array_keys( $array );
		$index = array_search( $key, $keys );
		$pos   = false === $index ? count( $array ) : $index + 1;

		return array_merge( array_slice( $array, 0, $pos ), $new, array_slice( $array, $pos ) );
	}
}

if ( ! function_exists( 'has_menu_items' ) ) {

	/**
	 * Check if a WordPress navigation menu has items.
	 *
	 * @param string $menu_name The name of the menu location to check.
	 * 
	 * @return bool Whether the menu has items (true) or is empty (false).
	 */
	function has_menu_items( $menu_name ) {

		// Get all registered menu locations and their assigned menus.
		$locations = get_nav_menu_locations();

		// Check if the menu location exists.
		if ( isset( $locations[ $menu_name] ) ) {
			// Get the menu object based on the menu location.
			$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );

			// Check if the menu has items
			if ( $menu && ! empty( wp_get_nav_menu_items( $menu->term_id ) ) ) {
				return true;
			}
		}

		return false;
	}
}

if ( ! function_exists( 'is_subscribe_form_theme_active' ) ) {

	/**
	 * Adds conditions for subscribe form theme script activation.
	 * 
	 * @return bool
	 */
	function is_subscribe_form_theme_active() {

		$active = true; // TODO: Load by condition.

		$widgets = array( 'aesthetix_subscribe_form_widget', 'aesthetix_subscribe_popup_form_widget' );
		foreach ( $widgets as $key => $widget ) {
			if ( is_active_widget( 0, 0, $widget ) ) {
				$active = true;
			}
		}

		if ( get_aesthetix_options( 'general_subscribe_form_display' ) ) {
			// $active = true;
		}

		if ( get_aesthetix_options( 'general_subscribe_form_type' ) !== 'theme' ) {
			// $active = false;
		}
		
		$active = apply_filters( 'is_subscribe_form_theme_active', $active );

		return $active;
	}
}

if ( ! function_exists( 'is_magnific_popup_active' ) ) {

	/**
	 * Adds conditions for magnific popup script activation.
	 * 
	 * @return bool
	 */
	function is_magnific_popup_active() {

		$active = true; // TODO: Load by condition.

		$widgets = array( 'aesthetix_search_popup_form_widget', 'aesthetix_subscribe_popup_form_widget' );
		foreach ( $widgets as $key => $widget ) {
			if ( is_active_widget( 0, 0, $widget ) ) {
				$active = true;
			}
		}
		
		$active = apply_filters( 'is_magnific_popup_active', $active );

		return $active;
	}
}

if ( ! function_exists( 'get_curl_content' ) ) {

	/**
	 * Retrieves content via curl and writes an acknowledgement/error in the log file.
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
	 * Receives and saves a file (html or image) by the given link.
	 * Returns an array of information about the function's operation.
	 *
	 * @param string $file_link External file link. Required
	 *        string $delay     Delay to reload. In strtotime values. 1 month example. Default: null
	 *        string $file_type Сontent type to parse. html/image options. Default: html
	 *        string $file_path Path to save file. Default: html
	 *        string $sleep     Delay after receiving a file. Default: 100000 (0.1 sec)
	 *
	 * @return array
	 */
	function save_remote_file( $file_link, $args = null ) {

		$defaults = array(
			'delay'      => null,
			'file_type'  => 'html',
			'file_path'  => 'data/html/',
			'sleep'      => 100000,
		);

		$parsed_args = wp_parse_args( $args, $defaults );

		$response = array(
			'where' => 'save_remote_file',
		);

		// Check that the link validate.
		if ( wp_http_validate_url( sanitize_url( $file_link ) ) === false ) {
			$response['ok']      = false;
			$response['message'] = sprintf( 'The link failed validation via the wp_http_validate_url function. File %s', $file_link );
			return apply_filters( 'save_remote_file', $response );
		}

		$file_dir = trailingslashit( get_stylesheet_directory() ) . trailingslashit( $parsed_args['file_path'] );

		// Сheck folder exists.
		if ( ! is_dir( $file_dir ) ) {
			mkdir( $file_dir, 0755, true );
		}

		$file_link = sanitize_url( $file_link );

		if ( $parsed_args['file_type'] === 'html' ) {

			$parse_url = wp_parse_url( $file_link );

			if ( ! isset( $parse_url['path'] ) || empty( untrailingslashit( $parse_url['path'] ) ) ) {
				$file_name = get_title_slug( $parse_url['host'] );
			} else {
				$file_name = get_title_slug( $parse_url['host'] . '-' . untrailingslashit( $parse_url['path'] ) );
			}

			$file_name = preg_replace('/^www-/', '', $file_name );
			$file_name = apply_filters( 'save_remote_file_name', $file_name, $file_link, $parsed_args );
			$basename  = $file_name . '.html';

		} elseif ( ! empty( pathinfo( $file_link, PATHINFO_EXTENSION ) ) ) {

			$file_name = pathinfo( $file_link, PATHINFO_FILENAME );
			$basename  = pathinfo( $file_link, PATHINFO_BASENAME );

		} else {

			$response['ok']      = false;
			$response['message'] = sprintf( 'For some reason the file %s doesn\'t have an extension', $file_link );
			return apply_filters( 'save_remote_file', $response );

		}

		$file_path        = trailingslashit( $file_dir ) . $basename;
		$response['file'] = $file_path;
		$response['name'] = $file_name;

		// Сheck file exists or it needs to be updated.
		if ( ! file_exists( $file_path ) || ( ! is_null( $parsed_args['delay'] ) && strtotime( '-' . $parsed_args['delay'], time() ) !== false && strtotime( '-' . $parsed_args['delay'], time() ) > filemtime( $file_path ) ) ) {

			if ( is_int( $parsed_args['sleep'] ) && $parsed_args['sleep'] > 0 ) {
				usleep( (int) $parsed_args['sleep'] );
			}

			$request = wp_remote_request( $file_link );

			if ( is_wp_error( $request ) ) {

				$response['ok']      = false;
				$response['message'] = sprintf( 'There was an error parsing the file %s. Message: %s. Link: %s', $basename, $request->get_error_message(), $file_link );

			} elseif ( in_array( wp_remote_retrieve_response_code( $request ), array( 400, 401, 403, 404 ), true ) ) {

				$response['ok']      = false;
				$response['message'] = sprintf( 'There was an error parsing the file %s. Code %s. Link: %s', $basename, wp_remote_retrieve_response_code( $request ), $file_link );

			} elseif ( wp_remote_retrieve_response_code( $request ) === 200 ) {

				// New or updated file.
				$new_file          = file_exists( $file_path ) ? true : false;
				$body              = apply_filters( 'save_remote_file_body', wp_remote_retrieve_body( $request ), $file_link, $parsed_args );
				$file_put_contents = file_put_contents( $file_path, $body, LOCK_EX );

				if ( $file_put_contents === false ) {
					$response['ok']      = false;
					$response['message'] = sprintf( 'There was an error parsing the file %s. Link: %s', $basename, $file_link );
				} else {
					$response['ok'] = true;
					if ( $new_file ) {
						$response['message'] = sprintf( 'File %s updated successfully', $basename );
					} else {
						$response['message'] = sprintf( 'File %s downloaded successfully', $basename );
					}
				}

			}
		} else {

			$response['ok']      = true;
			$response['message'] = sprintf( 'The file %s already exists', $basename );'The file already exists';

		}

		return apply_filters( 'save_remote_file', $response );
	}
}

if ( ! function_exists( 'aesthetix_wp_mail' ) ) {

	/**
	 * Send letter function.
	 *
	 * @param string $message  Message in a letter.
	 * @param array  $email_to Array of emails to send. Default, the letter is sent to the main admin and the author of the post.
	 * @param string $subject  Letter subject. Default 'Notice from the site %s'.
	 */
	function aesthetix_wp_mail( $message, $email_to = array(), $subject = null ) {

		if ( empty( $email_to ) ) {
			$email_to[] = get_option( 'admin_email' );

			global $post;
			if ( is_object( $post ) && isset( $post->ID ) ) {
				$userdata = get_userdata( $post->post_author );

				if ( $userdata ) {
					$email_to[] = $userdata->user_email;
				}
			}
		} elseif ( is_string( $email_to ) ) {
			$email_to = explode( ' ', $email_to );
		}

		$url_host   = wp_parse_url( get_home_url(), PHP_URL_HOST );
		$email_from = 'noreply@' . $url_host;
		$headers    = 'From: ' . $url_host . ' <' . $email_from . '>' . "\r\n" . 'Reply-To: ' . $email_from;

		if ( is_null( $subject ) ) {
			$subject = __( 'Notice from the site', 'aesthetix' ) . ' ' . $url_host;
		}

		// Send email.
		$wp_mail = wp_mail( array_unique( $email_to ), $subject, $message, $headers );

		// Error sending email.
		if ( is_wp_error( $wp_mail ) ) {
			$data = (int) $wp_mail->get_error_data();
			if ( ! empty( $wp_mail ) ) {
				return $wp_mail->get_error_message();
			} else {
				return __( 'An unknown error has occurred', 'aesthetix' );;
			}
		} else {
			return true;
		}
	}
}

if ( ! function_exists( 'aesthetix_flush_post_cache' ) ) {

	/**
	 * Deletes the current page cache depending on the plugin used.
	 * 
	 * @param ind $post_id Post ID for clearing.
	 * 
	 * @return bool
	 */
	function aesthetix_flush_post_cache( $post_id = null ) {

		if ( is_null( $post_id ) ) {
			return;
		}

		$post = get_post( $post_id );

		if ( is_null( $post ) ) {
			return;
		}

		// W3 Total Cache.
		if ( function_exists( 'w3tc_flush_post' ) ) {
			w3tc_flush_post( $post_id );
		}

		// WP Super Cache.
		if ( function_exists( 'wp_cache_post_change' ) ) {
			wp_cache_post_change( $post_id );
		}

		// WP Rocket.
		if ( function_exists( 'rocket_clean_post' ) ) {
			rocket_clean_post( $post_id );
		}

		// WP Fastest Cache.
		if ( function_exists( 'wpfc_clear_post_cache_by_id' ) ) {
			wpfc_clear_post_cache_by_id( $post_id );
		}

		// WP Optimize.
		if ( class_exists( 'WPO_Page_Cache' ) ) {
			WPO_Page_Cache::delete_single_post_cache( $post_id );
		}

		// LiteSpeed Cache.
		if ( has_action( 'litespeed_purge_post' ) ) {
			add_action( 'litespeed_purge_post', $post_id );
		}
	}
}
