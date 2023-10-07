/**
 * Subscription form js handler
 *
 * Form js handler  - /assets/js/source/subscription-from-handler.js
 * Setup js scripts - /inc/setup.php
 * Form php handler - /inc/handlers.php
 * Form html        - /templates/subscription-form.php
 */

jQuery( document ).ready( function($) {

	$( '#subscription-from' ).on( 'submit', function( e ) {

		var form   = $( this );
			submit = form.find( '.form-submit' );

		// Ajax request.
		if ( ! form.hasClass( 'processing' ) ) {
			$.ajax({
				type: 'POST',
				url: ajax_obj.url,
				data: {
					'action': 'subscription_form_action',
					'query': form.serialize(),
					'nonce': ajax_obj.nonce,
				},
				beforeSend: function() {
					submit.data( 'process-text' );
					form.find( '.error' ).removeClass( 'error' );
					form.find( '.notification' ).remove();
					form.addClass( 'processing' );
				},
				complete: function() {
					submit.data( 'default-text' );
					form.trigger( 'reset' ).removeClass( 'processing' );
				},
				success: function( response ) {
					console.log( response.data );
					if ( response.success ) {
						form.append( '<div class="notification notification_accept">' + response.data + '</div>' );
					} else {
						$.each( response.data, function( key, val ) {
							form.find( '#' + key ).addClass( 'error' );
							form.find( '#' + key ).after( '<span class="notification notification_warning notification_warning_' + key + '">' + val + '</span>' );
						});
					}
				},
			})
		}

		e.preventDefault();
	});
});
