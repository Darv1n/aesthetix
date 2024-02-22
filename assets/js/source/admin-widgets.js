/*
** Scripts for widgets admin page.
*/

jQuery( document ).ready( function ( $ ) {

	$( '.widget' ).on( 'click', '.button-add-adv-media', function( e ) {

		var form    = $( this ).closest( 'form' );
			control = $( this ).closest( '.media-widget-control' );
			mediaUploader;

		// If the uploader object has already been created, reopen the dialog.
		if ( mediaUploader ) {
			mediaUploader.open();
			return;
		}

		 // Extend the wp.media object.
		var mediaUploader = wp.media.frames.file_frame = wp.media( {
			title: 'Select Image',
			button: {
				text: 'Select Image'
			},
			multiple: false,
			library: {
				type: 'image'
			},
		} );

		// When a file is selected, grab the URL and set it as the text field's value.
		mediaUploader.on( 'select', function() {
			var attachment = mediaUploader.state().get( 'selection' ).first().toJSON();

			control.find( '.image-upload' ).val( attachment.url );
			control.find( '.media-image-container' ).empty();
			control.find( '.media-image-container' ).append( '<img src="' + attachment.url + '" class="media-image" alt="Image Preview" style="max-width:100%;margin-bottom:10px" /><span class="media-remove dashicons dashicons-no-alt"></span>' );

			$( '.media-modal:visible' ).find( '.media-modal-close' ).trigger( 'click' );

			form.find( 'input[name="savewidget"]' ).val( 'Save' ).removeAttr( 'disabled' );
		} );

		// Open the uploader dialog.
		mediaUploader.open();

		e.preventDefault();
	} );

	$( '.sortable-list' ).sortable( {
		update: function( event, ui ) {
			var items = [];
			$( this ).find( 'li.visible' ).each( function() {
				items.push( $( this ).data( 'key' ).trim() );
			} );
			$( this ).next( '.sortable-input' ).val( items.join( ',' ) ).trigger( 'change' );
		}
	} );

	$( '.dashicons-visibility' ).on( 'click', function( e ) {
		var items = [];
			_this = $( this );

		_this.toggleClass( 'visible invisible' );
		_this.parent().toggleClass( 'visible invisible' );
		_this.closest( '.sortable-list' ).find( 'li.visible' ).each( function() {
			items.push( $( this ).data( 'key' ).trim() );
		} );
		_this.closest( '.sortable-list' ).next( '.sortable-input' ).val( items.join( ',' ) ).trigger( 'change' );
	} );

	$( document ).on( 'click', '.media-remove', function( e ) {

		var control = $( this ).closest( '.media-widget-control' );

		control.find( '.media-image-container' ).empty();
		control.find( '.image-upload' ).val( '' );
	} );

} );
