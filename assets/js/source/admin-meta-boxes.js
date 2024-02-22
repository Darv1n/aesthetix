/*
** Scripts within the all post window for custom meta boxes.
*/

jQuery( document ).ready( function ( $ ) {

	function mediaUploader( buttonClass ) {

		// Trigger the Media Uploader dialog.
		$( document ).on( 'click', buttonClass, function( e ) {

			var mediaUploader;
				actionText = $( this ).data( 'action-text' );
				form       = $( buttonClass ).closest( 'form' );
				container  = form.find( '#post_images_container' );

			// If the uploader object has already been created, reopen the dialog.
			if ( mediaUploader ) {
				mediaUploader.open();
				return;
			}

			// Extend the wp.media object.
			var mediaUploader = wp.media.frames.file_frame = wp.media( {
				title: actionText,
				button: {
					text: actionText,
				},
				multiple: false,
				library: {
					type: 'image',
				},
			} );

			// When a file is selected, grab the URL and set it as the text field's value.
			mediaUploader.on( 'select', function () {
				var attachment = mediaUploader.state().get( 'selection' ).first().toJSON();
					items      = [];

				container.find( '.post_images' ).append( '<li class="image" data-attachment_id="' + attachment.id + '"><img src="' + attachment.url + '" class="media-image" alt="Image Preview"/><span class="media-remove dashicons dashicons-no-alt" data-attachment_id="' + attachment.id + '"></span></li>' );

				container.find( 'li.image' ).each( function() {
					items.push( $( this ).data( 'attachment_id' ) );
				} );

				container.find( '#post_image_gallery' ).val( items.join( ',' ) ).trigger( 'change' );

				$( '.media-modal:visible' ).find( '.media-modal-close' ).trigger( 'click' );
			} );

			// Open the uploader dialog.
			mediaUploader.open();

		} );
	}

	// Initialize media uploader
	mediaUploader( '.button-add-post-images' );

	$( '.sortable-list' ).sortable( {
		update: function( event, ui ) {
			var items = [];
			$( this ).find( 'li.image' ).each( function( e ) {
				items.push( $( this ).data( 'attachment_id' ) );
			});
			$( this ).next().val( items.join( ',' ) ).trigger( 'change' );
		}
	} );

	$( document ).on( 'click', '.media-remove', function( e ) {

		var form  = $( this ).closest( 'form' );
			id    = $( this ).data( 'attachment_id' );
			items = form.find( '#post_image_gallery' ).val().split( ',' );

		items.splice( $.inArray( String( id ), items ), 1 );

		form.find( '#post_image_gallery' ).val( items.join( ',' ) ).trigger( 'change' );

		$( this ).closest( 'li.image' ).remove();
	} );

} );
