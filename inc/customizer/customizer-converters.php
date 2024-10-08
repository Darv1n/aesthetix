<?php
/**
 * Customizer converters.
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'get_aesthetix_customizer_converter_sizes' ) ) {

	/**
	 * Return string or array with css values.
	 *
	 * @param string $control Key to get one value. Optional. Default null.
	 *
	 * @return string|array|false
	 */
	function get_aesthetix_customizer_converter_sizes( $control = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		// Main converter array.
		$converter = array(
			'none' => '0rem',
			'xxs'  => '.25rem',
			'xs'   => '.5rem',
			'sm'   => '.75rem',
			'md'   => '1rem',
			'lg'   => '1.25rem',
			'xl'   => '1.5rem',
			'xxl'  => '1.75rem',
		);

		$converter = apply_filters( 'get_aesthetix_customizer_converter_sizes', $converter );

		// Return controls.
		if ( is_null( $control ) ) {
			return $converter;
		} elseif ( ! isset( $converter[ $control ] ) || empty( $converter[ $control ] ) ) {
			return false;
		} else {
			return $converter[ $control ];
		}
	}
}

if ( ! function_exists( 'get_aesthetix_customizer_converter_button_sizes' ) ) {

	/**
	 * Return string or array with css values.
	 *
	 * @param string $control Key to get one value. Optional. Default null.
	 *
	 * @return string|array|false
	 */
	function get_aesthetix_customizer_converter_button_sizes( $control = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		// Main converter array.
		$converter = array(
			'xxs' => '.125rem 1rem',
			'xs'  => '.25rem 1.125rem',
			'sm'  => '.375rem 1.25rem',
			'md'  => '.5rem 1.375rem',
			'lg'  => '.625rem 1.5rem',
			'xl'  => '.75rem 1.625rem',
			'xxl' => '.875rem 1.75rem',
		);

		$converter = apply_filters( 'get_aesthetix_customizer_converter_button_sizes', $converter );

		// Return controls.
		if ( is_null( $control ) ) {
			return $converter;
		} elseif ( ! isset( $converter[ $control ] ) || empty( $converter[ $control ] ) ) {
			return false;
		} else {
			return $converter[ $control ];
		}
	}
}

if ( ! function_exists( 'get_aesthetix_customizer_converter_borders' ) ) {

	/**
	 * Return string or array with css values.
	 *
	 * @param string $control Key to get one value. Optional. Default null.
	 *
	 * @return string|array|false
	 */
	function get_aesthetix_customizer_converter_borders( $control = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		// Main converter array.
		$converter = array(
			'none' => '0px',
			'xs'   => '1px',
			'sm'   => '2px',
			'md'   => '3px',
			'lg'   => '4px',
			'xl'   => '6px',
		);

		$converter = apply_filters( 'get_aesthetix_customizer_converter_borders', $converter );

		// Return controls.
		if ( is_null( $control ) ) {
			return $converter;
		} elseif ( ! isset( $converter[ $control ] ) || empty( $converter[ $control ] ) ) {
			return false;
		} else {
			return $converter[ $control ];
		}
	}
}

if ( ! function_exists( 'get_aesthetix_customizer_converter_radiuses' ) ) {

	/**
	 * Return string or array with css values.
	 *
	 * @param string $control Key to get one value. Optional. Default null.
	 *
	 * @return string|array|false
	 */
	function get_aesthetix_customizer_converter_radiuses( $control = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		// Main converter array.
		$converter = array(
			'none' => '0px',
			'xxs'  => '.125rem',
			'xs'   => '.25rem',
			'sm'   => '.375rem',
			'md'   => '.5rem',
			'lg'   => '.75rem',
			'xl'   => '1rem',
			'2xl'  => '1.25rem',
			'3xl'  => '1.5rem',
			'4xl'  => '1.75rem',
			'full' => '2rem',
		);

		$converter = apply_filters( 'get_aesthetix_customizer_converter_radiuses', $converter );

		// Return controls.
		if ( is_null( $control ) ) {
			return $converter;
		} elseif ( ! isset( $converter[ $control ] ) || empty( $converter[ $control ] ) ) {
			return false;
		} else {
			return $converter[ $control ];
		}
	}
}

if ( ! function_exists( 'get_aesthetix_customizer_converter_paddings' ) ) {

	/**
	 * Return string or array with css values.
	 *
	 * @param string $control Key to get one value. Optional. Default null.
	 *
	 * @return string|array|false
	 */
	function get_aesthetix_customizer_converter_paddings( $control = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		// Main converter array.
		$converter = array(
			'p-none' => '0',
			'p-1'    => '.25rem',
			'p-2'    => '.5rem',
			'p-3'    => '.75rem',
			'p-4'    => '1rem',
			'p-5'    => '1.25rem',
			'p-6'    => '1.5rem',
		);

		$converter = apply_filters( 'get_aesthetix_customizer_converter_paddings', $converter );

		// Return controls.
		if ( is_null( $control ) ) {
			return $converter;
		} elseif ( ! isset( $converter[ $control ] ) || empty( $converter[ $control ] ) ) {
			return false;
		} else {
			return $converter[ $control ];
		}
	}
}

if ( ! function_exists( 'get_aesthetix_customizer_converter_shadows' ) ) {

	/**
	 * Return string or array with css values.
	 *
	 * @param string $control Key to get one value. Optional. Default null.
	 *
	 * @return string|array|false
	 */
	function get_aesthetix_customizer_converter_shadows( $control = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		// Main converter array.
		$converter = array(
			'none'  => '0 0 #0000',
			'xs'    => '0 1px 2px 0 rgba( 0, 0, 0, .15 )',
			'sm'    => '0 1px 3px 0 rgba( 0, 0, 0, .15 ), 0 1px 2px -1px rgba( 0, 0, 0, .15 )',
			'md'    => '0 4px 6px -1px rgba( 0, 0, 0, .15 ), 0 2px 4px -2px rgba( 0, 0, 0, .15 )',
			'lg'    => '0 10px 15px -3px rgba( 0, 0, 0, .15 ), 0 4px 6px -4px rgba( 0, 0, 0, .15 )',
			'xl'    => '0 20px 25px -5px rgba( 0, 0, 0, .15 ), 0 8px 10px -6px rgba( 0, 0, 0, .15 )',
			'xxl'   => '0 25px 50px -12px rgba( 0, 0, 0, .15 )',
			'inner' => 'inset 0 2px 4px 0 rgba( 0, 0, 0, .15 )',
		);

		$converter = apply_filters( 'get_aesthetix_customizer_converter_shadows', $converter );

		// Return controls.
		if ( is_null( $control ) ) {
			return $converter;
		} elseif ( ! isset( $converter[ $control ] ) || empty( $converter[ $control ] ) ) {
			return false;
		} else {
			return $converter[ $control ];
		}
	}
}

if ( ! function_exists( 'get_aesthetix_customizer_converter_colors' ) ) {

	/**
	 * Return string or array with css values.
	 *
	 * @param string $control Key to get one value. Optional. Default null.
	 * @param string $name    If exists return array with this substring (example border). Optional. Default null.
	 *
	 * @return string|array|false
	 */
	function get_aesthetix_customizer_converter_colors( $control = null, $name = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		// Main converter array.
		$converter = array(
			'dark'         => RGBtoHEX( 'rgb(0, 0, 0)' ),
			'white'        => RGBtoHEX( 'rgb(255, 255, 255)' ),

			'slate-50'     => RGBtoHEX( 'rgb(248, 250, 252)' ),
			'slate-100'    => RGBtoHEX( 'rgb(241, 245, 249)' ),
			'slate-200'    => RGBtoHEX( 'rgb(226, 232, 240)' ),
			'slate-300'    => RGBtoHEX( 'rgb(203, 213, 225)' ),
			'slate-400'    => RGBtoHEX( 'rgb(148, 163, 184)' ),
			'slate-500'    => RGBtoHEX( 'rgb(100, 116, 139)' ),
			'slate-600'    => RGBtoHEX( 'rgb(71, 85, 105)' ),
			'slate-700'    => RGBtoHEX( 'rgb(51, 65, 85)' ),
			'slate-800'    => RGBtoHEX( 'rgb(30, 41, 59)' ),
			'slate-900'    => RGBtoHEX( 'rgb(15, 23, 42)' ),
			'slate-950'    => RGBtoHEX( 'rgb(2, 6, 23)' ),

			'gray-50'      => RGBtoHEX( 'rgb(249, 250, 251)' ),
			'gray-100'     => RGBtoHEX( 'rgb(243, 244, 246)' ),
			'gray-200'     => RGBtoHEX( 'rgb(229, 231, 235)' ),
			'gray-300'     => RGBtoHEX( 'rgb(209, 213, 219)' ),
			'gray-400'     => RGBtoHEX( 'rgb(156, 163, 175)' ),
			'gray-500'     => RGBtoHEX( 'rgb(107, 114, 128)' ),
			'gray-600'     => RGBtoHEX( 'rgb(75, 85, 99)' ),
			'gray-700'     => RGBtoHEX( 'rgb(55, 65, 81)' ),
			'gray-800'     => RGBtoHEX( 'rgb(31, 41, 55)' ),
			'gray-900'     => RGBtoHEX( 'rgb(17, 24, 39)' ),
			'gray-950'     => RGBtoHEX( 'rgb(3, 7, 18)' ),

			'zinc-50'      => RGBtoHEX( 'rgb(250, 250, 250)' ),
			'zinc-100'     => RGBtoHEX( 'rgb(244, 244, 245)' ),
			'zinc-200'     => RGBtoHEX( 'rgb(228, 228, 231)' ),
			'zinc-300'     => RGBtoHEX( 'rgb(212, 212, 216)' ),
			'zinc-400'     => RGBtoHEX( 'rgb(161, 161, 170)' ),
			'zinc-500'     => RGBtoHEX( 'rgb(113, 113, 122)' ),
			'zinc-600'     => RGBtoHEX( 'rgb(82, 82, 91)' ),
			'zinc-700'     => RGBtoHEX( 'rgb(63, 63, 70)' ),
			'zinc-800'     => RGBtoHEX( 'rgb(39, 39, 42)' ),
			'zinc-900'     => RGBtoHEX( 'rgb(24, 24, 27)' ),
			'zinc-950'     => RGBtoHEX( 'rgb(9, 9, 11)' ),

			'neutral-50'   => RGBtoHEX( 'rgb(250, 250, 250)' ),
			'neutral-100'  => RGBtoHEX( 'rgb(245, 245, 245)' ),
			'neutral-200'  => RGBtoHEX( 'rgb(229, 229, 229)' ),
			'neutral-300'  => RGBtoHEX( 'rgb(212, 212, 212)' ),
			'neutral-400'  => RGBtoHEX( 'rgb(163, 163, 163)' ),
			'neutral-500'  => RGBtoHEX( 'rgb(115, 115, 115)' ),
			'neutral-600'  => RGBtoHEX( 'rgb(82, 82, 82)' ),
			'neutral-700'  => RGBtoHEX( 'rgb(64, 64, 64)' ),
			'neutral-800'  => RGBtoHEX( 'rgb(38, 38, 38)' ),
			'neutral-900'  => RGBtoHEX( 'rgb(23, 23, 23)' ),
			'neutral-950'  => RGBtoHEX( 'rgb(10, 10, 10)' ),

			'stone-50'     => RGBtoHEX( 'rgb(250, 250, 249)' ),
			'stone-100'    => RGBtoHEX( 'rgb(245, 245, 244)' ),
			'stone-200'    => RGBtoHEX( 'rgb(231, 229, 228)' ),
			'stone-300'    => RGBtoHEX( 'rgb(214, 211, 209)' ),
			'stone-400'    => RGBtoHEX( 'rgb(168, 162, 158)' ),
			'stone-500'    => RGBtoHEX( 'rgb(120, 113, 108)' ),
			'stone-600'    => RGBtoHEX( 'rgb(87, 83, 78)' ),
			'stone-700'    => RGBtoHEX( 'rgb(68, 64, 60)' ),
			'stone-800'    => RGBtoHEX( 'rgb(41, 37, 36)' ),
			'stone-900'    => RGBtoHEX( 'rgb(28, 25, 23)' ),
			'stone-950'    => RGBtoHEX( 'rgb(12, 10, 9)' ),

			'red-50'       => RGBtoHEX( 'rgb(254, 242, 242)' ),
			'red-100'      => RGBtoHEX( 'rgb(254, 226, 226)' ),
			'red-200'      => RGBtoHEX( 'rgb(254, 202, 202)' ),
			'red-300'      => RGBtoHEX( 'rgb(252, 165, 165)' ),
			'red-400'      => RGBtoHEX( 'rgb(248, 113, 113)' ),
			'red-500'      => RGBtoHEX( 'rgb(239, 68, 68)' ),
			'red-600'      => RGBtoHEX( 'rgb(220, 38, 38)' ),
			'red-700'      => RGBtoHEX( 'rgb(185, 28, 28)' ),
			'red-800'      => RGBtoHEX( 'rgb(153, 27, 27)' ),
			'red-900'      => RGBtoHEX( 'rgb(127, 29, 29)' ),
			'red-950'      => RGBtoHEX( 'rgb(69, 10, 10)' ),

			'orange-50'    => RGBtoHEX( 'rgb(255, 247, 237)' ),
			'orange-100'   => RGBtoHEX( 'rgb(255, 237, 213)' ),
			'orange-200'   => RGBtoHEX( 'rgb(254, 215, 170)' ),
			'orange-300'   => RGBtoHEX( 'rgb(253, 186, 116)' ),
			'orange-400'   => RGBtoHEX( 'rgb(251, 146, 60)' ),
			'orange-500'   => RGBtoHEX( 'rgb(249, 115, 22)' ),
			'orange-600'   => RGBtoHEX( 'rgb(234, 88, 12)' ),
			'orange-700'   => RGBtoHEX( 'rgb(194, 65, 12)' ),
			'orange-800'   => RGBtoHEX( 'rgb(154, 52, 18)' ),
			'orange-900'   => RGBtoHEX( 'rgb(124, 45, 18)' ),
			'orange-950'   => RGBtoHEX( 'rgb(67, 20, 7)' ),

			'amber-50'     => RGBtoHEX( 'rgb(255, 251, 235)' ),
			'amber-100'    => RGBtoHEX( 'rgb(254, 243, 199)' ),
			'amber-200'    => RGBtoHEX( 'rgb(253, 230, 138)' ),
			'amber-300'    => RGBtoHEX( 'rgb(252, 211, 77)' ),
			'amber-400'    => RGBtoHEX( 'rgb(251, 191, 36)' ),
			'amber-500'    => RGBtoHEX( 'rgb(245, 158, 11)' ),
			'amber-600'    => RGBtoHEX( 'rgb(217, 119, 6)' ),
			'amber-700'    => RGBtoHEX( 'rgb(180, 83, 9)' ),
			'amber-800'    => RGBtoHEX( 'rgb(146, 64, 14)' ),
			'amber-900'    => RGBtoHEX( 'rgb(120, 53, 15)' ),
			'amber-950'    => RGBtoHEX( 'rgb(69, 26, 3)' ),

			'yellow-50'    => RGBtoHEX( 'rgb(254, 252, 232)' ),
			'yellow-100'   => RGBtoHEX( 'rgb(254, 249, 195)' ),
			'yellow-200'   => RGBtoHEX( 'rgb(254, 240, 138)' ),
			'yellow-300'   => RGBtoHEX( 'rgb(253, 224, 71)' ),
			'yellow-400'   => RGBtoHEX( 'rgb(250, 204, 21)' ),
			'yellow-500'   => RGBtoHEX( 'rgb(234, 179, 8)' ),
			'yellow-600'   => RGBtoHEX( 'rgb(202, 138, 4)' ),
			'yellow-700'   => RGBtoHEX( 'rgb(161, 98, 7)' ),
			'yellow-800'   => RGBtoHEX( 'rgb(133, 77, 14)' ),
			'yellow-900'   => RGBtoHEX( 'rgb(113, 63, 18)' ),
			'yellow-950'   => RGBtoHEX( 'rgb(66, 32, 6)' ),

			'lime-50'      => RGBtoHEX( 'rgb(247, 254, 231)' ),
			'lime-100'     => RGBtoHEX( 'rgb(236, 252, 203)' ),
			'lime-200'     => RGBtoHEX( 'rgb(217, 249, 157)' ),
			'lime-300'     => RGBtoHEX( 'rgb(190, 242, 100)' ),
			'lime-400'     => RGBtoHEX( 'rgb(163, 230, 53)' ),
			'lime-500'     => RGBtoHEX( 'rgb(132, 204, 22)' ),
			'lime-600'     => RGBtoHEX( 'rgb(101, 163, 13)' ),
			'lime-700'     => RGBtoHEX( 'rgb(77, 124, 15)' ),
			'lime-800'     => RGBtoHEX( 'rgb(63, 98, 18)' ),
			'lime-900'     => RGBtoHEX( 'rgb(54, 83, 20)' ),
			'lime-950'     => RGBtoHEX( 'rgb(26, 46, 5)' ),

			'green-50'     => RGBtoHEX( 'rgb(240, 253, 244)' ),
			'green-100'    => RGBtoHEX( 'rgb(220, 252, 231)' ),
			'green-200'    => RGBtoHEX( 'rgb(187, 247, 208)' ),
			'green-300'    => RGBtoHEX( 'rgb(134, 239, 172)' ),
			'green-400'    => RGBtoHEX( 'rgb(74, 222, 128)' ),
			'green-500'    => RGBtoHEX( 'rgb(34, 197, 94)' ),
			'green-600'    => RGBtoHEX( 'rgb(22, 163, 74)' ),
			'green-700'    => RGBtoHEX( 'rgb(21, 128, 61)' ),
			'green-800'    => RGBtoHEX( 'rgb(22, 101, 52)' ),
			'green-900'    => RGBtoHEX( 'rgb(20, 83, 45)' ),
			'green-950'    => RGBtoHEX( 'rgb(5, 46, 22)' ),

			'emerald-50'   => RGBtoHEX( 'rgb(236, 253, 245)' ),
			'emerald-100'  => RGBtoHEX( 'rgb(209, 250, 229)' ),
			'emerald-200'  => RGBtoHEX( 'rgb(167, 243, 208)' ),
			'emerald-300'  => RGBtoHEX( 'rgb(110, 231, 183)' ),
			'emerald-400'  => RGBtoHEX( 'rgb(52, 211, 153)' ),
			'emerald-500'  => RGBtoHEX( 'rgb(16, 185, 129)' ),
			'emerald-600'  => RGBtoHEX( 'rgb(5, 150, 105)' ),
			'emerald-700'  => RGBtoHEX( 'rgb(4, 120, 87)' ),
			'emerald-800'  => RGBtoHEX( 'rgb(6, 95, 70)' ),
			'emerald-900'  => RGBtoHEX( 'rgb(6, 78, 59)' ),
			'emerald-950'  => RGBtoHEX( 'rgb(2, 44, 34)' ),

			'teal-50'      => RGBtoHEX( 'rgb(240, 253, 250)' ),
			'teal-100'     => RGBtoHEX( 'rgb(204, 251, 241)' ),
			'teal-200'     => RGBtoHEX( 'rgb(153, 246, 228)' ),
			'teal-300'     => RGBtoHEX( 'rgb(94, 234, 212)' ),
			'teal-400'     => RGBtoHEX( 'rgb(45, 212, 191)' ),
			'teal-500'     => RGBtoHEX( 'rgb(20, 184, 166)' ),
			'teal-600'     => RGBtoHEX( 'rgb(13, 148, 136)' ),
			'teal-700'     => RGBtoHEX( 'rgb(15, 118, 110)' ),
			'teal-800'     => RGBtoHEX( 'rgb(17, 94, 89)' ),
			'teal-900'     => RGBtoHEX( 'rgb(19, 78, 74)' ),
			'teal-950'     => RGBtoHEX( 'rgb(4, 47, 46)' ),

			'cyan-50'      => RGBtoHEX( 'rgb(236, 254, 255)' ),
			'cyan-100'     => RGBtoHEX( 'rgb(207, 250, 254)' ),
			'cyan-200'     => RGBtoHEX( 'rgb(165, 243, 252)' ),
			'cyan-300'     => RGBtoHEX( 'rgb(103, 232, 249)' ),
			'cyan-400'     => RGBtoHEX( 'rgb(34, 211, 238)' ),
			'cyan-500'     => RGBtoHEX( 'rgb(6, 182, 212)' ),
			'cyan-600'     => RGBtoHEX( 'rgb(8, 145, 178)' ),
			'cyan-700'     => RGBtoHEX( 'rgb(14, 116, 144)' ),
			'cyan-800'     => RGBtoHEX( 'rgb(21, 94, 117)' ),
			'cyan-900'     => RGBtoHEX( 'rgb(22, 78, 99)' ),
			'cyan-950'     => RGBtoHEX( 'rgb(8, 51, 68)' ),

			'sky-50'       => RGBtoHEX( 'rgb(240, 249, 255)' ),
			'sky-100'      => RGBtoHEX( 'rgb(224, 242, 254)' ),
			'sky-200'      => RGBtoHEX( 'rgb(186, 230, 253)' ),
			'sky-300'      => RGBtoHEX( 'rgb(125, 211, 252)' ),
			'sky-400'      => RGBtoHEX( 'rgb(56, 189, 248)' ),
			'sky-500'      => RGBtoHEX( 'rgb(14, 165, 233)' ),
			'sky-600'      => RGBtoHEX( 'rgb(2, 132, 199)' ),
			'sky-700'      => RGBtoHEX( 'rgb(3, 105, 161)' ),
			'sky-800'      => RGBtoHEX( 'rgb(7, 89, 133)' ),
			'sky-900'      => RGBtoHEX( 'rgb(12, 74, 110)' ),
			'sky-950'      => RGBtoHEX( 'rgb(8, 47, 73)' ),

			'blue-50'      => RGBtoHEX( 'rgb(239, 246, 255)' ),
			'blue-100'     => RGBtoHEX( 'rgb(219, 234, 254)' ),
			'blue-200'     => RGBtoHEX( 'rgb(191, 219, 254)' ),
			'blue-300'     => RGBtoHEX( 'rgb(147, 197, 253)' ),
			'blue-400'     => RGBtoHEX( 'rgb(96, 165, 250)' ),
			'blue-500'     => RGBtoHEX( 'rgb(59, 130, 246)' ),
			'blue-600'     => RGBtoHEX( 'rgb(37, 99, 235)' ),
			'blue-700'     => RGBtoHEX( 'rgb(29, 78, 216)' ),
			'blue-800'     => RGBtoHEX( 'rgb(30, 64, 175)' ),
			'blue-900'     => RGBtoHEX( 'rgb(30, 58, 138)' ),
			'blue-950'     => RGBtoHEX( 'rgb(23, 37, 84)' ),

			'indigo-50'    => RGBtoHEX( 'rgb(238, 242, 255)' ),
			'indigo-100'   => RGBtoHEX( 'rgb(224, 231, 255)' ),
			'indigo-200'   => RGBtoHEX( 'rgb(199, 210, 254)' ),
			'indigo-300'   => RGBtoHEX( 'rgb(165, 180, 252)' ),
			'indigo-400'   => RGBtoHEX( 'rgb(129, 140, 248)' ),
			'indigo-500'   => RGBtoHEX( 'rgb(99, 102, 241)' ),
			'indigo-600'   => RGBtoHEX( 'rgb(79, 70, 229)' ),
			'indigo-700'   => RGBtoHEX( 'rgb(67, 56, 202)' ),
			'indigo-800'   => RGBtoHEX( 'rgb(55, 48, 163)' ),
			'indigo-900'   => RGBtoHEX( 'rgb(49, 46, 129)' ),
			'indigo-950'   => RGBtoHEX( 'rgb(30, 27, 75)' ),

			'violet-50'    => RGBtoHEX( 'rgb(245, 243, 255)' ),
			'violet-100'   => RGBtoHEX( 'rgb(237, 233, 254)' ),
			'violet-200'   => RGBtoHEX( 'rgb(221, 214, 254)' ),
			'violet-300'   => RGBtoHEX( 'rgb(196, 181, 253)' ),
			'violet-400'   => RGBtoHEX( 'rgb(167, 139, 250)' ),
			'violet-500'   => RGBtoHEX( 'rgb(139, 92, 246)' ),
			'violet-600'   => RGBtoHEX( 'rgb(124, 58, 237)' ),
			'violet-700'   => RGBtoHEX( 'rgb(109, 40, 217)' ),
			'violet-800'   => RGBtoHEX( 'rgb(91, 33, 182)' ),
			'violet-900'   => RGBtoHEX( 'rgb(76, 29, 149)' ),
			'violet-950'   => RGBtoHEX( 'rgb(46, 16, 101)' ),

			'purple-50'    => RGBtoHEX( 'rgb(250, 245, 255)' ),
			'purple-100'   => RGBtoHEX( 'rgb(243, 232, 255)' ),
			'purple-200'   => RGBtoHEX( 'rgb(233, 213, 255)' ),
			'purple-300'   => RGBtoHEX( 'rgb(216, 180, 254)' ),
			'purple-400'   => RGBtoHEX( 'rgb(192, 132, 252)' ),
			'purple-500'   => RGBtoHEX( 'rgb(168, 85, 247)' ),
			'purple-600'   => RGBtoHEX( 'rgb(147, 51, 234)' ),
			'purple-700'   => RGBtoHEX( 'rgb(126, 34, 206)' ),
			'purple-800'   => RGBtoHEX( 'rgb(107, 33, 168)' ),
			'purple-900'   => RGBtoHEX( 'rgb(88, 28, 135)' ),
			'purple-950'   => RGBtoHEX( 'rgb(59, 7, 100)' ),

			'fuchsia-50'   => RGBtoHEX( 'rgb(253, 244, 255)' ),
			'fuchsia-100'  => RGBtoHEX( 'rgb(250, 232, 255)' ),
			'fuchsia-200'  => RGBtoHEX( 'rgb(245, 208, 254)' ),
			'fuchsia-300'  => RGBtoHEX( 'rgb(240, 171, 252)' ),
			'fuchsia-400'  => RGBtoHEX( 'rgb(232, 121, 249)' ),
			'fuchsia-500'  => RGBtoHEX( 'rgb(217, 70, 239)' ),
			'fuchsia-600'  => RGBtoHEX( 'rgb(192, 38, 211)' ),
			'fuchsia-700'  => RGBtoHEX( 'rgb(162, 28, 175)' ),
			'fuchsia-800'  => RGBtoHEX( 'rgb(134, 25, 143)' ),
			'fuchsia-900'  => RGBtoHEX( 'rgb(112, 26, 117)' ),
			'fuchsia-950'  => RGBtoHEX( 'rgb(74, 4, 78)' ),

			'pink-50'      => RGBtoHEX( 'rgb(253, 242, 248)' ),
			'pink-100'     => RGBtoHEX( 'rgb(252, 231, 243)' ),
			'pink-200'     => RGBtoHEX( 'rgb(251, 207, 232)' ),
			'pink-300'     => RGBtoHEX( 'rgb(249, 168, 212)' ),
			'pink-400'     => RGBtoHEX( 'rgb(244, 114, 182)' ),
			'pink-500'     => RGBtoHEX( 'rgb(236, 72, 153)' ),
			'pink-600'     => RGBtoHEX( 'rgb(219, 39, 119)' ),
			'pink-700'     => RGBtoHEX( 'rgb(190, 24, 93)' ),
			'pink-800'     => RGBtoHEX( 'rgb(157, 23, 77)' ),
			'pink-900'     => RGBtoHEX( 'rgb(131, 24, 67)' ),
			'pink-950'     => RGBtoHEX( 'rgb(80, 7, 36)' ),

			'rose-50'      => RGBtoHEX( 'rgb(255, 241, 242)' ),
			'rose-100'     => RGBtoHEX( 'rgb(255, 228, 230)' ),
			'rose-200'     => RGBtoHEX( 'rgb(254, 205, 211)' ),
			'rose-300'     => RGBtoHEX( 'rgb(253, 164, 175)' ),
			'rose-400'     => RGBtoHEX( 'rgb(251, 113, 133)' ),
			'rose-500'     => RGBtoHEX( 'rgb(244, 63, 94)' ),
			'rose-600'     => RGBtoHEX( 'rgb(225, 29, 72)' ),
			'rose-700'     => RGBtoHEX( 'rgb(190, 18, 60)' ),
			'rose-800'     => RGBtoHEX( 'rgb(159, 18, 57)' ),
			'rose-900'     => RGBtoHEX( 'rgb(136, 19, 55)' ),
			'rose-950'     => RGBtoHEX( 'rgb(76, 5, 25)' ),

			'material-blue-gray-50'      => RGBtoHEX( 'rgb(240, 243, 245)' ),
			'material-blue-gray-100'     => RGBtoHEX( 'rgb(222, 229, 232)' ),
			'material-blue-gray-200'     => RGBtoHEX( 'rgb(189, 202, 209)' ),
			'material-blue-gray-300'     => RGBtoHEX( 'rgb(158, 178, 188)' ),
			'material-blue-gray-400'     => RGBtoHEX( 'rgb(125, 152, 165)' ),
			'material-blue-gray-500'     => RGBtoHEX( 'rgb(96, 125, 139)' ),
			'material-blue-gray-600'     => RGBtoHEX( 'rgb(77, 100, 112)' ),
			'material-blue-gray-700'     => RGBtoHEX( 'rgb(58, 76, 84)' ),
			'material-blue-gray-800'     => RGBtoHEX( 'rgb(38, 49, 54)' ),
			'material-blue-gray-900'     => RGBtoHEX( 'rgb(19, 24, 27)' ),
			'material-blue-gray-950'     => RGBtoHEX( 'rgb(10, 14, 15)' ),
		);

		$converter = apply_filters( 'get_aesthetix_customizer_converter_colors', $converter );

		// Return controls.
		if ( ! is_null( $name ) ) {

			$array = array();
			foreach ( $converter as $key => $value ) {
				if ( stripos( $key, $name ) !== false ) {
					$array[ $key ] = $value;
				}
			}
			
			return $array; // Return names array values like rose-100, rose-200, rose-300 etc.
		} elseif ( is_null( $control ) ) {
			return $converter;
		} elseif ( ! isset( $converter[ $control ] ) || empty( $converter[ $control ] ) ) {
			return false;
		} else {
			return $converter[ $control ];
		}
	}
}

if ( ! function_exists( 'get_aesthetix_customizer_converter_display' ) ) {

	/**
	 * Return bool converter display.
	 *
	 * @param string $control Key to get one value. Optional. Default null.
	 *
	 * @return bool
	 */
	function get_aesthetix_customizer_converter_display( $control = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		if ( is_admin() ) {
			return true;
		}

		$display = false;

		if ( $control === 'all' ) {
			$display = true;
		}

		if ( $control === 'front-page' ) {
			if ( ( is_front_page() || is_home() ) && ! is_paged() ) {
				$display = true;
			}
		}

		if ( $control === 'not-front-page' ) {
			if ( ! is_front_page() && ! is_home() ) {
				$display = true;
			}
		}

		if ( $control === 'pages' ) {
			if ( is_page() ) {
				$display = true;
			}
		}

		if ( $control === 'not-pages' ) {
			if ( ! is_page() ) {
				$display = true;
			}
		}

		if ( $control === 'posts' ) {
			if ( is_single() ) {
				$display = true;
			}
		}

		if ( $control === 'not-posts' ) {
			if ( ! is_single() ) {
				$display = true;
			}
		}

		return apply_filters( 'get_aesthetix_customizer_converter_display', $display, $control );
	}
}
