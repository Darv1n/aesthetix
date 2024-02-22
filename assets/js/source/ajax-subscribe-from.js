/**
 * Subscribe form js handler
 *
 * Form js handler  - /assets/js/source/ajax-subscribe-from.js
 * Setup js scripts - /inc/template-setup.php
 * Form php handler - /inc/template-handlers.php
 * Form html        - /templates/subscribe-form.php
 */

jQuery( document ).ready( function( $ ) {

	$( '.subscribe-from' ).on( 'submit', function( e ) {

		var form        = $( this );
			submit      = form.find( '.form-submit' );
			defaultText = submit.data( 'default-text' );
			processText = submit.data( 'process-text' );

		// Ajax request.
		if ( ! form.hasClass( 'processing' ) ) {
			$.ajax( {
				type: 'POST',
				url: ajax_obj.url,
				data: {
					'action': 'subscribe_form_action',
					'query': form.serialize(),
					'nonce': ajax_obj.nonce,
				},
				beforeSend: function() {
					submit.addClass( 'icon-loading' ).text( processText );
					form.find( '.error' ).removeClass( 'error' );
					form.find( '.notification' ).remove();
					form.addClass( 'processing' );
				},
				complete: function() {
					submit.removeClass( 'icon-loading' ).text( defaultText );
					form.trigger( 'reset' ).removeClass( 'processing' );
					notificationButton();
				},
				success: function( response ) {
					if ( response.success ) {
						form.append( '<div class="notification notification_accept">' + response.data + '</div>' );

						if ( $( '.mfp-ready' ).length > 0 ) {
							setTimeout( function () {
								$.magnificPopup.close();
							}, 2500 );
						}

					} else {
						$.each( response.data, function( key, val ) {
							form.find( '#' + key ).addClass( 'error' );
							form.find( '#' + key ).after( '<span class="notification notification_warning">' + val + '</span>' );
						} );
					}
				},
			} )
		}

		e.preventDefault();
	} );
} );
