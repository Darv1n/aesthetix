jQuery( document ).ready( function( $ ) {

	if ( $( '.search-form' ).length > 0 ) {
		$( '.search-form' ).each( function() {
			var width = $( this ).find( '.search-submit' ).outerWidth();
			$( this ).find( '.search-field' ).css( 'padding-right', width );
		} );
	}

	$( 'body' ).on( 'click', '.toggle-icon', function( e ) {

		var on  = $( this ).data( 'icon-on' );
			off = $( this ).data( 'icon-off' );

		if ( $( this ).hasClass( off ) ) {
			$( this ).removeClass( off ).addClass( on );
		} else if ( $( this ).hasClass( on ) ) {
			$( this ).removeClass( on ).addClass( off );
		}

		e.preventDefault();
	} );

	$( 'body' ).on( 'click', '.dropdown-button', function( e ) {

		$( this ).toggleClass( 'on' );
		$( this ).next( '.dropdown-content' ).toggleClass( 'on' );

		e.preventDefault();
	} );

	$( '.menu-open' ).on( 'click', function() {
		$( '#aside-menu' ).addClass( 'on' );
	} );

	$( '.menu-close' ).on( 'click', function() {
		$( this ).closest( '.aside' ).removeClass( 'on' );
	} );

	$( '.scroll-top' ).on( 'click', function() {
		$( 'html, body' ).animate( { scrollTop : 0 }, 800 );
		return false;
	} );

	$( window ).on( 'scroll', function() {
		if ( $( this ).scrollTop() >= 800 ) {
			$( '.scroll-top-wrap' ).fadeIn( 350 );
		} else {
			$( '.scroll-top-wrap' ).fadeOut( 350 );
		}
	} );

	window.notificationButton = function() {
		if ( $( '.notification' ).length > 0 ) {
			$( '.notification' ).each( function() {
				$( this ).prepend( '<span class="notification-button-wrap"><button class="notification-button button-icon-reset button-reset icon icon-md icon-reset icon-xmark" type="button"></button></span>' );
			} );
		}
	}

	notificationButton();

	$( 'body' ).on( 'click', '.notification-button-wrap', function( e ) {
		$( this ).parent().remove();
	} );

	function initCookieAcceper( cookieAccepter ) {
		var button = cookieAccepter.find( '.cookie-button' );

		if ( cookieAccepter.length === 1 ) {
			if ( null === localStorage.getItem( 'cookieAccept' ) || 'off' === localStorage.getItem( 'cookieAccept' ) ) {

				cookieAccepter.css( 'display', 'block' );

				button.on( 'click', function() {
					localStorage.setItem( 'cookieAccept', 'on' );
					cookieAccepter.css( 'display', 'none' );
				});
			}
		} else {
			if ( 'on' === localStorage.getItem( 'cookieAccept' ) ) {
				localStorage.setItem( 'cookieAccept', 'off' );
			}
		}
	}

	initCookieAcceper( $( '#cookie' ) );
} );
