jQuery( document ).ready( function( $ ) {

	// localStorage.removeItem( 'likers' );

	var likers    = localStorage.getItem( 'likers' );
		container = '';
		button    = '';
		count     = '';

	if ( likers === 'undefined' || likers === null ) {
		likers = {};
	} else {
		likers = JSON.parse( likers );
	}

	$.each( likers, function( object_type, obj ) {
		$.each( obj, function( object_id, value ) {
			container = $( '#primary' ).find( '[data-object-type="' + object_type + '"][data-object-id="' + object_id + '"]' );
			if ( container.length === 1 ) {
				button = container.find( '[data-key="' + value + '"]' );
				if ( button.length === 1 ) {
					count = parseInt( button.text() );
					button.removeClass( 'button-empty' ).addClass( 'button-secondary' ).text( count + 1 );
				}
			}
		} );
	} );

	$( '#primary' ).on( 'click', '.button-like', function( e ) {

		var _this       = $( this )
			_value      = _this.data( 'key' );
			container   = _this.parents( '.likes' );
			object_id   = container.data( 'object-id' );
			object_type = container.data( 'object-type' );
			query       = {};

		if ( container.length === 0 ) {
			return;
		}

		if ( typeof likers[ object_type ] === 'undefined' ) {
			likers[ object_type ] = {};
		}

		query[ 'object_id' ]   = object_id;
		query[ 'object_type' ] = object_type;

		container.find( '.button-like' ).each( function( e ) {

			var value = $( this ).data( 'key' );

			// События для кликнутой кнопки.
			if ( value === _value ) {
				if ( $( this ).hasClass( 'button-secondary' ) ) {
					query[ value ] = 'unset';
					delete likers[ object_type ][ object_id ];
				} else {
					query[ value ] = 'set';
					likers[ object_type ][ object_id ] = _value;
				}
			} else {
				// События для второй кнопки.
				if ( $( this ).hasClass( 'button-secondary' ) ) {
					query[ value ] = 'unset';
				}
			}

		} );

		// console.log( _value );
		// console.log( container );
		// console.log( object_id );
		// console.log( object_type );
		// console.log( likers );
		// console.log( query );

		if ( ! container.hasClass( 'processing' ) ) {
			$.ajax( {
				url: ajax_obj.url, // Ajax url from function ajax_localize_params().
				type:'POST',
				data: {
					'action': 'likers_handler', // Handler name.
					'query': query,
				},
				beforeSend: function() {
					container.addClass( 'processing' );
					_this.addClass( 'icon-loading' );
				},
				complete: function() {
					container.removeClass( 'processing' );
					_this.removeClass( 'icon-loading' );
				},
				success:function( response ) {

					if ( response.success ) {
						container.find( '.button-like' ).each( function( e ) {

							var value = $( this ).data( 'key' );
								count = parseInt( $( this ).text() );

							// События для кликнутой кнопки.
							if ( value === _value ) {
								if ( $( this ).hasClass( 'button-secondary' ) ) {
									$( this ).removeClass( 'button-secondary' ).addClass( 'button-empty' ).text( count - 1 );
								} else {
									$( this ).removeClass( 'button-empty' ).addClass( 'button-secondary' ).text( count + 1 );
								}
								localStorage.setItem( 'likers', JSON.stringify( likers ) );
							} else {
								// События для второй кнопки.
								if ( $( this ).hasClass( 'button-secondary' ) ) {
									$( this ).removeClass( 'button-secondary' ).addClass( 'button-empty' ).text( count - 1 );
								}
							}

						} );
					} else {

					}
				}
			} );
		}

		e.preventDefault();
	} );

} );
