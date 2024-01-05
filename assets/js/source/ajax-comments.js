/**
 * Comment form js handler
 *
 * Form js handler  - /assets/js/source/subscribe-comments.js
 * Setup js scripts - /inc/setup.php
 * Form php handler - /inc/handlers.php
 * Form html        - /templates/subscribe-form.php
 */

jQuery( document ).ready(function ( $ ) {

	function resetCommentFormValues() {

		var obj = {
			'comment': '',
			'comment_parent': '0',
			'comment_id': '',
			'comment_action': '',
		};

		$.each( obj, function( key, value ) {
			if ( $( '#commentform' ).find( '[name="' + key + '"]' ).length > 0 ) {
				if ( key === 'comment' ) {
					$( '#commentform' ).find( '[name="' + key + '"]' ).text( value );
				} else {
					$( '#commentform' ).find( '[name="' + key + '"]' ).val( value );
				}
			}
		} );
	}

	function resetCommentForm() {
		resetCommentFormValues();

		var respond = $( '#respond' );

		$( '#comments' ).append( respond.prop( 'outerHTML' ) ); // Insert the form after the comment.
		respond.remove(); // Removing the form from the DOM.
	}

	$( '#comments' ).on( 'click', '.comment-confirmation-resend', function( e ) {

		var _this      = $( this );
			comment_id = $( this ).data( 'comment-id' );

		// Ajax request.
		if ( ! _this.hasClass( 'diactive' ) ) {
			$.ajax( {
				type: 'POST',
				url: ajax_obj.url,
				data: {
					'action': 'comments_confirmation_resend_action',
					'comment-id': comment_id,
					'nonce': ajax_obj.nonce,
				},
				beforeSend: function() {
					_this.addClass( 'diactive' );
				},
				complete: function() {
					notificationButton();
					setTimeout( function() {
						_this.removeClass( 'diactive' );
					}, 20000 );
				},
				success: function( response ) {
					if ( response.success ) {
						_this.closest( '.comment' ).find( '.comment-notifications' ).append( '<div class="notification notification_accept">' + response.data + '</div>' );
					} else {
						_this.closest( '.comment' ).find( '.comment-notifications' ).append( '<div class="notification notification_alert">' + response.data + '</div>' );
					}
				},
			} )
		}

		e.preventDefault();
	} );

	$( '#comments' ).on( 'click', '.comment-reply-link', function( e ) {

		resetCommentFormValues();

		var comment    = $( this ).closest( '.comment' );
			comment_id = $( this ).data( 'commentid' );

		$( '#cancel-comment-reply-link' ).css( 'display', 'inline' ); // Activate the cancel comment link.
		$( '#commentform' ).find( '[name="comment_parent"]' ).val( comment_id ); // Add the comment ID to the form.

		var respond = $( '#respond' );

		comment.after( respond.prop( 'outerHTML' ) ); // Insert the form after the comment.
		respond.remove(); // Removing the form from the DOM.

		e.preventDefault();
	} );

	$( '#comments' ).on( 'click', '.comment-edit-link', function( e ) {

		resetCommentFormValues();

		var comment      = $( this ).closest( '.comment' );
			comment_id   = $( this ).data( 'commentid' );
			comment_text = comment.find( '.comment-content' ).html().trim();

		$( '#cancel-comment-reply-link' ).css( 'display', 'inline' ); // Activate the cancel comment link.

		var respond = $( '#respond' );

		respond.find( '[name="comment"]' ).text( comment_text );
		respond.find( '[name="comment_id"]' ).val( comment_id );
		respond.find( '[name="comment_action"]' ).val( 'edit' );

		comment.after( respond.prop( 'outerHTML' ) ); // Insert the form after the comment.
		respond.remove(); // Removing the form from the DOM.

		e.preventDefault();
	} );

	$( '#comments' ).on( 'click', '.comment-delete-link', function( e ) {

		var form       = $( '#commentform' );
			comment_id = $( this ).data( 'commentid' );

		form.find( '[name="comment"]' ).text( 'delete' );
		form.find( '[name="comment_id"]' ).val( comment_id );
		form.find( '[name="comment_action"]' ).val( 'delete' );

		$.ajax( {
			type: 'POST',
			url: ajax_obj.url,
			data: {
				'action': 'comments_action',
				'query': form.serialize(),
				'nonce': ajax_obj.nonce,
			},
			beforeSend: function() {
			},
			complete: function() {
				form.trigger( 'reset' );
				notificationButton();
				resetCommentForm();
			},
			success: function( response ) {
				if ( response.success ) {
					$( '#comment-' + comment_id ).find( '.comment-content' ).html( response.data ).addClass( 'comment-deleted fade-in' );
				} else {
					$.each( response.data, function( key, val ) {
						if ( val.length !== 0 ) {
							// form.find( '[name="' + key + '"]' ).addClass( 'error' );
							form.find( '[name="' + key + '"]' ).after( '<div class="notification notification_warning">' + val + '</div>' );
						}
					} );
				}
			},
		} )

		e.preventDefault();
	} );

	$( '#comments' ).on( 'click', '#cancel-comment-reply-link', function( e ) {

		$( this ).css( 'display', 'none' ); // Hiding the cancel comment link.

		resetCommentForm();

		e.preventDefault();
	} );

	$( '#comments' ).on( 'click', '#submit', function( e ) {

		var submit            = $( this );
			form              = $( this ).closest( 'form' );
			defaultText       = submit.data( 'default-text' );
			processText       = submit.data( 'process-text' );
			comment_id        = form.find( '[name="comment_id"]' ).val();
			comment_parent_id = form.find( '[name="comment_parent"]' ).val();
			comment_action    = form.find( '[name="comment_action"]' ).val();
			ready             = true;

		form.find( '.notification' ).remove();

		$( '#commentform' ).find( 'input[required],textarea[required]' ).each( function() {
			if ( $( this ).val().length === 0 ) {
				$( this ).after( '<div class="notification notification_warning">' + $( this ).data( 'notification' ) + '</div>' );
				notificationButton();
				ready = false;
			}
		} );

		// Ajax request.
		if ( ready && ! form.hasClass( 'processing' ) ) {
			$.ajax( {
				type: 'POST',
				url: ajax_obj.url,
				data: {
					'action': 'comments_action',
					'query': form.serialize(),
					'nonce': ajax_obj.nonce,
				},
				beforeSend: function() {
					submit.addClass( 'icon-loading' ).text( processText );
					// form.find( '.error' ).removeClass( 'error' );
					form.addClass( 'processing' );
				},
				complete: function() {
					form.trigger( 'reset' ).removeClass( 'processing' );
					submit.removeClass( 'icon-loading' ).text( defaultText );
					notificationButton();
					resetCommentForm();
				},
				success: function( response ) {
					if ( response.success ) {
						if ( comment_action.length > 0 && comment_id.length > 0 ) {
							$( '#comment-' + comment_id ).find( '.comment-content' ).html( response.data ).addClass( 'fade-in' );
						} else if ( comment_parent_id === '0' ) {
							$( '#comments > .comment-list' ).append( response.data );
						} else {
							var comment_parent = $( '#comments' ).find( '.comment[data-id="' + comment_parent_id + '"]' );
								children       = comment_parent.closest( '.comment-list-item' ).find( '.children' );

							if ( children.length === 0 ) {
								comment_parent.after( '<ol class="children">' + response.data + '</ol>' );
							} else {
								children.append( response.data );
							}
						}

						console.log( 'New comment added' );
					} else {
						$.each( response.data, function( key, val ) {
							if ( val.length !== 0 ) {
								// form.find( '[name="' + key + '"]' ).addClass( 'error' );
								form.find( '[name="' + key + '"]' ).after( '<div class="notification notification_warning">' + val + '</div>' );
							}
						} );
					}
				},
			} )
		}

		e.preventDefault();
	} );
} );
