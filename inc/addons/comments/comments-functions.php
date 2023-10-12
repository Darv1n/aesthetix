<?php
/**
 * Comment functions.
 *
 * @package Aesthetix
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function aesthetix_comment_form_fields( $fields ) {

	$new_order    = array(); // Сюда собираем поля в новом порядке.
	$order_fields = array( 'author', 'email', 'url', 'comment', 'cookies' );

	foreach ( $order_fields as $key => $order_field ) {
		if ( isset( $fields[ $order_field ] ) ) {
			$new_order[ $order_field ] = $fields[ $order_field ];
			unset( $fields[ $order_field ] );
		}
	}

	// Если остались еще какие-то поля добавим их в конец.
	if ( $fields ) {
		foreach( $fields as $key => $field ) {
			$new_fields[ $key ] = $field;
		}
	}

	return $new_order;
}
add_filter( 'comment_form_fields', 'aesthetix_comment_form_fields', 10 );